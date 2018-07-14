@extends('layouts.app')

@section('content')
<div class="container">
    <script>
    window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
      }
    }
  </script>
    <div class="row justify-content">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              @if(!Auth::guest() && (Auth::user()->avatar == "default.jpg"))
                <span style="width: 60px; height: 60px; float:left; margin-right:100px; line-height: 62px; text-align: center; background: #263238; display: inline-block;  border-radius: 50%; color: #fff;font-size: 20px;">{{ ucfirst(substr( Auth::user()->name , 0, 1)) }}</span>
              @else
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px">
              @endif

                <div class="card" style="left:60px">
                  <h3 class="card-body"style=" display: block; margin-left: 0; right: 20;">{{ Auth::user()->name }}'s Dashboard</h3>
                  <br>
                  <div class="card-header"> Profile & Bio </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form enctype="multipart/form-data" action="/dashboard" method="POST">
                          <label>Update Profile Image</label>
                          <input type="file" name="avatar">
                          <input type="hidden" name="_token" value={{ csrf_token() }}>
                          <input type="submit" class="pull_right btn btn-sm btn-primary">
                        </form>
                        <hr>
                        <h3>Title/Co-op Position at RBC</h3>
                        {!! Form::open(['action'=>'DashboardController@store', 'method' => 'POST']) !!}
                          <div class='form-group'>
                            {{Form::label('title', 'Title')}}
                            {{Form::text('title', Auth::user()->title, ['class' => 'form-control', 'placeholder' => Auth::user()->title])}}
                          </div>
                          <div class='form-group'>
                            {{Form::label('body', 'Body')}}
                            {{Form::textarea('body', Auth::user()->bio, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                          </div>
                          <div class='form-group'>
                            {{Form::label('tag', 'Tag')}}
                            {{Form::text('tag', Auth::user()->tags, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                          </div>
                          <div class='form-group'>
                            {{Form::label('insta', 'Instagram')}}
                            {{Form::text('insta', Auth::user()->instagram, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                          </div>
                          <div class='form-group'>
                            {{Form::label('linked', 'LinkedIn')}}
                            {{Form::text('linked', Auth::user()->linkedin, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                          </div>
                          <div class='form-group'>
                            {{Form::label('twitter', 'Twitter')}}
                            {{Form::text('twitter', Auth::user()->twitter, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                          </div>
                          <div class='form-group'>
                            {{Form::label('fb', 'Facebook')}}
                            {{Form::text('fb', Auth::user()->facebook, ['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                          </div>
                          {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
                        {!! Form::close() !!}
                        <div class="panel-body">
                          <hr>
                          <h3> Your Blog Posts</h3>
                            @if(count($posts)>0)
                              <table class="table table-striped">
                                <tr>
                                  <th>Title</th>
                                  <th></th>
                                  <th></th>
                               </tr>

                             @foreach($posts as $post)
                               <tr>
                                 <td>{{$post->title}}</td>
                                 <td><a href="/posts/{{$post->id}}/edit" class"btn btn-default">Edit</a></td>
                                 <td>
                                     {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                      {{Form::hidden('_method', 'DELETE')}}
                                      {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                     {!!Form::close()!!}
                               </td>
                              </tr>
                             @endforeach
                          </table>
                          @else
                            <p>You have no saved posts</p>
                          @endif
                        </div>
                    </div>
                </div>
          </div>
        </div>
</div>
@endsection
