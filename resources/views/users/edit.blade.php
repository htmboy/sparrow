@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 offset-md-2">

            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('users.update', $user->id) }}" method="POST"
                          accept-charset="UTF-8"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('shared._error')

                        <div class="form-group">
                            <label for="name-field">您的姓名</label>
                            <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" />
                        </div>
                        <div class="form-group">
                            <label for="email-field">性 别</label>
                            <div class="form-check">
                                <label class="radio-inline">
                                    <input type="radio" name="sex" id="sex-field1" value="1" {{ old('sex', $user->sex) == 1?'checked':'' }}/>男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" id="sex-field2" value="2" {{ old('sex', $user->sex) == 2?'checked':'' }}/>女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth-field">出生年月</label>
                            <input class="form-control" type="date" name="birth" id="birth-field" value="{{ date('Y-m-d', strtotime(old('birth', $user->birth))) }}" />
                        </div>
                        <div class="form-group">
                            <label for="introduction-field">个人简介</label>
                            <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label for="" class="avatar-label">用户头像</label>
                            <input type="file" name="avatar" class="form-control-file">

                            @if($user->avatar)
                                <br>
                                <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" />
                            @endif
                        </div>
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection