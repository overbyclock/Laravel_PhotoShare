@extends('layouts.app')

@section('content')

    <div>@include('includes.messageOK')</div>

    <div class="container-photos">
        <h1>The best photos</h1>
        @foreach ($images as $image)
            @include('includes.photocard',['image'=>$image])
        @endforeach
    </div>

    {{ $images->links() }}


    <!--close container-photos-->
@endsection
