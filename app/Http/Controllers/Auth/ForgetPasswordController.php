<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;

class ForgetPasswordController extends Controller
{
    public function verifyPinPage()
    {
        return view('auth.verify-pin');
    }
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $pin = random_int(10000, 99999);
        $reset_user_token = bcrypt($pin);
        $user_password_reset = DB::table('password_resets')->where('email', $request->email)->first();
        if ($user_password_reset) {
            DB::table('password_resets')->where('email', $request->email)->delete();

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $reset_user_token,
            ]);

            Mail::send('email.send-pin', ['pin' => $pin], function ($mail) use ($request) {
                $mail->to($request->email);
                $mail->subject('Pin Verification');
                $mail->from('p2pconnectors@gmail.com', 'P2P Connector');
            });

            $email = $request->email;

            return redirect()->route('verify.pin')->with('send_email', $email);
        } else {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $reset_user_token,
            ]);

            Mail::send('email.send-pin', ['pin' => $pin], function ($mail) use ($request) {
                $mail->to($request->email);
                $mail->subject('Pin Verification');
                $mail->from('p2pconnectors@gmail.com', 'P2P Connector');
            });

            $email = $request->email;

            return redirect()->route('verify.pin')->with('send_email', $email);
        }
    }
    public function verifyPin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'pin' => ['required'],
        ]);

        $user_password_reset = DB::table('password_resets')->where('email', $request->email)->first();
        if ($user_password_reset !== null) {
            $verify_pin = password_verify($request->pin, $user_password_reset->token);
            if ($verify_pin) {
                DB::table('password_resets')->where('email', $request->email)->delete();
                $email = $request->email;
                return redirect()->route('password.reset')->with('email', $email);
            }
        } else {
            return redirect()->route('password.request')->with('fail', 'Please Again Try!');
        }
    }
}
