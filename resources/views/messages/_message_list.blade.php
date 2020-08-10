@if (count($messages))

    <ul class="list-unstyled">
        @foreach ($messages as $message)

            <li class="media">
                <div class="media-left">
                    <a href="{{ route('users.show', [$message->user_id]) }}">
                        <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="{{ $message->user->avatar }}" title="{{ $message->user->name }}">
                    </a>
                </div>

                <div class="media-body">

                    <div class="media-heading mt-0 mb-1">
                        <a href="{{ $message->link() }}" title="{{ $message->title }}">
                            {{ $message->title }}
                        </a>
                        <a class="float-right" href="{{ $message->link() }}">
                            <span class="badge badge-secondary badge-pill"> {{ $message->reply_count }} </span>
                        </a>
                    </div>

                    <small class="media-body meta text-secondary">

                        <a class="text-secondary" href="{{ route('themes.show', $message->themes_id) }}" title="{{ $message->theme->title }}">
                            <i class="far fa-folder"></i>
                            {{ $message->theme->title }}
                        </a>

                        <span> • </span>
                        <a class="text-secondary" href="{{ route('users.show', [$message->user_id]) }}" title="{{ $message->user->name }}">
                            <i class="far fa-user"></i>
                            {{ $message->user->name }}
                        </a>
                        <span> • </span>
                        <i class="far fa-clock"></i>
                        <span class="timeago" title="最后活跃于：{{ $message->updated_at }}">{{ $message->updated_at->diffForHumans() }}</span>
                    </small>

                </div>
            </li>

            @if ( ! $loop->last)
                <hr>
            @endif

        @endforeach
    </ul>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif