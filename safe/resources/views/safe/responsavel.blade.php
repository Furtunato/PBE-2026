<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE7 - Solicitar Autorização</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Solicitar Autorização</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Sair</button>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('safe.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nome do Aluno *</label>
                    <input type="text" name="aluno_nome" required class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Turma *</label>
                        <input type="text" name="turma" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Professor *</label>
                        <input type="text" name="professor_nome" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Tipo de Fluxo *</label>
                        <select name="tipo_fluxo" class="w-full border rounded-lg px-3 py-2">
                            <option value="Saída">Saída</option>
                            <option value="Entrada">Entrada</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Aula Referência</label>
                        <input type="text" name="aula_referencia" class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Data *</label>
                        <input type="date" name="data_evento" value="{{ date('Y-m-d') }}" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Horário *</label>
                        <input type="time" name="horario" value="{{ date('H:i') }}" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Controle de Falta</label>
                    <select name="controle_falta" class="w-full border rounded-lg px-3 py-2">
                        <option value="Sem Falta">Sem Falta</option>
                        <option value="Com Falta">Com Falta</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Responsável *</label>
                        <input type="text" name="responsavel_nome" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">E-mail do Responsável *</label>
                        <input type="email" name="responsavel_email" required class="w-full border rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Quem está autorizando? *</label>
                    <input type="text" name="quem_autorizou" required class="w-full border rounded-lg px-3 py-2">
                </div>

                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg transition">
                    Enviar Solicitação
                </button>
            </form>
        </div>
    </div>
</body>
</html>