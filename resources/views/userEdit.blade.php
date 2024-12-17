<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="{{ asset('stylesEditUser.css') }}">
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Deixe em branco para manter a senha atual">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
