<x-app-layout>
    <div x-data="posSystem()" class="flex flex-col lg:flex-row gap-10 -mt-6">
        <!-- Products Section -->
        <div class="flex-1 space-y-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div>
                    <h2 class="font-display font-black text-3xl text-white tracking-tight uppercase leading-none">Catalog <span class="emerald-text">Protocol</span></h2>
                    <p class="text-[9px] text-emerald-500/40 uppercase tracking-[0.3em] mt-2 font-bold">Initiating asset selection sequence</p>
                </div>
                
                <div class="relative w-full md:w-[350px] group">
                    <div class="absolute inset-0 bg-emerald-600/5 rounded-2xl blur-xl group-focus-within:bg-emerald-600/15 transition-all"></div>
                    <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-white/20 group-focus-within:text-emerald-500 transition-colors"></i>
                    <input type="text" x-model="search" placeholder="Search infrastructure..." 
                           class="relative w-full bg-slate-900/50 border border-emerald-500/10 rounded-2xl py-4 pl-14 pr-6 text-xs focus:border-emerald-500/50 focus:bg-slate-950/80 focus:ring-4 focus:ring-emerald-500/5 transition-all text-white placeholder:text-white/20 outline-none font-medium">
                </div>
            </div>

            <!-- Categories -->
            <div class="flex gap-3 overflow-x-auto pb-3 no-scrollbar">
                <button @click="selectedCategory = 'all'" 
                        :class="selectedCategory === 'all' ? 'emerald-gradient text-slate-950 shadow-lg' : 'bg-slate-900 text-white/40 border-white/5 hover:border-emerald-500/20'"
                        class="px-8 py-3 text-[9px] font-black rounded-xl border transition-all whitespace-nowrap uppercase tracking-widest">
                    All Sectors
                </button>
                <template x-for="cat in categories" :key="cat.id">
                    <button @click="selectedCategory = cat.id" 
                            :class="selectedCategory === cat.id ? 'emerald-gradient text-slate-950 shadow-lg' : 'bg-slate-900 text-white/40 border-white/5 hover:bg-white/5 hover:border-emerald-500/20'"
                            class="px-8 py-3 text-[9px] font-black rounded-xl border transition-all whitespace-nowrap uppercase tracking-widest"
                            x-text="cat.name"></button>
                </template>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
                <template x-for="product in filteredProducts" :key="product.id">
                    <button @click="addToCart(product)" class="glass-card group p-4 rounded-[2rem] text-left relative overflow-hidden border-emerald-500/5">
                        <div class="aspect-square rounded-2xl bg-slate-950/50 overflow-hidden mb-4 relative group-hover:scale-[1.03] transition-transform duration-700">
                            <template x-if="product.image">
                                <img :src="'/storage/' + product.image" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!product.image">
                                <div class="w-full h-full flex items-center justify-center opacity-10 group-hover:opacity-30 transition-opacity">
                                    <i data-lucide="shield" class="w-12 h-12"></i>
                                </div>
                            </template>
                            
                            <div class="absolute inset-0 emerald-gradient opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-5 group-hover:translate-y-0">
                                <div class="w-12 h-12 bg-white text-slate-950 rounded-full flex items-center justify-center shadow-xl">
                                    <i data-lucide="plus" class="w-6 h-6 stroke-[3px]"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-2">
                            <h4 class="font-display font-black text-white truncate text-base group-hover:text-emerald-400 transition-colors" x-text="product.name"></h4>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-[8px] text-white/20 uppercase tracking-[0.2em] font-black" x-text="product.category.name"></p>
                                <p class="font-display font-black text-sm text-emerald-500" x-text="formatPrice(product.price)"></p>
                            </div>
                        </div>
                        
                        <div class="absolute top-6 right-6">
                            <span :class="product.stock < 10 ? 'bg-red-500/20 text-red-400 border-red-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/10'" 
                                  class="px-3 py-1 rounded-full text-[8px] font-black border backdrop-blur-xl uppercase tracking-tighter"
                                  x-text="product.stock + ' Qty'"></span>
                        </div>
                    </button>
                </template>
            </div>
        </div>

        <div class="w-full lg:w-[420px] space-y-6">
            <div class="glass-card rounded-[2.5rem] p-8 flex flex-col h-[calc(100vh-140px)] sticky top-24 border-emerald-500/10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-display font-black text-2xl uppercase tracking-tight leading-none">Order <span class="emerald-text">Queue</span></h3>
                        <p class="text-[8px] text-emerald-500/40 uppercase tracking-[0.3em] font-black mt-2">Active Protocol session</p>
                    </div>
                    <button @click="clearCart()" x-show="cart.length > 0" class="w-12 h-12 rounded-xl bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center group">
                        <i data-lucide="trash-2" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto space-y-4 pr-3 custom-scrollbar">
                    <template x-for="item in cart" :key="item.id">
                        <div class="flex items-center gap-4 bg-slate-950/50 p-4 rounded-2xl border border-white/5 group transition-all hover:border-emerald-500/20">
                            <div class="w-12 h-12 emerald-gradient text-slate-950 rounded-xl flex items-center justify-center font-black text-lg shadow-lg" x-text="item.qty"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-black text-white truncate uppercase tracking-tight text-xs" x-text="item.name"></p>
                                <p class="text-[10px] text-white/30 font-bold" x-text="formatPrice(item.price)"></p>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <p class="font-display font-black text-emerald-500 text-sm" x-text="formatPrice(item.price * item.qty)"></p>
                                <div class="flex gap-1.5 p-1 bg-slate-950 rounded-lg border border-white/5">
                                    <button @click="updateQty(item.id, -1)" class="w-7 h-7 rounded-md flex items-center justify-center hover:bg-red-500/20 text-white/40 hover:text-red-400 transition-all">
                                        <i data-lucide="minus" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <button @click="updateQty(item.id, 1)" class="w-7 h-7 rounded-md flex items-center justify-center hover:bg-emerald-500/20 text-white/40 hover:text-emerald-500 transition-all">
                                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                    
                    <template x-if="cart.length === 0">
                        <div class="h-full flex flex-col items-center justify-center opacity-10 py-20">
                            <i data-lucide="layers-3" class="w-24 h-24 mb-6"></i>
                            <p class="font-black text-[10px] uppercase tracking-[0.5em]">System Idle • No Orders</p>
                        </div>
                    </template>
                </div>

                <div class="mt-6 pt-6 border-t border-emerald-500/10 space-y-6">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-white/20 font-black uppercase tracking-[0.3em] text-[8px]">Base Liquidity</span>
                            <span class="font-bold text-white/60" x-text="formatPrice(subtotal)"></span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-white/20 font-black uppercase tracking-[0.3em] text-[8px]">Protocol Fee (10%)</span>
                            <span class="font-bold text-white/60" x-text="formatPrice(tax)"></span>
                        </div>
                        <div class="flex justify-between items-end pt-2">
                            <span class="font-display font-black text-xl emerald-text uppercase tracking-tight">TOTAL</span>
                            <span class="font-display font-black text-3xl text-white tracking-tighter" x-text="formatPrice(total)"></span>
                        </div>
                    </div>
                    <div class="space-y-4 pt-4">
                        <div class="relative group">
                            <div class="absolute inset-0 bg-emerald-500/5 rounded-2xl blur-md group-focus-within:bg-emerald-500/10 transition-all"></div>
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-emerald-500/40 font-display font-black text-base italic">Rp</span>
                            <input type="number" x-model="payAmount" placeholder="Input" 
                                   class="relative w-full bg-slate-950 border border-white/5 rounded-2xl py-4 pl-14 pr-6 text-2xl font-display font-black text-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 outline-none transition-all placeholder:text-white/5">
                        </div>
                        <div x-show="changeAmount >= 0 && payAmount > 0" 
                             class="p-4 bg-emerald-500/5 border border-emerald-500/20 rounded-2xl flex justify-between items-center animate-in slide-in-from-top-4 duration-500">
                            <span class="text-[9px] font-black text-emerald-400/50 uppercase tracking-[0.3em]">Exchange</span>
                            <span class="text-2xl font-display font-black text-emerald-400" x-text="formatPrice(changeAmount)"></span>
                        </div>
                        <button @click="checkout()" 
                                :disabled="cart.length === 0 || payAmount < total"
                                :class="cart.length === 0 || payAmount < total ? 'opacity-20 grayscale' : 'hover:scale-[1.02] active:scale-95 shadow-xl'"
                                class="w-full py-6 emerald-gradient text-slate-950 font-black rounded-2xl text-[10px] uppercase tracking-[0.4em] transition-all relative overflow-hidden group">
                            Execute Protocol
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Protocol Success Portal -->
        <div x-show="showSuccess" class="fixed inset-0 z-[100] flex items-center justify-center p-8 bg-slate-950/95 backdrop-blur-3xl animate-in fade-in duration-700" x-cloak>
            <div class="glass p-16 rounded-[4rem] max-w-lg w-full text-center space-y-12 animate-in zoom-in-95 duration-700 border-emerald-500/20">
                <div class="w-32 h-32 emerald-gradient rounded-[3rem] flex items-center justify-center mx-auto shadow-[0_0_60px_rgba(16,185,129,0.4)] rotate-12">
                    <i data-lucide="shield-check" class="w-16 h-16 text-slate-950 stroke-[3px]"></i>
                </div>
                <div>
                    <h3 class="text-5xl font-display font-black tracking-tight uppercase">Protocol <span class="emerald-text">Success</span></h3>
                    <p class="text-white/30 text-sm mt-4 font-bold uppercase tracking-widest">Transaction synchronized with core nodes.</p>
                </div>
                <div class="grid grid-cols-1 gap-4 pt-4">
                    <button @click="printReceipt()" class="w-full py-6 bg-white text-slate-950 font-black rounded-3xl flex items-center justify-center gap-4 hover:scale-105 transition-all text-xs uppercase tracking-widest shadow-xl">
                        <i data-lucide="printer" class="w-6 h-6 stroke-[3px]"></i>
                        Generate Receipt
                    </button>
                    <button @click="resetPOS()" class="w-full py-6 bg-slate-900 border border-emerald-500/20 text-emerald-500 font-black rounded-3xl hover:bg-emerald-500 hover:text-slate-950 transition-all text-xs uppercase tracking-widest">
                        New Sequence
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function posSystem() {
            return {
                products: @json($products),
                categories: @json($categories),
                search: '',
                selectedCategory: 'all',
                cart: [],
                payAmount: 0,
                showSuccess: false,
                lastTransactionId: null,
                
                get filteredProducts() {
                    return this.products.filter(p => {
                        const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase());
                        const matchCategory = this.selectedCategory === 'all' || p.category_id === this.selectedCategory;
                        return matchSearch && matchCategory;
                    });
                },
                
                get subtotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },
                
                get tax() {
                    return this.subtotal * 0.1;
                },
                
                get total() {
                    return this.subtotal + this.tax;
                },
                
                get changeAmount() {
                    return this.payAmount - this.total;
                },
                
                addToCart(product) {
                    const item = this.cart.find(i => i.id === product.id);
                    if (item) {
                        item.qty++;
                    } else {
                        this.cart.push({
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            qty: 1
                        });
                    }
                    setTimeout(() => lucide.createIcons(), 10);
                },
                
                updateQty(id, delta) {
                    const item = this.cart.find(i => i.id === id);
                    if (item) {
                        item.qty += delta;
                        if (item.qty <= 0) {
                            this.cart = this.cart.filter(i => i.id !== id);
                        }
                    }
                    setTimeout(() => lucide.createIcons(), 10);
                },
                
                clearCart() {
                    this.cart = [];
                },
                
                formatPrice(price) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
                },
                
                async checkout() {
                    try {
                        const response = await fetch('{{ route('pos.checkout') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                cart: this.cart,
                                pay: this.payAmount
                            })
                        });
                        
                        let data;
                        try {
                            data = await response.json();
                        } catch (e) {
                            alert('Server Error: Transaction could not be processed.');
                            return;
                        }

                        if (response.ok) {
                            this.lastTransactionId = data.transaction_id;
                            this.showSuccess = true;
                            this.printReceipt();
                        } else {
                            alert(data.message || 'Transaction failed');
                        }
                    } catch (e) {
                        alert('Something went wrong');
                    }
                },
                
                resetPOS() {
                    this.cart = [];
                    this.payAmount = 0;
                    this.showSuccess = false;
                    this.lastTransactionId = null;
                },

                printReceipt() {
                    if (this.lastTransactionId) {
                        window.open(`/transactions/${this.lastTransactionId}/receipt`, '_blank', 'width=400,height=600');
                    }
                }
            }
        }
    </script>
</x-app-layout>
