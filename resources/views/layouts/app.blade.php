<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KUSKUS POS') }} • Cyber Emerald</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        slate: {
                            50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155', 800: '#1e293b', 900: '#0f172a', 950: '#020617',
                        },
                        emerald: {
                            50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b', 950: '#022c22',
                        }
                    }
                }
            }
        }
    </script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --emerald-500: #10b981;
            --emerald-600: #059669;
            --slate-950: #020617;
            --slate-900: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--slate-950);
            color: #ffffff;
            overflow-x: hidden;
        }

        .font-display { font-family: 'Outfit', sans-serif; }

        .emerald-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .emerald-text {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .emerald-glow {
            box-shadow: 0 0 30px rgba(16, 185, 129, 0.15);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--slate-950); }
        ::-webkit-scrollbar-thumb {
            background: rgba(16, 185, 129, 0.2);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover { background: var(--emerald-500); }
    </style>
</head>
<body class="antialiased selection:bg-emerald-500/30 selection:text-emerald-500" x-data="{ sidebarOpen: true }">
    <div class="min-h-screen flex">
        <!-- Sidebar Navigation -->
        @include('layouts.navigation')

        <!-- Main Content Area -->
        <main class="flex-1 transition-all duration-300 min-h-screen relative" 
              :class="sidebarOpen ? 'ml-72' : 'ml-24'">
            
            <!-- Top Dashboard Header -->
            <header class="h-20 flex items-center justify-between px-6 sticky top-0 z-30 bg-slate-950/80 backdrop-blur-xl border-b border-white/5">
                <div class="flex items-center gap-8">
                    <button @click="sidebarOpen = !sidebarOpen" 
                            class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center hover:bg-white/10 transition-all text-white/40 hover:text-emerald-500 group">
                        <i data-lucide="menu" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                    </button>
                    <div>
                        @if (isset($header))
                            {{ $header }}
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center hover:bg-white/10 transition-all relative">
                        <i data-lucide="bell" class="w-4 h-4 text-white/40"></i>
                        <span class="absolute top-2.5 right-2.5 w-1.5 h-1.5 bg-emerald-500 rounded-full emerald-glow"></span>
                    </button>
                    <div class="h-10 w-px bg-white/5"></div>
                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="text-right">
                            <p class="text-[11px] font-bold text-white group-hover:text-emerald-500 transition-colors">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-white/40 uppercase tracking-widest">{{ Auth::user()->role ?? 'Admin' }}</p>
                        </div>
                        <div class="w-10 h-10 emerald-gradient rounded-xl flex items-center justify-center text-slate-950 font-black shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6 lg:p-8">
                {{ $slot }}
            </div>

            <!-- Footer Decorative -->
            <div class="absolute bottom-0 right-0 p-10 opacity-20 pointer-events-none">
                <i data-lucide="leaf" class="w-32 h-32 text-emerald-500 rotate-12"></i>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
