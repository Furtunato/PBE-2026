<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE - Portaria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
        
        .animate-fade-up { animation: fadeInUp 0.6s ease-out; }
        .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .btn-liberar { background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%); transition: all 0.3s ease; }
        .btn-liberar:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.4); }
        
        table tbody tr {
            animation: fadeInUp 0.4s ease-out;
            transition: all 0.3s ease;
        }
        table tbody tr:hover {
            background: linear-gradient(90deg, #f3e8ff 0%, #ede9fe 100%);
            transform: scale(1.01);
        }
    </style>
</head>
<body class="min-h-screen">
    
    <canvas id="particlesCanvas" class="fixed inset-0 pointer-events-none"></canvas>
    
    <nav class="bg-white/90 backdrop-blur-md border-b border-white/20 shadow-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-door-open text-white"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">SAFE</span>
                        <span class="ml-3 text-xs font-medium text-purple-600 hidden sm:inline">Controle de Portaria</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-purple-700 hidden sm:block">
                        <i class="fas fa-user-shield mr-1"></i> {{ Auth::user()->name ?? 'Portaria' }}
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
        
        <div class="text-center mb-8 animate-fade-up">
            <h1 class="text-3xl font-black text-white mb-2">Liberação de Catraca</h1>
            <p class="text-purple-200">Gerencie a saída e entrada de alunos autorizados</p>
        </div>

        @if(session('success'))
            <div class="bg-gradient-to-r from-emerald-500 to-green-500 text-white p-4 rounded-xl mb-8 shadow-xl animate-fade-up flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="glass-card rounded-2xl shadow-2xl overflow-hidden animate-fade-up">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                <div class="flex items-center gap-3">
                    <i class="fas fa-users text-white text-xl"></i>
                    <h2 class="text-lg font-bold text-white">Solicitações Aguardando Liberação</h2>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-purple-100">
                    <thead class="bg-purple-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-700 uppercase">Aluno</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-700 uppercase">Turma</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-700 uppercase">Professor</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-purple-700 uppercase">Horário</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-purple-700 uppercase">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-purple-50 bg-white">
                        @forelse($autorizacoes as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-user-graduate text-purple-600"></i>
                                    </div>
                                    <span class="font-bold text-slate-800">{{ $item->aluno_nome }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                    {{ $item->turma }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $item->professor_nome }}</td>
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-purple-600">{{ $item->horario }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('safe.aprovar', ['autorizacao' => $item->id, 'etapa' => 'portaria']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn-liberar text-white font-bold py-2 px-5 rounded-xl shadow-md transition-all flex items-center gap-2 mx-auto">
                                        <i class="fas fa-qrcode"></i>
                                        Liberar Catraca
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-check-circle text-6xl text-purple-300 mb-4"></i>
                                    <p class="text-slate-500 font-medium">Nenhuma solicitação pendente</p>
                                    <p class="text-slate-400 text-sm mt-1">Tudo tranquilo na portaria!</p>
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
        const canvas = document.getElementById('particlesCanvas');
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
                ctx.fillStyle = `rgba(139, 92, 246, ${p.opacity})`;
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