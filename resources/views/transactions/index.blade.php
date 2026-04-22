<x-app-layout>
    <div class="animate-in fade-in duration-1000">
        <x-slot name="header">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h2 class="font-black text-6xl tracking-tighter uppercase leading-none">History</h2>
                    <p class="text-[10px] font-bold text-white/20 uppercase tracking-[0.4em] mt-4">Transaction Ledger Analytics</p>
                </div>
                <a href="{{ route('transactions.export') }}" class="px-8 py-4 bg-white text-black text-[10px] font-black rounded-2xl hover:scale-105 transition-all uppercase tracking-widest flex items-center gap-3 shadow-[0_20px_40px_rgba(255,255,255,0.1)]">
                    <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                    Export Data
                </a>
            </div>
        </x-slot>

        <div class="mt-12">
            <div class="bg-white/5 border border-white/10 rounded-[3rem] overflow-hidden shadow-[0_40px_100px_rgba(0,0,0,0.5)]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/5 text-[10px] font-black uppercase tracking-[0.3em] text-white/20">
                                <th class="px-12 py-8">Ledger ID</th>
                                <th class="px-12 py-8">Timestamp</th>
                                <th class="px-12 py-8">Operator</th>
                                <th class="px-12 py-8">Aggregate Value</th>
                                <th class="px-12 py-8 text-right">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($transactions as $tr)
                            <tr class="group hover:bg-white/[0.03] transition-all duration-500">
                                <td class="px-12 py-8 font-black text-white tracking-tighter uppercase text-lg">{{ $tr->invoice_number }}</td>
                                <td class="px-12 py-8">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white/60 tracking-tight">{{ $tr->created_at->format('M d, Y') }}</span>
                                        <span class="text-[9px] text-white/20 font-bold uppercase tracking-widest">{{ $tr->created_at->format('H:i:s A') }}</span>
                                    </div>
                                </td>
                                <td class="px-12 py-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-[10px] font-black text-white/40 border border-white/5">
                                            {{ strtoupper(substr($tr->user->name, 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-bold text-white">{{ $tr->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-12 py-8 font-black text-xl text-white tracking-tight">Rp {{ number_format($tr->total_price, 0, ',', '.') }}</td>
                                <td class="px-12 py-8 text-right">
                                    <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-4 group-hover:translate-x-0">
                                        <a href="{{ route('transactions.receipt', $tr->id) }}" target="_blank" class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white hover:text-black transition-all group/btn">
                                            <i data-lucide="printer" class="w-5 h-5 group-hover/btn:scale-110 transition-transform"></i>
                                        </a>
                                        <button class="px-6 py-3 rounded-2xl bg-white/5 border border-white/10 text-[9px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition-all">Details</button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-32 text-center flex flex-col items-center justify-center opacity-20">
                                    <i data-lucide="history" class="w-16 h-16 mb-6"></i>
                                    <p class="font-black uppercase tracking-[0.4em] text-xs">No records archived</p>
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
