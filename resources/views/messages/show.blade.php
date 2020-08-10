@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <h1>Message / Show #{{ $message->id }}</h1>
      </div>

      <div class="card-body">
        <div class="card-block bg-light">
          <div class="row">
            <div class="col-md-6">
              <a class="btn btn-link" href="{{ route('messages.index') }}"><- Back</a>
            </div>
            <div class="col-md-6">
              <a class="btn btn-sm btn-warning float-right mt-1" href="{{ route('messages.edit', $message->id) }}">
                Edit
              </a>
            </div>
          </div>
        </div>
        <br>

        <label>Position_id</label>
<p>
	{{ $message->position_id }}
</p> <label>User_id</label>
<p>
	{{ $message->user_id }}
</p> <label>Title</label>
<p>
	{{ $message->title }}
</p> <label>Content</label>
<p>
	{{ $message->content }}
</p> <label>Sort</label>
<p>
	{{ $message->sort }}
</p> <label>Seo_title</label>
<p>
	{{ $message->seo_title?:'' }}
</p> <label>Seo_keywords</label>
<p>
	{{ $message->seo_keywords?:'' }}
</p> <label>Seo_description</label>
<p>
	{{ $message->seo_description?:'' }}
</p> <label>Status</label>
<p>
	{{ $message->status }}
</p>
      </div>
    </div>
  </div>
</div>

@endsection
