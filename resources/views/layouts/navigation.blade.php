<nav x-data="{ open: false }" class="nn-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('notes.index') }}" class="nn-logo">
                    Note<span>Nest</span>
                </a>
            </div>

            {{-- Desktop: Settings Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="nn-user-btn">
                            <span class="nn-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="nn-chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- User info header --}}
                        <div class="nn-drop-header">
                            <div class="nn-drop-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="nn-drop-info">
                                <div class="nn-drop-name">{{ Auth::user()->name }}</div>
                                <div class="nn-drop-email">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                        {{-- Profile link --}}
                        <x-dropdown-link :href="route('profile.edit')" class="nn-drop-link">
                            👤 &nbsp; Profile
                        </x-dropdown-link>

                        <div class="nn-drop-divider"></div>

                        {{-- Logout: plain button inside form — no x-dropdown-link needed --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nn-drop-link nn-drop-logout">
                                🚪 &nbsp; Log Out
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="nn-hamburger">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden nn-mobile-menu">
        <div class="pt-4 pb-1 border-t border-white border-opacity-10">
            <div class="nn-mobile-user">
                <span class="nn-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                <div>
                    <div class="nn-mobile-name">{{ Auth::user()->name }}</div>
                    <div class="nn-mobile-email">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('notes.index') }}" class="nn-mobile-link">📝 My Notes</a>
                <a href="{{ route('profile.edit') }}" class="nn-mobile-link">👤 Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nn-mobile-logout">🚪 Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
/* ── Navbar ────────────────────────────────────────────────────── */
.nn-nav {
    background: linear-gradient(135deg, #1e1b4b 0%, #4c1d95 60%, #6d28d9 100%);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 2px 16px rgba(0,0,0,0.25);
    position: relative;
    z-index: 50;
}

/* ── Logo ──────────────────────────────────────────────────────── */
.nn-logo {
    font-family: 'Caveat', cursive;
    font-size: 30px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    letter-spacing: -0.5px;
    line-height: 1;
}
.nn-logo span { color: #fbbf24; }

/* ── Desktop user button ───────────────────────────────────────── */
.nn-user-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px 6px 6px;
    border-radius: 50px;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.1);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: background 0.2s;
}
.nn-user-btn:hover {
    background: rgba(255,255,255,0.2);
}

/* ── Avatar ────────────────────────────────────────────────────── */
.nn-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: #1e1b4b;
    flex-shrink: 0;
}

/* ── Chevron ───────────────────────────────────────────────────── */
.nn-chevron {
    width: 14px;
    height: 14px;
    fill: currentColor;
    opacity: 0.7;
}

/* ── Dropdown panel header ─────────────────────────────────────── */
.nn-drop-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    background: linear-gradient(135deg, #f8faff, #f0f4ff);
    border-bottom: 1px solid #e8edf8;
    border-radius: 6px 6px 0 0;
}
.nn-drop-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}
.nn-drop-info { overflow: hidden; }
.nn-drop-name {
    font-weight: 700;
    font-size: 14px;
    color: #1e1b4b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.nn-drop-email {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 1px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ── Dropdown links ────────────────────────────────────────────── */
.nn-drop-link {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding: 11px 16px;
    font-size: 14px;
    font-weight: 500;
    font-family: inherit;
    color: #374151;
    text-decoration: none;
    background: transparent;
    border: none;
    cursor: pointer;
    text-align: left;
    transition: background 0.15s;
}
.nn-drop-link:hover {
    background: #f8fafc;
}

/* Logout link – red tint */
.nn-drop-logout {
    color: #ef4444;
}
.nn-drop-logout:hover {
    background: #fef2f2;
}

.nn-drop-divider {
    height: 1px;
    background: #f1f5f9;
    margin: 2px 0;
}

/* ── Hamburger ─────────────────────────────────────────────────── */
.nn-hamburger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    color: #fff;
    cursor: pointer;
}

/* ── Mobile menu ───────────────────────────────────────────────── */
.nn-mobile-menu {
    background: rgba(20,16,60,0.98);
}
.nn-mobile-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
}
.nn-mobile-name { font-weight: 600; font-size: 14px; color: #fff; }
.nn-mobile-email { font-size: 12px; color: rgba(255,255,255,0.45); }

.nn-mobile-link {
    display: block;
    padding: 10px 12px;
    border-radius: 10px;
    color: rgba(255,255,255,0.85);
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.15s;
}
.nn-mobile-link:hover { background: rgba(255,255,255,0.08); }

.nn-mobile-logout {
    display: block;
    width: 100%;
    text-align: left;
    padding: 10px 12px;
    border-radius: 10px;
    color: #fca5a5;
    font-size: 14px;
    font-weight: 500;
    font-family: inherit;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: background 0.15s;
}
.nn-mobile-logout:hover { background: rgba(244,63,94,0.12); }
</style>