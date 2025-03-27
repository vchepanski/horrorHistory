<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function read(){
        // $novaColecao = $colecao->map(function ($item) {
        //     return transformação_do_item;
        // });
    $users = User::get();
        $collectionUsers = $users->map(function($user){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'status' => $user->ativo ? 'Ativo' : 'Inativo'
            ];
        });
        dd($collectionUsers);

        return view ('users', compact('users'));
    }
    public function create(){

        return view ('userCreate');

    }
    public function store(Request $request)
    {
        $lastId = DB::table('users')->max('id');
        $nextId = $lastId ? $lastId + 1 : 1;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('user.read')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Busca o usuário ou lança um erro 404
        return view('users.edit', compact('user')); // Retorna a view com os dados do usuário
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8',
    ]);

    $user = User::findOrFail($id); // Busca o usuário
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];

    if (!empty($validatedData['password'])) {
        $user->password = bcrypt($validatedData['password']);
    }

    $user->save();

    return redirect()->route('user.read')->with('success', 'Usuário atualizado com sucesso!');
}

    public function show(){

    }

    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
}

}
