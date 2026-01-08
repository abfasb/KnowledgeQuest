<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnQuest - AI-Powered Gamified Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #7209b7;
            --accent: #4cc9f0;
            --success: #4ade80;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--gray-900);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.dark-mode {
            background-color: var(--dark);
            color: var(--gray-100);
        }

        .heading-font {
            font-family: 'Poppins', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark-mode .glass-card {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-bg-alt {
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #4361ee 0%, #7209b7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: var(--primary-light);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        .dark-mode .stat-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 16px 40px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn-primary:hover::after {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(67, 97, 238, 0.3);
        }

        .nav-link {
            position: relative;
            padding: 8px 0;
            font-weight: 600;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #4361ee20 0%, #7209b720 100%);
        }

        .dark-mode .feature-icon {
            background: linear-gradient(135deg, #4361ee40 0%, #7209b740 100%);
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .floating-animation {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .typewriter {
            overflow: hidden;
            border-right: 3px solid var(--primary);
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--primary) }
        }

        .scroll-indicator {
            width: 30px;
            height: 50px;
            border: 2px solid var(--primary);
            border-radius: 15px;
            position: relative;
        }

        .scroll-indicator::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            transform: translateX(-50%);
            animation: scroll 2s infinite;
        }

        @keyframes scroll {
            0% { transform: translate(-50%, 0); opacity: 1; }
            100% { transform: translate(-50%, 20px); opacity: 0; }
        }

        .glow {
            filter: drop-shadow(0 0 20px rgba(67, 97, 238, 0.5));
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
            pointer-events: none;
            opacity: 0.5;
        }

        .splide__slide {
            opacity: 0.7;
            transform: scale(0.9);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .splide__slide.is-active {
            opacity: 1;
            transform: scale(1);
        }

        .toggle-checkbox:checked {
            right: 0;
            border-color: #68d391;
        }

        .toggle-checkbox:checked + .toggle-label {
            background: #68d391;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass-card shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center glow">
                        <i class="fas fa-brain text-white text-2xl"></i>
                    </div>
                    <span class="text-3xl font-black heading-font gradient-text">LearnQuest</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-10">
                    <a href="#features" class="nav-link text-gray-700 dark:text-gray-200">Features</a>
                    <a href="#how-it-works" class="nav-link text-gray-700 dark:text-gray-200">How It Works</a>
                    <a href="#leaderboard" class="nav-link text-gray-700 dark:text-gray-200">Leaderboard</a>
                    <a href="#pricing" class="nav-link text-gray-700 dark:text-gray-200">Pricing</a>
                    
                    <div class="flex items-center space-x-6">
                        
                        <a href="/login" class="text-gray-700 dark:text-gray-200 font-semibold hover:text-primary transition-colors">Sign In</a>
                        <a href="/register" class="btn-primary shadow-lg">Get Started Free</a>
                    </div>
                </div>
                
                <button class="md:hidden text-gray-700 dark:text-gray-200 text-2xl" id="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="md:hidden fixed inset-0 bg-white dark:bg-gray-900 z-40 transform -translate-x-full transition-transform duration-300" id="mobile-menu">
        <div class="p-6">
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center">
                        <i class="fas fa-brain text-white"></i>
                    </div>
                    <span class="text-2xl font-black heading-font gradient-text">LearnQuest</span>
                </div>
                <button id="close-menu" class="text-3xl">&times;</button>
            </div>
            
            <div class="space-y-8">
                <a href="#features" class="block text-2xl font-bold text-gray-800 dark:text-white">Features</a>
                <a href="#how-it-works" class="block text-2xl font-bold text-gray-800 dark:text-white">How It Works</a>
                <a href="#leaderboard" class="block text-2xl font-bold text-gray-800 dark:text-white">Leaderboard</a>
                <a href="#pricing" class="block text-2xl font-bold text-gray-800 dark:text-white">Pricing</a>
                <a href="#testimonials" class="block text-2xl font-bold text-gray-800 dark:text-white">Success Stories</a>
                
                <div class="pt-8 border-t dark:border-gray-700">
                    <div class="flex items-center justify-between mb-8">
                        <span class="text-lg font-semibold dark:text-white">Dark Mode</span>
                        <button id="mobile-theme-toggle" class="w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-700 relative">
                            <div class="absolute w-6 h-6 rounded-full bg-white dark:bg-gray-300 transform transition-transform duration-300"></div>
                        </button>
                    </div>
                    
                    <a href="/login" class="block text-lg font-semibold text-gray-800 dark:text-white mb-4">Sign In</a>
                    <a href="/register" class="btn-primary w-full text-center">Get Started Free</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="relative overflow-hidden py-20 md:py-20">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-purple-50/50 dark:from-gray-900 dark:to-gray-800"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-300/30 dark:bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-300/30 dark:bg-purple-500/10 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-1/2 mb-16 lg:mb-0">
                    <div class="inline-flex items-center px-5 py-3 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 text-blue-700 dark:text-blue-300 font-bold mb-8 border border-blue-200 dark:border-blue-800">
                        <i class="fas fa-bolt mr-3"></i>
                        AI-Powered Learning Platform
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black heading-font mb-8 leading-tight">
                        Master Skills
                        <span class="block gradient-text typewriter">
                            Through Play
                        </span>
                    </h1>
                    
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-10 leading-relaxed">
                        Transform learning into an addictive adventure with AI-powered quizzes, 
                        real-time competitions, and personalized progress tracking. 
                        Join <span class="font-bold text-primary dark:text-accent">250,000+</span> learners worldwide.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-6 mb-16">
                        <a href="#cta" class="btn-primary text-center text-lg shadow-xl">
                            Start 30-Day Free Trial
                            <i class="ml-3 fas fa-arrow-right animate-pulse"></i>
                        </a>
                        <a href="#demo" class="px-8 py-4 rounded-xl border-2 border-primary dark:border-accent text-primary dark:text-accent font-bold hover:bg-primary/5 dark:hover:bg-accent/5 transition-colors text-center">
                            <i class="fas fa-play-circle mr-3"></i>
                            Watch 2-Min Demo
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-black gradient-text mb-2">94%</div>
                            <div class="text-gray-600 dark:text-gray-400">Retention Rate</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black gradient-text mb-2">3.2x</div>
                            <div class="text-gray-600 dark:text-gray-400">Faster Learning</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-black gradient-text mb-2">98%</div>
                            <div class="text-gray-600 dark:text-gray-400">Satisfaction Score</div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 lg:pl-16 relative">
                    <div class="relative floating-animation">
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full opacity-20 blur-xl"></div>
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full opacity-20 blur-xl"></div>
                        
                        <div class="glass-card rounded-3xl p-8 shadow-2xl relative z-10">
                            <div class="flex items-center justify-between mb-10">
                                <div>
                                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2">AI Learning Dashboard</h3>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                                        <span class="text-green-600 dark:text-green-400 font-semibold">Active Session</span>
                                    </div>
                                </div>
                                <div class="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center shadow-lg">
                                    <i class="fas fa-robot text-white text-2xl"></i>
                                </div>
                            </div>
                            
                            <div class="relative w-64 h-64 mx-auto mb-10">
                                <svg class="progress-ring w-64 h-64" width="256" height="256">
                                    <circle class="stroke-gray-200 dark:stroke-gray-700" stroke-width="12" fill="transparent" r="110" cx="128" cy="128"/>
                                    <circle class="progress-ring-circle stroke-gradient-to-r from-blue-500 to-purple-500" stroke-width="12" fill="transparent" r="110" cx="128" cy="128" stroke-dashoffset="691" data-progress="85"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <div class="text-5xl font-black gradient-text mb-2">85%</div>
                                    <div class="text-gray-600 dark:text-gray-400">Mastery Score</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-500 mt-2">+12% this week</div>
                                </div>
                            </div>
                            
                            <div class="space-y-6">
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-800 dark:to-gray-800 rounded-2xl">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center mr-4">
                                            <i class="fas fa-fire text-white"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white">Learning Streak</div>
                                            <div class="text-2xl font-black text-gray-900 dark:text-white">27 days</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-green-600 dark:text-green-400 font-bold">+5 days</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">All time best</div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl">
                                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Quizzes Today</div>
                                        <div class="text-2xl font-black text-gray-900 dark:text-white">8/10</div>
                                    </div>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl">
                                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Accuracy</div>
                                        <div class="text-2xl font-black text-gray-900 dark:text-white">92%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <div class="scroll-indicator"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-white to-transparent dark:from-gray-900"></div>
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 text-blue-700 dark:text-blue-300 font-bold mb-6 border border-blue-200 dark:border-blue-800">
                    <i class="fas fa-star mr-3"></i>
                    Why Learners Choose Us
                </div>
                <h2 class="text-5xl font-black heading-font mb-6">
                    <span class="gradient-text">Revolutionary</span> Learning Experience
                </h2>
                <p class="text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    We combine cutting-edge AI with proven gamification techniques to create the most engaging learning platform ever built.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                <div class="glass-card rounded-3xl p-8 card-hover">
                    <div class="feature-icon">
                        <i class="fas fa-brain text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Adaptive AI Tutor</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        Our AI constantly adapts to your learning style, identifying weaknesses and personalizing content to maximize retention.
                    </p>
                    <div class="inline-flex items-center text-primary dark:text-accent font-bold">
                        <span>See AI in action</span>
                        <i class="fas fa-arrow-right ml-3 transition-transform group-hover:translate-x-2"></i>
                    </div>
                </div>
                
                <div class="glass-card rounded-3xl p-8 card-hover">
                    <div class="feature-icon">
                        <i class="fas fa-trophy text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Dynamic Rewards</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        Earn rare NFTs, unlock exclusive content, and collect digital badges that evolve as you progress through your journey.
                    </p>
                    <div class="flex space-x-3">
                        <div class="px-4 py-2 bg-gradient-to-r from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30 rounded-full text-yellow-700 dark:text-yellow-300 font-bold">Legendary</div>
                        <div class="px-4 py-2 bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-full text-purple-700 dark:text-purple-300 font-bold">Master</div>
                    </div>
                </div>
                
                <div class="glass-card rounded-3xl p-8 card-hover">
                    <div class="feature-icon">
                        <i class="fas fa-users text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-4">Live Battles</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        Challenge friends or random opponents in real-time quiz battles with live leaderboards and instant feedback.
                    </p>
                    <div class="flex items-center">
                        <div class="flex -space-x-3 mr-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-500"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-blue-500"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-pink-500"></div>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">500+ live battles happening now</span>
                    </div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full opacity-20 blur-xl"></div>
                    <div class="glass-card rounded-3xl p-8 shadow-2xl relative z-10">
                        <div class="flex items-center mb-8">
                            <div class="w-16 h-16 rounded-2xl gradient-bg flex items-center justify-center mr-6">
                                <i class="fas fa-chart-network text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-900 dark:text-white">Learning Analytics</h3>
                                <p class="text-gray-600 dark:text-gray-400">Real-time insights dashboard</p>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-700 dark:text-gray-300 font-semibold">Weekly Progress</span>
                                    <span class="font-black text-gray-900 dark:text-white">+47%</span>
                                </div>
                                <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-400 to-blue-500 rounded-full" style="width: 78%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-700 dark:text-gray-300 font-semibold">Skill Mastery</span>
                                    <span class="font-black text-gray-900 dark:text-white">4/8 mastered</span>
                                </div>
                                <div class="w-full h-3 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-400 to-pink-500 rounded-full" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-3xl font-black heading-font mb-6">
                        Data-Driven <span class="gradient-text">Success Path</span>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-8 text-lg leading-relaxed">
                        Our platform analyzes millions of data points to create the optimal learning path for you. Watch as your knowledge graph expands with each session.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-semibold">Personalized difficulty scaling</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-semibold">Predictive knowledge gaps</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-semibold">Optimal review scheduling</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-green-100 to-blue-100 dark:from-green-900/30 dark:to-blue-900/30 text-green-700 dark:text-green-300 font-bold mb-6 border border-green-200 dark:border-green-800">
                    <i class="fas fa-play-circle mr-3"></i>
                    Start Learning in 4 Steps
                </div>
                <h2 class="text-5xl font-black heading-font mb-6">
                    <span class="gradient-text">Simple</span> Yet Powerful
                </h2>
                <p class="text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    From beginner to master in weeks, not years. Our streamlined process makes expertise accessible.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full opacity-10 blur-xl"></div>
                    <div class="glass-card rounded-3xl p-8 text-center relative z-10 card-hover">
                        <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center text-white text-3xl font-black mx-auto mb-6 shadow-lg">
                            1
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-4">AI Assessment</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Our AI evaluates your current knowledge level and creates a personalized learning blueprint.
                        </p>
                        <div class="mt-6">
                            <div class="w-12 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto"></div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full opacity-10 blur-xl"></div>
                    <div class="glass-card rounded-3xl p-8 text-center relative z-10 card-hover">
                        <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center text-white text-3xl font-black mx-auto mb-6 shadow-lg">
                            2
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-4">Engage & Learn</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Dive into interactive modules, live challenges, and AI-powered quizzes that adapt in real-time.
                        </p>
                        <div class="mt-6">
                            <div class="w-12 h-1 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto"></div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-r from-green-500 to-green-600 rounded-full opacity-10 blur-xl"></div>
                    <div class="glass-card rounded-3xl p-8 text-center relative z-10 card-hover">
                        <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center text-white text-3xl font-black mx-auto mb-6 shadow-lg">
                            3
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-4">Compete & Grow</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Join global tournaments, climb leaderboards, and earn rewards that validate your expertise.
                        </p>
                        <div class="mt-6">
                            <div class="w-12 h-1 bg-gradient-to-r from-green-500 to-blue-500 mx-auto"></div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full opacity-10 blur-xl"></div>
                    <div class="glass-card rounded-3xl p-8 text-center relative z-10 card-hover">
                        <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center text-white text-3xl font-black mx-auto mb-6 shadow-lg">
                            4
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white mb-4">Master & Certify</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Earn verifiable certificates, showcase skills, and unlock advanced career opportunities.
                        </p>
                        <div class="mt-6">
                            <div class="w-12 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <a href="#cta" class="btn-primary inline-flex items-center px-12 py-5 text-xl">
                    <i class="fas fa-play mr-4"></i>
                    Start Your Journey Now
                </a>
                <p class="text-gray-600 dark:text-gray-400 mt-6">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Join 250,000+ professionals already mastering skills with our platform
                </p>
            </div>
        </div>
    </section>

    <!-- Leaderboard -->
    <section id="leaderboard" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-purple-50/30 dark:from-blue-900/10 dark:to-purple-900/10"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-yellow-100 to-orange-100 dark:from-yellow-900/30 dark:to-orange-900/30 text-yellow-700 dark:text-yellow-300 font-bold mb-6 border border-yellow-200 dark:border-yellow-800">
                    <i class="fas fa-crown mr-3"></i>
                    Global Elite Leaderboard
                </div>
                <h2 class="text-5xl font-black heading-font mb-6">
                    Compete with the <span class="gradient-text">Best</span>
                </h2>
                <p class="text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Join the most ambitious learners worldwide. Climb ranks, earn prestige, and showcase your expertise.
                </p>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="glass-card rounded-3xl p-8 shadow-2xl">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white">Weekly Champions</h3>
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <select class="appearance-none bg-gray-100 dark:bg-gray-800 border-0 rounded-xl pl-6 pr-12 py-3 font-bold focus:ring-2 focus:ring-primary">
                                        <option>This Week</option>
                                        <option>This Month</option>
                                        <option>All Time</option>
                                    </select>
                                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-500"></i>
                                    </div>
                                </div>
                                <div class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl font-bold text-white">
                                    Live
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-6 rounded-2xl bg-gradient-to-r from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20 border border-yellow-100 dark:border-yellow-800">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center text-white text-2xl font-black mr-6 shadow-lg">
                                    1
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h4 class="text-xl font-black text-gray-900 dark:text-white mr-4">Alexandra Chen</h4>
                                        <div class="px-3 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full text-white text-sm font-bold">
                                            Quantum AI
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-3 rounded-full" style="width: 96%"></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-gray-900 dark:text-white">24,850 XP</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Master Level</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-6 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-gray-300 to-gray-400 flex items-center justify-center text-white text-2xl font-black mr-6">
                                    2
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h4 class="text-xl font-black text-gray-900 dark:text-white mr-4">Marcus Rodriguez</h4>
                                        <div class="px-3 py-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full text-white text-sm font-bold">
                                            Data Science
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-blue-400 to-purple-500 h-3 rounded-full" style="width: 88%"></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-gray-900 dark:text-white">22,430 XP</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Expert Level</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-6 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-amber-300 to-amber-500 flex items-center justify-center text-white text-2xl font-black mr-6">
                                    3
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h4 class="text-xl font-black text-gray-900 dark:text-white mr-4">Sophie Williams</h4>
                                        <div class="px-3 py-1 bg-gradient-to-r from-green-400 to-blue-500 rounded-full text-white text-sm font-bold">
                                            Cybersecurity
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full" style="width: 82%"></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-black text-gray-900 dark:text-white">20,980 XP</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Expert Level</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <a href="#cta" class="text-lg font-bold gradient-text hover:opacity-80 transition-opacity inline-flex items-center">
                                Join the competition
                                <i class="fas fa-arrow-right ml-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <div class="glass-card rounded-3xl p-8 shadow-2xl">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Your Current Stats</h3>
                        
                        <div class="space-y-8">
                            <div>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-700 dark:text-gray-300 font-semibold">Global Rank</span>
                                    <span class="text-2xl font-black gradient-text">#42</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-3 rounded-full" style="width: 42%"></div>
                                </div>
                                <div class="text-right text-sm text-gray-600 dark:text-gray-500 mt-2">Top 5% worldwide</div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20">
                                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Weekly XP</div>
                                    <div class="text-2xl font-black text-gray-900 dark:text-white">+2,480</div>
                                </div>
                                <div class="p-4 rounded-2xl bg-gradient-to-br from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20">
                                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Accuracy</div>
                                    <div class="text-2xl font-black text-gray-900 dark:text-white">91%</div>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white mb-4">Recent Achievements</h4>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 flex flex-col items-center justify-center p-4">
                                        <i class="fas fa-bolt text-blue-500 dark:text-blue-400 text-2xl mb-2"></i>
                                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 text-center">Speed Demon</span>
                                    </div>
                                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 flex flex-col items-center justify-center p-4">
                                        <i class="fas fa-brain text-purple-500 dark:text-purple-400 text-2xl mb-2"></i>
                                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 text-center">Master Thinker</span>
                                    </div>
                                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-green-100 to-blue-100 dark:from-green-900/30 dark:to-blue-900/30 flex flex-col items-center justify-center p-4">
                                        <i class="fas fa-infinity text-green-500 dark:text-green-400 text-2xl mb-2"></i>
                                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 text-center">Infinite Learner</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-card rounded-3xl p-8 shadow-2xl">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6">Live Tournaments</h3>
                        <div class="space-y-4">
                            <div class="p-4 rounded-2xl bg-gradient-to-r from-blue-500/10 to-purple-500/10 border border-blue-200 dark:border-blue-800">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-gray-900 dark:text-white">AI Quiz Battle</span>
                                    <span class="px-3 py-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full text-white text-xs font-bold">Live Now</span>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">1,240 players online</div>
                            </div>
                            
                            <div class="p-4 rounded-2xl bg-gradient-to-r from-green-500/10 to-blue-500/10 border border-green-200 dark:border-green-800">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-gray-900 dark:text-white">Data Science Cup</span>
                                    <span class="px-3 py-1 bg-gradient-to-r from-green-500 to-blue-500 rounded-full text-white text-xs font-bold">Starting Soon</span>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Starts in 2:15:30</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories -->
    <section id="testimonials" class="py-24 bg-gradient-to-b from-white to-gray-50 dark:from-gray-800 dark:to-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <div class="inline-flex items-center px-6 py-3 rounded-full bg-gradient-to-r from-pink-100 to-rose-100 dark:from-pink-900/30 dark:to-rose-900/30 text-pink-700 dark:text-pink-300 font-bold mb-6 border border-pink-200 dark:border-pink-800">
                    <i class="fas fa-heart mr-3"></i>
                    Success Stories
                </div>
                <h2 class="text-5xl font-black heading-font mb-6">
                    Join Our <span class="gradient-text">Thriving</span> Community
                </h2>
                <p class="text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    See how learners transformed their careers and achieved their dreams with our platform.
                </p>
            </div>
            
            <div class="splide mb-20" id="testimonial-slider">
                <div class="splide__track">
                    <div class="splide__list">
                        <div class="splide__slide">
                            <div class="glass-card rounded-3xl p-8">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 mr-6"></div>
                                    <div>
                                        <h4 class="text-xl font-black text-gray-900 dark:text-white">Sarah Johnson</h4>
                                        <p class="text-gray-600 dark:text-gray-400">Senior AI Engineer @ Google</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-6">
                                    "LearnQuest completely transformed how I approach skill development. The AI-powered quizzes identified gaps I didn't even know I had. Within 3 months, I mastered advanced ML concepts that took me years to understand through traditional methods."
                                </p>
                                <div class="flex items-center">
                                    <div class="text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">4.8/5.0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="splide__slide">
                            <div class="glass-card rounded-3xl p-8">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-green-500 to-blue-500 mr-6"></div>
                                    <div>
                                        <h4 class="text-xl font-black text-gray-900 dark:text-white">Michael Chen</h4>
                                        <p class="text-gray-600 dark:text-gray-400">Data Scientist @ SpaceX</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-6">
                                    "The competitive aspect kept me motivated like nothing else. Climbing the global leaderboard gave me tangible goals, and the live tournaments simulated real-world pressure. I went from intermediate to expert in data visualization in just 6 weeks."
                                </p>
                                <div class="flex items-center">
                                    <div class="text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">5.0/5.0</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="splide__slide">
                            <div class="glass-card rounded-3xl p-8">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 mr-6"></div>
                                    <div>
                                        <h4 class="text-xl font-black text-gray-900 dark:text-white">Jessica Williams</h4>
                                        <p class="text-gray-600 dark:text-gray-400">Cybersecurity Lead @ Microsoft</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-6">
                                    "The adaptive learning algorithm is pure genius. It knew exactly when to challenge me and when to reinforce concepts. I earned 3 industry certifications thanks to LearnQuest, and my salary increased by 40% within a year of using the platform."
                                </p>
                                <div class="flex items-center">
                                    <div class="text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">4.7/5.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-black gradient-text mb-4">250K+</div>
                    <div class="text-gray-700 dark:text-gray-300 font-semibold">Active Learners</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black gradient-text mb-4">4.9/5.0</div>
                    <div class="text-gray-700 dark:text-gray-300 font-semibold">Average Rating</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black gradient-text mb-4">98%</div>
                    <div class="text-gray-700 dark:text-gray-300 font-semibold">Career Impact</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 gradient-bg-alt"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-white/50 via-white/30 to-transparent"></div>
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-8 heading-font leading-tight">
                    Ready to Transform
                    <span class="block">Your Learning Journey?</span>
                </h2>
                
                <p class="text-xl text-blue-100 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Join the future of education today. Experience the power of AI-driven gamification and see why traditional learning methods are becoming obsolete.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-6 sm:space-y-0 sm:space-x-8 mb-16">
                    <a href="#" class="bg-black text-white px-12 py-5 rounded-2xl font-black text-xl hover:bg-blue-50 transition-colors shadow-2xl hover:scale-105 transition-transform">
                        <i class="fas fa-rocket mr-4"></i>
                        Start Free Trial
                    </a>
                    <a href="#" class="bg-transparent border-2 border-white text-white px-12 py-5 rounded-2xl font-bold text-xl hover:bg-white/10 transition-colors">
                        <i class="fas fa-calendar-alt mr-4"></i>
                        Schedule Demo
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-white">
                    <div class="flex items-center justify-center">
                        <i class="fas fa-shield-alt text-2xl mr-4"></i>
                        <div>
                            <div class="font-bold">30-Day Free Trial</div>
                            <div class="text-sm opacity-90">No credit card required</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-trophy text-2xl mr-4"></i>
                        <div>
                            <div class="font-bold">Cancel Anytime</div>
                            <div class="text-sm opacity-90">No questions asked</div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-certificate text-2xl mr-4"></i>
                        <div>
                            <div class="font-bold">Certificates Included</div>
                            <div class="text-sm opacity-90">Industry-recognized</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-5 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center">
                            <i class="fas fa-brain text-white text-2xl"></i>
                        </div>
                        <span class="text-3xl font-black heading-font">LearnQuest</span>
                    </div>
                    <p class="text-gray-400 mb-8 text-lg leading-relaxed max-w-md">
                        We're on a mission to make expert-level knowledge accessible to everyone through the power of AI and gamification.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition-colors hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition-colors hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition-colors hover:scale-110">
                            <i class="fab fa-discord"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-gray-700 transition-colors hover:scale-110">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-black mb-6">Platform</h3>
                    <ul class="space-y-4">
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                        <li><a href="#how-it-works" class="text-gray-400 hover:text-white transition-colors">How It Works</a></li>
                        <li><a href="#leaderboard" class="text-gray-400 hover:text-white transition-colors">Leaderboard</a></li>
                        <li><a href="#pricing" class="text-gray-400 hover:text-white transition-colors">Pricing</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-black mb-6">Resources</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Research</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Community</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API Docs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-black mb-6">Company</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">&copy; 2026 LearnQuest. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookies</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">GDPR</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-14 h-14 rounded-full gradient-bg text-white shadow-2xl hover:scale-110 transition-transform z-50 hidden">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme Toggle
            const themeToggle = document.getElementById('theme-toggle');
            const mobileThemeToggle = document.getElementById('mobile-theme-toggle');
            const themeCircle = document.getElementById('theme-toggle-circle');
            
            function setTheme(isDark) {
                if (isDark) {
                    document.body.classList.add('dark-mode');
                    themeCircle.style.transform = 'translateX(24px)';
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.body.classList.remove('dark-mode');
                    themeCircle.style.transform = 'translateX(0)';
                    localStorage.setItem('theme', 'light');
                }
            }
            
            const savedTheme = localStorage.getItem('theme') || 
                               (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            setTheme(savedTheme === 'dark');
            
            themeToggle?.addEventListener('click', () => {
                const isDark = !document.body.classList.contains('dark-mode');
                setTheme(isDark);
            });
            
            mobileThemeToggle?.addEventListener('click', () => {
                const isDark = !document.body.classList.contains('dark-mode');
                setTheme(isDark);
            });

            // Mobile Menu
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const closeMenuBtn = document.getElementById('close-menu');
            
            mobileMenuBtn?.addEventListener('click', () => {
                mobileMenu.style.transform = 'translateX(0)';
            });
            
            closeMenuBtn?.addEventListener('click', () => {
                mobileMenu.style.transform = 'translateX(-100%)';
            });

            // Progress Animation
            const progressCircles = document.querySelectorAll('.progress-ring-circle');
            progressCircles.forEach(circle => {
                const progress = circle.getAttribute('data-progress');
                const offset = 691 - (691 * progress / 100);
                circle.style.strokeDashoffset = offset;
            });

            // Smooth Scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                        
                        // Close mobile menu if open
                        if (mobileMenu.style.transform === 'translateX(0px)') {
                            mobileMenu.style.transform = 'translateX(-100%)';
                        }
                    }
                });
            });

            // Back to Top Button
            const backToTopBtn = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.display = 'flex';
                } else {
                    backToTopBtn.style.display = 'none';
                }
            });
            
            backToTopBtn?.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Testimonial Slider
            new Splide('#testimonial-slider', {
                type: 'loop',
                perPage: 3,
                perMove: 1,
                gap: '2rem',
                padding: { left: '1rem', right: '1rem' },
                focus: 'center',
                breakpoints: {
                    1024: { perPage: 2 },
                    768: { perPage: 1 }
                },
                autoplay: true,
                interval: 5000,
                pauseOnHover: true
            }).mount();

            // Particle Effect
            function createParticle(x, y) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                particle.style.width = Math.random() * 30 + 10 + 'px';
                particle.style.height = particle.style.width;
                
                document.body.appendChild(particle);
                
                setTimeout(() => {
                    particle.remove();
                }, 1000);
            }
            
            document.addEventListener('mousemove', (e) => {
                if (Math.random() > 0.7) {
                    createParticle(e.clientX, e.clientY);
                }
            });

            // Typewriter Effect
            const typewriter = document.querySelector('.typewriter');
            if (typewriter) {
                setTimeout(() => {
                    typewriter.style.borderRight = 'none';
                }, 3500);
            }

            // Animate on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.card-hover').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>