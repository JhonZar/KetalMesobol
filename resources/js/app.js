import "./bootstrap";
import 'flowbite';
import Swal from 'sweetalert2';

// parte del nav 
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menu-button');
    const menu = document.getElementById('menu');

    menuBtn.addEventListener('click', function() {
        // Toggle classes for visibility and transition
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    });
});
//parte de alertaas 
window.showAlert = (title, text, icon) => {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        timer: 3000,  // cierra la alerta después de 3000 milisegundos
        timerProgressBar: true
    });
}
// ///////////////////////////////////////////
function updateSearchResults(query) {
    if (query.length < 3) {
        // Oculta el modal si la consulta es demasiado corta
        closeModal();
        return;
    }

    fetch(`/search?query=${query}`)
        .then(response => response.json())
        .then(data => {
            const results = data.results;
            const searchResults = document.getElementById('searchResults');
            searchResults.innerHTML = '';

            if (results.length > 0) {
                results.forEach(result => {
                    const li = document.createElement('li');
                    li.textContent = `Pedido #${result.id} - Cliente: ${result.cliente.nombre}`;
                    searchResults.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = 'No se encontraron resultados.';
                searchResults.appendChild(li);
            }

            openModal();
        });
}

function openModal() {
    document.getElementById('searchModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('searchModal').classList.add('hidden');
}

document.getElementById('search-toggle').addEventListener('input', (event) => {
    updateSearchResults(event.target.value);
});
