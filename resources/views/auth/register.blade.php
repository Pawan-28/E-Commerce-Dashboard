<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 dark:from-gray-900 dark:via-green-900 dark:to-teal-900 flex items-center justify-center p-4 relative overflow-hidden">
        
        <!-- AI-Generated E-commerce Background -->
        <div class="absolute inset-0 opacity-15 dark:opacity-10">
            <!-- Shopping Cart Pattern -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-20 left-20 w-16 h-16 bg-green-400/20 rounded-full blur-2xl"></div>
                <div class="absolute top-40 right-32 w-12 h-12 bg-teal-400/20 rounded-full blur-2xl"></div>
                <div class="absolute bottom-32 left-40 w-20 h-20 bg-emerald-400/20 rounded-full blur-2xl"></div>
                <div class="absolute bottom-20 right-20 w-14 h-14 bg-green-400/20 rounded-full blur-2xl"></div>
            </div>
            
            <!-- Product Grid Pattern -->
            <div class="absolute inset-0 grid grid-cols-6 gap-8 opacity-5">
                @for ($i = 0; $i < 24; $i++)
                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-teal-500 rounded-lg transform rotate-45"></div>
                @endfor
            </div>
            
            <!-- Floating Icons -->
            <div class="absolute top-16 left-16 animate-float">
                <svg class="w-6 h-6 text-green-400/30" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <div class="absolute top-32 right-24 animate-float-delayed">
                <svg class="w-5 h-5 text-teal-400/30" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <div class="absolute bottom-24 left-32 animate-float-slow">
                <svg class="w-4 h-4 text-emerald-400/30" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>

        <div class="max-w-sm w-full relative z-10">
            
            <!-- Compact Logo & Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl mb-4 shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Create Account</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Join our Dashboard</p>
            </div>

            <!-- Compact Register Form -->
            <div class="bg-white/90 dark:bg-gray-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/30 dark:border-gray-700/60 p-6">
                
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Full Name
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                class="w-full pl-9 pr-3 py-2.5 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-sm"
                                placeholder="Enter full name">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                class="w-full pl-9 pr-3 py-2.5 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-sm"
                                placeholder="Enter email">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full pl-9 pr-3 py-2.5 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-sm"
                                placeholder="Create password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Confirm
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full pl-9 pr-3 py-2.5 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-sm"
                                placeholder="Confirm password">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start text-xs">
                        <div class="flex items-center h-4">
                            <input id="terms" type="checkbox" name="terms" required
                                class="w-3 h-3 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="ml-2">
                            <label for="terms" class="text-gray-700 dark:text-gray-300">
                                I agree to 
                                <a href="#" class="text-green-600 dark:text-green-400 hover:text-green-500 dark:hover:text-green-300 transition-colors duration-200">
                                    Terms
                                </a>
                                &
                                <a href="#" class="text-green-600 dark:text-green-400 hover:text-green-500 dark:hover:text-green-300 transition-colors duration-200">
                                    Privacy
                                </a>
                            </label>
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-teal-600 text-white font-semibold py-2.5 px-4 rounded-lg hover:from-green-600 hover:to-teal-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Create Account
                    </button>
                </form>

                <!-- Compact Password Requirements -->
                <div class="mt-4 p-3 bg-green-50/80 dark:bg-green-900/20 border border-green-200/50 dark:border-green-700/50 rounded-lg backdrop-blur-sm">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <h4 class="text-xs font-medium text-green-800 dark:text-green-200">Requirements</h4>
                            <p class="text-xs text-green-700 dark:text-green-300 mt-0.5">
                                8+ chars, uppercase, lowercase, numbers
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compact Footer -->
            <div class="text-center mt-4">
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    Have account? 
                    <a href="{{ route('login') }}" class="font-medium text-green-600 dark:text-green-400 hover:text-green-500 dark:hover:text-green-300 transition-colors duration-200">
                        Sign in
                    </a>
                </p>
            </div>
        </div>

        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            @keyframes float-delayed {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-8px); }
            }
            @keyframes float-slow {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-6px); }
            }
            .animate-float { animation: float 3s ease-in-out infinite; }
            .animate-float-delayed { animation: float-delayed 4s ease-in-out infinite; }
            .animate-float-slow { animation: float-slow 5s ease-in-out infinite; }
        </style>
    </div>
</x-guest-layout>
