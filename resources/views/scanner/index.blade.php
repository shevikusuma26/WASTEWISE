@extends('layouts.dashboard')

@section('page_title', 'Realtime AI Smart Scanner')

@section('dashboard_content')
<!-- TensorFlow.js and COCO-SSD via CDN -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-5xl mx-auto space-y-6 relative">
    <div class="glass-card rounded-2xl p-6 text-center">
        <h2 class="text-3xl font-black text-slate-800 mb-2">Live AI Detection Engine</h2>
        <p class="text-slate-500 mb-6">Point your camera at waste items. Our Convolutional Neural Network processes frames in real-time to detect multiple objects.</p>
        
        <div class="relative max-w-3xl mx-auto rounded-2xl overflow-hidden shadow-2xl bg-slate-900 border-4 border-slate-800 group">
            
            <!-- Live Status HUD Overlay -->
            <div class="absolute top-4 left-4 z-40 bg-slate-900/80 backdrop-blur-md px-4 py-2 rounded-xl border border-slate-700/50 flex items-center gap-3 shadow-lg">
                <div class="relative flex h-3 w-3">
                    <span id="status-ping" class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-yellow-400"></span>
                    <span id="status-dot" class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">AI Status</p>
                    <p id="status-text" class="text-sm font-bold text-white transition-all">Loading AI Model...</p>
                </div>
            </div>

            <!-- FPS Counter & Processing Indicator -->
            <div class="absolute top-4 right-4 z-40 bg-slate-900/80 backdrop-blur-md px-3 py-1.5 rounded-lg border border-slate-700/50 flex flex-col items-end shadow-lg">
                <div class="text-xs font-bold text-slate-400">FPS: <span id="fps-counter" class="text-brand-400 font-mono">0</span></div>
                <div class="text-[10px] text-slate-500 font-medium">Inference: <span id="inference-counter" class="text-blue-400 font-mono">0ms</span></div>
            </div>

            <!-- Camera Container -->
            <div class="relative aspect-[4/3] sm:aspect-video w-full bg-slate-900 rounded-xl overflow-hidden">
                <video id="video" class="absolute inset-0 w-full h-full object-cover z-10 block" autoplay playsinline muted></video>
                <canvas id="canvas" class="absolute inset-0 w-full h-full object-cover z-20 pointer-events-none"></canvas>
                
                <div id="loading-overlay" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900/90 backdrop-blur-md z-30 transition-opacity">
                    <div class="relative w-20 h-20 mb-6">
                        <div class="absolute inset-0 border-4 border-slate-700 rounded-full"></div>
                        <div class="absolute inset-0 border-4 border-brand-500 border-t-transparent rounded-full animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-8 h-8 text-brand-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <p class="text-white font-bold text-xl animate-pulse tracking-wide">Loading AI Model...</p>
                    <p class="text-brand-400 text-sm mt-2 font-medium">Downloading TensorFlow Neural Weights</p>
                </div>
            </div>
            
            <div class="bg-slate-900 p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-800 relative z-30">
                <button id="save-btn" disabled class="w-full sm:w-auto px-8 py-3 rounded-xl font-black text-white bg-gradient-to-r from-brand-500 to-teal-500 hover:scale-[1.02] shadow-xl shadow-brand-500/20 transition-all flex justify-center items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Save Detection</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FULLSCREEN AI ANALYTICS MODAL -->
