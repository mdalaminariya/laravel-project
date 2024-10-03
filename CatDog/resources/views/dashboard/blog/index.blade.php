@extends('layouts.dashboardmaster')
@section('title')
Blog/Show/D A S H T R A P
@endsection
@section('content')

<x-breadCum catdog="Blog's Show  Page"></x-breadCum>


<div class="row">
    <div class="col-lg-12">
        <div class="card-body">
            <h4 class="header-title">Blog's Table</h4>
            <p class="sub-header">

            </p>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light" style="padding-left: 120px">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)

                        <tr>
                            <th scope="row">
                                {{ $loop->index + 1 }}
                            </th>
                            <td>
                                <img src="{{ asset('upload/blog') }}/{{ $blog->thumbnail }}" style="width: 80px" height="80px">
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>
                                {!! $blog->description !!}

                                {{-- <form id="CatDog{{ $blog->id }}" action="{{ route('category.index.status',$blog->slug) }}" method="post">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#CatDog{{ $blog->id }}').submit()"   class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                      </div>
                                </form> --}}
                            </td>
                            <td>
                                <a href="{{ route('category.index.edit',$blog->slug) }}" class="btn btn-info btn-sm" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('category.index.delete',$blog->slug) }}" class="btn btn-danger btn-sm" >
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

</div>

@endsection

@section('script')
@if (session('Blog_success'))
<script>
    Toastify({
    text: "{{ session('Blog_success') }}",
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
