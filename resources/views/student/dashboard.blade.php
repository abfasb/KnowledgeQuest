<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel - Quiz Master</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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

            <!-- User Profile Card -->
            <div class="p-6 border-b border-blue-700">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-xl font-bold">
                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                        <p class="text-sm text-blue-300">{{ auth()->user()->user_type }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg bg-blue-700 text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-question-circle mr-3"></i>
                            Take Quiz
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-chart-line mr-3"></i>
                            Analytics
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-trophy mr-3"></i>
                            Leaderboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-medal mr-3"></i>
                            Badges
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-history mr-3"></i>
                            History
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>

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
                        <input type="text" placeholder="Search quizzes, categories, or topics..." class="w-full p-3 pl-12 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-6">
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="text-gray-700 hover:text-blue-600 transition duration-200">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </div>

                    <!-- Messages -->
                    <div class="relative">
                        <button class="text-gray-700 hover:text-blue-600 transition duration-200">
                            <i class="fas fa-envelope text-xl"></i>
                        </button>
                        <span class="absolute -top-1 -right-1 bg-yellow-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">1</span>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr(auth()->user()->first_name, 0, 1) }}
                            </div>
                            <i class="fas fa-chevron-down text-gray-600"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-10">
                            <div class="p-4 border-b">
                                <p class="font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="p-2">
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-user mr-3"></i>Profile</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-cog mr-3"></i>Settings</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-question-circle mr-3"></i>Help</a>
                                <div class="border-t my-2"></div>
                                <a href="{{ route('logout')}}" class="block px-4 py-2 text-red-600 hover:bg-red-50 rounded"><i class="fas fa-sign-out-alt mr-3"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden">
                <div class="w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white h-full animate__animated animate__slideInLeft">
                    <div class="p-4 flex justify-between items-center border-b border-blue-700">
                        <h2 class="text-xl font-bold">Menu</h2>
                        <button id="closeMobileMenu" class="text-2xl">&times;</button>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                                <p class="text-sm text-blue-300">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <nav>
                            <ul class="space-y-2">
                                <li><a href="#" class="block p-3 rounded-lg bg-blue-700"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                                <li><a href="#" class="block p-3 rounded-lg hover:bg-blue-700"><i class="fas fa-question-circle mr-3"></i>Take Quiz</a></li>
                                <li><a href="#" class="block p-3 rounded-lg hover:bg-blue-700"><i class="fas fa-chart-line mr-3"></i>Analytics</a></li>
                                <li><a href="#" class="block p-3 rounded-lg hover:bg-blue-700"><i class="fas fa-trophy mr-3"></i>Leaderboard</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <main class="flex-1 p-6 overflow-y-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Welcome back, <span class="text-blue-600">{{ auth()->user()->first_name }}</span>! 👋</h1>
                    <p class="text-gray-600 mt-2">Ready to test your knowledge and earn some badges today?</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Total Points</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">1,850</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
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

                    <!-- Quizzes Completed -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Quizzes Completed</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">24</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
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

                    <!-- Badges Earned -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Badges Earned</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">8</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
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

                    <!-- Rank -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Your Rank</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">#15</h3>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column -->
                    <div class="lg:col-span-2">
                        <!-- Available Quizzes -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800">Available Quizzes</h2>
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">View All <i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Quiz 1 -->
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Science</span>
                                            <h4 class="font-bold text-gray-800 mt-2">Physics Fundamentals</h4>
                                            <p class="text-gray-600 text-sm mt-1">10 questions • 15 minutes</p>
                                        </div>
                                        <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded">Medium</span>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                                            <span>50 points</span>
                                        </div>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">Start Quiz</button>
                                    </div>
                                </div>

                                <!-- Quiz 2 -->
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">History</span>
                                            <h4 class="font-bold text-gray-800 mt-2">World History Challenge</h4>
                                            <p class="text-gray-600 text-sm mt-1">15 questions • 20 minutes</p>
                                        </div>
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">Hard</span>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                                            <span>100 points</span>
                                        </div>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">Start Quiz</button>
                                    </div>
                                </div>

                                <!-- Quiz 3 -->
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">Mathematics</span>
                                            <h4 class="font-bold text-gray-800 mt-2">Algebra Basics</h4>
                                            <p class="text-gray-600 text-sm mt-1">8 questions • 10 minutes</p>
                                        </div>
                                        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">Easy</span>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                                            <span>30 points</span>
                                        </div>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">Start Quiz</button>
                                    </div>
                                </div>

                                <!-- Quiz 4 -->
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Literature</span>
                                            <h4 class="font-bold text-gray-800 mt-2">Shakespeare Trivia</h4>
                                            <p class="text-gray-600 text-sm mt-1">12 questions • 15 minutes</p>
                                        </div>
                                        <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded">Medium</span>
                                    </div>
                                    <div class="mt-4 flex justify-between items-center">
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                                            <span>75 points</span>
                                        </div>
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">Start Quiz</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Tracking -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Your Progress</h2>
                            
                            <div class="space-y-6">
                                <!-- Progress Bar 1 -->
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium text-gray-700">Science</span>
                                        <span class="font-bold text-blue-600">75%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-blue-600 h-3 rounded-full animate__animated animate__pulse" style="width: 75%"></div>
                                    </div>
                                    <p class="text-gray-500 text-sm mt-1">6 of 8 quizzes completed</p>
                                </div>

                                <!-- Progress Bar 2 -->
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium text-gray-700">Mathematics</span>
                                        <span class="font-bold text-green-600">50%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-600 h-3 rounded-full animate__animated animate__pulse" style="width: 50%"></div>
                                    </div>
                                    <p class="text-gray-500 text-sm mt-1">4 of 8 quizzes completed</p>
                                </div>

                                <!-- Progress Bar 3 -->
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium text-gray-700">History</span>
                                        <span class="font-bold text-purple-600">90%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-purple-600 h-3 rounded-full animate__animated animate__pulse" style="width: 90%"></div>
                                    </div>
                                    <p class="text-gray-500 text-sm mt-1">9 of 10 quizzes completed</p>
                                </div>

                                <!-- Progress Bar 4 -->
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium text-gray-700">Literature</span>
                                        <span class="font-bold text-yellow-600">30%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-yellow-600 h-3 rounded-full animate__animated animate__pulse" style="width: 30%"></div>
                                    </div>
                                    <p class="text-gray-500 text-sm mt-1">3 of 10 quizzes completed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <!-- Badges Section -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Your Badges</h2>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-medal text-yellow-600 text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-center">Quiz Master</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-bolt text-blue-600 text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-center">Speedster</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-brain text-green-600 text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-center">Genius</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-fire text-purple-600 text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-center">Hot Streak</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-crown text-red-600 text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-center">Top Performer</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center mb-2">
                                        <i class="fas fa-infinity text-indigo-600 text-2xl"></i>
                                    </div>
                                    <p class="text-xs font-medium text-center">Consistent</p>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View all 8 badges <i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>

                        <!-- Leaderboard -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800">Top Performers</h2>
                                <span class="text-gray-500 text-sm">This Week</span>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Top 1 -->
                                <div class="flex items-center p-3 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg">
                                    <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-white font-bold mr-3">1</div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800">Alex Johnson</h4>
                                        <p class="text-gray-600 text-sm">2,450 points</p>
                                    </div>
                                    <i class="fas fa-crown text-yellow-600 text-xl"></i>
                                </div>

                                <!-- Top 2 -->
                                <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-bold mr-3">2</div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800">Maria Garcia</h4>
                                        <p class="text-gray-600 text-sm">2,120 points</p>
                                    </div>
                                    <i class="fas fa-medal text-gray-500 text-xl"></i>
                                </div>

                                <!-- Top 3 -->
                                <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-8 h-8 rounded-full bg-orange-300 flex items-center justify-center text-gray-700 font-bold mr-3">3</div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800">David Chen</h4>
                                        <p class="text-gray-600 text-sm">1,980 points</p>
                                    </div>
                                    <i class="fas fa-medal text-orange-500 text-xl"></i>
                                </div>

                                <!-- Current User -->
                                <div class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg">
                                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold mr-3">15</div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                                        <p class="text-gray-600 text-sm">1,850 points</p>
                                    </div>
                                    <div class="text-green-600 font-bold">
                                        <i class="fas fa-arrow-up mr-1"></i>5
                                    </div>
                                </div>

                                <!-- Top 4 -->
                                <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold mr-3">4</div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800">Sarah Williams</h4>
                                        <p class="text-gray-600 text-sm">1,920 points</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <a href="#" class="block text-center w-full py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition duration-200 font-medium">View Full Leaderboard</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-lg p-6 mt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Recent Activity</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">Completed "Physics Fundamentals" quiz</h4>
                                <p class="text-gray-500 text-sm">Scored 85% • Earned 50 points</p>
                            </div>
                            <span class="text-gray-500 text-sm">2 hours ago</span>
                        </div>

                        <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                                <i class="fas fa-medal text-yellow-600"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">Earned "Quiz Master" badge</h4>
                                <p class="text-gray-500 text-sm">Completed 20 quizzes</p>
                            </div>
                            <span class="text-gray-500 text-sm">1 day ago</span>
                        </div>

                        <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                <i class="fas fa-chart-line text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">Moved up 5 positions on leaderboard</h4>
                                <p class="text-gray-500 text-sm">Now ranked #15 overall</p>
                            </div>
                            <span class="text-gray-500 text-sm">3 days ago</span>
                        </div>

                        <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                <i class="fas fa-history text-purple-600"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">Attempted "World History Challenge"</h4>
                                <p class="text-gray-500 text-sm">Scored 70% • Earned 75 points</p>
                            </div>
                            <span class="text-gray-500 text-sm">5 days ago</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript for interactivity -->
    <script>
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

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const dropdownBtn = document.getElementById('userDropdownBtn');
            
            if (!dropdownBtn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Add animation to progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate loading animation for progress bars
            const progressBars = document.querySelectorAll('.animate__pulse');
            progressBars.forEach(bar => {
                bar.style.width = '0%';
                setTimeout(() => {
                    const targetWidth = bar.style.width;
                    bar.style.transition = 'width 1.5s ease-in-out';
                    bar.style.width = targetWidth;
                }, 300);
            });

            // Update current time
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                const dateString = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                
                // Find or create time display element
                let timeDisplay = document.getElementById('currentTime');
                if (!timeDisplay) {
                    timeDisplay = document.createElement('div');
                    timeDisplay.id = 'currentTime';
                    timeDisplay.className = 'text-gray-500 text-sm mt-1';
                    document.querySelector('.mb-8').appendChild(timeDisplay);
                }
                
                timeDisplay.textContent = `${dateString} • ${timeString}`;
            }
            
            updateTime();
            setInterval(updateTime, 60000); // Update every minute
        });
    </script>
</body>
</html>