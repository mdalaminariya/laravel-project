@extends('layouts.dashboardmaster')

@section('title')
    Show Request / D A S H T R A P
@endsection

@section('content')

<x-breadCum catdog="Request Show Page..!"></x-breadCum>

<div class="row my-5">
   @foreach ($requests as $req)
     <div class="col-lg-3 col-xl-4">
         <!-- Simple card -->
         <div class="card">
            @if ($req->oneuser->image == 'CatDog.jpg')

            <img style="height:100%;width:100%;" class="card-img-top img-fluid" src="{{ asset('upload/default') }}/{{ $req->oneuser->image }}" alt="Card image cap">

            @else

            <img  style="height:100%;width:100%;" class="card-img-top img-fluid" src="{{ asset('upload/profile') }}/{{ $req->oneuser->image }}" alt="Card image cap">

            @endif
            <div class="card-body">
                 <h5 class="card-title">{{ $req->oneuser->name }}</h5>
                 <p class="card-text">{{ $req->feedback }}.</p>
                 <a href="{{ route('request.accept',$req->id) }}" class="btn btn-primary waves-effect waves-light">Accept</a>
                 <a href="{{ route('request.reject',$req->id) }}" class="btn btn-danger waves-effect waves-light">Reject</a>
             </div>
         </div>
     </div>
   @endforeach
</div>

@endsection


@section('script')

@if (session('accept_success'))
<script>
    Toastify({
    text: "{{ session('accept_success') }}",
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
