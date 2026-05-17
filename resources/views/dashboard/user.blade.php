@extends('layouts.dashboard')

@section('page_title', 'Smart AI Sustainability Dashboard')

@section('dashboard_content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div x-data="userDashboard()" x-init="fetchData()" class="space-y-8 pb-10">
    
    <!-- Hero / Welcome Banner -->
    <div class="relative w-full rounded-[2rem] overflow-hidden bg-gradient-to-r from-slate-900 via-brand-900 to-teal-900 p-8 md:p-12 shadow-2xl">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-10 w-64 h-64 bg-brand-500 rounded-full mix-blend-multiply blur-3xl opacity-40 animate-blob"></div>
            <div class="absolute bottom-0 left-10 w-64 h-64 bg-teal-500 rounded-full mix-blend-multiply blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <!-- Wavy background pattern -->
            <svg class="absolute bottom-0 w-full h-auto text-white/5" viewBox="0 0 1440 320" preserveAspectRatio="none"><path fill="currentColor" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,197.3C384,192,480,160,576,165.3C672,171,768,213,864,229.3C960,245,1056,235,1152,202.7C1248,171,1344,117,1392,90.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-brand-300 font-bold text-xs mb-4 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                    AI-Powered Smart Recycling Dashboard
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-2">
                    Welcome Back, <span x-text="stats.user_name || 'Eco Warrior'"></span> 🌱
                </h1>
                <p class="text-brand-100 font-medium text-lg">Perjalanan sustainability kamu terus berkembang hari ini.</p>
            </div>
            
            <!-- Quick Action -->
            <div class="shrink-0 flex flex-col gap-3">
                <a href="/scanner" class="px-8 py-4 bg-white text-slate-900 font-black rounded-2xl hover:scale-105 transition-all shadow-[0_0_30px_rgba(255,255,255,0.3)] flex justify-center items-center gap-2 group">
                    <svg class="w-6 h-6 text-brand-500 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    Open Smart Scanner
                </a>
                <p class="text-center text-xs font-bold text-brand-200 uppercase tracking-widest flex justify-center items-center gap-1">
                    <svg class="w-4 h-4 text-brand-400 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Realtime AI Detection Active
                </p>
            </div>
        </div>
    </div>

    <!-- Smart Analytics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Score Ring -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group hover:border-brand-300 transition-colors">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-brand-50 rounded-full mix-blend-multiply blur-2xl group-hover:bg-brand-100 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Eco-Points</p>
                    <h3 class="text-3xl font-black text-slate-800" x-text="stats.eco_points">0</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500">Statistik kontribusi lingkungan kamu terus meningkat.</p>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group hover:border-teal-300 transition-colors">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-teal-50 rounded-full mix-blend-multiply blur-2xl group-hover:bg-teal-100 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">CO₂ Reduced</p>
                    <h3 class="text-3xl font-black text-slate-800"><span x-text="stats.carbon_reduction_est || 0">0</span><span class="text-lg text-slate-500 ml-1">kg</span></h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700">+12% this week</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group hover:border-blue-300 transition-colors">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-blue-50 rounded-full mix-blend-multiply blur-2xl group-hover:bg-blue-100 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Scans</p>
                    <h3 class="text-3xl font-black text-slate-800" x-text="stats.total_scans">0</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500"><span class="font-bold text-blue-600" x-text="stats.recyclable_percentage + '%'"></span> Recyclable Ratio.</p>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm relative overflow-hidden group hover:border-purple-300 transition-colors">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-purple-50 rounded-full mix-blend-multiply blur-2xl group-hover:bg-purple-100 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">AI Accuracy</p>
                    <h3 class="text-3xl font-black text-slate-800"><span x-text="stats.ai_accuracy || 99">0</span><span class="text-lg text-slate-500 ml-1">%</span></h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
            </div>
            <p class="text-xs font-medium text-slate-500">Model inference realtime aktif.</p>
        </div>
    </div>

    <!-- Eco Achievement System -->
    <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm relative overflow-hidden">
        <div class="absolute right-0 top-0 w-64 h-full bg-gradient-to-l from-white via-white to-transparent z-10 pointer-events-none hidden md:block"></div>
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-xl font-black text-slate-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg>
                    Eco Achievement System
                </h2>
                <p class="text-sm font-medium text-slate-500">Koleksi badge sustainability level kamu.</p>
            </div>
            <a href="#" class="text-sm font-bold text-brand-600 hover:text-brand-700 hidden md:block">View All Rewards</a>
        </div>
        
        <div class="flex gap-4 overflow-x-auto pb-4 hide-scrollbar">
            <!-- Badge 1 -->
            <div class="min-w-[200px] bg-slate-50 rounded-2xl p-4 border border-slate-200">
                <div class="w-12 h-12 rounded-full bg-green-100 border-2 border-green-500 flex items-center justify-center text-xl mb-3 shadow-sm shadow-green-500/20">🌱</div>
                <h4 class="font-black text-slate-800 text-sm">Green Starter</h4>
                <p class="text-[10px] text-slate-500 font-bold mb-3">Selesaikan 10 Scan Pertama</p>
                <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="w-full h-full bg-green-500"></div></div>
                <p class="text-[10px] font-bold text-green-600 text-right mt-1">Unlocked!</p>
            </div>
            <!-- Badge 2 -->
            <div class="min-w-[200px] bg-brand-50 rounded-2xl p-4 border border-brand-200 relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-16 h-16 bg-brand-100 rounded-full"></div>
                <div class="w-12 h-12 rounded-full bg-white border-2 border-brand-500 flex items-center justify-center text-xl mb-3 shadow-lg shadow-brand-500/30 relative z-10">♻️</div>
                <h4 class="font-black text-brand-900 text-sm">Recycling Hero</h4>
                <p class="text-[10px] text-brand-600 font-bold mb-3">Reduksi 10kg Karbon</p>
                <div class="w-full h-1.5 bg-brand-200 rounded-full overflow-hidden"><div class="w-[80%] h-full bg-brand-500"></div></div>
                <p class="text-[10px] font-bold text-brand-600 text-right mt-1">8/10 kg</p>
            </div>
            <!-- Badge 3 -->
            <div class="min-w-[200px] bg-slate-50 rounded-2xl p-4 border border-slate-200 opacity-60 grayscale hover:grayscale-0 transition-all cursor-not-allowed">
                <div class="w-12 h-12 rounded-full bg-slate-200 border-2 border-slate-400 flex items-center justify-center text-xl mb-3 shadow-sm">🌍</div>
                <h4 class="font-black text-slate-800 text-sm">Eco Warrior</h4>
                <p class="text-[10px] text-slate-500 font-bold mb-3">Capai 1,000 Eco-Points</p>
                <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden"><div class="w-[30%] h-full bg-slate-400"></div></div>
                <p class="text-[10px] font-bold text-slate-500 text-right mt-1">Locked</p>
            </div>
        </div>
    </div>

    <!-- Live Waste Analytics & Timeline Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Environmental Impact Dashboard -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Environmental Impact Dashboard</h3>
                        <p class="text-sm font-medium text-slate-500">Track progress sustainability kamu mingguan.</p>
                    </div>
                    <select class="text-xs font-bold text-slate-600 bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 outline-none">
                        <option>This Week</option>
                        <option>This Month</option>
                    </select>
                </div>
                <div class="w-full h-72 relative">
                    <canvas id="impactChart"></canvas>
                </div>
            </div>

            <!-- AI Smart Recommendation -->
            <div class="bg-gradient-to-br from-slate-900 to-brand-900 rounded-3xl p-6 md:p-8 text-white shadow-lg relative overflow-hidden">
                <div class="absolute right-0 bottom-0 w-64 h-64 bg-brand-500 rounded-full mix-blend-screen blur-[80px] opacity-30"></div>
                
                <h3 class="text-xl font-black flex items-center gap-2 mb-2">
                    <svg class="w-6 h-6 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    AI Smart Recommendation
                </h3>
                <p class="text-brand-100 font-medium text-sm mb-6 max-w-xl">Rekomendasi AI untuk gaya hidup eco-friendly berdasarkan aktivitas deteksi sampah kamu minggu ini.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center shrink-0">♻️</div>
                        <div>
                            <h4 class="font-bold text-sm mb-1">Recycle plastic bottles</h4>
                            <p class="text-xs text-slate-300">Kamu banyak menscan Botol PET. Coba daur ulang botol plastik ke bank sampah terdekat untuk 50 Bonus Pts.</p>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center shrink-0">📚</div>
                        <div>
                            <h4 class="font-bold text-sm mb-1">Eco habit recommendation</h4>
                            <p class="text-xs text-slate-300">Kurangi penggunaan sedotan plastik. Baca artikel "Zero Waste Lifestyle" di menu Education.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Realtime AI Activity & Timeline -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Realtime Detection Panel -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm h-[400px] flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 flex justify-end">
                    <span class="flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-500"></span>
                    </span>
                </div>
                
                <h3 class="text-lg font-black text-slate-800 mb-1">Realtime AI Activity</h3>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4 border-b border-slate-100 pb-4">Aktivitas Daur Ulang Terbaru</p>
                
                <div class="flex-1 overflow-y-auto pr-2 space-y-4 hide-scrollbar">
                    <template x-if="stats.recent_scans && stats.recent_scans.length > 0">
                        <template x-for="scan in stats.recent_scans" :key="scan.id">
                            <div class="flex gap-4 group">
                                <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0 border border-slate-200 shadow-sm relative">
                                    <img :src="'/storage/' + scan.image" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                    <div class="absolute inset-0 bg-brand-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-slate-800 truncate group-hover:text-brand-600 transition-colors" x-text="scan.scan_result || 'Unknown Object'"></h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-black uppercase bg-brand-100 text-brand-700" x-text="scan.confidence_score + '% ACC'"></span>
                                        <span class="text-[10px] font-bold text-slate-400 truncate" x-text="scan.category ? scan.category.category_name : 'No Category'"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </template>
                    <template x-if="!stats.recent_scans || stats.recent_scans.length === 0">
                        <div class="text-center py-10 text-slate-400">
                            <p class="text-sm font-medium">Belum ada aktivitas deteksi.</p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Smart Activity Timeline -->
            <div class="bg-slate-900 rounded-3xl p-6 border border-slate-800 shadow-sm text-white">
                <h3 class="text-lg font-black mb-1">Smart Activity Feed</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Your Eco Journey</p>
                
                <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-700 before:to-transparent">
                    
                    <template x-for="(item, index) in stats.timeline" :key="index">
                        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-slate-900 bg-slate-700 group-hover:bg-brand-500 text-slate-300 group-hover:text-white shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow shadow-slate-900 transition-colors">
                                <template x-if="item.type === 'scan'"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg></template>
                                <template x-if="item.type === 'achievement'"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path></svg></template>
                                <template x-if="item.type === 'pickup'"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></template>
                            </div>
                            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-slate-800 p-3 rounded-xl border border-slate-700 shadow">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-bold text-brand-400 uppercase" x-text="item.time"></span>
                                    <h4 class="font-bold text-sm text-slate-200 mt-1" x-text="item.title"></h4>
                                    <p class="text-xs text-slate-400 mt-0.5" x-text="item.desc"></p>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
            </div>

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
.animate-spin-slow { animation: spin 4s linear infinite; }
.hide-scrollbar::-webkit-scrollbar { display: none; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('userDashboard', () => ({
        stats: {
            user_name: 'Eco Warrior',
            eco_points: 0, level: 1, total_scans: 0, total_pickups: 0,
            recyclable_percentage: 0, ai_accuracy: 0, carbon_reduction_est: 0,
            recent_scans: [], timeline: [],
            chart_categories: [], chart_category_data: [], chart_carbon_data: []
        },
        async fetchData() {
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/dashboard/statistics', {
                    headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
                });
                if (res.ok) {
                    this.stats = await res.json();
                    this.renderCharts();
                }
            } catch (e) {
                console.error(e);
            }
        },
        renderCharts() {
            // Impact Chart (Line + Bar combo for modern feel)
            const ctx = document.getElementById('impactChart').getContext('2d');
            
            let gradientLine = ctx.createLinearGradient(0, 0, 0, 300);
            gradientLine.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
            gradientLine.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        {
                            type: 'line',
                            label: 'Carbon Reduced (kg)',
                            data: this.stats.chart_carbon_data || [12, 19, 15, 25, 22, 30, 45],
                            borderColor: '#10b981',
                            backgroundColor: gradientLine,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#10b981',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            type: 'bar',
                            label: 'Items Scanned',
                            data: [5, 8, 4, 12, 10, 15, 20],
                            backgroundColor: '#3b82f6',
                            borderRadius: 4,
                            barPercentage: 0.5,
                            categoryPercentage: 0.5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8, font: { weight: 'bold', family: "'Inter', sans-serif" } } }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#f1f5f9', drawBorder: false } },
                        x: { grid: { display: false, drawBorder: false } }
                    }
                }
            });
        }
    }));
});
</script>
@endsection
