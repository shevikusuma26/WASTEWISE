@extends('layouts.app')

@section('content')
<div class="min-h-screen w-full flex bg-slate-50 relative overflow-hidden" x-data="loginForm()">
    <!-- Left Side: Eco Illustration & USP -->
    <div class="hidden lg:flex w-1/2 relative bg-slate-900 flex-col justify-between p-12 overflow-hidden">
        <!-- Animated Background blobs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-500 rounded-full mix-blend-multiply blur-[100px] opacity-40 animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-500 rounded-full mix-blend-multiply blur-[100px] opacity-30 animate-blob animation-delay-2000"></div>
        
        <div class="relative z-10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-400 to-teal-500 flex items-center justify-center p-2 shadow-lg shadow-brand-500/30">
                <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-white" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
            </div>
            <span class="text-2xl font-black text-white tracking-tight">WasteWise</span>
        </div>

        <div class="relative z-10 my-auto pt-10">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-brand-300 font-bold text-xs mb-6 backdrop-blur-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Smart Waste Management Platform
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-black text-white leading-tight mb-6">
                Your Smart <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-teal-400">Recycling Companion</span>
            </h1>
            
            <p class="text-lg text-slate-300 font-medium leading-relaxed max-w-md mb-8">
                Mulai perjalanan eco-friendly kamu bersama ribuan pengguna lainnya. Identifikasi sampah dengan AI, kurangi jejak karbon, dan dapatkan rewards.
            </p>

            <div class="space-y-4">
                <div class="flex items-center gap-3 text-slate-300">
                    <div class="w-8 h-8 rounded-full bg-brand-500/20 flex items-center justify-center text-brand-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-medium text-sm">Realtime AI Waste Detection</span>
                </div>
                <div class="flex items-center gap-3 text-slate-300">
                    <div class="w-8 h-8 rounded-full bg-brand-500/20 flex items-center justify-center text-brand-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-medium text-sm">Track Carbon Reduction</span>
                </div>
                <div class="flex items-center gap-3 text-slate-300">
                    <div class="w-8 h-8 rounded-full bg-brand-500/20 flex items-center justify-center text-brand-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-medium text-sm">Earn Eco Points & Rewards</span>
                </div>
            </div>
        </div>

        <div class="relative z-10 flex items-center gap-4 text-xs font-bold text-slate-500">
            <a href="/" class="hover:text-white transition-colors">Back to Home</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-12 relative">
        <a href="/" class="absolute top-8 right-8 w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-brand-500 hover:scale-110 transition-all lg:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <div class="w-full max-w-md animate-fade-in-up">
            <div class="text-center lg:text-left mb-10">
                <div class="lg:hidden w-12 h-12 rounded-xl bg-gradient-to-br from-brand-400 to-teal-500 flex items-center justify-center p-2.5 mx-auto mb-6 shadow-lg shadow-brand-500/30">
                    <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-white" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-900 mb-2">Welcome Back</h2>
                <p class="text-slate-500 font-medium">Please enter your details to access your dashboard.</p>
            </div>

            <!-- Social Login Mockups -->
            <div class="grid grid-cols-2 gap-4 mb-8">
                <button class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:shadow-sm font-bold text-sm text-slate-700 transition-all">
                    <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                    Google
                </button>
                <button class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 hover:shadow-sm font-bold text-sm text-slate-700 transition-all">
                    <svg class="w-5 h-5 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.43.987 3.96.948 1.637-.026 2.62-1.473 3.603-2.92 1.156-1.674 1.633-3.298 1.659-3.385-.035-.015-3.17-1.22-3.197-4.85-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.619 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.559-1.701"/></svg>
                    Apple
                </button>
            </div>

            <div class="flex items-center gap-4 mb-8">
                <div class="h-px bg-slate-200 flex-1"></div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Or login with email</span>
                <div class="h-px bg-slate-200 flex-1"></div>
            </div>
            
            <form @submit.prevent="submit" class="space-y-6">
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
                
                <!-- Password Input -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-bold text-slate-700">Password</label>
                        <a href="#" class="text-xs font-bold text-brand-600 hover:text-brand-700">Forgot Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input x-model="password" :type="showPassword ? 'text' : 'password'" class="w-full pl-11 pr-12 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all font-medium text-slate-800" placeholder="Enter your password" required>
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-brand-600 focus:outline-none">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="showPassword" style="display:none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-brand-500 bg-slate-100 border-slate-300 rounded focus:ring-brand-500 focus:ring-2">
                    <label for="remember" class="ml-2 text-sm font-medium text-slate-600">Remember me</label>
                </div>
                
                <button type="submit" :disabled="loading" class="w-full py-4 px-4 rounded-xl font-black text-white bg-gradient-to-r from-brand-500 to-teal-500 hover:from-brand-600 hover:to-teal-600 shadow-lg shadow-brand-500/25 transition-all hover:scale-[1.02] active:scale-[0.98] flex justify-center items-center gap-2 group disabled:opacity-70 disabled:cursor-not-allowed">
                    <span x-show="!loading">Log In to Dashboard</span>
                    <svg x-show="!loading" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    <svg x-show="loading" style="display:none;" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </button>
            </form>
            
            <p class="text-center text-sm font-medium text-slate-500 mt-8">
                New to WasteWise? <a href="/register" class="font-bold text-brand-600 hover:text-brand-700 underline decoration-2 underline-offset-4 decoration-brand-200">Create your eco account</a>
            </p>
        </div>
    </div>
</div>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob { animation: blob 7s infinite; }
.animation-delay-2000 { animation-delay: 2s; }
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
</style>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('loginForm', () => ({
            email: '',
            password: '',
            showPassword: false,
            loading: false,
            
            async submit() {
                this.loading = true;
                try {
                    const response = await fetch('/api/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ email: this.email, password: this.password })
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok) {
                        localStorage.setItem('token', data.access_token);
                        localStorage.setItem('user', JSON.stringify(data.user));
                        
                        Swal.fire({
                            icon: 'success', title: 'Welcome Back!', text: 'Login successful.',
                            toast: true, position: 'top-end', showConfirmButton: false, timer: 1500
                        }).then(() => {
                            if(data.user.role === 'admin') window.location.href = '/admin';
                            else window.location.href = '/dashboard';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error', title: 'Login Failed', text: data.error || 'Invalid credentials',
                            confirmButtonColor: '#10b981'
                        });
                    }
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!', confirmButtonColor: '#10b981' });
                } finally {
                    this.loading = false;
                }
            }
        }))
    })
</script>
@endpush
@endsection
