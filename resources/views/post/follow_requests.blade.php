@extends('layout.dashboard') 

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">Follow Requests</h4>
            </div>
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if($requests->isEmpty())
                    <p class="text-muted mb-0">You have no pending follow requests.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($requests as $requestingUser)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <strong>{{ $requestingUser->name }}</strong> 
                                    <span class="text-muted"> wants to follow you</span>
                                </div>
                                <div class="d-flex gap-2">
                                    {{-- Approve Button Form --}}
                                    <form action="{{ route('follow.approve', $requestingUser->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm rounded-pill">Approve</button>
                                    </form>

                                    {{-- Reject Button Form --}}
                                    <form action="{{ route('follow.reject', $requestingUser->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">Reject</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
