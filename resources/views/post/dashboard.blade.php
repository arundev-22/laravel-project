@extends('layout.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-10 m-auto">
            @foreach($posts as $post)
                <div class="card position-relative">
                    <div class="card-header d-flex justify-content-between w-100 bg-transparent border-0 text-start position-absolute mb-3">
                        <span class="d-flex align-items-center fw-bold  text-white bg-dark bg-opacity-50 rounded px-1">
                            <img src="/images/user.jpeg" alt="" width="25" height="25" class="rounded-circle me-1">
                            {{ $post->user->name }}
                        </span>
                        <div class="dropdown">
                            <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/images/menu-bttn.png" alt="Menu Btn" width="30" height="30" class="rounded-circle">
                            </button>
                            @if(Auth::check() && Auth::id() === $post->user_id)
                                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 70px;">
                                    <li>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger text-center">
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
                    @endif

                    <div class="card-body ms-2 mt-4">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->content }}</p>
                        <div class="d-flex">
                            <div class="dropdown dropdown-list">
                                <img src="/images/comment.png" alt="Comment Btn" width="45" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <div class="dropdown-menu comments-list border-top pt-1 overflow-y-auto flex-grow-1 p-2" style="max-height: 200px; min-width: 280px;">
                                    @forelse($post->comments as $comment)
                                        <div class="d-flex align-items-start mb-1 p-1 bg-light rounded text-dark text-start">
                                            <img src="/images/user.jpeg" alt="User Profile" width="20" height="20" class="me-2 rounded-circle">
                                            <div>
                                                <span class="fw-bold d-block small">{{ $comment->user->name ?? 'Anonymous' }}</span>
                                                <span>{{ $comment->body }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-muted small text-center p-2">No comments yet.</div>
                                    @endforelse
                                </div>
                            </div>

                            <form action="{{ route('comment.store', $post->id) }}" method="POST" class="d-flex align-items-center me-2" style="min-width: 50vw;">
                                @csrf 
                                <input type="text" name="body" class="form-control me-2" placeholder="Write a comment..." required>
                                <button type="submit" class="btn btn-success">Comment</button>
                            </form>
                        </div>
                    </div>           
                </div>
            @endforeach
        </div>
    </div>

@endsection