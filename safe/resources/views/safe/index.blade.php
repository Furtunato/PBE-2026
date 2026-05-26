<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE - Painel Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(99, 102, 241, 0); }
        }
        
        .animate-slide-in { animation: slideIn 0.5s ease-out; }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15); }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4); }
        
        table tbody tr {
            transition: all 0.2s ease;
        }
        table tbody tr:hover {
            background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
            transform: scale(1.01);
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .input-focus-effect:focus {
            transform: translateY(-2px);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
    </style>
</head>
<body class="min-h-screen">
    
    <!-- Animated Background Particles -->
    <canvas id="bgCanvas" class="fixed inset-0 pointer-events-none" style="z-index: 0;"></canvas>
    
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-shield-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">SAFE</span>
                        <span class="ml-3 text-xs font-medium text-slate-500 hidden sm:inline">Painel de Controle Central</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 font-semibold px-3 py-1.5 rounded-full shadow-sm">
                        <i class="fas fa-user-shield mr-1"></i> AQV / Coordenação
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-sm font-medium text-slate-600 hover:text-red-600 transition-all px-3 py-2 rounded-lg hover:bg-red-50 group">
                            <i class="fas fa-sign-out-alt group-hover:translate-x-1 transition-transform"></i>
                            <span class="ml-1">Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        
        @if(session('success'))
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-lg mb-8 shadow-md animate-slide-in" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card rounded-2xl p-6 shadow-lg card-hover animate-slide-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-amber-600 uppercase tracking-wider">Aguardando Professor</p>
                        <h3 class="text-4xl font-black text-slate-800 mt-2">{{ $arquivos_pendentes_prof }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-hourglass-half text-white text-2xl"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="w-full bg-amber-100 rounded-full h-1.5">
                        <div class="bg-amber-500 h-1.5 rounded-full" style="width: {{ min(100, $arquivos_pendentes_prof * 10) }}%"></div>
                    </div>
                </div>
            </div>

            <div class="stat-card rounded-2xl p-6 shadow-lg card-hover animate-slide-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-purple-600 uppercase tracking-wider">Retido na Portaria</p>
                        <h3 class="text-4xl font-black text-slate-800 mt-2">{{ $arquivos_pendentes_port }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-door-closed text-white text-2xl"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="w-full bg-purple-100 rounded-full h-1.5">
                        <div class="bg-purple-500 h-1.5 rounded-full" style="width: {{ min(100, $arquivos_pendentes_port * 10) }}%"></div>
                    </div>
                </div>
            </div>

            <div class="stat-card rounded-2xl p-6 shadow-lg card-hover animate-slide-in" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wider">Finalizados (Hoje)</p>
                        <h3 class="text-4xl font-black text-emerald-600 mt-2">{{ $total_concluido }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-check-double text-white text-2xl"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="w-full bg-emerald-100 rounded-full h-1.5">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ min(100, $total_concluido * 10) }}%"></div>
                    </div>
                </div>
            </div>

            <div class="stat-card rounded-2xl p-6 shadow-lg card-hover animate-slide-in" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wider">Alunos em Trânsito</p>
                        <h3 class="text-4xl font-black text-blue-600 mt-2">{{ $alunos_transito }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-walking text-white text-2xl"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="w-full bg-blue-100 rounded-full h-1.5">
                        <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ min(100, $alunos_transito * 10) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Form Section -->
            <div class="lg:col-span-1">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden sticky top-24 animate-slide-in" style="animation-delay: 0.5s">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-5">
                        <h2 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="fas fa-pen-alt"></i> Emitir Autorização
                        </h2>
                        <p class="text-indigo-100 text-xs mt-1">Preencha os dados para gerar o fluxo escolar</p>
                    </div>
                    
                    <form method="POST" action="{{ route('safe.store') }}" class="p-6 space-y-4">
                        @csrf
                        <div class="relative">
                            <i class="fas fa-user-graduate absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="text" name="aluno_nome" required placeholder="Nome do Aluno *" 
                                   class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all input-focus-effect">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative">
                                <i class="fas fa-users absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="text" name="turma" required placeholder="Turma *" 
                                       class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            </div>
                            <div class="relative">
                                <i class="fas fa-exchange-alt absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <select name="tipo_fluxo" class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm bg-white focus:ring-2 focus:ring-indigo-500 appearance-none">
                                    <option value="Saída">Saída</option>
                                    <option value="Entrada">Entrada</option>
                                </select>
                            </div>
                        </div>

                        <div class="relative">
                            <i class="fas fa-chalkboard-teacher absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="text" name="professor_nome" required placeholder="Professor Responsável *" 
                                   class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <select name="aula_referencia" required class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-white focus:ring-2 focus:ring-indigo-500">
                                    <option value="" disabled selected>Aula Referência</option>
                                    <option value="1ª Aula">1ª Aula</option>
                                    <option value="2ª Aula">2ª Aula</option>
                                    <option value="3ª Aula">3ª Aula</option>
                                    <option value="4ª Aula">4ª Aula</option>
                                    <option value="5ª Aula">5ª Aula</option>
                                </select>
                            </div>
                            <div>
                                <select name="controle_falta" class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm bg-white focus:ring-2 focus:ring-indigo-500">
                                    <option value="Sem Falta">Sem Falta</option>
                                    <option value="Com Falta">Com Falta</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="relative">
                                <i class="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="date" name="data_evento" value="{{ date('Y-m-d') }}" required 
                                       class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div class="relative">
                                <i class="fas fa-clock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="time" name="horario" value="{{ date('H:i') }}" required 
                                       class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-4 space-y-4">
                            <div class="relative">
                                <i class="fas fa-user-check absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="text" name="responsavel_nome" required placeholder="Responsável Legal *" 
                                       class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="email" name="responsavel_email" required placeholder="E-mail do Responsável *" 
                                       class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="relative">
                            <i class="fas fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input type="text" name="quem_autorizou" required placeholder="Emitido por (Admin) *" 
                                   class="w-full border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm bg-slate-50">
                        </div>

                        <button type="submit" class="btn-gradient w-full text-white font-bold py-3 rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            Confirmar e Enviar Fluxo
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table Section -->
            <div class="lg:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden animate-slide-in" style="animation-delay: 0.6s">
                    <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                                    <i class="fas fa-chart-line"></i> Fluxos Ativos e Histórico
                                </h2>
                                <p class="text-slate-400 text-xs mt-1">Acompanhamento de status ponta a ponta</p>
                            </div>
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50/80">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase">Aluno / Turma</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase">Secretaria</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase">Professor</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase">Portaria</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($autorizacoes as $item)
                                <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-transparent transition-all">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user-graduate text-indigo-600 text-xs"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-slate-900">{{ $item->aluno_nome }}</div>
                                                <div class="text-xs text-slate-500">Turma: {{ $item->turma }} • {{ $item->horario }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                            <i class="fas fa-check-circle mr-1 text-xs"></i> Autorizado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($item->status_professor === 'aprovado')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                                <i class="fas fa-check mr-1"></i> Liberado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 animate-pulse">
                                                <i class="fas fa-clock mr-1"></i> Aguardando
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($item->status_portaria === 'liberado')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
                                                <i class="fas fa-check-double mr-1"></i> Concluído
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">
                                                <i class="fas fa-lock mr-1"></i> Retido
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <i class="fas fa-inbox text-5xl text-slate-300 mb-3 block"></i>
                                        <p class="text-slate-500">Nenhum fluxo registrado no momento</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const canvas = document.getElementById('bgCanvas');
        const ctx = canvas.getContext('2d');
        
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        
        let particles = [];
        for(let i = 0; i < 50; i++) {
            particles.push({
                x: Math.random() * window.innerWidth,
                y: Math.random() * window.innerHeight,
                radius: Math.random() * 2 + 1,
                opacity: Math.random() * 0.3,
                speedX: (Math.random() - 0.5) * 0.3,
                speedY: (Math.random() - 0.5) * 0.2
            });
        }
        
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(99, 102, 241, ${p.opacity})`;
                ctx.fill();
                p.x += p.speedX;
                p.y += p.speedY;
                if(p.x < 0) p.x = canvas.width;
                if(p.x > canvas.width) p.x = 0;
                if(p.y < 0) p.y = canvas.height;
                if(p.y > canvas.height) p.y = 0;
            });
            requestAnimationFrame(draw);
        }
        
        window.addEventListener('resize', () => { resizeCanvas(); });
        resizeCanvas();
        draw();
    </script>
</body>
</html>