<div id="analysis-modal" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity"></div>
    
    <!-- Modal Content -->
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-5xl max-h-[95vh] overflow-y-auto shadow-[0_0_50px_rgba(34,197,94,0.3)] relative animate-fade-in-up">
            
            <!-- Header -->
            <div class="sticky top-0 bg-white/90 backdrop-blur border-b border-slate-100 px-6 py-4 flex justify-between items-center z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-slate-800">AI Waste Analysis Result</h2>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    
                    <!-- Left Col: Image & Top Stats -->
                    <div class="lg:col-span-5 space-y-6">
                        <!-- Captured Image -->
                        <div class="relative rounded-2xl overflow-hidden shadow-lg border-4 border-slate-50 aspect-square sm:aspect-video lg:aspect-square bg-slate-100">
                            <img id="modal-image" src="" class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute top-4 right-4 bg-brand-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Saved
                            </div>
                        </div>
                        
                        <!-- Top Stat Card -->
                        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500 rounded-full blur-3xl opacity-20 -mr-10 -mt-10"></div>
                            
                            <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Primary Object</p>
                            <h3 id="modal-primary-object" class="text-3xl font-black mb-4 capitalize">Bottle</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm font-bold mb-1">
                                        <span class="text-slate-300">AI Confidence</span>
                                        <span id="modal-confidence-text" class="text-brand-400">94%</span>
                                    </div>
                                    <div class="w-full bg-slate-700 rounded-full h-2">
                                        <div id="modal-confidence-bar" class="bg-brand-500 h-2 rounded-full transition-all duration-1000" style="width: 0%"></div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-700/50">
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">Material</p>
                                        <p id="modal-material" class="font-bold text-white">Plastic Waste</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">Objects Detected</p>
                                        <p id="modal-total-objects" class="font-bold text-white">1 Items</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Col: Deep Analysis -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- AI Summary Paragraph -->
                        <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-6 relative overflow-hidden">
                            <div class="absolute top-4 right-4 text-blue-200">
                                <svg class="w-24 h-24 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                            </div>
                            <h4 class="text-lg font-black text-blue-900 mb-3 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                                AI Analysis Summary
                            </h4>
                            <p id="modal-recommendation" class="text-blue-800 leading-relaxed font-medium relative z-10">
                                AI mendeteksi objek...
                            </p>
                        </div>
                        
                        <!-- Sustainability Impact Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Recyclability -->
                            <div class="border border-slate-200 rounded-2xl p-5 hover:shadow-md transition-shadow">
                                <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-500 uppercase">Recyclable Status</p>
                                <p id="modal-recyclable-status" class="text-xl font-black text-slate-800">Highly Recyclable</p>
                            </div>
                            
                            <!-- Environmental Impact -->
                            <div class="border border-slate-200 rounded-2xl p-5 hover:shadow-md transition-shadow">
                                <div class="w-12 h-12 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-500 uppercase">Est. Carbon Reduction</p>
                                <p class="text-xl font-black text-slate-800"><span id="modal-carbon">0</span> kg CO₂</p>
                            </div>
                        </div>

                        <!-- Eco-Points Reward -->
                        <div class="bg-gradient-to-r from-emerald-400 to-teal-500 rounded-2xl p-6 text-white shadow-lg flex items-center justify-between">
                            <div>
                                <p class="text-emerald-100 font-bold text-sm uppercase tracking-wider mb-1">Reward Earned</p>
                                <h4 class="text-2xl font-black">+<span id="modal-points-earned">10</span> Eco-Points</h4>
                            </div>
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/30">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                        
                        <div class="flex gap-4 pt-4">
                            <a href="{{ route('dashboard.user') }}" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold py-3 rounded-xl transition-colors">Go to Dashboard</a>
                            <button onclick="closeModal()" class="flex-1 text-center bg-brand-500 hover:bg-brand-600 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-brand-500/30">Scan Again</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.animate-fade-in-up {
    animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>

<script>
// Real Vanilla JS Implementation for True Realtime Computer Vision
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const loadingOverlay = document.getElementById('loading-overlay');
const statusText = document.getElementById('status-text');
const statusPing = document.getElementById('status-ping');
const statusDot = document.getElementById('status-dot');
const fpsCounter = document.getElementById('fps-counter');
const inferenceCounter = document.getElementById('inference-counter');
const saveBtn = document.getElementById('save-btn');

let frames = 0;
let lastTime = performance.now();
let latestDetections = [];
let isProcessing = false;

const wasteMapping = {
    'bottle': 'Plastic Waste', 'cup': 'Plastic Waste', 'wine glass': 'Glass Waste', 'bowl': 'Plastic Waste',
    'cell phone': 'E-Waste', 'laptop': 'E-Waste', 'tv': 'E-Waste', 'mouse': 'E-Waste', 'keyboard': 'E-Waste',
    'book': 'Paper Waste', 'paper': 'Paper Waste', 'cardboard': 'Paper Waste',
    'apple': 'Organic Waste', 'banana': 'Organic Waste', 'orange': 'Organic Waste', 'broccoli': 'Organic Waste', 'carrot': 'Organic Waste',
    'fork': 'Metal Waste', 'knife': 'Metal Waste', 'spoon': 'Metal Waste', 'can': 'Metal Waste'
};

async function setupCamera() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: 'environment' },
            audio: false
        });

        video.srcObject = stream;

        return new Promise((resolve) => {
            video.onloadedmetadata = () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                resolve(video);
            };
        });
    } catch (e) {
        statusText.innerText = "Camera access required for realtime AI detection.";
        alert("Camera access required for realtime AI detection.");
        console.error(e);
    }
}

async function startDetection() {
    try {
        const model = await cocoSsd.load();
        
        console.log("AI MODEL LOADED");
        loadingOverlay.style.display = 'none';
        statusText.innerText = "Realtime AI Detection Active.";

        async function detectFrame() {
            if (isProcessing) {
                requestAnimationFrame(detectFrame);
                return;
            }

            if (canvas.width !== video.videoWidth || canvas.height !== video.videoHeight) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
            }

            const startInference = performance.now();
            const predictions = await model.detect(video);
            const inferenceTime = Math.round(performance.now() - startInference);

            if (frames % 60 === 0 && predictions.length > 0) {
                console.log("AI Predictions:", predictions);
            }

            drawPredictions(predictions, inferenceTime);

            requestAnimationFrame(detectFrame);
        }

        detectFrame();
    } catch (error) {
        statusText.innerText = "AI Model failed to load.";
        console.error("Failed to load model", error);
    }
}

