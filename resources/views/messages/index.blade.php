@extends('layouts.app')

@section('title', isset($theme) ? $theme->title : '话题列表')

@section('content')

  <div class="row mb-5">
    <div class="col-lg-9 col-md-9 topic-list">
      @if (isset($theme))
        <div class="alert alert-info" role="alert">
          {{ $theme->title }}
        </div>
      @endif
      <div class="card ">

        <div class="card-header bg-transparent">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link {{ ! active_class(if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=default">
                最新发布
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ active_class(if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=recent">
                最后回复
              </a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          {{-- 话题列表 --}}
          @include('messages._message_list', ['messages' => $messages])

          {{-- 分页 --}}
          <div class="mt-5">
            {!! $messages->appends(Request::except('page'))->render() !!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
      @include('messages._sidebar')
    </div>
  </div>

@endsection