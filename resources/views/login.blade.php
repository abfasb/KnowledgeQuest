<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>KnowledgeQuest - Login</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .card-shadow {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex flex-col items-center justify-center p-4">
    <!-- Main Container -->
    <div class="container max-w-6xl mx-auto">
        <!-- Header -->
        <header class="text-center mb-12">
            <a href="#" class="inline-flex items-center space-x-3 mb-4">
                <div class="h-14 w-14 rounded-full bg-white flex items-center justify-center">
                    <i class="fas fa-brain text-3xl gradient-text"></i>
                </div>
                <h1 class="text-4xl font-bold text-white">KnowledgeQuest</h1>
            </a>
            <p class="text-white text-lg opacity-90 max-w-2xl mx-auto">
                Welcome back! Sign in to continue your learning journey, track your progress, and unlock new achievements.
            </p>
        </header>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-8">
            <!-- Login Form Card -->
            <div class="bg-white rounded-2xl card-shadow overflow-hidden w-full max-w-md">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Sign In to Your Account</h2>
                        <p class="text-gray-600">Enter your credentials to access your dashboard</p>
                    </div>
                    
                    <form id="loginForm" class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="b lock text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-purple-600"></i>Email Address
                            </label>
                            <div class="relative">
                                <input type="email" id="email" name="email" 
                                       class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                       placeholder="Enter your email    " required>
                                <div class="absolute left-4 top-3.5 text-gray-400">
                                    <i class="far fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password Field -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-lock mr-2 text-purple-600"></i>Password
                                </label>
                                <a href="#" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="relative">
                                <input type="password" id="password" name="password" 
                                       class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                       placeholder="Enter your password" required>
                                <div class="absolute left-4 top-3.5 text-gray-400">
                                    <i class="fas fa-key"></i>
                                </div>
                                <button type="button" id="togglePassword" class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Remember me for 30 days
                            </label>
                        </div>
                        
                        <!-- Login Button -->
                        <button type="submit" 
                                class="w-full gradient-bg text-white py-3.5 rounded-xl font-semibold text-lg hover:opacity-90 transition duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                        </button>
                        
                        <!-- Divider -->
                        <div class="relative flex items-center justify-center my-6">
                            <div class="flex-grow border-t border-gray-300"></div>
                            <span class="mx-4 text-gray-500 text-sm">Or continue with</span>
                            <div class="flex-grow border-t border-gray-300"></div>
                        </div>
                        
                        <!-- Social Login Buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" 
                                    class="flex items-center justify-center py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition duration-300">
                                <i class="fab fa-google text-red-500 mr-2"></i>
                                <span>Google</span>
                            </button>
                            <button type="button" 
                                    class="flex items-center justify-center py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition duration-300">
                                <i class="fab fa-github text-gray-800 mr-2"></i>
                                <span>GitHub</span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Switch to Register -->
                    <div class="mt-8 text-center">
                        <p class="text-gray-600">
                            Don't have an account? 
                            <a href="register.html" class="text-purple-600 font-semibold hover:text-purple-800 ml-1">
                                Create one now
                            </a>
                        </p>
                    </div>
                    
                    <!-- Role Selection -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-center text-gray-600 mb-4">Sign in as:</p>
                        <div class="flex space-x-4">
                            <button id="studentLogin" 
                                    class="flex-1 py-3 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl text-blue-700 font-medium hover:from-blue-100 hover:to-blue-200 transition duration-300">
                                <i class="fas fa-user-graduate mr-2"></i>Student
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>
        
        <!-- Demo Credentials -->
        <div class="mt-12 max-w-2xl mx-auto bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-6 text-white">
            <h4 class="font-bold text-lg mb-4 text-center"><i class="fas fa-info-circle mr-2"></i>Demo Credentials</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-white bg-opacity-15 rounded-lg">
                    <h5 class="font-semibold mb-2 flex items-center">
                        <i class="fas fa-user-graduate mr-2"></i>Student Account
                    </h5>
                    <p class="text-sm opacity-90 mb-1">Email: <code class="bg-white bg-opacity-20 px-2 py-1 rounded">student@knowledgequest.com</code></p>
                    <p class="text-sm opacity-90">Password: <code class="bg-white bg-opacity-20 px-2 py-1 rounded">password123</code></p>
                </div>
                <div class="p-4 bg-white bg-opacity-15 rounded-lg">
                    <h5 class="font-semibold mb-2 flex items-center">
                        <i class="fas fa-user-shield mr-2"></i>Admin Account
                    </h5>
                    <p class="text-sm opacity-90 mb-1">Email: <code class="bg-white bg-opacity-20 px-2 py-1 rounded">admin@knowledgequest.com</code></p>
                    <p class="text-sm opacity-90">Password: <code class="bg-white bg-opacity-20 px-2 py-1 rounded">admin123</code></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="mt-12 text-center text-white opacity-80 pb-8">
        <p class="mb-4">&copy; 2023 KnowledgeQuest. All rights reserved.</p>
        <div class="flex justify-center space-x-6">
            <a href="#" class="hover:opacity-100 opacity-80 transition duration-300">Privacy Policy</a>
            <a href="#" class="hover:opacity-100 opacity-80 transition duration-300">Terms of Service</a>
            <a href="#" class="hover:opacity-100 opacity-80 transition duration-300">Contact Us</a>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
            });

            const floatingIcons = document.querySelectorAll('.floating');
            floatingIcons.forEach((icon, index) => {
                icon.style.animationDelay = `${index * 0.5}s`;
            });
        });
    </script>
</body>
</html>