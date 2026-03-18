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
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
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
        border-color: #ed8936;
        box-shadow: 0 0 0 3px rgba(237, 137, 54, 0.1);
    }

    .form-input:hover {
        border-color: #cbd5e0;
    }

    /* Input com máscara */
    .input-masked {
        font-family: monospace;
        letter-spacing: 0.5px;
    }

    /* Textarea específico */
    textarea.form-input {
        resize: vertical;
        min-height: 100px;
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

    /* Botão Atualizar */
    .btn-submit {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
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
        box-shadow: 0 4px 15px rgba(237, 137, 54, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(237, 137, 54, 0.6);
        background: linear-gradient(135deg, #dd6b20 0%, #c05621 100%);
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
            {{ __('Editar Fornecedor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="main-container">
            <div class="content-card">

                <h3 class="form-title">✏️ Editar Fornecedor</h3>

                <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Nome do Fornecedor</label>
                        <input type="text" name="nome" value="{{ old('nome', $fornecedor->nome) }}" 
                               class="form-input" placeholder="Digite o nome do fornecedor" required>
                        @error('nome') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-grid">
                        <div>
                            <label class="form-label">CNPJ</label>
                            <input type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" 
                                   class="form-input input-masked" placeholder="00.000.000/0000-00" required>
                            @error('cnpj') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" 
                                   class="form-input input-masked" placeholder="(00) 00000-0000" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $fornecedor->email) }}" 
                               class="form-input" placeholder="fornecedor@email.com" required>
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="form-label">Endereço</label>
                        <textarea name="endereco" rows="2" class="form-input" 
                                  placeholder="Rua, número, bairro, cidade, estado">{{ old('endereco', $fornecedor->endereco) }}</textarea>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('fornecedores.index') }}" class="btn-cancel">Cancelar</a>
                        <button type="submit" class="btn-submit">Atualizar Fornecedor</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- SCRIPT DE MÁSCARAS -->
    <script>
        // Máscara para CNPJ: 00.000.000/0000-00
        function mascaraCNPJ(campo) {
            let valor = campo.value.replace(/\D/g, '');
            
            if (valor.length <= 14) {
                valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
                valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
                valor = valor.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
            }
            
            campo.value = valor;
        }

        // Máscara para Telefone: (00) 00000-0000
        function mascaraTelefone(campo) {
            let valor = campo.value.replace(/\D/g, '');
            
            if (valor.length <= 11) {
                if (valor.length > 10) {
                    valor = valor.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                } else {
                    valor = valor.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                }
            }
            
            campo.value = valor;
        }

        function aplicarMascara(campo) {
            const nome = campo.name.toLowerCase();
            
            if (nome.includes('cnpj')) {
                mascaraCNPJ(campo);
            } else if (nome.includes('telefone')) {
                mascaraTelefone(campo);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const campos = document.querySelectorAll('input.input-masked');
            
            campos.forEach(campo => {
                if (campo.value) {
                    aplicarMascara(campo);
                }
                
                campo.addEventListener('input', function() {
                    aplicarMascara(this);
                });
                
                campo.addEventListener('keypress', function(e) {
                    const charCode = e.which ? e.which : e.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>