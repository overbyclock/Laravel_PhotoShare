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
                <img class="heart-like" src="{{ asset('icons/heart-grey.png') }}" alt="heart icon">
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

                    @if ((Auth::check() && Auth::user()->id == $comment->user_id) || $comment->image->user_id == Auth::user()->id)
                        <a class="btn btn-small btn-danger"
                            href="{{ route('comment.delete', ['id' => $comment->id]) }}">Delete</a>
                    @endif

                @endforeach
            </div>
        </div>
    </div>


@endsection
