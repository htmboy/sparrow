@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          Message /
          @if($message->id)
            Edit #{{ $message->id }}
          @else
            Create
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($message->id)
          <form action="{{ route('messages.update', $message->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('messages.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          
                <div class="form-group">
                    <label for="position_id-field">Position_id</label>
                    <input class="form-control" type="text" name="position_id" id="position_id-field" value="{{ old('position_id', $message->position_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $message->user_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="title-field">Title</label>
                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $message->title ) }}" />
                </div> 
                <div class="form-group">
                    <label for="content-field">Content</label>
                    <input class="form-control" type="text" name="content" id="content-field" value="{{ old('content', $message->content ) }}" />
                </div> 
                <div class="form-group">
                    <label for="sort-field">Sort</label>
                    <input class="form-control" type="text" name="sort" id="sort-field" value="{{ old('sort', $message->sort ) }}" />
                </div> 
                <div class="form-group">
                	<label for="seo_title-field">Seo_title</label>
                	<input class="form-control" type="text" name="seo_title" id="seo_title-field" value="{{ old('seo_title', $message->seo_title ) }}" />
                </div> 
                <div class="form-group">
                	<label for="seo_keywords-field">Seo_keywords</label>
                	<input class="form-control" type="text" name="seo_keywords" id="seo_keywords-field" value="{{ old('seo_keywords', $message->seo_keywords ) }}" />
                </div> 
                <div class="form-group">
                    <label for="seo_description-field">Seo_description</label>
                    <input class="form-control" type="text" name="seo_description" id="seo_description-field" value="{{ old('seo_description', $message->seo_description ) }}" />
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $message->status ) }}" />
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link float-xs-right" href="{{ route('messages.index') }}"> <- Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
