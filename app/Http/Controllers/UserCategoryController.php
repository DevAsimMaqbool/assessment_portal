<?php

namespace App\Http\Controllers;

use App\Models\UserCategoryScore;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId = null)
    {
        $userId = $userId ?? Auth::user()->id;
        $latestAttempts = UserCategoryScore::where('user_id', $userId)
        ->select('attempt')
        ->distinct()
        ->orderByDesc('attempt')
        ->limit(2)
        ->pluck('attempt');

        // Step 2: Get all category scores for those 2 attempts
        $userScores = UserCategoryScore::with('category')
            ->where('user_id', $userId)
            ->whereIn('attempt', $latestAttempts)
            ->orderBy('attempt')
            ->get()
            ->groupBy('attempt');
            return view('admin.self_feedback', compact('userScores'));

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserCategoryScore $userScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserCategoryScore $userScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserCategoryScore $userScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserCategoryScore $userScore)
    {
        //
    }

    public function showAttemptDetail(Request $request)
    {
        $userId = Auth::id();
        $categoryId = $request->input('category_id');
        $attempt = $request->input('attempt');

        // Find the created_at time of that attempt
        $scoreEntry = UserCategoryScore::where('user_id', $userId)
            ->where('category_id', $categoryId)
            ->where('attempt', $attempt)
            ->firstOrFail();

        // Get answers closest to the time of that attempt (could be improved with attempt column in user_answers)
        $userAnswers = UserAnswer::where('user_id', $userId)
            ->whereHas('question', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->whereDate('created_at', $scoreEntry->created_at->toDateString()) // Approximation based on date
            ->with('question')
            ->get();

        return view('admin.self_feedback_detail', compact('userAnswers', 'scoreEntry'));
    }

}
