@extends('layouts.app')
@section('content')

  


<div style="border:solid 1px">

	@foreach ($books as $book) 

	@php

      $likes_id = "likes" . $book->id;

	  $dislikes_id = "dislikes" . $book->id;


	@endphp
	
	<div style="padding-right: 40%;padding-top: 1%;">


    <div class="card" style="width: 30rem;border: 1px solid" >
		<img src="{{URL::asset($book->cover) }}" alt="{{$book->cover}}">
    <div ><h4>{{$book->title}}</h4></div>
    <div  ><h5>{{$book->auther_id}}</h5></div>
    <div ><h6>{{$book->created_at}}</h6></div>
      <div class="card-body" style="border: 1px solid">
        <p  class="card-text">{{$book->content}}</p>
      </div>
	 <!-- <button class="btn btn-block btn-primary"><i class="fa fa-thumbs-up">Like</i> </button>-->
    </div>
	<br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<div class="container"> 

		<span class="text-info" style="cursor: pointer"
                            onclick="like({{$book->id}}, '{{$likes_id}}')">
							
                        <i id={{$likes_id}} class="fa fa-2x fa-thumbs-up"> {{$book->likes}} </i>
        </span>

		&nbsp; &nbsp;

		<span class="text-info" style="cursor: pointer"
                            onclick="dislike({{$book->id}}, '{{$dislikes_id}}')">
							
                        <i id={{$dislikes_id}} class="fa fa-2x fa-thumbs-down"> {{$book->dislikes}} </i>
        </span>
		

	</div>

</div>

<br>

@endforeach
{!!  $books->render() !!}
</div>



	  
	  



@endsection

<script>

function like(book_id, likes_id) {

    // Creating XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    
    var url = '/book/like/' + book_id;


    // Making connection
    xhr.open("POST", url, true);

    // function execute after request is successful
    xhr.onload = function() {
            document.getElementById(likes_id).innerHTML = " " + this.responseText;
        }
        // Sending request
    xhr.send();
}

function dislike(book_id, dislikes_id) {

// Creating XMLHttpRequest object
var xhr = new XMLHttpRequest();

var url = '/book/dislike/' + book_id;


// Making connection
xhr.open("POST", url, true);

// function execute after request is successful
xhr.onload = function() {
		document.getElementById(dislikes_id).innerHTML = " " + this.responseText;
	}
	// Sending request
xhr.send();
}
</script>