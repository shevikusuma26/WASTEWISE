@extends('layouts.dashboard')

@section('page_title', 'My Profile')

@section('dashboard_content')
<div x-data="profileManager()" class="max-w-3xl mx-auto space-y-6">
    <div class="glass-card rounded-3xl p-8 relative overflow-hidden">
        <div class="absolute right-0 top-0 w-64 h-64 bg-brand-200 rounded-full mix-blend-multiply blur-3xl opacity-50 translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="flex flex-col md:flex-row gap-8 items-center md:items-start relative z-10">
            <div class="relative group">
                <div class="w-32 h-32 rounded-full bg-slate-200 overflow-hidden border-4 border-white shadow-xl flex items-center justify-center text-4xl text-slate-400 font-bold">
                    <template x-if="user.profile_photo">
                        <img :src="user.profile_photo" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!user.profile_photo">
                        <span x-text="user.name ? user.name.charAt(0).toUpperCase() : 'U'"></span>
                    </template>
                </div>
            </div>
            
            <div class="flex-1 text-center md:text-left space-y-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800" x-text="user.name"></h2>
                    <p class="text-slate-500" x-text="user.email"></p>
                </div>
                
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <div class="px-4 py-2 bg-brand-50 rounded-xl border border-brand-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-brand-700" x-text="user.eco_points + ' Eco-Points'"></span>
                    </div>
                    <div class="px-4 py-2 bg-blue-50 rounded-xl border border-blue-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        <span class="font-bold text-blue-700" x-text="'Level ' + user.level"></span>
                    </div>
                    <span class="px-4 py-2 bg-slate-100 rounded-xl font-medium text-slate-600 capitalize" x-text="user.role"></span>
                </div>
            </div>
        </div>
    </div>
    

</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('profileManager', () => ({
        user: JSON.parse(localStorage.getItem('user')) || {}
    }));
});
</script>
@endsection
