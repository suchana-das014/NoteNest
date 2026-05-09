<x-app-layout>

    {{-- White header bar with page title --}}
    <x-slot name="header">
        <h2 style="font-family:'Inter',sans-serif;font-size:20px;font-weight:700;
                   color:#1e1b4b;margin:0;display:flex;align-items:center;gap:8px;">
            📝 My Notes
        </h2>
    </x-slot>

    <div class="note-container py-10">

        {{-- Success flash --}}
        @if(session('success'))
            <div class="success-message">✅ {{ session('success') }}</div>
        @endif

        {{-- New Note + Search bar row --}}
<div style="display:flex;align-items:center;justify-content:space-between;
            gap:16px;margin-bottom:32px;margin-top:8px;flex-wrap:wrap;">

    {{-- New Note button --}}
    <a href="{{ route('notes.create') }}" class="new-note-btn"
       style=" margin:0;">
        New Note
    </a>

    {{-- Search bar --}}
    <form method="GET" action="{{ route('notes.index') }}"
          style="display:flex;align-items:center;flex:1;max-width:400px;">
        <div style="display:flex;align-items:center;width:100%;
                    background:#fff;border-radius:50px;
                    box-shadow:0 2px 12px rgba(99,102,241,0.12);
                    border:1px solid #e0e7ff;overflow:hidden;">
            <span style="padding:0 12px;font-size:17px;">🔍</span>
            <input
                type="text"
                name="search"
                value="{{ $query ?? '' }}"
                placeholder="Search notes..."
                style="flex:1;border:none;outline:none;padding:11px 4px;
                       font-size:14px;font-family:'Inter',sans-serif;
                       background:transparent;color:#1e1b4b;"
            />
            @if($query ?? false)
                <a href="{{ route('notes.index') }}"
                   style="padding:0 12px;color:#94a3b8;font-size:20px;
                          text-decoration:none;line-height:1;">
                    ×
                </a>
            @endif
            <button type="submit"
                    style="padding:10px 18px;
                           background:linear-gradient(135deg,#6366f1,#8b5cf6);
                           color:#fff;border:none;font-family:'Inter',sans-serif;
                           font-weight:600;font-size:13px;cursor:pointer;
                           white-space:nowrap;">
                Search
            </button>
        </div>
    </form>

</div>

{{-- Show what's being searched --}}
@if($query ?? false)
    <p style="color:#6366f1;font-size:14px;margin-bottom:16px;font-weight:500;">
        Showing results for "<strong>{{ $query }}</strong>"
        &nbsp;·&nbsp;
        <a href="{{ route('notes.index') }}" style="color:#94a3b8;text-decoration:none;">Clear</a>
    </p>
@endif
        {{-- Notes grid --}}
        <div class="notes">
            @forelse ($notes as $note)
                <div class="note">
                    <div class="note-body">
                        {{ Str::words($note->note, 30) }}
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('notes.show', $note) }}" class="note-view-button">View</a>
                        <a href="{{ route('notes.edit', $note) }}" class="note-edit-button">Edit</a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="note-delete-button">Delete</button>
                        </form>
                    </div>
                </div>
           @empty
    <div style="text-align:center;color:#94a3b8;font-size:16px;padding:48px 0;width:100%;">
        @if($query ?? false)
            😕 No notes found for "<strong>{{ $query }}</strong>"
        @else
            📭 No notes yet — click <strong>New Note</strong> to get started!
        @endif
    </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div style="padding:24px 0;display:flex;justify-content:center;">
            {{ $notes->links() }}
        </div>

    </div>
</x-app-layout>