<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Wallet;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries  = Country::get();
        $currency = PaymentMethod::where('status',1)->get();
        return view('frontend.auth.register',compact('countries','currency'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $token = Str::random(64);
        $userData = [
            'name' => $request->name,
            'country' => $request->country,
            'currency' => $request->currency,
            'unique_id' => '#'.random_int(100000, 999999),
            'role' => 'user',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];


        Cache::put($token, $userData, now()->addMinutes(60));

        Mail::send('auth.verify', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification');
            $message->from('p2pconnectors@gmail.com', 'P2P Connector');
        });

        return view('frontend.send_alert');
       }
    public function verify($token)
    {
        if (!Cache::has($token)) {
            return redirect()->route('user_registration')->with('error', 'Invalid or expired verification token.');
        }

        $userData = Cache::get($token);
        Cache::forget($token);
        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        Wallet::create([
            'user_id' => Auth::user()->id,
            'wallet'=> 0,
            'deposit'=> 0,
            'withdrow'=> 0,
        ]);

        return redirect()->route('home')->with('success', 'Your email has been verified and your account is created.');
    }
}
