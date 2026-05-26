<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE - Professor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #064e3b 0%, #047857 100%); }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes glowPulse {
            0%, 100% { box-shadow: 0 0 5px #10b981, 0 0 10px #10b981; }
            50% { box-shadow: 0 0 20px #10b981, 0 0 30px #10b981; }
        }
        
        .animate-slide-right { animation: slideInRight 0.5s ease-out; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .btn-liberar { background: linear-gradient(135deg, #10b981 0%, #059669 100%); transition: all 0.3s ease; }
        .btn-liberar:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4); }
        
        table tbody tr {
            animation: slideInRight 0.4s ease-out;
            transition: all 0.3s ease;
        }
        table tbody tr:hover {
            background: linear-gradient(90deg, #d1fae5 0%, #a7f3d0 100%);
            transform: scale(1.01);
        }
    </style>
</head>
<body class="min-h-screen">
    
    <canvas id="bgCanvas" class="fixed inset-0 pointer-events-none"></canvas>
    
    <nav class="bg-white/90 backdrop-blur-md border-b border-white/20 shadow-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chalkboard-teacher text-white"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">SAFE</span>
                        <span class="ml-3 text-xs font-medium text-emerald-600 hidden sm:inline">Portal do Professor</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-emerald-700 hidden sm:block">
                        <i class="fas fa-user-graduate mr-1"></i> {{ Auth::user()->name ?? 'Professor' }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-sm font-medium text-slate-600 hover:text-red-600 transition-all px-3 py-2 rounded-lg hover:bg-red-50">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="ml-1">Sair</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative z-10">
        
        <div class="text-center mb-8 animate-slide-right">
            <h1 class="text-3xl font-black text-white mb-2">Autorizações Pendentes</h1>
            <p class="text-emerald-200">Alunos da sua aula que possuem solicitação de fluxo</p>
        </div>

        @if(session('success'))
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white p-4 rounded-xl mb-8 shadow-xl animate-slide-right flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="glass-card rounded-2xl shadow-2xl overflow-hidden animate-slide-right">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <i class="fas fa-bell text-white text-xl"></i>
                    <h2 class="text-lg font-bold text-white">Solicitações para Autorização</h2>
                    <span class="ml-auto bg-white/20 px-3 py-1 rounded-full text-xs font-bold">
                        {{ count($autorizacoes) }} pendente(s)
                    </span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-emerald-100">
                    <thead class="bg-emerald-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase">Aluno</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase">Turma</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase">Responsável</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase">Horário</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-emerald-700 uppercase">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-50 bg-white">
                        @forelse($autorizacoes as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-user text-emerald-600"></i>
                                    </div>
                                    <span class="font-bold text-slate-800">{{ $item->aluno_nome }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                    {{ $item->turma }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $item->responsavel_nome }}</td>
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-emerald-600">{{ $item->horario }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('safe.aprovar', ['autorizacao' => $item->id, 'etapa' => 'professor']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn-liberar text-white font-bold py-2 px-5 rounded-xl shadow-md transition-all flex items-center gap-2 mx-auto">
                                        <i class="fas fa-check-circle"></i>
                                        Liberar Aluno
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-smile-wink text-6xl text-emerald-300 mb-4"></i>
                                    <p class="text-slate-500 font-medium">Nenhuma solicitação pendente</p>
                                    <p class="text-slate-400 text-sm mt-1">Tudo em ordem com sua turma!</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
        for(let i = 0; i < 60; i++) {
            particles.push({
                x: Math.random() * window.innerWidth,
                y: Math.random() * window.innerHeight,
                radius: Math.random() * 2 + 1,
                opacity: Math.random() * 0.4,
                speedX: (Math.random() - 0.5) * 0.5,
                speedY: (Math.random() - 0.5) * 0.3
            });
        }
        
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(16, 185, 129, ${p.opacity})`;
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
        
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();
        draw();
    </script>
</body>
</html>