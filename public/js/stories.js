document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.story-title').forEach(title => {
        title.addEventListener('click', function () {
            const storyId = this.getAttribute('data-id');

            // Corrige a URL para garantir que está correta
            const url = `${window.location.origin}/stories/${storyId}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Erro ao buscar história.');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('story-title').innerText = data.title;
                    document.getElementById('story-body').innerText = data.content;
                    document.getElementById('story-content').style.display = 'block';
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao carregar a história.');
                });
        });
    });
});
