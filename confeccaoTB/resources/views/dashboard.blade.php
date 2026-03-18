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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700 !important;
        font-size: 1.8rem !important;
        letter-spacing: -0.5px;
    }

    /* Container principal */
    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Card de boas-vindas */
    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        animation: fadeInUp 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .welcome-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .welcome-text h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .welcome-text p {
        color: #718096;
        font-size: 1.1rem;
    }

    .welcome-text span {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    .welcome-icon {
        font-size: 4rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Grid de cards */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* Cards de estatísticas */
    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 1.5rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.5s ease;
        animation-fill-mode: both;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 50px rgba(0,0,0,0.3);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .stat-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-icon {
        font-size: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .stat-change {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #48bb78;
    }

    .stat-change.negative {
        color: #f56565;
    }

    /* Cards de ações rápidas */
    .quick-actions {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        animation: fadeInUp 0.5s ease;
        animation-delay: 0.5s;
        animation-fill-mode: both;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f7fafc;
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        border-color: #667eea;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.2);
    }

    .action-icon {
        font-size: 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .action-info {
        flex: 1;
    }

    .action-info h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }

    .action-info p {
        font-size: 0.85rem;
        color: #718096;
    }

    /* Cards de últimas atividades */
    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .activity-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        padding: 1.5rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        transition: all 0.3s ease;
        animation: fadeInUp 0.5s ease;
        animation-fill-mode: both;
    }

    .activity-card:nth-child(1) { animation-delay: 0.6s; }
    .activity-card:nth-child(2) { animation-delay: 0.7s; }

    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 50px rgba(0,0,0,0.3);
    }

    .activity-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 2px dashed #e2e8f0;
    }

    .activity-icon {
        font-size: 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .activity-header h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item .item-name {
        color: #4a5568;
        font-weight: 500;
    }

    .activity-item .item-value {
        color: #718096;
        font-size: 0.9rem;
    }

    .activity-item .item-value.highlight {
        color: #48bb78;
        font-weight: 600;
    }

    /* Animações */
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

    /* Responsividade */
    @media (max-width: 768px) {
        .main-container {
            padding: 1rem;
        }

        .welcome-text h3 {
            font-size: 1.4rem;
        }

        .welcome-icon {
            font-size: 3rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .actions-grid {
            grid-template-columns: 1fr;
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
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight header-bg">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="main-container">

            <!-- Card de Boas-vindas -->
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="welcome-text">
                        <h3>👋 Bem-vindo(a) ao Sistema!</h3>
                        <p>Gerencie sua <span>Confecção</span> de forma eficiente e moderna</p>
                    </div>
                    <div class="welcome-icon">
                        🏭
                    </div>
                </div>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="dashboard-grid">
                <!-- Total de Produtos -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total de Produtos</span>
                        <span class="stat-icon">👕</span>
                    </div>
                    <div class="stat-value">156</div>
                    <div class="stat-change">
                        <span>▲</span> +12 este mês
                    </div>
                </div>

                <!-- Total de Clientes -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Clientes Ativos</span>
                        <span class="stat-icon">👥</span>
                    </div>
                    <div class="stat-value">89</div>
                    <div class="stat-change">
                        <span>▲</span> +8 este mês
                    </div>
                </div>

                <!-- Pedidos do Mês -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Pedidos do Mês</span>
                        <span class="stat-icon">📦</span>
                    </div>
                    <div class="stat-value">45</div>
                    <div class="stat-change">
                        <span>▲</span> +23% em relação ao mês passado
                    </div>
                </div>

                <!-- Faturamento -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Faturamento Mensal</span>
                        <span class="stat-icon">💰</span>
                    </div>
                    <div class="stat-value">R$ 47.890</div>
                    <div class="stat-change">
                        <span>▲</span> +15% em relação ao mês passado
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="quick-actions">
                <h3 class="section-title">⚡ Ações Rápidas</h3>
                <div class="actions-grid">
                    <a href="{{ route('produtos.create') }}" class="action-btn">
                        <span class="action-icon">➕</span>
                        <div class="action-info">
                            <h4>Novo Produto</h4>
                            <p>Adicionar produto ao catálogo</p>
                        </div>
                    </a>

                    <a href="{{ route('clientes.create') }}" class="action-btn">
                        <span class="action-icon">👤</span>
                        <div class="action-info">
                            <h4>Novo Cliente</h4>
                            <p>Cadastrar novo cliente</p>
                        </div>
                    </a>

                    <a href="{{ route('pedidos.create') }}" class="action-btn">
                        <span class="action-icon">📋</span>
                        <div class="action-info">
                            <h4>Novo Pedido</h4>
                            <p>Registrar novo pedido</p>
                        </div>
                    </a>

                    <a href="{{ route('fornecedores.create') }}" class="action-btn">
                        <span class="action-icon">🏢</span>
                        <div class="action-info">
                            <h4>Novo Fornecedor</h4>
                            <p>Adicionar fornecedor</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Últimas Atividades -->
            <div class="activities-grid">
                <!-- Últimos Pedidos -->
                <div class="activity-card">
                    <div class="activity-header">
                        <span class="activity-icon">📋</span>
                        <h4>Últimos Pedidos</h4>
                    </div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <span class="item-name">Pedido #2456</span>
                            <span class="item-value highlight">R$ 1.250,00</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Pedido #2455</span>
                            <span class="item-value highlight">R$ 890,00</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Pedido #2454</span>
                            <span class="item-value highlight">R$ 2.300,00</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Pedido #2453</span>
                            <span class="item-value highlight">R$ 675,00</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Pedido #2452</span>
                            <span class="item-value highlight">R$ 1.890,00</span>
                        </li>
                    </ul>
                </div>

                <!-- Produtos em Destaque -->
                <div class="activity-card">
                    <div class="activity-header">
                        <span class="activity-icon">👕</span>
                        <h4>Produtos em Destaque</h4>
                    </div>
                    <ul class="activity-list">
                        <li class="activity-item">
                            <span class="item-name">Camiseta Básica</span>
                            <span class="item-value">156 vendas</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Calça Jeans</span>
                            <span class="item-value">89 vendas</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Vestido Floral</span>
                            <span class="item-value">67 vendas</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Jaqueta de Couro</span>
                            <span class="item-value">45 vendas</span>
                        </li>
                        <li class="activity-item">
                            <span class="item-name">Camisa Social</span>
                            <span class="item-value">34 vendas</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Status do Estoque (Opcional) -->
            <div class="quick-actions" style="margin-top: 1.5rem;">
                <h3 class="section-title">📊 Status do Estoque</h3>
                <div class="actions-grid" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
                    <div class="stat-card" style="padding: 1rem;">
                        <div style="text-align: center;">
                            <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">⬆️</span>
                            <span style="font-weight: 600; color: #48bb78;">Alto</span>
                            <span style="display: block; color: #718096; font-size: 0.9rem;">32 produtos</span>
                        </div>
                    </div>
                    <div class="stat-card" style="padding: 1rem;">
                        <div style="text-align: center;">
                            <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">⬇️</span>
                            <span style="font-weight: 600; color: #fbbf24;">Médio</span>
                            <span style="display: block; color: #718096; font-size: 0.9rem;">18 produtos</span>
                        </div>
                    </div>
                    <div class="stat-card" style="padding: 1rem;">
                        <div style="text-align: center;">
                            <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">⚠️</span>
                            <span style="font-weight: 600; color: #f56565;">Baixo</span>
                            <span style="display: block; color: #718096; font-size: 0.9rem;">7 produtos</span>
                        </div>
                    </div>
                    <div class="stat-card" style="padding: 1rem;">
                        <div style="text-align: center;">
                            <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">📦</span>
                            <span style="font-weight: 600; color: #667eea;">Total</span>
                            <span style="display: block; color: #718096; font-size: 0.9rem;">57 produtos</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>