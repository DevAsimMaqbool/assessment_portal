<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class QuestionController extends Controller
{
    /**
     * Display the self mirror view
     */
    public function show()
    {
        $questions = Question::with('answers')
            ->where([
                ['type', '=', 'self'],
                ['level', '=', Auth::user()->level],
            ])
            ->orderBy('id')
            ->limit('5')
            ->get();
        return view('questions', compact('questions'));
    }


    public function stakeholder($UserID = null)
    {
        $userTree = getUserTree(Auth::user()->id, Auth::user()->level, Auth::user()->manager_id);
        $questions = collect();

        if (!is_null($UserID)) {
            $userLevel = getUserLevel($UserID);

            if ($userLevel) {
                $questions = Question::with('answers')
                    ->where([
                        ['type', '=', 'stakeholder'],
                        ['level', '=', $userLevel],
                    ])
                    ->orderBy('id')
                    ->limit('5')
                    ->get();
            }
        }

        return view('stakeholder_question', compact('questions', 'userTree', 'UserID'));
    }

    /**
     * Store self mirror assessment
     */
    public function storeSelfMirror(Request $request)
    {
        $request->validate([
            'ratings' => 'required|array',
            'ratings.*' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|array',
            'comments.*' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        foreach ($request->ratings as $questionId => $rating) {
            Question::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'type' => 'self',
                'rating' => $rating,
                'comment' => $request->comments[$questionId] ?? null,
            ]);
        }

        return redirect()->route('self-mirror.history')
            ->with('success', 'Self assessment submitted successfully.');
    }

    /**
     * Display self mirror history
     */
    public function selfMirrorHistory()
    {
        $assessments = Question::with('question')
            ->where('user_id', Auth::id())
            ->where('type', 'self')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        return view('self-mirror-history', compact('assessments'));
    }

    /**
     * Display the social mirror view
     */
    public function socialMirror()
    {
        $questions = Question::where('type', 'social_mirror')->orderBy('order')->get();
        $users = DB::table('users')->where('id', '!=', Auth::id())->get();
        $selectedUser = null;

        if (request('user_id')) {
            $selectedUser = DB::table('users')->find(request('user_id'));
        }

        return view('social-mirror', compact('questions', 'users', 'selectedUser'));
    }

    /**
     * Store social mirror assessment
     */
    public function storeSocialMirror(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ratings' => 'required|array',
            'ratings.*' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|array',
            'comments.*' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        foreach ($request->ratings as $questionId => $rating) {
            Question::create([
                'user_id' => $userId,
                'question_id' => $questionId,
                'type' => 'social_mirror',
                'rating' => $rating,
                'comment' => $request->comments[$questionId] ?? null,
                'target_user_id' => $request->user_id,
            ]);
        }

        return redirect()->route('social-mirror.history')
            ->with('success', 'Feedback submitted successfully.');
    }

    /**
     * Display social mirror history
     */
    public function socialMirrorHistory()
    {
        $assessments = Question::with(['question', 'targetUser'])
            ->where('user_id', Auth::id())
            ->where('type', 'social_mirror')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        return view('social-mirror-history', compact('assessments'));
    }

    /**
     * Display reports view
     */
    public function reports()
    {
        $users = DB::table('users')->get();
        return view('reports', compact('users'));
    }

    /**
     * Display user report
     */
    public function employeeReport($userId)
    {
        // Get self assessments
        $selfAssessments = Question::where('user_id', $userId)
            ->where('type', 'self')
            ->select('question_id', DB::raw('AVG(rating) as self_rating'))
            ->groupBy('question_id')
            ->get();

        // Get social assessments
        $socialAssessments = Question::where('target_user_id', $userId)
            ->where('type', 'social_mirror')
            ->select('question_id', DB::raw('AVG(rating) as others_rating'))
            ->groupBy('question_id')
            ->get();

        // Combine assessments
        $questionComparisons = Question::where('type', 'self')
            ->orderBy('order')
            ->get()
            ->map(function ($question) use ($selfAssessments, $socialAssessments) {
                $selfRating = $selfAssessments->firstWhere('question_id', $question->id)?->self_rating ?? 0;
                $othersRating = $socialAssessments->firstWhere('question_id', $question->id)?->others_rating ?? 0;

                return (object) [
                    'name' => $question->name,
                    'self_rating' => round($selfRating, 1),
                    'others_rating' => round($othersRating, 1),
                ];
            });

        // Calculate overall score
        $overallScore = $questionComparisons->avg(function ($comparison) {
            return ($comparison->self_rating + $comparison->others_rating) / 2;
        }) * 20; // Convert to percentage

        // Perform sentiment analysis on comments
        $comments = Question::where('target_user_id', $userId)
            ->where('type', 'social_mirror')
            ->whereNotNull('comment')
            ->pluck('comment')
            ->join(' ');

        $sentimentAnalysis = $this->analyzeSentiment($comments);

        // Identify key strengths and areas for improvement
        $keyStrengths = $questionComparisons
            ->where('others_rating', '>=', 4)
            ->pluck('name');

        $areasForImprovement = $questionComparisons
            ->where('others_rating', '<=', 3)
            ->pluck('name');

        $user = DB::table('users')->find($userId);

        return view('reports', compact(
            'user',
            'questionComparisons',
            'overallScore',
            'sentimentAnalysis',
            'keyStrengths',
            'areasForImprovement'
        ));
    }

    /**
     * Export user report as PDF
     */
    public function exportReport($userId)
    {
        $data = $this->employeeReport($userId);
        //$pdf = PDF::loadView('reports-pdf', $data);
        // return $pdf->download("report-{$data['user']->name}.pdf");
    }

    /**
     * Display a listing of questions
     */
    public function index()
    {
        $questions = Question::orderBy('order')->get();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new question
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created question
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:self,social_mirror',
        ]);

        Question::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'order' => Question::max('order') + 1,
        ]);

        return redirect()->route('questions.index')
            ->with('success', 'Question created successfully.');
    }

    /**
     * Show the form for editing a question
     */
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified question
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:self,social_mirror',
        ]);

        $question->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return redirect()->route('questions.index')
            ->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified question
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')
            ->with('success', 'Question deleted successfully.');
    }

    /**
     * Reorder questions
     */
    public function reorderQuestions(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|integer|exists:questions,id',
        ]);

        foreach ($request->order as $position => $id) {
            Question::where('id', $id)->update(['order' => $position + 1]);
        }

        return response()->json(['message' => 'Questions reordered successfully.']);
    }

    /**
     * Analyze sentiment of text
     */
    private function analyzeSentiment($text)
    {
        // This is a simple sentiment analysis implementation
        // In a real application, you would use a more sophisticated NLP library
        $positiveWords = ['good', 'great', 'excellent', 'outstanding', 'positive', 'happy', 'satisfied'];
        $negativeWords = ['bad', 'poor', 'terrible', 'negative', 'unhappy', 'dissatisfied'];

        $words = str_word_count(strtolower($text), 1);
        $totalWords = count($words);

        if ($totalWords === 0) {
            return (object) [
                'positive' => 0,
                'neutral' => 100,
                'negative' => 0,
            ];
        }

        $positiveCount = count(array_intersect($words, $positiveWords));
        $negativeCount = count(array_intersect($words, $negativeWords));
        $neutralCount = $totalWords - $positiveCount - $negativeCount;

        return (object) [
            'positive' => round(($positiveCount / $totalWords) * 100, 1),
            'neutral' => round(($neutralCount / $totalWords) * 100, 1),
            'negative' => round(($negativeCount / $totalWords) * 100, 1),
        ];
    }
}
