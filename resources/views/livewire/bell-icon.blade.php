<!-- bell-icon.blade.php -->

<div>
    <div wire:click="showLastNewNotes" class="cursor-pointer ">
        <svg class="c-icon">
            <use xlink:href="{{ url('/icons/sprites/free.svg#cil-bell') }}"></use>
            @if (count($lastNotes) > 0)
                <span class="badge badge-danger">{{$unreadCount }}</span>
            @endif
        </svg>

        @if ($showContent && count($lastNotes) > 0)
            <div class="dropdown-menu dropdown-menu-right pt-0">
                @foreach ($lastNotes as $note)
                    <a class="dropdown-item @if (!$note->read) bg-warning text-white @endif" href="{{url("/notes/")."/".$note->id}}" wire:click="markAsRead({{ $note->id }})">
                        {{ $note->title }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
