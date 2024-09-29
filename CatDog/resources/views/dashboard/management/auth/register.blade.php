@extends('layouts.dashboardmaster')

@section('title')
    Management Registraion / D A S H T R A P
@endsection

@section('content')

<x-breadCum catdog="Management Registration  Page"></x-breadCum>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Role & User Registration</h4>

                <form role="form" action="{{ route('management.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name')
                            is-invalid
                        @enderror" id="inputEmail3" placeholder="Name" name="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('email')
                            is-invalid
                        @enderror" id="inputPassword3" placeholder="Email" name="email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">User Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password')
                                is-invalid
                            @enderror" id="inputPassword5" placeholder="Password"  name="password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">User Role</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-select">
                                <option value=""> Select User Role </option>
                                <option value="manager"> Manager </option>
                                <option value="blogger"> Blogger </option>
                                <option value="user"> User </option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
        <div class="card-body">
            <h4 class="header-title">Manager's Table</h4>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            @if (Auth::user()->role == 'admin')

                            <th>Status</th>
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($managers as $manager)

                        <tr>
                            <th scope="row">
                                {{ $loop->index + 1 }}
                            </th>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->role }}</td>
                            @if (Auth::user()->role == 'admin')

                            <td>
                                <form id="CatDog{{ $manager->id }}" action="{{ route('management.down',$manager->id) }}" method="post">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#CatDog{{ $manager->id }}').submit()"   class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $manager->role == $manager->role ? 'checked' : '' }}>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a href="" class="btn btn-info btn-sm" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="" class="btn btn-danger btn-sm" >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
        </div>
    </div>
    </div>

</div>


@endsection

@section('script')

@if (session('register_complete'))
<script>
    Toastify({
    text: "{{ session('register_complete') }}",
    duration: 5000,
    newWindow: true,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "center", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
        background: "linear-gradient(to right, #008B8B, #D8BFD8)",
    },
    onClick: function(){} // Callback after click
    }).showToast();
</script>
@endif

@endsection
