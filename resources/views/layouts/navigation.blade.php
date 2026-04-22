<aside class="fixed left-0 top-0 bottom-0 z-50 transition-all duration-300 overflow-hidden bg-slate-950/80 backdrop-blur-2xl border-r border-emerald-500/5"
       :class="sidebarOpen ? 'w-72' : 'w-24'">
    
    <!-- Sidebar Header -->
    <div class="h-24 flex items-center px-6 mb-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 emerald-gradient rounded-2xl flex-shrink-0 flex items-center justify-center shadow-[0_0_20px_rgba(16,185,129,0.3)] rotate-3 transition-transform duration-500"
                 :class="sidebarOpen ? 'rotate-3' : 'rotate-0'">
                <i data-lucide="leaf" class="text-slate-950 w-6 h-6 stroke-[2.5px]"></i>
            </div>
            <div class="flex flex-col overflow-hidden transition-all duration-300" 
                 :class="sidebarOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0'">
                <span class="font-display font-black text-xl tracking-tight leading-none text-white">KUSKUS</span>
                <span class="text-[9px] font-bold text-emerald-500/60 uppercase tracking-[0.4em] mt-1 whitespace-nowrap">Intelligence Suite</span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all group {{ request()->routeIs('dashboard') ? 'bg-emerald-500/10 text-emerald-500' : 'text-white/40 hover:bg-white/5 hover:text-white' }}">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl flex-shrink-0 transition-colors {{ request()->routeIs('dashboard') ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800' }}">
                <i data-lucide="layout-grid" class="w-5 h-5"></i>
            </div>
            <span class="font-bold text-sm tracking-tight transition-all duration-300"
                  :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">Dashboard</span>
        </a>

        <!-- POS -->
        <a href="{{ route('pos.index') }}" 
           class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all group {{ request()->routeIs('pos.*') ? 'bg-emerald-500/10 text-emerald-500' : 'text-white/40 hover:bg-white/5 hover:text-white' }}">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl flex-shrink-0 transition-colors {{ request()->routeIs('pos.*') ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800' }}">
                <i data-lucide="zap" class="w-5 h-5"></i>
            </div>
            <span class="font-bold text-sm tracking-tight transition-all duration-300"
                  :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">Cashier</span>
        </a>

        <!-- Inventory -->
        <a href="{{ route('inventory.index') }}" 
           class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all group {{ request()->routeIs('inventory.*') ? 'bg-emerald-500/10 text-emerald-500' : 'text-white/40 hover:bg-white/5 hover:text-white' }}">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl flex-shrink-0 transition-colors {{ request()->routeIs('inventory.*') ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800' }}">
                <i data-lucide="package" class="w-5 h-5"></i>
            </div>
            <span class="font-bold text-sm tracking-tight transition-all duration-300"
                  :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">Inventory</span>
        </a>

        <!-- Reports -->
        <a href="{{ route('transactions.index') }}" 
           class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all group {{ request()->routeIs('transactions.*') ? 'bg-emerald-500/10 text-emerald-500' : 'text-white/40 hover:bg-white/5 hover:text-white' }}">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl flex-shrink-0 transition-colors {{ request()->routeIs('transactions.*') ? 'bg-emerald-500 text-slate-950' : 'bg-slate-800' }}">
                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
            </div>
            <span class="font-bold text-sm tracking-tight transition-all duration-300"
                  :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">Reports</span>
        </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="absolute bottom-8 left-4 right-4 space-y-4">
        <div class="p-4 rounded-2xl bg-white/5 border border-white/5 flex items-center gap-4 overflow-hidden transition-all duration-300"
             :class="sidebarOpen ? 'opacity-100' : 'opacity-0 scale-95'">
            <div class="w-10 h-10 emerald-gradient rounded-xl flex items-center justify-center font-black text-slate-950 text-xs">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-xs font-bold truncate">{{ Auth::user()->name }}</span>
                <span class="text-[10px] text-white/40 uppercase tracking-widest">{{ Auth::user()->role ?? 'Admin' }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-4 py-4 rounded-2xl text-red-400 hover:bg-red-500/10 transition-all group">
                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-500/10 flex-shrink-0 group-hover:bg-red-500 group-hover:text-white transition-all">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </div>
                <span class="font-bold text-sm tracking-tight transition-all duration-300"
                      :class="sidebarOpen ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">Sign Out</span>
            </button>
        </form>
    </div>
</aside>
