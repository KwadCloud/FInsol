<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('user.home');
    }

    public function settings()
    {
        $userId = auth()->user()->id;
        $data['settings'] = UserSetting::where(['user_id' => $userId, 'type' => 'Upload Document'])->get();
        return view('user.pages.settings.uploaddoc')->with($data);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.pages.profile.profile', compact('user'));
    }

    public function profileEdit()
    {
        $user = auth()->user();
        return view('user.pages.profile.edit', compact('user'));
    }

    public function editPassword()
    {
        $user = auth()->user();
        return view('user.pages.profile.password', compact('user'));
    }

    public function save_profile(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:users'],
        ]);

        $user = User::where('id', $request->input('id'));

        $user->update([
            'email' => $request->input('email'),
            'aadhaar' => $request->input('aadhaar')
        ]);

        return redirect('profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:users'],
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);

        $user = User::where('id', $request->input('id'));
        $auth = Auth::user();
        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            return back()->with('error', "Current Password is Invalid");
        }
        
        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('profile');
    }

    public function update_image(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:users'],
            'image' => ['required'],
        ]);

        $userFolder = 'public/uploads/users/'.$request->input('id').'/profile';

        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }

        $userFolder = 'public/uploads/users/' . $request->input('id') . '/profile';
        $image = $request->file('image');
        $newName = mt_rand(2000, 9000) . $request->input('id') . '.' . $image->getClientOriginalExtension();
        $path = $image->move($userFolder, $newName);

        $user = User::where('id', $request->input('id'));
        $user->update([
            'image' => $newName
        ]);

        return redirect('profile');
    }
}
