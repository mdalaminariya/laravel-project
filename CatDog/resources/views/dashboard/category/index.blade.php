@extends('layouts.dashboardmaster')

@section('title')
    Category / D A S H T R A P
@endsection

@section('content')

<x-breadCum catdog="Category Show  Page"></x-breadCum>

<div class="row">
    <div class="col-lg-6">
        <div class="card-body">
            <h4 class="header-title">Category Table</h4>
            <p class="sub-header">

            </p>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)

                        <tr>
                            <th scope="row">
                                {{ $loop->index + 1 }}
                            </th>
                            <td>
                                <img src="{{ asset('upload/category') }}/{{ $category->image }}" style="width: 80px" height="80px">
                            </td>
                            <td>{{ $category->title }}</td>
                            <td>
                                <form id="CatDog{{ $category->id }}" action="{{ route('category.status',$category->slug) }}" method="post">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#CatDog{{ $category->id }}').submit()"   class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $category->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('category.edit',$category->slug) }}" class="btn btn-info btn-sm" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('category.delete',$category->slug) }}" class="btn btn-danger btn-sm" style="margin-top: 5px">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
        </div>
    </div>


    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Insert Form</h4>

                <form role="form" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title')
                            is-invalid
                        @enderror" id="inputEmail3" placeholder="Title" name="title">
                        </div>
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Slug" name="slug">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control @error('image')
                                is-invalid
                            @enderror" id="inputPassword5" name="image">
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
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
</div>

@endsection

@section('script')

@if (session('category_success'))
<script>
    Toastify({
    text: "{{ session('category_success') }}",
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
