<x-app-layout>
    <div x-data="inventorySystem()" class="animate-in fade-in duration-1000">
        <x-slot name="header">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div>
                    <h2 class="font-display font-black text-6xl tracking-tighter uppercase leading-none">Asset <span class="emerald-text">Intel</span></h2>
                    <p class="text-[10px] font-black text-emerald-500/40 uppercase tracking-[0.5em] mt-4">Inventory Intelligence System • Operational</p>
                </div>
                <div class="flex gap-4">
                    <button @click="showManageCategories = true" class="px-10 py-5 bg-slate-900 border border-emerald-500/10 text-white/40 text-[10px] font-black rounded-3xl hover:text-emerald-500 hover:border-emerald-500/30 transition-all uppercase tracking-[0.2em] flex items-center gap-4 group">
                        <i data-lucide="layers" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                        Sectors
                    </button>
                    <button @click="showAddProduct = true" class="px-10 py-5 emerald-gradient text-slate-950 text-[10px] font-black rounded-3xl hover:scale-105 transition-all uppercase tracking-[0.3em] flex items-center gap-4 shadow-[0_20px_40px_rgba(16,185,129,0.2)]">
                        <i data-lucide="plus" class="w-6 h-6 stroke-[3px]"></i>
                        New Entity
                    </button>
                </div>
            </div>
        </x-slot>

        <div class="mt-16 space-y-16">
            <!-- Search & Filtering -->
            <div class="flex flex-col lg:flex-row gap-10 items-stretch lg:items-center justify-between">
                <div class="relative flex-1 max-w-3xl group">
                    <div class="absolute inset-0 bg-emerald-500/5 rounded-[2.5rem] blur-xl group-focus-within:bg-emerald-500/10 transition-all"></div>
                    <i data-lucide="search" class="absolute left-8 top-1/2 -translate-y-1/2 w-6 h-6 text-white/20 group-focus-within:text-emerald-500 transition-colors"></i>
                    <input type="text" x-model="search" placeholder="Scan infrastructure for entity signature..." class="relative w-full bg-slate-900/50 border border-emerald-500/10 rounded-[2.5rem] py-6 pl-18 pr-10 text-sm focus:border-emerald-500/50 focus:bg-slate-950 focus:ring-8 focus:ring-emerald-500/5 transition-all text-white placeholder:text-white/10 tracking-wide font-medium">
                </div>
                
                <div class="flex gap-3 overflow-x-auto pb-4 lg:pb-0 no-scrollbar">
                    <button @click="selectedCategory = 'all'" :class="selectedCategory === 'all' ? 'emerald-gradient text-slate-950' : 'bg-slate-900 text-white/40 border-white/5'" class="px-10 py-5 text-[10px] font-black rounded-2xl border uppercase tracking-[0.3em] whitespace-nowrap transition-all">All Sectors</button>
                    <template x-for="cat in categories" :key="cat.id">
                        <button @click="selectedCategory = cat.id" :class="selectedCategory === cat.id ? 'emerald-gradient text-slate-950' : 'bg-slate-900 text-white/40 border-white/5'" class="px-10 py-5 text-[10px] font-black rounded-2xl border uppercase tracking-[0.3em] whitespace-nowrap hover:text-white transition-all" x-text="cat.name"></button>
                    </template>
                </div>
            </div>

            <!-- Asset Table -->
            <div class="glass-card rounded-[4rem] overflow-hidden border-emerald-500/5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900 border-b border-white/5 text-[10px] font-black uppercase tracking-[0.5em] text-white/20">
                                <th class="px-12 py-10">Entity Identity</th>
                                <th class="px-12 py-10">Sector</th>
                                <th class="px-12 py-10">Liquidity Value</th>
                                <th class="px-12 py-10">Unit Strength</th>
                                <th class="px-12 py-10 text-right">Protocol</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.03]">
                            <template x-for="product in filteredProducts" :key="product.id">
                                <tr class="group hover:bg-emerald-500/[0.02] transition-all duration-700">
                                    <td class="px-12 py-10">
                                        <div class="flex items-center gap-8">
                                            <div class="w-24 h-24 rounded-[2.5rem] bg-slate-950 border border-emerald-500/5 flex items-center justify-center overflow-hidden group-hover:border-emerald-500/30 group-hover:scale-105 transition-all duration-700 shadow-2xl">
                                                <template x-if="product.image">
                                                    <img :src="'/storage/' + product.image" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!product.image">
                                                    <i data-lucide="shield" class="w-10 h-10 text-white/10 group-hover:text-emerald-500/40 transition-colors"></i>
                                                </template>
                                            </div>
                                            <div>
                                                <p class="font-display font-black text-xl text-white tracking-tight uppercase mb-2 group-hover:text-emerald-400 transition-colors" x-text="product.name"></p>
                                                <p class="text-[10px] text-white/20 font-black uppercase tracking-[0.5em]">Signature: <span class="text-emerald-500/50" x-text="'0x' + product.id.toString().padStart(4, '0')"></span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        <span class="px-6 py-2.5 bg-emerald-500/5 border border-emerald-500/10 rounded-full text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/60" x-text="product.category.name"></span>
                                    </td>
                                    <td class="px-12 py-10">
                                        <div class="flex flex-col">
                                            <span class="font-display font-black text-2xl text-white tracking-tight" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></span>
                                            <span class="text-[10px] text-white/20 font-black uppercase tracking-[0.4em] mt-1">Market Valuation</span>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10">
                                        <div class="flex items-center gap-6">
                                            <div class="h-2 w-24 bg-slate-950 rounded-full overflow-hidden p-[2px] border border-white/5">
                                                <div class="h-full rounded-full transition-all duration-1000" 
                                                     :class="product.stock < 10 ? 'bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]' : 'emerald-gradient shadow-[0_0_10px_rgba(16,185,129,0.3)]'"
                                                     :style="'width: ' + Math.min(100, (product.stock/50)*100) + '%'"></div>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-display font-black text-2xl" :class="product.stock < 10 ? 'text-red-500' : 'text-white'" x-text="product.stock"></span>
                                                <span class="text-[10px] text-white/20 uppercase font-black tracking-[0.4em]">Units</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-12 py-10 text-right">
                                        <div class="flex justify-end gap-4 opacity-0 group-hover:opacity-100 transition-all duration-700 translate-x-10 group-hover:translate-x-0">
                                            <button @click="selectedProduct = product.id; showRestock = true" class="px-8 py-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-black uppercase tracking-widest hover:bg-emerald-500 text-emerald-500 hover:text-slate-950 transition-all flex items-center gap-3">
                                                <i data-lucide="zap" class="w-4 h-4"></i>
                                                Replenish
                                            </button>
                                            <button class="w-14 h-14 rounded-2xl bg-slate-900 border border-emerald-500/10 flex items-center justify-center hover:bg-white hover:text-slate-950 transition-all">
                                                <i data-lucide="edit-3" class="w-6 h-6"></i>
                                            </button>
                                            <form :action="'/inventory/' + product.id" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Archive this entity?')" class="w-14 h-14 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                                                    <i data-lucide="trash-2" class="w-6 h-6"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <template x-if="filteredProducts.length === 0">
                    <div class="py-40 text-center flex flex-col items-center justify-center opacity-10">
                        <i data-lucide="database" class="w-24 h-24 mb-8"></i>
                        <p class="font-black uppercase tracking-[0.6em] text-sm">No Matching Entities Sequenced</p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Modals - Golden Obsidian Style -->
        <template x-if="true">
            <div>
                <!-- Add Product Modal -->
                <div x-show="showAddProduct" class="fixed inset-0 z-[200] flex items-center justify-center p-8 bg-slate-950/95 backdrop-blur-3xl" x-transition.opacity x-cloak>
                    <div @click.away="showAddProduct = false" class="glass-card p-16 rounded-[4rem] max-w-2xl w-full space-y-12 border-emerald-500/20 shadow-2xl">
                        <div class="text-center">
                            <h3 class="text-5xl font-display font-black tracking-tight uppercase text-white">Initialize <span class="emerald-text">Entity</span></h3>
                            <p class="text-[10px] font-black text-emerald-500/40 uppercase tracking-[0.4em] mt-4">Secure Infrastructure Registration</p>
                        </div>
                        <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 gap-10">
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-4">Sector Classification</label>
                                    <select name="category_id" class="w-full bg-slate-900 border border-emerald-500/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 appearance-none cursor-pointer font-bold">
                                        <template x-for="cat in categories" :key="cat.id">
                                            <option :value="cat.id" x-text="cat.name" class="bg-slate-950 text-white"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-4">Designation Name</label>
                                    <input type="text" name="name" required class="w-full bg-slate-900 border border-emerald-500/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 placeholder:text-white/5 font-bold" placeholder="e.g. Imperial Espresso Base">
                                </div>
                                <div class="grid grid-cols-2 gap-10">
                                    <div class="space-y-4">
                                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-4">Base Valuation</label>
                                        <input type="number" name="price" required class="w-full bg-slate-900 border border-emerald-500/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 font-bold" placeholder="0">
                                    </div>
                                    <div class="space-y-4">
                                        <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-4">Initial Capacity</label>
                                        <input type="number" name="stock" required class="w-full bg-slate-900 border border-emerald-500/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 font-bold" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-10 flex gap-8">
                                <button type="button" @click="showAddProduct = false" class="flex-1 py-7 border border-white/5 text-white/20 font-black rounded-[2rem] uppercase text-[10px] tracking-[0.4em] hover:text-white hover:bg-white/5 transition-all">Abort</button>
                                <button type="submit" class="flex-1 py-7 emerald-gradient text-slate-950 font-black rounded-[2rem] uppercase text-[10px] tracking-[0.4em] hover:scale-105 transition-all shadow-xl">Execute Link</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Manage Categories Modal -->
                <div x-show="showManageCategories" class="fixed inset-0 z-[200] flex items-center justify-center p-8 bg-slate-950/95 backdrop-blur-3xl" x-transition.opacity x-cloak>
                    <div @click.away="showManageCategories = false" class="glass-card p-16 rounded-[4rem] max-w-2xl w-full space-y-12 border-emerald-500/20 shadow-2xl">
                        <div class="text-center">
                            <h3 class="text-5xl font-display font-black tracking-tight uppercase text-white">Sector <span class="emerald-text">Registry</span></h3>
                            <p class="text-[10px] font-black text-emerald-500/40 uppercase tracking-[0.4em] mt-4">Structural Infrastructure Management</p>
                        </div>
                        <form action="{{ route('categories.store') }}" method="POST" class="flex gap-4">
                            @csrf
                            <input type="text" name="name" placeholder="New classification designation..." required class="flex-1 bg-slate-900 border border-emerald-500/10 rounded-[2rem] py-5 px-10 text-sm text-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 font-bold">
                            <button type="submit" class="w-20 h-20 emerald-gradient text-slate-950 rounded-[2rem] flex items-center justify-center hover:scale-110 transition-all shadow-lg"><i data-lucide="plus" class="w-8 h-8 stroke-[3px]"></i></button>
                        </form>
                        <div class="space-y-4 max-h-96 overflow-y-auto pr-6 custom-scrollbar">
                            <template x-for="cat in categories" :key="cat.id">
                                <div class="flex justify-between items-center p-8 bg-slate-900 border border-white/5 rounded-[2.5rem] group hover:border-emerald-500/30 transition-all">
                                    <span class="text-sm font-black text-white uppercase tracking-[0.2em]" x-text="cat.name"></span>
                                    <form :action="'/categories/' + cat.id" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-500 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center hover:bg-red-500 hover:text-white">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </template>
                        </div>
                        <button @click="showManageCategories = false" class="w-full py-7 bg-slate-900 border border-white/5 text-white/20 font-black rounded-[2.5rem] uppercase text-[10px] tracking-[0.4em] hover:text-white transition-all">Close Registry</button>
                    </div>
                </div>

                <!-- Restock Modal -->
                <div x-show="showRestock" class="fixed inset-0 z-[200] flex items-center justify-center p-8 bg-slate-950/95 backdrop-blur-3xl" x-transition.opacity x-cloak>
                    <div @click.away="showRestock = false" class="glass-card p-16 rounded-[4rem] max-w-md w-full space-y-12 border-emerald-500/20 shadow-2xl">
                        <div class="text-center">
                            <h3 class="text-5xl font-display font-black tracking-tight uppercase text-white emerald-text">Replenish</h3>
                            <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] mt-4">Invasive Asset Injection</p>
                        </div>
                        <form action="{{ route('inventory.restock') }}" method="POST" class="space-y-10">
                            @csrf
                            <input type="hidden" name="product_id" :value="selectedProduct">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-6">Quantity to Inject</label>
                                <input type="number" name="qty" required class="w-full bg-slate-900 border border-emerald-500/10 rounded-[2.5rem] py-8 px-10 text-5xl font-display font-black text-emerald-500 focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 text-center shadow-inner" placeholder="0">
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-white/30 uppercase tracking-[0.4em] ml-6">Supply Origin</label>
                                <input type="text" name="supplier" class="w-full bg-slate-900 border border-emerald-500/10 rounded-[2rem] py-6 px-10 text-sm text-white focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 font-bold" placeholder="External Provider / Node">
                            </div>
                            <button type="submit" class="w-full py-8 emerald-gradient text-slate-950 font-black rounded-[2.5rem] uppercase text-[10px] tracking-[0.5em] hover:scale-105 transition-all shadow-2xl">Confirm Injection</button>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function inventorySystem() {
            return {
                products: @json($products),
                categories: @json($categories),
                search: '',
                selectedCategory: 'all',
                showAddProduct: false,
                showManageCategories: false,
                showRestock: false,
                selectedProduct: null,

                get filteredProducts() {
                    return this.products.filter(p => {
                        const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
                        const matchCategory = this.selectedCategory === 'all' || p.category_id === this.selectedCategory;
                        return matchSearch && matchCategory;
                    });
                }
            }
        }
    </script>
    <style>[x-cloak] { display: none !important; }</style>
</x-app-layout>

