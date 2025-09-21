@extends('layouts.main')

@section('title', 'Login - Uni Support')
@section('meta_description', 'Welcome to Uni Support - Your trusted partner for exceptional IT solutions and services. We specialize in delivering innovative technology solutions tailored to meet your business needs.')

@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w-[400px] flex flex-col items-center justify-center gap-4 shadow-md m-auto mt-[250px] p-10 rounded-[20px] border-gray-100 border">
        @csrf
        <h1 class="text-bold text-[25px] mb-5">Sign in</h1>
        <div class="w-full">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 w-full">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-3 w-full">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-end mt-4 w-full">
            <button class="p-3 rounded-[5px] bg-indigo-600 text-white w-full mb-5">
                {{ __('Log in') }}
            </button>
            @if (Route::has('password.request'))
                <a class="mx-auto underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
@endsection
