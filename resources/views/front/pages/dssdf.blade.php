@extends('layouts.app')

@section('content')
<head>
</head>

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h2 class="display-5">Add new Entry</h2>
            <hr class="my-4">
            <div class="col">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Title</label>
                      <input type="text" name="title" >
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Content</label>
                      <textarea class="form-control" name="content" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Photo</label><br>
                        <input type="file"  name="photo">
                      </div>
        <br>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Publish</button>
                      </div>

                </form>
            </div>
        </div>
      </div>
    </div>
</div>



<div class="container" >
    <a href="{{route('posts.trashed')}}">Trashed posts</a>
    <p id="test"> </p>
    <div class="row">
        <div class="col-md-8">



              @if ($posts->count() > 0)
              @php
                //$c = 1;
                //$counter_id = "likes_counter" . $c;

                $b = 1;
                $button_id = "like_button" . $b;

                $n = 1;
                $show_names_id = "likes_names" . $n;
              @endphp
            @foreach ($posts as $post)

            @php
                $c = $post->id;
                $counter_id = "likes_counter" . $c;
            @endphp

            <div class="post-content">
              <div class="post-container">
                <div class="post-detail">
                  <div class="user-info">
                    <h5>
                        <img src="{{URL::asset($post->user->profile->profile_picture)}}" alt="d"
                            class="profile-photo-md pull-left">
                        <a href="timeline.html" class="profile-link">{{$post->user->name}}</a>

                         <span class="following"
                         onmouseover="show2({{$post->id}} , {{$n}})"
                         onmouseout="hide({{$n}})">
                         show</span>

                    </h5>
                    <p class="text-muted">Published: {{$post->created_at->diffForhumans()}}</p>
                  </div>

                  <div class="reaction">
                    <a class="text-danger" href="{{route('post.show' , ['slug'=> $post->slug])}}" title="show">
                        <i class="fas fa-eye text-success  fa-2x"></i>
                    </a>
                    @if ($post->user_id == Auth::id())
                    &nbsp;  &nbsp;
                      <a href="{{route('post.edit' , ['id' => $post->id ])}}" title="edit">
                        <i class="fa-solid fa-2x fa-pen-to-square"></i>
                    </a>
                    &nbsp;  &nbsp;
                    <a class="text-danger" href="{{route('post.destroy' , ['id'=> $post->id])}}" title="delete">
                        <i class="fa-solid fa-2x fa-trash-can"></i>
                    </a>
                    @endif
                  </div>

                    <br>
                    <div  class="names">
                        <p id={{$show_names_id}}></p>
                    </div>

                  <div class="line-divider"></div>
                    <div class="post-title">
                        <p> {{$post->title}} <i class="em em-anguished"></i>
                            <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                    </div>
                    <div class="post-text">
                        <p> {{$post->content}} <i class="em em-anguished"></i>
                            <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                    </div>
                  <div class="line-divider"></div>

                  @if ($post->photo != null)
                    <div class="post-photo">
                        <img src="{{URL::asset($post->photo)}}" alt="{{$post->photo}}"
                            class="img-tumbnail" width="300" height="300">
                    </div>
                    <div class="line-divider"></div>
                  @endif
                    {{-- open small modal to show likes --}}
                  <div style="margin-top: 10px" >
                    <a data-toggle="modal" id="smallButton" data-target="#smallModal" title="show likes">
                      <span class="text-info" style="cursor: pointer"
                            onclick="showLikes({{$post->id}})">
                        <i id={{$counter_id}} class="fa fa-thumbs-up"> {{$post->likes}}</i>
                      </span>
                    </a>
                  </div>


<div style="margin-top: 10px">
                  <button type="button"
                            onclick="like({{$post->id}} , '{{$counter_id}}' , {{$b}})">
                            @if ($post->isliked($post->id))
                                <span title="unlike">
                                <i id={{$button_id}} class="fa-regular fa-2x fa-thumbs-down"></i>
                                </span>
                            @else
                                <span class="text-success" title="like">
                                <i id={{$button_id}} class="fa-regular fa-2x fa-thumbs-up"></i>
                                </span>
                            @endif
                    </button>
</div>

</div>


                </div>
              </div>

              @php
                $c = $c+1;
                $counter_id = 'likes_counter' . $c;

                $b = $b + 1;
                $button_id = "like_button" . $b;

                $n = $n + 1;
                $show_names_id = "likes_names" . $n;
                 @endphp
              @endforeach

              @else
                 <div class="alert alert-danger" role="alert"> No posts! </div>
              @endif
            </div>
        </div>
    </div>


<!-- small modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Likes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="smallBody">
            <div>
                <!-- the result to be displayed apply here -->
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function tim(){
        var now = new Date();
   //     var mm = now.getYear();
       var h = now.getHours();
       var m = now.getMinutes();
       var s = now.getSeconds();
        document.getElementById("test").innerHTML = "" + h + ":" + m + ":" + s ;
    }
    setInterval(() => { tim() } , 1000);
</script>

@endsection

