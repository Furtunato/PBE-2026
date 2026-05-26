<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFE - Login Profissional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated gradient background */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animated-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        /* Glassmorphism effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Floating animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        /* Input focus effects */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }

        .input-group input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: color 0.3s ease;
            font-size: 1.1rem;
        }

        .input-group input:focus + i {
            color: #6366f1;
        }

        /* Button gradient animation */
        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-gradient:active {
            transform: translateY(0);
        }

        /* Shimmer loading effect */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        /* Particle canvas */
        #particles-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        /* Card hover effect */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 40px -15px rgba(0, 0, 0, 0.3);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 4px;
        }

        /* Account cards */
        .account-card {
            transition: all 0.2s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .account-card:hover {
            transform: translateX(5px);
            border-color: #6366f1;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        /* Error animation */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .error-shake {
            animation: shake 0.3s ease-in-out;
        }

        /* Success checkmark animation */
        @keyframes checkmark {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .glass-card {
                margin: 1rem;
                padding: 1.5rem !important;
            }
        }
    </style>
</head>
<body class="animated-bg min-h-screen flex items-center justify-center p-4 relative">
    
    <canvas id="particles-canvas"></canvas>

    <div class="relative z-10 w-full max-w-md">
        <!-- Logo Section with Floating Effect -->
        <div class="text-center mb-8 float-animation">
            <div class="inline-block bg-white/20 backdrop-blur-md rounded-full p-4 mb-4 shadow-xl">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center shadow-2xl">
                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                </div>
            </div>
            <h1 class="text-5xl font-black text-white mb-2 tracking-tight drop-shadow-lg">SAFE</h1>
            <p class="text-white/90 text-sm font-medium tracking-wide">Sistema de Autorização e Fluxo Escolar</p>
            <div class="flex justify-center gap-2 mt-3">
                <span class="w-12 h-0.5 bg-white/40 rounded-full"></span>
                <span class="w-6 h-0.5 bg-white/60 rounded-full"></span>
                <span class="w-3 h-0.5 bg-white/80 rounded-full"></span>
            </div>
        </div>

        <!-- Main Card -->
        <div class="glass-card hover-lift transition-all duration-300 p-8 md:p-10">
            
            @if($errors->any())
                <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg error-shake" role="alert">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle text-red-500 mt-0.5"></i>
                        <div>
                            <p class="text-red-800 text-sm font-semibold">Erro de Autenticação</p>
                            <p class="text-red-600 text-sm mt-1">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="space-y-5" id="loginForm">
                @csrf
                
                <!-- Email Field -->
                <div class="input-group">
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           placeholder="seu@email.com" id="emailInput">
                    <i class="fas fa-envelope"></i>
                </div>
                
                <!-- Password Field -->
                <div class="input-group">
                    <input type="password" name="password" required 
                           placeholder="••••••" id="passwordInput">
                    <i class="fas fa-lock"></i>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-gradient w-full text-white font-bold py-3.5 px-4 rounded-xl text-base shadow-lg transition-all duration-300 relative overflow-hidden group" id="submitBtn">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i>
                        Entrar no Sistema
                    </span>
                </button>

                
            </form>

            <!-- Test Accounts Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-center text-sm font-semibold text-gray-700 mb-4">
                    <i class="fas fa-users text-indigo-500 mr-2"></i>
                    Contas para Teste
                </p>
                <div class="space-y-2.5">
                    <div class="account-card bg-gradient-to-r from-gray-50 to-gray-100 p-3 rounded-xl flex justify-between items-center group transition-all">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-crown text-indigo-600 text-xs"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">admin@safe7.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <code class="text-xs text-gray-500 bg-white px-2 py-1 rounded">123456</code>
                            <i class="fas fa-copy text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"></i>
                        </div>
                    </div>
                    <div class="account-card bg-gradient-to-r from-gray-50 to-gray-100 p-3 rounded-xl flex justify-between items-center group transition-all">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-green-600 text-xs"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">professor@safe7.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <code class="text-xs text-gray-500 bg-white px-2 py-1 rounded">123456</code>
                            <i class="fas fa-copy text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"></i>
                        </div>
                    </div>
                    <div class="account-card bg-gradient-to-r from-gray-50 to-gray-100 p-3 rounded-xl flex justify-between items-center group transition-all">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-door-open text-blue-600 text-xs"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">portaria@safe7.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <code class="text-xs text-gray-500 bg-white px-2 py-1 rounded">123456</code>
                            <i class="fas fa-copy text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white/70 text-xs">
                <i class="fas fa-lock mr-1"></i> Ambiente seguro 
                <span class="mx-2">•</span> 
                <i class="fas fa-shield-alt mr-1"></i> Dados criptografados
            </p>
        </div>
    </div>

    <script>
        // Particle system for background
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        
        let particles = [];
        let particleCount = 80;
        
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        
        function createParticles() {
            particles = [];
            for(let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    radius: Math.random() * 2 + 1,
                    speedX: (Math.random() - 0.5) * 0.5,
                    speedY: (Math.random() - 0.5) * 0.3,
                    opacity: Math.random() * 0.5 + 0.2
                });
            }
        }
        
        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach(particle => {
                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 255, 255, ${particle.opacity})`;
                ctx.fill();
                
                particle.x += particle.speedX;
                particle.y += particle.speedY;
                
                if(particle.x < 0) particle.x = canvas.width;
                if(particle.x > canvas.width) particle.x = 0;
                if(particle.y < 0) particle.y = canvas.height;
                if(particle.y > canvas.height) particle.y = 0;
            });
            
            requestAnimationFrame(drawParticles);
        }
        
        window.addEventListener('resize', () => {
            resizeCanvas();
            createParticles();
        });
        
        resizeCanvas();
        createParticles();
        drawParticles();
        
        // Form validation and interaction
        const form = document.getElementById('loginForm');
        const emailInput = document.getElementById('emailInput');
        const passwordInput = document.getElementById('passwordInput');
        const submitBtn = document.getElementById('submitBtn');
        
        // Real-time validation
        emailInput.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(this.value && !emailRegex.test(this.value)) {
                this.style.borderColor = '#ef4444';
                this.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
            } else {
                this.style.borderColor = '#e2e8f0';
                this.style.boxShadow = 'none';
            }
        });
        
        passwordInput.addEventListener('input', function() {
            if(this.value && this.value.length < 6) {
                this.style.borderColor = '#f59e0b';
                this.style.boxShadow = '0 0 0 4px rgba(245, 158, 11, 0.1)';
            } else if(this.value && this.value.length >= 6) {
                this.style.borderColor = '#10b981';
                this.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.1)';
            } else {
                this.style.borderColor = '#e2e8f0';
                this.style.boxShadow = 'none';
            }
        });
        
        // Button loading effect
        form.addEventListener('submit', function(e) {
            const originalHTML = submitBtn.innerHTML;
            submitBtn.innerHTML = '<div class="flex items-center justify-center gap-2"><div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>Autenticando...</div>';
            submitBtn.disabled = true;
            
            // Simulate loading (remove this in production, the form will submit naturally)
            setTimeout(() => {
                if(!form.submitted) {
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.disabled = false;
                }
            }, 2000);
        });
        
        // Copy account credentials
        document.querySelectorAll('.account-card').forEach(card => {
            card.addEventListener('click', function() {
                const emailSpan = this.querySelector('span:first-of-type');
                const codeSpan = this.querySelector('code');
                
                if(emailSpan && codeSpan) {
                    const email = emailSpan.textContent.trim();
                    const password = codeSpan.textContent.trim();
                    
                    // Fill form fields
                    emailInput.value = email;
                    passwordInput.value = password;
                    
                    // Visual feedback
                    const originalBorder = emailInput.style.borderColor;
                    emailInput.style.borderColor = '#10b981';
                    emailInput.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.2)';
                    
                    setTimeout(() => {
                        emailInput.style.borderColor = originalBorder;
                        emailInput.style.boxShadow = 'none';
                    }, 1000);
                    
                    // Show notification
                    showNotification('Conta preenchida automaticamente!');
                }
            });
        });
        
        // Simple notification system
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce';
            notification.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${message}`;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
        
        // Copy functionality for code elements
        document.querySelectorAll('.fa-copy').forEach(copyIcon => {
            copyIcon.addEventListener('click', function(e) {
                e.stopPropagation();
                const code = this.parentElement.querySelector('code').textContent;
                navigator.clipboard.writeText(code);
                showNotification('Senha copiada!');
            });
        });
        
        // Add floating labels effect (enhancement)
        const inputs = document.querySelectorAll('.input-group input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
        
        // Mouse move parallax effect on card
        const card = document.querySelector('.glass-card');
        if(card) {
            document.addEventListener('mousemove', (e) => {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;
                const moveX = (mouseX - 0.5) * 10;
                const moveY = (mouseY - 0.5) * 10;
                
                card.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
            
            document.addEventListener('mouseleave', () => {
                card.style.transform = 'translate(0, 0)';
            });
        }
        
        // Smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if(target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>