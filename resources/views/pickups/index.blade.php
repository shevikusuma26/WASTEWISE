@extends('layouts.dashboard')

@section('page_title', 'Realtime Pickup Tracking')

@section('dashboard_content')
<!-- Include Pusher and Laravel Echo -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

<div x-data="pickupSystem()" x-init="initPickups()" class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">My Pickups</h2>
            <p class="text-slate-500">Track your waste pickups in real-time.</p>
        </div>
        <button @click="showModal = true" class="px-5 py-2.5 rounded-xl font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:scale-[1.02] shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2 w-max">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Request Pickup
        </button>
    </div>

    <!-- Active Pickups Timeline -->
    <div x-show="activePickups.length > 0" class="space-y-6">
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-500"></span>
            </span>
            Active Tracking
        </h3>
        
        <template x-for="pickup in activePickups" :key="'active-'+pickup.id">
            <div class="glass-card rounded-3xl p-6 md:p-8 relative overflow-hidden border-2 border-brand-100 shadow-xl transition-all">
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-100 mix-blend-multiply blur-3xl opacity-50 rounded-full translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-start justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-800 text-white shadow-md">ID: #<span x-text="pickup.id"></span></span>
                            <span class="text-slate-500 text-sm font-medium" x-text="new Date(pickup.pickup_date).toLocaleDateString()"></span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-2xl mb-1" x-text="pickup.waste_type"></h4>
                        <p class="text-slate-600 flex items-start gap-2 max-w-md">
                            <svg class="w-5 h-5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <span x-text="pickup.address"></span>
                        </p>
                    </div>
                    
                    <!-- Realtime Timeline -->
                    <div class="w-full md:w-1/2">
                        <div class="relative pt-2">
                            <!-- Background Line -->
                            <div class="absolute top-5 left-4 right-4 h-1 bg-slate-200 rounded-full z-0"></div>
                            
                            <!-- Progress Line -->
                            <div class="absolute top-5 left-4 h-1 bg-brand-500 rounded-full z-0 transition-all duration-1000 ease-in-out"
                                 :style="'width: ' + getProgressWidth(pickup.status)"></div>
                            
                            <!-- Steps -->
                            <div class="relative z-10 flex justify-between">
                                <!-- Step 1: Pending -->
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center transition-colors duration-500 shadow-sm"
                                         :class="isStepActive(pickup.status, 1) ? 'bg-brand-500 text-white' : 'bg-slate-200 text-slate-400'">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold" :class="isStepActive(pickup.status, 1) ? 'text-brand-700' : 'text-slate-400'">Requested</span>
                                </div>
                                
                                <!-- Step 2: Accepted -->
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center transition-colors duration-500 shadow-sm"
                                         :class="isStepActive(pickup.status, 2) ? 'bg-brand-500 text-white' : 'bg-slate-200 text-slate-400'">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold" :class="isStepActive(pickup.status, 2) ? 'text-brand-700' : 'text-slate-400'">Accepted</span>
                                </div>
                                
                                <!-- Step 3: On Process -->
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-7 h-7 rounded-full flex items-center justify-center transition-colors duration-500 shadow-sm"
                                         :class="isStepActive(pickup.status, 3) ? 'bg-brand-500 text-white' : 'bg-slate-200 text-slate-400'">
                                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold" :class="isStepActive(pickup.status, 3) ? 'text-brand-700' : 'text-slate-400'">On the way</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-3 bg-brand-50 rounded-xl border border-brand-100 flex items-center gap-3 animate-fade-in" x-show="pickup.status === 'on_process'">
                            <div class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h5 class="text-sm font-bold text-brand-800">Driver is arriving soon!</h5>
                                <p class="text-xs text-brand-600">Please prepare your waste items.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Past Pickups -->
    <div x-show="pastPickups.length > 0" class="mt-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Past Pickups</h3>
        <div class="glass-card rounded-2xl p-6">
            <div class="space-y-4">
                <template x-for="pickup in pastPickups" :key="'past-'+pickup.id">
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-white/50 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800" x-text="pickup.waste_type"></h4>
                                <p class="text-xs text-slate-500" x-text="new Date(pickup.updated_at || pickup.pickup_date).toLocaleDateString()"></p>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-700 border border-brand-100">Completed</span>
                    </div>
                </template>
            </div>
        </div>
    </div>
    
    <div x-show="pickups.length === 0" class="text-center py-12">
        <div class="w-20 h-20 mx-auto bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-700">No Pickups Yet</h3>
        <p class="text-slate-500 mt-1">Request a pickup and track it here in real-time.</p>
    </div>

    <!-- Request Modal -->
    <div x-show="showModal" style="display:none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
        <div @click.away="showModal = false" class="bg-white rounded-3xl p-6 w-full max-w-md shadow-2xl relative animate-bounce-in mx-4">
            <button @click="showModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h3 class="text-2xl font-bold text-slate-800 mb-6">Request Pickup</h3>
            <form @submit.prevent="submitRequest" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Waste Type</label>
                    <select x-model="form.waste_type" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50" required>
                        <option value="">Select type...</option>
                        <option value="Campuran (Organik & Anorganik)">Campuran (Organik & Anorganik)</option>
                        <option value="Plastik & Kertas">Plastik & Kertas</option>
                        <option value="Elektronik (E-Waste)">Elektronik (E-Waste)</option>
                        <option value="Kaca & Logam">Kaca & Logam</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pickup Date</label>
                    <input type="date" x-model="form.pickup_date" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Full Address</label>
                    <textarea x-model="form.address" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 bg-slate-50" placeholder="Enter your full address..." required></textarea>
                </div>
                <button type="submit" :disabled="loading" class="w-full py-3.5 rounded-xl font-semibold text-white bg-blue-600 hover:bg-blue-700 flex justify-center items-center gap-2 transition-colors mt-6">
                    <span x-show="!loading">Submit Request</span>
                    <svg x-show="loading" style="display:none;" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes bounce-in { 0% { transform: scale(0.9); opacity: 0; } 50% { transform: scale(1.02); opacity: 1; } 100% { transform: scale(1); opacity: 1; } }
