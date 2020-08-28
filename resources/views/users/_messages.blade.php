@if (count($messages))

    <ul class="list-group mt-4 border-0">
        @foreach ($messages as $message)
            <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
                <a href="{{ route('messages.show', [positionToSlugs($message->position), $message->id]) }}">
                    {{ $message->title }}
                </a>
                <span class="meta float-right text-secondary">
          {{ $message->reply_count }} 回复
          <span> ⋅ </span>
          {{ $message->created_at->diffForHumans() }}
        </span>
            </li>
        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
    {!! $messages->render() !!}
</div>