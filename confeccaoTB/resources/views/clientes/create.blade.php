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
        background: linear-gradient(135deg, #9f7aea 0%, #805ad5 100%);
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
        background: linear-gradient(135deg, #9f7aea 0%, #805ad5 100%);
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

    /* Inputs e Textarea */
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
        border-color: #9f7aea;
        box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.1);
    }

    .form-input:hover {
        border-color: #cbd5e0;
    }

    /* Input com máscara */
    .input-masked {
        font-family: monospace;
        letter-spacing: 0.5px;
    }

    /* Hint de máscara */
    .mask-hint {
        font-size: 0.8rem;
        color: #718096;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .mask-hint::before {
        content: '✨';
        font-size: 0.9rem;
    }

    /* Textarea específico */
    textarea.form-input {
        resize: vertical;
        min-height: 80px;
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

    /* Grid de campos */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1rem;
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

    /* Botão Salvar */
    .btn-submit {
        background: linear-gradient(135deg, #9f7aea 0%, #805ad5 100%);
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
        box-shadow: 0 4px 15px rgba(159, 122, 234, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(159, 122, 234, 0.6);
        background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Ícone decorativo */
    .form-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .main-container {
            padding: 1rem;
        }
        
        .content-card {
            padding: 1.5rem;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
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
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight header-bg">
            {{ __('Cadastrar Novo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="main-container">
            <div class="content-card">
                
                <div class="form-icon">👤</div>
                <h3 class="form-title">Novo Cliente</h3>

                <!-- Formulário apontando para a rota de salvar -->
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" 
                               class="form-input" placeholder="Digite o nome completo" required>
                        @error('nome') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-grid">
                        <div>
                            <label class="form-label">CPF</label>
                            <input type="text" name="cpf" value="{{ old('cpf') }}" 
                                   class="form-input input-masked" placeholder="000.000.000-00" required>
                            @error('cpf') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" value="{{ old('telefone') }}" 
                                   class="form-input input-masked" placeholder="(00) 00000-0000" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="form-input" placeholder="cliente@email.com" required>
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Endereço</label>
                        <textarea name="endereco" class="form-input" 
                                  placeholder="Rua, número, bairro, cidade, estado">{{ old('endereco') }}</textarea>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('clientes.index') }}" class="btn-cancel">Cancelar</a>
                        <button type="submit" class="btn-submit">
                            Salvar Cliente
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- SCRIPT DE MÁSCARAS -->
    <script>
        // Máscara para CPF: 000.000.000-00
        function mascaraCPF(campo) {
            let valor = campo.value.replace(/\D/g, '');
            
            if (valor.length <= 11) {
                valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
                valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
                valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            
            campo.value = valor;
        }

        // Máscara para Telefone: (00) 00000-0000
        function mascaraTelefone(campo) {
            let valor = campo.value.replace(/\D/g, '');
            
            if (valor.length <= 11) {
                if (valor.length > 10) {
                    // Celular com 9 dígitos
                    valor = valor.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                } else {
                    // Telefone fixo com 8 dígitos
                    valor = valor.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                }
            }
            
            campo.value = valor;
        }

        // Função para aplicar máscara baseada no nome do campo
        function aplicarMascara(campo) {
            const nome = campo.name.toLowerCase();
            
            if (nome.includes('cpf')) {
                mascaraCPF(campo);
            } else if (nome.includes('telefone')) {
                mascaraTelefone(campo);
            }
        }

        // Aplicar máscaras quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            const campos = document.querySelectorAll('input.input-masked');
            
            campos.forEach(campo => {
                // Aplicar máscara inicial se já tiver valor
                if (campo.value) {
                    aplicarMascara(campo);
                }
                
                // Adicionar evento de input
                campo.addEventListener('input', function() {
                    aplicarMascara(this);
                });
                
                // Prevenir caracteres não numéricos
                campo.addEventListener('keypress', function(e) {
                    const charCode = e.which ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Remover formatação antes de enviar (opcional - se quiser salvar sem formatação)
        document.addEventListener('submit', function(e) {
            if (e.target.tagName === 'FORM') {
                const campos = e.target.querySelectorAll('input.input-masked');
                
                campos.forEach(campo => {
                    const nome = campo.name.toLowerCase();
                    
                    if (nome.includes('cpf') || nome.includes('telefone')) {
                        // Criar campo hidden com valor sem formatação
                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = campo.name + '_raw';
                        hidden.value = campo.value.replace(/\D/g, '');
                        
                        e.target.appendChild(hidden);
                    }
                });
            }
        });
    </script>
</x-app-layout>