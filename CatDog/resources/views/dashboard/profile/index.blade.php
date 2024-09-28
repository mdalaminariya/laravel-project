@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-xl-6">
       {{-- name Update massage start --}}
       @if (session('name_update'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{session('name_update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

       @endif
       {{-- name update massage end --}}

       {{-- name update start --}}
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Name Update</h5>

                <form action="{{ route('home.profile.name.update') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="name" type="text" class="form-control @error('name')
                            is-invalid
                        @enderror " id="floatingnameInput" placeholder="Enter Name" >
                        <label for="floatingnameInput">Name</label>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    {{-- name update end --}}

    {{-- email update massage start --}}
    <div class="col-xl-6">
       {{-- name Update start --}}
       @if (session('email_update'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{session('email_update')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

       @endif
       {{-- email update massage end --}}

       {{-- email update start --}}
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Email Update</h5>

                <form action="{{ route('home.profile.email.update') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="email" type="text" class="form-control @error('email')
                            is-invalid
                        @enderror " id="floatingnameInput" placeholder="Enter Email">
                        <label for="floatingnameInput">Email</label>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    {{-- email update end --}}

    {{-- password update  massage start --}}
    <div class="col-xl-6">
        {{-- password Update start --}}
        @if (session('password_update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
         <i class="mdi mdi-check-all me-2"></i>
         {{session('password_update')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>

        @endif
        {{-- password update massage end --}}

        {{-- password update start --}}
         <div class="card">
             <div class="card-body">
                 <h5 class="header-title">Password Update</h5>

                 <form action="{{ route('home.profile.password.update') }}" method="post">
                     @csrf
                     <div class="form-floating mb-3">
                         <input name="current_password" type="password" class="form-control @error('current_password')
                             is-invalid
                         @enderror " id="floatingnameInput" placeholder="Enter  Password" >
                         <label for="floatingnameInput">Current Password</label>
                         @error('current_password')
                             <p class="text-danger">{{ $message }}</p>
                         @enderror
                     </div>
                     <div class="form-floating mb-3">
                         <input name="password" type="password" class="form-control @error('password')
                             is-invalid
                         @enderror " id="floatingnameInput" placeholder="Enter password" >
                         <label for="floatingnameInput">New Password</label>
                         @error('password')
                             <p class="text-danger">{{ $message }}</p>
                         @enderror
                     </div>
                     <div class="form-floating mb-3">
                         <input name="password_confirmation" type="password" class="form-control @error('password_confirmation')
                             is-invalid
                         @enderror " id="floatingnameInput" placeholder="Enter Confirm Password">
                         <label for="floatingnameInput">Confirm Password</label>

                     </div>
                     <div>
                         <button type="submit" class="btn btn-primary w-md">Submit</button>
                     </div>
                 </form>
             </div>
             <!-- end card body -->
         </div>
         <!-- end card -->
     </div>
    {{-- password update end --}}

    {{-- image Update massage start --}}
    <div class="col-xl-6">
        @if (session('image_update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
         <i class="mdi mdi-check-all me-2"></i>
         {{session('image_update')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>

        @endif
        {{-- image update massage end --}}

        {{-- image update start --}}
         <div class="card">
             <div class="card-body">
                 <h5 class="header-title">Image Update</h5>

                 <form action="{{ route('home.profile.image.update') }}" method="Post" enctype="multipart/form-data">
                     @csrf
                     <div class="form-floating mb-3">
                         <input name='image' type='file' class="form-control @error('image')
                             is-invalid
                         @enderror " id="floatingnameInput" >
                         <label for="floatingnameInput">Image</label>
                         @error('image')
                             <p class="text-danger">{{ $message }}</p>
                         @enderror
                     </div>
                     <div>
                         <button type="submit" class="btn btn-primary w-md">Submit</button>
                     </div>
                 </form>
             </div>
             <!-- end card body -->
         </div>
         <!-- end card -->
     </div>
    {{-- image update end--}}
</div>

@endsection
