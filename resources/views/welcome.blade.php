<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>KUSKUS • Intelligence Terminal</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                        },
                        colors: {
                            slate: {
                                50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155', 800: '#1e293b', 900: '#0f172a', 950: '#020617',
                            },
                            emerald: {
                                50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b', 950: '#022c22',
                            }
                        },
                        animation: {
                            'slow-spin': 'spin 12s linear infinite',
                            'float': 'float 6s ease-in-out infinite',
                            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0)' },
                                '50%': { transform: 'translateY(-20px)' },
                            }
                        }
                    }
                }
            }
        </script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <style>
            [x-cloak] { display: none !important; }
            .grainy-bg {
                background-image: url('https://grainy-gradients.vercel.app/noise.svg');
                opacity: 0.03;
                pointer-events: none;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.02);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .glass-card:hover {
                background: rgba(255, 255, 255, 0.05);
                border-color: rgba(255, 255, 255, 0.2);
                transform: translateY(-5px);
            }
            .text-glow {
                text-shadow: 0 0 30px rgba(255,255,255,0.3);
            }
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: #020205; }
            ::-webkit-scrollbar-thumb { background: #1a1a2e; border-radius: 10px; }
        </style>
    </head>
    <body class="antialiased bg-[#020205] text-white selection:bg-indigo-600 selection:text-white overflow-x-hidden">
        <div class="fixed inset-0 grainy-bg z-[100]"></div>
        
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[10%] -left-[10%] w-[60%] h-[60%] bg-emerald-600/10 rounded-full blur-[150px] animate-pulse-slow"></div>
            <div class="absolute top-[20%] -right-[10%] w-[50%] h-[50%] bg-teal-600/10 rounded-full blur-[150px] animate-pulse-slow" style="animation-delay: 2s"></div>
            <div class="absolute bottom-0 left-[20%] w-[40%] h-[40%] bg-emerald-400/5 rounded-full blur-[150px] animate-pulse-slow" style="animation-delay: 4s"></div>
        </div>

        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 px-6 py-8">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-8 py-5 glass-card rounded-[2rem] shadow-2xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(16,185,129,0.3)]">
                        <i data-lucide="leaf" class="text-black w-6 h-6 stroke-[3px]"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-2xl tracking-tighter uppercase leading-none text-white">KUSKUS</span>
                        <span class="text-[8px] font-black text-emerald-500/30 uppercase tracking-[0.4em] mt-1">Terminal Node 01</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center gap-12">
                    <a href="#features" class="text-[10px] font-black text-white/40 hover:text-white uppercase tracking-[0.3em] transition-colors">Infrastructure</a>
                    <a href="#about" class="text-[10px] font-black text-white/40 hover:text-white uppercase tracking-[0.3em] transition-colors">Security</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-white text-black text-[10px] font-black rounded-xl hover:scale-105 transition-all uppercase tracking-widest shadow-xl">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black text-white/40 hover:text-white uppercase tracking-widest transition-colors mr-6">Identity</a>
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-black text-[10px] font-black rounded-xl hover:scale-105 transition-all uppercase tracking-widest shadow-xl">Initialize</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative min-h-screen pt-40 flex flex-col items-center justify-center overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center z-10">
                <div class="space-y-12 animate-in fade-in slide-in-from-left-10 duration-1000">
                    <div class="inline-flex items-center gap-4 px-6 py-3 rounded-full glass-card text-[10px] font-black uppercase tracking-[0.3em] text-indigo-400">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        System Online • Status Nominal
                    </div>
                    
                    <h1 class="text-[5rem] lg:text-[7.5rem] font-black tracking-tighter leading-[0.85] uppercase">
                        Smarter<br/>
                        <span class="text-glow text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 via-white to-teal-500">Retail.</span>
                    </h1>
                    
                    <p class="text-lg text-white/30 max-w-xl leading-relaxed font-medium uppercase tracking-tight">
                        Experience the next paradigm of retail intelligence. Minimalist architecture. Maximum performance. Engineered for those who command excellence.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-6 pt-6">
                        <a href="{{ route('login') }}" class="px-12 py-6 bg-white text-black font-black rounded-[2rem] hover:scale-105 transition-all uppercase tracking-[0.2em] text-sm shadow-[0_20px_50px_rgba(255,255,255,0.1)] text-center">
                            Access Node
                        </a>
                        <div class="flex items-center gap-4 px-8 py-5 glass-card rounded-[2rem]">
                            <div class="flex -space-x-3">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="w-10 h-10 rounded-full border-2 border-indigo-950 bg-indigo-900/50 flex items-center justify-center text-[8px] font-black">X{{$i}}</div>
                                @endfor
                            </div>
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-[0.2em]">Trusted by 2.4k Nodes</span>
                        </div>
                    </div>
                </div>

                <!-- Interactive Hero Graphic -->
                <div class="relative animate-in fade-in slide-in-from-right-10 duration-1000 delay-300">
                    <!-- Dashboard Preview Card -->
                    <div class="glass-card p-10 rounded-[4rem] animate-float relative z-20 overflow-hidden shadow-[0_50px_100px_rgba(0,0,0,0.5)]">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/10 rounded-full blur-[80px] -mr-32 -mt-32"></div>
                        
                        <div class="flex justify-between items-center mb-12">
                            <div>
                                <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.4em] mb-2">Aggregated Flow</p>
                                <h3 class="text-4xl font-black tracking-tighter uppercase">Rp 128.4M</h3>
                            </div>
                            <div class="w-16 h-16 bg-white text-black rounded-3xl flex items-center justify-center shadow-2xl">
                                <i data-lucide="bar-chart-3" class="w-7 h-7 stroke-[2.5px]"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                            @foreach([['Flux Coffee', '98%'], ['Nova Pastry', '84%'], ['Zen Tea', '92%']] as $item)
                            <div class="p-6 rounded-[2rem] bg-white/5 border border-white/5 hover:bg-white/10 transition-all group">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40 group-hover:text-white transition-colors">{{$item[0]}}</span>
                                    <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">{{$item[1]}}</span>
                                </div>
                                <div class="h-1.5 w-full bg-black/40 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-indigo-600 to-violet-600 rounded-full transition-all duration-1000" style="width: {{$item[1]}}"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-violet-600/10 rounded-full blur-[60px] animate-pulse"></div>
                    <div class="absolute -bottom-10 -left-10 glass-card p-8 rounded-[3rem] animate-float z-30" style="animation-delay: -2s">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-xl">
                                <i data-lucide="shield-check" class="w-8 h-8 text-white stroke-[2.5px]"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] mb-1">Security Node</p>
                                <p class="text-2xl font-black uppercase tracking-tighter">Encrypted</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Animated Marquee Background -->
            <div class="absolute bottom-20 left-0 w-full overflow-hidden opacity-[0.03] select-none pointer-events-none rotate-[-2deg]">
                <div class="flex gap-20 whitespace-nowrap animate-in fade-in duration-1000 slide-in-from-bottom-20">
                    @for ($i = 0; $i < 10; $i++)
                        <span class="text-[15rem] font-black uppercase tracking-tighter italic">KUSKUS INTELLIGENCE • TERMINAL ALPHA • </span>
                    @endfor
                </div>
            </div>
        </main>

        <!-- Feature Grid (Bento) -->
        <section id="features" class="py-40 relative z-10">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-24 space-y-6">
                    <h2 class="text-[4rem] font-black tracking-tighter uppercase leading-none">Global Architecture</h2>
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.5em]">The Infrastructure of Modern Commerce</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 h-[800px]">
                    <div class="md:col-span-8 glass-card rounded-[4rem] p-16 flex flex-col justify-between group overflow-hidden relative">
                        <div class="absolute top-0 right-0 w-[50%] h-full bg-indigo-600/5 group-hover:bg-indigo-600/10 transition-all duration-700 blur-[100px]"></div>
                        <div>
                            <i data-lucide="cpu" class="w-16 h-16 text-indigo-500 mb-8 stroke-[1.5px] group-hover:scale-110 transition-transform duration-700"></i>
                            <h3 class="text-5xl font-black tracking-tighter uppercase mb-6 leading-tight">Hyper-Core<br/>Processing</h3>
                            <p class="text-white/30 text-lg max-w-sm leading-relaxed uppercase tracking-tight">Zero-latency transaction execution powered by Rive Core architecture. Engineered for high-volume environments.</p>
                        </div>
                        <div class="flex gap-4">
                            <span class="px-6 py-2 rounded-full border border-white/10 text-[8px] font-black uppercase tracking-[0.3em]">0.4ms Response</span>
                            <span class="px-6 py-2 rounded-full border border-white/10 text-[8px] font-black uppercase tracking-[0.3em]">Scalable Node</span>
                        </div>
                    </div>
                    
                    <div class="md:col-span-4 glass-card rounded-[4rem] p-12 flex flex-col items-center justify-center text-center group">
                        <div class="w-32 h-32 bg-white/5 rounded-full flex items-center justify-center mb-8 border border-white/10 group-hover:border-white/40 transition-all duration-700 shadow-2xl">
                            <i data-lucide="layers" class="w-12 h-12 text-white group-hover:rotate-12 transition-transform duration-700"></i>
                        </div>
                        <h3 class="text-3xl font-black tracking-tighter uppercase mb-4">Unified Storage</h3>
                        <p class="text-white/30 text-sm leading-relaxed uppercase tracking-tight">End-to-end cloud sync across your entire business ecosystem.</p>
                    </div>

                    <div class="md:col-span-4 glass-card rounded-[4rem] p-12 flex flex-col justify-between group">
                        <i data-lucide="fingerprint" class="w-12 h-12 text-indigo-500 mb-8"></i>
                        <h3 class="text-3xl font-black tracking-tighter uppercase leading-tight">Biometric<br/>Identity</h3>
                    </div>

                    <div class="md:col-span-8 glass-card rounded-[4rem] p-16 flex justify-between items-center group">
                        <div class="space-y-6">
                            <h3 class="text-5xl font-black tracking-tighter uppercase leading-tight">Autonomous<br/>Analytics</h3>
                            <p class="text-white/30 text-lg max-w-sm leading-relaxed uppercase tracking-tight">Predictive inventory modeling based on real-time consumer velocity.</p>
                        </div>
                        <div class="hidden md:block w-48 h-48 bg-indigo-600/20 rounded-[3rem] blur-[40px] group-hover:blur-[20px] transition-all duration-1000"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-40 relative">
            <div class="max-w-4xl mx-auto px-6 text-center space-y-16 relative z-10">
                <h2 class="text-6xl md:text-[6rem] font-black tracking-tighter leading-none uppercase">Ready to Evolve?</h2>
                <div class="flex flex-col sm:flex-row justify-center gap-8">
                    <a href="{{ route('register') }}" class="px-16 py-8 bg-white text-black font-black rounded-[3rem] hover:scale-105 transition-all uppercase tracking-[0.4em] text-xs shadow-[0_30px_60px_rgba(255,255,255,0.2)]">Initialize Terminal</a>
                    <a href="{{ route('login') }}" class="px-16 py-8 glass-card font-black rounded-[3rem] hover:scale-105 transition-all uppercase tracking-[0.4em] text-xs">Node Access</a>
                </div>
            </div>
            
            <!-- Final Decoration -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-6xl aspect-square bg-indigo-600/5 rounded-full blur-[180px] -z-10 animate-pulse-slow"></div>
        </section>

        <footer class="border-t border-white/5 py-20 relative z-10">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="flex items-center gap-4 opacity-40">
                    <i data-lucide="zap" class="w-5 h-5"></i>
                    <p class="text-[10px] font-black uppercase tracking-[0.5em]">&copy; 2026 KUSKUS INTELLIGENCE GROUP</p>
                </div>
                <div class="flex gap-12 opacity-30 text-[10px] font-black uppercase tracking-[0.4em]">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Infrastructure</a>
                    <a href="#" class="hover:text-white transition-colors">Terminal Ops</a>
                </div>
            </div>
        </footer>

        <script>
            lucide.createIcons();
            
            // Subtle Parallax Effect for Hero
            window.addEventListener('mousemove', (e) => {
                const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
                const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
                document.querySelectorAll('.animate-float').forEach(el => {
                    el.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            });
        </script>
    </body>
</html>
