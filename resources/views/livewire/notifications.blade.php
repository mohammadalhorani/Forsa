<div>
    @foreach($notifications as $notification)
        <div class="notification {{ $notification->read_at ? 'read' : 'unread' }}">
            {{ $notification->data['message'] }}
        </div>
    @endforeach
</div>
