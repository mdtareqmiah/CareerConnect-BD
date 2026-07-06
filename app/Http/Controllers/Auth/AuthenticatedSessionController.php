<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Login user.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Prevent Session Fixation
        $request->session()->regenerate();

        // Update Last Login
        $request->user()->update([
            'last_login_at' => now(),
        ]);

        //return $this->redirectToDashboard($request->user());

        return redirect()->to(
            $this->redirectToDashboard($request->user())
        );
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Redirect user based on role.
     */
    private function redirectToDashboard(User $user): RedirectResponse
    {
        return match ($user->role->slug) {

            'admin' =>
            redirect()->route('admin.dashboard'),

            'employer' =>
            redirect()->route('employer.dashboard'),

            'job_seeker' =>
            redirect()->route('jobseeker.dashboard'),

            default =>
            abort(403, 'Unauthorized role.')
        };
    }
}
