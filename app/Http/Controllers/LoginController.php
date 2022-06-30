<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 5) {
                return redirect('/');
            } else if (Auth::user()->role_id == 4) {
                return redirect('/sales');
            } else {
                return redirect('/admin_kas');
            }
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            if (Auth::user()->role_id == 5) {
                return redirect('/');
            } else if (Auth::user()->role_id == 4) {
                return redirect('/sales');
            } else if (Auth::user()->role_id == 3) {
                return redirect('/admin_ss');
            } else {
                return redirect('/admin_kas');
            }
        }else{
            return redirect('/login')->with(['error' => 'Username / password Salah']);
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function user()
    {
        $user = User::find(2);
        return view('admin_kas.user.user', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        
        $data = User::findOrFail($request->id);

        if (Hash::check($request->old_password, $data->password)) {
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);   
            $data->save();
    
            return redirect()->back()->with(['success' => 'Data berhasil di update']);
        } else {
            return redirect()->back()->with(['error' => 'Password lama salah']);            
        }

       
    }
}
