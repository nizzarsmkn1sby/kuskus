<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RIVE POS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
        <script src="https://unpkg.com/lucide@latest"></script>
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#050505] text-white selection:bg-white selection:text-black overflow-hidden">
        <!-- Decorative Background Glows -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-white/5 rounded-full blur-[150px]"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%] bg-white/5 rounded-full blur-[150px]"></div>
        </div>

        <div class="min-h-screen relative z-10 flex flex-col items-center justify-center p-6">
            <div class="w-full max-w-lg">
                <div class="flex flex-col items-center mb-16 animate-in fade-in slide-in-from-top-4 duration-1000">
                    <a href="/" class="flex flex-col items-center gap-6 group">
                        <div class="w-20 h-20 bg-white rounded-[2rem] flex items-center justify-center shadow-[0_0_50px_rgba(255,255,255,0.2)] group-hover:scale-110 transition-transform duration-700">
                            <i data-lucide="zap" class="text-black w-10 h-10 stroke-[3px]"></i>
                        </div>
                        <div class="text-center">
                            <span class="font-black text-4xl tracking-[0.2em] uppercase leading-none block">RIVE</span>
                            <span class="text-[10px] text-white/40 font-bold uppercase tracking-[0.5em] mt-2 block">System Intelligence</span>
                        </div>
                    </a>
                </div>

                <div class="bg-white/5 border border-white/10 backdrop-blur-3xl p-12 md:p-16 rounded-[4rem] shadow-[0_40px_100px_rgba(0,0,0,0.5)] animate-in zoom-in-95 duration-700">
                    {{ $slot }}
                </div>

                <div class="mt-12 text-center animate-in fade-in duration-1000 delay-500">
                    <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.5em]">Developed by Rive Intelligence Group</p>
                </div>
            </div>
        </div>
        <script>lucide.createIcons();</script>
    </body>
</html>