function drawPredictions(predictions, inferenceTime) {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    frames++;
    const now = performance.now();
    if (now - lastTime >= 1000) {
        fpsCounter.innerText = frames;
        frames = 0;
        lastTime = now;
    }
    inferenceCounter.innerText = inferenceTime + 'ms';

    const relevantDetections = predictions.filter(p => p.score > 0.40);
    latestDetections = relevantDetections;

    if (relevantDetections.length > 0) {
        statusPing.className = "animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-green-400";
        statusDot.className = "relative inline-flex rounded-full h-3 w-3 bg-green-500";
        
        const topDet = relevantDetections[0];
        const category = wasteMapping[topDet.class] || 'Waste';
        statusText.innerText = `${topDet.class.toUpperCase()} Detected — Confidence ${Math.round(topDet.score * 100)}%`;
        saveBtn.disabled = false;
        
        relevantDetections.forEach(det => {
            const [x, y, width, height] = det.bbox;
            const mappedCat = wasteMapping[det.class] || det.class;
            const text = `${mappedCat} - ${Math.round(det.score * 100)}%`;
            
            ctx.strokeStyle = '#22C55E';
            ctx.lineWidth = 4;
            ctx.strokeRect(x, y, width, height);
            
            ctx.fillStyle = 'rgba(34, 197, 94, 0.2)';
            ctx.fillRect(x, y, width, height);
            
            ctx.fillStyle = '#22C55E';
            ctx.font = 'bold 16px Arial';
            const textWidth = ctx.measureText(text).width;
            ctx.fillRect(x, y - 30, textWidth + 20, 30);
            
            ctx.fillStyle = '#FFFFFF';
            ctx.fillText(text, x + 10, y - 10);
        });
    } else {
        statusPing.className = "animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-yellow-400";
        statusDot.className = "relative inline-flex rounded-full h-3 w-3 bg-yellow-500";
        statusText.innerText = "Scanning recyclable objects...";
        saveBtn.disabled = true;
    }
}

setupCamera().then(() => {
    video.play();
    startDetection();
});

// Modal Logic
function openModal(data, imageUrl) {
    document.getElementById('analysis-modal').classList.remove('hidden');
    document.getElementById('modal-image').src = imageUrl;
    
    document.getElementById('modal-primary-object').innerText = data.scan.scan_result;
    document.getElementById('modal-confidence-text').innerText = data.scan.confidence_score + '%';
    
    // Animate Bar
    setTimeout(() => {
        document.getElementById('modal-confidence-bar').style.width = data.scan.confidence_score + '%';
    }, 100);

    document.getElementById('modal-material').innerText = data.category;
    document.getElementById('modal-total-objects').innerText = data.total_objects + ' Items';
    document.getElementById('modal-recommendation').innerText = data.scan.recommendation;
    document.getElementById('modal-recyclable-status').innerText = data.recyclable_status;
    document.getElementById('modal-carbon').innerText = data.carbon_reduction;
    document.getElementById('modal-points-earned').innerText = data.eco_points_earned;
}

function closeModal() {
    document.getElementById('analysis-modal').classList.add('hidden');
    document.getElementById('modal-confidence-bar').style.width = '0%';
    isProcessing = false; // Resume TF.js
}

saveBtn.addEventListener('click', async () => {
    if (latestDetections.length === 0) return;
    
    isProcessing = true; // Pause TF.js inference while saving
    saveBtn.disabled = true;
    const oldText = saveBtn.innerHTML;
    saveBtn.innerHTML = `<svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span>Processing AI Data...</span>`;
    
    // Extract exact predictions to send to backend!
    const predictionsJSON = JSON.stringify(latestDetections);
    
    canvas.toBlob(async (blob) => {
        // Create a visual URL for immediate modal rendering
        const imageUrl = URL.createObjectURL(blob);
        
        const formData = new FormData();
        formData.append('image', blob, 'realtime-scan.jpg');
        formData.append('predictions', predictionsJSON); // <-- Sent to Backend!
        
        const token = localStorage.getItem('token');
        try {
            const res = await fetch('/api/classify', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' },
                body: formData
            });
            const data = await res.json();
            
            if (res.ok) {
                // Trigger global points update
                window.dispatchEvent(new CustomEvent('points-updated', { detail: data.total_points }));
                
                // OPEN THE NEW ANALYTICS MODAL
                openModal(data, imageUrl);
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'Failed to analyze.'});
                isProcessing = false;
            }
        } catch(e) {
            console.error(e);
            Swal.fire({ icon: 'error', title: 'Network Error', text: 'Failed to connect to backend.'});
            isProcessing = false;
        } finally {
            saveBtn.disabled = false;
            saveBtn.innerHTML = oldText;
        }
    }, 'image/jpeg');
});
</script>
@endsection
