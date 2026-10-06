<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
        <div class="position-relative overflow-hidden radial-gradient min-vh-75 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="card w-50">
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="/images/nav.jpeg" alt="" width="45">
                                    <span class="fs-2 ms-2 fw-bold">Eloquent</span>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mt-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="mt-3">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="current-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4">
                                        <div class="form-check">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="underline text-primary text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <x-primary-button class=" d-flex flex-column mt-3 ms-3 bg-primary w-100 text-center justify-content-center align-items-center">
                                            {{ __('Log in') }}
                                        </x-primary-button>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a class="text-primary fw-bold mt-4" href="{{ route('register') }}">Create an account</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    
</x-guest-layout>


