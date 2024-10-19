@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Edit Form</h4>

                <form role="form" action="{{ route('category.update',$category->slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title')
                            is-invalid
                        @enderror" id="inputEmail3" placeholder="Title" name="title" value="{{ $category->title }}">
                        </div>
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Slug" name="slug" value="{{ $category->slug }}">
                        </div>
                    </div>

                    <div class="row mb-3"  style="padding-left: 35%">
                        <div class="col-sm-9">
                            <img id="catDog" src="{{ asset('upload/category') }}/{{ $category->image }}" style="width:100%; height:100%;">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">
                            <input type="file" onchange="document.querySelector('#catDog').src = window.URL.createObjectURL(this.files[0])" class="form-control @error('image') is-invalid @enderror" id="inputPassword5" name="image">
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9" style="padding-left: 20%">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
