@extends('layouts.dashboardmaster')

@section('title')
    Management Role Update / D A S H T R A P
@endsection

@section('content')

<x-breadCum catdog="Management Role Update  Page"></x-breadCum>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Exist User Role Management</h4>

                <form role="form" action="{{ route('management.role.assign') }}" method="post">
                    @csrf

                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Manage Role</label>
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
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Manage User's</label>
                        <div class="col-sm-9">
                            <select name="user_id" class="form-select">
                                <option value=""> Select User Role </option>
                                @foreach ($users as $user)

                                <option value="{{$user->id}}"> {{ $user->name }} </option>

                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
        <div class="card-body">
            <h4 class="header-title">User's Table</h4>

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
                        @forelse ($users as $user)

                        <tr>
                            <th scope="row">
                                {{ $loop->index + 1 }}
                            </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            @if (Auth::user()->role == 'admin')

                            <td>
                                <form id="CatDog{{ $user->id }}" action="{{ route('management.role.user.down',$user->id) }}" method="post">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#CatDog{{ $user->id }}').submit()"   class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $user->role == $user->role ? 'checked' : '' }}>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a href="" class="btn btn-info btn-sm" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('management.role.user.delete',$user->id) }}" class="btn btn-danger btn-sm" >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">Sorry can't found any User.! </td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
        </div>
    </div>
</div>

    <div class="col-lg-6">
        <div class="card">
        <div class="card-body">
            <h4 class="header-title">Blogger's Table</h4>

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
                        @forelse ($bloggers as $blogger)

                        <tr>
                            <th scope="row">
                                {{ $loop->index + 1 }}
                            </th>
                            <td>{{ $blogger->name }}</td>
                            <td>{{ $blogger->role }}</td>
                            @if (Auth::user()->role == 'admin')

                            <td>
                                <form id="CatDog{{ $blogger->id }}" action="{{ route('management.role.blogger.down',$blogger->id) }}" method="post">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#CatDog{{ $blogger->id }}').submit()"   class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $blogger->role == $blogger->role ? 'checked' : '' }}>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a href="" class="btn btn-info btn-sm" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('management.role.blogger.delete',$blogger->id) }}" class="btn btn-danger btn-sm" >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-danger text-center">Sorry can't found any Blogger.! </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
        </div>
    </div>
</div>


</div>

@endsection


@section('script')

@if (session('AssignRoll_complete'))
<script>
    Toastify({
    text: "{{ session('AssignRoll_complete') }}",
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

