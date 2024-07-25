<?php

namespace App\Http\Controllers\User\Auth;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\OTPCode;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $states = State::orderBy('name', 'asc')->get();
        $routeUrl = Helper::getBaseUrl($request);
        return view('user.auth.register', compact('states', 'routeUrl'));
    }

    public function checkUniqueEmail(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['status' => 'error', 'message' => 'Email already exists']);
        }

        return response()->json(['status' => 'success']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            //'aadhaar' => ['unique:users'],
            //'email' => ['unique:users']
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'mobile' => $request['mobile'],
            'state' => $request['state'],
            'district' => $request['district'],
            'block' => $request['block'],
            'aadhaar' => $request['aadhaar'],
        ]);
        session()->flash('message', 'Thank you for registering!');
        Auth::login($user);
        return redirect()->to('home');

        // $otp = rand(123456, 999999);
        // OTPCode::updateOrCreate([
        //     'user_id' => $user->id,
        // ], [
        //     'code' => $otp,
        //     'expiry' => Carbon::now()->addMinutes(10),
        // ]);

        // // $basic = new \Vonage\Client\Credentials\Basic("26370151", "pp7rNfKvnGp51XIR");
        // // $client = new \Vonage\Client($basic);
        // // $response = $client->sms()->send(new \Vonage\SMS\Message\SMS('91'.$user->mobile, 'FINSOL', 'Your OTP for Finsol is ' . $otp . '.'));
        // // $message = $response->current();

        // // if($message->getStatus() === 0)
        // // {
        // //     return view('user.auth.otp', compact('user'));
        // // }

        // $response = Http::post('https://control.msg91.com/api/v5/flow/', [
        //     'body' => '{"template_id":"65c37c54d6fc0530c10059e2","short_url":"1 (On) or 0 (Off)","recipients":[{"mobiles":"91'.$user->mobile.'","VAR1":"'.$otp.'"}]}',
        //     'headers' => [
        //       'accept' => 'application/json',
        //       'authkey' => '269800AKJ12m4XMp6z65c37b75P1',
        //       'content-type' => 'application/json',
        //     ],
        //   ]);

        // //echo $response->getBody();
        // return view('user.auth.otp', compact('user'));
    }
}
