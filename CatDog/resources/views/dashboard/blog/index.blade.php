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

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light" style="padding-left: 120px">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category Title</th>
                            <th>Status</th>
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
                            <td>{{ $blog->onecategory->title }}</td>
                            <td>

                                 <form id="CatDog{{ $blog->id }}" action="{{ route('blog.status',$blog->id) }}" method="post">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input onchange="document.querySelector('#CatDog{{ $blog->id }}').submit()"   class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $blog->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-info btn-sm" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                     <button type="submit" class="btn btn-info btn-sm text-danger" style="margin-top: 5px">
                                         <i class="fa-solid fa-trash"></i>
                                     </button>
                                 </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{ $blogs->links() }}
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
