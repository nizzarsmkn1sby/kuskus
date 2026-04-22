<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-[9px] font-bold text-emerald-500 uppercase tracking-[0.2em]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Command Center • Active
                </div>
                <h2 class="font-display font-black text-3xl md:text-5xl text-white tracking-tight leading-none">
                    Welcome, <span class="emerald-text">{{ explode(' ', Auth::user()->name)[0] }}</span>.
                </h2>
                <p class="text-white/40 text-[11px] font-medium uppercase tracking-widest">Protocol v4.0.2 • Secured</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="px-6 py-3 glass-card rounded-2xl border-emerald-500/10">
                    <p class="text-[8px] text-emerald-500/50 uppercase tracking-[0.3em] font-black mb-0.5">Liquidity</p>
                    <p class="text-xl font-display font-black text-white">Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="{{ route('pos.index') }}" class="group relative flex items-center justify-center w-14 h-14 emerald-gradient text-slate-950 rounded-2xl shadow-lg transition-all hover:scale-110 active:scale-95">
                    <i data-lucide="zap" class="w-6 h-6 group-hover:fill-current transition-all"></i>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-8">
        <!-- Main Stats Card (Bento Large) -->
        <div class="md:col-span-4 lg:col-span-4 glass-card rounded-[2.5rem] p-8 overflow-hidden relative group min-h-[350px] flex flex-col justify-between">
            <div class="absolute top-0 right-0 w-[50%] h-full emerald-gradient opacity-[0.03] group-hover:opacity-[0.08] blur-[120px] transition-all duration-1000"></div>
            
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-10">
                    <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center border border-emerald-500/10 shadow-xl">
                        <i data-lucide="trending-up" class="w-7 h-7 text-emerald-500"></i>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 text-emerald-400 text-[9px] font-black tracking-widest uppercase border border-emerald-500/20">
                        <i data-lucide="arrow-up-right" class="w-3 h-3"></i>
                        Eff +18.4%
                    </div>
                </div>
                
                <p class="text-white/30 font-bold uppercase tracking-[0.4em] text-[9px] mb-2">Portfolio Value</p>
                <h3 class="text-5xl font-display font-black tracking-tight mb-6">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</h3>
                
                <div class="h-2 w-full bg-slate-950 rounded-full overflow-hidden p-[2px] border border-white/5">
                    <div class="h-full emerald-gradient rounded-full w-[75%] shadow-[0_0_20px_rgba(16,185,129,0.4)]"></div>
                </div>
            </div>

            <div class="relative z-10 pt-6 grid grid-cols-3 gap-6">
                <div>
                    <p class="text-white/20 text-[9px] font-bold uppercase tracking-[0.2em] mb-1">Processed</p>
                    <p class="text-2xl font-display font-black">{{ $totalTransactions ?? 0 }} <span class="text-[10px] text-emerald-500/50">Tx</span></p>
                </div>
                <div>
                    <p class="text-white/20 text-[9px] font-bold uppercase tracking-[0.2em] mb-1">Volume</p>
                    <p class="text-2xl font-display font-black">{{ $totalItemsSold ?? 0 }} <span class="text-[10px] text-emerald-500/50">Qty</span></p>
                </div>
                <div>
                    <p class="text-white/20 text-[9px] font-bold uppercase tracking-[0.2em] mb-1">Integrity</p>
                    <p class="text-2xl font-display font-black text-emerald-400">99.9<span class="text-[10px]">%</span></p>
                </div>
            </div>
        </div>

        <!-- Inventory Control (Bento Medium) -->
        <div class="md:col-span-2 lg:col-span-2 glass-card rounded-[2.5rem] p-8 flex flex-col justify-between border-t border-t-emerald-500/20">
            <div>
                <div class="flex items-center justify-between mb-8">
                    <h4 class="text-xl font-display font-black uppercase tracking-tight">Stock Intel</h4>
                    <div class="w-10 h-10 emerald-gradient rounded-xl flex items-center justify-center shadow-lg rotate-6">
                        <i data-lucide="package" class="w-5 h-5 text-slate-950"></i>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="p-4 rounded-2xl bg-slate-900 border border-white/5 flex items-center justify-between group hover:border-red-500/30 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]"></div>
                            <span class="text-xs font-bold text-white/60">Depleted</span>
                        </div>
                        <span class="text-xl font-display font-black text-red-500">{{ $outOfStockCount ?? 0 }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-900 border border-white/5 flex items-center justify-between group hover:border-emerald-500/30 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                            <span class="text-xs font-bold text-white/60">Warning</span>
                        </div>
                        <span class="text-xl font-display font-black text-emerald-500">{{ $lowStockCount ?? 0 }}</span>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('inventory.index') }}" class="w-full py-5 rounded-2xl bg-white/5 hover:bg-emerald-500 hover:text-slate-950 text-[10px] font-black uppercase tracking-[0.4em] text-center transition-all border border-white/5">
                Optimize Inventory
            </a>
        </div>

        <!-- Recent Logs Table -->
        <div class="md:col-span-4 lg:col-span-6 mt-8">
            <div class="flex items-center justify-between mb-6 px-6">
                <div class="flex items-center gap-3">
                    <i data-lucide="clock" class="w-5 h-5 text-emerald-500"></i>
                    <h3 class="text-xl font-display font-black tracking-tight uppercase">Recent Protocol Logs</h3>
                </div>
                <a href="{{ route('transactions.index') }}" class="text-[9px] font-black uppercase tracking-[0.3em] text-emerald-500/50 hover:text-emerald-500 transition-colors">
                    Access Archives →
                </a>
            </div>
            
            <div class="glass-card rounded-[2rem] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900 border-b border-white/5">
                                <th class="px-6 py-5 text-[9px] uppercase tracking-[0.3em] font-black text-white/20">Identity</th>
                                <th class="px-6 py-5 text-[9px] uppercase tracking-[0.3em] font-black text-white/20">Chronos</th>
                                <th class="px-6 py-5 text-[9px] uppercase tracking-[0.3em] font-black text-white/20">Value</th>
                                <th class="px-6 py-5 text-[9px] uppercase tracking-[0.3em] font-black text-white/20 text-right">Verification</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.03]">
                            @forelse($recentTransactions ?? [] as $transaction)
                            <tr class="hover:bg-emerald-500/[0.02] transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-800 border border-white/5 flex items-center justify-center font-mono text-[9px] text-emerald-500 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all">
                                            #{{ substr($transaction->invoice_number, -4) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-xs tracking-tight">{{ $transaction->customer_name ?? 'Anonymous Node' }}</div>
                                            <div class="text-[9px] text-white/20 uppercase tracking-widest">Protocol Sync</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-xs font-medium text-white/40">{{ $transaction->created_at->format('H:i:s') }}</div>
                                    <div class="text-[8px] font-bold text-white/20 uppercase">{{ $transaction->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-base font-display font-black text-white">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 text-[8px] font-black border border-emerald-500/20 uppercase tracking-widest">
                                        Verified
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-10 py-32 text-center">
                                    <div class="flex flex-col items-center opacity-10">
                                        <i data-lucide="database" class="w-20 h-20 mb-6"></i>
                                        <p class="text-xl font-display font-black uppercase tracking-widest">Zero Protocol Logs Found</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
