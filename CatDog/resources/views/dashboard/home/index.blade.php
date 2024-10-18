@extends('layouts.dashboardmaster')

@section('title')
    Home / D A S H T R A P
@endsection

@section('content')
<x-breadCum catdog="Home Page"></x-breadCum>
    <h1 class="d-flex justify-content-center">Welcome to CatDog Page</h1>


    @if (auth()->user()->role == 'user')
        <div class="row">
            @if (!$request)
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">If you want to be a blogger then sent Request.!</h4>

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <i class="mdi mdi-help-circle me-1 text-primary"></i>  Do you want promotion user to Blogger.?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">

                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="header-title mb-3">Request form</h4>

                                                        <form role="form" action="{{ route('request.send',Auth::user()->id) }}" method="post">
                                                            @csrf
                                                            <div class="row mb-3">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Feedback</label>
                                                                <div class="col-sm-9">
                                                                    <textarea type="text" class="form-control" id="inputEmail3" name="feedback" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="justify-content-end row">
                                                                <div class="col-sm-9">
                                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Send Request</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            @endif
        </div>
    @endif
@endsection

@section('script')

@if (session('Success'))
<script>
    Toastify({
    text: "{{ session('Success') }}",
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
