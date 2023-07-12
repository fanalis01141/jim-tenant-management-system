@extends('layouts/contentNavbarLayout')

@section('title', 'Add New Tenant - ')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="row">

            <div class="col-md-6">
                <div class="card p-1">
                    <div class="card-header">
                        <h4 class="card-title">Editing Information of User: {{ucwords($user->name)}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <form method="POST" action="{{ route( 'user.update' , $user->id) }}">
                            @csrf
                            @method('PUT')
                        
                            <div class="row mb-3">

                                <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Name') }}</label>
                        
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <div class="col-md-12 text-start">
                                    <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                            </div>
                        
                            <div class="row mb-3">
                                <label for="level" class="col-md-12 col-form-label text-md-start">{{ __('Level') }}</label>
                        
                                <div class="col-md-12">
                                    <select name="level" id="level" class="form-control" required>
                                        <option value="" selected disabled>Select a role for user</option>
                                        <option value="admin" class="form-control" {{ $user->level === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="encoder" class="form-control" {{ $user->level === 'encoder' ? 'selected' : '' }}>Encoder</option>
                                        <option value="viewer" class="form-control" {{ $user->level === 'viewer' ? 'selected' : '' }}>Viewer</option>
                                    </select>
                                
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                        
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                        
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter new password.">
                        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-12 col-form-label text-md-start">{{ __('Confirm Password') }}</label>
                        
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm new password.">
                                </div>
                            </div>
                        
                            <div class="row mb-0">
                                <div class="col-md-12 text-center d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Update Account') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card  p-1">
                    <div class="card-header">
                        <div class="card-title"><h4>List of Users</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 485px; overflow-y: auto; height: 485px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Access Level</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ucwords($user->name) }}                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{ucwords($user->level)}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('user/' . $user->id . '/edit') }}"><i class="bx bx-edit-alt me-2"></i>Edit</a>
                                                    <a class="dropdown-item" onclick="deleteUser({{$user->id}})" data-id="{{$user->id}}" href="#"><i class="bx bx-trash me-2"></i>Delete</a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach                               
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

function deleteUser(userId) {
    swal({
        title: "Delete User?",
        text: "Once deleted, you will not be able to restore this user",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
    if (willDelete) {
            fetch('/user/'+userId, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
                }).then(response => {
                    swal({
                    title: "Deleted User",
                    text: "You will be redirected to your dashboard.",
                    icon: "success",
                    button: "OK",
                }).then(() => {
                    window.location.href = "/";
                });
            });
        }
    });
}


</script>
  
