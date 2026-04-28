<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UserDex - Sistema de Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .user-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }
        .tab-btn {
            transition: all 0.2s ease;
        }
        .tab-btn.active {
            border-bottom: 2px solid #3b82f6;
            color: #3b82f6;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl shadow-xl p-6 mb-8 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">🎯 UserDex</h1>
                    <p class="text-purple-100">Sua Pokédex de Usuários!</p>
                </div>
                <div class="text-right">
                    <span class="text-5xl">👥</span>
                    <p class="text-sm text-purple-100 mt-1">API DummyJSON</p>
                </div>
            </div>
        </div>

        <!-- Sistema de Abas -->
        <div class="bg-white rounded-xl shadow-md mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6">
                    <button onclick="showTab('listar')" id="tab-listar-btn" class="tab-btn active py-4 px-2 text-gray-600 hover:text-gray-900 font-medium">
                        📋 Listar Usuários
                    </button>
                    <button onclick="showTab('buscar')" id="tab-buscar-btn" class="tab-btn py-4 px-2 text-gray-600 hover:text-gray-900 font-medium">
                        🔍 Buscar Usuário
                    </button>
                    <button onclick="showTab('cadastrar')" id="tab-cadastrar-btn" class="tab-btn py-4 px-2 text-gray-600 hover:text-gray-900 font-medium">
                        ➕ Cadastrar Usuário
                    </button>
                    <button onclick="showTab('detalhes')" id="tab-detalhes-btn" class="tab-btn py-4 px-2 text-gray-600 hover:text-gray-900 font-medium">
                        ⭐ Destaque
                    </button>
                </nav>
            </div>
        </div>

        <!-- Aba 1: Listar Usuários -->
        <div id="tab-listar" class="tab-content">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">👥 Todos os Usuários</h2>
                    <button onclick="carregarUsuarios()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
                        🔄 Atualizar
                    </button>
                </div>
                
                <div id="usuarios-loading" class="text-center py-12 hidden">
                    <div class="loading mx-auto"></div>
                    <p class="text-gray-500 mt-4">Carregando usuários...</p>
                </div>
                
                <div id="usuarios-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg hidden"></div>
                
                <div id="usuarios-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Usuários serão inseridos aqui -->
                </div>
            </div>
        </div>

        <!-- Aba 2: Buscar Usuário -->
        <div id="tab-buscar" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">🔍 Buscar Usuário</h2>
                
                <div class="flex flex-col md:flex-row gap-4 mb-8">
                    <input type="text" id="buscar-input" placeholder="Digite o nome ou ID do usuário..." 
                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="flex gap-3">
                        <select id="buscar-tipo" class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="nome">🔤 Buscar por Nome</option>
                            <option value="id">🔢 Buscar por ID</option>
                        </select>
                        <button onclick="buscarUsuario()" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-medium transition">
                            Buscar
                        </button>
                    </div>
                </div>
                
                <div id="buscar-loading" class="text-center py-8 hidden">
                    <div class="loading mx-auto"></div>
                    <p class="text-gray-500 mt-3">Buscando...</p>
                </div>
                
                <div id="buscar-resultado" class="hidden">
                    <!-- Resultado da busca -->
                </div>
                
                <div id="buscar-erro" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg hidden"></div>
            </div>
        </div>

        <!-- Aba 3: Cadastrar Usuário -->
        <div id="tab-cadastrar" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">➕ Cadastrar Novo Usuário</h2>
                <p class="text-sm text-gray-500 mb-6 bg-gray-50 p-3 rounded-lg">⚠️ Observação: Como é uma API fake (dummyjson.com), os dados não são realmente persistidos. Mas a requisição é simulada com sucesso!</p>
                
                <form id="form-cadastro" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nome *</label>
                            <input type="text" name="firstName" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sobrenome *</label>
                            <input type="text" name="lastName" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                            <input type="text" name="phone" required placeholder="(00) 00000-0000"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Idade *</label>
                            <input type="number" name="age" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gênero *</label>
                            <select name="gender" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="male">👨 Masculino</option>
                                <option value="female">👩 Feminino</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento *</label>
                            <input type="date" name="birthDate" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div class="border-t pt-5 mt-3">
                        <h3 class="font-semibold text-gray-800 mb-4">📍 Endereço</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Endereço *</label>
                                <input type="text" name="address[address]" required 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cidade *</label>
                                <input type="text" name="address[city]" required 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">País *</label>
                                <input type="text" name="address[country]" required 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg font-medium transition">
                            ✅ Cadastrar Usuário
                        </button>
                        <button type="button" onclick="limparFormulario()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-lg font-medium transition">
                            Limpar
                        </button>
                    </div>
                </form>
                
                <div id="cadastro-resultado" class="mt-6 hidden"></div>
            </div>
        </div>

        <!-- Aba 4: Destaque / Sobre -->
        <div id="tab-detalhes" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">⭐ Sobre o UserDex</h2>
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-xl p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-5xl">🎯</span>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">O que é o UserDex?</h3>
                            <p class="text-gray-600">Sua enciclopédia de usuários integrada com a API DummyJSON</p>
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="text-3xl mb-2">📋</div>
                            <h4 class="font-semibold text-gray-800">Listagem Completa</h4>
                            <p class="text-sm text-gray-600">Visualize todos os usuários em cards interativos</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="text-3xl mb-2">🔍</div>
                            <h4 class="font-semibold text-gray-800">Busca Rápida</h4>
                            <p class="text-sm text-gray-600">Encontre usuários por nome ou ID</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="text-3xl mb-2">➕</div>
                            <h4 class="font-semibold text-gray-800">Cadastro Simulado</h4>
                            <p class="text-sm text-gray-600">Teste o fluxo de cadastro de usuários</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="text-3xl mb-2">📱</div>
                            <h4 class="font-semibold text-gray-800">Design Responsivo</h4>
                            <p class="text-sm text-gray-600">Funciona perfeitamente em todos os dispositivos</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                        <p class="text-sm text-gray-700">🔧 <strong>API utilizada:</strong> DummyJSON.com - Uma API fake para testes e desenvolvimento</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // URL base da API
        const API_BASE = '';
        
        // Gerenciamento de abas
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            document.getElementById(`tab-${tabName}`).classList.remove('hidden');
            
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                btn.classList.add('text-gray-600');
            });
            document.getElementById(`tab-${tabName}-btn`).classList.add('active', 'border-blue-500', 'text-blue-600');
        }
        
        // ==================== LISTAR USUÁRIOS ====================
        async function carregarUsuarios() {
            const loadingDiv = document.getElementById('usuarios-loading');
            const errorDiv = document.getElementById('usuarios-error');
            const gridDiv = document.getElementById('usuarios-grid');
            
            loadingDiv.classList.remove('hidden');
            errorDiv.classList.add('hidden');
            gridDiv.innerHTML = '';
            
            try {
                const response = await fetch(`/usuarios`);
                const data = await response.json();
                
                if (response.ok) {
                    exibirUsuarios(data.usuarios);
                } else {
                    throw new Error(data.erro || 'Erro ao carregar usuários');
                }
            } catch (error) {
                errorDiv.innerHTML = `❌ Erro: ${error.message}. Verifique se o servidor está rodando.`;
                errorDiv.classList.remove('hidden');
                console.error('Erro:', error);
            } finally {
                loadingDiv.classList.add('hidden');
            }
        }
        
        function exibirUsuarios(usuarios) {
            const gridDiv = document.getElementById('usuarios-grid');
            gridDiv.innerHTML = '';
            
            if (!usuarios || usuarios.length === 0) {
                gridDiv.innerHTML = '<div class="col-span-full text-center text-gray-500 py-12">Nenhum usuário encontrado.</div>';
                return;
            }
            
            usuarios.forEach(user => {
                const card = document.createElement('div');
                card.className = 'user-card bg-gray-50 rounded-xl p-5 shadow-sm';
                card.onclick = () => verDetalhes(user.id);
                card.innerHTML = `
                    <div class="flex items-center gap-4 mb-4">
                        <img src="${user.foto || 'https://randomuser.me/api/portraits/lego/1.jpg'}" 
                             alt="${user.nome_completo}" 
                             class="w-16 h-16 rounded-full object-cover border-3 border-blue-500">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 text-lg">${user.nome_completo}</h3>
                            <p class="text-sm text-gray-500">${user.email}</p>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm border-t pt-3">
                        <span class="text-gray-600">🎂 ${user.idade} anos</span>
                        <span class="text-gray-600">👤 ${user.genero === 'male' ? 'Masculino' : 'Feminino'}</span>
                    </div>
                `;
                gridDiv.appendChild(card);
            });
        }
        
        // ==================== DETALHES ====================
        async function verDetalhes(id) {
            // Criar modal simples
            const modalHtml = `
                <div id="modal-detalhes" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" onclick="fecharModal(event)">
                    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-bold text-gray-800">📄 Detalhes do Usuário</h3>
                                <button onclick="fecharModal()" class="text-gray-400 hover:text-gray-600 text-3xl">&times;</button>
                            </div>
                            <div id="modal-conteudo" class="space-y-3">
                                <div class="text-center py-8">
                                    <div class="loading mx-auto"></div>
                                    <p class="mt-2">Carregando...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            
            try {
                const response = await fetch(`/usuario/${id}`);
                const data = await response.json();
                
                if (response.ok) {
                    const user = data.usuario;
                    const modalConteudo = document.getElementById('modal-conteudo');
                    modalConteudo.innerHTML = `
                        <div class="flex items-center gap-5 pb-5 border-b">
                            <img src="${user.foto || 'https://randomuser.me/api/portraits/lego/1.jpg'}" class="w-24 h-24 rounded-full object-cover">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">${user.nome_completo}</h3>
                                <p class="text-gray-500">ID: #${user.id}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm mt-4">
                            <div class="bg-gray-50 p-3 rounded-lg"><span class="font-semibold">📧 Email:</span><br>${user.email}</div>
                            <div class="bg-gray-50 p-3 rounded-lg"><span class="font-semibold">📞 Telefone:</span><br>${user.telefone}</div>
                            <div class="bg-gray-50 p-3 rounded-lg"><span class="font-semibold">🎂 Idade:</span><br>${user.idade} anos</div>
                            <div class="bg-gray-50 p-3 rounded-lg"><span class="font-semibold">👤 Gênero:</span><br>${user.genero === 'male' ? 'Masculino' : 'Feminino'}</div>
                            <div class="bg-gray-50 p-3 rounded-lg"><span class="font-semibold">📅 Nascimento:</span><br>${user.data_nascimento}</div>
                            <div class="bg-gray-50 p-3 rounded-lg col-span-2"><span class="font-semibold">📍 Endereço:</span><br>${user.endereco}</div>
                        </div>
                    `;
                } else {
                    document.getElementById('modal-conteudo').innerHTML = `<div class="text-center text-red-500 py-8">❌ ${data.erro || 'Erro ao carregar detalhes'}</div>`;
                }
            } catch (error) {
                document.getElementById('modal-conteudo').innerHTML = `<div class="text-center text-red-500 py-8">❌ Erro de conexão</div>`;
            }
        }
        
        function fecharModal(event) {
            const modal = document.getElementById('modal-detalhes');
            if (modal) modal.remove();
        }
        
        // ==================== BUSCAR ====================
        async function buscarUsuario() {
            const input = document.getElementById('buscar-input');
            const tipo = document.getElementById('buscar-tipo').value;
            const query = input.value.trim();
            
            if (!query) {
                mostrarErroBusca('⚠️ Digite um nome ou ID para buscar');
                return;
            }
            
            document.getElementById('buscar-erro').classList.add('hidden');
            document.getElementById('buscar-loading').classList.remove('hidden');
            document.getElementById('buscar-resultado').classList.add('hidden');
            
            try {
                let response;
                if (tipo === 'id') {
                    response = await fetch(`/usuario/${query}`);
                    const data = await response.json();
                    
                    if (response.ok) {
                        exibirResultadoBusca([data.usuario]);
                    } else {
                        throw new Error(data.erro || 'Usuário não encontrado');
                    }
                } else {
                    response = await fetch(`/usuarios/buscar?nome=${encodeURIComponent(query)}`);
                    const data = await response.json();
                    
                    if (response.ok) {
                        if (data.usuarios.length === 0) {
                            throw new Error('Nenhum usuário encontrado com esse nome');
                        }
                        exibirResultadoBusca(data.usuarios);
                    } else {
                        throw new Error(data.erro || 'Erro na busca');
                    }
                }
            } catch (error) {
                mostrarErroBusca(`❌ ${error.message}`);
            } finally {
                document.getElementById('buscar-loading').classList.add('hidden');
            }
        }
        
        function mostrarErroBusca(mensagem) {
            const errorDiv = document.getElementById('buscar-erro');
            errorDiv.innerHTML = mensagem;
            errorDiv.classList.remove('hidden');
        }
        
        function exibirResultadoBusca(usuarios) {
            const resultadoDiv = document.getElementById('buscar-resultado');
            resultadoDiv.innerHTML = '<h3 class="font-bold text-gray-700 mb-3">🔍 Resultados encontrados:</h3>';
            
            usuarios.forEach(user => {
                const card = document.createElement('div');
                card.className = 'bg-gray-50 rounded-xl p-4 shadow-sm hover:shadow-md transition cursor-pointer mb-3';
                card.onclick = () => verDetalhes(user.id);
                card.innerHTML = `
                    <div class="flex items-center gap-4">
                        <img src="${user.foto || 'https://randomuser.me/api/portraits/lego/1.jpg'}" class="w-14 h-14 rounded-full object-cover">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 text-lg">${user.nome_completo}</h3>
                            <p class="text-sm text-gray-500">${user.email}</p>
                        </div>
                        <span class="text-blue-500 text-sm">Ver detalhes →</span>
                    </div>
                `;
                resultadoDiv.appendChild(card);
            });
            
            resultadoDiv.classList.remove('hidden');
        }
        
        // ==================== CADASTRAR ====================
        const formCadastro = document.getElementById('form-cadastro');
        formCadastro.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(formCadastro);
            const dados = {
                firstName: formData.get('firstName'),
                lastName: formData.get('lastName'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                age: parseInt(formData.get('age')),
                gender: formData.get('gender'),
                birthDate: formData.get('birthDate'),
                address: {
                    address: formData.get('address[address]'),
                    city: formData.get('address[city]'),
                    country: formData.get('address[country]')
                }
            };
            
            const resultadoDiv = document.getElementById('cadastro-resultado');
            resultadoDiv.innerHTML = '<div class="text-center py-4"><div class="loading mx-auto"></div><p class="mt-2">Enviando...</p></div>';
            resultadoDiv.classList.remove('hidden');
            
            try {
                const response = await fetch(`/usuario/novo`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(dados)
                });
                
                const data = await response.json();
                
                if (response.status === 201 || response.ok) {
                    resultadoDiv.innerHTML = `
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                            ✅ ${data.mensagem || 'Usuário cadastrado com sucesso!'}<br>
                            <span class="text-sm">ID gerado: ${data.id_gerado}</span>
                            ${data.observacao ? `<p class="text-xs text-gray-500 mt-2">ℹ️ ${data.observacao}</p>` : ''}
                        </div>
                    `;
                    formCadastro.reset();
                } else {
                    throw new Error(data.erro || 'Erro ao cadastrar');
                }
            } catch (error) {
                resultadoDiv.innerHTML = `<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">❌ ${error.message}</div>`;
            }
        });
        
        function limparFormulario() {
            formCadastro.reset();
            document.getElementById('cadastro-resultado').classList.add('hidden');
        }
        
        // Carregar usuários ao iniciar
        carregarUsuarios();
        
        // Fechar modal com ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') fecharModal();
        });
    </script>
</body>
</html>