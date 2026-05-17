@extends('layouts.app')

@section('content')
<div x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)" class="w-full h-screen overflow-y-auto bg-slate-50 relative scroll-smooth">
    
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-teal-200/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-[20%] right-[-10%] w-[50%] h-[50%] bg-brand-200/40 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-[60%] h-[60%] bg-blue-200/30 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-500" :class="{'bg-white/80 backdrop-blur-lg shadow-sm py-4': scrolled, 'bg-transparent py-6': !scrolled}">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-400 to-teal-500 shadow-lg shadow-brand-500/30 flex items-center justify-center p-2.5 transition-transform group-hover:scale-110">
                    <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-white" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-brand-600 to-teal-600 tracking-tight">WasteWise</span>
            </div>
            <div class="hidden md:flex gap-8 items-center font-bold text-slate-600">
                <a href="#features" class="hover:text-brand-600 transition-colors">Platform</a>
                <a href="#impact" class="hover:text-brand-600 transition-colors">Impact</a>
                <a href="#ai-tech" class="hover:text-brand-600 transition-colors">AI Engine</a>
                <a href="/login" class="px-5 py-2 hover:bg-slate-100 rounded-full transition-colors">Log In</a>
                <a href="/register" class="px-6 py-2.5 bg-slate-900 text-white rounded-full hover:bg-brand-600 shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5">Get Started Free</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 px-6 z-10 overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Hero Text -->
            <div class="space-y-8 relative z-20">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 font-bold text-sm shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    WasteWise AI V2.0 is Live
                </div>
                
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] tracking-tight">
                    Smart Waste <br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-brand-500 to-teal-500">Intelligence.</span>
                </h1>
                
                <p class="text-xl text-slate-600 font-medium leading-relaxed max-w-lg">
                    Transforming urban sustainability through Real-time Computer Vision. Instantly identify, classify, and monetize your recyclables with zero friction.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="/register" class="px-8 py-4 bg-gradient-to-r from-brand-500 to-teal-500 text-white font-black rounded-2xl hover:scale-105 transition-all shadow-[0_0_40px_rgba(34,197,94,0.4)] flex justify-center items-center gap-2">
                        Start Scanning Now
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="#how-it-works" class="px-8 py-4 bg-white text-slate-700 font-bold rounded-2xl hover:bg-slate-50 border border-slate-200 transition-all flex justify-center items-center shadow-sm">
                        See How it Works
                    </a>
                </div>
                
                <div class="pt-8 flex items-center gap-6 text-sm font-bold text-slate-500 border-t border-slate-200">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=1" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=2" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=3" alt="User">
                        <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-xs">+2k</div>
                    </div>
                    <p>Trusted by 2,000+ Eco-Warriors</p>
                </div>
            </div>

            <!-- Hero AI Visual -->
            <div class="relative z-10 perspective-1000">
                <div class="relative rounded-[2rem] bg-slate-900 border-[8px] border-white shadow-2xl overflow-hidden transform rotate-y-[-10deg] rotate-x-[5deg] hover:rotate-y-0 hover:rotate-x-0 transition-transform duration-700 ease-out">
                    <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=1200&q=80" class="w-full h-[500px] object-cover opacity-80" alt="Recycling App">
                    
                    <!-- Fake UI Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                    
                    <!-- AI Detection Box Overlay -->
                    <div class="absolute top-1/3 left-1/4 w-48 h-64 border-4 border-brand-400 rounded-xl bg-brand-400/20 shadow-[0_0_30px_rgba(52,211,153,0.5)] flex items-end animate-pulse-slow">
                        <div class="bg-brand-500 text-white text-xs font-bold px-3 py-1.5 rounded-br-lg rounded-tl-lg flex items-center gap-2">
                            <span>Plastic Bottle</span>
                            <span class="bg-white/20 px-1.5 py-0.5 rounded text-[10px]">98%</span>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-8 left-8 right-8 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 flex justify-between items-center text-white">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-brand-500 rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-300">Analysis Complete</p>
                                <p class="font-bold">+10 Eco-Points Earned</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- IMPACT STATISTICS -->
    <section class="py-12 bg-slate-900 relative z-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-slate-800">
            <div class="text-center px-4">
                <p class="text-4xl font-black text-brand-400 mb-2">1.2M+</p>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Items Scanned</p>
            </div>
            <div class="text-center px-4">
                <p class="text-4xl font-black text-teal-400 mb-2">500k</p>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Kg CO₂ Reduced</p>
            </div>
            <div class="text-center px-4">
                <p class="text-4xl font-black text-blue-400 mb-2">150+</p>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Waste Banks</p>
            </div>
            <div class="text-center px-4">
                <p class="text-4xl font-black text-purple-400 mb-2">99.8%</p>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">AI Accuracy</p>
            </div>
        </div>
    </section>

    <!-- FEATURES SHOWCASE -->
    <section id="features" class="py-24 bg-white relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-brand-600 font-bold tracking-widest uppercase mb-3">Platform Features</h2>
                <h3 class="text-4xl font-black text-slate-900 mb-4">Complete Eco-System</h3>
                <p class="text-slate-500 font-medium text-lg">Everything you need to turn everyday waste into environmental impact and personal rewards.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-brand-600 mb-6 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Realtime AI Scanner</h4>
                    <p class="text-slate-600 leading-relaxed font-medium">Point your camera and let our 60FPS browser-based TensorFlow models instantly classify materials and provide recycling recommendations.</p>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-teal-600 mb-6 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Smart Bank Routing</h4>
                    <p class="text-slate-600 leading-relaxed font-medium">Find the nearest verified Waste Banks based on your exact material types. Get live directions, opening hours, and rating systems.</p>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 mb-3">Advanced Analytics</h4>
                    <p class="text-slate-600 leading-relaxed font-medium">Track your carbon footprint reduction and earn Eco-Points. Visualize your environmental impact with beautiful, real-time interactive charts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- AI ENGINE DEMO SECTION -->
    <section id="ai-tech" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div class="order-2 lg:order-1 relative group">
                <div class="absolute inset-0 bg-brand-400 rounded-3xl rotate-3 scale-105 opacity-20 group-hover:rotate-6 transition-transform"></div>
                <div class="bg-slate-900 rounded-3xl p-2 shadow-2xl relative">
                    <!-- Fake code editor window -->
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-800">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="ml-4 text-xs font-mono text-slate-500">tensorflow-inference.js</span>
                    </div>
                    <div class="p-6 font-mono text-sm">
                        <p class="text-slate-400"><span class="text-pink-400">const</span> <span class="text-blue-300">model</span> = <span class="text-pink-400">await</span> cocoSsd.<span class="text-yellow-200">load</span>();</p>
                        <p class="text-slate-400"><span class="text-pink-400">const</span> <span class="text-blue-300">stream</span> = <span class="text-pink-400">await</span> navigator.mediaDevices.<span class="text-yellow-200">getUserMedia</span>({ video: <span class="text-purple-300">true</span> });</p>
                        <br>
                        <p class="text-slate-400"><span class="text-pink-400">while</span> (<span class="text-purple-300">true</span>) {</p>
                        <p class="text-slate-400 pl-4"><span class="text-pink-400">const</span> <span class="text-blue-300">predictions</span> = <span class="text-pink-400">await</span> model.<span class="text-yellow-200">detect</span>(video);</p>
                        <p class="text-slate-400 pl-4"><span class="text-pink-400">if</span> (predictions[<span class="text-purple-300">0</span>].score > <span class="text-purple-300">0.40</span>) {</p>
                        <p class="text-slate-400 pl-8"><span class="text-yellow-200">drawBoundingBox</span>(predictions);</p>
                        <p class="text-slate-400 pl-8"><span class="text-yellow-200">calculateCarbonReduction</span>();</p>
                        <p class="text-slate-400 pl-4">}</p>
                        <p class="text-slate-400">}</p>
                        
                        <div class="mt-6 p-4 bg-black/50 rounded-lg border border-slate-800">
                            <p class="text-brand-400 animate-pulse">> AI Model Loaded. Inference Time: 12ms.</p>
                            <p class="text-white">> Object Detected: Plastic Bottle (Confidence: 94%)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2 space-y-6">
                <h2 class="text-4xl font-black text-slate-900">Powered by Edge AI</h2>
                <p class="text-lg text-slate-600 font-medium leading-relaxed">
                    We don't send your camera feed to a slow server. WasteWise utilizes TensorFlow.js to run complex Convolutional Neural Networks directly inside your browser.
                </p>
                <ul class="space-y-4 pt-4">
                    <li class="flex items-start gap-3">
                        <div class="mt-1 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0">✓</div>
                        <div>
                            <strong class="text-slate-800">Zero Latency</strong>
                            <p class="text-slate-500 text-sm">60 Frames Per Second processing for instant visual feedback.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-1 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0">✓</div>
                        <div>
                            <strong class="text-slate-800">Total Privacy</strong>
                            <p class="text-slate-500 text-sm">Images are processed locally. Nothing is uploaded until you click Save.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-1 w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0">✓</div>
                        <div>
                            <strong class="text-slate-800">Offline Capable</strong>
                            <p class="text-slate-500 text-sm">Once the model loads, the AI can detect objects even with poor connections.</p>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-brand-900 z-0"></div>
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-brand-500/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center text-white">
            <h2 class="text-4xl md:text-6xl font-black mb-6">Ready to make an impact?</h2>
            <p class="text-xl text-brand-100 font-medium mb-10 max-w-2xl mx-auto">Join thousands of users who are transforming their waste into value while saving the planet. Registration takes less than 30 seconds.</p>
            
            <a href="/register" class="inline-flex justify-center items-center gap-2 px-10 py-5 bg-white text-brand-900 font-black text-lg rounded-2xl hover:scale-105 transition-all shadow-[0_0_40px_rgba(255,255,255,0.3)]">
                Create Free Account
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
            
            <p class="mt-6 text-sm text-brand-200/60">No credit card required. Web application runs directly in browser.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-400 to-teal-500 flex items-center justify-center p-1.5">
                    <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-white" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <span class="text-xl font-black text-slate-800">WasteWise</span>
            </div>
            <p class="text-slate-500 font-medium">© 2026 WasteWise Technologies. Smart Environment Platform.</p>
        </div>
    </footer>
</div>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
.animation-delay-4000 {
    animation-delay: 4s;
}
.perspective-1000 {
    perspective: 1000px;
}
.animate-pulse-slow {
    animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection
