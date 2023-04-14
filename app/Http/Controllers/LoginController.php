<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {

        $request->validateWithBag('login', [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Signed in');
        }
        return redirect('login')->withErrors('Error', 'login');
    }

    public function registration() {
        return view('auth.registration');
    }

    public function customRegistration(Request $request) {
        $request->validateWithBag('login',[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' =>'required|min:6'
        ]);
        $data = $request->all();
        $check = $this->create($data);

        return redirect('dashboard')->withSuccess('Estas registrado');
    }

    public function create(array $data) {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard() {
        if(Auth::check()) {
            return view('dashboard');
        }
        return redirect('login')->withSuccess('No has iniciado sesion!');
    }
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
