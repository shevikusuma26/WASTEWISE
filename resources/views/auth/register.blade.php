@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex bg-slate-50 relative overflow-hidden" x-data="registerForm()">
    
    <!-- Left Side: Register Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 lg:p-12 relative z-10 overflow-y-auto">
        <a href="/" class="absolute top-8 left-8 w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-brand-500 hover:scale-110 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>

        <div class="w-full max-w-md mx-auto animate-fade-in-up mt-16 lg:mt-0">
            <div class="mb-8">
                <div class="lg:hidden w-12 h-12 rounded-xl bg-gradient-to-br from-brand-400 to-teal-500 flex items-center justify-center p-2.5 mb-6 shadow-lg shadow-brand-500/30">
                    <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-white" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-900 mb-2">Create Your Eco Journey</h2>
                <p class="text-slate-500 font-medium">Join thousands of smart recyclers and start contributing to a greener future today.</p>
            </div>
            
            <form @submit.prevent="submit" class="space-y-5">
                
                <!-- Name Input -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input x-model="name" type="text" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-slate-800" placeholder="John Doe" required>
                    </div>
                </div>

                <!-- Email Input -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input x-model="email" type="email" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-slate-800" placeholder="hello@example.com" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password Input -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input x-model="password" :type="showPassword ? 'text' : 'password'" class="w-full pl-11 pr-12 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-slate-800" placeholder="••••••••" required>
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-600 focus:outline-none">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="showPassword" style="display:none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Confirm</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input x-model="password_confirmation" :type="showPassword ? 'text' : 'password'" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-slate-800" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-start bg-brand-50 p-4 rounded-xl border border-brand-100 mt-6">
                    <input type="checkbox" id="agree" required class="mt-1 w-5 h-5 text-brand-500 bg-white border-brand-200 rounded focus:ring-brand-500 focus:ring-2">
                    <label for="agree" class="ml-3 text-sm font-medium text-brand-800 leading-relaxed">
                        I agree to the <a href="#" class="font-bold underline decoration-brand-300">Sustainability Mission</a> and pledge to properly separate my waste to protect the environment.
                    </label>
                </div>
                
                <button type="submit" :disabled="loading" class="w-full py-4 px-4 rounded-xl font-black text-white bg-gradient-to-r from-teal-500 to-brand-500 hover:from-teal-600 hover:to-brand-600 shadow-lg shadow-brand-500/25 transition-all hover:scale-[1.02] active:scale-[0.98] flex justify-center items-center gap-2 group disabled:opacity-70 disabled:cursor-not-allowed">
                    <span x-show="!loading">Join Sustainable Future</span>
                    <svg x-show="!loading" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    <svg x-show="loading" style="display:none;" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </button>
            </form>
            
            <p class="text-center text-sm font-medium text-slate-500 mt-8">
                Already an eco-warrior? <a href="/login" class="font-bold text-brand-600 hover:text-brand-700 underline decoration-2 underline-offset-4 decoration-brand-200">Log in here</a>
            </p>
        </div>
    </div>

    <!-- Right Side: Eco Stats Preview -->
    <div class="hidden lg:flex w-1/2 relative bg-gradient-to-br from-brand-900 to-slate-900 flex-col justify-center p-12 overflow-hidden">
        
        <!-- Animated Particles -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-10 right-20 w-4 h-4 bg-brand-400 rounded-full animate-bounce"></div>
            <div class="absolute bottom-20 left-20 w-6 h-6 bg-teal-400 rounded-full animate-pulse-slow"></div>
            <div class="absolute top-1/2 right-1/3 w-3 h-3 bg-white rounded-full animate-ping"></div>
        </div>
        
        <div class="relative z-10 max-w-lg mx-auto">
            <!-- Mockup Card -->
            <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 text-white shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-brand-300 font-bold text-sm uppercase tracking-wider mb-1">Global Impact</p>
                        <h3 class="text-3xl font-black">AI-Powered<br>Sustainability</h3>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm border border-white/30">
                        <svg class="w-8 h-8 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="bg-black/20 rounded-2xl p-4 flex items-center gap-4 border border-white/10">
                        <div class="w-12 h-12 bg-brand-500 rounded-full flex items-center justify-center shrink-0 shadow-lg shadow-brand-500/50">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-300">Total Scans Today</p>
                            <p class="text-xl font-black text-white">+12,450 Items</p>
                        </div>
                    </div>
                    
                    <div class="bg-black/20 rounded-2xl p-4 flex items-center gap-4 border border-white/10">
                        <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center shrink-0 shadow-lg shadow-teal-500/50">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-300">Carbon Reduced</p>
                            <p class="text-xl font-black text-white">4,200 kg CO₂</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <p class="text-brand-100 font-medium italic text-lg opacity-80">
                    "Waste isn't waste until we waste it. Join the movement to circular economy."
                </p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
.animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
</style>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('registerForm', () => ({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            showPassword: false,
            loading: false,
            
            async submit() {
                if (this.password !== this.password_confirmation) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Passwords do not match!',
                        confirmButtonColor: '#10b981'
                    });
                    return;
                }
                
                this.loading = true;
                try {
                    const response = await fetch('/api/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.password_confirmation
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok) {
                        localStorage.setItem('token', data.access_token);
                        localStorage.setItem('user', JSON.stringify(data.user));
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Welcome to WasteWise!',
                            text: 'Your eco account has been created.',
                            confirmButtonColor: '#10b981'
                        }).then(() => {
                            window.location.href = '/dashboard';
                        });
                    } else {
                        // Handle validation errors
                        let errorMsg = data.message || 'Registration failed';
                        if (data.errors) {
                            errorMsg = Object.values(data.errors).flat().join('\n');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: errorMsg,
                            confirmButtonColor: '#10b981'
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        confirmButtonColor: '#10b981'
                    });
                } finally {
                    this.loading = false;
                }
            }
        }))
    })
</script>
@endpush
@endsection
