@extends('layouts.main')

@section('title', 'Forgot Password - Uni Support')
@section('meta_description', 'Reset your Uni Support account password to regain access to our services.')

@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="w-[400px] flex flex-col items-center justify-center gap-4 shadow-md m-auto mt-[250px] p-10 rounded-[20px] border-gray-100 border">
        @csrf

        <div class="mb-4 text-sm text-gray-600 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Email Address -->
        <div class="w-full">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-end mt-4 w-full">
            <button class="p-3 rounded-[5px] bg-indigo-600 text-white w-full mb-5">
                {{ __('Email Password Reset Link') }}
            </button>
            <a class="mx-auto underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Back to Login') }}
            </a>
        </div>
    </form>
@endsection
