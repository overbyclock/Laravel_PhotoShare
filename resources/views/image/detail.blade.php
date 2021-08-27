@extends('layouts.app')

@section('content')

    <div>@include('includes.messageOK')</div>

    <div class="container-photos">
        <div class="box-photo box-detail">
            <div class="box-header">
                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="avatar" class="avatar">
                <h5>{{ $image->user->name . ' ' . $image->user->surname }}</h5>
            </div>
            <div class="box-img img-detail">
                <img src="{{ route('image.get', ['filename' => $image->image_path]) }}" class="img-detail">
            </div>
            <div class="description">
                <strong>{{ $image->created_at }}</strong>
                <em>{{ \FormatTime::LongTimeFilter($image->created_at) }}</em>
                {{ '@' . $image->user->nick . ': ' . $image->description }}
                <a href="" class="btn btn-warning">Comment {{ count($image->comments) }}</a>
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

                @if (Auth::user() && Auth::user()->id == $image->user->id)
                    <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-info">Update</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                        Delete
                    </button>

                @endif

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Are you sure?</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                You are in the middle to delete the image and its comments and likes. The operation
                                is not going back.
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <a href="{{ route('image.delete', ['id' => $image->id]) }}"
                                    class="btn btn-danger">Confirm Delete</a>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
            <div class="box-footer">
                <form action="{{ route('comment.save') }}" method="post">
                    <h4>Comment this photo!!</h4>
                    @csrf
                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror"></textarea>
                    @error('comment')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                    <input type="submit" value="SEND" class="btn btn-success">
                    <input type="hidden" name="img-id" value="{{ $image->id }}">
                </form>
            </div>
            <div class="box-comment">
                @foreach ($image->comments as $comment)
                    <p><strong> {{ '@' . $comment->user->nick . ' ' }}</strong>
                        <em>{{ \FormatTime::LongTimeFilter($comment->created_at) }}</em>
                        {{ ' ' . $comment->content }}
                    </p>

                    @if ((Auth::check() && Auth::user()->id == $comment->user_id) || Auth::user()->id == $image->user_id)
                        <a class="btn btn-small btn-danger"
                            href="{{ route('comment.delete', ['id' => $comment->id]) }}">Delete</a>
                    @endif

                @endforeach
            </div>
        </div>
    </div>


@endsection
