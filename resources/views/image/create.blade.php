@extends('layouts.app')

@section('content')
<div class="form-container">
  @include ('includes.messageOK')
  <form action="{{route('image.save')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="form-head">Upload Awesome Images</div>
    <div class="input-container">
      <div class="input-item">
          <label for="description">Description</label>
          <input type="text" name="description"
          class="form-control @error('name') is-invalid @enderror" name="description"
          value=""
          required autocomplete="description" autofocus>
      </div>
      @error('name')
      <span class="error" role="alert">
       <strong>{{ $message }}</strong>
      </span>
      @enderror
      <div class="input-item">
          <label for="image">Image</label>
          <input type="file" name="image" id="image"
          class="form-control @error('image') is-invalid @enderror"
          value="{{ Auth::user()->image }}"
          required autocomplete="image" autofocus>
      </div>
      @error('image')
      <span class="error" role="alert">
       <strong>{{ $message }}</strong>
      </span>
      @enderror
      <div class="input-submit">
          <input type="submit" name="submit" value="Save Changes">
      </div>
   </div>
  </form>
</div>
@endsection
