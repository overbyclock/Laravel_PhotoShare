@extends('layouts.app')

@section('content')

    <div class="container-photos">
        <h1>Your favorite photos</h1>
        @foreach ($likes as $like)
            <div class="box-photo">
                <div class="box-img">
                    <a href="{{ route('image.detail', ['id' => $like->image_id]) }}">
                        <img src="{{ route('image.get', ['filename' => $like->image->image_path]) }}" alt="">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    {{ $likes->links() }}

@endsection
