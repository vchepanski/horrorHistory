<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Admin | Histórias</title>
  <style>
    body {
      background-color: #0d0d0d;
      color: white;
      font-family: Arial, sans-serif;
    }
    table {
      width: 100%;
      margin-top: 2rem;
      border-collapse: collapse;
    }
    th, td {
      padding: 1rem;
      border-bottom: 1px solid #333;
    }
    .actions button {
      margin-right: 0.5rem;
      padding: 0.4rem 0.8rem;
      background: #111;
      border: 1px solid #444;
      color: #ff4444;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>📜 Histórias Submetidas</h1>

  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Categoria</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($historias as $historia)
      <tr>
        <td>{{ $historia->title }}</td>
        <td>{{ $historia->category->name ?? 'Sem categoria' }}</td>
        <td>
          @if ($historia->is_published)
            ✅ Publicada
          @else
            ⏳ Pendente
          @endif
        </td>
        <td class="actions">
          <form action="{{ route('admin.historias.approve', $historia->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">✅ Aprovar</button>
          </form>
          <a href="{{ route('admin.historias.edit', $historia->id) }}"><button>✏️ Editar</button></a>
          <form action="{{ route('admin.historias.destroy', $historia->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">🗑️ Excluir</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
