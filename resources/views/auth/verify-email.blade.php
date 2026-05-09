<x-guest-layout>
    <p style="font-size:13px;color:rgba(255,255,255,0.55);line-height:1.6;margin-bottom:20px;">
        Thanks for signing up! Please verify your email address by clicking the link we sent you.
        If you didn't receive it, we can send another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div style="background:rgba(16,185,129,0.15);border:1px solid rgba(16,185,129,0.3);
                    color:#6ee7b7;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:20px;">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-top:8px;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline">Log Out</button>
        </form>
    </div>
</x-guest-layout>