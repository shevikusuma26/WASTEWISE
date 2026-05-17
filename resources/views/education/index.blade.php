@extends('layouts.dashboard')

@section('page_title', 'Environmental Education Hub')

@section('dashboard_content')
<div x-data="educationHub()" x-init="fetchArticles()" class="space-y-8">
    
    <!-- Hero / Featured Article Banner -->
    <template x-if="featuredArticle">
        <div class="relative w-full h-[400px] md:h-[500px] rounded-3xl overflow-hidden shadow-2xl group cursor-pointer" @click="openArticle(featuredArticle)">
            <img :src="featuredArticle.image || 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200&q=80'" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>
            
            <div class="absolute inset-0 p-8 md:p-12 flex flex-col justify-end">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-brand-500 text-white text-xs font-black uppercase tracking-wider rounded-full shadow-lg">Featured</span>
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-wider rounded-full border border-white/30" x-text="featuredArticle.category"></span>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 max-w-4xl group-hover:text-brand-300 transition-colors" x-text="featuredArticle.title"></h1>
                <p class="text-slate-300 text-sm md:text-base max-w-2xl line-clamp-2 mb-6" x-text="featuredArticle.content"></p>
                
                <div class="flex items-center gap-4 text-slate-300 text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-brand-500 flex items-center justify-center text-white font-bold text-xs" x-text="featuredArticle.author.charAt(0)"></div>
                        <span x-text="featuredArticle.author"></span>
                    </div>
                    <span class="w-1 h-1 rounded-full bg-slate-500"></span>
                    <span x-text="new Date(featuredArticle.created_at).toLocaleDateString()"></span>
                    <span class="w-1 h-1 rounded-full bg-slate-500"></span>
                    <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span x-text="featuredArticle.read_time + ' min read'"></span></span>
                </div>
            </div>
        </div>
    </template>

    <!-- Navigation & Filters -->
    <div class="sticky top-0 z-30 bg-slate-50/90 backdrop-blur-md py-4 border-b border-slate-200/50 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="flex gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 hide-scrollbar">
            <template x-for="cat in categories" :key="cat">
                <button @click="setCategory(cat)" 
                        class="px-5 py-2 rounded-xl text-sm font-bold whitespace-nowrap transition-all shadow-sm"
                        :class="activeCategory === cat ? 'bg-slate-800 text-white shadow-slate-800/30' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'">
                    <span x-text="cat"></span>
                </button>
            </template>
        </div>
        
        <div class="relative w-full md:w-72">
            <input type="text" x-model="searchQuery" @input.debounce.500ms="filterArticles()" placeholder="Search articles..." 
                   class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all text-sm shadow-sm">
            <svg class="w-5 h-5 absolute left-4 top-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Article Grid -->
        <div class="lg:col-span-8 space-y-6">
            <h3 class="text-2xl font-black text-slate-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Latest Insights
            </h3>
            
            <template x-if="isLoading">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="i in 4">
                        <div class="bg-white rounded-2xl p-4 border border-slate-100 animate-pulse">
                            <div class="w-full h-48 bg-slate-200 rounded-xl mb-4"></div>
                            <div class="h-4 bg-slate-200 rounded w-3/4 mb-2"></div>
                            <div class="h-4 bg-slate-200 rounded w-1/2 mb-4"></div>
                        </div>
                    </template>
                </div>
            </template>
            
            <template x-if="!isLoading && regularArticles.length === 0">
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-100 border-dashed">
                    <p class="text-slate-500 font-medium">No articles found matching your criteria.</p>
                </div>
            </template>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <template x-for="article in regularArticles" :key="article.id">
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:border-brand-200 transition-all group flex flex-col h-full cursor-pointer" @click="openArticle(article)">
                        <div class="h-48 relative overflow-hidden bg-slate-100">
                            <img :src="article.image || 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=500&q=80'" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-3 left-3 px-3 py-1 bg-white/90 backdrop-blur-sm text-slate-800 text-[10px] font-black uppercase tracking-wider rounded-lg shadow-sm" x-text="article.category"></div>
                            <button @click.stop="toggleBookmark(article.id)" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center text-slate-400 hover:text-brand-500 transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                            </button>
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <h4 class="text-lg font-black text-slate-800 mb-2 leading-tight group-hover:text-brand-600 transition-colors line-clamp-2" x-text="article.title"></h4>
                            <p class="text-sm text-slate-500 line-clamp-3 mb-4 flex-1" x-text="article.content"></p>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center font-bold text-[10px]" x-text="article.author.charAt(0)"></div>
                                    <span class="text-xs font-bold text-slate-600" x-text="article.author"></span>
                                </div>
                                <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span x-text="article.read_time + ' min'"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Right: Trending Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <h3 class="text-xl font-black text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                Trending Now
            </h3>
            
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-6">
                <template x-for="(article, index) in trendingArticles" :key="article.id">
                    <div class="flex gap-4 group cursor-pointer" @click="openArticle(article)">
                        <h4 class="text-3xl font-black text-slate-200 group-hover:text-brand-300 transition-colors">0<span x-text="index + 1"></span></h4>
                        <div>
                            <h5 class="font-bold text-slate-800 leading-tight mb-1 group-hover:text-brand-600 transition-colors line-clamp-2" x-text="article.title"></h5>
                            <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase">
                                <span class="text-brand-500" x-text="article.category"></span>
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <span x-text="article.read_time + ' min read'"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Eco Tips Widget -->
            <div class="bg-gradient-to-br from-brand-500 to-teal-600 rounded-3xl p-6 shadow-lg shadow-brand-500/20 text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h4 class="text-lg font-black mb-2">Daily Eco-Tip</h4>
                <p class="text-sm text-brand-100 leading-relaxed font-medium">Keep your recyclable paper dry and clean. Paper contaminated with food waste or grease (like pizza boxes) cannot be recycled and should be composted instead!</p>
            </div>
        </div>
    </div>
    
    <!-- Article Reading Modal -->
    <div x-show="viewingArticle" class="fixed inset-0 z-[100] flex justify-end" style="display: none;">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="closeArticle()" x-transition.opacity></div>
        
        <div class="w-full md:w-[800px] bg-white h-full overflow-y-auto shadow-2xl relative z-10 transform transition-transform"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">
             
            <template x-if="viewingArticle">
                <div>
                    <!-- Modal Header -->
                    <div class="sticky top-0 z-20 bg-white/80 backdrop-blur-xl border-b border-slate-100 px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button @click="closeArticle()" class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <span class="font-bold text-slate-800 text-sm">Back to Hub</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="w-10 h-10 rounded-full bg-slate-100 hover:bg-brand-50 text-slate-600 hover:text-brand-600 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                            </button>
                            <button class="w-10 h-10 rounded-full bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"></path></svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="sticky top-[73px] z-20 w-full h-1 bg-slate-100">
                        <div class="h-full bg-brand-500" :style="`width: ${scrollProgress}%`"></div>
                    </div>
                    
                    <!-- Article Content -->
                    <div class="p-8 md:p-12" @scroll.window="updateScrollProgress($event.target)">
                        <div class="mb-8">
                            <span class="px-3 py-1 bg-brand-50 text-brand-600 text-xs font-black uppercase tracking-wider rounded-lg mb-4 inline-block" x-text="viewingArticle.category"></span>
                            <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6" x-text="viewingArticle.title"></h1>
                            
                            <div class="flex items-center gap-4 py-4 border-y border-slate-100">
                                <div class="w-12 h-12 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-600 text-lg" x-text="viewingArticle.author.charAt(0)"></div>
                                <div>
                                    <p class="font-bold text-slate-800" x-text="viewingArticle.author"></p>
                                    <p class="text-xs text-slate-500 font-medium">
                                        <span x-text="new Date(viewingArticle.created_at).toLocaleDateString('en-US', {month:'long', day:'numeric', year:'numeric'})"></span>
                                        &bull; <span x-text="viewingArticle.read_time + ' min read'"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full h-64 md:h-96 rounded-3xl overflow-hidden mb-10 bg-slate-100">
                            <img :src="viewingArticle.image || 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200&q=80'" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Formatted Content -->
                        <div class="prose prose-lg prose-slate max-w-none prose-headings:font-black prose-a:text-brand-600" x-html="formatContent(viewingArticle.content)">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar { display: none; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('educationHub', () => ({
        allArticles: [],
        categories: ['All', 'Eco Lifestyle', 'Technology', 'Innovation', 'Recycling', 'Eco Tips', 'Climate Change', 'Green Tech'],
        activeCategory: 'All',
        searchQuery: '',
        isLoading: true,
        viewingArticle: null,
        scrollProgress: 0,
        
        async fetchArticles() {
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/articles', {
                    headers: { 'Authorization': 'Bearer ' + token }
                });
                if(res.ok) {
                    this.allArticles = await res.json();
                }
            } catch (e) { console.error(e); }
            finally { this.isLoading = false; }
        },
        
        get featuredArticle() {
            return this.allArticles.find(a => a.is_featured === 1 || a.is_featured === true) || this.allArticles[0];
        },
        
        get trendingArticles() {
            return this.allArticles.filter(a => (a.is_trending === 1 || a.is_trending === true) && a.id !== this.featuredArticle?.id).slice(0, 4);
        },
        
        get regularArticles() {
            let filtered = this.allArticles.filter(a => a.id !== this.featuredArticle?.id && !this.trendingArticles.includes(a));
            
            if (this.activeCategory !== 'All') {
                filtered = filtered.filter(a => a.category === this.activeCategory);
            }
            if (this.searchQuery) {
                const q = this.searchQuery.toLowerCase();
                filtered = filtered.filter(a => a.title.toLowerCase().includes(q) || a.content.toLowerCase().includes(q));
            }
            return filtered;
        },
        
        setCategory(cat) {
            this.activeCategory = cat;
        },
        
        openArticle(article) {
            this.viewingArticle = article;
            this.scrollProgress = 0;
            document.body.style.overflow = 'hidden';
        },
        
        closeArticle() {
            this.viewingArticle = null;
            document.body.style.overflow = 'auto';
        },
        
        updateScrollProgress(element) {
            if(!element.scrollTop) return;
            const winScroll = element.scrollTop;
            const height = element.scrollHeight - element.clientHeight;
            this.scrollProgress = (winScroll / height) * 100;
        },
        
        formatContent(text) {
            // Simple formatter to split long paragraphs
            return text.split('\n\n').map(p => `<p class="mb-6 leading-relaxed text-slate-700">${p}</p>`).join('');
        },
        
        toggleBookmark(id) {
            // Placeholder
            alert('Saved to your bookmarks!');
        }
    }));
});
</script>
@endsection
