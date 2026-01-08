<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>KnowledgeQuest - Register</title>
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
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .progress-bar {
            height: 6px;
            transition: width 0.5s ease;
        }
        
        .strength-weak { background: linear-gradient(to right, #f87171, #ef4444); }
        .strength-fair { background: linear-gradient(to right, #fbbf24, #f59e0b); }
        .strength-good { background: linear-gradient(to right, #60a5fa, #3b82f6); }
        .strength-strong { background: linear-gradient(to right, #10b981, #059669); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex flex-col items-center justify-center p-4">
    <!-- Main Container -->
    <div class="container max-w-6xl mx-auto">
        <!-- Header -->
        <header class="text-center mb-10">
            <a href="login.html" class="inline-flex items-center space-x-3 mb-4">
                <div class="h-14 w-14 rounded-full bg-white flex items-center justify-center">
                    <i class="fas fa-brain text-3xl gradient-text"></i>
                </div>
                <h1 class="text-4xl font-bold text-white">KnowledgeQuest</h1>
            </a>
            <p class="text-white text-lg opacity-90 max-w-2xl mx-auto">
                Join our community of learners and start your journey towards mastering new skills and competing with peers.
            </p>
        </header>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-8">
            <!-- Left Side - Registration Form -->
            <div class="w-full max-w-2xl">
                <div class="bg-white rounded-2xl card-shadow overflow-hidden">
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Your Account</h2>
                            <p class="text-gray-600">Join thousands of learners already on KnowledgeQuest</p>
                            
                            <!-- Progress Steps -->
                            <div class="flex items-center justify-center mt-6 mb-2">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold">
                                        1
                                    </div>
                                    <div class="h-1 w-20 bg-purple-600"></div>
                                    <div class="h-10 w-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold">
                                        2
                                    </div>
                                    <div class="h-1 w-20 bg-gray-300"></div>
                                    <div class="h-10 w-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold">
                                        3
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-purple-600 font-medium">Step 1 of 3: Basic Information</p>
                        </div>
                        
                        <form id="registerForm" class="space-y-6">
                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user mr-2 text-purple-600"></i>First Name
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="firstName" name="firstName" 
                                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                               placeholder="John" required>
                                        <div class="absolute left-4 top-3.5 text-gray-400">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user mr-2 text-purple-600"></i>Last Name
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="lastName" name="lastName" 
                                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                               placeholder="Doe" required>
                                        <div class="absolute left-4 top-3.5 text-gray-400">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-purple-600"></i>Email Address
                                </label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" 
                                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                           placeholder="you@example.com" required>
                                    <div class="absolute left-4 top-3.5 text-gray-400">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">We'll never share your email with anyone else.</p>
                            </div>
                            
                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-purple-600"></i>Password
                                </label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" 
                                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                           placeholder="Create a strong password" required>
                                    <div class="absolute left-4 top-3.5 text-gray-400">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <button type="button" id="togglePassword" class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                
                                <!-- Password Strength Meter -->
                                <div class="mt-3">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Password strength</span>
                                        <span id="strengthText" class="text-sm font-medium">Weak</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div id="strengthBar" class="progress-bar rounded-full strength-weak" style="width: 25%"></div>
                                    </div>
                                    <div class="mt-2 grid grid-cols-2 gap-2">
                                        <div class="flex items-center">
                                            <i id="lengthCheck" class="far fa-times-circle text-red-500 mr-2"></i>
                                            <span class="text-xs text-gray-600">At least 8 characters</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i id="numberCheck" class="far fa-times-circle text-red-500 mr-2"></i>
                                            <span class="text-xs text-gray-600">Contains a number</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i id="upperCheck" class="far fa-times-circle text-red-500 mr-2"></i>
                                            <span class="text-xs text-gray-600">Uppercase letter</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i id="specialCheck" class="far fa-times-circle text-red-500 mr-2"></i>
                                            <span class="text-xs text-gray-600">Special character</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Confirm Password Field -->
                            <div>
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-purple-600"></i>Confirm Password
                                </label>
                                <div class="relative">
                                    <input type="password" id="confirmPassword" name="confirmPassword" 
                                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                                           placeholder="Confirm your password" required>
                                    <div class="absolute left-4 top-3.5 text-gray-400">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <div id="passwordMatch" class="absolute right-4 top-3.5 hidden">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- User Type Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    <i class="fas fa-user-tag mr-2 text-purple-600"></i>I want to join as:
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="relative">
                                        <input type="radio" id="student" name="userType" value="student" class="hidden peer" checked>
                                        <label for="student" 
                                               class="flex flex-col items-center p-5 border-2 border-gray-300 rounded-xl cursor-pointer peer-checked:border-purple-500 peer-checked:bg-purple-50 transition duration-300">
                                            <div class="h-16 w-16 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center mb-3">
                                                <i class="fas fa-user-graduate text-2xl text-white"></i>
                                            </div>
                                            <h4 class="font-bold text-gray-800">Student</h4>
                                            <p class="text-sm text-gray-600 text-center mt-1">Take quizzes, earn badges, compete on leaderboards</p>
                                        </label>
                                    </div>
                                    
                                    <div class="relative">
                                        <input type="radio" id="admin" name="userType" value="admin" class="hidden peer">
                                        <label for="admin" 
                                               class="flex flex-col items-center p-5 border-2 border-gray-300 rounded-xl cursor-pointer peer-checked:border-purple-500 peer-checked:bg-purple-50 transition duration-300">
                                            <div class="h-16 w-16 rounded-full bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center mb-3">
                                                <i class="fas fa-user-shield text-2xl text-white"></i>
                                            </div>
                                            <h4 class="font-bold text-gray-800">Admin</h4>
                                            <p class="text-sm text-gray-600 text-center mt-1">Create quizzes, manage content, and oversee platform</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Terms and Conditions -->
                            <div class="flex items-start">
                                <input type="checkbox" id="terms" name="terms" class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded mt-1">
                                <label for="terms" class="ml-3 block text-sm text-gray-700">
                                    I agree to the 
                                    <a href="#" class="text-purple-600 font-medium hover:text-purple-800">Terms of Service</a> 
                                    and 
                                    <a href="#" class="text-purple-600 font-medium hover:text-purple-800">Privacy Policy</a>.
                                    I understand that KnowledgeQuest will process my information in accordance with these documents.
                                </label>
                            </div>
                            
                            <!-- Register Button -->
                            <button type="submit" 
                                    class="w-full gradient-bg text-white py-3.5 rounded-xl font-semibold text-lg hover:opacity-90 transition duration-300 transform hover:-translate-y-0.5">
                                <i class="fas fa-user-plus mr-2"></i>Create Account
                            </button>
                            
                            <!-- Already have account -->
                            <div class="mt-6 text-center">
                                <p class="text-gray-600">
                                    Already have an account? 
                                    <a href="login.html" class="text-purple-600 font-semibold hover:text-purple-800 ml-1">
                                        Sign in here
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Benefits/Info -->
            <div class="w-full max-w-md">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">Benefits of Joining</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="h-12 w-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-medal text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Earn Achievements</h4>
                                <p class="opacity-90">Unlock badges and trophies as you complete quizzes and reach milestones.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="h-12 w-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-pie text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Detailed Analytics</h4>
                                <p class="opacity-90">Track your progress with comprehensive statistics and performance insights.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="h-12 w-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-gamepad text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Gamified Experience</h4>
                                <p class="opacity-90">Learning feels like play with points, levels, and friendly competition.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="h-12 w-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-graduation-cap text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Learn at Your Pace</h4>
                                <p class="opacity-90">Choose from multiple difficulty levels and take quizzes anytime, anywhere.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonials -->
                    <div class="mt-10">
                        <h4 class="font-bold text-lg mb-4">What Our Users Say</h4>
                        <div class="space-y-4">
                            <div class="bg-white bg-opacity-10 p-4 rounded-xl">
                                <p class="italic mb-3">"KnowledgeQuest made learning fun again! I've improved my general knowledge significantly."</p>
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Chen&background=667eea&color=fff" class="h-8 w-8 rounded-full mr-2">
                                    <span class="font-medium">Sarah Chen</span>
                                    <div class="ml-auto text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white bg-opacity-10 p-4 rounded-xl">
                                <p class="italic mb-3">"As an educator, I use KnowledgeQuest to create quizzes for my students. The admin tools are excellent!"</p>
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name=Dr+James+Wilson&background=764ba2&color=fff" class="h-8 w-8 rounded-full mr-2">
                                    <span class="font-medium">Dr. James Wilson</span>
                                    <div class="ml-auto text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
            });
            
            // Password strength checker
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            const lengthCheck = document.getElementById('lengthCheck');
            const numberCheck = document.getElementById('numberCheck');
            const upperCheck = document.getElementById('upperCheck');
            const specialCheck = document.getElementById('specialCheck');
            const passwordMatch = document.getElementById('passwordMatch');
            
            function checkPasswordStrength(password) {
                let strength = 0;
                
                // Length check
                if (password.length >= 8) {
                    strength += 25;
                    lengthCheck.className = 'fas fa-check-circle text-green-500 mr-2';
                } else {
                    lengthCheck.className = 'far fa-times-circle text-red-500 mr-2';
                }
                
                // Number check
                if (/\d/.test(password)) {
                    strength += 25;
                    numberCheck.className = 'fas fa-check-circle text-green-500 mr-2';
                } else {
                    numberCheck.className = 'far fa-times-circle text-red-500 mr-2';
                }
                
                // Uppercase check
                if (/[A-Z]/.test(password)) {
                    strength += 25;
                    upperCheck.className = 'fas fa-check-circle text-green-500 mr-2';
                } else {
                    upperCheck.className = 'far fa-times-circle text-red-500 mr-2';
                }
                
                // Special character check
                if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                    strength += 25;
                    specialCheck.className = 'fas fa-check-circle text-green-500 mr-2';
                } else {
                    specialCheck.className = 'far fa-times-circle text-red-500 mr-2';
                }
                
                // Update strength bar
                strengthBar.style.width = `${strength}%`;
                
                // Update strength text and color
                if (strength <= 25) {
                    strengthBar.className = 'progress-bar rounded-full strength-weak';
                    strengthText.textContent = 'Weak';
                    strengthText.className = 'text-sm font-medium text-red-600';
                } else if (strength <= 50) {
                    strengthBar.className = 'progress-bar rounded-full strength-fair';
                    strengthText.textContent = 'Fair';
                    strengthText.className = 'text-sm font-medium text-yellow-600';
                } else if (strength <= 75) {
                    strengthBar.className = 'progress-bar rounded-full strength-good';
                    strengthText.textContent = 'Good';
                    strengthText.className = 'text-sm font-medium text-blue-600';
                } else {
                    strengthBar.className = 'progress-bar rounded-full strength-strong';
                    strengthText.textContent = 'Strong';
                    strengthText.className = 'text-sm font-medium text-green-600';
                }
            }
            
            function checkPasswordMatch() {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;
                
                if (confirmPassword === '') {
                    passwordMatch.classList.add('hidden');
                    confirmPasswordField.classList.remove('border-green-500', 'border-red-500');
                    return;
                }
                
                if (password === confirmPassword && password !== '') {
                    passwordMatch.classList.remove('hidden');
                    passwordMatch.innerHTML = '<i class="fas fa-check-circle text-green-500"></i>';
                    confirmPasswordField.classList.add('border-green-500');
                    confirmPasswordField.classList.remove('border-red-500');
                } else {
                    passwordMatch.classList.remove('hidden');
                    passwordMatch.innerHTML = '<i class="fas fa-times-circle text-red-500"></i>';
                    confirmPasswordField.classList.add('border-red-500');
                    confirmPasswordField.classList.remove('border-green-500');
                }
            }
            
            passwordField.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
            });
            
            confirmPasswordField.addEventListener('input', checkPasswordMatch);
            
            // Form submission
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const userType = document.querySelector('input[name="userType"]:checked').value;
                const terms = document.getElementById('terms').checked;
                
                // Validation
                if (!firstName || !lastName || !email || !password || !confirmPassword) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                if (password !== confirmPassword) {
                    alert('Passwords do not match');
                    return;
                }
                
                if (!terms) {
                    alert('You must agree to the terms and conditions');
                    return;
                }
                
                // Check password strength
                checkPasswordStrength(password);
                if (strengthText.textContent === 'Weak') {
                    if (!confirm('Your password is weak. Are you sure you want to continue?')) {
                        return;
                    }
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    alert(`Registration successful! Welcome to KnowledgeQuest, ${firstName}!\n\nAccount Type: ${userType}\nEmail: ${email}\n\nYou will now be redirected to the login page.`);
                    
                    // In a real app, you would submit the form or redirect
                    // For demo purposes, redirect to login page
                    window.location.href = 'login.html';
                    
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 2000);
            });
            
            // Auto-fill demo data for testing
            document.querySelector('input[value="student"]').addEventListener('click', function() {
                // Pre-fill student demo data
                if (document.getElementById('firstName').value === '') {
                    document.getElementById('firstName').value = 'John';
                    document.getElementById('lastName').value = 'Student';
                    document.getElementById('email').value = 'student@knowledgequest.com';
                    document.getElementById('password').value = 'Password123!';
                    document.getElementById('confirmPassword').value = 'Password123!';
                    document.getElementById('terms').checked = true;
                    
                    // Trigger password strength check
                    checkPasswordStrength('Password123!');
                    checkPasswordMatch();
                }
            });
            
            document.querySelector('input[value="admin"]').addEventListener('click', function() {
                // Pre-fill admin demo data
                if (document.getElementById('firstName').value === '') {
                    document.getElementById('firstName').value = 'Admin';
                    document.getElementById('lastName').value = 'User';
                    document.getElementById('email').value = 'admin@knowledgequest.com';
                    document.getElementById('password').value = 'AdminPass123!';
                    document.getElementById('confirmPassword').value = 'AdminPass123!';
                    document.getElementById('terms').checked = true;
                    
                    // Trigger password strength check
                    checkPasswordStrength('AdminPass123!');
                    checkPasswordMatch();
                }
            });
        });
    </script>
</body>
</html>