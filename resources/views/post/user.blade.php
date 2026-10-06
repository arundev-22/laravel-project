@extends('layout.dashboard')

@section('content')

    <div class="container my-4">
        <h2 class="mb-4 text-center text-shadow-lg">User List</h2>

        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="d-block">{{ $user->name }}</strong>
                        <span class="text-muted small">{{ $user->email }}</span>
                    </div>

                    <div>
                        @if(auth()->id() !== $user->id)
                            <form action="{{ route('user.follow', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                
                                @if(auth()->user()->isFollowing($user))
                                    <button type="submit" class="btn btn-outline-secondary rounded btn-sm">
                                        <span>Unfollow</span>
                                    </button>
                                @elseif(auth()->user()->hasPendingFollowRequest($user))
                                    <button type="submit" class="btn btn-outline-warning rounded btn-sm">
                                        <span>Requested</span>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary rounded btn-sm">
                                        <span>Follow</span>
                                    </button>
                                @endif
                            </form>
                        @else
                            <a href="{{ route('profile.edit') }}" class="badge bg-primary rounded-pill text-decoration-none">profile</a>
                        @endif
                    </div>

                </li>
            @endforeach
        </ul>

    </div>

@endsection
