<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel - Quiz Master Pro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --warning: #f72585;
            --dark: #1a1a2e;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .quiz-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }
        
        .quiz-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(67, 97, 238, 0); }
            100% { box-shadow: 0 0 0 0 rgba(67, 97, 238, 0); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring__circle {
            transition: stroke-dashoffset 0.5s;
            transform-origin: 50% 50%;
        }
        
        .typewriter {
            overflow: hidden;
            border-right: .15em solid var(--primary);
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--primary) }
        }
        
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Enhanced Sidebar -->
        <aside class="w-64 gradient-bg text-white shadow-2xl hidden md:flex flex-col relative z-10">
            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
                <div class="absolute -top-20 -left-20 w-40 h-40 bg-white rounded-full"></div>
                <div class="absolute top-1/2 right-0 w-60 h-60 bg-white rounded-full"></div>
                <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-white rounded-full"></div>
            </div>
            
            <div class="relative z-10">
                <!-- Logo -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-brain text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">QuizMaster<span class="text-yellow-400">Pro</span></h1>
                            <p class="text-white/60 text-sm">Intelligent Learning</p>
                        </div>
                    </div>
                </div>

                <!-- User Profile Card -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="w-14 h-14 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center text-xl font-bold shadow-lg">
                                {{ strtoupper(substr(auth()->user()->first_name ?? '', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-blue-900 flex items-center justify-center">
                                <i class="fas fa-bolt text-xs text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                            <div class="flex items-center space-x-2 mt-1">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-white/70 text-xs">Online</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="#dashboard" class="nav-item flex items-center p-4 rounded-xl bg-white/10 text-white transition-all duration-300 hover:bg-white/20 hover:translate-x-2 active">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <span class="font-medium">Dashboard</span>
                                <div class="ml-auto w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#quiz-section" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10 transition-all duration-300 hover:translate-x-2">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <span class="font-medium">Take Quiz</span>
                            </a>
                        </li>
                        <li>
                            <a href="#history" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10 transition-all duration-300 hover:translate-x-2">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-history"></i>
                                </div>
                                <span class="font-medium">History</span>
                                <span id="historyBadge" class="ml-auto px-2 py-1 bg-red-500 text-xs rounded-full hidden"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#leaderboard" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10 transition-all duration-300 hover:translate-x-2">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <span class="font-medium">Leaderboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#analytics" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10 transition-all duration-300 hover:translate-x-2">
                                <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <span class="font-medium">Analytics</span>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Quick Stats -->
                    <div class="mt-8 p-4 bg-white/5 rounded-xl">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-white/60 text-sm">Today's Progress</span>
                            <span id="dailyProgress" class="text-green-400 font-bold">0%</span>
                        </div>
                        <div class="w-full bg-white/10 rounded-full h-2">
                            <div id="dailyProgressBar" class="bg-gradient-to-r from-green-400 to-emerald-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </nav>

                <!-- Footer -->
                <div class="p-6 border-t border-white/10">
                    <div class="text-center">
                        <div class="flex justify-center space-x-4 mb-3">
                            <button class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors">
                                <i class="fab fa-discord"></i>
                            </button>
                            <button class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors">
                                <i class="fab fa-github"></i>
                            </button>
                            <button class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </button>
                        </div>
                        <p class="text-white/50 text-sm">© 2026 QuizMaster Pro v3.0</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Enhanced Top Header -->
            <header class="glass-effect backdrop-blur-lg p-4 flex justify-between items-center shadow-lg">
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-white bg-white/20 p-3 rounded-xl hover:bg-white/30 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-4">
                    <div class="relative">
                        <input type="text" placeholder="Search quizzes, topics, or categories..." 
                               class="w-full p-4 pl-12 rounded-2xl border-none bg-white/10 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:bg-white/15 transition-all">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-white/60"></i>
                        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                            <i class="fas fa-sliders-h text-white/80"></i>
                        </button>
                    </div>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-4">
                    <!-- Points Display -->
                    <div class="hidden md:flex items-center bg-gradient-to-r from-yellow-500 to-orange-500 px-4 py-3 rounded-xl shadow-lg">
                        <i class="fas fa-star mr-2 text-white"></i>
                        <span class="text-white font-bold" id="totalPoints">0</span>
                        <span class="text-white/80 ml-2">Points</span>
                    </div>

                    <!-- Streak Display -->
                    <div class="hidden md:flex items-center bg-gradient-to-r from-red-500 to-pink-500 px-4 py-3 rounded-xl shadow-lg">
                        <i class="fas fa-fire mr-2 text-white"></i>
                        <span class="text-white font-bold" id="streakCount">0</span>
                        <span class="text-white/80 ml-2">Day Streak</span>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button class="notification-btn w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors relative">
                            <i class="fas fa-bell text-xl text-white"></i>
                            <span id="notificationCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">3</span>
                        </button>
                    </div>

                    <!-- Messages -->
                    <div class="relative">
                        <button class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-colors relative">
                            <i class="fas fa-envelope text-xl text-white"></i>
                            <span class="absolute -top-1 -right-1 bg-yellow-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">1</span>
                        </button>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative" style="z-index: 10000;">
                        <button id="userDropdownBtn" class="flex items-center space-x-3 focus:outline-none group">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-110 transition-transform">
                                    {{ strtoupper(substr(auth()->user()->first_name ?? '', 0, 1)) }}
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="font-semibold text-white text-sm">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <p class="text-white/60 text-xs">Student Level 15</p>
                            </div>
                            <i class="fas fa-chevron-down text-white/60 hidden md:block group-hover:rotate-180 transition-transform"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                       <div id="userDropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl border border-gray-200 hidden overflow-hidden animate__animated animate__fadeIn" style="z-index: 9999;">
                            <div class="p-4 bg-gradient-to-r from-blue-500 to-purple-600">
                                <p class="font-bold text-white text-lg">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <p class="text-white/90 text-sm">{{ auth()->user()->email }}</p>
                                <div class="flex items-center mt-3">
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-xl transition-colors group">
                                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <span class="font-medium">Profile</span>
                                        <p class="text-gray-500 text-xs">View your profile</p>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 rounded-xl transition-colors group">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cog text-green-600"></i>
                                    </div>
                                    <div>
                                        <span class="font-medium">Settings</span>
                                        <p class="text-gray-500 text-xs">Customize preferences</p>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-50 rounded-xl transition-colors group">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-question-circle text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <span class="font-medium">Help Center</span>
                                        <p class="text-gray-500 text-xs">Get help & support</p>
                                    </div>
                                </a>
                                <div class="border-t my-2"></div>
                                <a href="/logout" class="flex items-center px-4 text-red-600 hover:bg-red-50 rounded-xl transition-colors group">
                                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-sign-out-alt text-red-600"></i>
                                    </div>
                                    <div>
                                        <span class="font-medium">Logout</span>
                                        <p class="text-gray-500 text-xs">Sign out of your account</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Sidebar -->
            <div id="mobileSidebar" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden md:hidden">
                <div class="w-80 gradient-bg text-white h-full animate__animated animate__slideInLeft overflow-y-auto">
                    <div class="p-6 flex justify-between items-center border-b border-white/10">
                        <h2 class="text-2xl font-bold">Menu</h2>
                        <button id="closeMobileMenu" class="text-3xl text-white/60 hover:text-white">&times;</button>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center text-2xl font-bold shadow-lg">
                                {{ strtoupper(substr(auth()->user()->first_name ?? '', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                                <p class="text-white/70 text-sm">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <nav class="space-y-2">
                            <a href="#dashboard" class="nav-item flex items-center p-4 rounded-xl bg-white/10 text-white">
                                <i class="fas fa-tachometer-alt mr-4 text-lg"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="#quiz-section" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10">
                                <i class="fas fa-question-circle mr-4 text-lg"></i>
                                <span class="font-medium">Take Quiz</span>
                            </a>
                            <a href="#history" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10">
                                <i class="fas fa-history mr-4 text-lg"></i>
                                <span class="font-medium">History</span>
                                <span id="mobileHistoryBadge" class="ml-auto px-2 py-1 bg-red-500 text-xs rounded-full">3</span>
                            </a>
                            <a href="#leaderboard" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10">
                                <i class="fas fa-trophy mr-4 text-lg"></i>
                                <span class="font-medium">Leaderboard</span>
                            </a>
                            <a href="#analytics" class="nav-item flex items-center p-4 rounded-xl text-white/80 hover:bg-white/10">
                                <i class="fas fa-chart-line mr-4 text-lg"></i>
                                <span class="font-medium">Analytics</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-gradient-to-br from-gray-50 to-blue-50/30">
                <!-- Dashboard Section -->
                <div id="dashboard" class="content-section">
                    <!-- Welcome Section -->
                    <div class="mb-8 animate__animated animate__fadeIn">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                            <div>
                                <h1 class="text-4xl font-bold text-gray-800 mb-2">Welcome back, <span class="gradient-text">{{ auth()->user()->first_name }}</span>! 👋</h1>
                                <p class="text-gray-600 text-lg" id="greetingMessage">Ready to ace some quizzes today?</p>
                            </div>
                        </div>
                        
                        <!-- Stats Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <!-- Points Card -->
                            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-blue-500 hover:shadow-2xl transition-all duration-500 animate__animated animate__fadeInUp">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Total Points</p>
                                        <h3 class="text-4xl font-bold text-gray-800 mt-2" id="totalPointsCard">0</h3>
                                        <div class="flex items-center text-green-600 text-sm mt-2">
                                            <i class="fas fa-arrow-up mr-2"></i>
                                            <span id="pointsGrowth">+12% from last week</span>
                                        </div>
                                    </div>
                                    <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-star text-blue-600 text-2xl"></i>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Daily Goal</span>
                                        <span class="font-semibold">1000 pts</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                        <div id="pointsProgress" class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quizzes Card -->
                            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-green-500 hover:shadow-2xl transition-all duration-500 animate__animated animate__fadeInUp animate__delay-1s">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Quizzes Completed</p>
                                        <h3 class="text-4xl font-bold text-gray-800 mt-2" id="totalQuizzesCard">0</h3>
                                        <div class="flex items-center text-green-600 text-sm mt-2">
                                            <i class="fas fa-arrow-up mr-2"></i>
                                            <span id="quizzesGrowth">+3 this week</span>
                                        </div>
                                    </div>
                                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Today's Quizzes</span>
                                        <span class="font-semibold" id="todayQuizzes">0</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                        <div id="quizzesProgress" class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accuracy Card -->
                            <div class="bg-white rounded-2xl shadow-xl p-6 border-l-4 border-purple-500 hover:shadow-2xl transition-all duration-500 animate__animated animate__fadeInUp animate__delay-2s">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-gray-500 text-sm font-medium">Accuracy Rate</p>
                                        <h3 class="text-4xl font-bold text-gray-800 mt-2" id="accuracyRate">0%</h3>
                                        <div class="flex items-center text-green-600 text-sm mt-2">
                                            <i class="fas fa-trend-up mr-2"></i>
                                            <span id="accuracyTrend">+5% improvement</span>
                                        </div>
                                    </div>
                                    <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-bullseye text-purple-600 text-2xl"></i>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Target</span>
                                        <span class="font-semibold">85%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                        <div id="accuracyProgress" class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rank Card -->
                           
                        </div>

                        <!-- Charts Row -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                            <!-- Performance Chart -->
                            <div class="bg-white rounded-2xl shadow-xl p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">Performance Trend</h3>
                                        <p class="text-gray-600">Your quiz scores over time</p>
                                    </div>
                                    <select id="chartTimeRange" class="border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="7">Last 7 days</option>
                                        <option value="30">Last 30 days</option>
                                        <option value="90">Last 90 days</option>
                                    </select>
                                </div>
                                <div class="h-72">
                                    <canvas id="performanceChart"></canvas>
                                </div>
                            </div>

                            <!-- Category Distribution -->
                            <div class="bg-white rounded-2xl shadow-xl p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">Category Mastery</h3>
                                        <p class="text-gray-600">Your performance by category</p>
                                    </div>
                                    <button onclick="loadCategoryStats()" class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center hover:bg-blue-200 transition-colors">
                                        <i class="fas fa-redo text-blue-600"></i>
                                    </button>
                                </div>
                                <div class="h-72">
                                    <canvas id="categoryChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions & Recent Activity -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                            <!-- Quick Actions -->
                            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Actions</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <button onclick="startQuiz('linux', 'easy')" class="flex flex-col items-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl hover:shadow-lg transition-all duration-300 group">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                            <i class="fas fa-code text-white text-lg"></i>
                                        </div>
                                        <span class="font-semibold text-gray-800 text-sm">Linux Quiz</span>
                                        <span class="text-gray-600 text-xs mt-1">Easy Level</span>
                                    </button>
                                    
                                    <button onclick="startQuiz('docker', 'medium')" class="flex flex-col items-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl hover:shadow-lg transition-all duration-300 group">
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                            <i class="fab fa-docker text-white text-lg"></i>
                                        </div>
                                        <span class="font-semibold text-gray-800 text-sm">Docker</span>
                                        <span class="text-gray-600 text-xs mt-1">Medium Level</span>
                                    </button>
                                    
                                    <button onclick="startQuiz('sql', 'hard')" class="flex flex-col items-center p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-2xl hover:shadow-lg transition-all duration-300 group">
                                        <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                            <i class="fas fa-database text-white text-lg"></i>
                                        </div>
                                        <span class="font-semibold text-gray-800 text-sm">SQL Challenge</span>
                                        <span class="text-gray-600 text-xs mt-1">Hard Level</span>
                                    </button>
                                    
                                    <button onclick="startQuiz('random', 'mixed')" class="flex flex-col items-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl hover:shadow-lg transition-all duration-300 group">
                                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                            <i class="fas fa-random text-white text-lg"></i>
                                        </div>
                                        <span class="font-semibold text-gray-800 text-sm">Random Mix</span>
                                        <span class="text-gray-600 text-xs mt-1">Mixed Difficulty</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Recent Activity -->
                            <div class="bg-white rounded-2xl shadow-xl p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-xl font-bold text-gray-800">Recent Activity</h3>
                                    <span class="text-blue-600 text-sm font-medium" id="recentActivityCount">0 items</span>
                                </div>
                                <div class="space-y-4" id="recentActivityList">
                                    <!-- Recent activity items will be loaded here -->
                                    <div class="animate-pulse">
                                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                            <div class="w-10 h-10 bg-gray-200 rounded-xl"></div>
                                            <div class="flex-1">
                                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                                <div class="h-3 bg-gray-200 rounded w-1/2 mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiz Section -->
                <div id="quiz-section" class="content-section hidden">
                    <!-- Quiz Header -->
                    <div class="mb-8 text-center animate__animated animate__fadeIn">
                        <h1 class="text-4xl font-bold text-gray-800 mb-3 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Interactive Quiz Challenge</h1>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Customize your quiz and test your knowledge. Earn points and level up!</p>
                    </div>

                    <!-- Quiz Setup Card -->
                    <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 mb-8 border border-gray-100 animate__animated animate__slideInUp">
                        <div class="flex items-center mb-8">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mr-5">
                                <i class="fas fa-sliders-h text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-800">Quiz Customizer</h2>
                                <p class="text-gray-600">Select your preferences and start the challenge</p>
                            </div>
                        </div>
                        
                        <!-- Setup Options -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <!-- Category Selector -->
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-folder mr-2 text-blue-500"></i>
                                    Category
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <select id="category" class="w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none hover:bg-white transition-colors">
                                        <option value="">Any Category</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Difficulty Selector -->
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-chart-line mr-2 text-green-500"></i>
                                    Difficulty
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-signal text-gray-400"></i>
                                    </div>
                                    <select id="difficulty" class="w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none hover:bg-white transition-colors">
                                        <option value="">Any Difficulty</option>
                                        <option value="Easy" class="text-green-600 font-medium">Easy</option>
                                        <option value="Medium" class="text-yellow-600 font-medium">Medium</option>
                                        <option value="Hard" class="text-red-600 font-medium">Hard</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Question Count -->
                            <div class="space-y-3">
                                <label class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-list-ol mr-2 text-purple-500"></i>
                                    Questions
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-hashtag text-gray-400"></i>
                                    </div>
                                    <select id="limit" class="w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-transparent appearance-none hover:bg-white transition-colors">
                                        <option value="5">5 Questions</option>
                                        <option value="10" selected>10 Questions</option>
                                        <option value="15">15 Questions</option>
                                        <option value="20">20 Questions</option>
                                        <option value="25">25 Questions</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Start Button -->
                            <div class="flex items-end">
                                <button onclick="startQuiz()" 
                                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-2xl flex items-center justify-center space-x-3 pulse-animation">
                                    <i class="fas fa-play-circle text-xl"></i>
                                    <span class="text-lg">Start Quiz</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Section -->
                    <div id="progressSection" class="hidden bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl shadow-xl p-6 mb-8 border border-blue-100">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Quiz Progress</h3>
                                <p id="progressText" class="text-gray-600">Answer all questions to see results</p>
                            </div>
                            <div class="text-center md:text-right">
                                <div class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent" id="scoreDisplay">0/0</div>
                                <div class="text-sm text-gray-500">Current Score</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-gray-600 mb-3">
                                <span>Progress</span>
                                <span id="progressPercent" class="font-bold">0%</span>
                            </div>
                            <div class="h-4 bg-gray-200 rounded-full overflow-hidden shadow-inner">
                                <div id="progressBar" class="h-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-full w-0 progress-bar"></div>
                            </div>
                        </div>


                        <div id="questionNav" class="flex flex-wrap gap-2 mb-4"></div>
                    </div>

                    <div id="quiz" class="space-y-6 mb-8"></div>

                    <!-- Quiz Results -->
                    <div id="resultsSection" class="hidden bg-white rounded-2xl shadow-2xl p-6 md:p-8 mb-8 animate__animated animate__fadeIn">
                        <div class="text-center mb-10">
                            <div class="relative inline-block mb-8">
                                <div class="w-32 h-32 bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto shadow-2xl">
                                    <i class="fas fa-trophy text-white text-4xl"></i>
                                </div>
                                <div class="absolute -top-2 -right-2 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                            </div>
                            <h2 class="text-4xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Quiz Completed!</h2>
                            <p class="text-gray-600 text-lg max-w-md mx-auto">Here's how you performed. Great work!</p>
                        </div>

                        <!-- Score Card -->
                        <div class="max-w-2xl mx-auto bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8 mb-10 border border-blue-200 shadow-lg">
                            <div class="text-center">
                                <div class="text-6xl font-bold text-gray-800 mb-4" id="finalScore">0/0</div>
                                <div class="text-gray-600 text-xl mb-8">Your Score</div>
                                
                                <!-- Performance Indicator -->
                                <div class="relative mb-10">
                                    <div class="h-6 bg-gradient-to-r from-red-500 via-yellow-500 to-green-500 rounded-full overflow-hidden">
                                        <div id="performanceBar" class="h-full bg-gray-800 rounded-full w-0 transition-all duration-1000"></div>
                                    </div>
                                    <div id="performanceMarker" class="absolute top-8 transform -translate-x-1/2 text-sm font-bold transition-all duration-1000" style="left: 0%">
                                        <div class="w-4 h-4 bg-gray-800 rounded-full mx-auto mb-1"></div>
                                        <div>0%</div>
                                    </div>
                                </div>
                                
                                <div class="text-2xl font-bold mb-2" id="performanceText">Analyzing your performance...</div>
                                <div class="text-gray-500" id="performanceSubtext">Keep up the great work!</div>
                            </div>
                        </div>

                        <!-- Statistics Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl p-6 border border-green-200 transform hover:-translate-y-2 transition-transform duration-300">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center mr-4">
                                        <i class="fas fa-check-circle text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-bold text-gray-800" id="correctCount">0</div>
                                        <div class="text-gray-600">Correct</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-green-200">
                                    <div class="text-sm text-green-700 font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i>
                                        Perfect answers!
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-red-50 to-pink-100 rounded-2xl p-6 border border-red-200 transform hover:-translate-y-2 transition-transform duration-300">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-r from-red-400 to-pink-500 rounded-2xl flex items-center justify-center mr-4">
                                        <i class="fas fa-times-circle text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-bold text-gray-800" id="incorrectCount">0</div>
                                        <div class="text-gray-600">Incorrect</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-red-200">
                                    <div class="text-sm text-red-700 font-medium">
                                        <i class="fas fa-lightbulb mr-1"></i>
                                        Review needed
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-purple-50 to-indigo-100 rounded-2xl p-6 border border-purple-200 transform hover:-translate-y-2 transition-transform duration-300">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-2xl flex items-center justify-center mr-4">
                                        <i class="fas fa-percentage text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-bold text-gray-800" id="percentageScore">0%</div>
                                        <div class="text-gray-600">Accuracy</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-purple-200">
                                    <div class="text-sm text-purple-700 font-medium">
                                        <i class="fas fa-chart-line mr-1"></i>
                                        Above average
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-100 rounded-2xl p-6 border border-blue-200 transform hover:-translate-y-2 transition-transform duration-300">
                                <div class="flex items-center">
                                    <div class="w-14 h-14 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-2xl flex items-center justify-center mr-4">
                                        <i class="fas fa-clock text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-bold text-gray-800" id="timeTaken">00:00</div>
                                        <div class="text-gray-600">Time Taken</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-blue-200">
                                    <div class="text-sm text-blue-700 font-medium">
                                        <i class="fas fa-bolt mr-1"></i>
                                        Great speed!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Points Earned -->
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-8 mb-10 border border-yellow-200 shadow-lg">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div class="flex items-center mb-6 md:mb-0">
                                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mr-6">
                                        <i class="fas fa-coins text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-bold text-gray-800" id="pointsEarned">+0 Points</div>
                                        <div class="text-gray-600">Added to your total</div>
                                    </div>
                                </div>
                                <button onclick="claimPoints()" 
                                        class="px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-bold text-lg rounded-xl hover:from-yellow-600 hover:to-orange-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-3">
                                    <i class="fas fa-gift"></i>
                                    <span>Claim Points</span>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-6 justify-center">
                            <button onclick="startQuiz()" 
                                    class="px-10 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-2xl flex items-center justify-center space-x-3">
                                <i class="fas fa-redo"></i>
                                <span>Take Another Quiz</span>
                            </button>
                            
                            <button onclick="reviewAnswers()" 
                                    id="reviewBtn"
                                    class="px-10 py-4 bg-white border-2 border-gray-300 text-gray-700 font-bold text-lg rounded-xl hover:bg-gray-50 hover:border-blue-500 hover:text-blue-600 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                                <i class="fas fa-eye"></i>
                                <span>Review Answers</span>
                            </button>
                            
                            <button onclick="shareResults()" 
                                    class="px-10 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-lg rounded-xl hover:from-green-600 hover:to-emerald-700 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                                <i class="fas fa-share-alt"></i>
                                <span>Share Results</span>
                            </button>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="text-center py-16 animate__animated animate__fadeIn">
                        <div class="w-40 h-40 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-8">
                            <i class="fas fa-question-circle text-gray-400 text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-400 mb-4">No Quiz Started</h3>
                        <p class="text-gray-500 max-w-md mx-auto text-lg mb-8">Select your quiz preferences above and click "Start Quiz" to begin your challenge.</p>
                        <button onclick="startQuiz()" 
                                class="px-10 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-2xl">
                            Start Your First Quiz
                        </button>
                    </div>
                </div>

                <!-- History Section -->
                <div id="history" class="content-section hidden">
                    <div class="mb-8 animate__animated animate__fadeIn">
                        <h1 class="text-4xl font-bold text-gray-800 mb-3 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Quiz History</h1>
                        <p class="text-gray-600 text-lg">Track your progress and review past performances</p>
                    </div>

                    <!-- History Filters -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select id="historyCategory" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Categories</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty</label>
                                <select id="historyDifficulty" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">All Levels</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                                <input type="date" id="historyDateFrom" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                                <input type="date" id="historyDateTo" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <button onclick="loadHistory()" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-2">
                                <i class="fas fa-filter"></i>
                                <span>Apply Filters</span>
                            </button>
                            <button onclick="clearHistoryFilters()" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                Clear All
                            </button>
                        </div>
                    </div>

                    <!-- History Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600" id="historyTotalAttempts">0</div>
                                <div class="text-gray-600">Total Attempts</div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600" id="historyAvgScore">0%</div>
                                <div class="text-gray-600">Average Score</div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-yellow-600" id="historyBestScore">0%</div>
                                <div class="text-gray-600">Best Score</div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600" id="historyTotalPoints">0</div>
                                <div class="text-gray-600">Total Points</div>
                            </div>
                        </div>
                    </div>

                    <!-- History Table -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800">Your Quiz History</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Time</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Difficulty</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Score</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Accuracy</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Time</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Points</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody" class="divide-y divide-gray-200">
                                    <!-- History data will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="p-6 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="text-gray-600 text-sm" id="historyPaginationInfo">
                                    Showing 0 entries
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="changeHistoryPage(-1)" class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" id="historyPrevBtn" disabled>
                                        Previous
                                    </button>
                                    <button onclick="changeHistoryPage(1)" class="px-4 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed" id="historyNextBtn" disabled>
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- No History State -->
                    <div id="noHistoryState" class="text-center py-16 hidden">
                        <div class="w-40 h-40 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-8">
                            <i class="fas fa-history text-gray-400 text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-400 mb-4">No History Yet</h3>
                        <p class="text-gray-500 max-w-md mx-auto text-lg mb-8">Complete your first quiz to see your history here.</p>
                        <button onclick="document.querySelector('a[href=\"#quiz-section\"]').click()" 
                                class="px-10 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-300 shadow-xl hover:shadow-2xl">
                            Take Your First Quiz
                        </button>
                    </div>
                </div>

                <!-- Leaderboard Section -->
                <div id="leaderboard" class="content-section hidden">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-yellow-500 to-orange-500 bg-clip-text text-transparent">Global Leaderboard</h1>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Compete with students worldwide and climb the ranks!</p>
                    </div>
                    
                    <!-- Coming Soon -->
                    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                        <div class="w-32 h-32 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-8">
                            <i class="fas fa-trophy text-yellow-500 text-5xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Leaderboard Coming Soon!</h2>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">We're working on bringing you an exciting global leaderboard feature. Compete with friends and climb the ranks!</p>
                        <div class="flex justify-center space-x-4">
                            <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300">
                                <i class="fas fa-bell mr-2"></i>Notify Me
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Analytics Section -->
                <div id="analytics" class="content-section hidden">
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-green-500 to-emerald-600 bg-clip-text text-transparent">Advanced Analytics</h1>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Deep insights into your learning patterns and performance</p>
                    </div>
                    
                    <!-- Coming Soon -->
                    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                        <div class="w-32 h-32 bg-gradient-to-r from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-8">
                            <i class="fas fa-chart-line text-green-500 text-5xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Advanced Analytics Coming Soon!</h2>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">Get ready for detailed analytics and insights into your learning journey. Track progress, identify strengths, and improve weaknesses.</p>
                        <div class="flex justify-center space-x-4">
                            <button class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300">
                                <i class="fas fa-bell mr-2"></i>Get Notified
                            </button>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 p-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-brain text-white text-sm"></i>
                            </div>
                            <span class="font-bold text-gray-800">QuizMaster Pro</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1">© 2026 All rights reserved • v3.1.0</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-blue-600 transition-colors">
                            <i class="fab fa-facebook text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-blue-800 transition-colors">
                            <i class="fab fa-linkedin text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-800 transition-colors">
                            <i class="fab fa-github text-lg"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Global Variables
        window.quizData = [];
        window.userAnswers = [];
        window.currentQuestion = 0;
        window.score = 0;
        window.quizStarted = false;
        window.quizResults = [];
        window.quizStartTime = null;
        window.quizTimer = null;
        window.elapsedTime = 0;
        window.historyPage = 1;
        window.historyTotalPages = 1;
        window.performanceChart = null;
        window.categoryChart = null;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardStats();
            loadCategories();
            loadHistory();
            updateGreeting();
            setupCharts();
            setupEventListeners();
            
            // Update time every second
            setInterval(updateGreeting, 60000);
            
            // Load dashboard stats every 30 seconds
            setInterval(loadDashboardStats, 30000);
        });

        // Setup event listeners
        function setupEventListeners() {
            // Navigation
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('href').substring(1);
                    
                    // Update active nav item
                    document.querySelectorAll('.nav-item').forEach(nav => {
                        nav.classList.remove('active', 'bg-white/10');
                    });
                    this.classList.add('active', 'bg-white/10');
                    
                    // Show target section
                    document.querySelectorAll('.content-section').forEach(section => {
                        section.classList.add('hidden');
                        section.classList.remove('animate__fadeIn');
                    });
                    const targetSection = document.getElementById(target);
                    targetSection.classList.remove('hidden');
                    targetSection.classList.add('animate__fadeIn');
                    
                    // Load section data
                    if (target === 'dashboard') {
                        loadDashboardStats();
                    } else if (target === 'history') {
                        loadHistory();
                    } else if (target === 'leaderboard') {
                        // Future: Load leaderboard
                    }
                    
                    // Close mobile menu if open
                    document.getElementById('mobileSidebar').classList.add('hidden');
                });
            });

            // Mobile menu
            document.getElementById('mobileMenuBtn').addEventListener('click', function() {
                document.getElementById('mobileSidebar').classList.remove('hidden');
            });

            document.getElementById('closeMobileMenu').addEventListener('click', function() {
                document.getElementById('mobileSidebar').classList.add('hidden');
            });

            // User dropdown
            document.getElementById('userDropdownBtn').addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = document.getElementById('userDropdown');
                dropdown.classList.toggle('hidden');
            });

            // Close dropdowns on outside click
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('userDropdown');
                const dropdownBtn = document.getElementById('userDropdownBtn');
                
                if (!dropdownBtn.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });

            // Notification button
            document.querySelector('.notification-btn').addEventListener('click', function() {
                // Show notifications dropdown (to be implemented)
                alert('Notifications feature coming soon!');
            });

            // History filter inputs
            ['historyCategory', 'historyDifficulty', 'historyDateFrom', 'historyDateTo'].forEach(id => {
                document.getElementById(id).addEventListener('change', loadHistory);
            });

            // Chart time range
            document.getElementById('chartTimeRange').addEventListener('change', loadDashboardStats);
        }

        // Update greeting based on time
        function updateGreeting() {
            const hour = new Date().getHours();
            let greeting = '';
            let emoji = '👋';
            
            if (hour < 12) {
                greeting = 'Good morning';
                emoji = '🌅';
            } else if (hour < 17) {
                greeting = 'Good afternoon';
                emoji = '☀️';
            } else {
                greeting = 'Good evening';
                emoji = '🌙';
            }
            
            document.getElementById('greetingMessage').textContent = `${greeting}! Ready to ace some quizzes today? ${emoji}`;
        }

        // Load dashboard stats
        async function loadDashboardStats() {
            try {
                const response = await fetch('/dashboard/stats', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Failed to load dashboard stats');
                
                const data = await response.json();
                
                if (data.success) {
                    // Update main stats
                    document.getElementById('totalPointsCard').textContent = data.stats.total_points.toLocaleString();
                    document.getElementById('totalQuizzesCard').textContent = data.stats.total_quizzes;
                    document.getElementById('accuracyRate').textContent = data.stats.accuracy + '%';
                    document.getElementById('globalRank').textContent = '#' + data.stats.leaderboard_position;
                    document.getElementById('rankPercentile').textContent = data.stats.rank_percentage + '%';
                    document.getElementById('todayQuizzes').textContent = data.today_quizzes;
                    
                    // Update header stats
                    document.getElementById('totalPoints').textContent = data.stats.total_points.toLocaleString();
                    document.getElementById('streakCount').textContent = data.stats.current_streak;
                    
                    // Update progress bars
                    const pointsProgress = Math.min((data.stats.total_points / 10000) * 100, 100);
                    const quizzesProgress = Math.min((data.today_quizzes / 5) * 100, 100);
                    const accuracyProgress = Math.min(data.stats.accuracy, 100);
                    const rankProgress = Math.min(data.stats.rank_percentage, 100);
                    
                    document.getElementById('pointsProgress').style.width = pointsProgress + '%';
                    document.getElementById('quizzesProgress').style.width = quizzesProgress + '%';
                    document.getElementById('accuracyProgress').style.width = accuracyProgress + '%';
                    document.getElementById('rankProgress').style.width = rankProgress + '%';
                    
                    // Update daily progress
                    const dailyProgress = Math.min((data.today_quizzes / 3) * 100, 100);
                    document.getElementById('dailyProgress').textContent = dailyProgress.toFixed(0) + '%';
                    document.getElementById('dailyProgressPercent').textContent = dailyProgress.toFixed(0) + '%';
                    document.getElementById('dailyProgressBar').style.width = dailyProgress + '%';
                    
                    // Update circle progress
                    const circle = document.getElementById('dailyProgressCircle');
                    const circumference = 2 * Math.PI * 15.9155;
                    const offset = circumference - (dailyProgress / 100) * circumference;
                    circle.style.strokeDasharray = `${circumference} ${circumference}`;
                    circle.style.strokeDashoffset = offset;
                    
                    // Update recent activity
                    updateRecentActivity(data.recent_activity);
                    
                    // Update charts
                    updatePerformanceChart(data.recent_activity);
                    updateCategoryChart(data.category_performance);
                    
                }
            } catch (error) {
                console.error('Error loading dashboard stats:', error);
            }
        }

        // Update recent activity
        function updateRecentActivity(activity) {
            const container = document.getElementById('recentActivityList');
            const countElement = document.getElementById('recentActivityCount');
            
            if (!activity || activity.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-6">
                        <i class="fas fa-inbox text-gray-300 text-3xl mb-3"></i>
                        <p class="text-gray-500">No recent activity</p>
                    </div>
                `;
                countElement.textContent = '0 items';
                return;
            }
            
            let html = '';
            activity.forEach((item, index) => {
                const date = new Date(item.date);
                const formattedDate = date.toLocaleDateString('en-US', { 
                    month: 'short', 
                    day: 'numeric' 
                });
                
                html += `
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-xl transition-colors ${index < 3 ? '' : 'hidden'}">
                        <div class="w-10 h-10 ${getPerformanceColor(item.avg_score)} rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-800">Completed ${item.count} quiz${item.count > 1 ? 's' : ''}</div>
                            <div class="text-sm text-gray-500">Average score: ${parseFloat(item.avg_score).toFixed(1)}% • ${formattedDate}</div>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-1 text-xs font-medium ${getPerformanceColor(item.avg_score)} text-white rounded-full">
                                ${parseFloat(item.avg_score).toFixed(0)}%
                            </span>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
            countElement.textContent = activity.length + ' items';
        }

        // Get performance color based on score
        function getPerformanceColor(score) {
            if (score >= 90) return 'bg-gradient-to-r from-green-500 to-emerald-600';
            if (score >= 75) return 'bg-gradient-to-r from-blue-500 to-purple-600';
            if (score >= 60) return 'bg-gradient-to-r from-yellow-500 to-orange-500';
            return 'bg-gradient-to-r from-red-500 to-pink-600';
        }

        // Setup charts
        function setupCharts() {
            // Performance chart
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            window.performanceChart = new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Score (%)',
                        data: [],
                        borderColor: '#4361ee',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4361ee',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: { size: 12 },
                            bodyFont: { size: 14 },
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: { size: 11 },
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: { size: 11 }
                            }
                        }
                    }
                }
            });

            // Category chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            window.categoryChart = new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Accuracy (%)',
                        data: [],
                        backgroundColor: [
                            'rgba(67, 97, 238, 0.8)',
                            'rgba(76, 201, 240, 0.8)',
                            'rgba(247, 37, 133, 0.8)',
                            'rgba(67, 97, 238, 0.6)',
                            'rgba(76, 201, 240, 0.6)'
                        ],
                        borderColor: [
                            '#4361ee',
                            '#4cc9f0',
                            '#f72585',
                            '#4361ee',
                            '#4cc9f0'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: { size: 11 },
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: { size: 11 }
                            }
                        }
                    }
                }
            });
        }

        // Update performance chart
        function updatePerformanceChart(activity) {
            if (!window.performanceChart || !activity) return;
            
            const labels = activity.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            });
            
            const scores = activity.map(item => parseFloat(item.avg_score));
            
            window.performanceChart.data.labels = labels;
            window.performanceChart.data.datasets[0].data = scores;
            window.performanceChart.update();
        }

        // Update category chart
        function updateCategoryChart(categories) {
            if (!window.categoryChart || !categories) return;
            
            const labels = categories.map(item => item.category);
            const scores = categories.map(item => parseFloat(item.avg_score));
            
            window.categoryChart.data.labels = labels;
            window.categoryChart.data.datasets[0].data = scores;
            window.categoryChart.update();
        }

        // Load categories
        async function loadCategories() {
            try {
                const response = await fetch('/categories', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Failed to load categories');
                
                const data = await response.json();
                
                if (Array.isArray(data)) {
                    const categorySelect = document.getElementById('category');
                    const historyCategorySelect = document.getElementById('historyCategory');
                    
                    // Clear existing options
                    categorySelect.innerHTML = '<option value="">Any Category</option>';
                    historyCategorySelect.innerHTML = '<option value="">All Categories</option>';
                    
                    data.forEach(item => {
                        const option = `<option value="${item.id}">${item.display_name || item.name}</option>`;
                        categorySelect.innerHTML += option;
                        historyCategorySelect.innerHTML += option;
                    });
                }
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        }

        // Start quiz
        async function startQuiz(category, difficulty) {
            const categorySelect = document.getElementById('category');
            const difficultySelect = document.getElementById('difficulty');
            const limitSelect = document.getElementById('limit');
            
            // Set values if provided
            if (category) {
                categorySelect.value = category;
            }
            if (difficulty) {
                difficultySelect.value = difficulty;
            }
            
            const categoryVal = categorySelect.value;
            const difficultyVal = difficultySelect.value;
            const limitVal = limitSelect.value;
            
            // Navigate to quiz section
            document.querySelector('a[href="#quiz-section"]').click();
            
            // Show loading state
            document.getElementById('quiz').innerHTML = `
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center animate__animated animate__fadeIn">
                    <div class="relative inline-block mb-6">
                        <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <div class="animate-spin rounded-full h-20 w-20 border-b-2 border-blue-600"></div>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-brain text-blue-600 text-3xl"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Preparing Your Quiz</h3>
                    <p class="text-gray-600 mb-8">Loading questions from our intelligent database...</p>
                    <div class="w-64 bg-gray-200 rounded-full h-2 mx-auto overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full animate-pulse" style="width: 80%"></div>
                    </div>
                </div>
            `;
            
            // Show progress section
            document.getElementById('progressSection').classList.remove('hidden');
            document.getElementById('emptyState').classList.add('hidden');
            document.getElementById('resultsSection').classList.add('hidden');
            
            // Reset variables
            window.quizData = [];
            window.userAnswers = [];
            window.currentQuestion = 0;
            window.score = 0;
            window.quizStarted = false;
            window.elapsedTime = 0;
            
            // Clear timer
            if (window.quizTimer) {
                clearInterval(window.quizTimer);
            }
            
            // Start timer
            window.quizStartTime = Date.now();
            window.quizTimer = setInterval(updateQuizTimer, 1000);
            
            // Build API URL
            let url = `/quiz-data?limit=${limitVal}`;
            if (categoryVal) url += `&category=${categoryVal}`;
            if (difficultyVal) url += `&difficulty=${difficultyVal}`;
            
            try {
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (!data || !Array.isArray(data) || data.length === 0) {
                    document.getElementById('quiz').innerHTML = `
                        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                            <div class="w-24 h-24 bg-gradient-to-r from-red-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">No Questions Available</h3>
                            <p class="text-gray-600 mb-6">Try selecting different quiz parameters or try again later.</p>
                            <div class="flex justify-center space-x-4">
                                <button onclick="startQuiz()" 
                                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-colors">
                                    Try Again
                                </button>
                                <button onclick="document.getElementById('emptyState').classList.remove('hidden')" 
                                        class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                    Go Back
                                </button>
                            </div>
                        </div>
                    `;
                    return;
                }
                
                // Initialize quiz
                window.quizData = data;
                window.userAnswers = new Array(data.length).fill(null);
                window.score = 0;
                window.quizStarted = true;
                window.currentQuestion = 0;
                
                // Update progress
                updateProgress();
                
                // Display questions
                displayQuestions();
                
                // Setup question navigation
                setupQuestionNavigation();
                
            } catch (error) {
                console.error('Quiz fetch error:', error);
                document.getElementById('quiz').innerHTML = `
                    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-exclamation-circle text-yellow-500 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Connection Error</h3>
                        <p class="text-gray-600 mb-6">Unable to load quiz. Please check your connection and try again.</p>
                        <div class="flex justify-center space-x-4">
                            <button onclick="startQuiz()" 
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-colors">
                                Retry
                            </button>
                            <button onclick="document.getElementById('emptyState').classList.remove('hidden')" 
                                    class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                Go Back
                            </button>
                        </div>
                    </div>
                `;
            }
        }

        // Update quiz timer
        function updateQuizTimer() {
            if (window.quizStartTime) {
                window.elapsedTime = Math.floor((Date.now() - window.quizStartTime) / 1000);
                const minutes = Math.floor(window.elapsedTime / 60);
                const seconds = window.elapsedTime % 60;
               
            }
        }

        // Display questions
        function displayQuestions() {
            const quizContainer = document.getElementById('quiz');
            quizContainer.innerHTML = '';
            
            if (!window.quizData || !Array.isArray(window.quizData) || window.quizData.length === 0) {
                quizContainer.innerHTML = `
                    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-red-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Questions Loaded</h3>
                        <p class="text-gray-600 mb-6">Please try starting a new quiz.</p>
                    </div>
                `;
                return;
            }
            
            window.quizData.forEach((question, index) => {
                if (!question.answers) return;
                
                const answers = Object.entries(question.answers)
                    .filter(([key, value]) => value && value.trim() !== '')
                    .map(([key, value]) => ({
                        key,
                        value,
                        isSelected: window.userAnswers[index] === key
                    }));
                
                if (answers.length === 0) return;
                
                const questionHTML = `
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 quiz-question animate__animated animate__fadeIn" 
                         id="question-${index}">
                        <div class="p-6 md:p-8 border-b border-gray-100">
                            <div class="flex flex-col md:flex-row md:items-start justify-between">
                                <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-600 rounded-2xl flex items-center justify-center font-bold text-xl flex-shrink-0">
                                        ${index + 1}
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold text-gray-800 leading-relaxed">${question.question || 'No question text available'}</h3>
                                        <div class="flex items-center space-x-3 mt-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-tag mr-1"></i> ${question.category || 'General'}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span class="px-4 py-2 text-sm font-bold rounded-xl 
                                    ${question.difficulty === 'Easy' ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200' : 
                                      question.difficulty === 'Medium' ? 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 border border-yellow-200' : 
                                      'bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200'}">
                                    ${question.difficulty || 'Mixed'}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6 md:p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                ${answers.map((answer, i) => `
                                    <div class="quiz-option ${answer.isSelected ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-blue-300' : 'bg-gray-50 border-gray-200'} 
                                         border-2 rounded-2xl p-6 cursor-pointer transition-all duration-300 hover:border-blue-400 hover:shadow-lg"
                                         onclick="selectAnswer(${index}, '${answer.key}')">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-xl ${answer.isSelected ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white' : 'bg-white text-gray-600 border'} 
                                                 flex items-center justify-center mr-4 font-bold text-lg flex-shrink-0 shadow-sm">
                                                ${String.fromCharCode(65 + i)}
                                            </div>
                                            <span class="text-gray-700 text-lg break-words flex-1">${answer.value}</span>
                                            ${answer.isSelected ? `
                                                <div class="ml-4">
                                                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg">
                                                        <i class="fas fa-check text-white text-sm"></i>
                                                    </div>
                                                </div>
                                            ` : ''}
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                        
                        <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center">
                            <div class="flex items-center text-gray-600 mb-2 sm:mb-0">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                <span class="text-sm">Select one answer to proceed</span>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium ${window.userAnswers[index] ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200' : 'bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 border border-yellow-200'}">
                                    ${window.userAnswers[index] ? 
                                        '<i class="fas fa-check-circle mr-2"></i> Answered' : 
                                        '<i class="fas fa-clock mr-2"></i> Answer it Correctly'}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
                
                quizContainer.innerHTML += questionHTML;
            });
            
            if (window.quizData.length > 0) {
                quizContainer.innerHTML += `
                    <div class="mt-10 text-center animate__animated animate__fadeInUp">
                        <div class="mb-6">
                            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-50 to-emerald-100 rounded-2xl border border-green-200">
                                <i class="fas fa-check-circle text-green-600 mr-3 text-xl"></i>
                                <span class="text-gray-700 font-medium">You've answered <span id="answeredCount" class="font-bold text-green-600">0</span> out of <span class="font-bold text-gray-800">${window.quizData.length}</span> questions</span>
                            </div>
                        </div>
                        <button onclick="submitQuiz()" 
                                class="px-12 py-5 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-xl rounded-2xl hover:from-green-600 hover:to-emerald-700 transform hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 shadow-xl flex items-center justify-center space-x-4 mx-auto pulse-animation">
                            <i class="fas fa-paper-plane text-2xl"></i>
                            <span>Submit Quiz</span>
                            <i class="fas fa-arrow-right text-xl"></i>
                        </button>
                        <p class="text-gray-500 text-sm mt-4">Make sure to review all answers before submitting</p>
                    </div>
                `;
                updateAnsweredCount();
            }
        }

        // Select answer
        function selectAnswer(questionIndex, answerKey) {
            if (!window.quizData || !Array.isArray(window.quizData)) return;
            
            window.userAnswers[questionIndex] = answerKey;
            
            // Update UI
            const questionElement = document.getElementById(`question-${questionIndex}`);
            if (!questionElement) return;
            
            const options = questionElement.querySelectorAll('.quiz-option');
            
            options.forEach(option => {
                option.classList.remove('bg-gradient-to-r', 'from-blue-50', 'to-purple-50', 'border-blue-300');
                option.classList.add('bg-gray-50', 'border-gray-200');
                const prefix = option.querySelector('.w-10.h-10');
                if (prefix) {
                    prefix.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-purple-600', 'text-white');
                    prefix.classList.add('bg-white', 'text-gray-600', 'border');
                }
                
                const checkIcon = option.querySelector('.fa-check');
                if (checkIcon) {
                    checkIcon.parentElement.parentElement.remove();
                }
            });
            
            // Mark selected option
            const selectedOption = questionElement.querySelector(`[onclick*="${answerKey}"]`);
            if (selectedOption) {
                selectedOption.classList.remove('bg-gray-50', 'border-gray-200');
                selectedOption.classList.add('bg-gradient-to-r', 'from-blue-50', 'to-purple-50', 'border-blue-300');
                const prefix = selectedOption.querySelector('.w-10.h-10');
                if (prefix) {
                    prefix.classList.remove('bg-white', 'text-gray-600', 'border');
                    prefix.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-purple-600', 'text-white');
                }
                
                // Add check icon
                const flexContainer = selectedOption.querySelector('.flex.items-center');
                if (flexContainer) {
                    flexContainer.innerHTML += `
                        <div class="ml-4">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                        </div>
                    `;
                }
            }
            
            // Update status
            const statusSpan = questionElement.querySelector('.inline-flex.items-center');
            if (statusSpan) {
                statusSpan.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Answered';
                statusSpan.className = 'inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200';
            }
            
            updateProgress();
            updateAnsweredCount();
        }

        // Update answered count
        function updateAnsweredCount() {
            const answered = window.userAnswers.filter(answer => answer !== null).length;
            document.getElementById('answeredCount').textContent = answered;
        }

        // Update progress
        function updateProgress() {
            if (!window.quizStarted || !window.quizData) return;
            
            const answered = window.userAnswers.filter(answer => answer !== null).length;
            const total = window.quizData.length;
            const percentage = total > 0 ? Math.round((answered / total) * 100) : 0;
            
            // Update progress bar
            document.getElementById('progressBar').style.width = `${percentage}%`;
            document.getElementById('progressPercent').textContent = `${percentage}%`;
            document.getElementById('progressText').textContent = `${answered} of ${total} questions answered`;
            document.getElementById('scoreDisplay').textContent = `${window.score}/${total}`;
            
            // Update counts
            const correctCount = window.userAnswers.filter((answer, index) => {
                if (!answer || !window.quizData[index] || !window.quizData[index].correct_answers) return false;
                const correctKey = `${answer}_correct`;
                return window.quizData[index].correct_answers[correctKey] === "true";
            }).length;
            
            const incorrectCount = answered - correctCount;
            
            setupQuestionNavigation();
        }

        // Setup question navigation
        function setupQuestionNavigation() {
            const navContainer = document.getElementById('questionNav');
            if (!navContainer || !window.quizData) return;
            
            navContainer.innerHTML = '';
            
            window.quizData.forEach((_, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = `w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg transition-all duration-300 transform hover:scale-110
                    ${window.userAnswers[index] ? 
                        'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg' : 
                        index === window.currentQuestion ? 
                        'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 
                        'bg-gray-100 text-gray-600 hover:bg-gray-200'}`;
                button.textContent = index + 1;
                button.onclick = () => scrollToQuestion(index);
                
                navContainer.appendChild(button);
            });
        }

        // Scroll to question
        function scrollToQuestion(index) {
            window.currentQuestion = index;
            const element = document.getElementById(`question-${index}`);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                element.classList.add('animate__pulse');
                setTimeout(() => {
                    element.classList.remove('animate__pulse');
                }, 1000);
                setupQuestionNavigation();
            }
        }

        // Submit quiz
        async function submitQuiz() {
            if (!window.quizData || !Array.isArray(window.quizData) || window.quizData.length === 0) {
                alert('No quiz data available. Please start a new quiz.');
                return;
            }
            
            const unanswered = window.userAnswers.filter(answer => answer === null).length;
            if (unanswered > 0) {
                const confirmSubmit = await showConfirmationModal(
                    'Unanswered Questions',
                    `You have ${unanswered} unanswered question(s). Are you sure you want to submit?`,
                    'warning'
                );
                if (!confirmSubmit) return;
            }
            
            // Calculate score
            window.score = 0;
            const results = [];
            
            window.quizData.forEach((question, index) => {
                const userAnswer = window.userAnswers[index];
                let isCorrect = false;
                
                if (userAnswer && question.correct_answers) {
                    const correctKey = `${userAnswer}_correct`;
                    if (question.correct_answers[correctKey] === "true") {
                        isCorrect = true;
                        window.score++;
                    }
                }
                
                results.push({
                    question: question.question || 'No question text',
                    userAnswer,
                    correct: isCorrect,
                    correctAnswers: question.correct_answers ? 
                        Object.entries(question.correct_answers)
                            .filter(([key, value]) => value === "true")
                            .map(([key]) => key.replace('_correct', '')) : []
                });
            });
            
            // Stop timer
            if (window.quizTimer) {
                clearInterval(window.quizTimer);
                window.quizTimer = null;
            }
            
            // Calculate final time
            const finalTime = window.elapsedTime;
            
            // Calculate percentages
            const total = window.quizData.length;
            const percentage = total > 0 ? Math.round((window.score / total) * 100) : 0;
            const correctAnswers = window.score;
            const incorrectAnswers = total - window.sco
            
            // Submit to server
            try {
                const response = await fetch('/quiz/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        score: window.score,
                        total_questions: total,
                        correct_answers: correctAnswers,
                        incorrect_answers: incorrectAnswers,
                        percentage: percentage,
                        category: document.getElementById('category').value,
                        difficulty: document.getElementById('difficulty').value,
                        time_taken: finalTime,
                        details: results
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update total points in header
                    document.getElementById('totalPoints').textContent = data.total_points.toLocaleString();
                    
                    // Show results with server data
                    showResults(results, percentage, total, correctAnswers, incorrectAnswers, finalTime, data.points_earned);
                } else {
                    throw new Error('Failed to save quiz results');
                }
            } catch (error) {
                console.error('Error submitting quiz:', error);
                // Show results anyway (offline mode)
                showResults(results, percentage, total, correctAnswers, incorrectAnswers, finalTime, 0);
            }
        }

        // Show confirmation modal
        function showConfirmationModal(title, message, type) {
            return new Promise((resolve) => {
                // Create modal
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4';
                modal.innerHTML = `
                    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate__animated animate__zoomIn">
                        <div class="p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 ${type === 'warning' ? 'bg-gradient-to-r from-yellow-100 to-orange-100' : 'bg-gradient-to-r from-blue-100 to-purple-100'} rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle ${type === 'warning' ? 'text-yellow-600' : 'text-blue-600'} text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">${title}</h3>
                                    <p class="text-gray-600">${message}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                            <button onclick="this.closest('.fixed').remove(); resolve(false)" 
                                    class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button onclick="this.closest('.fixed').remove(); resolve(true)" 
                                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-colors">
                                Submit Anyway
                            </button>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(modal);
            });
        }

        // Show results
        function showResults(results, percentage, total, correct, incorrect, timeTaken, pointsEarned) {
            // Format time
            const minutes = Math.floor(timeTaken / 60);
            const seconds = timeTaken % 60;
            const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            // Update UI
            document.getElementById('finalScore').textContent = `${correct}/${total}`;
            document.getElementById('correctCount').textContent = correct;
            document.getElementById('incorrectCount').textContent = incorrect;
            document.getElementById('percentageScore').textContent = `${percentage}%`;
            document.getElementById('timeTaken').textContent = formattedTime;
            document.getElementById('pointsEarned').textContent = `+${pointsEarned} Points`;
            
            // Update performance bar
            const performanceBar = document.getElementById('performanceBar');
            const performanceMarker = document.getElementById('performanceMarker');
            if (performanceBar) {
                performanceBar.style.width = `${percentage}%`;
                performanceMarker.style.left = `${percentage}%`;
                performanceMarker.innerHTML = `
                    <div class="w-4 h-4 bg-gray-800 rounded-full mx-auto mb-1"></div>
                    <div>${percentage}%</div>
                `;
            }
            
            // Set performance text
            let performanceText = '';
            let performanceSubtext = '';
            let performanceEmoji = '';
            
            if (percentage >= 90) {
                performanceText = 'Outstanding Performance! 🏆';
                performanceSubtext = 'You\'re a quiz master! Perfect score territory!';
                performanceEmoji = '🎯';
            } else if (percentage >= 75) {
                performanceText = 'Excellent Work! 🌟';
                performanceSubtext = 'Great job! You\'re mastering the material.';
                performanceEmoji = '✨';
            } else if (percentage >= 60) {
                performanceText = 'Good Job! 👍';
                performanceSubtext = 'Solid performance. Keep practicing!';
                performanceEmoji = '📈';
            } else if (percentage >= 40) {
                performanceText = 'Not Bad! 💪';
                performanceSubtext = 'Good effort. Review and try again!';
                performanceEmoji = '🎯';
            } else {
                performanceText = 'Keep Learning! 📚';
                performanceSubtext = 'Don\'t give up! Practice makes perfect.';
                performanceEmoji = '🚀';
            }
            
            document.getElementById('performanceText').textContent = performanceText + ' ' + performanceEmoji;
            document.getElementById('performanceSubtext').textContent = performanceSubtext;
            
            // Hide quiz and show results
            document.getElementById('quiz').innerHTML = '';
            document.getElementById('progressSection').classList.add('hidden');
            document.getElementById('resultsSection').classList.remove('hidden');
            
            // Scroll to results
            document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });
            
            // Store results for review
            window.quizResults = results;
            
            // Load dashboard stats to update points
            loadDashboardStats();
        }

        // Claim points
        function claimPoints() {
            alert('Points claimed successfully! They have been added to your total.');
            loadDashboardStats();
        }

        // Review answers
        function reviewAnswers() {
            const quizContainer = document.getElementById('quiz');
            const reviewBtn = document.getElementById('reviewBtn');
            
            if (!quizContainer || !reviewBtn) return;
            
            if (reviewBtn.textContent.includes('Review')) {
                // Show review
                quizContainer.innerHTML = '';
                
                if (!window.quizResults || !Array.isArray(window.quizResults)) {
                    quizContainer.innerHTML = '<p class="text-center text-gray-600">No results to review.</p>';
                    return;
                }
                
                window.quizResults.forEach((result, index) => {
                    const question = window.quizData[index];
                    if (!question) return;
                    
                    const answers = question.answers ? 
                        Object.entries(question.answers)
                            .filter(([key, value]) => value && value.trim() !== '')
                            .map(([key, value]) => ({
                                key,
                                value,
                                isUserAnswer: window.userAnswers[index] === key,
                                isCorrect: result.correctAnswers.includes(key)
                            })) : [];
                    
                    if (answers.length === 0) return;
                    
                    const questionHTML = `
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border ${result.correct ? 'border-green-200' : 'border-red-200'} mb-6 animate__animated animate__fadeIn">
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex flex-col md:flex-row md:items-start justify-between">
                                    <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                        <div class="w-12 h-12 ${result.correct ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-600' : 'bg-gradient-to-r from-red-100 to-pink-100 text-red-600'} rounded-2xl flex items-center justify-center font-bold text-xl flex-shrink-0">
                                            ${index + 1}
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl font-semibold text-gray-800">${question.question || 'No question text'}</h3>
                                            <div class="flex items-center space-x-3 mt-3">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${result.correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                                    <i class="fas fa-${result.correct ? 'check' : 'times'} mr-1"></i>
                                                    ${result.correct ? 'Correct' : 'Incorrect'}
                                                </span>
                                                <span class="text-gray-500 text-sm">
                                                    ${question.category || 'General'} • ${question.difficulty || 'Mixed'}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    ${answers.map((answer, i) => {
                                        let bgClass = 'bg-gray-50';
                                        let borderClass = 'border-gray-200';
                                        let prefixClass = 'bg-white text-gray-600 border';
                                        let checkIcon = '';
                                        
                                        if (answer.isCorrect) {
                                            bgClass = 'bg-gradient-to-r from-green-50 to-emerald-50';
                                            borderClass = 'border-green-300';
                                            prefixClass = 'bg-gradient-to-r from-green-500 to-emerald-600 text-white';
                                            checkIcon = '<div class="ml-4"><div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center shadow-lg"><i class="fas fa-check text-white text-sm"></i></div></div>';
                                        }
                                        
                                        if (answer.isUserAnswer && !answer.isCorrect) {
                                            bgClass = 'bg-gradient-to-r from-red-50 to-pink-50';
                                            borderClass = 'border-red-300';
                                            prefixClass = 'bg-gradient-to-r from-red-500 to-pink-600 text-white';
                                            checkIcon = '<div class="ml-4"><div class="w-8 h-8 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center shadow-lg"><i class="fas fa-times text-white text-sm"></i></div></div>';
                                        }
                                        
                                        return `
                                            <div class="${bgClass} ${borderClass} border-2 rounded-2xl p-6">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 rounded-xl ${prefixClass} flex items-center justify-center mr-4 font-bold text-lg flex-shrink-0">
                                                        ${String.fromCharCode(65 + i)}
                                                    </div>
                                                    <span class="text-gray-700 text-lg break-words flex-1">${answer.value}</span>
                                                    ${checkIcon}
                                                </div>
                                            </div>
                                        `;
                                    }).join('')}
                                </div>
                                
                                ${!result.correct ? `
                                    <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-2xl">
                                        <div class="flex items-start space-x-4">
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-lightbulb text-white text-xl"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-blue-800 text-lg mb-2">Learning Tip</div>
                                                <div class="text-blue-700">Review this question and understand why your answer was incorrect. The correct answer${result.correctAnswers.length > 1 ? 's are' : ' is'} marked in green.</div>
                                            </div>
                                        </div>
                                    </div>
                                ` : `
                                    <div class="mt-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl">
                                        <div class="flex items-start space-x-4">
                                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-check-circle text-white text-xl"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-green-800 text-lg mb-2">Great Job!</div>
                                                <div class="text-green-700">You answered this question correctly. Keep up the good work!</div>
                                            </div>
                                        </div>
                                    </div>
                                `}
                            </div>
                        </div>
                    `;
                    
                    quizContainer.innerHTML += questionHTML;
                });
                
                reviewBtn.innerHTML = `
                    <i class="fas fa-times"></i>
                    <span>Close Review</span>
                `;
                
                // Scroll to quiz section
                quizContainer.scrollIntoView({ behavior: 'smooth' });
                
            } else {
                // Close review
                quizContainer.innerHTML = '';
                reviewBtn.innerHTML = `
                    <i class="fas fa-eye"></i>
                    <span>Review Answers</span>
                `;
            }
        }

        // Share results
        function shareResults() {
            const score = window.score;
            const total = window.quizData.length;
            const percentage = Math.round((score / total) * 100);
            
            const shareText = `I just scored ${score}/${total} (${percentage}%) on QuizMaster Pro! 🎯 Test your knowledge too!`;
            
            if (navigator.share) {
                navigator.share({
                    title: 'My Quiz Results',
                    text: shareText,
                    url: window.location.href
                });
            } else {
                // Fallback: Copy to clipboard
                navigator.clipboard.writeText(shareText).then(() => {
                    alert('Results copied to clipboard! Share with your friends.');
                });
            }
        }

        // Load history
        async function loadHistory() {
            try {
                const category = document.getElementById('historyCategory').value;
                const difficulty = document.getElementById('historyDifficulty').value;
                const dateFrom = document.getElementById('historyDateFrom').value;
                const dateTo = document.getElementById('historyDateTo').value;
                
                let url = `/quiz/history?page=${window.historyPage}`;
                if (category) url += `&category=${category}`;
                if (difficulty) url += `&difficulty=${difficulty}`;
                if (dateFrom) url += `&date_from=${dateFrom}`;
                if (dateTo) url += `&date_to=${dateTo}`;
                
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Failed to load history');
                
                const data = await response.json();
                
                if (data.success) {
                    updateHistoryTable(data.history.data);
                    updateHistoryStats(data.stats);
                    updateHistoryPagination(data.history);
                    
                    // Show/hide no history state
                    if (data.history.data.length === 0) {
                        document.getElementById('noHistoryState').classList.remove('hidden');
                        document.querySelector('#history .bg-white.rounded-2xl').classList.add('hidden');
                    } else {
                        document.getElementById('noHistoryState').classList.add('hidden');
                        document.querySelector('#history .bg-white.rounded-2xl').classList.remove('hidden');
                    }
                }
            } catch (error) {
                console.error('Error loading history:', error);
                document.getElementById('historyTableBody').innerHTML = `
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-red-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Error Loading History</h3>
                            <p class="text-gray-600">Please try again later.</p>
                        </td>
                    </tr>
                `;
            }
        }

        // Update history table
        function updateHistoryTable(history) {
            const tbody = document.getElementById('historyTableBody');
            tbody.innerHTML = '';
            
            if (!history || history.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-400 mb-2">No History Found</h3>
                            <p class="text-gray-500">Try changing your filters or take a new quiz.</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            history.forEach(item => {
                const date = new Date(item.created_at);
                const formattedDate = date.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                const timeTaken = item.time_taken || 0;
                const minutes = Math.floor(timeTaken / 60);
                const seconds = timeTaken % 60;
                const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                const row = `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${formattedDate}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                ${item.category || 'General'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${getDifficultyColor(item.difficulty)}">
                                ${item.difficulty || 'Mixed'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">${item.score}/${item.total_questions}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                    <div class="h-2 rounded-full ${getPerformanceColor(item.percentage)}" style="width: ${item.percentage}%"></div>
                                </div>
                                <span class="text-sm font-medium ${getPerformanceTextColor(item.percentage)}">
                                    ${item.percentage}%
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            ${formattedTime}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                <span class="font-bold text-gray-900">${item.points_earned}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="viewHistoryDetail(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="retakeQuiz(${item.id})" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-redo"></i>
                            </button>
                        </td>
                    </tr>
                `;
                
                tbody.innerHTML += row;
            });
        }

        // Get difficulty color
        function getDifficultyColor(difficulty) {
            switch(difficulty) {
                case 'Easy': return 'bg-green-100 text-green-800';
                case 'Medium': return 'bg-yellow-100 text-yellow-800';
                case 'Hard': return 'bg-red-100 text-red-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        // Get performance text color
        function getPerformanceTextColor(percentage) {
            if (percentage >= 90) return 'text-green-600';
            if (percentage >= 75) return 'text-blue-600';
            if (percentage >= 60) return 'text-yellow-600';
            return 'text-red-600';
        }

        // Update history stats
        function updateHistoryStats(stats) {
            document.getElementById('historyTotalAttempts').textContent = stats.total_attempts;
            document.getElementById('historyAvgScore').textContent = stats.average_score + '%';
            document.getElementById('historyBestScore').textContent = stats.best_score + '%';
            document.getElementById('historyTotalPoints').textContent = stats.total_points;
        }

        // Update history pagination
        function updateHistoryPagination(pagination) {
            window.historyTotalPages = pagination.last_page;
            
            document.getElementById('historyPaginationInfo').textContent = 
                `Showing ${pagination.from || 0} to ${pagination.to || 0} of ${pagination.total} entries`;
            
            document.getElementById('historyPrevBtn').disabled = pagination.current_page === 1;
            document.getElementById('historyNextBtn').disabled = pagination.current_page === pagination.last_page;
        }

        // Change history page
        function changeHistoryPage(delta) {
            const newPage = window.historyPage + delta;
            if (newPage >= 1 && newPage <= window.historyTotalPages) {
                window.historyPage = newPage;
                loadHistory();
            }
        }

        // Clear history filters
        function clearHistoryFilters() {
            document.getElementById('historyCategory').value = '';
            document.getElementById('historyDifficulty').value = '';
            document.getElementById('historyDateFrom').value = '';
            document.getElementById('historyDateTo').value = '';
            window.historyPage = 1;
            loadHistory();
        }

        function viewHistoryDetail(historyId) {
            alert(`Viewing details for history ID: ${historyId}\n\nThis feature will show detailed question-by-question results.`);
        }

        function retakeQuiz(historyId) {
            alert(`Retaking quiz from history ID: ${historyId}\n\nThis feature will recreate a similar quiz for you to retake.`);
        }

        async function loadCategoryStats() {
            try {
                const response = await fetch('/category/stats', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Failed to load category stats');
                
                const data = await response.json();
                
                if (data.success) {
                    updateCategoryChart(data.categories);
                }
            } catch (error) {
                console.error('Error loading category stats:', error);
            }
        }
    </script>
</body>
</html>