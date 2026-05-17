@extends('layouts.app')

@section('content')
<div x-data="dashboardState()" class="flex h-screen w-full bg-slate-50 relative overflow-hidden" x-init="initDashboard()">
    
    <!-- Sidebar -->
    <aside class="w-64 glass-card border-r border-slate-200 flex flex-col hidden md:flex absolute md:relative z-20 h-full transition-transform" :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen, 'md:translate-x-0': true}">
        <div class="p-6 border-b border-slate-200/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-400 to-teal-500 shadow-lg shadow-brand-500/30 flex items-center justify-center p-2">
                    <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-white" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-brand-600 to-teal-600 tracking-tight">WasteWise</span>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <template x-if="user.role === 'admin'">
                <a href="/admin" class="flex items-center gap-3 px-4 py-3 text-slate-700 rounded-xl hover:bg-brand-50 hover:text-brand-700 transition-colors" :class="{'bg-brand-50 text-brand-700 font-semibold': window.location.pathname === '/admin'}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Overview
                </a>
            </template>
            <template x-if="user.role === 'user'">
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 text-slate-700 rounded-xl hover:bg-brand-50 hover:text-brand-700 transition-colors" :class="{'bg-brand-50 text-brand-700 font-semibold': window.location.pathname === '/dashboard'}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
            </template>
            
            <a href="/scanner" class="flex items-center gap-3 px-4 py-3 text-slate-700 rounded-xl hover:bg-brand-50 hover:text-brand-700 transition-colors" :class="{'bg-brand-50 text-brand-700 font-semibold': window.location.pathname === '/scanner'}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                AI Scanner
            </a>
            
            <a href="/pickups" class="flex items-center gap-3 px-4 py-3 text-slate-700 rounded-xl hover:bg-brand-50 hover:text-brand-700 transition-colors" :class="{'bg-brand-50 text-brand-700 font-semibold': window.location.pathname === '/pickups'}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Pickups
            </a>
            
            <a href="/waste-banks" class="flex items-center gap-3 px-4 py-3 text-slate-700 rounded-xl hover:bg-brand-50 hover:text-brand-700 transition-colors" :class="{'bg-brand-50 text-brand-700 font-semibold': window.location.pathname === '/waste-banks'}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Waste Banks
            </a>
            
            <a href="/education" class="flex items-center gap-3 px-4 py-3 text-slate-700 rounded-xl hover:bg-brand-50 hover:text-brand-700 transition-colors" :class="{'bg-brand-50 text-brand-700 font-semibold': window.location.pathname === '/education'}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Education
            </a>
        </div>
        
        <div class="p-4 border-t border-slate-200/50">
            <button @click="logout" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Top Navbar -->
        <header class="h-16 glass z-10 flex items-center justify-between px-6 border-b border-slate-200/50">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden text-slate-500 hover:text-slate-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h1 class="text-xl font-bold text-slate-800 hidden sm:block" x-text="pageTitle"></h1>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-50 text-brand-700 border border-brand-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold text-sm" x-text="user.eco_points + ' pts'"></span>
                </div>
                
                <a href="/profile" class="flex items-center gap-3 hover:bg-white/50 p-1.5 rounded-full transition-colors cursor-pointer">
                    <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden flex items-center justify-center text-slate-500 font-bold border border-slate-300">
                        <template x-if="user.profile_photo">
                            <img :src="user.profile_photo" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!user.profile_photo">
                            <span x-text="user.name ? user.name.charAt(0).toUpperCase() : 'U'"></span>
                        </template>
                    </div>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            @yield('dashboard_content')
        </div>
    </main>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dashboardState', () => ({
            sidebarOpen: false,
            user: { name: '', role: 'user', eco_points: 0, level: 1 },
            pageTitle: '@yield("page_title", "Dashboard")',
            
            async initDashboard() {
                const token = localStorage.getItem('token');
                if(!token) {
                    window.location.href = '/login';
                    return;
                }
                
                try {
                    const res = await fetch('/api/me', {
                        headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                    });
                    if(res.ok) {
                        this.user = await res.json();
                        localStorage.setItem('user', JSON.stringify(this.user));
                        
                        // Guard admin routes
                        if(window.location.pathname === '/admin' && this.user.role !== 'admin') {
                            window.location.href = '/dashboard';
                        }
                    } else {
                        localStorage.removeItem('token');
                        window.location.href = '/login';
                    }
                } catch(e) {
                    console.error('Failed to load user', e);
                }
            },
            
            async logout() {
                const token = localStorage.getItem('token');
                if(token) {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: { 'Authorization': 'Bearer ' + token }
                    });
                }
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                window.location.href = '/login';
            }
        }));
    });
</script>
@endpush
@endsection
