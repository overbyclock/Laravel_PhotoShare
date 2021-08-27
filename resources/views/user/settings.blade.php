@extends('layouts.app')

@section('content')
<div class="form-container">
    @if(session('message'))
      <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="form-head">Your account seetings</div>
      <div class="input-container">
        <div class="input-item">
            <label for="name">Name</label>
            <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ Auth::user()->name }}"
            required autocomplete="name" autofocus>

        </div>
        @error('name')
        <span class="error" role="alert">
         <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="input-item">
            <label for="surname">Surname</label>
            <input type="text" name="surname"
            class="form-control @error('surname') is-invalid @enderror" name="surname"
            value="{{ Auth::user()->surname }}"
            required autocomplete="surname" autofocus>

        </div>
        @error('surname')
        <span class="error" role="alert">
         <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="input-item">
            <label for="nick">Nick</label>
            <input type="text" name="nick"
            class="form-control @error('nick') is-invalid @enderror" name="nick"
            value="{{ Auth::user()->nick }}"
            required autocomplete="nick" autofocus>
        </div>

        @error('nick')
        <span class="error" role="alert">
         <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="input-item">
            <label for="email">Email</label>
            <input type="email" name="email"
            class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ Auth::user()->email }}"
            required autocomplete="nick" autofocus>

        </div>
        @error('email')
        <span class="error" role="alert">
         <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="input-item">
            <label for="image">Avatar  </label>
            <input type="file" name="image" id="image"
            class="form-control @error('image') is-invalid @enderror"
            value="{{ Auth::user()->image }}"
            autocomplete="image" autofocus>
           

        </div>
        <div class="container-avatar">
         
        </div>
        @error('image')
        <span class="error" role="alert">
         <strong>{{ $message }}</strong>
        </span>
        @enderror
        <?php /*
        <div class="input-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password"
            class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-item">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
            required autocomplete="new-password">
        </div>
        */?>
        <div class="input-submit">
            <input type="submit" name="submit" value="Save Changes">
        </div>
     </div>
    </form>
</div>
@endsection
