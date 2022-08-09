<div class="card pub_image">
    @if ($image->user->image)
        <div class="container-avatar">
            <img src="{{ url('/user/avatar/' . $image->user->image) }}" alt="" alt="Avatar"
                class="avatar" />
        </div>
    @endif
    <div class="data-user">
        <div class="card-header">{{ $image->user->name }} {{ $image->user->surname }}
            <a href="{{route('image.detail',['id' => $image->id])}}">{{ $image->user->nick }}</a>
          
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.get', ['filename' => $image->image_path]) }}" class="pub_image" />
        </div>
       
        <div class="description">
          
            <strong class="nickname">{{$image->user->nick }}</strong>
            <p>{{ $image->description }}</p>

        </div>
        <div class="likes">

            <!-- Comprobar si el usuario le dio like a la imagen -->
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
            @if($like->user->id == Auth::user()->id)
            <?php $user_like = true; ?>
            @endif
            @endforeach

            @if($user_like)
            <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike"/>
            @else
            <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like"/>
            @endif

            <span class="number_likes">{{count($image->likes)}}</span>
        </div>
      
        <div class="comments">
			<a href="" class="btn btn-sm btn-warning btn-comments">
				Comentarios ({{count($image->comments)}})
			</a>
		</div>

    </div>
</div>