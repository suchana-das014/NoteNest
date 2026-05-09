<x-guest-layout>
    <p style="font-size:13px;color:rgba(255,255,255,0.55);line-height:1.6;margin-bottom:24px;">
        This is a secure area. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div style="margin-top:24px;display:flex;justify-content:flex-end;">
            <button type="submit">Confirm</button>
        </div>
    </form>
</x-guest-layout>