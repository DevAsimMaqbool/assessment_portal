<?php

namespace App\Http\Controllers;

use App\Models\UserAnswer;
use App\Models\UserCategoryScore;
use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $surveyId = $request->survey_id; // optional
        $forUserId = $request->for_user_id ?? null;
        $userId = auth()->id();

        // 1. Store each answer
        foreach ($request->input('answer', []) as $questionId => $answerValue) {
            UserAnswer::create([
                'user_id' => $userId,
                'for_user_id' => $forUserId,
                'survey_id' => $surveyId,
                'question_id' => $questionId,
                'answer' => $answerValue,
            ]);
        }

        // 2. Only calculate & store average scores for SELF-assessments
        if (!$forUserId) {
            $user = auth()->user();

            // Get the next attempt number
            $maxAttempt = UserCategoryScore::where('user_id', $userId)->max('attempt') ?? 0;
            $nextAttempt = $maxAttempt + 1;

            // Calculate average scores per category for 'self' type & user's level
            $categoryScores = UserAnswer::selectRaw('questions.category_id, AVG(user_answers.answer) as average_score')
                ->join('questions', 'user_answers.question_id', '=', 'questions.id')
                ->where('user_answers.user_id', $userId)
                ->where('questions.type', 'self')
                ->where('questions.level', $user->level)
                ->groupBy('questions.category_id')
                ->get();

            // Save the scores into the user_category_scores table
            foreach ($categoryScores as $score) {
                UserCategoryScore::create([
                    'user_id' => $userId,
                    'category_id' => $score->category_id,
                    'attempt' => $nextAttempt,
                    'average_score' => $score->average_score,
                ]);
            }
        }

        // Redirect after submission
        if ($forUserId) {
            return redirect()->route('question.stakeholder')->with('success', 'Survey submitted successfully.');
        } else {
            return redirect()->route('questions')->with('success', 'Survey submitted successfully.');
        }
    }

    public function storeBK(Request $request)
    {
        $surveyId = $request->survey_id; // if needed
        $forUserId = $request->for_user_id ?? null;

        foreach ($request->input('answer', []) as $questionId => $answerValue) {
            UserAnswer::create([
                'user_id' => auth()->id(),
                'for_user_id' => $forUserId,
                'survey_id' => $surveyId,
                'question_id' => $questionId,
                'answer' => $answerValue,
            ]);
        }
        if ($forUserId) {
            return redirect()->route('question.stakeholder')->with('success', 'Survey submitted successfully.');
        } else {
            return redirect()->route('questions')->with('success', 'Survey submitted successfully.');
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(UserAnswerController $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAnswerController $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAnswerController $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAnswerController $answer)
    {
        //
    }
}
