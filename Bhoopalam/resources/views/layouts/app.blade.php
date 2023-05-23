<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
  <!--favicon-->
  <link rel="icon" href="{{asset('frontend/images/favicon.png')}}" type="image/png" />
    @include('frontend.layouts.header')
    <!-- Scripts -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
{{-- header --}}
@include('frontend.layouts.navbar')
{{-- content --}}
@yield('content')
{{-- script --}}
{{-- footer credit --}}
@include('frontend.layouts.footer')
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
