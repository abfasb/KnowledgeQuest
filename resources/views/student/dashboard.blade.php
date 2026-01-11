<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel - Quiz Master</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .quiz-option {
            transition: all 0.3s ease;
        }
        
        .quiz-option:hover {
            transform: translateY(-2px);
        }
        
        .progress-bar {
            transition: width 0.5s ease;
        }
        
        .question-number.active {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .quiz-card {
            transition: all 0.3s ease;
        }
        
        .quiz-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white shadow-xl hidden md:flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-blue-700">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-graduation-cap mr-3 text-yellow-400"></i>
                    QuizMaster
                </h1>
                <p class="text-blue-300 text-sm mt-1">Student Learning Portal</p>
            </div>

            <div class="p-6 border-b border-blue-700">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-xl font-bold">
                        {{ strtoupper(substr(auth()->user()->first_name ?? '', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold">{{ auth()->user()->first_name}} {{ auth()->user()->last_name}}</h3>
                        <p class="text-sm text-blue-300">Student</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#dashboard" class="flex items-center p-3 rounded-lg bg-blue-700 text-white nav-item active">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#quiz-section" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200 nav-item">
                            <i class="fas fa-question-circle mr-3"></i>
                            Take Quiz
                        </a>
                    </li>
                    <li>
                        <a href="#history" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200 nav-item">
                            <i class="fas fa-history mr-3"></i>
                            History
                        </a>
                    </li>
                    <li>
                        <a href="#settings" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200 nav-item">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Progress Bar -->
            <div class="p-6 border-t border-blue-700">
                <p class="text-blue-300 text-sm mb-2">Weekly Progress</p>
                <div class="w-full bg-blue-900 rounded-full h-2 mb-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width: 75%"></div>
                </div>
                <p class="text-blue-400 text-xs">75% of weekly goal completed</p>
            </div>

            <!-- Footer -->
            <div class="p-6 border-t border-blue-700 text-center">
                <p class="text-blue-300 text-sm">© 2026 QuizMaster</p>
                <p class="text-blue-400 text-xs mt-1">v2.1.0</p>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Header -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Search Bar -->
                <div class="flex-1 max-w-2xl mx-4">
                    <div class="relative">
                        <input type="text" placeholder="Search quizzes, categories, or topics..." class="w-full p-3 pl-12 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-6">
                    <!-- Points Badge -->
                    <div class="hidden md:flex items-center bg-yellow-50 px-4 py-2 rounded-full">
                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                        <span class="text-yellow-800 font-bold">1,850</span>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button class="text-gray-700 hover:text-blue-600 transition duration-200 relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>
                    </div>

                    <!-- Messages -->
                    <div class="relative">
                        <button class="text-gray-700 hover:text-blue-600 transition duration-200 relative">
                            <i class="fas fa-envelope text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-yellow-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">1</span>
                        </button>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                 {{ strtoupper(substr(auth()->user()->first_name ?? '', 0, 1)) }}
                            </div>
                            <i class="fas fa-chevron-down text-gray-600 hidden md:block"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 hidden z-10">
                            <div class="p-4 border-b">
                                <p class="font-semibold text-gray-800">{{ auth()->user()->first_name}} {{ auth()->user()->last_name}}</p>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email}}</p>
                                <div class="flex items-center mt-2">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">Student</span>
                                    <span class="ml-2 text-xs text-gray-500">Level 15</span>
                                </div>
                            </div>
                            <div class="p-2">
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <span>Profile</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-cog text-green-600"></i>
                                    </div>
                                    <span>Settings</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-question-circle text-yellow-600"></i>
                                    </div>
                                    <span>Help & Support</span>
                                </a>
                                <div class="border-t my-2"></div>
                                <a href="#" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-sign-out-alt text-red-600"></i>
                                    </div>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Sidebar -->
            <div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden">
                <div class="w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white h-full animate__animated animate__slideInLeft">
                    <div class="p-4 flex justify-between items-center border-b border-blue-700">
                        <h2 class="text-xl font-bold">Menu</h2>
                        <button id="closeMobileMenu" class="text-2xl">&times;</button>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                                 {{ strtoupper(substr(auth()->user()->first_name ?? '', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? '', 0, 1)) }}
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold">{{ auth()->user()->first_name}} {{ auth()->user()->last_name}}</h3>
                                <p class="text-sm text-blue-300">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <nav>
                            <ul class="space-y-2">
                                <li><a href="#dashboard" class="block p-3 rounded-lg bg-blue-700"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                                <li><a href="#quiz-section" class="block p-3 rounded-lg hover:bg-blue-700"><i class="fas fa-question-circle mr-3"></i>Take Quiz</a></li>
                                <li><a href="#history" class="block p-3 rounded-lg hover:bg-blue-700"><i class="fas fa-history mr-3"></i>History</a></li>
                                <li><a href="#settings" class="block p-3 rounded-lg hover:bg-blue-700"><i class="fas fa-cog mr-3"></i>Settings</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <!-- Dashboard Section -->
                <div id="dashboard" class="content-section">
                    <!-- Welcome Section -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">Welcome back, <span class="text-blue-600">{{ auth()->user()->first_name}}</span>! 👋</h1>
                        <p class="text-gray-600 mt-2">Ready to test your knowledge and earn some badges today?</p>
                        <div class="flex flex-wrap items-center mt-4 gap-3">
                            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                                <i class="fas fa-fire mr-2"></i> 5-day streak
                            </div>
                            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                                <i class="fas fa-bolt mr-2"></i> 3 quizzes today
                            </div>
                            <div class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                                <i class="fas fa-trophy mr-2"></i> Rank #15
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500 text-sm">Total Points</p>
                                    <h3 class="text-3xl font-bold text-gray-800 mt-2">1,850</h3>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-star text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-green-600 text-sm">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+12% from last week</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500 text-sm">Quizzes Completed</p>
                                    <h3 class="text-3xl font-bold text-gray-800 mt-2">24</h3>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-green-600 text-sm">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+3 this week</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500 text-sm">Badges Earned</p>
                                    <h3 class="text-3xl font-bold text-gray-800 mt-2">8</h3>
                                </div>
                                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-medal text-yellow-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-green-600 text-sm">
                                    <i class="fas fa-plus mr-1"></i>
                                    <span>2 new this month</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-500 text-sm">Your Rank</p>
                                    <h3 class="text-3xl font-bold text-gray-800 mt-2">#15</h3>
                                </div>
                                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-trophy text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center text-green-600 text-sm">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    <span>+5 positions this month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Available Quizzes -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Available Quizzes</h2>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                View All <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Quiz Card 1 -->
                            <div class="quiz-card border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Science</span>
                                        <h4 class="font-bold text-gray-800 mt-3 text-lg">Physics Fundamentals</h4>
                                        <p class="text-gray-600 text-sm mt-1 flex items-center">
                                            <i class="fas fa-question-circle mr-2"></i> 10 questions • 15 minutes
                                        </p>
                                    </div>
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Medium</span>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                                        <span class="font-bold">50 points</span>
                                    </div>
                                    <button class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm font-medium">
                                        Start Quiz
                                    </button>
                                </div>
                            </div>

                            <!-- Quiz Card 2 -->
                            <div class="quiz-card border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">History</span>
                                        <h4 class="font-bold text-gray-800 mt-3 text-lg">World History Challenge</h4>
                                        <p class="text-gray-600 text-sm mt-1 flex items-center">
                                            <i class="fas fa-question-circle mr-2"></i> 15 questions • 20 minutes
                                        </p>
                                    </div>
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Hard</span>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                                        <span class="font-bold">100 points</span>
                                    </div>
                                    <button class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm font-medium">
                                        Start Quiz
                                    </button>
                                </div>
                            </div>

                            <!-- Quiz Card 3 -->
                            <div class="quiz-card border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">Mathematics</span>
                                        <h4 class="font-bold text-gray-800 mt-3 text-lg">Algebra Basics</h4>
                                        <p class="text-gray-600 text-sm mt-1 flex items-center">
                                            <i class="fas fa-question-circle mr-2"></i> 8 questions • 10 minutes
                                        </p>
                                    </div>
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Easy</span>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                                        <span class="font-bold">30 points</span>
                                    </div>
                                    <button class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm font-medium">
                                        Start Quiz
                                    </button>
                                </div>
                            </div>

                            <!-- Quiz Card 4 -->
                            <div class="quiz-card border border-gray-200 rounded-xl p-5 hover:shadow-lg transition-all duration-300">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Literature</span>
                                        <h4 class="font-bold text-gray-800 mt-3 text-lg">Shakespeare Trivia</h4>
                                        <p class="text-gray-600 text-sm mt-1 flex items-center">
                                            <i class="fas fa-question-circle mr-2"></i> 12 questions • 15 minutes
                                        </p>
                                    </div>
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Medium</span>
                                </div>
                                <div class="mt-5 flex justify-between items-center">
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                                        <span class="font-bold">75 points</span>
                                    </div>
                                    <button class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm font-medium">
                                        Start Quiz
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Tracking -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Your Learning Progress</h2>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                Details <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-flask text-blue-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-700">Science</span>
                                    </div>
                                    <span class="font-bold text-blue-600">75%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                                </div>
                                <p class="text-gray-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    6 of 8 quizzes completed • 450 points earned
                                </p>
                            </div>

                            <div>
                                <div class="flex justify-between mb-2">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-calculator text-green-600"></i>
                                        </div>
                                        <span class="font-medium text-gray-700">Mathematics</span>
                                    </div>
                                    <span class="font-bold text-green-600">50%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 50%"></div>
                                </div>
                                <p class="text-gray-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    4 of 8 quizzes completed • 320 points earned
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiz Section -->
                <div id="quiz-section" class="content-section hidden">
                    <!-- Quiz Header -->
                    <div class="mb-8 text-center">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-brain text-white text-2xl"></i>
                            </div>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-3">Interactive Quiz Challenge</h1>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Customize your quiz and test your knowledge. Earn points and level up!</p>
                    </div>

                    <!-- Quiz Setup Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-8 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-sliders-h text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Quiz Customizer</h2>
                                <p class="text-gray-600">Select your preferences and start the challenge</p>
                            </div>
                        </div>
                        
                        <!-- Setup Options -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <!-- Category Selector -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-folder mr-2 text-blue-500"></i>
                                    Category
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <select id="category" class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none">
                                        <option value="">Any Category</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Difficulty Selector -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-chart-line mr-2 text-green-500"></i>
                                    Difficulty
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-signal text-gray-400"></i>
                                    </div>
                                    <select id="difficulty" class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-transparent appearance-none">
                                        <option value="">Any Difficulty</option>
                                        <option value="Easy" class="text-green-600">Easy</option>
                                        <option value="Medium" class="text-yellow-600">Medium</option>
                                        <option value="Hard" class="text-red-600">Hard</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Question Count -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-list-ol mr-2 text-purple-500"></i>
                                    Questions
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-hashtag text-gray-400"></i>
                                    </div>
                                    <select id="limit" class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-transparent appearance-none">
                                        <option value="5">5 Questions</option>
                                        <option value="10" selected>10 Questions</option>
                                        <option value="15">15 Questions</option>
                                        <option value="20">20 Questions</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Start Button -->
                            <div class="flex items-end">
                                <button onclick="startQuiz()" 
                                        class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                    <i class="fas fa-play"></i>
                                    <span>Start Quiz</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Section (Hidden Initially) -->
                    <div id="progressSection" class="hidden bg-white rounded-2xl shadow-xl p-6 mb-8">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                            <div class="mb-4 md:mb-0">
                                <h3 class="text-xl font-bold text-gray-800">Quiz Progress</h3>
                                <p id="progressText" class="text-gray-600">Answer all questions to see results</p>
                            </div>
                            <div class="text-center md:text-right">
                                <div class="text-2xl font-bold text-blue-600" id="scoreDisplay">0/0</div>
                                <div class="text-sm text-gray-500">Current Score</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Progress</span>
                                <span id="progressPercent">0%</span>
                            </div>
                            <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div id="progressBar" class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full w-0 progress-bar"></div>
                            </div>
                        </div>

                        <!-- Question Navigation -->
                        <div id="questionNav" class="flex flex-wrap gap-2 mb-6"></div>
                    </div>

                    <!-- Quiz Container -->
                    <div id="quiz" class="space-y-6 mb-8"></div>

                    <!-- Quiz Results (Hidden Initially) -->
                    <div id="resultsSection" class="hidden bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-8">
                        <div class="text-center mb-8">
                            <div class="w-24 h-24 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-trophy text-white text-3xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-3">Quiz Completed!</h2>
                            <p class="text-gray-600 text-lg">Here's how you performed</p>
                        </div>

                        <!-- Score Card -->
                        <div class="max-w-md mx-auto bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 mb-8 border border-blue-200">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-gray-800 mb-2" id="finalScore">0/0</div>
                                <div class="text-gray-600 mb-6">Your Score</div>
                                
                                <!-- Performance Indicator -->
                                <div class="flex items-center justify-center mb-6">
                                    <div class="relative w-64 h-4 bg-gray-300 rounded-full overflow-hidden">
                                        <div id="performanceBar" class="h-full bg-gradient-to-r from-red-500 via-yellow-500 to-green-500 rounded-full w-0"></div>
                                    </div>
                                </div>
                                
                                <div class="text-sm text-gray-500" id="performanceText">Analyzing your performance...</div>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-check-circle text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-gray-800" id="correctCount">0</div>
                                        <div class="text-gray-600">Correct Answers</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-red-50 rounded-xl p-6 border border-red-100">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-gray-800" id="incorrectCount">0</div>
                                        <div class="text-gray-600">Incorrect Answers</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-purple-50 rounded-xl p-6 border border-purple-100">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-percentage text-purple-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-gray-800" id="percentageScore">0%</div>
                                        <div class="text-gray-600">Success Rate</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Points Earned -->
                        <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100 mb-8">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-star text-yellow-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-xl font-bold text-gray-800" id="pointsEarned">+50 Points</div>
                                        <div class="text-gray-600">Added to your total</div>
                                    </div>
                                </div>
                                <button class="px-5 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600 transition-colors font-medium">
                                    Claim Points
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button onclick="startQuiz()" 
                                    class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg flex items-center justify-center space-x-2">
                                <i class="fas fa-redo"></i>
                                <span>Take Another Quiz</span>
                            </button>
                            
                            <button onclick="reviewAnswers()" 
                                    id="reviewBtn"
                                    class="px-8 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 flex items-center justify-center space-x-2">
                                <i class="fas fa-eye"></i>
                                <span>Review Answers</span>
                            </button>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="text-center py-12">
                        <div class="w-32 h-32 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-question-circle text-gray-400 text-5xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-400 mb-3">No Quiz Started</h3>
                        <p class="text-gray-500 max-w-md mx-auto">Select your quiz preferences above and click "Start Quiz" to begin your challenge.</p>
                    </div>
                </div>

                <!-- History Section -->
                <div id="history" class="content-section hidden">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Quiz History</h2>
                        <p class="text-gray-600 mb-6">Your past quiz attempts and results</p>
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-history text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-400 mb-3">History Coming Soon</h3>
                            <p class="text-gray-500">Your quiz history will appear here once you complete some quizzes.</p>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <div id="settings" class="content-section hidden">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Settings</h2>
                        <p class="text-gray-600 mb-6">Customize your learning experience</p>
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-cog text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-400 mb-3">Settings Panel</h3>
                            <p class="text-gray-500">Customize your preferences, notification settings, and more.</p>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 p-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-600 text-sm mb-2 md:mb-0">
                        <span class="font-medium">QuizMaster Student Portal</span> • © 2026 All rights reserved
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-500 hover:text-blue-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-blue-600">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-blue-600">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-blue-600">
                            <i class="fab fa-github"></i>
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

        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('href').substring(1);
                
                // Update active nav item
                document.querySelectorAll('.nav-item').forEach(nav => {
                    nav.classList.remove('active', 'bg-blue-700');
                });
                this.classList.add('active', 'bg-blue-700');
                
                // Show target section
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.add('hidden');
                });
                document.getElementById(target).classList.remove('hidden');
                
                // Close mobile menu if open
                document.getElementById('mobileSidebar').classList.add('hidden');
            });
        });

        // Load categories on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/categories')
                .then(res => res.json())
                .then(data => {
                    const select = document.getElementById('category');
                    select.innerHTML = '<option value="">Any Category</option>';
                    if (Array.isArray(data)) {
                        data.forEach(item => {
                            select.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                        });
                    }
                })
                .catch(err => console.error('Error loading categories:', err));
            
            // Setup initial navigation
            document.querySelector('.nav-item.active').click();
        });

        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.remove('hidden');
        });

        document.getElementById('closeMobileMenu').addEventListener('click', function() {
            document.getElementById('mobileSidebar').classList.add('hidden');
        });

        // User dropdown toggle
        document.getElementById('userDropdownBtn').addEventListener('click', function() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('userDropdown');
            const userDropdownBtn = document.getElementById('userDropdownBtn');
            
            if (!userDropdownBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });

        // Start Quiz Function
        async function startQuiz() {
            const category = document.getElementById('category').value;
            const difficulty = document.getElementById('difficulty').value;
            const limit = document.getElementById('limit').value;

            // Navigate to quiz section
            document.querySelector('a[href="#quiz-section"]').click();

            // Show loading state
            document.getElementById('quiz').innerHTML = `
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-blue-600 mx-auto mb-6"></div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Preparing Your Quiz</h3>
                    <p class="text-gray-600">Loading questions...</p>
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

            // Build API URL
            let url = `/quiz-data?limit=${limit}`;
            if (category) url += `&category=${category}`;
            if (difficulty) url += `&difficulty=${difficulty}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                console.log('API Response:', data); // Debug log

                // Check if data is valid array
                if (!data || !Array.isArray(data) || data.length === 0) {
                    document.getElementById('quiz').innerHTML = `
                        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">No Questions Available</h3>
                            <p class="text-gray-600 mb-6">Try selecting different quiz parameters or try again later.</p>
                            <button onclick="startQuiz()" 
                                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                                Try Again
                            </button>
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
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-exclamation-circle text-yellow-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Connection Error</h3>
                        <p class="text-gray-600 mb-6">Unable to load quiz. Please check your connection and try again.</p>
                        <button onclick="startQuiz()" 
                                class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                            Retry
                        </button>
                    </div>
                `;
            }
        }

        // Display Questions
        function displayQuestions() {
            const quizContainer = document.getElementById('quiz');
            quizContainer.innerHTML = '';

            // Check if quizData is valid array
            if (!window.quizData || !Array.isArray(window.quizData) || window.quizData.length === 0) {
                quizContainer.innerHTML = `
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Questions Loaded</h3>
                        <p class="text-gray-600 mb-6">Please try starting a new quiz.</p>
                    </div>
                `;
                return;
            }

            window.quizData.forEach((question, index) => {
                // Check if question has answers
                if (!question.answers) {
                    console.error('Question has no answers:', question);
                    return;
                }

                const answers = Object.entries(question.answers)
                    .filter(([key, value]) => value && value.trim() !== '')
                    .map(([key, value]) => ({
                        key,
                        value,
                        isSelected: window.userAnswers[index] === key
                    }));

                // Skip if no valid answers
                if (answers.length === 0) return;

                const questionHTML = `
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 quiz-question" id="question-${index}">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex flex-col md:flex-row md:items-start justify-between">
                                <div class="flex items-start space-x-3 mb-4 md:mb-0">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center font-bold flex-shrink-0">
                                        ${index + 1}
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800">${question.question || 'No question text available'}</h3>
                                </div>
                                <span class="px-3 py-1 text-sm font-medium rounded-full 
                                    ${question.difficulty === 'Easy' ? 'bg-green-100 text-green-800' : 
                                      question.difficulty === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 
                                      'bg-red-100 text-red-800'}">
                                    ${question.difficulty || 'Unknown'}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                ${answers.map((answer, i) => `
                                    <div class="quiz-option ${answer.isSelected ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-200'} 
                                         border rounded-xl p-4 cursor-pointer transition-all hover:border-blue-300 hover:bg-blue-50"
                                         onclick="selectAnswer(${index}, '${answer.key}')">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-lg ${answer.isSelected ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border'} 
                                                 flex items-center justify-center mr-3 font-medium flex-shrink-0">
                                                ${String.fromCharCode(65 + i)}
                                            </div>
                                            <span class="text-gray-700 break-words">${answer.value}</span>
                                            ${answer.isSelected ? `
                                                <div class="ml-auto">
                                                    <i class="fas fa-check text-blue-600"></i>
                                                </div>
                                            ` : ''}
                                        </div>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                        
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <div class="text-sm text-gray-600 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Select one answer
                            </div>
                            <div>
                                <span class="text-sm font-medium ${window.userAnswers[index] ? 'text-green-600' : 'text-yellow-600'}">
                                    ${window.userAnswers[index] ? '✓ Answered' : 'Answer it carefully'}
                                </span>
                            </div>
                        </div>
                    </div>
                `;

                quizContainer.innerHTML += questionHTML;
            });

            if (window.quizData.length > 0) {
                quizContainer.innerHTML += `
                    <div class="mt-8 flex justify-center">
                        <button onclick="submitQuiz()" 
                                class="px-10 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold text-lg rounded-xl hover:from-green-600 hover:to-emerald-700 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center space-x-3">
                            <i class="fas fa-paper-plane"></i>
                            <span>Submit Quiz</span>
                        </button>
                    </div>
                `;
            }
        }

        // Select Answer
        function selectAnswer(questionIndex, answerKey) {
            if (!window.quizData || !Array.isArray(window.quizData)) return;
            
            window.userAnswers[questionIndex] = answerKey;
            
            // Update UI for selected answer
            const questionElement = document.getElementById(`question-${questionIndex}`);
            if (!questionElement) return;
            
            const options = questionElement.querySelectorAll('.quiz-option');
            
            options.forEach(option => {
                option.classList.remove('bg-blue-50', 'border-blue-200');
                option.classList.add('bg-gray-50', 'border-gray-200');
                const prefix = option.querySelector('.w-8.h-8');
                if (prefix) {
                    prefix.classList.remove('bg-blue-600', 'text-white');
                    prefix.classList.add('bg-white', 'text-gray-600', 'border');
                }
                
                const checkIcon = option.querySelector('.fa-check');
                if (checkIcon) {
                    checkIcon.parentElement.remove();
                }
            });
            
            // Mark selected option
            const selectedOption = questionElement.querySelector(`[onclick*="${answerKey}"]`);
            if (selectedOption) {
                selectedOption.classList.remove('bg-gray-50', 'border-gray-200');
                selectedOption.classList.add('bg-blue-50', 'border-blue-200');
                const prefix = selectedOption.querySelector('.w-8.h-8');
                if (prefix) {
                    prefix.classList.remove('bg-white', 'text-gray-600', 'border');
                    prefix.classList.add('bg-blue-600', 'text-white');
                }
                
                // Add check icon
                const flexContainer = selectedOption.querySelector('.flex.items-center');
                if (flexContainer) {
                    flexContainer.innerHTML += `
                        <div class="ml-auto">
                            <i class="fas fa-check text-blue-600"></i>
                        </div>
                    `;
                }
            }
            
            // Update status in footer
            const statusSpan = questionElement.querySelector('.text-sm.font-medium');
            if (statusSpan) {
                statusSpan.textContent = '✓ Answered';
                statusSpan.className = 'text-sm font-medium text-green-600';
            }
            
            updateProgress();
        }

        // Update Progress
        function updateProgress() {
            if (!window.quizStarted || !window.quizData || !Array.isArray(window.quizData)) return;
            
            const answered = window.userAnswers.filter(answer => answer !== null).length;
            const total = window.quizData.length;
            const percentage = total > 0 ? Math.round((answered / total) * 100) : 0;
            
            // Update progress bar
            const progressBar = document.getElementById('progressBar');
            const progressPercent = document.getElementById('progressPercent');
            const progressText = document.getElementById('progressText');
            const scoreDisplay = document.getElementById('scoreDisplay');
            
            if (progressBar) progressBar.style.width = `${percentage}%`;
            if (progressPercent) progressPercent.textContent = `${percentage}%`;
            if (progressText) progressText.textContent = `${answered} of ${total} questions answered`;
            if (scoreDisplay) scoreDisplay.textContent = `${window.score}/${total}`;
            
            setupQuestionNavigation();
        }

        // Setup Question Navigation
        function setupQuestionNavigation() {
            const navContainer = document.getElementById('questionNav');
            if (!navContainer) return;
            
            navContainer.innerHTML = '';
            
            // Check if quizData is valid array
            if (!window.quizData || !Array.isArray(window.quizData) || window.quizData.length === 0) {
                return;
            }
            
            window.quizData.forEach((_, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = `w-10 h-10 rounded-xl flex items-center justify-center font-medium transition-all
                    ${window.userAnswers[index] ? 'bg-green-100 text-green-700 border border-green-200' : 
                      index === window.currentQuestion ? 'bg-blue-600 text-white' : 
                      'bg-gray-100 text-gray-600 hover:bg-gray-200'}`;
                button.textContent = index + 1;
                button.onclick = () => scrollToQuestion(index);
                
                navContainer.appendChild(button);
            });
        }

        // Scroll to Question
        function scrollToQuestion(index) {
            window.currentQuestion = index;
            const element = document.getElementById(`question-${index}`);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setupQuestionNavigation();
            }
        }

        // Submit Quiz
        function submitQuiz() {
            // Check if quiz data is valid
            if (!window.quizData || !Array.isArray(window.quizData) || window.quizData.length === 0) {
                alert('No quiz data available. Please start a new quiz.');
                return;
            }
            
            // Check if all questions are answered
            const unanswered = window.userAnswers.filter(answer => answer === null).length;
            if (unanswered > 0) {
                if (!confirm(`You have ${unanswered} unanswered question(s). Submit anyway?`)) {
                    return;
                }
            }
            
            // Calculate score
            window.score = 0;
            const results = [];
            
            window.quizData.forEach((question, index) => {
                const userAnswer = window.userAnswers[index];
                let isCorrect = false;
                
                // Check if answer is correct
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
            
            // Show results
            showResults(results);
        }

        // Show Results
        function showResults(results) {
            const total = window.quizData.length;
            const percentage = total > 0 ? Math.round((window.score / total) * 100) : 0;
            
            // Update final score display
            document.getElementById('finalScore').textContent = `${window.score}/${total}`;
            document.getElementById('correctCount').textContent = window.score;
            document.getElementById('incorrectCount').textContent = total - window.score;
            document.getElementById('percentageScore').textContent = `${percentage}%`;
            
            // Calculate points earned
            const pointsEarned = Math.round((window.score / total) * 100);
            document.getElementById('pointsEarned').textContent = `+${pointsEarned} Points`;
            
            // Update performance bar
            const performanceBar = document.getElementById('performanceBar');
            if (performanceBar) performanceBar.style.width = `${percentage}%`;
            
            // Performance text
            let performanceText = '';
            if (percentage >= 90) {
                performanceText = 'Excellent! You\'re a quiz master! 🏆';
            } else if (percentage >= 70) {
                performanceText = 'Great job! Well done! 👍';
            } else if (percentage >= 50) {
                performanceText = 'Good effort! Keep practicing! 💪';
            } else {
                performanceText = 'Keep learning! You\'ll do better next time! 📚';
            }
            document.getElementById('performanceText').textContent = performanceText;
            
            // Hide quiz and show results
            document.getElementById('quiz').innerHTML = '';
            document.getElementById('progressSection').classList.add('hidden');
            document.getElementById('resultsSection').classList.remove('hidden');
            
            // Store results for review
            window.quizResults = results;
            
            // Scroll to results
            document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });
        }

        // Review Answers
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
                                isUserAnswer: result.userAnswer === key,
                                isCorrect: result.correctAnswers.includes(key)
                            })) : [];
                    
                    if (answers.length === 0) return;
                    
                    const questionHTML = `
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border ${result.correct ? 'border-green-200' : 'border-red-200'} mb-6">
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex flex-col md:flex-row md:items-start justify-between">
                                    <div class="flex items-start space-x-3 mb-4 md:mb-0">
                                        <div class="w-10 h-10 ${result.correct ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'} rounded-xl flex items-center justify-center font-bold flex-shrink-0">
                                            ${index + 1}
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-800">${question.question || 'No question text'}</h3>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        ${result.correct ? 
                                            '<span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Correct</span>' : 
                                            '<span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">Incorrect</span>'
                                        }
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    ${answers.map((answer, i) => {
                                        let bgClass = 'bg-gray-50';
                                        let borderClass = 'border-gray-200';
                                        let textClass = 'text-gray-700';
                                        let prefixClass = 'bg-white text-gray-600 border';
                                        
                                        if (answer.isCorrect) {
                                            bgClass = 'bg-green-50';
                                            borderClass = 'border-green-200';
                                            prefixClass = 'bg-green-100 text-green-700';
                                        }
                                        
                                        if (answer.isUserAnswer && !answer.isCorrect) {
                                            bgClass = 'bg-red-50';
                                            borderClass = 'border-red-200';
                                            prefixClass = 'bg-red-100 text-red-700';
                                        }
                                        
                                        return `
                                            <div class="${bgClass} ${borderClass} border rounded-xl p-4">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-lg ${prefixClass} flex items-center justify-center mr-3 font-medium flex-shrink-0">
                                                        ${String.fromCharCode(65 + i)}
                                                    </div>
                                                    <span class="${textClass} break-words">${answer.value}</span>
                                                    ${answer.isCorrect ? `
                                                        <div class="ml-auto">
                                                            <i class="fas fa-check text-green-600"></i>
                                                        </div>
                                                    ` : ''}
                                                    ${answer.isUserAnswer && !answer.isCorrect ? `
                                                        <div class="ml-auto">
                                                            <i class="fas fa-times text-red-600"></i>
                                                        </div>
                                                    ` : ''}
                                                </div>
                                            </div>
                                        `;
                                    }).join('')}
                                </div>
                                
                                ${!result.correct ? `
                                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                        <div class="flex items-center">
                                            <i class="fas fa-lightbulb text-blue-600 text-xl mr-3"></i>
                                            <div>
                                                <div class="font-medium text-blue-800">Your answer was incorrect</div>
                                                <div class="text-blue-700 text-sm mt-1">The correct answer${result.correctAnswers.length > 1 ? 's were' : ' was'} marked in green.</div>
                                            </div>
                                        </div>
                                    </div>
                                ` : ''}
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
    </script>
</body>
</html>