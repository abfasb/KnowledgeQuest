<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>KnowledgeQuest - Interactive Learning Platform</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .progress-bar {
            transition: width 1s ease-in-out;
        }
        
        .tab-active {
            background-color: white;
            color: #764ba2;
            font-weight: 600;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
            100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <nav class="gradient-bg text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-brain text-2xl"></i>
                    <h1 class="text-2xl font-bold">KnowledgeQuest</h1>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="hover:text-yellow-300 transition duration-300">Dashboard</a>
                    <a href="#" class="hover:text-yellow-300 transition duration-300">Quizzes</a>
                    <a href="#" class="hover:text-yellow-300 transition duration-300">Leaderboard</a>
                    <a href="#" class="hover:text-yellow-300 transition duration-300">Progress</a>
                    <a href="#" class="hover:text-yellow-300 transition duration-300">Badges</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <i class="fas fa-bell text-xl cursor-pointer"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 bg-white bg-opacity-20 px-4 py-2 rounded-full">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="User" class="h-8 w-8 rounded-full">
                        <span>John Doe</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Container -->
    <div class="container mx-auto px-4 py-8">
        <!-- Role Selection (Tabs) -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="flex flex-col md:flex-row justify-center items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Welcome to KnowledgeQuest</h2>
                <div class="bg-gradient-to-r from-purple-100 to-blue-100 px-6 py-2 rounded-full">
                    <span class="font-medium text-purple-800">Interactive Learning Platform</span>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="flex border-b">
                    <button id="studentTab" class="tab-button flex-1 py-4 text-center text-lg font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition duration-300 tab-active">
                        <i class="fas fa-user-graduate mr-2"></i>Student Portal
                    </button>
                    <button id="adminTab" class="tab-button flex-1 py-4 text-center text-lg font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition duration-300">
                        <i class="fas fa-user-shield mr-2"></i>Admin Portal
                    </button>
                </div>
                
                <!-- Student Dashboard -->
                <div id="studentDashboard" class="p-6 md:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                        <!-- User Profile Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 p-6 rounded-xl border border-blue-100 card-hover">
                            <div class="flex items-center mb-4">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=667eea&color=fff" alt="User" class="h-16 w-16 rounded-full mr-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">John Doe</h3>
                                    <p class="text-gray-600">Knowledge Seeker</p>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-star text-yellow-500 mr-1"></i>
                                        <span class="font-medium">Level 12</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Points:</span>
                                <span class="font-bold text-purple-700">1,850</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Rank:</span>
                                <span class="font-bold text-purple-700">#8</span>
                            </div>
                        </div>
                        
                        <!-- Stats Card -->
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm card-hover">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Your Stats</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-700">Quizzes Completed</span>
                                        <span class="font-medium">24</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 80%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-700">Correct Answers</span>
                                        <span class="font-medium">78%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-700">Learning Streak</span>
                                        <span class="font-medium">14 days</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-purple-500 h-2 rounded-full" style="width: 70%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Badges Card -->
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm card-hover">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Recent Badges</h3>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex flex-col items-center">
                                    <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center mb-1">
                                        <i class="fas fa-rocket text-yellow-600"></i>
                                    </div>
                                    <span class="text-xs text-center">Quick Starter</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-1">
                                        <i class="fas fa-brain text-blue-600"></i>
                                    </div>
                                    <span class="text-xs text-center">Mastermind</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mb-1">
                                        <i class="fas fa-fire text-green-600"></i>
                                    </div>
                                    <span class="text-xs text-center">Hot Streak</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center mb-1">
                                        <i class="fas fa-trophy text-purple-600"></i>
                                    </div>
                                    <span class="text-xs text-center">Champion</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center mb-1">
                                        <i class="fas fa-bolt text-red-600"></i>
                                    </div>
                                    <span class="text-xs text-center">Speedster</span>
                                </div>
                            </div>
                            <button class="w-full mt-4 bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 rounded-lg transition duration-300">
                                View All Badges
                            </button>
                        </div>
                    </div>
                    
                    <!-- Available Quizzes Section -->
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Available Quizzes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                        <!-- Quiz Card 1 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm card-hover">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Science</span>
                                        <span class="inline-block ml-2 px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Easy</span>
                                    </div>
                                    <div class="text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <span class="text-sm ml-1">4.8</span>
                                    </div>
                                </div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2">Biology Basics</h4>
                                <p class="text-gray-600 mb-4">Test your knowledge of fundamental biology concepts and living organisms.</p>
                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span>15 min</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-question-circle mr-1"></i>
                                        <span>10 questions</span>
                                    </div>
                                </div>
                                <button class="w-full gradient-bg text-white py-3 rounded-lg font-medium hover:opacity-90 transition duration-300 pulse">
                                    Start Quiz
                                </button>
                            </div>
                        </div>
                        
                        <!-- Quiz Card 2 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm card-hover">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">History</span>
                                        <span class="inline-block ml-2 px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Medium</span>
                                    </div>
                                    <div class="text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <span class="text-sm ml-1">4.5</span>
                                    </div>
                                </div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2">World History</h4>
                                <p class="text-gray-600 mb-4">Explore historical events from ancient civilizations to modern times.</p>
                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span>25 min</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-question-circle mr-1"></i>
                                        <span>15 questions</span>
                                    </div>
                                </div>
                                <button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg font-medium hover:opacity-90 transition duration-300">
                                    Start Quiz
                                </button>
                            </div>
                        </div>
                        
                        <!-- Quiz Card 3 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm card-hover">
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Mathematics</span>
                                        <span class="inline-block ml-2 px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Hard</span>
                                    </div>
                                    <div class="text-yellow-500">
                                        <i class="fas fa-star"></i>
                                        <span class="text-sm ml-1">4.9</span>
                                    </div>
                                </div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2">Advanced Calculus</h4>
                                <p class="text-gray-600 mb-4">Challenge yourself with complex calculus problems and theorems.</p>
                                <div class="flex justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="far fa-clock mr-1"></i>
                                        <span>40 min</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="far fa-question-circle mr-1"></i>
                                        <span>20 questions</span>
                                    </div>
                                </div>
                                <button class="w-full bg-gradient-to-r from-red-500 to-orange-600 text-white py-3 rounded-lg font-medium hover:opacity-90 transition duration-300">
                                    Start Quiz
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Leaderboard Preview -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Top Performers</h3>
                            <a href="#" class="text-purple-600 hover:text-purple-800 font-medium">View Full Leaderboard <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left py-3 text-gray-700">Rank</th>
                                        <th class="text-left py-3 text-gray-700">Player</th>
                                        <th class="text-left py-3 text-gray-700">Points</th>
                                        <th class="text-left py-3 text-gray-700">Quizzes</th>
                                        <th class="text-left py-3 text-gray-700">Accuracy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                                    <span class="font-bold text-yellow-800">1</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://ui-avatars.com/api/?name=Alex+Johnson&background=667eea&color=fff" alt="User" class="h-10 w-10 rounded-full mr-3">
                                                <span class="font-medium">Alex Johnson</span>
                                            </div>
                                        </td>
                                        <td class="py-4 font-bold text-gray-800">2,450</td>
                                        <td class="py-4">32</td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <span class="mr-2">94%</span>
                                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: 94%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                                    <span class="font-bold text-gray-800">2</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://ui-avatars.com/api/?name=Maria+Garcia&background=764ba2&color=fff" alt="User" class="h-10 w-10 rounded-full mr-3">
                                                <span class="font-medium">Maria Garcia</span>
                                            </div>
                                        </td>
                                        <td class="py-4 font-bold text-gray-800">2,310</td>
                                        <td class="py-4">28</td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <span class="mr-2">91%</span>
                                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: 91%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                                    <span class="font-bold text-orange-800">3</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://ui-avatars.com/api/?name=David+Smith&background=f6ad55&color=fff" alt="User" class="h-10 w-10 rounded-full mr-3">
                                                <span class="font-medium">David Smith</span>
                                            </div>
                                        </td>
                                        <td class="py-4 font-bold text-gray-800">2,150</td>
                                        <td class="py-4">30</td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <span class="mr-2">89%</span>
                                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                    <span class="font-bold text-blue-800">8</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=4299e1&color=fff" alt="User" class="h-10 w-10 rounded-full mr-3">
                                                <span class="font-medium">John Doe</span>
                                                <span class="ml-2 text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">You</span>
                                            </div>
                                        </td>
                                        <td class="py-4 font-bold text-gray-800">1,850</td>
                                        <td class="py-4">24</td>
                                        <td class="py-4">
                                            <div class="flex items-center">
                                                <span class="mr-2">78%</span>
                                                <div class="w-20 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Dashboard -->
                <div id="adminDashboard" class="p-6 md:p-8 hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                        <!-- Admin Profile Card -->
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 p-6 rounded-xl border border-purple-100 card-hover">
                            <div class="flex items-center mb-6">
                                <div class="h-16 w-16 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 flex items-center justify-center text-white text-2xl mr-4">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Admin User</h3>
                                    <p class="text-gray-600">Platform Administrator</p>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-crown text-yellow-500 mr-1"></i>
                                        <span class="font-medium">Full Access</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Quizzes:</span>
                                    <span class="font-bold text-purple-700">48</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Questions:</span>
                                    <span class="font-bold text-purple-700">520</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Active Users:</span>
                                    <span class="font-bold text-purple-700">1,248</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm card-hover">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">Quick Actions</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <button class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-lg flex flex-col items-center justify-center hover:opacity-90 transition duration-300">
                                    <i class="fas fa-plus-circle text-2xl mb-2"></i>
                                    <span class="text-sm font-medium">Add Quiz</span>
                                </button>
                                <button class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white p-4 rounded-lg flex flex-col items-center justify-center hover:opacity-90 transition duration-300">
                                    <i class="fas fa-question-circle text-2xl mb-2"></i>
                                    <span class="text-sm font-medium">Add Questions</span>
                                </button>
                                <button class="bg-gradient-to-r from-purple-500 to-pink-600 text-white p-4 rounded-lg flex flex-col items-center justify-center hover:opacity-90 transition duration-300">
                                    <i class="fas fa-users text-2xl mb-2"></i>
                                    <span class="text-sm font-medium">Manage Users</span>
                                </button>
                                <button class="bg-gradient-to-r from-orange-500 to-red-600 text-white p-4 rounded-lg flex flex-col items-center justify-center hover:opacity-90 transition duration-300">
                                    <i class="fas fa-chart-bar text-2xl mb-2"></i>
                                    <span class="text-sm font-medium">View Reports</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- System Status -->
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm card-hover">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">System Status</h3>
                            <div class="space-y-5">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-700">Server Load</span>
                                        <span class="font-medium">42%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 42%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-700">Database</span>
                                        <span class="font-medium">68%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 68%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-700">Active Sessions</span>
                                        <span class="font-medium">247</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 p-3 bg-green-50 text-green-800 rounded-lg text-sm">
                                <i class="fas fa-check-circle mr-2"></i> All systems operational
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quiz Management Section -->
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Quiz Management</h3>
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-10">
                        <div class="px-6 py-4 border-b flex justify-between items-center">
                            <h4 class="text-lg font-bold text-gray-800">All Quizzes</h4>
                            <button class="gradient-bg text-white px-4 py-2 rounded-lg font-medium hover:opacity-90 transition duration-300">
                                <i class="fas fa-plus mr-2"></i> Create New Quiz
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">ID</th>
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">Quiz Title</th>
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">Category</th>
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">Difficulty</th>
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">Questions</th>
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">Status</th>
                                        <th class="text-left py-4 px-6 text-gray-700 font-medium">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">#001</td>
                                        <td class="py-4 px-6 font-medium">Biology Basics</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Science</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Easy</span>
                                        </td>
                                        <td class="py-4 px-6">10</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">#002</td>
                                        <td class="py-4 px-6 font-medium">World History</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">History</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Medium</span>
                                        </td>
                                        <td class="py-4 px-6">15</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">#003</td>
                                        <td class="py-4 px-6 font-medium">Advanced Calculus</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Mathematics</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Hard</span>
                                        </td>
                                        <td class="py-4 px-6">20</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-6">#004</td>
                                        <td class="py-4 px-6 font-medium">Literature Classics</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">Literature</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Medium</span>
                                        </td>
                                        <td class="py-4 px-6">12</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Draft</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-4 px-6">#005</td>
                                        <td class="py-4 px-6 font-medium">Computer Science 101</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs font-medium rounded-full">Technology</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Easy</span>
                                        </td>
                                        <td class="py-4 px-6">8</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-green-600 hover:text-green-800">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Create New Quiz Form -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Create New Quiz</h3>
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 mb-2">Quiz Title</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter quiz title">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Category</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                        <option value="">Select Category</option>
                                        <option value="science">Science</option>
                                        <option value="history">History</option>
                                        <option value="mathematics">Mathematics</option>
                                        <option value="literature">Literature</option>
                                        <option value="technology">Technology</option>
                                        <option value="arts">Arts</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Difficulty Level</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                        <option value="">Select Difficulty</option>
                                        <option value="easy">Easy</option>
                                        <option value="medium">Medium</option>
                                        <option value="hard">Hard</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Time Limit (minutes)</label>
                                    <input type="number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter time limit" min="1">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 mb-2">Description</label>
                                <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Enter quiz description"></textarea>
                            </div>
                            <div class="flex justify-end space-x-4">
                                <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                                    Cancel
                                </button>
                                <button type="submit" class="gradient-bg text-white px-6 py-3 rounded-lg font-medium hover:opacity-90 transition duration-300">
                                    <i class="fas fa-save mr-2"></i> Save Quiz
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-brain text-2xl text-purple-400"></i>
                        <h2 class="text-2xl font-bold">KnowledgeQuest</h2>
                    </div>
                    <p class="text-gray-400">Interactive, gamified learning platform</p>
                </div>
                
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 KnowledgeQuest. All rights reserved. | Built with Laravel & Tailwind CSS</p>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript for Tab Switching -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentTab = document.getElementById('studentTab');
            const adminTab = document.getElementById('adminTab');
            const studentDashboard = document.getElementById('studentDashboard');
            const adminDashboard = document.getElementById('adminDashboard');
            
            // Switch to Student Dashboard
            studentTab.addEventListener('click', function() {
                studentTab.classList.add('tab-active');
                adminTab.classList.remove('tab-active');
                studentDashboard.classList.remove('hidden');
                adminDashboard.classList.add('hidden');
            });
            
            // Switch to Admin Dashboard
            adminTab.addEventListener('click', function() {
                adminTab.classList.add('tab-active');
                studentTab.classList.remove('tab-active');
                adminDashboard.classList.remove('hidden');
                studentDashboard.classList.add('hidden');
            });
            
            // Add some interactive elements
            const quizCards = document.querySelectorAll('.card-hover');
            quizCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            setTimeout(() => {
                const progressBars = document.querySelectorAll('.progress-bar');
                progressBars.forEach(bar => {
                    bar.style.width = bar.getAttribute('data-width') || '0%';
                });
            }, 300);
        });
    </script>
</body>
</html>