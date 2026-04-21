<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(auth()->user()->user_type === 'admin'){
            return redirect()->intended(route('dashboard', absolute: false));
        }else{
            return redirect()->intended(route('front.dashbaord', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(){
        if(Auth::check()){
            return redirect('/');
        }
        return view('frontend.auth.register');
    }

    public function store_register(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_type' => 'required',
            'phone' => 'required',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $membershipData = [];
        if ($request->user_type === 'seller') {
            $membership = null;
            try {
                $membership = Membership::where('user_type', 'seller')
                    ->where('is_active', 1)
                    ->where('is_default', 1)
                    ->first();
            } catch (\Throwable $e) {
                $membership = null;
            }

            $expiryDate = Carbon::now()->addMonth(1)->format('Y-m-d');
            if ($membership) {
                $durationValue = max((int) $membership->duration_value, 1);
                $expiry = Carbon::now();
                if ($membership->duration_type === 'day') {
                    $expiry->addDays($durationValue);
                } elseif ($membership->duration_type === 'year') {
                    $expiry->addYears($durationValue);
                } else {
                    $expiry->addMonths($durationValue);
                }
                $expiryDate = $expiry->format('Y-m-d');
            }

            $membershipData = [
                'membership_id' => $membership->code ?? 4,
                'membership_title' => $membership->title ?? 'Free (Seller)',
                'start_date' => Carbon::now()->format('Y-m-d'),
                'expiry_date' => $expiryDate,
            ];
        }

        $user = User::create([
            'user_type' => $request->user_type,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ] + $membershipData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('front.dashbaord', absolute: false));
    }
}
