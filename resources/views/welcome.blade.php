<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnQuest - Enterprise AI-Powered Gamified Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --darker: #020617;
            --light: #f8fafc;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glow: 0 0 40px rgba(99, 102, 241, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Manrope', 'Inter', sans-serif;
            background-color: var(--darker);
            color: #e2e8f0;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
            z-index: -2;
            pointer-events: none;
        }

        .noise-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
            z-index: -1;
            pointer-events: none;
        }

        .heading-font {
            font-family: 'Poppins', sans-serif;
            font-weight: 900;
        }

        .section-title {
            background: linear-gradient(135deg, #fff 0%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 
                0 25px 60px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-border {
            position: relative;
            border: 2px solid transparent;
            background: linear-gradient(var(--darker), var(--darker)) padding-box,
                        linear-gradient(135deg, var(--primary), var(--secondary), var(--accent)) border-box;
        }

        .btn-primary {
            position: relative;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 18px 48px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1.1rem;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: var(--glow);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 
                0 20px 50px rgba(99, 102, 241, 0.4),
                var(--glow);
        }

        .btn-primary:active {
            transform: translateY(-2px) scale(1.01);
        }

        .nav-link {
            position: relative;
            padding: 12px 0;
            font-weight: 600;
            color: #cbd5e1;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(-10px) rotate(-1deg); }
        }

        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.05); }
        }

        .typewriter {
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            position: relative;
        }

        .typewriter::after {
            content: '|';
            position: absolute;
            right: 0;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .scroll-indicator {
            width: 24px;
            height: 40px;
            border: 2px solid var(--primary);
            border-radius: 12px;
            position: relative;
        }

        .scroll-indicator::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            width: 4px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            transform: translateX(-50%);
            animation: scroll 2s infinite;
        }

        @keyframes scroll {
            0% { transform: translate(-50%, 0); opacity: 1; }
            100% { transform: translate(-50%, 16px); opacity: 0; }
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
        }

        .splide__slide {
            opacity: 0.7;
            transform: scale(0.95);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .splide__slide.is-active {
            opacity: 1;
            transform: scale(1);
        }

        .toggle-checkbox:checked {
            right: 0;
            border-color: #10b981;
        }

        .toggle-checkbox:checked + .toggle-label {
            background: #10b981;
        }

        /* 3D Card Flip */
        .flip-card {
            perspective: 1500px;
            height: 400px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 24px;
            overflow: hidden;
        }

        .flip-card-back {
            transform: rotateY(180deg);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        /* Glowing orb animation */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.3;
            z-index: -1;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            top: 10%;
            left: 5%;
            animation: orb-move-1 20s infinite alternate ease-in-out;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--secondary) 0%, transparent 70%);
            bottom: 10%;
            right: 10%;
            animation: orb-move-2 25s infinite alternate ease-in-out;
        }

        @keyframes orb-move-1 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 100px) scale(1.2); }
        }

        @keyframes orb-move-2 {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-80px, -80px) scale(1.3); }
        }

        /* Progress ring animation */
        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 2s cubic-bezier(0.4, 0, 0.2, 1);
            stroke-linecap: round;
        }

        /* Text reveal animation */
        .reveal-text {
            position: relative;
            overflow: hidden;
        }

        .reveal-text::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--primary-light), transparent);
            transform: translateX(-100%);
            animation: text-reveal 2s ease-out 0.5s forwards;
        }

        @keyframes text-reveal {
            100% { transform: translateX(100%); }
        }

        /* Holographic effect */
        .holographic {
            position: relative;
            overflow: hidden;
        }

        .holographic::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.1) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            animation: hologram 3s infinite linear;
        }

        @keyframes hologram {
            0% { transform: rotate(30deg) translateX(-100%); }
            100% { transform: rotate(30deg) translateX(100%); }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.8);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, var(--primary-light), var(--accent));
        }

        /* Particle network container */
        #particle-network {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        /* Section entrance animations */
        .section-entrance {
            opacity: 0;
            transform: translateY(60px);
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), 
                        transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .section-entrance.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glitch text effect */
        .glitch-text {
            position: relative;
            display: inline-block;
        }

        .glitch-text::before,
        .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.8;
        }

        .glitch-text::before {
            animation: glitch-1 2s infinite linear alternate-reverse;
            color: #ff00ff;
            z-index: -1;
        }

        .glitch-text::after {
            animation: glitch-2 3s infinite linear alternate-reverse;
            color: #00ffff;
            z-index: -2;
        }

        @keyframes glitch-1 {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }

        @keyframes glitch-2 {
            0% { transform: translate(0); }
            10% { transform: translate(2px, -2px); }
            30% { transform: translate(-2px, 2px); }
            50% { transform: translate(2px, 2px); }
            70% { transform: translate(-2px, -2px); }
            90% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }

        /* Neural network lines */
        .neural-line {
            position: absolute;
            width: 2px;
            background: linear-gradient(to bottom, transparent, var(--primary), transparent);
            z-index: -1;
        }

        .neural-node {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            z-index: -1;
            box-shadow: 0 0 10px var(--primary);
        }
        
        /* Shimmer effect */
        .shimmer {
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        /* Matrix rain effect for neural network */
        .matrix-rain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.3;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 bg-darker z-50 flex flex-col items-center justify-center">
        <div class="relative w-32 h-32 mb-8">
            <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-primary border-r-secondary animate-spin"></div>
            <div class="absolute inset-4 rounded-full border-4 border-transparent border-b-accent border-l-primary-light animate-spin-reverse"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-16 h-16 rounded-xl gradient-bg flex items-center justify-center">
                    <i class="fas fa-brain text-white text-3xl"></i>
                </div>
            </div>
        </div>
        <div class="text-2xl font-bold gradient-text">Initializing LearnQuest AI...</div>
        <div class="w-64 h-2 bg-gray-800 rounded-full mt-8 overflow-hidden">
            <div id="preloader-progress" class="h-full gradient-bg rounded-full" style="width: 0%"></div>
        </div>
    </div>

    <!-- Particle Network Canvas -->
    <canvas id="particle-network"></canvas>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 glass-card py-4 border-b border-glass-border">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl gradient-bg flex items-center justify-center glow pulse-animation">
                        <i class="fas fa-brain text-white text-3xl"></i>
                    </div>
                    <div>
                        <span class="text-3xl font-black heading-font gradient-text">LearnQuest</span>
                        <div class="text-xs text-accent font-bold uppercase tracking-wider mt-1">ENTERPRISE EDITION</div>
                    </div>
                </div>
                
                <div class="hidden lg:flex items-center space-x-12">
                    <a href="#features" class="nav-link text-lg">Features</a>
                    <a href="#how-it-works" class="nav-link text-lg">How It Works</a>
                    <a href="#leaderboard" class="nav-link text-lg">Leaderboard</a>
                    <a href="#enterprise" class="nav-link text-lg">Enterprise</a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <button id="theme-toggle" class="w-12 h-6 rounded-full bg-gray-800 relative">
                        <div id="theme-toggle-circle" class="absolute w-6 h-6 rounded-full bg-white transform transition-transform duration-300"></div>
                    </button>
                    
                    <a href="/login" class="text-lg font-semibold text-gray-300 hover:text-white transition-colors">Sign In</a>
                    <a href="/register" class="btn-primary">
                        <span>Start Now</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <button class="lg:hidden text-2xl text-gray-300" id="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-24 overflow-hidden">
        <!-- Animated background elements -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="section-entrance">
                    <div class="inline-flex items-center px-6 py-3 rounded-full glass-card mb-10 border border-primary/30">
                        <div class="w-8 h-8 rounded-full gradient-bg flex items-center justify-center mr-3">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <span class="font-bold text-white">Next-Gen AI Learning Platform</span>
                    </div>
                    
                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-black heading-font mb-8 leading-tight">
                        <span class="block text-white">Master Skills</span>
                        <span class="block gradient-text typewriter" id="typewriter-text">Through Immersive Play</span>
                    </h1>
                    
                    <p class="text-xl md:text-2xl text-gray-300 mb-12 leading-relaxed">
                        Transform learning into an <span class="font-bold text-primary-light">addictive adventure</span> with AI-powered adaptive quizzes, 
                        real-time global competitions, and neuroscience-backed progress tracking. 
                        Join <span class="font-bold gradient-text">500,000+</span> elite learners worldwide.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-6 mb-16">
                        <a href="#cta" class="btn-primary text-lg">
                            <i class="fas fa-rocket"></i>
                            Register Now
                        </a>
                        <a href="#demo" class="px-10 py-5 rounded-xl glass-card border border-primary/30 text-white font-bold hover:border-primary/50 transition-all flex items-center justify-center">
                            <i class="fas fa-play-circle mr-3 text-accent"></i>
                            Watch Immersive Demo
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-4xl font-black gradient-text mb-2">96%</div>
                            <div class="text-gray-400">Retention Rate</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black gradient-text mb-2">3.8x</div>
                            <div class="text-gray-400">Faster Learning</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-black gradient-text mb-2">99%</div>
                            <div class="text-gray-400">Satisfaction Score</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative section-entrance" style="transition-delay: 0.2s">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-gradient-to-r from-accent/20 to-primary/20 rounded-full blur-3xl"></div>
                    
                    <div class="glass-card rounded-3xl p-8 border border-primary/20 relative overflow-hidden holographic">
                        <div class="flex items-center justify-between mb-10">
                            <div>
                                <h3 class="text-3xl font-black text-white mb-2">AI Learning Dashboard</h3>
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                                    <span class="text-green-400 font-semibold">Neural Network Active</span>
                                </div>
                            </div>
                            <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center shadow-2xl glow">
                                <i class="fas fa-robot text-white text-3xl"></i>
                            </div>
                        </div>
                        
                        <!-- Animated neural network visualization - FIXED: Using canvas -->
                        <div class="relative w-full h-64 mb-10 rounded-2xl overflow-hidden bg-gradient-to-br from-gray-900/50 to-gray-800/50 border border-gray-700/50">
                            <canvas id="neural-visualization" class="w-full h-full"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-6xl font-black gradient-text mb-2">85%</div>
                                <div class="text-gray-400">Mastery Score</div>
                                <div class="text-sm text-gray-500 mt-2">+18% this week</div>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-center justify-between p-5 rounded-2xl bg-gradient-to-r from-primary/10 to-secondary/10 border border-primary/20">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center mr-4 shadow-lg">
                                        <i class="fas fa-fire text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">Learning Streak</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-400">All time best</div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-5 rounded-2xl glass-card border border-gray-700/50">
                                    <div class="text-sm text-gray-400 mb-2">Quizzes Today</div>
                                    <div class="text-3xl font-black text-white">12/15</div>
                                    <div class="w-full h-2 bg-gray-800 rounded-full mt-2 overflow-hidden">
                                        <div class="h-full gradient-bg rounded-full" style="width: 80%"></div>
                                    </div>
                                </div>
                                <div class="p-5 rounded-2xl glass-card border border-gray-700/50">
                                    <div class="text-sm text-gray-400 mb-2">Accuracy</div>
                                    <div class="text-3xl font-black text-white">94%</div>
                                    <div class="w-full h-2 bg-gray-800 rounded-full mt-2 overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-green-500 to-accent rounded-full" style="width: 94%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <div class="scroll-indicator"></div>
        </div>
    </section>

    <!-- Features Section with 3D Cards -->
    <section id="features" class="py-32 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-24 section-entrance">
                <div class="inline-flex items-center px-6 py-3 rounded-full glass-card border border-primary/30 mb-8">
                    <i class="fas fa-star text-accent mr-3"></i>
                    <span class="font-bold text-white">Why Fortune 500 Companies Choose Us</span>
                </div>
                <h2 class="text-6xl font-black heading-font mb-8">
                    <span class="section-title">Revolutionary</span>
                    <span class="block text-white mt-4">Learning Experience</span>
                </h2>
                <p class="text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    We combine cutting-edge AI with neuroscience and gamification to create the most engaging enterprise learning platform ever built.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24">
                <!-- 3D Flip Card 1 -->
                <div class="flip-card section-entrance">
                    <div class="flip-card-inner">
                        <div class="flip-card-front glass-card p-8">
                            <div class="w-24 h-24 rounded-2xl gradient-bg flex items-center justify-center mb-8 mx-auto shadow-xl">
                                <i class="fas fa-brain text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-6">Adaptive AI Tutor</h3>
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                Our AI constantly adapts to your learning style, identifying weaknesses and personalizing content to maximize retention.
                            </p>
                            <div class="inline-flex items-center text-primary-light font-bold">
                                <span>See AI in action</span>
                                <i class="fas fa-arrow-right ml-3"></i>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <h3 class="text-2xl font-black text-white mb-6">Neural Adaptation Engine</h3>
                            <p class="text-gray-300 mb-6 text-center">
                                Real-time adjustment of difficulty and content based on 127+ learning metrics and neural response patterns.
                            </p>
                            <div class="px-6 py-3 bg-primary/20 rounded-full text-primary-light font-bold">
                                <i class="fas fa-microchip mr-2"></i>
                                15ms Response Time
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 3D Flip Card 2 -->
                <div class="flip-card section-entrance" style="transition-delay: 0.1s">
                    <div class="flip-card-inner">
                        <div class="flip-card-front glass-card p-8">
                            <div class="w-24 h-24 rounded-2xl gradient-bg flex items-center justify-center mb-8 mx-auto shadow-xl">
                                <i class="fas fa-trophy text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-6">Dynamic Rewards System</h3>
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                Earn rare NFTs, unlock exclusive content, and collect digital badges that evolve as you progress through your journey.
                            </p>
                            <div class="flex space-x-3 justify-center">
                                <div class="px-4 py-2 bg-gradient-to-r from-yellow-500/20 to-orange-600/20 rounded-full text-yellow-300 font-bold border border-yellow-500/30">Legendary</div>
                                <div class="px-4 py-2 bg-gradient-to-r from-purple-500/20 to-pink-600/20 rounded-full text-purple-300 font-bold border border-purple-500/30">Master</div>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <h3 class="text-2xl font-black text-white mb-6">Blockchain-Powered Achievements</h3>
                            <p class="text-gray-300 mb-6 text-center">
                                Verifiable, transferable credentials stored on blockchain with smart contract rewards and marketplace integration.
                            </p>
                            <div class="px-6 py-3 bg-secondary/20 rounded-full text-secondary-light font-bold">
                                <i class="fab fa-ethereum mr-2"></i>
                                Ethereum & Polygon
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 3D Flip Card 3 -->
                <div class="flip-card section-entrance" style="transition-delay: 0.2s">
                    <div class="flip-card-inner">
                        <div class="flip-card-front glass-card p-8">
                            <div class="w-24 h-24 rounded-2xl gradient-bg flex items-center justify-center mb-8 mx-auto shadow-xl">
                                <i class="fas fa-users text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-6">Quiz</h3>
                            <p class="text-gray-300 mb-6 leading-relaxed">
                                Lorem ipsum dolor sit amet.
                            </p>
                            <div class="flex items-center justify-center">
                                <div class="flex -space-x-3 mr-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary to-secondary border-2 border-darker"></div>
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-accent to-primary border-2 border-darker"></div>
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-secondary to-accent border-2 border-darker"></div>
                                </div>
                                <span class="text-sm text-gray-400">2,500+ live battles</span>
                            </div>
                        </div>
                        <div class="flip-card-back">
                            <h3 class="text-2xl font-black text-white mb-6">Real-Time Competitive Arena</h3>
                            <p class="text-gray-300 mb-6 text-center">
                                Low-latency multiplayer with regional servers, anti-cheat protection, and esports tournament integration.
                            </p>
                            <div class="px-6 py-3 bg-accent/20 rounded-full text-accent font-bold">
                                <i class="fas fa-bolt mr-2"></i>
                                8ms Global Latency
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Advanced Analytics Dashboard Preview -->
            <div class="grid lg:grid-cols-2 gap-16 items-center mt-32">
                <div class="relative section-entrance">
                    <div class="absolute -top-10 -left-10 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>
                    <div class="glass-card rounded-3xl p-10 border border-primary/20 relative overflow-hidden">
                        <div class="flex items-center mb-12">
                            <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center mr-8 shadow-xl">
                                <i class="fas fa-chart-network text-white text-3xl"></i>
                            </div>
                            <div>
                                <h3 class="text-3xl font-black text-white">Learning Analytics</h3>
                                <p class="text-gray-400">Real-time neural insights dashboard</p>
                            </div>
                        </div>
                        
                        <div class="space-y-8">
                            <div>
                                <div class="flex justify-between mb-4">
                                    <span class="text-gray-300 font-semibold">Weekly Progress</span>
                                    <span class="font-black text-white text-xl">+62%</span>
                                </div>
                                <div class="w-full h-4 bg-gray-800/50 rounded-full overflow-hidden">
                                    <div class="h-full gradient-bg rounded-full relative overflow-hidden shimmer"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between mb-4">
                                    <span class="text-gray-300 font-semibold">Skill Mastery</span>
                                    <span class="font-black text-white text-xl">7/12 mastered</span>
                                </div>
                                <div class="w-full h-4 bg-gray-800/50 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-600 rounded-full"></div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-6">
                                <div class="p-5 rounded-2xl bg-gradient-to-br from-primary/10 to-transparent border border-primary/20">
                                    <div class="text-sm text-gray-400 mb-2">Active Neurons</div>
                                    <div class="text-3xl font-black text-white">2.4M</div>
                                </div>
                                <div class="p-5 rounded-2xl bg-gradient-to-br from-accent/10 to-transparent border border-accent/20">
                                    <div class="text-sm text-gray-400 mb-2">Synapses Formed</div>
                                    <div class="text-3xl font-black text-white">18.7M</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="section-entrance" style="transition-delay: 0.2s">
                    <h3 class="text-4xl font-black heading-font mb-8">
                        Data-Driven <span class="gradient-text">Neural Path</span>
                    </h3>
                    <p class="text-gray-300 mb-10 text-xl leading-relaxed">
                        Our platform analyzes <span class="font-bold text-primary-light">millions of neural data points</span> to create the optimal learning path for you. Watch as your knowledge graph expands with each session in real-time 3D visualization.
                    </p>
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500/20 to-emerald-600/20 flex items-center justify-center mr-5 mt-1">
                                <i class="fas fa-check text-green-400"></i>
                            </div>
                            <div>
                                <span class="text-xl font-bold text-white">Personalized difficulty scaling</span>
                                <p class="text-gray-400 mt-2">AI adjusts complexity in real-time based on 42 performance metrics</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500/20 to-cyan-600/20 flex items-center justify-center mr-5 mt-1">
                                <i class="fas fa-check text-blue-400"></i>
                            </div>
                            <div>
                                <span class="text-xl font-bold text-white">Predictive knowledge gaps</span>
                                <p class="text-gray-400 mt-2">Anticipates learning obstacles 3 sessions ahead with 94% accuracy</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500/20 to-pink-600/20 flex items-center justify-center mr-5 mt-1">
                                <i class="fas fa-check text-purple-400"></i>
                            </div>
                            <div>
                                <span class="text-xl font-bold text-white">Optimal review scheduling</span>
                                <p class="text-gray-400 mt-2">Spaced repetition algorithm based on Ebbinghaus forgetting curve</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works - Interactive Timeline -->
    <section id="how-it-works" class="py-32 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary via-secondary to-accent"></div>
        <div class="container mx-auto px-6">
            <div class="text-center mb-24 section-entrance">
                <div class="inline-flex items-center px-6 py-3 rounded-full glass-card border border-green-500/30 mb-8">
                    <i class="fas fa-play-circle text-green-400 mr-3"></i>
                    <span class="font-bold text-white">Start Learning in 4 Steps</span>
                </div>
                <h2 class="text-6xl font-black heading-font mb-8">
                    <span class="section-title">Simple</span>
                    <span class="block text-white mt-4">Yet Revolutionary</span>
                </h2>
                <p class="text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    From beginner to master in weeks, not years. Our streamlined process makes elite expertise accessible to everyone.
                </p>
            </div>
            
            <!-- Interactive Timeline -->
            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-primary via-secondary to-accent hidden lg:block"></div>
                
                <!-- Timeline items -->
                <div class="space-y-24 lg:space-y-0">
                    <!-- Step 1 -->
                    <div class="relative lg:grid lg:grid-cols-2 gap-16 items-center mb-24 section-entrance">
                        <div class="lg:text-right lg:pr-16 mb-12 lg:mb-0">
                            <div class="inline-flex items-center justify-center lg:justify-end w-full mb-8">
                                <div class="w-28 h-28 rounded-3xl gradient-bg flex items-center justify-center text-white text-4xl font-black shadow-2xl glow">
                                    01
                                </div>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-6">AI Neural Assessment</h3>
                            <p class="text-xl text-gray-300 leading-relaxed">
                                Our AI evaluates your current knowledge through adaptive neural assessment and creates a personalized learning blueprint.
                            </p>
                        </div>
                        <div class="relative">
                            <div class="absolute -inset-4 bg-gradient-to-r from-primary/20 to-transparent rounded-3xl blur-xl"></div>
                            <div class="glass-card rounded-3xl p-10 border border-primary/20 relative">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center mr-6">
                                        <i class="fas fa-brain text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-2xl font-black text-white">Neural Mapping Complete</h4>
                                        <p class="text-gray-400">1,247 knowledge nodes identified</p>
                                    </div>
                                </div>
                                <div class="w-full h-48 rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-5xl font-black gradient-text mb-2">87%</div>
                                        <div class="text-gray-400">Initial Knowledge Coverage</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative lg:grid lg:grid-cols-2 gap-16 items-center mb-24 section-entrance" style="transition-delay: 0.1s">
                        <div class="lg:order-2 lg:pl-16 mb-12 lg:mb-0">
                            <div class="inline-flex items-center justify-center lg:justify-start w-full mb-8">
                                <div class="w-28 h-28 rounded-3xl gradient-bg flex items-center justify-center text-white text-4xl font-black shadow-2xl glow">
                                    02
                                </div>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-6">Immersive Learning</h3>
                            <p class="text-xl text-gray-300 leading-relaxed">
                                Dive into interactive 3D modules, live challenges, and AI-powered quizzes that adapt in real-time to your neural responses.
                            </p>
                        </div>
                        <div class="relative lg:order-1">
                            <div class="absolute -inset-4 bg-gradient-to-r from-secondary/20 to-transparent rounded-3xl blur-xl"></div>
                            <div class="glass-card rounded-3xl p-10 border border-secondary/20 relative">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mr-6">
                                        <i class="fas fa-gamepad text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-2xl font-black text-white">Active Learning Session</h4>
                                        <p class="text-gray-400">Difficulty adapting in real-time</p>
                                    </div>
                                </div>
                                <div class="w-full h-48 rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-5xl font-black gradient-text mb-2">12</div>
                                        <div class="text-gray-400">Active Learning Modules</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="relative lg:grid lg:grid-cols-2 gap-16 items-center mb-24 section-entrance" style="transition-delay: 0.2s">
                        <div class="lg:text-right lg:pr-16 mb-12 lg:mb-0">
                            <div class="inline-flex items-center justify-center lg:justify-end w-full mb-8">
                                <div class="w-28 h-28 rounded-3xl gradient-bg flex items-center justify-center text-white text-4xl font-black shadow-2xl glow">
                                    03
                                </div>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-6">Global Competition</h3>
                            <p class="text-xl text-gray-300 leading-relaxed">
                                Join global tournaments, climb real-time leaderboards, and earn verifiable credentials that showcase your expertise.
                            </p>
                        </div>
                        <div class="relative">
                            <div class="absolute -inset-4 bg-gradient-to-r from-accent/20 to-transparent rounded-3xl blur-xl"></div>
                            <div class="glass-card rounded-3xl p-10 border border-accent/20 relative">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mr-6">
                                        <i class="fas fa-trophy text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-2xl font-black text-white">Tournament Arena</h4>
                                        <p class="text-gray-400">Live global competition</p>
                                    </div>
                                </div>
                                <div class="w-full h-48 rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-5xl font-black gradient-text mb-2">#42</div>
                                        <div class="text-gray-400">Global Rank</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="relative lg:grid lg:grid-cols-2 gap-16 items-center section-entrance" style="transition-delay: 0.3s">
                        <div class="lg:order-2 lg:pl-16 mb-12 lg:mb-0">
                            <div class="inline-flex items-center justify-center lg:justify-start w-full mb-8">
                                <div class="w-28 h-28 rounded-3xl gradient-bg flex items-center justify-center text-white text-4xl font-black shadow-2xl glow">
                                    04
                                </div>
                            </div>
                            <h3 class="text-4xl font-black text-white mb-6">Master & Certify</h3>
                            <p class="text-xl text-gray-300 leading-relaxed">
                                Earn blockchain-verified certificates, showcase skills to employers, and unlock advanced career opportunities with our partner network.
                            </p>
                        </div>
                        <div class="relative lg:order-1">
                            <div class="absolute -inset-4 bg-gradient-to-r from-orange-500/20 to-transparent rounded-3xl blur-xl"></div>
                            <div class="glass-card rounded-3xl p-10 border border-orange-500/20 relative">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center mr-6">
                                        <i class="fas fa-certificate text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-2xl font-black text-white">Verifiable Credentials</h4>
                                        <p class="text-gray-400">Blockchain-certified achievements</p>
                                    </div>
                                </div>
                                <div class="w-full h-48 rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-5xl font-black gradient-text mb-2">7</div>
                                        <div class="text-gray-400">Skills Certified</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-32">
                <a href="#cta" class="btn-primary px-16 py-6 text-xl">
                    <i class="fas fa-play mr-4"></i>
                    Launch Your Learning Journey
                </a>
                <p class="text-gray-400 mt-8 text-lg">
                    <i class="fas fa-shield-alt mr-2 text-accent"></i>
                    Join 500,000+ professionals already mastering skills with our enterprise platform
                </p>
            </div>
        </div>
    </section>

    <!-- Enterprise Features Section -->
    <section id="enterprise" class="py-32 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-24 section-entrance">
                <div class="inline-flex items-center px-6 py-3 rounded-full glass-card border border-accent/30 mb-8">
                    <i class="fas fa-building text-accent mr-3"></i>
                    <span class="font-bold text-white">Enterprise-Grade Features</span>
                </div>
                <h2 class="text-6xl font-black heading-font mb-8">
                    <span class="section-title">Built for</span>
                    <span class="block text-white mt-4">Global Organizations</span>
                </h2>
                <p class="text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    Scalable, secure, and compliant learning solutions for the world's most demanding organizations.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-24">
                <div class="glass-card p-8 rounded-3xl border border-gray-700/50 hover:border-primary/50 transition-all duration-500 section-entrance">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500/20 to-cyan-600/20 flex items-center justify-center mb-8">
                        <i class="fas fa-server text-blue-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-6">Global Infrastructure</h3>
                    <p class="text-gray-300 mb-6">Multi-region deployment with 99.99% uptime SLA and edge caching</p>
                    <div class="text-sm text-blue-400 font-bold">AWS • Azure • GCP</div>
                </div>
                
                <div class="glass-card p-8 rounded-3xl border border-gray-700/50 hover:border-primary/50 transition-all duration-500 section-entrance" style="transition-delay: 0.1s">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-green-500/20 to-emerald-600/20 flex items-center justify-center mb-8">
                        <i class="fas fa-shield-alt text-green-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-6">Enterprise Security</h3>
                    <p class="text-gray-300 mb-6">SOC 2 Type II, GDPR, HIPAA compliant with end-to-end encryption</p>
                    <div class="text-sm text-green-400 font-bold">AES-256 • Zero Trust</div>
                </div>
                
                <div class="glass-card p-8 rounded-3xl border border-gray-700/50 hover:border-primary/50 transition-all duration-500 section-entrance" style="transition-delay: 0.2s">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-purple-500/20 to-pink-600/20 flex items-center justify-center mb-8">
                        <i class="fas fa-chart-line text-purple-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-6">Advanced Analytics</h3>
                    <p class="text-gray-300 mb-6">Real-time team insights, predictive analytics, and custom reporting</p>
                    <div class="text-sm text-purple-400 font-bold">API • Webhooks • SIEM</div>
                </div>
                
                <div class="glass-card p-8 rounded-3xl border border-gray-700/50 hover:border-primary/50 transition-all duration-500 section-entrance" style="transition-delay: 0.3s">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-orange-500/20 to-red-600/20 flex items-center justify-center mb-8">
                        <i class="fas fa-users-cog text-orange-400 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-6">Admin Controls</h3>
                    <p class="text-gray-300 mb-6">Centralized management, custom roles, and automated provisioning</p>
                    <div class="text-sm text-orange-400 font-bold">SCIM • SSO • Audit Logs</div>
                </div>
            </div>
            
            <!-- Enterprise Dashboard Preview -->
            <div class="glass-card rounded-3xl p-10 border border-primary/20 overflow-hidden relative section-entrance">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h3 class="text-3xl font-black text-white mb-2">Enterprise Dashboard</h3>
                        <p class="text-gray-400">Real-time organizational learning analytics</p>
                    </div>
                    <div class="px-6 py-3 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-full text-primary-light font-bold border border-primary/30">
                        <i class="fas fa-eye mr-2"></i>
                        Live Preview
                    </div>
                </div>
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50 p-8 h-64">
                            <div class="flex items-center justify-between mb-8">
                                <h4 class="text-xl font-bold text-white">Team Performance Heatmap</h4>
                                <div class="text-sm text-gray-400">Last 30 days</div>
                            </div>
                            <div class="grid grid-cols-5 gap-4">
                                <div class="h-8 rounded-lg bg-gradient-to-r from-green-500/80 to-green-600/80"></div>
                                <div class="h-8 rounded-lg bg-gradient-to-r from-green-400/70 to-green-500/70"></div>
                                <div class="h-8 rounded-lg bg-gradient-to-r from-yellow-500/70 to-yellow-600/70"></div>
                                <div class="h-8 rounded-lg bg-gradient-to-r from-green-500/80 to-green-600/80"></div>
                                <div class="h-8 rounded-lg bg-gradient-to-r from-green-600/90 to-green-700/90"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-8">
                        <div class="p-6 rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50">
                            <div class="text-sm text-gray-400 mb-2">Active Learners</div>
                            <div class="text-4xl font-black text-white">2,847</div>
                            <div class="text-sm text-green-400 mt-2">+12% this month</div>
                        </div>
                        <div class="p-6 rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 border border-gray-700/50">
                            <div class="text-sm text-gray-400 mb-2">Avg. Completion</div>
                            <div class="text-4xl font-black text-white">94%</div>
                            <div class="text-sm text-green-400 mt-2">+8% vs industry</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" class="py-40 relative overflow-hidden">
        <div class="absolute inset-0 gradient-bg"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-white/50 via-white/30 to-transparent"></div>
        
        <!-- Animated particles in CTA -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/3 right-1/4 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-6xl md:text-7xl font-black text-white mb-10 heading-font leading-tight">
                    Ready to Transform
                    <span class="block">Your Organization's Learning?</span>
                </h2>
                
                <p class="text-2xl text-white/80 mb-16 max-w-3xl mx-auto leading-relaxed">
                    Join the future of enterprise education today. Experience the power of AI-driven gamification and see why traditional learning methods are becoming obsolete.
                </p>
                
                <div class="flex flex-col lg:flex-row justify-center items-center gap-8 mb-20">
                    <a href="#" class="bg-white text-darker px-16 py-6 rounded-2xl font-black text-xl hover:bg-gray-100 transition-colors shadow-2xl hover:scale-105 transition-transform flex items-center">
                        <i class="fas fa-rocket mr-4"></i>
                        Start Enterprise Trial
                    </a>
                    <a href="#" class="bg-transparent border-2 border-white text-white px-16 py-6 rounded-2xl font-bold text-xl hover:bg-white/10 transition-colors flex items-center">
                        <i class="fas fa-calendar-alt mr-4"></i>
                        Schedule Executive Demo
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-white/90">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-shield-alt text-2xl mr-4 text-accent"></i>
                        <div>
                            <div class="font-bold">30-Day Enterprise Trial</div>
                            <div class="text-sm opacity-80">Full platform access</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-trophy text-2xl mr-4 text-accent"></i>
                        <div>
                            <div class="font-bold">Dedicated Support</div>
                            <div class="text-sm opacity-80">24/7 enterprise support</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-certificate text-2xl mr-4 text-accent"></i>
                        <div>
                            <div class="font-bold">Custom Implementation</div>
                            <div class="text-sm opacity-80">Tailored to your needs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-darker py-20 border-t border-gray-800/50">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-5 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-4 mb-10">
                        <div class="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center glow">
                            <i class="fas fa-brain text-white text-3xl"></i>
                        </div>
                        <div>
                            <span class="text-3xl font-black heading-font gradient-text">LearnQuest</span>
                            <div class="text-sm text-gray-400 mt-1">Enterprise AI Learning Platform</div>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-10 text-lg leading-relaxed max-w-md">
                        We're on a mission to make expert-level knowledge accessible to everyone through the power of AI, neuroscience, and gamification.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 rounded-xl glass-card border border-gray-700/50 flex items-center justify-center hover:border-primary/50 transition-all hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-xl glass-card border border-gray-700/50 flex items-center justify-center hover:border-primary/50 transition-all hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-xl glass-card border border-gray-700/50 flex items-center justify-center hover:border-primary/50 transition-all hover:scale-110">
                            <i class="fab fa-discord"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-xl glass-card border border-gray-700/50 flex items-center justify-center hover:border-primary/50 transition-all hover:scale-110">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-black text-white mb-8">Platform</h3>
                    <ul class="space-y-4">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Features</a></li>
                        <li><a href="#how-it-works" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">How It Works</a></li>
                        <li><a href="#leaderboard" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Leaderboard</a></li>
                        <li><a href="#enterprise" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Enterprise</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-black text-white mb-8">Resources</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Research</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Case Studies</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">API</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-black text-white mb-8">Company</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 transition-all">Security</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-12 border-t border-gray-800/50 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-6 md:mb-0">&copy; 2026 LearnQuest AI. All rights reserved.</p>
                <div class="flex space-x-8">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">GDPR</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="back-to-top" class="fixed bottom-10 right-10 w-16 h-16 rounded-full gradient-bg text-white shadow-2xl hover:scale-110 transition-transform z-50 hidden items-center justify-center">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>

    <!-- Noise Background -->
    <div class="noise-bg"></div>

    <script>
        // Wait for DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            // Preloader
            const preloader = document.getElementById('preloader');
            const preloaderProgress = document.getElementById('preloader-progress');
            
            // Simulate loading progress
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(progressInterval);
                    setTimeout(() => {
                        preloader.style.opacity = '0';
                        preloader.style.transition = 'opacity 0.5s ease';
                        setTimeout(() => {
                            preloader.style.display = 'none';
                            initApp();
                        }, 500);
                    }, 300);
                }
                preloaderProgress.style.width = `${progress}%`;
            }, 100);

            // Initialize app after preloader
            function initApp() {
                // Theme Toggle
                const themeToggle = document.getElementById('theme-toggle');
                const themeCircle = document.getElementById('theme-toggle-circle');
                
                function setTheme(isDark) {
                    if (isDark) {
                        document.documentElement.style.setProperty('--darker', '#0f172a');
                        document.documentElement.style.setProperty('--glass', 'rgba(255, 255, 255, 0.05)');
                        themeCircle.style.transform = 'translateX(24px)';
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.style.setProperty('--darker', '#f8fafc');
                        document.documentElement.style.setProperty('--glass', 'rgba(0, 0, 0, 0.05)');
                        themeCircle.style.transform = 'translateX(0)';
                        localStorage.setItem('theme', 'light');
                    }
                }
                
                const savedTheme = localStorage.getItem('theme') || 
                                   (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'dark');
                setTheme(savedTheme === 'dark');
                
                themeToggle?.addEventListener('click', () => {
                    const isDark = !(localStorage.getItem('theme') === 'dark');
                    setTheme(isDark);
                });

                // Typewriter Effect
                const typewriterText = document.getElementById('typewriter-text');
                const texts = [
                    "Through Immersive Play",
                    "With AI-Powered Quizzes",
                    "In Global Competitions",
                    "Via Neural Adaptation"
                ];
                let textIndex = 0;
                let charIndex = 0;
                let isDeleting = false;
                let isEnd = false;

                function typeWriter() {
                    const currentText = texts[textIndex];
                    
                    if (isDeleting) {
                        typewriterText.textContent = currentText.substring(0, charIndex - 1);
                        charIndex--;
                    } else {
                        typewriterText.textContent = currentText.substring(0, charIndex + 1);
                        charIndex++;
                    }
                    
                    if (!isDeleting && charIndex === currentText.length) {
                        isEnd = true;
                        setTimeout(() => {
                            isDeleting = true;
                            typeWriter();
                        }, 2000);
                        return;
                    }
                    
                    if (isDeleting && charIndex === 0) {
                        isDeleting = false;
                        textIndex = (textIndex + 1) % texts.length;
                    }
                    
                    const speed = isDeleting ? 50 : isEnd ? 100 : 100;
                    setTimeout(typeWriter, speed);
                }
                
                setTimeout(typeWriter, 1000);

                // Particle Network
                const canvas = document.getElementById('particle-network');
                const ctx = canvas.getContext('2d');
                let particles = [];
                let mouse = { x: null, y: null, radius: 100 };

                function resizeCanvas() {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                }

                function createParticles() {
                    particles = [];
                    const particleCount = Math.min(100, Math.floor((canvas.width * canvas.height) / 15000));
                    
                    for (let i = 0; i < particleCount; i++) {
                        particles.push({
                            x: Math.random() * canvas.width,
                            y: Math.random() * canvas.height,
                            size: Math.random() * 2 + 0.5,
                            speedX: Math.random() * 0.5 - 0.25,
                            speedY: Math.random() * 0.5 - 0.25,
                            color: `rgba(${Math.floor(Math.random() * 100 + 155)}, ${Math.floor(Math.random() * 100 + 155)}, 255, ${Math.random() * 0.5 + 0.2})`
                        });
                    }
                }

                function drawParticles() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    // Update and draw particles
                    for (let i = 0; i < particles.length; i++) {
                        let p = particles[i];
                        
                        // Update position
                        p.x += p.speedX;
                        p.y += p.speedY;
                        
                        // Bounce off walls
                        if (p.x > canvas.width || p.x < 0) p.speedX = -p.speedX;
                        if (p.y > canvas.height || p.y < 0) p.speedY = -p.speedY;
                        
                        // Draw particle
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                        ctx.fillStyle = p.color;
                        ctx.fill();
                        
                        // Draw connections
                        for (let j = i + 1; j < particles.length; j++) {
                            let p2 = particles[j];
                            let dx = p.x - p2.x;
                            let dy = p.y - p2.y;
                            let distance = Math.sqrt(dx * dx + dy * dy);
                            
                            if (distance < 100) {
                                ctx.beginPath();
                                ctx.strokeStyle = `rgba(100, 100, 255, ${0.2 * (1 - distance/100)})`;
                                ctx.lineWidth = 0.5;
                                ctx.moveTo(p.x, p.y);
                                ctx.lineTo(p2.x, p2.y);
                                ctx.stroke();
                            }
                        }
                        
                        // Mouse interaction
                        if (mouse.x !== null && mouse.y !== null) {
                            let dx = mouse.x - p.x;
                            let dy = mouse.y - p.y;
                            let distance = Math.sqrt(dx * dx + dy * dy);
                            
                            if (distance < mouse.radius) {
                                let force = (mouse.radius - distance) / mouse.radius;
                                let forceX = dx / distance * force * 5;
                                let forceY = dy / distance * force * 5;
                                
                                p.x -= forceX;
                                p.y -= forceY;
                            }
                        }
                    }
                    
                    requestAnimationFrame(drawParticles);
                }

                // Initialize particle network
                resizeCanvas();
                createParticles();
                drawParticles();
                
                window.addEventListener('resize', () => {
                    resizeCanvas();
                    createParticles();
                });
                
                canvas.addEventListener('mousemove', (e) => {
                    mouse.x = e.x;
                    mouse.y = e.y;
                });
                
                canvas.addEventListener('mouseleave', () => {
                    mouse.x = null;
                    mouse.y = null;
                });

                // Neural network visualization - FIXED: Now using canvas
                const neuralCanvas = document.getElementById('neural-visualization');
                if (neuralCanvas && neuralCanvas.getContext) {
                    const neuralCtx = neuralCanvas.getContext('2d');
                    let animationId;
                    
                    function resizeNeuralCanvas() {
                        const container = neuralCanvas.parentElement;
                        neuralCanvas.width = container.clientWidth;
                        neuralCanvas.height = container.clientHeight;
                    }
                    
                    function drawNeuralNetwork() {
                        resizeNeuralCanvas();
                        
                        neuralCtx.clearRect(0, 0, neuralCanvas.width, neuralCanvas.height);
                        
                        // Draw neural network
                        const layers = 5;
                        const neuronsPerLayer = [3, 5, 8, 5, 3];
                        const neuronPositions = [];
                        
                        // Calculate neuron positions
                        for (let l = 0; l < layers; l++) {
                            neuronPositions[l] = [];
                            const x = (l + 1) * neuralCanvas.width / (layers + 1);
                            
                            for (let n = 0; n < neuronsPerLayer[l]; n++) {
                                const y = (n + 1) * neuralCanvas.height / (neuronsPerLayer[l] + 1);
                                neuronPositions[l][n] = { x, y };
                            }
                        }
                        
                        // Draw connections
                        neuralCtx.strokeStyle = 'rgba(99, 102, 241, 0.1)';
                        neuralCtx.lineWidth = 1;
                        
                        for (let l = 0; l < layers - 1; l++) {
                            for (let n1 = 0; n1 < neuronPositions[l].length; n1++) {
                                for (let n2 = 0; n2 < neuronPositions[l + 1].length; n2++) {
                                    // Randomly activate some connections
                                    if (Math.random() > 0.7) {
                                        neuralCtx.beginPath();
                                        neuralCtx.moveTo(neuronPositions[l][n1].x, neuronPositions[l][n1].y);
                                        neuralCtx.lineTo(neuronPositions[l + 1][n2].x, neuronPositions[l + 1][n2].y);
                                        neuralCtx.stroke();
                                    }
                                }
                            }
                        }
                        
                        // Draw neurons
                        for (let l = 0; l < layers; l++) {
                            for (let n = 0; n < neuronPositions[l].length; n++) {
                                const pos = neuronPositions[l][n];
                                const gradient = neuralCtx.createRadialGradient(
                                    pos.x, pos.y, 0,
                                    pos.x, pos.y, 8
                                );
                                
                                if (l === 2) { // Middle layer (most active)
                                    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
                                    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.1)');
                                } else {
                                    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.6)');
                                    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');
                                }
                                
                                neuralCtx.beginPath();
                                neuralCtx.arc(pos.x, pos.y, 6, 0, Math.PI * 2);
                                neuralCtx.fillStyle = gradient;
                                neuralCtx.fill();
                                
                                // Pulsing effect for some neurons
                                if (Math.random() > 0.8) {
                                    neuralCtx.beginPath();
                                    neuralCtx.arc(pos.x, pos.y, 10, 0, Math.PI * 2);
                                    neuralCtx.strokeStyle = 'rgba(99, 102, 241, 0.3)';
                                    neuralCtx.lineWidth = 1;
                                    neuralCtx.stroke();
                                }
                            }
                        }
                        
                        // Continue the animation loop
                        animationId = requestAnimationFrame(drawNeuralNetwork);
                    }
                    
                    // Start the animation
                    drawNeuralNetwork();
                    
                    // Handle window resize
                    window.addEventListener('resize', () => {
                        cancelAnimationFrame(animationId);
                        drawNeuralNetwork();
                    });
                }

                // Scroll animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -100px 0px'
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, observerOptions);
                
                document.querySelectorAll('.section-entrance').forEach(el => {
                    observer.observe(el);
                });

                // Back to Top Button
                const backToTopBtn = document.getElementById('back-to-top');
                
                window.addEventListener('scroll', () => {
                    if (window.pageYOffset > 500) {
                        backToTopBtn.style.display = 'flex';
                    } else {
                        backToTopBtn.style.display = 'none';
                    }
                });
                
                backToTopBtn?.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });

                // Smooth scrolling for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return;
                        
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 100,
                                behavior: 'smooth'
                            });
                        }
                    });
                });

                // Add floating particles on click
                document.addEventListener('click', (e) => {
                    for (let i = 0; i < 5; i++) {
                        createFloatingParticle(e.clientX, e.clientY);
                    }
                });

                function createFloatingParticle(x, y) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = x + 'px';
                    particle.style.top = y + 'px';
                    particle.style.width = Math.random() * 20 + 5 + 'px';
                    particle.style.height = particle.style.width;
                    particle.style.background = `radial-gradient(circle, 
                        rgba(${Math.floor(Math.random() * 100 + 155)}, 
                        ${Math.floor(Math.random() * 100 + 155)}, 
                        255, 0.8) 0%, transparent 70%)`;
                    
                    document.body.appendChild(particle);
                    
                    // Animate particle
                    const duration = 1000 + Math.random() * 1000;
                    const angle = Math.random() * Math.PI * 2;
                    const distance = 50 + Math.random() * 100;
                    
                    const animation = particle.animate([
                        { 
                            transform: 'translate(0, 0) scale(1)', 
                            opacity: 1 
                        },
                        { 
                            transform: `translate(${Math.cos(angle) * distance}px, ${Math.sin(angle) * distance}px) scale(0)`, 
                            opacity: 0 
                        }
                    ], {
                        duration: duration,
                        easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
                    });
                    
                    animation.onfinish = () => particle.remove();
                }

                // Add shimmer effect to buttons
                document.querySelectorAll('.btn-primary').forEach(btn => {
                    btn.addEventListener('mouseenter', function() {
                        this.style.boxShadow = '0 20px 60px rgba(99, 102, 241, 0.5), 0 0 40px rgba(99, 102, 241, 0.3)';
                    });
                    
                    btn.addEventListener('mouseleave', function() {
                        this.style.boxShadow = '0 0 40px rgba(99, 102, 241, 0.3)';
                    });
                });

                // Add random glitch effect to headings
                setInterval(() => {
                    if (Math.random() > 0.9) {
                        const headings = document.querySelectorAll('h1, h2, h3');
                        const randomHeading = headings[Math.floor(Math.random() * headings.length)];
                        
                        randomHeading.classList.add('glitch-text');
                        setTimeout(() => {
                            randomHeading.classList.remove('glitch-text');
                        }, 300);
                    }
                }, 3000);

                // Progress ring animations
                const progressCircles = document.querySelectorAll('.progress-ring-circle');
                progressCircles.forEach(circle => {
                    const progress = circle.getAttribute('data-progress') || 85;
                    const offset = 283 - (283 * progress / 100);
                    circle.style.strokeDashoffset = offset;
                });

                console.log('LearnQuest Enterprise Edition initialized successfully.');
                console.log('Particle network: Active');
                console.log('Neural visualization: Active');
                console.log('3D animations: Enabled');
                console.log('Enterprise features: Loaded');
            }
        });
    </script>
</body>
</html>