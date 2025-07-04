<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse|RedirectResponse
    {
        $request->authenticate();

        if (!($request->wantsJson() || $request->is('api/*'))) {
            $request->session()->regenerate();
        }
        $user = Auth::user();
        
        if ($request->wantsJson() || $request->is('api/*')) {
            return apiResponse('Login successful.', ['users' => $user],
            true, 200,$user->createToken('api-token')->plainTextToken);
        }
    
        if ($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif ($user->hasRole('user')) {
            return redirect()->intended(route('dashboard', absolute: false)); // Replace 'user.page' with your route name
        }

        // Default fallback
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse|JsonResponse
    {
        $user = Auth::user();
        if ($request->wantsJson() || $request->is('api/*')) {
           if ($user) {
                $user->tokens()->delete(); // delete all tokens
            }
            return apiResponse('Logged out successfully', [],
            true, 200,'');
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
