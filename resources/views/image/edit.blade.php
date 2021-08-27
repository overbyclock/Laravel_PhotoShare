@extends('layouts.app')

@section('content')
    <div class="form-container">
        @include ('includes.messageOK')
        <form action="{{ route('image.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="image_id" value="{{ $image->id }}">
            <div class="form-head">Edit your Awesome Images</div>
            <div class="input-container">
                <div class="input-item">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control @error('name') is-invalid @enderror"
                        name="description" required autocomplete="description" autofocus
                        value="{{ $image->description }}">
                </div>
                @error('name')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-item">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"
                        autocomplete="image" autofocus>
                </div>
                @error('image')
                    <span class="error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="box-img img-detail">
                    <img src="{{ route('image.get', ['filename' => $image->image_path]) }}" class="thumb">
                </div>
                <div class="input-submit">
                    <input type="submit" name="submit" value="Save Changes">
                </div>
            </div>
        </form>
    </div>
@endsection
