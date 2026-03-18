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
        background: linear-gradient(135deg, #ed64a6 0%, #d53f8c 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700 !important;
        font-size: 1.8rem !important;
        letter-spacing: -0.5px;
    }

    /* Container principal */
    .main-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Card de conteúdo */
    .content-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 2.5rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        animation: fadeInUp 0.5s ease;
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

    /* Título do formulário */
    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #ed64a6 0%, #d53f8c 100%);
        border-radius: 2px;
    }

    /* Labels */
    .form-label {
        display: block;
        font-weight: 600;
        font-size: 0.95rem;
        color: #4a5568;
        margin-bottom: 0.5rem;
        letter-spacing: 0.3px;
    }

    /* Inputs */
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        font-family: 'Poppins', sans-serif;
    }

    .form-input:focus {
        outline: none;
        border-color: #ed64a6;
        box-shadow: 0 0 0 3px rgba(237, 100, 166, 0.1);
    }

    .form-input:hover {
        border-color: #cbd5e0;
    }

    /* Mensagens de erro */
    .error-message {
        display: block;
        color: #f56565;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        font-weight: 500;
        animation: shake 0.5s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
        20%, 40%, 60%, 80% { transform: translateX(2px); }
    }

    /* Container dos botões */
    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e2e8f0;
    }

    /* Botão Cancelar */
    .btn-cancel {
        color: #718096;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        margin-right: 1rem;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
    }

    .btn-cancel:hover {
        background: #edf2f7;
        color: #4a5568;
        border-color: #cbd5e0;
        transform: translateY(-2px);
    }

    /* Botão Atualizar */
    .btn-submit {
        background: linear-gradient(135deg, #ed64a6 0%, #d53f8c 100%);
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(237, 100, 166, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(237, 100, 166, 0.6);
        background: linear-gradient(135deg, #d53f8c 0%, #b83280 100%);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .main-container {
            padding: 1rem;
        }
        
        .content-card {
            padding: 1.5rem;
        }
        
        .header-bg h2 {
            font-size: 1.4rem !important;
        }
        
        .form-title {
            font-size: 1.5rem;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-cancel {
            margin-right: 0;
            width: 100%;
            text-align: center;
        }
        
        .btn-submit {
            width: 100%;
        }
    }

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

    /* Placeholder styling */
    ::placeholder {
        color: #a0aec0;
        font-size: 0.9rem;
    }

    /* Input number arrows styling */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        opacity: 0.5;
        height: 20px;
    }

    input[type=number]:hover::-webkit-inner-spin-button,
    input[type=number]:hover::-webkit-outer-spin-button {
        opacity: 1;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight header-bg">
            {{ __('Editar Pedido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="main-container">
            <div class="content-card">

                <h3 class="form-title">✏️ Editar Pedido #{{ $pedido->id }}</h3>

                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">ID do Cliente</label>
                        <input type="number" name="cliente_id" value="{{ old('cliente_id', $pedido->cliente_id) }}" 
                               class="form-input" placeholder="Digite o ID do cliente" required>
                        @error('cliente_id') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">ID do Produto</label>
                        <input type="number" name="produto_id" value="{{ old('produto_id', $pedido->produto_id) }}" 
                               class="form-input" placeholder="Digite o ID do produto" required>
                        @error('produto_id') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" value="{{ old('quantidade', $pedido->quantidade) }}" 
                               class="form-input" placeholder="Digite a quantidade" required>
                        @error('quantidade') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Valor Total (R$)</label>
                        <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total', $pedido->valor_total) }}" 
                               class="form-input" placeholder="0,00" required>
                        @error('valor_total') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('pedidos.index') }}" class="btn-cancel">Cancelar</a>
                        <button type="submit" class="btn-submit">Atualizar Pedido</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>