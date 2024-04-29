<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('monitoringlog.profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'photo' => 'mimes:png,jpeg,jpg,svg'
        ]);

        $id_user = Auth::user()->id;
        $user = User::find($id_user);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $ubah_nama_photo = time() .'_' .  $photo->getClientOriginalName();
            $photo->move('photo', $ubah_nama_photo);

            if($user->photo != 'user.png'){
                File::delete('photo/' . $user->photo);
            }

            $user->photo = $ubah_nama_photo;
            $user->save();
        }

        $user->name = $request->name == '' ? Auth ::user()->name : $request->name;
        $user->email = $request->email == '' ? Auth ::user()->email : $request->email;
        $user->save();
        return redirect('/profile')->with('success', 'Profile berhasil terupdate');

    }

    public function update_password(Request $request)
    {
        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/profile')->with('success', 'Password berhasil terupdate');
     }
}
