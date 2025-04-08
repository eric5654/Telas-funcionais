document.addEventListener('DOMContentLoaded', function() {
    fetch('get_users.php')
        .then(response => response.json())
        .then(users => {
            const tableBody = document.getElementById('userTableBody');
            users.forEach(user => {
                const row = tableBody.insertRow();
                row.insertCell().textContent = user.id;
                row.insertCell().textContent = user.nome;
                row.insertCell().textContent = user.email;
                row.insertCell().textContent = user.telefone;
                const actionsCell = row.insertCell();
                actionsCell.innerHTML = `<button class="delete" data-id="${user.id}">Excluir</button>`;
            });

            tableBody.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete')) {
                    const userId = event.target.dataset.id;
                    if (confirm('Tem certeza que deseja excluir este usuário?')) {
                        fetch('delete_user.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: userId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                event.target.closest('tr').remove();
                            } else {
                                alert('Erro ao excluir usuário.');
                            }
                        });
                    }
                }
            });
        });

    document.getElementById('addUserButton').addEventListener('click', function() {
        alert("Funcionalidade 'Adicionar Usuário' ainda não implementada.");
    });
});