<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index')->with([
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:30',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->update();

        return redirect()->route('profile.index')->withSuccess(__('Uytkownik zaktualizowany pomyślnie.'));
    }

    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::find(auth()->user()->id);
        if(Hash::check($request->current_password, $user->password))
        {
            $user->password = $request->password;
            $user->update();
            return redirect()->route('profile.index')->withSuccess(__('Hasło zaktualizowane pomyślnie.'));
        }
        else
        {
            return redirect()->route('profile.index')->withError(__('Podane hasło jest takie samo jak obecne.'));
        }
    }
}
