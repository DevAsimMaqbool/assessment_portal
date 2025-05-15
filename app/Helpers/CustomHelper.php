<?php

//namespace App\Helpers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\UserAnswer;

use Carbon\Carbon;

if (!function_exists('getResponse')) {
    function getResponse($data, $token, $message, $status): array
    {
        $responseResults = [
            'data' => $data,
            'token' => $token,
            'message' => $message,
            'status' => $status,
        ];
        return $responseResults;
    }
}

function _userCannot(string|array ...$permissions): bool
{
    $permissions = Arr::flatten($permissions);

    return !Auth::user()->can($permissions);
}
function _permissionErrorMessage(): string
{
    return __('You don`t have permission to perform this task.');
}

function sendOtp($user)
{
    $currentTime = Carbon::now();
    $expiresAt = $user->two_factor_expires_at ? Carbon::parse($user->two_factor_expires_at) : null;

    if ($expiresAt && $currentTime->lessThan($expiresAt)) {
        return [
            'success' => false,
            'message' => "OTP has already been sent. Please wait {$expiresAt->diffInSeconds($currentTime)} seconds before requesting again.",
            'status' => 429
        ];
    }

    $otp = random_int(100000, 999999);
    $user->update([
        'two_factor_code' => $otp,
        'two_factor_expires_at' => $currentTime->addMinutes(1), // OTP valid for 1 minute
    ]);

    return [
        'success' => true,
        'otp' => $otp,
        'status' => 201,
        'message' => "OTP has been sent to your email."
    ];
}

function getUserTree($UserID, $level, $manager)
{
    $user = User::where(function ($query) use ($UserID, $level, $manager) {
        $query->where('manager_id', $UserID)
            ->orWhere('level', $level)
            ->orWhere('id', $manager);
    })
        ->where('id', '!=', Auth::id())
        ->get();

    return $user;
}

function getUserLevel($UserID)
{
    $user = User::where('id', $UserID)->firstOrFail();

    return $user->level;
}

function getSocialMirrorScores($userId, $surveyId, $userLevel)
{
    $scores = UserAnswer::selectRaw('questions.category_id, categories.name as category_name, AVG(user_answers.answer) as average_score')
        ->join('questions', 'user_answers.question_id', '=', 'questions.id')
        ->join('categories', 'questions.category_id', '=', 'categories.id')
        ->where('user_answers.for_user_id', $userId)
        ->where('user_answers.survey_id', $surveyId)
        ->where('questions.type', 'stakeholder') // social mirror (360°)
        ->where('questions.level', $userLevel) // match the evaluated user's level
        ->groupBy('questions.category_id', 'categories.name')
        ->get();

    return response()->json($scores);
}