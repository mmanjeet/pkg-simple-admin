<?php

namespace Cyberzet\SingleAdmin\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

/**
 * Summary of AdminAuthController
 * @author Developer
 * @copyright (c) 2024
 */
class AdminAuthController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('single-admin::login');
    }
    /**
     * Summary of loginAuth
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAuth(Request $request): RedirectResponse
    {
        $data = $request->all();
        $validator = array();
        $validator['email'] = 'required|email';
        $validator['password'] = 'required';
        $request->validate($validator);
        if (Auth::guard('web')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'admin'])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('admin')->with('msg', 'Please Check Your Credentials');
        }
    }
    /**
     * profile
     *
     * @return View
     */
    public function profile(): View
    {
        return view('single-admin::profile');
    }


    /**
     * updateProfile
     *
     * @param Request request
     *
     * @return void
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $validator = array();
        $validator['name'] = 'required|unique:users,name,' . auth()->user()->id;
        $validator['fname'] = 'required';
        $validator['lname'] = 'required';
        if (!empty($request->hasFile('profile_pic'))) {
            $validator['profile_pic'] = 'required|image|mimes:jpeg,png,jpg|max:300';
        }
        $validator['phone'] = 'required';
        $request->validate($validator);
        $user = User::find(auth()->user()->id);
        $user->name = $request->post('name');
        $user->fname = $request->post('fname');
        $user->lname = $request->post('lname');
        $user->phone = $request->post('phone');
        if (!empty($request->hasFile('profile_pic'))) {
            if (!empty(auth()->user()->profile_pic)) {
                if (Storage::disk('public')->exists(auth()->user()->profile_pic)) {
                    Storage::disk('public')->delete(auth()->user()->profile_pic);
                }
            }
            $image = $request->file('profile_pic');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/' . $filename;
            $image->storeAs("public/uploads", $filename);
            $user->profile_pic = $path;
        }
        $user->name = $request->post('name');

        $is_updated = $user->save();
        if ($is_updated) {
            return redirect()->route('profile')->with('msg', ["code" => 200, "message" => "Your Profile has been updated successfully."]);
        } else {
            return redirect()->route('profile')->with('msg', ["code" => 400, "message" => "Please try again."]);
        }
    }


    /**
     * updatePassword
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'new_pass' => 'min:6',
                'password' => 'min:6|required_with:new_pass|same:new_pass'
            ],
            ['same' => 'Confirm password does not match.']
        );
        $object = User::find(auth()->user()->id);
        $object->password = Hash::make($request->password);
        if ($object->save()) {
            return back()->with('msg', ["code" => 200, "message" => "Your password has been updated successfully."]);
        } else {
            return back()->with('msg', ["code" => 400, "message" => "Please try again."]);
        }
    }

    /**
     * logout
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin')->with('msg', 'You are logged out...');
    }
}
