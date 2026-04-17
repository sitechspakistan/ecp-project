<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if(isset($request->new_password)){

            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $request->user()->password = Hash::make($request->new_password);
        }
        

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if(isset($request->address)){
            $request->user()->address = $request->address;
        }

        if(isset($request->country)){
            $request->user()->country = $request->country;
        }

        if(isset($request->state)){
            $request->user()->state = $request->state;
        }

        if(isset($request->city)){
            $request->user()->city = $request->city;
        }

        $uploadDir  = public_path("/uploads/user_image/");
        $name = $request->name.rand(0,9);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $filename = $name.$file->getClientOriginalName().'.'.$file_ext;
            // $file->move($uploadDir, $filename);
            $filepath = $uploadDir.$filename;

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $image = $manager->read($request->file('image'));

            $image->resize(300, 300)->save($filepath);
            $data['image'] = $filename;

            $request->user()->image = $filename;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Profile Updated Successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        dd('ookkkkk');
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        // $user = $request->user();

        // Auth::logout();

        // $user->delete();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return Redirect::to('/');
    }
}
