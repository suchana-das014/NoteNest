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

        {{-- New Note button centred --}}
        <div style="display:flex;justify-content:center;margin-bottom:36px;">
            <a href="{{ route('notes.create') }}" class="new-note-btn">New Note</a>
        </div>

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
                    No notes yet — click <strong>New Note</strong> to get started!
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div style="padding:24px 0;display:flex;justify-content:center;">
            {{ $notes->links() }}
        </div>

    </div>
</x-app-layout>