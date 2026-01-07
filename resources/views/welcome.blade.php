<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KnowledgeQuest - Smart Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --secondary: #7c3aed;
            --accent: #10b981;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #f0f9ff 0%, #fdf4ff 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid #e2e8f0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 12px 32px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
            padding: 12px 32px;
            border-radius: 10px;
            font-weight: 600;
            border: 2px solid var(--primary);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }

        .nav-link {
            position: relative;
            padding: 8px 0;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 1s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out forwards;
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">KnowledgeQuest</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="nav-link text-gray-600 hover:text-gray-900 font-medium">Features</a>
                    <a href="#how-it-works" class="nav-link text-gray-600 hover:text-gray-900 font-medium">How It Works</a>
                    <a href="#leaderboard" class="nav-link text-gray-600 hover:text-gray-900 font-medium">Leaderboard</a>
                    <a href="#testimonials" class="nav-link text-gray-600 hover:text-gray-900 font-medium">Testimonials</a>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Sign In</a>
                        <a href="/register" class="btn-primary">Get Started</a>
                    </div>
                </div>
                
                <button class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg py-20 md:py-32">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-1/2 mb-12 lg:mb-0 animate-slide-up">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 font-medium mb-6">
                        <i class="fas fa-rocket mr-2"></i>
                        Gamified Learning Platform
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Learn Smarter,
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                            Play Harder
                        </span>
                    </h1>
                    
                    <p class="text-xl text-gray-600 mb-8">
                        Master new skills through interactive quizzes, earn rewards, and compete with friends. 
                        Make learning an adventure you'll love.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="/register" class="btn-primary text-center">
                            Start Free Trial
                            <i class="ml-2 fas fa-arrow-right"></i>
                        </a>
                        <a href="#features" class="btn-secondary text-center">
                            <i class="fas fa-play-circle mr-2"></i>
                            Watch Demo
                        </a>
                    </div>
                    
                    <div class="flex items-center mt-12 space-x-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">50K+</div>
                            <div class="text-gray-600">Active Learners</div>
                        </div>
                        <div class="h-8 w-px bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">500+</div>
                            <div class="text-gray-600">Quizzes</div>
                        </div>
                        <div class="h-8 w-px bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">4.8</div>
                            <div class="text-gray-600">Rating</div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 lg:pl-12 animate-fade-in">
                    <div class="bg-white rounded-2xl shadow-xl p-8 card-hover">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Your Progress</h3>
                                <p class="text-gray-600">Current Level: Advanced</p>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center">
                                <i class="fas fa-trophy text-white"></i>
                            </div>
                        </div>
                        
                        <div class="relative w-48 h-48 mx-auto mb-8">
                            <svg class="progress-ring w-48 h-48" width="180" height="180">
                                <circle class="stroke-gray-200" stroke-width="8" fill="transparent" r="80" cx="90" cy="90"/>
                                <circle class="progress-ring-circle stroke-blue-500" stroke-width="8" fill="transparent" r="80" cx="90" cy="90" stroke-dashoffset="283" style="stroke-dashoffset: 85;"></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <div class="text-3xl font-bold text-gray-900">85%</div>
                                <div class="text-gray-600">Mastery Score</div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-700">Learning Streak</span>
                                    <span class="font-medium text-gray-900">14 days</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-green-400 to-blue-500 h-2 rounded-full w-3/4"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-700">Quizzes Completed</span>
                                    <span class="font-medium text-gray-900">42/50</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-purple-400 to-pink-500 h-2 rounded-full w-4/5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 font-medium mb-4">
                    <i class="fas fa-star mr-2"></i>
                    Why Choose KnowledgeQuest
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Smart Learning Features</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Everything you need to make learning engaging, effective, and fun
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-8 shadow-lg card-hover">
                    <div class="feature-icon bg-blue-50 text-blue-600">
                        <i class="fas fa-gamepad text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Interactive Quizzes</h3>
                    <p class="text-gray-600 mb-4">
                        Engaging quizzes with instant feedback, timers, and competitive elements to keep you motivated.
                    </p>
                    <a href="#" class="text-blue-600 font-medium inline-flex items-center">
                        Learn more <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <div class="bg-white rounded-xl p-8 shadow-lg card-hover">
                    <div class="feature-icon bg-purple-50 text-purple-600">
                        <i class="fas fa-trophy text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Rewards System</h3>
                    <p class="text-gray-600 mb-4">
                        Earn badges, level up, and unlock achievements as you progress through learning paths.
                    </p>
                    <div class="flex space-x-2 mt-4">
                        <div class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">Fast Learner</div>
                        <div class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">Quiz Master</div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl p-8 shadow-lg card-hover">
                    <div class="feature-icon bg-green-50 text-green-600">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Progress Tracking</h3>
                    <p class="text-gray-600 mb-4">
                        Detailed analytics and visual progress reports to help you stay on track with your goals.
                    </p>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Current Progress</span>
                            <span class="font-medium">75%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full w-3/4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-purple-50 text-purple-700 font-medium mb-4">
                    <i class="fas fa-play-circle mr-2"></i>
                    Simple Process
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">How KnowledgeQuest Works</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Start your learning journey in four simple steps
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Sign Up Free</h3>
                    <p class="text-gray-600">
                        Create your account and set up your learning preferences
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Choose Topics</h3>
                    <p class="text-gray-600">
                        Select from 50+ categories and personalized learning paths
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Take Quizzes</h3>
                    <p class="text-gray-600">
                        Complete interactive quizzes and earn points
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Earn Rewards</h3>
                    <p class="text-gray-600">
                        Level up, collect badges, and track your progress
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="/register" class="btn-primary inline-flex items-center px-8 py-4">
                    <i class="fas fa-play mr-3"></i>
                    Start Learning Now
                </a>
            </div>
        </div>
    </section>

    <!-- Leaderboard -->
    <section id="leaderboard" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 font-medium mb-4">
                    <i class="fas fa-crown mr-2"></i>
                    Top Performers
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Global Leaderboard</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Compete with learners worldwide and climb to the top
                </p>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900">Top Players This Week</h3>
                            <select class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2">
                                <option>Weekly</option>
                                <option>Monthly</option>
                                <option>All Time</option>
                            </select>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center text-white font-bold mr-4">
                                    1
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900">Alex Johnson</h4>
                                    <div class="flex items-center mt-1">
                                        <div class="w-full bg-gray-100 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-2 rounded-full w-11/12"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-900">15,240 XP</div>
                                    <div class="text-sm text-gray-600">Level 42</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 hover:bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-bold mr-4">
                                    2
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900">Sarah Miller</h4>
                                    <div class="flex items-center mt-1">
                                        <div class="w-full bg-gray-100 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-gray-400 to-gray-500 h-2 rounded-full w-10/12"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-900">14,850 XP</div>
                                    <div class="text-sm text-gray-600">Level 41</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 hover:bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-bold mr-4">
                                    3
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900">Michael Chen</h4>
                                    <div class="flex items-center mt-1">
                                        <div class="w-full bg-gray-100 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-amber-400 to-amber-500 h-2 rounded-full w-9/12"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-gray-900">13,920 XP</div>
                                    <div class="text-sm text-gray-600">Level 40</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-8">
                            <a href="/register" class="text-blue-600 font-medium hover:text-blue-700 inline-flex items-center">
                                Join the leaderboard
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Your Statistics</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Your Current Rank</span>
                                <span class="font-bold text-gray-900">#128</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full w-1/4"></div>
                            </div>
                            <div class="text-right text-sm text-gray-500 mt-1">Top 25%</div>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-gray-900 mb-4">Weekly Progress</h4>
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Quizzes Completed</span>
                                        <span class="font-medium">24/30</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full w-4/5"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600">Correct Answers</span>
                                        <span class="font-medium">85%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full w-85"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-bold text-gray-900 mb-4">Recent Badges</h4>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="aspect-square rounded-lg bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-bolt text-blue-500 text-xl"></i>
                                </div>
                                <div class="aspect-square rounded-lg bg-purple-50 flex items-center justify-center">
                                    <i class="fas fa-brain text-purple-500 text-xl"></i>
                                </div>
                                <div class="aspect-square rounded-lg bg-green-50 flex items-center justify-center">
                                    <i class="fas fa-rocket text-green-500 text-xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <a href="/register" class="btn-primary w-full text-center mt-6">
                            View Full Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">
                Start Learning for Free Today
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Join thousands of learners who are already mastering new skills with KnowledgeQuest.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="/register" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition-colors">
                    <i class="fas fa-rocket mr-3"></i>
                    Start Free Trial
                </a>
                <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-colors">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Book a Demo
                </a>
            </div>
            
            <p class="text-blue-100 mt-8">
                <i class="fas fa-shield-alt mr-2"></i>
                30-day free trial • No credit card required
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="text-2xl font-bold">KnowledgeQuest</span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Making learning engaging and effective through gamification.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gray-700">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gray-700">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gray-700">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6">Platform</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">How It Works</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Leaderboard</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6">Resources</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Community</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">API Docs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; 2024 KnowledgeQuest. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple scroll animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-slide-up');
                    }
                });
            }, { threshold: 0.1 });
            
            // Observe elements for animation
            document.querySelectorAll('.card-hover').forEach(el => {
                observer.observe(el);
            });
            
            // Progress ring animation
            const progressCircles = document.querySelectorAll('.progress-ring-circle');
            progressCircles.forEach(circle => {
                const offset = circle.getAttribute('stroke-dashoffset');
                circle.style.strokeDashoffset = offset;
            });
            
            document.querySelector('button.md\\:hidden').addEventListener('click', function() {
                alert('Mobile menu would open here. In a real implementation, this would toggle a menu.');
            });
        });
    </script>
</body>
</html>