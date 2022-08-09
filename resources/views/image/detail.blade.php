@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')
                <div class="card pub_image pub_image_detail">
                    @if ($image->user->image)
                        <div class="container-avatar">
                            <img src="{{ url('/user/avatar/' . $image->user->image) }}" alt="" alt="Avatar"
                                class="avatar" />
                        </div>
                    @endif
                    <div class="data-user">
                        <div class="card-header">{{ $image->user->name }} {{ $image->user->surname }}
                            <a href="{{route('image.detail',['id' => $image->id])}}">{{'@'.$image->user->nick}} </a>
                          
                        </div>
                    </div>
                
                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{ route('image.get', ['filename' => $image->image_path]) }}" class="pub_image" />
                        </div>
                       
                        <div class="description">
                          
                            <strong class="nickname">{{$image->user->nick }}</strong>
                            <p>{{ $image->description }}</p>
                
                        </div>
                        <div class='likes'>
                            <img src="{{asset('img/heart-black.png')}}" alt="">
                        </div>
                        <div class="clearfix">

                        </div>
                        <div class="comments">
                            <h2>Comentarios ({{count($image->comments)}})</h2>
                            <hr>
                            <form action="{{route('comment.save')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id_user"  value="{{Auth::user()->id}}"/>
                                @if($errors->has('id_user'))
                                        <span class="alert-alert-danger" role="alert">
                                        <strong>{{$errors->first('id_user')}}</strong>
                                    </span>
                                    @endif
                                <input type="hidden" name="image_id"  value="{{$image->id}}"/>
                                <p>
                                    <textarea name="content"  class="form-control"></textarea>
                                    @if($errors->has('content'))
                                        <span class="alert-alert-danger" role="alert">
                                        <strong>{{$errors->first('content')}}</strong>
                                    </span>
                                    @endif
                                </p>

                                <input type="submit" value="Enviar" class="btn btn-success">                                   
                            </form>
                            <hr>
                            @foreach($image->comments as $comment)
						    <div class="comment">
                                <span class="nickname">{{'@'.$comment->user->nick}} </span>
						    	
							    <p>{{$comment->content}}<br/>

								    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
								        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                            Eliminar
								        </a>
                                    @endif

							
							</p>
						</div>
						@endforeach
                        </div>
                
                    </div>
                </div>
			 </div>
        </div>
    </div>
@endsection
