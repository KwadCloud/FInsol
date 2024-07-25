<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\OTPCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function generateOTP($user_id)
    {
        $otp = rand(123456, 999999);
        OTPCode::updateOrCreate([
            'user_id' => $user_id,
        ], [
            'code' => $otp,
            'expiry' => Carbon::now()->addMinutes(10),
        ]);

        return $otp;
    }

    public function resendOTP($id)
    {
        $otp = rand(123456, 999999);
        $code = OTPCode::where('user_id', $id);
        $code->update([
            'code' => $otp,
            'expiry' => Carbon::now()->addMinutes(10),
        ]);

        $user = User::where('id', $id)->first();
        $res = $this->sendOTP($user->mobile, $otp);

        if ($res->getStatus() === 0) {
            return view('user.auth.otp', compact('user'));
        }
    }

    public function checkOTP(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'code' => 'required|max:6',
        ]);

        $code = OTPCode::where('user_id', $request->input('user_id'))->first();
        if (Carbon::now()->lte(Carbon::parse($code->expiry))) {
            if ($request->input('code') === $code->code) {
                $user = User::where('id', $code->user_id)->first();
                Auth::login($user);
                return redirect()->route('home');
            }
        } else {
            return "OTP Expired. Send new OTP.";
        }
    }

    public function sendOTP($mobile, $otp)
    {
        $response = Http::post('https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"65c37c54d6fc0530c10059e2","recipients":[{"mobiles":"91' . $mobile . '","VAR1":"' . $otp . '"}]}',
            'headers' => [
                    'accept' => 'application/json',
                    'authkey' => '269800AKJ12m4XMp6z65c37b75P1',
                    'content-type' => 'application/json',
                ],
        ]);

        echo $response;
    }

    public function generateOTPForm(Request $request)
    {
        $credentials = $request->validate([
            'mobile' => ['required', 'exists:users', 'max:10'],
        ]);

        $user = User::where('mobile', $request->input('mobile'))->first();
        $otp = $this->generateOTP($user->id);

        $res = $this->sendOTP($request->input('mobile'), $otp);

        // if($res->getStatus() === 0)
        // {
        //     return view('user.auth.otp', compact('user'));
        // }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'mobile' => ['required', 'exists:users'],
            'password' => ['required'],
        ]);

        if(Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember))
        {
            return redirect()->route('home');
        } else {
            return back()->withErrors(
                [
                    'password' => 'Incorrect password!'
                ]
            );
        }
        
        
    }
}
