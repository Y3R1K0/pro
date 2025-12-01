<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar formulario de login (si lo necesitas)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Lógica de login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Si el usuario es un admin, redirigir al dashboard
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // Si no es admin, redirigir a home
            return redirect()->route('home');
        }

        // Si las credenciales no son válidas, redirigir con error
        return redirect()->route('login')->withErrors('Credenciales incorrectas');
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
