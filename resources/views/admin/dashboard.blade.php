<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Quiz Master</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-xl hidden md:flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-shield-alt mr-3 text-purple-400"></i>
                    QuizMaster Admin
                </h1>
                <p class="text-gray-400 text-sm mt-1">Administration Portal</p>
            </div>

            <!-- User Profile Card -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-xl font-bold">
                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                        <p class="text-sm text-gray-400">Administrator</p>
                        <p class="text-xs text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-4">
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-4 ml-3">Dashboard</p>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg bg-gray-700 text-white">
                            <i class="fas fa-tachometer-alt mr-3 text-purple-400"></i>
                            Admin Dashboard
                        </a>
                    </li>
                    
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-4 ml-3 mt-6">Management</p>
                    
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-users mr-3"></i>
                            User Management
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center">12</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-question-circle mr-3"></i>
                            Quiz Management
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-chart-pie mr-3"></i>
                            Analytics & Reports
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-tags mr-3"></i>
                            Categories & Tags
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-trophy mr-3"></i>
                            Badges & Rewards
                        </a>
                    </li>
                    
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-4 ml-3 mt-6">System</p>
                    
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-cogs mr-3"></i>
                            System Settings
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-database mr-3"></i>
                            Database Backup
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-exclamation-triangle mr-3"></i>
                            Reported Issues
                            <span class="ml-auto bg-yellow-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                            <i class="fas fa-history mr-3"></i>
                            Audit Logs
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="p-6 border-t border-gray-700 text-center">
                <p class="text-gray-400 text-sm">System Status: <span class="text-green-500 font-semibold">Online</span></p>
                <p class="text-gray-500 text-xs mt-1">Last Backup: 12 hours ago</p>
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

                <!-- Breadcrumb -->
                <div class="flex-1 mx-4">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600">
                                    <i class="fas fa-home mr-2"></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                    <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-purple-600 md:ml-2">Admin</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                    <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Dashboard</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <!-- Right Side Icons -->
                <div class="flex items-center space-x-6">
                    <!-- System Status -->
                    <div class="hidden md:flex items-center bg-green-50 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-green-700 text-sm font-medium">System Online</span>
                    </div>

                    <!-- Quick Actions Dropdown -->
                    <div class="relative">
                        <button id="quickActionsBtn" class="text-gray-700 hover:text-purple-600 transition duration-200">
                            <i class="fas fa-bolt text-xl"></i>
                        </button>
                        <div id="quickActionsMenu" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-10">
                            <div class="p-3 border-b">
                                <p class="font-semibold text-gray-800">Quick Actions</p>
                            </div>
                            <div class="p-2 grid grid-cols-2 gap-2">
                                <a href="#" class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fas fa-user-plus text-blue-600"></i>
                                    </div>
                                    <span class="text-xs font-medium">Add User</span>
                                </a>
                                <a href="#" class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fas fa-plus-circle text-green-600"></i>
                                    </div>
                                    <span class="text-xs font-medium">Add Quiz</span>
                                </a>
                                <a href="#" class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fas fa-chart-bar text-yellow-600"></i>
                                    </div>
                                    <span class="text-xs font-medium">Reports</span>
                                </a>
                                <a href="#" class="flex flex-col items-center p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fas fa-cog text-purple-600"></i>
                                    </div>
                                    <span class="text-xs font-medium">Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button class="text-gray-700 hover:text-purple-600 transition duration-200">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">7</span>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-700 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr(auth()->user()->first_name, 0, 1) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-600 hidden md:block"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-10">
                            <div class="p-4 border-b">
                                <p class="font-semibold text-gray-800">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                <p class="text-xs text-purple-600 font-medium mt-1">Super Administrator</p>
                            </div>
                            <div class="p-2">
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-user-shield mr-3"></i>Admin Profile</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-cog mr-3"></i>System Settings</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-key mr-3"></i>Change Password</a>
                                <div class="border-t my-2"></div>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"><i class="fas fa-user mr-3"></i>View as Student</a>
                                <div class="border-t my-2"></div>
                                <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50 rounded"><i class="fas fa-sign-out-alt mr-3"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Sidebar (Hidden by default) -->
            <div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden">
                <div class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white h-full animate__animated animate__slideInLeft">
                    <div class="p-4 flex justify-between items-center border-b border-gray-700">
                        <h2 class="text-xl font-bold">Admin Menu</h2>
                        <button id="closeMobileMenu" class="text-2xl">&times;</button>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
                                <p class="text-sm text-gray-400">Administrator</p>
                            </div>
                        </div>
                        <nav>
                            <ul class="space-y-2">
                                <li><a href="#" class="block p-3 rounded-lg bg-gray-700"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a></li>
                                <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700"><i class="fas fa-users mr-3"></i>User Management</a></li>
                                <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700"><i class="fas fa-question-circle mr-3"></i>Quiz Management</a></li>
                                <li><a href="#" class="block p-3 rounded-lg hover:bg-gray-700"><i class="fas fa-chart-pie mr-3"></i>Analytics</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Welcome, <span class="text-purple-600">{{ auth()->user()->first_name }}</span> <i class="fas fa-shield-alt text-purple-500"></i></h1>
                    <p class="text-gray-600 mt-2">Administrator Dashboard • System Overview & Management</p>
                    <div class="flex flex-wrap items-center mt-4 space-x-4">
                        <div class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-server mr-1"></i> Server: Online
                        </div>
                        <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-users mr-1"></i> 1,248 Active Users
                        </div>
                        <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-database mr-1"></i> 4.2 GB Storage Used
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Total Users</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">2,548</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-1 text-xs"></i> 12% increase
                                    </span>
                                    <span class="text-gray-400 mx-2">•</span>
                                    <span class="text-gray-500 text-sm">1,248 active</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Total Quizzes -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Total Quizzes</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">187</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-plus mr-1 text-xs"></i> 5 new this week
                                    </span>
                                </div>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-question-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Attempts -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Quiz Attempts Today</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">842</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-arrow-up mr-1 text-xs"></i> 24% from yesterday
                                    </span>
                                </div>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- System Health -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">System Health</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">98%</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 text-sm font-medium flex items-center">
                                        <i class="fas fa-check-circle mr-1 text-xs"></i> All systems operational
                                    </span>
                                </div>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-heartbeat text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Data Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <!-- Left Column - Charts -->
                    <div class="lg:col-span-2">
                        <!-- User Growth Chart -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800">User Growth</h2>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm font-medium">7 Days</button>
                                    <button class="px-3 py-1 bg-purple-600 text-white rounded-lg text-sm font-medium">30 Days</button>
                                    <button class="px-3 py-1 bg-gray-100 text-gray-800 rounded-lg text-sm font-medium">1 Year</button>
                                </div>
                            </div>
                            <div class="h-72">
                                <canvas id="userGrowthChart"></canvas>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800">Recent System Activities</h2>
                                <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">View All Logs <i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-user-plus text-green-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">New user registration</h4>
                                        <p class="text-gray-500 text-sm">"John Doe" registered with email johndoe@example.com</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-gray-500 text-sm">10 min ago</span>
                                        <span class="block text-xs text-gray-400">IP: 192.168.1.1</span>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-question-circle text-blue-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">New quiz created</h4>
                                        <p class="text-gray-500 text-sm">"Advanced Physics Quiz" added by Admin</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-gray-500 text-sm">1 hour ago</span>
                                        <span class="block text-xs text-gray-400">Category: Science</span>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">Reported content</h4>
                                        <p class="text-gray-500 text-sm">User "Sarah123" reported a question in "World History" quiz</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-gray-500 text-sm">3 hours ago</span>
                                        <span class="block text-xs text-red-500">Pending Review</span>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-medal text-yellow-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">Badge awarded</h4>
                                        <p class="text-gray-500 text-sm">"Quiz Master" badge awarded to user "AlexJohnson"</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-gray-500 text-sm">5 hours ago</span>
                                        <span class="block text-xs text-gray-400">Automated</span>
                                    </div>
                                </div>

                                <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-4">
                                        <i class="fas fa-database text-purple-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">Database backup completed</h4>
                                        <p class="text-gray-500 text-sm">System backup completed successfully</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-gray-500 text-sm">12 hours ago</span>
                                        <span class="block text-xs text-green-500">Successful</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <!-- Quick Stats -->
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Quick Stats</h2>
                            
                            <div class="space-y-5">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                                            <i class="fas fa-user-graduate text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Active Students</p>
                                            <p class="text-gray-500 text-sm">Logged in last 24h</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800">842</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center mr-3">
                                            <i class="fas fa-check-circle text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Completed Quizzes</p>
                                            <p class="text-gray-500 text-sm">Today</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800">312</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center mr-3">
                                            <i class="fas fa-star text-yellow-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Avg. Score</p>
                                            <p class="text-gray-500 text-sm">Across all quizzes</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800">74%</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center mr-3">
                                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Pending Actions</p>
                                            <p class="text-gray-500 text-sm">Require attention</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800">8</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center mr-3">
                                            <i class="fas fa-server text-purple-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Server Uptime</p>
                                            <p class="text-gray-500 text-sm">Last 30 days</p>
                                        </div>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-800">99.8%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Actions -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800">Pending Actions</h2>
                                <span class="bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center">8</span>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="p-3 border border-red-100 bg-red-50 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">Reported Content</h4>
                                            <p class="text-gray-600 text-sm mt-1">3 quizzes reported by users</p>
                                        </div>
                                        <span class="text-red-600 font-bold">!</span>
                                    </div>
                                    <button class="w-full mt-3 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 text-sm">Review Now</button>
                                </div>

                                <div class="p-3 border border-yellow-100 bg-yellow-50 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">User Verification</h4>
                                            <p class="text-gray-600 text-sm mt-1">12 new users to verify</p>
                                        </div>
                                        <span class="text-yellow-600 font-bold">12</span>
                                    </div>
                                    <button class="w-full mt-3 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-200 text-sm">Verify Users</button>
                                </div>

                                <div class="p-3 border border-blue-100 bg-blue-50 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">Quiz Review</h4>
                                            <p class="text-gray-600 text-sm mt-1">5 quizzes pending approval</p>
                                        </div>
                                        <span class="text-blue-600 font-bold">5</span>
                                    </div>
                                    <button class="w-full mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">Review Quizzes</button>
                                </div>

                                <div class="p-3 border border-green-100 bg-green-50 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">System Update</h4>
                                            <p class="text-gray-600 text-sm mt-1">New version available</p>
                                        </div>
                                        <span class="text-green-600 font-bold">v2.5.1</span>
                                    </div>
                                    <button class="w-full mt-3 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200 text-sm">Update Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Management Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Recent User Registrations</h2>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg font-medium hover:bg-gray-200 transition duration-200">
                                <i class="fas fa-download mr-2"></i> Export
                            </button>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition duration-200">
                                <i class="fas fa-user-plus mr-2"></i> Add User
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold mr-3">MJ</div>
                                            <div>
                                                <div class="font-medium text-gray-900">Michael Johnson</div>
                                                <div class="text-gray-500 text-sm">ID: #USR-2451</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">michael.j@example.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Student</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Today, 10:24 AM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-800 font-bold mr-3">SD</div>
                                            <div>
                                                <div class="font-medium text-gray-900">Sarah Davis</div>
                                                <div class="text-gray-500 text-sm">ID: #USR-2450</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">sarahdavis@example.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Student</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Yesterday, 3:45 PM</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-800 font-bold mr-3">RT</div>
                                            <div>
                                                <div class="font-medium text-gray-900">Robert Taylor</div>
                                                <div class="text-gray-500 text-sm">ID: #USR-2449</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">robert.t@example.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">Teacher</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">2 days ago</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="p-2 text-green-600 hover:bg-green-50 rounded-lg">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-800 font-bold mr-3">AJ</div>
                                            <div>
                                                <div class="font-medium text-gray-900">Alex Johnson</div>
                                                <div class="text-gray-500 text-sm">ID: #USR-2448</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">alexj@example.com</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Admin</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">3 days ago</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-gray-500 text-sm">Showing 4 of 2,548 users</div>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Previous</button>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg">1</button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Next</button>
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

        // Quick actions dropdown toggle
        document.getElementById('quickActionsBtn').addEventListener('click', function() {
            const dropdown = document.getElementById('quickActionsMenu');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('userDropdown');
            const userDropdownBtn = document.getElementById('userDropdownBtn');
            const quickActionsMenu = document.getElementById('quickActionsMenu');
            const quickActionsBtn = document.getElementById('quickActionsBtn');
            
            if (!userDropdownBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
            
            if (!quickActionsBtn.contains(event.target) && !quickActionsMenu.contains(event.target)) {
                quickActionsMenu.classList.add('hidden');
            }
        });

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // User Growth Chart
            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            const userGrowthChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'New Users',
                        data: [65, 78, 66, 84, 105, 120, 98, 87, 130, 145, 160, 185],
                        borderColor: 'rgb(147, 51, 234)',
                        backgroundColor: 'rgba(147, 51, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Active Users',
                        data: [120, 130, 125, 140, 160, 180, 175, 190, 210, 220, 240, 250],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 50
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
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
                
                timeDisplay.textContent = `${dateString} • ${timeString} • System Time`;
            }
            
            updateTime();
            setInterval(updateTime, 60000); // Update every minute
            
            setInterval(function() {
                // Simulate updating the "Quiz Attempts Today" stat
                const attemptsElement = document.querySelector('.border-l-4.border-purple-500 h3');
                if (attemptsElement) {
                    let currentAttempts = parseInt(attemptsElement.textContent);
                    currentAttempts += Math.floor(Math.random() * 5) + 1;
                    attemptsElement.textContent = currentAttempts;
                }
            }, 30000); 
        });
    </script>
</body>
</html>