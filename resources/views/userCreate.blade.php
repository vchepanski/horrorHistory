<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="{{ asset('stylesCreateUser.css') }}">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Usuário</h1>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
