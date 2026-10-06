<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/nav.jpeg') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .modal-backdrop.fade { 
                opacity: 0 !important;
            }
    </style>
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"                      
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-start">
                    <img src="/images/nav.jpeg" alt="" width="45">
                    <span class="fs-2 ms-2 fw-bold">Eloquent</span>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar me-1" data-simplebar="">
                    <ul id="sidebarnav" style="padding: 0px;">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('post.home') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('post.dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Posts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('post.user') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link nav-icon-hover" href="{{ route('follow.requests') }}">
                                <i class="ti ti-bell-ringing"></i>
                                
                                @if(isset($pendingFollowRequestsCount) && $pendingFollowRequestsCount > 0)
                                    <div class="notification bg-primary rounded-circle">
                                        <span class="badge bg-danger rounded-circle text-white position-absolute" 
                                            style="font-size: 0.6rem; top: 5px; right: 5px; padding: 0.25em 0.4em;">
                                            {{ $pendingFollowRequestsCount }}
                                        </span>
                                    </div>
                                @endif
                            </a>
                        </li>
                    </ul>
                    
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                  
                            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPostModal">
                                Add Post
                            </button>

                            <div class="modal fade" id="addPostModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addPostModalLabel">Create New Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <form id="myForm" action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}">
                                                    @error('title')
                                                        <span class="text-xs font-medium text-red-600 mt-1 block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content</label>
                                                    <textarea id="content" class="form-control" name="content" rows="3">{{ old('content') }}</textarea>
                                                    @error('content')
                                                        <span class="text-xs font-medium text-red-600 mt-1 block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" id="image" class="form-control" name="image" accept="image/*">
                                                </div>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit Post</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('profile.edit') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-6">My Profile</p>
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">
                                            @csrf
                                        </form>
                                        <a class="btn btn-outline-primary mx-3 mt-2 d-block" href="{{ route('logout') }}" 
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="container-fluid">
                <div class="d-flex justify-content-center flex-shrink-0">
                    @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show bg-success bg-opacity-50 w-50 d-flex flex-column  justify-content-center align-items-center" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    @yield('content')
                </div>
                <div class="mb-0 py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design by Arun</p>
                </div>
            </div>
        </div>
        
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    
                    setTimeout(() => alert.remove(), 500); 
                }, 3000); 
            }
        });
    </script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    @if ($errors->any())
    <script>
        $(document).ready(function () {
            $('#addPostModal').modal('show');
        });
    </script>
    @endif
</body>
</html>