@extends('layouts.dashboard')

@section('page_title', 'Waste Bank Finder')

@section('dashboard_content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div x-data="wasteBankFinder()" x-init="initFinder()" class="h-[calc(100vh-8rem)] flex flex-col md:flex-row gap-6">
    
    <!-- Sidebar / List View -->
    <div class="w-full md:w-1/3 flex flex-col gap-4 h-full bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden relative z-10">
        
        <!-- Header & Filters -->
        <div class="p-6 pb-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-xl font-black text-slate-800 mb-4">Find Near You</h2>
            
            <div class="space-y-3">
                <div class="relative">
                    <input type="text" x-model="searchQuery" placeholder="Search by name or location..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all text-sm">
                    <svg class="w-5 h-5 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                
                <div class="flex gap-2 overflow-x-auto pb-2 hide-scrollbar">
                    <template x-for="cat in ['All', 'Plastik', 'Kertas', 'Logam', 'Elektronik', 'Organik']">
                        <button @click="activeCategory = cat" 
                                class="px-4 py-1.5 rounded-full text-xs font-bold whitespace-nowrap transition-colors"
                                :class="activeCategory === cat ? 'bg-brand-500 text-white shadow-md' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'">
                            <span x-text="cat"></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <!-- Bank List -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4">
            <template x-if="isLoading">
                <div class="flex flex-col items-center justify-center h-full text-brand-500">
                    <svg class="w-8 h-8 animate-spin mb-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <p class="font-bold text-sm animate-pulse">Scanning locations...</p>
                </div>
            </template>
            
            <template x-if="!isLoading && filteredBanks.length === 0">
                <div class="text-center py-10 text-slate-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    <p class="font-medium">No waste banks found matching your criteria.</p>
                </div>
            </template>

            <template x-for="bank in filteredBanks" :key="bank.id">
                <div @click="focusBank(bank)" class="group cursor-pointer bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl hover:border-brand-200 transition-all">
                    <div class="h-32 relative overflow-hidden bg-slate-100">
                        <img :src="bank.thumbnail || 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=500&q=80'" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-2 right-2 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm"
                             :class="bank.is_open ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
                             <span x-text="bank.is_open ? 'Open Now' : 'Closed'"></span>
                        </div>
                        <div class="absolute bottom-2 left-2 px-2 py-1 bg-black/60 backdrop-blur rounded text-white text-xs font-bold flex items-center gap-1">
                            <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span x-text="bank.rating"></span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="font-bold text-slate-800 text-sm line-clamp-1" x-text="bank.bank_name"></h3>
                            <span class="text-xs font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded ml-2 whitespace-nowrap" x-text="bank.distance ? bank.distance + ' km' : '...'"></span>
                        </div>
                        <p class="text-xs text-slate-500 line-clamp-1 mb-3" x-text="bank.address"></p>
                        
                        <div class="flex flex-wrap gap-1">
                            <template x-for="cat in getCategories(bank.accepted_categories)">
                                <span class="text-[10px] px-2 py-0.5 bg-slate-100 text-slate-600 rounded-full font-medium" x-text="cat"></span>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Map View -->
    <div class="w-full md:w-2/3 h-full bg-slate-200 rounded-3xl overflow-hidden relative z-0 border border-slate-200 shadow-sm">
        <div id="map" class="w-full h-full"></div>
        
        <!-- Map Overlay Actions -->
        <button @click="centerOnUser()" class="absolute bottom-6 right-6 z-[400] w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-slate-700 hover:text-brand-600 hover:scale-110 transition-all border border-slate-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </button>
    </div>
</div>

<style>
/* Hide scrollbar for category filter */
.hide-scrollbar::-webkit-scrollbar { display: none; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

/* Custom Leaflet Popup styling */
.leaflet-popup-content-wrapper { border-radius: 1rem; padding: 0; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }
.leaflet-popup-content { margin: 0; width: 280px !important; }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('wasteBankFinder', () => ({
        banks: [],
        map: null,
        markers: [],
        userLat: -6.2088,
        userLng: 106.8456,
        searchQuery: '',
        activeCategory: 'All',
        isLoading: true,
        
        async initFinder() {
            this.initMap();
            await this.fetchBanks();
            this.getUserLocation();
        },
        
        initMap() {
            // Default center Jakarta
            this.map = L.map('map', { zoomControl: false }).setView([this.userLat, this.userLng], 12);
            
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap &copy; CARTO'
            }).addTo(this.map);
            
            L.control.zoom({ position: 'topright' }).addTo(this.map);
        },
        
        async fetchBanks() {
            const token = localStorage.getItem('token');
            try {
                const res = await fetch('/api/waste-banks', {
                    headers: { 'Authorization': 'Bearer ' + token }
                });
                if(res.ok) {
                    this.banks = await res.json();
                    this.calculateDistances();
                    this.updateMapMarkers();
                }
            } catch (e) { console.error(e); }
            finally { this.isLoading = false; }
        },
        
        getUserLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(position => {
                    this.userLat = position.coords.latitude;
                    this.userLng = position.coords.longitude;
                    
                    // Add user marker
                    const userIcon = L.divIcon({
                        html: `<div class="w-5 h-5 bg-blue-500 border-2 border-white rounded-full shadow-[0_0_15px_rgba(59,130,246,0.8)] animate-pulse"></div>`,
                        className: '', iconSize: [20, 20], iconAnchor: [10, 10]
                    });
                    L.marker([this.userLat, this.userLng], {icon: userIcon, zIndexOffset: 1000}).addTo(this.map).bindTooltip("You are here");
                    
                    this.centerOnUser();
                    this.calculateDistances();
                });
            }
        },
        
        calculateDistances() {
            this.banks.forEach(bank => {
                if(bank.latitude && bank.longitude) {
                    const R = 6371; // km
                    const dLat = (bank.latitude - this.userLat) * Math.PI / 180;
                    const dLon = (bank.longitude - this.userLng) * Math.PI / 180;
                    const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                              Math.cos(this.userLat * Math.PI / 180) * Math.cos(bank.latitude * Math.PI / 180) *
                              Math.sin(dLon/2) * Math.sin(dLon/2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                    bank.distance = (R * c).toFixed(1);
                } else {
                    bank.distance = 999;
                }
            });
            // Sort by distance
            this.banks.sort((a, b) => parseFloat(a.distance) - parseFloat(b.distance));
        },
        
        get filteredBanks() {
            let result = this.banks;
            
            if (this.searchQuery) {
                const q = this.searchQuery.toLowerCase();
                result = result.filter(b => b.bank_name.toLowerCase().includes(q) || b.address.toLowerCase().includes(q));
            }
            
            if (this.activeCategory !== 'All') {
                result = result.filter(b => {
                    const cats = this.getCategories(b.accepted_categories);
                    return cats.includes(this.activeCategory);
                });
            }
            
            // Re-render markers based on filter
            this.$nextTick(() => { this.updateMapMarkers(result); });
            
            return result;
        },
        
        getCategories(catStr) {
            if(!catStr) return ['Umum'];
            try { return JSON.parse(catStr); } catch(e) { return [catStr]; }
        },
        
        updateMapMarkers(banksToRender = this.banks) {
            if(!this.map) return;
            
            // Clear existing markers
            this.markers.forEach(m => this.map.removeLayer(m));
            this.markers = [];
            
            const customIcon = L.divIcon({
                html: `<div class="relative w-8 h-8">
                        <div class="absolute inset-0 bg-brand-500 rounded-full shadow-lg flex items-center justify-center border-2 border-white transform hover:scale-110 transition-transform">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                       </div>`,
                className: '', iconSize: [32, 32], iconAnchor: [16, 16], popupAnchor: [0, -16]
            });
            
            banksToRender.forEach(bank => {
                if(bank.latitude && bank.longitude) {
                    const popupContent = `
                        <div class="w-full">
                            <img src="${bank.thumbnail || 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=500&q=80'}" class="w-full h-32 object-cover">
                            <div class="p-4">
                                <h3 class="font-bold text-slate-800 text-sm mb-1">${bank.bank_name}</h3>
                                <p class="text-xs text-slate-500 mb-2">${bank.address}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-xs font-bold text-brand-600 bg-brand-50 px-2 py-1 rounded">${bank.distance} km</span>
                                    <a href="https://www.google.com/maps/dir/?api=1&destination=${bank.latitude},${bank.longitude}" target="_blank" class="text-xs font-bold bg-slate-900 text-white px-3 py-1 rounded hover:bg-slate-800">Navigate</a>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    const marker = L.marker([bank.latitude, bank.longitude], {icon: customIcon})
                                   .addTo(this.map)
                                   .bindPopup(popupContent);
                                   
                    marker.bankId = bank.id;
                    this.markers.push(marker);
                }
            });
        },
        
        focusBank(bank) {
            if(!bank.latitude) return;
            this.map.setView([bank.latitude, bank.longitude], 15);
            // Open popup
            const marker = this.markers.find(m => m.bankId === bank.id);
            if(marker) marker.openPopup();
        },
        
        centerOnUser() {
            this.map.flyTo([this.userLat, this.userLng], 13);
        }
    }));
});
</script>
@endsection
