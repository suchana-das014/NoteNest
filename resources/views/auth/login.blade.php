<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div style="margin-top:18px;">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div style="margin-top:14px;display:flex;align-items:center;gap:8px;">
            <input id="remember_me" type="checkbox" name="remember"
                   style="width:15px;height:15px;border-radius:4px;">
            <label for="remember_me" style="font-size:13px;color:rgba(255,255,255,0.6);cursor:pointer;">
                Remember me
            </label>
        </div>

        <div style="margin-top:24px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="underline text-gray-600">
                    Forgot password?
                </a>
            @endif
            <button type="submit">Log In</button>
        </div>

        <div style="text-align:center;margin-top:22px;font-size:13px;color:rgba(255,255,255,0.45);">
            Don't have an account?
            <a href="{{ route('register') }}"
               style="color:#fbbf24;font-weight:600;text-decoration:none;margin-left:4px;">
                Sign Up
            </a>
        </div>
    </form>
</x-guest-layout>