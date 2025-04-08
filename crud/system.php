<?php
require_once 'Connect.php';
require_once 'Individuo.php';
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Administrativo - Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <style>
        #usersTable th:nth-child(4),
        #usersTable td:nth-child(4) {
            min-width: 150px; /* Ajuste a largura conforme necessário */
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">
    <aside class="bg-gray-800 text-white w-64 min-h-screen p-4">
        </aside>

    <main class="flex-1 p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Usuários Cadastrados</h1>
            <button id="openModal" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full">
                <i class="fas fa-plus mr-2"></i> Novo Usuário
            </button>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <table id="usersTable" class="w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $individuo = new Individuo('', '', '', '');
                        $usuarios = $individuo->getAll();

                        if (is_array($usuarios)) {
                            foreach ($usuarios as $usuario) {
                                echo "<tr>";
                                echo "<td>{$usuario['id']}</td>";
                                echo "<td>{$usuario['nome']}</td>";
                                echo "<td>{$usuario['email']}</td>";
                                echo "<td>{$usuario['telefone']}</td>";
                                echo "<td>
                                        <a href='processarDelete.php?id={$usuario['id']}' class='text-red-500 hover:text-red-700'>
                                            <i class='fas fa-trash-alt'></i>
                                        </a>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 id="userModalTitle" class="text-lg leading-6 font-medium text-gray-900">Cadastro de Novo Usuário</h3>
            <form id="userForm" action="insert.php" method="POST" class="mt-2 text-left">
                <div class="mb-4">
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                    <input type="text" id="nome" name="nome" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label for="telefone" class="block text-gray-700 text-sm font-bold mb-2">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label for="senha" class="block text-gray-700 text-sm font-bold mb-2">Senha:</label>
                    <input type="password" id="senha" name="senha" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label for="confirmSenha" class="block text-gray-700 text-sm font-bold mb-2">Confirmação de Senha:</label>
                    <input type="password" id="confirmSenha" name="confirmSenha" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Cadastrar</button>
                <button type="button" id="closeModal"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#usersTable').DataTable();

            $('#telefone').mask('(00) 00000-0000');

            $('#openModal').click(function () {
                $('#userForm')[0].reset();
                $('#userModalTitle').text('Cadastro de Novo Usuário');
                $('#userModal').removeClass('hidden');
            });

            $('#closeModal').click(function () {
                $('#userModal').addClass('hidden');
            });

            $('#userForm').submit(function (e) {
                var senha = $('#senha').val();
                var confirmSenha = $('#confirmSenha').val();

                if (senha !== confirmSenha) {
                    e.preventDefault();
                    alert("As senhas não coincidem.");
                }
            });
        });
    </script>
</body>

</html>