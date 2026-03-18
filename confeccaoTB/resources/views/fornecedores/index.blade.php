<style>
    /* Importando fonte Poppins do Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Reset e estilos base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    /* Header estilizado */
    .header-bg {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .header-bg h2 {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700 !important;
        font-size: 1.8rem !important;
        letter-spacing: -0.5px;
    }

    /* Botão Novo Fornecedor com animação */
    .btn-primary {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(237, 137, 54, 0.4);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(237, 137, 54, 0.6);
        background: linear-gradient(135deg, #dd6b20 0%, #c05621 100%);
    }

    /* Container principal */
    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Card de conteúdo */
    .content-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
    }

    /* Alert de sucesso */
    .success-alert {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
        border: none;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        color: #2d3748;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(132, 250, 176, 0.3);
        animation: slideDown 0.5s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Grid de fornecedores */
    .fornecedores-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    /* Card de fornecedor */
    .fornecedor-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .fornecedor-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
    }

    .fornecedor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 30px rgba(0,0,0,0.1);
    }

    /* Nome do fornecedor */
    .fornecedor-nome {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px dashed #e2e8f0;
    }

    /* Informações do fornecedor */
    .fornecedor-info {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.5rem;
        background: #f7fafc;
        border-radius: 10px;
        font-size: 0.95rem;
    }

    .info-item strong {
        color: #4a5568;
        min-width: 60px;
        font-weight: 600;
    }

    .info-item span {
        color: #718096;
        word-break: break-all;
        font-family: monospace;
        letter-spacing: 0.5px;
    }

    .info-item .cnpj {
        font-family: monospace;
        background: #edf2f7;
        padding: 2px 8px;
        border-radius: 6px;
    }

    /* Ícones nas informações */
    .info-icon {
        font-size: 1.2rem;
        min-width: 24px;
    }

    /* Rodapé do card */
    .card-footer {
        border-top: 1px solid #e2e8f0;
        padding-top: 1rem;
        margin-top: 0.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    /* Botões de ação */
    .btn-edit {
        color: #ed8936;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 6px 12px;
        border-radius: 8px;
        transition: all 0.2s ease;
        background: #fffaf0;
    }

    .btn-edit:hover {
        background: #ed8936;
        color: white;
    }

    .btn-delete {
        color: #f56565;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 6px 12px;
        border-radius: 8px;
        transition: all 0.2s ease;
        background: #fff5f5;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #f56565;
        color: white;
    }

    /* Estado vazio */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: #f7fafc;
        border-radius: 20px;
        color: #a0aec0;
    }

    .empty-state p {
        font-size: 1.2rem;
        font-style: italic;
        position: relative;
        display: inline-block;
    }

    .empty-state p::before,
    .empty-state p::after {
        content: '🏢';
        margin: 0 10px;
        opacity: 0.5;
    }

    /* Modal */
    .modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        animation: fadeIn 0.3s ease;
    }

    .modal.show {
        display: flex;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background: white;
        border-radius: 30px;
        padding: 2rem;
        width: 400px;
        max-width: 90%;
        box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #f56565 0%, #ed64a6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    .modal-text {
        color: #4a5568;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }

    .modal-text strong {
        color: #f56565;
        font-weight: 600;
        display: block;
        margin-top: 0.5rem;
        font-size: 1.2rem;
        background: #fff5f5;
        padding: 8px;
        border-radius: 8px;
        text-align: center;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-cancel {
        padding: 10px 20px;
        background: #e2e8f0;
        color: #4a5568;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        background: #cbd5e0;
    }

    .btn-confirm-delete {
        padding: 10px 24px;
        background: linear-gradient(135deg, #f56565 0%, #ed64a6 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(245, 101, 101, 0.4);
    }

    .btn-confirm-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 101, 101, 0.6);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .main-container {
            padding: 1rem;
        }
        
        .content-card {
            padding: 1rem;
        }
        
        .fornecedores-grid {
            grid-template-columns: 1fr;
        }
        
        .header-bg h2 {
            font-size: 1.4rem !important;
        }
        
        .btn-primary {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }

    /* Animações adicionais */
    .fornecedor-card {
        animation: fadeInUp 0.5s ease;
        animation-fill-mode: both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Delay nas animações dos cards */
    .fornecedor-card:nth-child(1) { animation-delay: 0.1s; }
    .fornecedor-card:nth-child(2) { animation-delay: 0.2s; }
    .fornecedor-card:nth-child(3) { animation-delay: 0.3s; }
    .fornecedor-card:nth-child(4) { animation-delay: 0.4s; }
    .fornecedor-card:nth-child(5) { animation-delay: 0.5s; }
    .fornecedor-card:nth-child(6) { animation-delay: 0.6s; }

    /* Scrollbar personalizada */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
</style>

@php
    function formatarCNPJ($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) == 14) {
            return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
        }
        return $cnpj;
    }

    function formatarTelefone($telefone) {
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        if (strlen($telefone) == 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } elseif (strlen($telefone) == 10) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        }
        return $telefone;
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center header-bg">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fornecedores') }}
            </h2>

            <a href="{{ route('fornecedores.create') }}"
               class="btn-primary">
                + Novo Fornecedor
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="main-container">
            <div class="content-card">

                @if(session('success'))
                    <div class="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="fornecedores-grid">

                    @forelse ($fornecedores as $fornecedor)

                        <div class="fornecedor-card">

                            <div>
                                <h3 class="fornecedor-nome">
                                    {{ $fornecedor->nome }}
                                </h3>

                                <div class="fornecedor-info">
                                    <div class="info-item">
                                        <span class="info-icon">🏢</span>
                                        <strong>CNPJ:</strong>
                                        <span class="cnpj">{{ formatarCNPJ($fornecedor->cnpj) }}</span>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-icon">📞</span>
                                        <strong>Tel:</strong>
                                        <span>{{ formatarTelefone($fornecedor->telefone) }}</span>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-icon">✉️</span>
                                        <strong>Email:</strong>
                                        <span>{{ $fornecedor->email }}</span>
                                    </div>

                                    @if($fornecedor->endereco)
                                    <div class="info-item">
                                        <span class="info-icon">📍</span>
                                        <strong>End:</strong>
                                        <span>{{ $fornecedor->endereco }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Rodapé -->
                            <div class="card-footer">

                                <a href="{{ route('fornecedores.edit', $fornecedor->id) }}"
                                   class="btn-edit">
                                    Editar
                                </a>

                                <!-- BOTÃO MODAL -->
                                <button 
                                    data-id="{{ $fornecedor->id }}"
                                    data-nome="{{ $fornecedor->nome }}"
                                    onclick="abrirModalFornecedor(this)"
                                    class="btn-delete">
                                    Excluir
                                </button>

                            </div>

                        </div>

                    @empty

                        <div class="empty-state">
                            <p>
                                Nenhum fornecedor cadastrado
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div id="modalExcluirFornecedor" class="modal">
        <div class="modal-content">

            <h2 class="modal-title">
                ⚠️ Confirmar exclusão
            </h2>

            <p class="modal-text">
                Deseja excluir o fornecedor:
                <strong id="nomeFornecedor"></strong>?
            </p>

            <div class="modal-actions">

                <button onclick="fecharModalFornecedor()"
                        class="btn-cancel">
                    Cancelar
                </button>

                <form id="formExcluirFornecedor" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn-confirm-delete">
                        Sim, excluir
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function abrirModalFornecedor(element) {
            let id = element.getAttribute('data-id');
            let nome = element.getAttribute('data-nome');

            document.getElementById('modalExcluirFornecedor').classList.add('show');
            document.getElementById('nomeFornecedor').innerText = nome;
            document.getElementById('formExcluirFornecedor').action = '/fornecedores/' + id;
        }

        function fecharModalFornecedor() {
            document.getElementById('modalExcluirFornecedor').classList.remove('show');
        }

        // Fechar modal ao clicar fora
        window.onclick = function(event) {
            let modal = document.getElementById('modalExcluirFornecedor');
            if (event.target == modal) {
                fecharModalFornecedor();
            }
        }
    </script>

</x-app-layout>