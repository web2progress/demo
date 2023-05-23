@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@section('header-link')
    @parent
    {{-- custom link --}}
@endsection
@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <a href="{{ url('/admin/blog-post') }}">
                    <div class="card radius-10 bg-gradient-deepblue">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">Active :
                                    {{ App\Models\BlogPost::where('status', 'publish')->count() }}
                                </h5>
                                <div class="ms-auto">
                                    <i class='lni lni-grid fs-3 text-white'></i>
                                </div>
                            </div>
                            @php
                                $totalBlog = App\Models\BlogPost::count();
                                $rdBlog = App\Models\BlogPost::wherein('status', ['draft','recyclebin'])->count();
                                $percentage = 100-(100/(($totalBlog !='' ?$totalBlog:50)/ ($rdBlog!='' ?$rdBlog:50)));
                            @endphp
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Blogs</p>
                                <p class="mb-0 ms-auto">{{ $totalBlog }}<span><i
                                            class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                            <small class="badge bg-primary"><i class="text-light">In RecycleBin :
                                    {{ App\Models\BlogPost::where('status', 'recyclebin')->count() }}</i></small>
                                    <small class="badge bg-primary"><i class="text-light">In Draft :
                                    {{ App\Models\BlogPost::where('status', 'draft')->count() }}</i></small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ url('/admin/blog-comments') }}">
                    <div class="card radius-10 bg-gradient-orange">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">
                                    {{ App\Models\Comment::where('status', 'active')->count() }}
                                </h5>
                                <div class="ms-auto">
                                    <i class='lni lni-grid-alt fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Comment</p>
                                <p class="mb-0 ms-auto">
                                    {{ App\Models\Comment::where('status', 'active')->count() }}<span><i
                                            class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                            <small class="badge bg-primary"><i class="text-light">Pending Approval:
                                    {{ App\Models\Comment::where('status', 'inactive')->count() }}</i></small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ url('/admin/products') }}">
                    <div class="card radius-10 bg-gradient-ibiza">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 text-white">
                                    {{ App\Models\Product::where('status', 'publish')->count() }}
                                </h5>
                                <div class="ms-auto">
                                    <i class='lni lni-indent-decrease fs-3 text-white'></i>
                                </div>
                            </div>
                            <div class="progress my-3 bg-light-transparent" style="height:3px;">
                                <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <p class="mb-0">Total Product</p>
                                <p class="mb-0 ms-auto">
                                    {{ App\Models\Product::count() }}<span><i
                                            class='bx bx-up-arrow-alt'></i></span></p>
                            </div>
                            <small class="badge bg-primary"><i class="text-light"> In Draft:
                                {{ App\Models\Product::where('status', 'draft')->count() }}</i></small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--end row-->
    </div>
@endsection
@section('footer-script')
    @parent
    <script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
@endsection