.animate-bounce-in { animation: bounce-in 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('pickupSystem', () => ({
        pickups: [],
        showModal: false,
        loading: false,
        echo: null,
        user: JSON.parse(localStorage.getItem('user')) || {},
        form: { waste_type: '', pickup_date: '', address: '' },
        
        get activePickups() { return this.pickups.filter(p => p.status !== 'completed'); },
        get pastPickups() { return this.pickups.filter(p => p.status === 'completed'); },
        
        async initPickups() {
            await this.fetchPickups();
            this.setupWebSockets();
        },
        
        setupWebSockets() {
            // Setup Echo
            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: 'wastewise_key', // From .env PUSHER_APP_KEY
                cluster: 'mt1',
                forceTLS: true
            });
            
            // Listen on private/public channel for user
            window.Echo.channel(`pickups.${this.user.id}`)
                .listen('PickupStatusUpdated', (e) => {
                    console.log('Realtime Update Received:', e);
                    
                    // Find and update the pickup in local array
                    const idx = this.pickups.findIndex(p => p.id === e.id);
                    if(idx !== -1) {
                        this.pickups[idx].status = e.status;
                        
                        // Show Live Notification
                        Swal.fire({
                            icon: 'info',
                            title: 'Pickup Update',
                            text: e.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000
                        });
                        
                        // Force alpine reactivity by creating a new array reference
                        this.pickups = [...this.pickups];
                    }
                });
        },
        
        isStepActive(status, step) {
            const steps = { 'pending': 1, 'accepted': 2, 'on_process': 3, 'completed': 4 };
            return steps[status] >= step;
        },
        
        getProgressWidth(status) {
            const widths = { 'pending': '0%', 'accepted': '50%', 'on_process': '100%', 'completed': '100%' };
            return widths[status] || '0%';
        },
        
        async fetchPickups() {
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/pickups', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                if (res.ok) this.pickups = await res.json();
            } catch (e) { console.error(e); }
        },
        
        async submitRequest() {
            this.loading = true;
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/pickups', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(this.form)
                });
                if (res.ok) {
                    this.showModal = false;
                    Swal.fire({ icon: 'success', title: 'Pickup Requested', toast: true, position: 'top-end', showConfirmButton: false, timer: 2000 });
                    this.form = { waste_type: '', pickup_date: '', address: '' };
                    this.fetchPickups();
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Please fill all required fields correctly.' });
                }
            } catch(e) { Swal.fire({ icon: 'error', title: 'Oops', text: 'Something went wrong.' }); } 
            finally { this.loading = false; }
        }
    }));
});
</script>
@endsection
