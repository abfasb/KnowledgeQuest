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

<!-- ============================================
     MAIN CONTAINER
================================================ -->
<div class="flex min-h-screen">

<!-- ============================================
     SIDEBAR NAVIGATION (4 Items Only)
================================================ -->
<aside class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-xl hidden md:flex flex-col">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold flex items-center">
            <i class="fas fa-shield-alt mr-3 text-purple-400"></i>
            QuizMaster Admin
        </h1>
        <p class="text-gray-400 text-sm mt-1">Administration Portal</p>
    </div>

    <!-- User Profile -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-xl font-bold">
                JD
            </div>
            <div class="ml-4">
                <h3 class="font-semibold">John Doe</h3>
                <p class="text-sm text-gray-400">Administrator</p>
                <p class="text-xs text-gray-500 mt-1">admin@example.com</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu (4 Items Only) -->
    <nav class="flex-1 p-4">
        <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-4 ml-3">Main Menu</p>
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center p-3 rounded-lg bg-gray-700 text-white">
                    <i class="fas fa-tachometer-alt mr-3 text-purple-400"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-users mr-3"></i>
                    User Management
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
                    Analytics
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="p-6 border-t border-gray-700 text-center">
        <p class="text-gray-400 text-sm">Status: <span class="text-green-500 font-semibold">Online</span></p>
    </div>
</aside>

<!-- ============================================
     MAIN CONTENT AREA
================================================ -->
<div class="flex-1 flex flex-col">

<!-- ============================================
     TOP HEADER
================================================ -->
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
                        <span class="ml-1 text-sm font-medium text-purple-600 md:ml-2">Dashboard</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Right Side Icons -->
    <div class="flex items-center space-x-6">
        <!-- Notifications -->
        <div class="relative">
            <button class="text-gray-700 hover:text-purple-600 transition duration-200">
                <i class="fas fa-bell text-xl"></i>
            </button>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
        </div>

        <!-- User Dropdown -->
        <div class="relative">
            <button id="userDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-indigo-700 rounded-full flex items-center justify-center text-white font-bold">
                    J
                </div>
                <i class="fas fa-chevron-down text-gray-600"></i>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="userDropdown" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 hidden z-10">
                <div class="p-4 border-b">
                    <p class="font-semibold text-gray-800">John Doe</p>
                    <p class="text-sm text-gray-500">admin@example.com</p>
                </div>
                <div class="p-2">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                        <i class="fas fa-user mr-3"></i>Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">
                        <i class="fas fa-cog mr-3"></i>Settings
                    </a>
                    <div class="border-t my-2"></div>
                    <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50 rounded">
                        <i class="fas fa-sign-out-alt mr-3"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- ============================================
     MOBILE SIDEBAR
================================================ -->
<div id="mobileSidebar" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 hidden md:hidden">
    <div class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white h-full animate__animated animate__slideInLeft">
        <div class="p-4 flex justify-between items-center border-b border-gray-700">
            <h2 class="text-xl font-bold">Admin Menu</h2>
            <button id="closeMobileMenu" class="text-2xl">&times;</button>
        </div>
        <div class="p-4">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                    JD
                </div>
                <div class="ml-3">
                    <h3 class="font-semibold">John Doe</h3>
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

<!-- ============================================
     MAIN CONTENT
================================================ -->
<main class="flex-1 p-6 overflow-y-auto">

<!-- Welcome Section -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Welcome, <span class="text-purple-600">John</span></h1>
    <p class="text-gray-600 mt-2">Administrator Dashboard Overview</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Total Users</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">1,248</h3>
                <p class="text-green-600 text-sm mt-2">Active users</p>
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
                <h3 class="text-3xl font-bold text-gray-800 mt-2">87</h3>
                <p class="text-green-600 text-sm mt-2">5 new this week</p>
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
                <p class="text-gray-500 text-sm">Today's Attempts</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">342</h3>
                <p class="text-green-600 text-sm mt-2">24% increase</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">System Status</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">100%</h3>
                <p class="text-green-600 text-sm mt-2">All systems OK</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-heartbeat text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- User Growth Chart -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">User Growth</h2>
        <div class="h-72">
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Recent Activities</h2>
        <div class="space-y-4">
            <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                    <i class="fas fa-user-plus text-green-600"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800">New user registered</h4>
                    <p class="text-gray-500 text-sm">Sarah Davis registered</p>
                </div>
                <span class="text-gray-500 text-sm">10 min ago</span>
            </div>

            <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                    <i class="fas fa-question-circle text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800">New quiz created</h4>
                    <p class="text-gray-500 text-sm">Advanced Physics Quiz added</p>
                </div>
                <span class="text-gray-500 text-sm">1 hour ago</span>
            </div>

            <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                    <i class="fas fa-medal text-yellow-600"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800">Badge awarded</h4>
                    <p class="text-gray-500 text-sm">Quiz Master badge awarded</p>
                </div>
                <span class="text-gray-500 text-sm">5 hours ago</span>
            </div>
        </div>
    </div>
</div>

<!-- User Management Section -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Recent Users</h2>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold mr-3">MJ</div>
                            <div>
                                <div class="font-medium text-gray-900">Michael Johnson</div>
                                <div class="text-gray-500 text-sm">michael.j@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Student</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                    </td>
                </tr>
                
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-800 font-bold mr-3">SD</div>
                            <div>
                                <div class="font-medium text-gray-900">Sarah Davis</div>
                                <div class="text-gray-500 text-sm">sarahdavis@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Student</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</main>
</div>
</div>

<!-- ============================================
     JAVASCRIPT
================================================ -->
<script>
document.getElementById('mobileMenuBtn').addEventListener('click', function() {
    document.getElementById('mobileSidebar').classList.remove('hidden');
});

document.getElementById('closeMobileMenu').addEventListener('click', function() {
    document.getElementById('mobileSidebar').classList.add('hidden');
});

document.getElementById('userDropdownBtn').addEventListener('click', function() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('hidden');
});

document.addEventListener('click', function(event) {
    const userDropdown = document.getElementById('userDropdown');
    const userDropdownBtn = document.getElementById('userDropdownBtn');
    
    if (!userDropdownBtn.contains(event.target) && !userDropdown.contains(event.target)) {
        userDropdown.classList.add('hidden');
    }
});

// Initialize chart
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'New Users',
                data: [65, 78, 66, 84, 105, 120],
                borderColor: 'rgb(147, 51, 234)',
                backgroundColor: 'rgba(147, 51, 234, 0.1)',
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
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
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
});
</script>

</body>
</html> 