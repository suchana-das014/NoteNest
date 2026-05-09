<x-guest-layout>
    <p style="font-size:13px;color:rgba(255,255,255,0.55);line-height:1.6;margin-bottom:24px;">
        Forgot your password? No problem — enter your email and we'll send you a reset link.
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email"
                :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div style="margin-top:24px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
            <a href="{{ route('login') }}" class="underline text-gray-600">
                Back to login
            </a>
            <button type="submit">Send Reset Link</button>
        </div>
    </form>
</x-guest-layout>