@extends('layouts.app')

@section('title', $message->title)
@section('description', $message->seo_description)

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="media">
            <div align="center">
              <a href="{{ route('users.show', $message->user->id) }}">
                <img class="thumbnail img-fluid" src="{{ $message->user->avatar }}" width="300px" height="300px">
              </a>
            </div>
          </div>
          <hr>
          <div class="text-center">
            作者：{{ $message->user->name?:$reply->user->username }}
          </div>


        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 message-content">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $message->position->place .' -- '. $message->title }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $message->created_at->diffForHumans() }}
            ⋅
            <i class="far fa-comment"></i>
            {{ $message->reply_count }}
          </div>

          <div class="message-body mt-4 mb-4">
            {!! $message->content !!}
          </div>

          @can('update', $message)
            <div class="operate">
              <hr>
              <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                <i class="far fa-edit"></i> 编辑
              </a>
              <form action="{{ route('messages.destroy', $message->id) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您确定要删除吗？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                  <i class="far fa-trash-alt"></i> 删除
                </button>
              </form>
            </div>
          @endcan

        </div>
      </div>

      {{-- 用户回复列表 --}}
      <div class="card message-reply mt-4">
        <div class="card-body">
          @includeWhen(Auth::check(), 'messages._reply_box', ['message' => $message])
          @include('messages._reply_list', ['replies' => $message->replies()->with('user')->get()])
        </div>
      </div>

    </div>
  </div>
@stop