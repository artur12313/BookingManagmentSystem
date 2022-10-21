<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    public function index() 
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:30',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        $user->save();
        
        return redirect()->route('users.index')->withSuccess(__('Użytkownik utworzony pomyślnie.'));
    }

    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:30',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->update();

        return redirect()->route('users.index')->withSuccess(__('Uytkownik zaktualizowany pomyślnie.'));
    }

    public function destroy($id) 
    {
        User::destroy($id);
        return redirect()->route('users.index')->withSuccess(__('Użytkownik usunięty pomyślnie.'));
    }
}
