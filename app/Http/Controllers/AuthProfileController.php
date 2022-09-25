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
            'lastname' => ['required', 'string', 'max:50'],
            'firstname' => ['required', 'string', 'max:50'],
            'gender' => 'required',
            'update_action' => 'required',
            'imageupload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'required',
        ]);

        if ($request->update_action == "personal") {
            $user = User::find($request->id);
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            // image upload to public/images folder and store image name to database users table
            if ($request->hasFile('imageupload')) {
                if ($user->image != null) {
                    $image_path = 'uploads/' . $user->role . '/' . $user->image;
                    unlink($image_path);
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
        return redirect()->route('profile.show')
            ->with('success', 'user updated successfully');
    }


    // Account acctivity
    public function account_activity()
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        // $data_sessions = count(Sessions::where('user_id', $user_id)->get());
        // $sessions = Sessions::where('user_id', $user_id)->orderBy('last_activity')->paginate(15);
        return view('profile.show', compact('user'));
    }
}
