<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>KnowledgeQuest - Register</title>
    <style>
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
    </style>
</head>
<body class="gradient-bg min-h-screen flex flex-col items-center justify-center p-4">
    <div class="container max-w-lg mx-auto">
        <header class="text-center mb-8">
            <div class="flex items-center justify-center space-x-3 mb-4">
                <div class="h-12 w-12 rounded-full bg-white flex items-center justify-center">
                    <i class="fas fa-brain text-2xl gradient-text"></i>
                </div>
                <h1 class="text-3xl font-bold text-white">KnowledgeQuest</h1>
            </div>
            <p class="text-white opacity-90">
                Create your account and start your learning journey
            </p>
        </header>

        <div class="bg-white rounded-2xl card-shadow p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create Account</h2>
            
            <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                            First Name
                        </label>
                        <input type="text" id="first_name" name="first_name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                               placeholder="Enter your first name"
                               value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Last Name
                        </label>
                        <input type="text" id="last_name" name="last_name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                               placeholder="Enter your last name"
                               value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                           placeholder="Enter your email address"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                           placeholder="Create a password" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                           placeholder="Confirm your password" required>
                </div>
                
                <!-- User Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        I want to join as:
                    </label>
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <input type="radio" id="student" name="user_type" value="student" class="hidden peer" checked>
                            <label for="student" 
                                   class="flex items-center justify-center p-3 border-2 border-gray-300 rounded-lg cursor-pointer peer-checked:border-purple-500 peer-checked:bg-purple-50">
                                <span class="font-medium">Student</span>
                            </label>
                        </div>
                        
                    </div>
                    @error('user_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" id="terms" name="terms" class="h-5 w-5 text-purple-600 mt-1" required>
                    <label for="terms" class="ml-2 text-sm text-gray-700">
                        I agree to the Terms of Service and Privacy Policy
                    </label>
                    @error('terms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" 
                        class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition duration-300">
                    Create Account
                </button>
                
                <div class="text-center pt-4">
                    <p class="text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:text-purple-800 ml-1">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
        
        <footer class="mt-8 text-center text-white opacity-80">
            <p>&copy; 2026 KnowledgeQuest. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>