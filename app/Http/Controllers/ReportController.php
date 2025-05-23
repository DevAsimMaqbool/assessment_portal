<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{



    public function reports()
    {
        $users = DB::table('users')->get();
        return view('admin.report', compact('users'));
    }


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
