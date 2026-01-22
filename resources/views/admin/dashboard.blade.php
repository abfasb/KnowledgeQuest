<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - KnowledgeQuest</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #7209b7;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --dark-color: #1a1a2e;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-card {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        }
        
        .gradient-warning {
            background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);
        }
        
        .gradient-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .question-type-tag {
            @apply px-3 py-1 rounded-full text-xs font-semibold;
        }
        
        .difficulty-badge {
            @apply px-3 py-1 rounded-full text-xs font-bold;
        }
        
        .option-drag-handle {
            cursor: move;
            touch-action: none;
        }
        
        .quiz-card {
            transition: all 0.3s ease;
            transform-style: preserve-3d;
        }
        
        .quiz-card:hover {
            transform: translateY(-5px) rotateX(5deg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .glow-effect {
            box-shadow: 0 0 20px rgba(67, 97, 238, 0.3);
        }
        
        .progress-ring__circle {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
        
        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.3s;
        }
        .fade-enter, .fade-leave-to {
            opacity: 0;
        }
        
        .slide-enter-active, .slide-leave-active {
            transition: transform 0.3s, opacity 0.3s;
        }
        .slide-enter, .slide-leave-to {
            transform: translateX(-20px);
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-white text-lg font-semibold">Loading...</p>
        </div>
    </div>

    <!-- Notification Toast -->
    <div id="toast" class="fixed top-4 right-4 z-50 max-w-sm hidden">
        <div class="bg-white rounded-lg shadow-lg p-4 border-l-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i id="toastIcon" class="text-xl"></i>
                </div>
                <div class="ml-3">
                    <p id="toastMessage" class="text-sm font-medium"></p>
                </div>
                <button onclick="hideToast()" class="ml-auto text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
                <div class="p-6">
                    <div class="text-center">
                        <i id="confirmIcon" class="text-4xl mb-4"></i>
                        <h3 id="confirmTitle" class="text-lg font-semibold mb-2"></h3>
                        <p id="confirmMessage" class="text-gray-600 mb-6"></p>
                    </div>
                    <div class="flex justify-center space-x-4">
                        <button onclick="hideConfirmModal()" id="confirmCancel" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button onclick="confirmAction()" id="confirmAction" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen">
        <!-- Header -->
        <header class="gradient-bg text-white shadow-lg">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="animate-float">
                            <i class="fas fa-brain text-3xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">KnowledgeQuest</h1>
                            <p class="text-sm opacity-80">Admin Panel</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="toggleDarkMode()" class="p-2 rounded-full bg-white bg-opacity-20 hover:bg-opacity-30">
                            <i class="fas fa-moon"></i>
                        </button>
                        <div class="relative">
                            <button onclick="toggleUserMenu()" class="flex items-center space-x-2 p-2 rounded-lg bg-white bg-opacity-20 hover:bg-opacity-30">
                                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center">
                                    <i class="fas fa-user text-gray-700"></i>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                            <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
                                <div class="py-2">
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i> Profile
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-cog mr-2"></i> Settings
                                    </a>
                                    <div class="border-t my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-6">
            <!-- Navigation -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <button onclick="showDashboard()" class="px-4 py-2 rounded-lg bg-white shadow hover:shadow-md transition-shadow">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </button>
                    <button onclick="showClasses()" class="px-4 py-2 rounded-lg bg-white shadow hover:shadow-md transition-shadow">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Classes
                    </button>
                    <button onclick="showQuizzes()" class="px-4 py-2 rounded-lg bg-white shadow hover:shadow-md transition-shadow">
                        <i class="fas fa-question-circle mr-2"></i>Quizzes
                    </button>
                    <button onclick="showStudentQuizzes()" class="px-4 py-2 rounded-lg bg-white shadow hover:shadow-md transition-shadow">
                        <i class="fas fa-graduation-cap mr-2"></i>Student Quizzes
                    </button>
                    <button onclick="showAnalytics()" class="px-4 py-2 rounded-lg bg-white shadow hover:shadow-md transition-shadow">
                        <i class="fas fa-chart-bar mr-2"></i>Analytics
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div id="contentArea">
                <!-- Dashboard will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Templates -->
    <template id="dashboardTemplate">
        <div class="animate__animated animate__fadeIn">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="gradient-card text-white rounded-xl p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm opacity-90">Total Classes</p>
                            <p class="text-3xl font-bold mt-2" id="totalClasses">0</p>
                        </div>
                        <i class="fas fa-chalkboard-teacher text-3xl opacity-50"></i>
                    </div>
                </div>
                <div class="gradient-success text-white rounded-xl p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm opacity-90">Total Quizzes</p>
                            <p class="text-3xl font-bold mt-2" id="totalQuizzes">0</p>
                        </div>
                        <i class="fas fa-question-circle text-3xl opacity-50"></i>
                    </div>
                </div>
                <div class="gradient-warning text-white rounded-xl p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm opacity-90">Active Quizzes</p>
                            <p class="text-3xl font-bold mt-2" id="activeQuizzes">0</p>
                        </div>
                        <i class="fas fa-rocket text-3xl opacity-50"></i>
                    </div>
                </div>
                <div class="gradient-danger text-white rounded-xl p-6 shadow-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm opacity-90">Total Students</p>
                            <p class="text-3xl font-bold mt-2" id="totalStudents">0</p>
                        </div>
                        <i class="fas fa-users text-3xl opacity-50"></i>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Quiz Performance</h3>
                    <div class="h-64">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Class Distribution</h3>
                    <div class="h-64">
                        <canvas id="classChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Recent Activity</h3>
                    <button onclick="refreshDashboard()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg">
                        <i class="fas fa-sync-alt mr-2"></i>Refresh
                    </button>
                </div>
                <div id="recentActivity" class="space-y-4">
                    <!-- Activity will be loaded here -->
                </div>
            </div>
        </div>
    </template>

    <template id="classesTemplate">
        <div class="animate__animated animate__fadeIn">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Classes Management</h2>
                <button onclick="showCreateClassModal()" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:opacity-90">
                    <i class="fas fa-plus mr-2"></i>Create Class
                </button>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[300px]">
                        <input type="text" id="classSearch" placeholder="Search classes..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <select id="classFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="all">All Classes</option>
                        <option value="active">Active Only</option>
                        <option value="inactive">Inactive Only</option>
                    </select>
                </div>
            </div>

            <!-- Classes Grid -->
            <div id="classesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Classes will be loaded here -->
            </div>
        </div>
    </template>

    <template id="quizzesTemplate">
        <div class="animate__animated animate__fadeIn">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Quizzes Management</h2>
                <button onclick="showCreateQuizModal()" class="px-6 py-3 bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg hover:opacity-90">
                    <i class="fas fa-plus mr-2"></i>Create Quiz
                </button>
            </div>

            <!-- Class Selector -->
            <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
                <div class="flex items-center space-x-4">
                    <label class="font-medium">Filter by Class:</label>
                    <select id="quizClassFilter" onchange="loadQuizzes()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="all">All Classes</option>
                    </select>
                </div>
            </div>

            <!-- Quizzes Container -->
            <div id="quizzesContainer">
                <!-- Quizzes will be loaded here -->
            </div>
        </div>
    </template>

    <template id="quizCardTemplate">
        <div class="quiz-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-blue-300">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="difficulty-badge bg-blue-100 text-blue-800" data-difficulty="easy">Easy</span>
                        <span class="difficulty-badge bg-yellow-100 text-yellow-800" data-difficulty="medium">Medium</span>
                        <span class="difficulty-badge bg-red-100 text-red-800" data-difficulty="hard">Hard</span>
                    </div>
                    <div class="flex space-x-2">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm" data-published="true">
                            <i class="fas fa-eye mr-1"></i>Published
                        </span>
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm" data-published="false">
                            <i class="fas fa-eye-slash mr-1"></i>Draft
                        </span>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold mb-2">Quiz Title</h3>
                <p class="text-gray-600 mb-4">Quiz description goes here...</p>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Questions</p>
                        <p class="text-lg font-semibold" data-questions-count="0">0</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Attempts</p>
                        <p class="text-lg font-semibold" data-attempts-count="0">0</p>
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">
                        <i class="far fa-clock mr-1"></i><span data-time-limit="0">No time limit</span>
                    </span>
                    <div class="flex space-x-2">
                        <button onclick="manageQuestions(this)" data-quiz-id="0" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="editQuiz(this)" data-quiz-id="0" class="px-4 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button onclick="deleteQuiz(this)" data-quiz-id="0" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Modal Templates -->
    <template id="createClassModalTemplate">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Create New Class</h3>
                        <button onclick="hideModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="createClassForm" onsubmit="createClass(event)">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Class Name *</label>
                                <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="hideModal()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:opacity-90">
                                Create Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <template id="createQuizModalTemplate">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Create New Quiz</h3>
                        <button onclick="hideModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="createQuizForm" onsubmit="createQuiz(event)">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Class *</label>
                                    <select name="class_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Select Class</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quiz Title *</label>
                                    <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Difficulty *</label>
                                    <select name="difficulty" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="easy">Easy</option>
                                        <option value="medium" selected>Medium</option>
                                        <option value="hard">Hard</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Time Limit (minutes)</label>
                                    <input type="number" name="time_limit" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Total Points *</label>
                                    <input type="number" name="total_points" required min="1" value="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                    <input type="datetime-local" name="start_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                    <input type="datetime-local" name="end_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Attempts Allowed *</label>
                                    <input type="number" name="attempts_allowed" required min="1" value="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Settings</label>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="shuffle_questions" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm">Shuffle Questions</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="shuffle_options" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm">Shuffle Options</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="show_result_immediately" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm">Show Result Immediately</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="hideModal()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg hover:opacity-90">
                                Create Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Add more templates for other modals... -->

    <script>
        // State Management
        const state = {
            currentView: 'dashboard',
            classes: [],
            quizzes: [],
            currentQuiz: null,
            currentClass: null,
            questions: [],
            quizAttempts: [],
            studentQuizzes: [],
            analytics: null,
            darkMode: false,
            confirmCallback: null,
            confirmData: null
        };

        // API Endpoints
        const API = {
            classes: '/admin/classes',
            classStudents: (id) => `/admin/classes/${id}/students`,
            updateStudentStatus: (classId, studentId) => `/admin/classes/${classId}/students/${studentId}`,
            quizzes: '/admin/quizzes',
            classQuizzes: (classId) => `/admin/classes/${classId}/quizzes`,
            quizQuestions: (quizId) => `/admin/quizzes/${quizId}/questions`,
            quizAttempts: (quizId) => `/admin/quizzes/${quizId}/attempts`,
            quizAttemptDetails: (attemptId) => `/admin/attempts/${attemptId}`,
            studentQuizzes: '/admin/student/quizzes',
            startQuiz: (quizId) => `/admin/student/quizzes/${quizId}/start`,
            submitAnswer: (attemptId) => `/admin/attempts/${attemptId}/answers`,
            completeQuiz: (attemptId) => `/admin/attempts/${attemptId}/complete`,
            studentAttempts: '/admin/student/attempts',
            studentAttemptDetails: (attemptId) => `/admin/student/attempts/${attemptId}`,
            analytics: '/admin/analytics'
        };

        // Utility Functions
        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hidden');
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const icon = document.getElementById('toastIcon');
            const messageEl = document.getElementById('toastMessage');
            
            // Set icon and color based on type
            switch(type) {
                case 'success':
                    icon.className = 'fas fa-check-circle text-green-500';
                    toast.querySelector('.border-l-4').classList.add('border-green-500');
                    break;
                case 'error':
                    icon.className = 'fas fa-times-circle text-red-500';
                    toast.querySelector('.border-l-4').classList.add('border-red-500');
                    break;
                case 'warning':
                    icon.className = 'fas fa-exclamation-triangle text-yellow-500';
                    toast.querySelector('.border-l-4').classList.add('border-yellow-500');
                    break;
                case 'info':
                    icon.className = 'fas fa-info-circle text-blue-500';
                    toast.querySelector('.border-l-4').classList.add('border-blue-500');
                    break;
            }
            
            messageEl.textContent = message;
            toast.classList.remove('hidden');
            
            // Auto hide after 5 seconds
            setTimeout(hideToast, 5000);
        }

        function hideToast() {
            document.getElementById('toast').classList.add('hidden');
        }

        function showConfirm(title, message, callback, data = null, icon = 'exclamation-triangle', confirmText = 'Confirm') {
            const modal = document.getElementById('confirmModal');
            document.getElementById('confirmTitle').textContent = title;
            document.getElementById('confirmMessage').textContent = message;
            document.getElementById('confirmIcon').className = `fas fa-${icon} text-red-500`;
            document.getElementById('confirmAction').textContent = confirmText;
            
            state.confirmCallback = callback;
            state.confirmData = data;
            modal.classList.remove('hidden');
        }

        function hideConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            state.confirmCallback = null;
            state.confirmData = null;
        }

        function confirmAction() {
            if (state.confirmCallback) {
                state.confirmCallback(state.confirmData);
            }
            hideConfirmModal();
        }

        function showModal(templateId, data = null) {
            const template = document.getElementById(templateId);
            if (!template) return;
            
            // Remove any existing modal (but NOT the loading overlay)
            const existingModal = document.querySelector('.fixed.inset-0.bg-gray-900.bg-opacity-50:not(#loadingOverlay)');
            if (existingModal) {
                existingModal.remove();
            }
            
            const modal = template.content.cloneNode(true);
            document.body.appendChild(modal);
            
            // Initialize modal with data if provided
            if (data && window[`init${templateId.replace('Template', '')}`]) {
                window[`init${templateId.replace('Template', '')}`](data);
            }
        }

        function hideModal() {
            const modal = document.querySelector('.fixed.inset-0.bg-gray-900.bg-opacity-50:not(#loadingOverlay)');
            if (modal) {
                modal.remove();
            }
        }

        // Fetch wrapper with error handling
        async function fetchAPI(url, options = {}) {
    showLoading();
    try {
        const response = await fetch(url, {
            ...options,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                ...options.headers
            }
        });
        
        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(errorText || 'Something went wrong');
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('API Error:', error);
        showToast(error.message || 'Something went wrong', 'error');
        throw error;
    } finally {
        hideLoading();
    }
}

        // Navigation Functions
        function showDashboard() {
            state.currentView = 'dashboard';
            loadDashboard();
        }

        function showClasses() {
            state.currentView = 'classes';
            loadClasses();
        }

        function showQuizzes() {
            state.currentView = 'quizzes';
            loadQuizzes();
        }

        function showStudentQuizzes() {
            state.currentView = 'studentQuizzes';
            loadStudentQuizzes();
        }

        function showAnalytics() {
            state.currentView = 'analytics';
            loadAnalytics();
        }

        // Dashboard Functions
        async function loadDashboard() {
            const contentArea = document.getElementById('contentArea');
            const template = document.getElementById('dashboardTemplate');
            contentArea.innerHTML = '';
            contentArea.appendChild(template.content.cloneNode(true));
            
            try {
                const data = await fetchAPI(API.analytics);
                state.analytics = data;
                
                // Update stats
                document.getElementById('totalClasses').textContent = data.class_stats.length;
                document.getElementById('totalQuizzes').textContent = data.quiz_stats.length;
                document.getElementById('activeQuizzes').textContent = data.quiz_stats.filter(q => q.is_published).length;
                document.getElementById('totalStudents').textContent = data.class_stats.reduce((sum, c) => sum + c.active_students_count, 0);
                
                // Render charts
                renderPerformanceChart(data);
                renderClassChart(data);
                renderRecentActivity(data.recent_activity);
            } catch (error) {
                console.error('Failed to load dashboard:', error);
            }
        }

        function renderPerformanceChart(data) {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const quizNames = data.quiz_stats.map(q => q.title.substring(0, 20) + '...');
            const avgScores = data.quiz_stats.map(q => {
                const avg = q.attempts?.[0]?.avg_score || 0;
                return Math.round(avg);
            });
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: quizNames,
                    datasets: [{
                        label: 'Average Score (%)',
                        data: avgScores,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }

        function renderClassChart(data) {
            const ctx = document.getElementById('classChart').getContext('2d');
            const classNames = data.class_stats.map(c => c.name);
            const studentCounts = data.class_stats.map(c => c.active_students_count);
            const quizCounts = data.class_stats.map(c => c.quizzes_count);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: classNames,
                    datasets: [
                        {
                            label: 'Students',
                            data: studentCounts,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            tension: 0.1
                        },
                        {
                            label: 'Quizzes',
                            data: quizCounts,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }

        function renderRecentActivity(activities) {
            const container = document.getElementById('recentActivity');
            container.innerHTML = '';
            
            activities.forEach(activity => {
                const activityEl = document.createElement('div');
                activityEl.className = 'flex items-center p-4 bg-gray-50 rounded-lg';
                
                const icon = activity.status === 'completed' ? 'check-circle text-green-500' : 'clock text-yellow-500';
                const message = `${activity.user.name} ${activity.status === 'completed' ? 'completed' : 'started'} "${activity.quiz.title}"`;
                const score = activity.total_score ? `Score: ${activity.total_score}%` : 'In Progress';
                
                activityEl.innerHTML = `
                    <div class="flex-shrink-0">
                        <i class="fas fa-${icon} text-xl"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="font-medium">${message}</p>
                        <p class="text-sm text-gray-500">${score} • ${new Date(activity.completed_at || activity.started_at).toLocaleString()}</p>
                    </div>
                `;
                
                container.appendChild(activityEl);
            });
        }

        function refreshDashboard() {
            loadDashboard();
        }

        // Classes Functions
        async function loadClasses() {
            const contentArea = document.getElementById('contentArea');
            const template = document.getElementById('classesTemplate');
            contentArea.innerHTML = '';
            contentArea.appendChild(template.content.cloneNode(true));
            
            try {
                const data = await fetchAPI(API.classes);
                state.classes = data;
                renderClasses(data);
                
                // Setup search and filter
                setupClassSearch();
            } catch (error) {
                console.error('Failed to load classes:', error);
            }
        }

        function renderClasses(classes) {
            const container = document.getElementById('classesContainer');
            container.innerHTML = '';
            
            classes.forEach(classItem => {
                const classEl = document.createElement('div');
                classEl.className = 'bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-purple-300 transition-all duration-300';
                classEl.innerHTML = `
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="px-3 py-1 ${classItem.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'} rounded-full text-sm">
                                    ${classItem.is_active ? 'Active' : 'Inactive'}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="manageClassStudents(${classItem.id})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                    <i class="fas fa-users"></i>
                                </button>
                                <button onclick="editClass(${classItem.id})" class="p-2 text-green-600 hover:bg-green-50 rounded-lg">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteClass(${classItem.id})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2">${classItem.name}</h3>
                        <p class="text-gray-600 mb-4">${classItem.description || 'No description'}</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Students</p>
                                <p class="text-lg font-semibold">${classItem.active_students_count || 0}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Quizzes</p>
                                <p class="text-lg font-semibold">${classItem.quizzes_count || 0}</p>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-key mr-1"></i>${classItem.class_code}
                                </span>
                                <span class="text-sm text-gray-500">
                                    ${classItem.pending_students_count || 0} pending
                                </span>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(classEl);
            });
        }

        function setupClassSearch() {
            const searchInput = document.getElementById('classSearch');
            const filterSelect = document.getElementById('classFilter');
            
            const handleSearch = () => {
                const searchTerm = searchInput.value.toLowerCase();
                const filterValue = filterSelect.value;
                
                let filtered = state.classes;
                
                if (searchTerm) {
                    filtered = filtered.filter(c => 
                        c.name.toLowerCase().includes(searchTerm) || 
                        c.description?.toLowerCase().includes(searchTerm) ||
                        c.class_code.toLowerCase().includes(searchTerm)
                    );
                }
                
                if (filterValue === 'active') {
                    filtered = filtered.filter(c => c.is_active);
                } else if (filterValue === 'inactive') {
                    filtered = filtered.filter(c => !c.is_active);
                }
                
                renderClasses(filtered);
            };
            
            searchInput.addEventListener('input', handleSearch);
            filterSelect.addEventListener('change', handleSearch);
        }

        function showCreateClassModal() {
            showModal('createClassModalTemplate');
        }

        async function createClass(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            try {
                const result = await fetchAPI(API.classes, {
                    method: 'POST',
                    body: JSON.stringify(data)
                });
                
                showToast(result.message, 'success');
                hideModal();
                loadClasses();
            } catch (error) {
                console.error('Failed to create class:', error);
            }
        }

        async function editClass(classId) {
            const classItem = state.classes.find(c => c.id === classId);
            if (!classItem) return;
            
            showModal('createClassModalTemplate', classItem);
            // Update form with class data
            setTimeout(() => {
                const form = document.getElementById('createClassForm');
                form.querySelector('[name="name"]').value = classItem.name;
                form.querySelector('[name="description"]').value = classItem.description || '';
                form.onsubmit = (e) => updateClass(e, classId);
                form.querySelector('button[type="submit"]').textContent = 'Update Class';
            }, 100);
        }

        async function updateClass(event, classId) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            try {
                const result = await fetchAPI(`${API.classes}/${classId}`, {
                    method: 'PUT',
                    body: JSON.stringify(data)
                });
                
                showToast(result.message, 'success');
                hideModal();
                loadClasses();
            } catch (error) {
                console.error('Failed to update class:', error);
            }
        }

        async function deleteClass(classId) {
            showConfirm(
                'Delete Class',
                'Are you sure you want to delete this class? This action cannot be undone.',
                async () => {
                    try {
                        const result = await fetchAPI(`${API.classes}/${classId}`, {
                            method: 'DELETE'
                        });
                        
                        showToast(result.message, 'success');
                        loadClasses();
                    } catch (error) {
                        console.error('Failed to delete class:', error);
                    }
                },
                classId
            );
        }

        async function manageClassStudents(classId) {
            // Implementation for managing class students
            showToast('Student management feature coming soon!', 'info');
        }

        // Quizzes Functions
        async function loadQuizzes(classId = null) {
            const contentArea = document.getElementById('contentArea');
            const template = document.getElementById('quizzesTemplate');
            contentArea.innerHTML = '';
            contentArea.appendChild(template.content.cloneNode(true));
            
            try {
                // Load classes for filter
                const classes = await fetchAPI(API.classes);
                const classFilter = document.getElementById('quizClassFilter');
                
                classes.forEach(classItem => {
                    const option = document.createElement('option');
                    option.value = classItem.id;
                    option.textContent = classItem.name;
                    if (classId && classItem.id === classId) {
                        option.selected = true;
                    }
                    classFilter.appendChild(option);
                });
                
                // Load quizzes
                const url = classId && classId !== 'all' ? API.classQuizzes(classId) : API.quizzes;
                const data = await fetchAPI(url);
                state.quizzes = data;
                renderQuizzes(data);
            } catch (error) {
                console.error('Failed to load quizzes:', error);
            }
        }

        function renderQuizzes(quizzes) {
            const container = document.getElementById('quizzesContainer');
            container.innerHTML = '';
            
            if (quizzes.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12">
                        <i class="fas fa-question-circle text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">No Quizzes Found</h3>
                        <p class="text-gray-500 mb-4">Create your first quiz to get started!</p>
                        <button onclick="showCreateQuizModal()" class="px-6 py-2 bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg hover:opacity-90">
                            <i class="fas fa-plus mr-2"></i>Create Quiz
                        </button>
                    </div>
                `;
                return;
            }
            
            quizzes.forEach(quiz => {
                const quizEl = document.createElement('div');
                quizEl.className = 'quiz-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-blue-300 mb-6';
                quizEl.innerHTML = `
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="difficulty-badge ${getDifficultyClass(quiz.difficulty)}">
                                    ${quiz.difficulty.charAt(0).toUpperCase() + quiz.difficulty.slice(1)}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <span class="px-3 py-1 ${quiz.is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'} rounded-full text-sm">
                                    <i class="fas ${quiz.is_published ? 'fa-eye' : 'fa-eye-slash'} mr-1"></i>
                                    ${quiz.is_published ? 'Published' : 'Draft'}
                                </span>
                                <button onclick="toggleQuizPublish(${quiz.id}, ${!quiz.is_published})" class="px-3 py-1 ${quiz.is_published ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'bg-blue-100 text-blue-800 hover:bg-blue-200'} rounded-full text-sm">
                                    <i class="fas ${quiz.is_published ? 'fa-eye-slash' : 'fa-eye'} mr-1"></i>
                                    ${quiz.is_published ? 'Unpublish' : 'Publish'}
                                </button>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2">${quiz.title}</h3>
                        <p class="text-gray-600 mb-4">${quiz.description || 'No description'}</p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Questions</p>
                                <p class="text-lg font-semibold">${quiz.questions?.length || 0}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Attempts</p>
                                <p class="text-lg font-semibold">${quiz.attempts?.length || 0}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Time</p>
                                <p class="text-lg font-semibold">${quiz.time_limit || '∞'} min</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Points</p>
                                <p class="text-lg font-semibold">${quiz.total_points}</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>${quiz.class?.name || 'Unknown Class'}
                                </span>
                                ${quiz.start_date ? `
                                    <span class="text-sm text-gray-500 ml-4">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        ${new Date(quiz.start_date).toLocaleDateString()}
                                    </span>
                                ` : ''}
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="manageQuestions(${quiz.id})" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                    <i class="fas fa-edit mr-2"></i>Questions
                                </button>
                                <button onclick="viewQuizResults(${quiz.id})" class="px-4 py-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200">
                                    <i class="fas fa-chart-bar mr-2"></i>Results
                                </button>
                                <button onclick="editQuiz(${quiz.id})" class="px-4 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                    <i class="fas fa-pencil-alt mr-2"></i>Edit
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(quizEl);
            });
        }

        function getDifficultyClass(difficulty) {
            switch(difficulty) {
                case 'easy': return 'bg-green-100 text-green-800';
                case 'medium': return 'bg-yellow-100 text-yellow-800';
                case 'hard': return 'bg-red-100 text-red-800';
                default: return 'bg-gray-100 text-gray-800';
            }
        }

        function showCreateQuizModal() {
            showModal('createQuizModalTemplate');
            
            // Load classes into select
            setTimeout(async () => {
                try {
                    const classes = await fetchAPI(API.classes);
                    const select = document.querySelector('#createQuizForm select[name="class_id"]');
                    select.innerHTML = '<option value="">Select Class</option>';
                    
                    classes.forEach(classItem => {
                        const option = document.createElement('option');
                        option.value = classItem.id;
                        option.textContent = classItem.name;
                        select.appendChild(option);
                    });
                } catch (error) {
                    console.error('Failed to load classes:', error);
                }
            }, 100);
        }

        async function createQuiz(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            // Convert checkboxes
            data.shuffle_questions = formData.get('shuffle_questions') === 'on';
            data.shuffle_options = formData.get('shuffle_options') === 'on';
            data.show_result_immediately = formData.get('show_result_immediately') === 'on';
            
            try {
                const result = await fetchAPI(API.quizzes, {
                    method: 'POST',
                    body: JSON.stringify(data)
                });
                
                showToast(result.message, 'success');
                hideModal();
                loadQuizzes(data.class_id);
            } catch (error) {
                console.error('Failed to create quiz:', error);
            }
        }

        async function editQuiz(quizId) {
            const quiz = state.quizzes.find(q => q.id === quizId);
            if (!quiz) return;
            
            showModal('createQuizModalTemplate', quiz);
            
            setTimeout(async () => {
                try {
                    const classes = await fetchAPI(API.classes);
                    const form = document.getElementById('createQuizForm');
                    const select = form.querySelector('select[name="class_id"]');
                    
                    select.innerHTML = '<option value="">Select Class</option>';
                    classes.forEach(classItem => {
                        const option = document.createElement('option');
                        option.value = classItem.id;
                        option.textContent = classItem.name;
                        if (classItem.id === quiz.class_id) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                    
                    // Fill form with quiz data
                    form.querySelector('[name="title"]').value = quiz.title;
                    form.querySelector('[name="description"]').value = quiz.description || '';
                    form.querySelector('[name="difficulty"]').value = quiz.difficulty;
                    form.querySelector('[name="time_limit"]').value = quiz.time_limit || '';
                    form.querySelector('[name="total_points"]').value = quiz.total_points;
                    form.querySelector('[name="attempts_allowed"]').value = quiz.attempts_allowed;
                    form.querySelector('[name="shuffle_questions"]').checked = quiz.shuffle_questions;
                    form.querySelector('[name="shuffle_options"]').checked = quiz.shuffle_options;
                    form.querySelector('[name="show_result_immediately"]').checked = quiz.show_result_immediately;
                    
                    if (quiz.start_date) {
                        const startDate = new Date(quiz.start_date);
                        form.querySelector('[name="start_date"]').value = startDate.toISOString().slice(0, 16);
                    }
                    
                    if (quiz.end_date) {
                        const endDate = new Date(quiz.end_date);
                        form.querySelector('[name="end_date"]').value = endDate.toISOString().slice(0, 16);
                    }
                    
                    form.onsubmit = (e) => updateQuiz(e, quizId);
                    form.querySelector('button[type="submit"]').textContent = 'Update Quiz';
                } catch (error) {
                    console.error('Failed to load quiz data:', error);
                }
            }, 100);
        }

        async function updateQuiz(event, quizId) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            // Convert checkboxes
            data.shuffle_questions = formData.get('shuffle_questions') === 'on';
            data.shuffle_options = formData.get('shuffle_options') === 'on';
            data.show_result_immediately = formData.get('show_result_immediately') === 'on';
            
            try {
                const result = await fetchAPI(`${API.quizzes}/${quizId}`, {
                    method: 'PUT',
                    body: JSON.stringify(data)
                });
                
                showToast(result.message, 'success');
                hideModal();
                loadQuizzes(data.class_id);
            } catch (error) {
                console.error('Failed to update quiz:', error);
            }
        }

        async function toggleQuizPublish(quizId, publish) {
            try {
                const url = `${API.quizzes}/${quizId}/${publish ? 'publish' : 'unpublish'}`;
                const result = await fetchAPI(url, {
                    method: 'POST'
                });
                
                showToast(result.message, 'success');
                loadQuizzes();
            } catch (error) {
                console.error('Failed to toggle publish:', error);
            }
        }

        async function manageQuestions(quizId) {
            // Implementation for managing questions
            showToast('Question management feature coming soon!', 'info');
        }

        async function viewQuizResults(quizId) {
            // Implementation for viewing quiz results
            showToast('Results viewing feature coming soon!', 'info');
        }

        // Student Quizzes Functions
        async function loadStudentQuizzes() {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="animate__animated animate__fadeIn">
                    <h2 class="text-2xl font-bold mb-6">Available Quizzes</h2>
                    <div id="studentQuizzesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="text-center py-12">
                            <div class="w-16 h-16 border-4 border-gray-300 border-t-transparent rounded-full animate-spin mx-auto"></div>
                            <p class="mt-4 text-gray-600">Loading quizzes...</p>
                        </div>
                    </div>
                </div>
            `;
            
            try {
                const data = await fetchAPI(API.studentQuizzes);
                state.studentQuizzes = data;
                renderStudentQuizzes(data);
            } catch (error) {
                console.error('Failed to load student quizzes:', error);
            }
        }

        function renderStudentQuizzes(quizzes) {
            const container = document.getElementById('studentQuizzesContainer');
            container.innerHTML = '';
            
            if (quizzes.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-question-circle text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">No Available Quizzes</h3>
                        <p class="text-gray-500">You are not enrolled in any classes with active quizzes.</p>
                    </div>
                `;
                return;
            }
            
            quizzes.forEach(quiz => {
                const attempts = quiz.attempts || [];
                const remainingAttempts = quiz.remaining_attempts;
                const canTakeQuiz = remainingAttempts > 0 && quiz.is_active;
                
                const quizEl = document.createElement('div');
                quizEl.className = 'quiz-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-blue-300';
                quizEl.innerHTML = `
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="difficulty-badge ${getDifficultyClass(quiz.difficulty)}">
                                    ${quiz.difficulty.charAt(0).toUpperCase() + quiz.difficulty.slice(1)}
                                </span>
                            </div>
                            <div>
                                <span class="px-3 py-1 ${quiz.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'} rounded-full text-sm">
                                    ${quiz.is_active ? 'Active' : 'Inactive'}
                                </span>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2">${quiz.title}</h3>
                        <p class="text-gray-600 mb-4">${quiz.description || 'No description'}</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Class</p>
                                <p class="font-semibold">${quiz.class?.name || 'Unknown'}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Time Limit</p>
                                <p class="font-semibold">${quiz.time_limit || '∞'} min</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-1">Attempts: ${attempts.length}/${quiz.attempts_allowed}</p>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: ${(attempts.length / quiz.attempts_allowed) * 100}%"></div>
                            </div>
                        </div>
                        
                        ${attempts.length > 0 ? `
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-2">Best Score:</p>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center text-white font-bold">
                                        ${Math.max(...attempts.map(a => a.total_score || 0))}%
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-600">Completed: ${attempts.filter(a => a.status === 'completed').length}</p>
                                        <p class="text-sm text-gray-600">Remaining: ${remainingAttempts}</p>
                                    </div>
                                </div>
                            </div>
                        ` : ''}
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                ${remainingAttempts > 0 ? `${remainingAttempts} attempt${remainingAttempts > 1 ? 's' : ''} left` : 'No attempts left'}
                            </span>
                            <button onclick="${canTakeQuiz ? `startQuiz(${quiz.id})` : 'showToast(\'No attempts remaining or quiz inactive\', \'warning\')'}" 
                                class="px-6 py-2 ${canTakeQuiz ? 'bg-gradient-to-r from-green-500 to-blue-600 hover:opacity-90' : 'bg-gray-300 cursor-not-allowed'} text-white rounded-lg">
                                <i class="fas fa-play mr-2"></i>Start Quiz
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(quizEl);
            });
        }

        async function startQuiz(quizId) {
            try {
                const result = await fetchAPI(API.startQuiz(quizId), {
                    method: 'POST'
                });
                
                showToast(result.message, 'success');
                // Redirect to quiz taking interface
                showQuizTakingInterface(result.attempt, result.questions, result.quiz);
            } catch (error) {
                console.error('Failed to start quiz:', error);
            }
        }

        function showQuizTakingInterface(attempt, questions, quiz) {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="animate__animated animate__fadeIn">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold">${quiz.title}</h2>
                                <p class="text-gray-600">${quiz.description || ''}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-blue-600" id="quizTimer">${quiz.time_limit || '∞'}:00</div>
                                <p class="text-sm text-gray-500">Time Remaining</p>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium">Progress</span>
                                <span class="text-sm font-medium"><span id="currentQuestion">1</span>/${questions.length}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" id="progressBar" style="width: ${(1/questions.length)*100}%"></div>
                            </div>
                        </div>
                        
                        <div id="quizQuestionsContainer" class="space-y-6">
                            <!-- Questions will be loaded here -->
                        </div>
                        
                        <div class="mt-8 flex justify-between">
                            <button onclick="showStudentQuizzes()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-arrow-left mr-2"></i>Back to Quizzes
                            </button>
                            <button onclick="submitQuiz(${attempt.id})" class="px-6 py-2 bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg hover:opacity-90">
                                Submit Quiz <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            renderQuizQuestions(questions, quiz);
            
            // Start timer if time limit exists
            if (quiz.time_limit) {
                startQuizTimer(quiz.time_limit * 60);
            }
        }

        function renderQuizQuestions(questions, quiz) {
            const container = document.getElementById('quizQuestionsContainer');
            container.innerHTML = '';
            
            questions.forEach((question, index) => {
                const questionEl = document.createElement('div');
                questionEl.className = 'bg-gray-50 rounded-lg p-6';
                questionEl.innerHTML = `
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="question-type-tag ${getQuestionTypeClass(question.question_type)}">
                                ${getQuestionTypeLabel(question.question_type)}
                            </span>
                            <span class="ml-2 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                ${question.points} point${question.points > 1 ? 's' : ''}
                            </span>
                        </div>
                        <span class="text-gray-500">Question ${index + 1}</span>
                    </div>
                    
                    <p class="text-lg font-medium mb-6">${question.question_text}</p>
                    
                    <div id="questionOptions_${question.id}">
                        ${renderQuestionOptions(question, quiz)}
                    </div>
                    
                    ${question.explanation ? `
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-800"><strong>Hint:</strong> ${question.explanation}</p>
                        </div>
                    ` : ''}
                `;
                container.appendChild(questionEl);
            });
        }

        function getQuestionTypeClass(type) {
            const classes = {
                'mcq': 'bg-purple-100 text-purple-800',
                'identification': 'bg-yellow-100 text-yellow-800',
                'fill_in_the_blanks': 'bg-green-100 text-green-800',
                'true_false': 'bg-red-100 text-red-800',
                'multiple_response': 'bg-pink-100 text-pink-800',
                'essay': 'bg-indigo-100 text-indigo-800',
                'matching': 'bg-teal-100 text-teal-800',
                'ordering': 'bg-orange-100 text-orange-800'
            };
            return classes[type] || 'bg-gray-100 text-gray-800';
        }

        function getQuestionTypeLabel(type) {
            const labels = {
                'mcq': 'Multiple Choice',
                'identification': 'Identification',
                'fill_in_the_blanks': 'Fill in the Blanks',
                'true_false': 'True/False',
                'multiple_response': 'Multiple Response',
                'essay': 'Essay',
                'matching': 'Matching',
                'ordering': 'Ordering'
            };
            return labels[type] || type;
        }

        function renderQuestionOptions(question, quiz) {
            switch(question.question_type) {
                case 'mcq':
                case 'true_false':
                    return `
                        <div class="space-y-3">
                            ${question.options.map((option, optIndex) => `
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                    <input type="radio" name="question_${question.id}" value="${option.id}" 
                                           onchange="saveAnswer(${question.id}, '${option.id}')"
                                           class="h-5 w-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">${option.option_text}</span>
                                </label>
                            `).join('')}
                        </div>
                    `;
                    
                case 'multiple_response':
                    return `
                        <div class="space-y-3">
                            ${question.options.map(option => `
                                <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-blue-50 cursor-pointer">
                                    <input type="checkbox" name="question_${question.id}[]" value="${option.id}"
                                           onchange="saveMultipleAnswer(${question.id})"
                                           class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">${option.option_text}</span>
                                </label>
                            `).join('')}
                        </div>
                    `;
                    
                case 'identification':
                case 'fill_in_the_blanks':
                    return `
                        <div>
                            <input type="text" onchange="saveTextAnswer(${question.id}, this.value)"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Type your answer here...">
                        </div>
                    `;
                    
                case 'essay':
                    return `
                        <div>
                            <textarea onchange="saveTextAnswer(${question.id}, this.value)"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Write your essay answer here..."></textarea>
                        </div>
                    `;
                    
                default:
                    return '<p class="text-gray-500">Question type not supported</p>';
            }
        }

        async function saveAnswer(questionId, answer) {
            // Implementation for saving single answer
            showToast('Answer saved!', 'success');
        }

        async function saveMultipleAnswer(questionId) {
            // Implementation for saving multiple answers
            showToast('Answer saved!', 'success');
        }

        async function saveTextAnswer(questionId, answer) {
            // Implementation for saving text answer
            showToast('Answer saved!', 'success');
        }

        function startQuizTimer(totalSeconds) {
            let remainingSeconds = totalSeconds;
            const timerElement = document.getElementById('quizTimer');
            
            const timer = setInterval(() => {
                remainingSeconds--;
                
                const minutes = Math.floor(remainingSeconds / 60);
                const seconds = remainingSeconds % 60;
                
                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                
                if (remainingSeconds <= 0) {
                    clearInterval(timer);
                    showToast('Time is up! Submitting quiz...', 'warning');
                    submitQuiz(state.currentAttemptId);
                }
            }, 1000);
        }

        async function submitQuiz(attemptId) {
            try {
                const result = await fetchAPI(API.completeQuiz(attemptId), {
                    method: 'POST'
                });
                
                showToast(result.message, 'success');
                
                if (result.show_result) {
                    showQuizResult(result.attempt, result.score_data);
                } else {
                    showToast('Quiz submitted successfully! Results will be available later.', 'success');
                    showStudentQuizzes();
                }
            } catch (error) {
                console.error('Failed to submit quiz:', error);
            }
        }

        function showQuizResult(attempt, scoreData) {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="animate__animated animate__fadeIn">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold mb-4">Quiz Completed!</h2>
                        <p class="text-gray-600">You have successfully completed the quiz.</p>
                    </div>
                    
                    <div class="max-w-2xl mx-auto">
                        <!-- Score Card -->
                        <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                            <div class="text-center">
                                <div class="inline-block relative">
                                    <svg class="w-48 h-48" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="45" fill="none" stroke="#e6e6e6" stroke-width="10"/>
                                        <circle cx="50" cy="50" r="45" fill="none" stroke="#4361ee" stroke-width="10" 
                                                stroke-dasharray="283" stroke-dashoffset="${283 - (scoreData.score / 100 * 283)}"
                                                class="progress-ring__circle"/>
                                        <text x="50" y="50" text-anchor="middle" dy=".3em" class="text-2xl font-bold">${scoreData.score}%</text>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold mt-4">${scoreData.score >= 70 ? 'Congratulations!' : 'Good Effort!'}</h3>
                                <p class="text-gray-600 mt-2">Your score: ${scoreData.points_earned}/${scoreData.total_possible} points</p>
                            </div>
                        </div>
                        
                        <!-- Stats Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-white rounded-lg shadow p-4 text-center">
                                <p class="text-2xl font-bold text-green-600">${scoreData.correct}</p>
                                <p class="text-sm text-gray-600">Correct</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 text-center">
                                <p class="text-2xl font-bold text-red-600">${scoreData.incorrect}</p>
                                <p class="text-sm text-gray-600">Incorrect</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 text-center">
                                <p class="text-2xl font-bold text-blue-600">${attempt.time_taken || 0}</p>
                                <p class="text-sm text-gray-600">Seconds</p>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 text-center">
                                <p class="text-2xl font-bold text-purple-600">${attempt.attempt_number}</p>
                                <p class="text-sm text-gray-600">Attempt</p>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex justify-center space-x-4">
                            <button onclick="showStudentQuizzes()" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:opacity-90">
                                <i class="fas fa-list mr-2"></i>Back to Quizzes
                            </button>
                            <button onclick="reviewQuiz(${attempt.id})" class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-eye mr-2"></i>Review Answers
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        async function reviewQuiz(attemptId) {
            try {
                const data = await fetchAPI(API.studentAttemptDetails(attemptId));
                showQuizReview(data);
            } catch (error) {
                console.error('Failed to load quiz review:', error);
            }
        }

        function showQuizReview(attempt) {
            // Implementation for quiz review
            showToast('Quiz review feature coming soon!', 'info');
        }

        // Analytics Functions
        async function loadAnalytics() {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="animate__animated animate__fadeIn">
                    <h2 class="text-2xl font-bold mb-6">Analytics Dashboard</h2>
                    <div class="text-center py-12">
                        <div class="w-16 h-16 border-4 border-gray-300 border-t-transparent rounded-full animate-spin mx-auto"></div>
                        <p class="mt-4 text-gray-600">Loading analytics...</p>
                    </div>
                </div>
            `;
            
            try {
                const data = await fetchAPI(API.analytics);
                renderAnalytics(data);
            } catch (error) {
                console.error('Failed to load analytics:', error);
            }
        }

        function renderAnalytics(data) {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="animate__animated animate__fadeIn">
                    <h2 class="text-2xl font-bold mb-6">Analytics Dashboard</h2>
                    
                    <!-- Overall Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Classes</p>
                                    <p class="text-2xl font-bold">${data.class_stats.length}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                                    <i class="fas fa-question-circle text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Active Quizzes</p>
                                    <p class="text-2xl font-bold">${data.quiz_stats.filter(q => q.is_published).length}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 mr-4">
                                    <i class="fas fa-users text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Students</p>
                                    <p class="text-2xl font-bold">${data.class_stats.reduce((sum, c) => sum + c.active_students_count, 0)}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-purple-100 text-purple-600 mr-4">
                                    <i class="fas fa-chart-line text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Avg. Score</p>
                                    <p class="text-2xl font-bold">
                                        ${data.quiz_stats.reduce((sum, q) => {
                                            const avg = q.attempts?.[0]?.avg_score || 0;
                                            return sum + avg;
                                        }, 0) / data.quiz_stats.length || 0}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detailed Analytics -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Quiz Performance -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Top Performing Quizzes</h3>
                            <div class="space-y-4">
                                ${data.quiz_stats
                                    .sort((a, b) => (b.attempts?.[0]?.avg_score || 0) - (a.attempts?.[0]?.avg_score || 0))
                                    .slice(0, 5)
                                    .map(quiz => `
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div>
                                                <p class="font-medium">${quiz.title}</p>
                                                <p class="text-sm text-gray-600">${quiz.class?.name || 'Unknown Class'}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-blue-600">${quiz.attempts?.[0]?.avg_score?.toFixed(1) || 0}%</p>
                                                <p class="text-sm text-gray-600">${quiz.attempts_count || 0} attempts</p>
                                            </div>
                                        </div>
                                    `).join('')}
                            </div>
                        </div>
                        
                        <!-- Recent Activity -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                            <div class="space-y-4">
                                ${data.recent_activity
                                    .slice(0, 5)
                                    .map(activity => `
                                        <div class="flex items-center p-3 border border-gray-200 rounded-lg">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white">
                                                    ${activity.user.name.charAt(0)}
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <p class="font-medium">${activity.user.name}</p>
                                                <p class="text-sm text-gray-600">
                                                    ${activity.status === 'completed' ? 'completed' : 'started'} "${activity.quiz.title}"
                                                    ${activity.total_score ? `with ${activity.total_score}%` : ''}
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm text-gray-500">
                                                    ${new Date(activity.completed_at || activity.started_at).toLocaleDateString()}
                                                </p>
                                            </div>
                                        </div>
                                    `).join('')}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Utility Functions
        function toggleDarkMode() {
            state.darkMode = !state.darkMode;
            if (state.darkMode) {
                document.documentElement.classList.add('dark');
                document.body.classList.add('bg-gray-900', 'text-white');
            } else {
                document.documentElement.classList.remove('dark');
                document.body.classList.remove('bg-gray-900', 'text-white');
            }
        }

        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        }

        // Close user menu when clicking outside
        document.addEventListener('click', (event) => {
            const userMenu = document.getElementById('userMenu');
            const userButton = document.querySelector('[onclick="toggleUserMenu()"]');
            
            if (userMenu && !userMenu.contains(event.target) && !userButton.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Initialize dashboard on page load
        document.addEventListener('DOMContentLoaded', () => {
            showDashboard();
        });
    </script>
</body>
</html>