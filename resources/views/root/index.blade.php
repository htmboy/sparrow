@extends('layouts.app')
@section('title', '首页')

@section('content')
    <div class="row mb-12">
        <div class="col-lg-12 col-md-12 message-list">
            <div class="alert alert-info" role="alert">
                选择区域
            </div>

            <div class="card">
                <div class="card-body">
                    @foreach($provinces as $province)
                        <h6>{{$province->place}}</h6>
                        <ul class="nav nav-pills">
                            @foreach($towns as $town)
                                @if(explode('-', trim($town->path, '-'))[0] == $province->id)
                                    <li class="nav-item">
                                        <a class="nav-link" href="/{{positionToSlugs($town)}}">
                                            {{positionToSlugs($town, false)}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop