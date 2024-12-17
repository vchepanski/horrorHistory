<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login'); // Certifique-se que a view 'auth.login' existe
    }
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentativa de autenticar com o e-mail e senha fornecidos
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Login bem-sucedido, redireciona para a página inicial
            return redirect()->intended('/site');
        }

        // Falha na autenticação, retorna com erro claro
        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }
}
