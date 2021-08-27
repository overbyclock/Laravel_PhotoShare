<div class="box-photo">
    <div class="box-header">
        <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="avatar" class="avatar">
        <h5>{{ $image->user->name . ' ' . $image->user->surname }}</h5>
    </div>
    <div class="box-img">
        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
            <img src="{{ route('image.get', ['filename' => $image->image_path]) }}" alt="">
        </a>
    </div>
    <div class="description">
        <strong>{{ $image->created_at }}</strong>
        <em>{{ \FormatTime::LongTimeFilter($image->created_at) }}</em>
        {{ '@' . $image->user->nick . ': ' . $image->description }}
        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-warning">Comment
            {{ count($image->comments) }}</a>
        <?php $controll = false; ?>
        @foreach ($image->likes as $like)
            @if (Auth::user()->id == $like->user->id)
                <?php $controll = true; ?>
            @else
                <?php $controll = false; ?>
            @endif
        @endforeach

        @if ($controll)
            <img class="heart-like" info="{{ $image->id }}" src="{{ asset('icons/heart-red.png') }}"
                alt="heart icon">{{ count($image->likes) }}
        @else
            <img class="heart-like" info="{{ $image->id }}" src="{{ asset('icons/heart-grey.png') }}"
                alt="heart icon">{{ count($image->likes) }}
        @endif
    </div>
    <div class="box-comment">
        @foreach ($image->comments as $comment)
            <p><strong> {{ '@' . $comment->user->nick . ' ' }}</strong>
                <em>{{ \FormatTime::LongTimeFilter($comment->created_at) }}</em>
                {{ ' ' . $comment->content }}
            </p>
        @endforeach
    </div>
</div>
