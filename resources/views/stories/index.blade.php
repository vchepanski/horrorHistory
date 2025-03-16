<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórias de Terror</title>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="{{ asset('stories.css') }}">
</head>
<body>
    <div class="container">
        <h1>Histórias de Terror</h1>

        <!-- Lista de Títulos -->
            @foreach($stories as $story)
            <div class="story-title" data-id="{{ $story->id }}">
                {{ $story->title }}
            </div>
        @endforeach

        <!-- Conteúdo da História -->
        <div id="story-content" style="display:none;">
            <h2 id="story-title"></h2>
            <p id="story-body"></p>
        </div>
    </div>

    <!-- Link para o JS -->
    <script src="{{ asset('js/stories.js') }}"></script>
</body>
</html>
