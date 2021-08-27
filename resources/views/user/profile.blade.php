@extends('layouts.app')

@section('content')

    <div>@include('includes.messageOK')</div>

    <div class="container-photos">
        <div class="profile">
            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="avatar" class="avatar-XL">
            <h1>{{ $user->name }} ,here you have your photos!</h1>
        </div>


        @foreach ($user->images as $image)
            @include('includes.photocard',['image'=>$image])
        @endforeach

    </div>
    <!--close container-photos-->
@endsection
