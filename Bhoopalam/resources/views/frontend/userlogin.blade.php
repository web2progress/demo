@extends('layouts.app')
@section('title', 'About Us')
@section('header')
@parent
<style>
    .formcontainer{
        display: flex;
        justify-content: center;
    }
</style>
<!-- external  -->
<link rel="stylesheet" href="{{asset('assets/f-book/css/style.css')}}">
@endsection
@section('content')

<div class="formcontainer">
    <div class="header">

    </div>
<form action="{{url('/userloginverify')}}" class="col-8 border p-4 " method="post">
    @csrf
    <div class="mb-3 mt-3 ">
      <label for="Number" class="form-label">Number</label>
      <input type="number"    class="form-control " id="email" placeholder="Enter Your Number" name="mobile" required     >
    </div>

    <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>




{{-- checking alternate login --}}




@endsection
@section('footer')
@parent

@endsection
