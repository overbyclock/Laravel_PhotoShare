@extends('layouts.app')

@section('content')

    <div>@include('includes.messageOK')</div>

    <div class="container-users">
        <h1>List of users</h1>
        <form action="{{ route('user.getUsers') }}" method="get" id="form-search">
            <input type="text" id="search" class="form-group">
            <input type="submit" value="submit" class="btn btn-info">
        </form>
        @foreach ($users as $user)
            <div class="list-users">
                <div class="container-row">
                    <a href="{{ url('/user/profile/' . $user->id) }}"><img
                            src="{{ url('/user/avatar/' . $user->image) }}" alt="avatar" class="avatar-XL"></a>
                </div>
                <div class="container-column">
                    <h3>{{ $user->name . ' ' . $user->surname }}</h3>
                    <ul>
                        <li><span class="bold">Nick:</span> {{ '@' . $user->nick }}</li>
                        <li><span class="bold">Email:</span> {{ $user->email }}</li>
                        <li><span class="bold">Registered </span> {{ \FormatTime::LongTimeFilter($user->created_at) }}
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
        {{ $users->links() }}
    </div>
    <!--close container-photos-->
@endsection
