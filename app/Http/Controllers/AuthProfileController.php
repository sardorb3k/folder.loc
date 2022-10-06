<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthProfileController extends Controller
{
    // Update information
    public function information(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'lastname' => ['nullable', 'string', 'max:50'],
            'firstname' => ['nullable', 'string', 'max:50'],
            'gender' => 'nullable',
            'update_action' => 'required',
            'imageupload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'nullable',
        ]);
        if(Auth::user()->id == $request->id) {
            if ($request->update_action == "personal") {
                $user = User::find($request->id);
                $user->lastname = $request->lastname ?? $user->lastname;
                $user->firstname = $request->firstname ?? $user->firstname;
                $user->gender = $request->gender ?? $user->gender;
                $user->birthday = $request->birthday;
                // image upload to public/images folder and store image name to database users table
                if ($request->hasFile('imageupload')) {
                    if ($user->image != null) {
                        $image_path = 'uploads/' . $user->role . '/' . $user->image;
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }
                    }
                    $image = $request->file('imageupload');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/' . $user->role);
                    $image->move($destinationPath, $name);
                }
                $user->image = $name ?? $user->image;
                $user->save();
                return redirect()->route('profile.show')
                    ->with('success', 'user updated successfully');
            } else {
                if ($request->password == $request->password_confirmation) {
                    $user = User::find($request->id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return redirect()->route('profile.show')
                        ->with('success', 'user updated successfully');
                } else {
                    $request->validate([
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                    return redirect()->route('users.index')
                        ->with('success', 'Nimadir xato');
                }
            }
        } else {
            return redirect()->route('profile.show')
                ->with('error', 'user not updated');
        }
        return redirect()->route('profile.show')
            ->with('success', 'user updated successfully');
    }


    // Account acctivity
    public function account_activity()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        return view('profile.show', compact('user'));
    }
}
