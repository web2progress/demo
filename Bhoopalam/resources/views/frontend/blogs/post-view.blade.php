@extends('layouts.app')
@section('title', 'Bhagya-Mitra : ' . $posts->title)
@section('header')
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="pingback" href="/" />
    <meta name="description" content="{{ $posts->description }}" />
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
    <link rel="canonical" href="{{ url('') }}/post/{{ $posts->slug }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $posts->title }}" />
    <meta property="og:description" content="{{ $posts->description }}" />
    <meta property="og:url" content="{{ url('') }}/post/{{ $posts->slug }}" />
    <meta property="og:site_name" content="{{url('')}}" />
    <meta property="article:publisher" content="{{url('')}}" />
    <meta property="article:author" content="MunnaPatel" />
    @foreach (explode(',', $posts->tags) as $tag)
        {{-- get row by each tag --}}
        <meta property="article:tag" content="{{ \App\Models\BlogTag::where('id', $tag)->value('title') }}" />
    @endforeach
    <meta property="article:section" content="Make Money Online" />
    <meta property="og:updated_time" content="2020-10-21T13:33:21+05:30" />
    <meta property="og:image" content="{{ $posts->thumbnail ? $posts->thumbnail : url('images/thumbnail.jpg') }}" />
    <meta property="og:image:secure_url"
        content="{{ $posts->thumbnail ? $posts->thumbnail : url('images/thumbnail.jpg') }}" />
    <meta property="og:image:width" content="696" />
    <meta property="og:image:height" content="385" />
    <meta property="og:image:alt" content="{{ $posts->title }}" />
    <meta property="og:image:type" content="image/png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $posts->title }}" />
    <meta name="twitter:description" content="{{ $posts->description }}" />
    <meta name="twitter:site" content="@mobipharma" />
    <meta name="twitter:creator" content="@prabhanjan92" />
    <meta name="twitter:image" content="{{ $posts->thumbnail ? $posts->thumbnail : url('images/thumbnail.jpg') }}" />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link href='https://fonts.gstatic.com' crossorigin rel='preconnect' />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/blog/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
    @parent
    <!-- css -->
    <style>
        /*--------------------------------------------------------------
                                                    # Alignments
                                                    --------------------------------------------------------------*/
        .alignleft {
            display: inline !important;
            float: left;
            margin-right: 1.5em;
        }

        .alignright {
            display: inline !important;
            float: right;
            margin-left: 1.5em;
        }

        .aligncenter {
            clear: both;
            display: block !important;
            margin-left: auto;
            margin-right: auto;
        }

        /* @foreach (config('app.colors') as $color)
        .has-{{ $color['slug'] }}-color {
            color: {!! $color['color'] !!};
        }

        .has-{{ $color['slug'] }}-background-color {
            background-color: {!! $color['color'] !!};
        }
        @endforeach
        */
    </style>
@endsection
@section('content')
    <!-- body  -->
    <div class="container post-full-container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-md-9 col-sm-12 col-12">
                <div class="content mt-4">
                    <h2> {{ $posts->title }}</h2>
                </div>
                <div class="contact">
                    <div class="side-social d-flex bd-highligh" data-aos="flip-right">
                        <a class="flex-fill bd-highligh" target="_blank" href="###">
                            <img src="{{ asset('frontend/images/facebook.svg') }}" alt="facebook icon" class="img-fluid">
                            Facebook
                        </a>
                        <a class="flex-fill bd-highligh" target="_blank" href="##">
                            <img src="{{ asset('frontend/images/twitter.svg') }}" alt="facebook icon" class="img-fluid">
                            Twitter
                        </a>
                        <a class="flex-fill bd-highligh" target="_blank" target="_blank" href="##">
                            <img src="{{ asset('frontend/images/Instagram.svg') }}" alt="facebook icon" class="img-fluid">
                            Instagram
                        </a>
                        <a class="flex-fill bd-highligh" target="_blank"
                            href="https://api.whatsapp.com/send?phone=+91888888888&text=Hello..!">
                            <img src="{{ asset('frontend/images/whatsapp.svg') }}" alt="facebook icon" class="img-fluid">
                            What's App
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <img class="img-fluid w-100"
                        src="{{ $posts->thumbnail ? $posts->thumbnail : url('images/thumbnail.jpg') }}"
                        alt="{{ $posts->title }}">
                </div>
                <!-- Blog Detail -->
                <div class="mt-2 mb-2">
                    <span class="btn btn-sm btn-default">
                        Published at: {{ $posts->created_at->format('d M Y') }}
                    </span>
                    <!-- content  -->
                    <div class="content w-100  post-content">
                        <div class="clear-fixed"></div>
                        {!! $posts->content !!}
                        <div class="clear-fixed"></div>
                    </div>
                    <!-- Tag -->
                    <div class="container">
                        <p class="f1-s-12 cl5 m-r-8 mt-4">
                            Category:
                            {{-- all category in foreachoop --}}
                            @if (!empty($posts->categories))
                                @foreach (explode(',', $posts->categories) as $postCat)
                                    {{-- get row by each category --}}
                                    @php
                                        $catData = \App\Models\BlogCategory::where('id', $postCat)->first();
                                    @endphp
                                    {{-- prient category --}}
                                    <a class="default-tag"
                                        href="/categories/{{ $catData->slug }}">{{ $catData->title }}</a>
                                @endforeach
                            @endif
                        </p>
                        <p class="f1-s-12 cl5 m-r-8">
                            Tags:
                            @if (!empty($posts->tags))
                                @foreach (explode(',', $posts->tags) as $tagid)
                                    {{-- get row by each tag --}}
                                    @php
                                        $tagdata = \App\Models\BlogTag::where('id', $tagid)->first();
                                    @endphp
                                    <span class="default-tag">{{ $tagdata->title }}</span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <!-- Share -->
                    <div id="doReply" class="share-outer mt-5 d-flex">
                        <div class="share_div"><i class="fas fa-share"></i><span></span>
                            <h4>Share</h4>
                        </div>
                        <div class="social_icons">
                            <a class="social-button"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ url('') }}/post/{{ $posts->slug }}">
                                <div class="facebook">
                                    <i class="fab fa-facebook"></i>
                                </div>
                            </a>
                            <a class="social-button"
                                href="https://www.linkedin.com/shareArticle?url={{ url('') }}/post/{{ $posts->slug }}">
                                <div class="linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </div>
                            </a>
                            <a class="social-button"
                                href="https://twitter.com/intent/tweet?text=जीवन की वर्णमाला&amp;url={{ url('') }}/post/{{ $posts->slug }}">
                                <div class="twitter">
                                    <i class="fab fa-twitter"></i>
                                </div>
                            </a>
                            <a class="social-button"
                                href="https://wa.me/?text= 👉 Please share this website with your friends - {{ url('') }}/post/{{ $posts->slug }}">
                                <div class="whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Leave a comment -->
                <!-- Main Body -->
                <section class="container-fluid pb-5">
                    <div class="post-comment container py-5">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-12 pb-4">
                                <h2>Comments</h2>
                                <div class="d-flex justify-content-center row">
                                    <div class="d-flex flex-column comment-section">
                                        @foreach ($getcomments as $comment)
                                            <div class="bg-white px-3">
                                                <div class="d-flex flex-row user-info"><img class="rounded-circle"
                                                        src="{{ asset('frontend/images/avtar.png') }}" width="50">
                                                    <div class="d-flex flex-column justify-content-start ml-2">
                                                        <span
                                                            class="d-block font-weight-bold name">{{ $comment->name }}</span><span
                                                            class="date text-black-50">commented on -
                                                            {{ $comment->created_at->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <p class="comment-text"> {{ $comment->comment }} </p>
                                                </div>

                                                <div class="bg-white">
                                                    <div class="d-flex flex-row fs-12 pl-4">
                                                        <div class="like p-2 cursor"><i class="fa fa-share"></i><span
                                                                class="ml-1">Reply</span></div>
                                                    </div>
                                                </div>
                                                <div class="px-2">
                                                    @if (auth()->user())
                                                        @if (auth()->user()->hasRole('admin'))
                                                            <form class="submitMultopost needs-validation"
                                                                action="javascript:void(0)" method="post" novalidate>
                                                                @csrf
                                                                <div class="d-flex flex-row align-items-start"><img
                                                                        class="rounded-circle"
                                                                        src="{{ asset('frontend/images/avtar-teply.png') }}"
                                                                        width="40">
                                                                    <input type="hidden" name="cid"
                                                                        value="{{ Illuminate\Support\Facades\Crypt::encrypt($comment->id) }}">
                                                                    <textarea name="reply_comment" class="form-control ml-1 shadow-none textarea" placeholder="Reply..." required>@if (!empty($comment->multiComment)){{ $comment->multiComment->comments }} @endif</textarea>
                                                                </div>
                                                                <div class="mt-2 d-flex justify-content-end">
                                                                    <button class="btn btn-primary btn-sm shadow-none"
                                                                        type="submit">
                                                                        Post Reply </button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    @else
                                                    @if (!empty($comment->multiComment))
                                                        <div class="pl-5">
                                                            <div class="mt-2">
                                                                <p class="comment-text">
                                                                    {{ $comment->multiComment->comments }} </p>
                                                            </div>
                                                            <span class="date text-black-50">Shared
                                                                publicly -
                                                                {{ $comment->multiComment->created_at->format('d M Y') }}</span>
                                                        </div>
                                                    @endif
                                                    @endif
                                                </div>


                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                                <!-- error alert  -->
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $error }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- success alert  -->
                                <form class="blog-comment card px-3" method="POST" id="algin-form" action="/comment">
                                    <h4 class="text-dark">Leave a comment</h4>
                                    @csrf
                                    <div class="forms-inputs mt-4">
                                        <span>Message*</span>
                                        <textarea name="comment" class="form-control" value="" rows="5" required=""></textarea>
                                    </div>
                                    <div class="forms-inputs mt-4">
                                        <span>Name*</span>
                                        <input type="text" name="name" class="form-control" value=""
                                            required="">
                                    </div>
                                    <div class="forms-inputs mt-4">
                                        <span>Email*</span>
                                        <input type="email" name="email" class="form-control" value=""
                                            required="">
                                    </div>
                                    <input type="hidden" name="id" value="  {{ $posts->id }}">
                                    <div class="form-group"> <button type="submit" id="post" class="btn">Post
                                            Comment</button> </div>
                                </form>
                                <!-- success alert  -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Sidebar -->
            <div class="col-xl-3 col-md-3 col-sm-12 mt-4">
                @include('frontend.blogs._sidebar')
            </div>
        </div>
    </div>
    {{-- Model apear --}}
    {{-- @if (!empty($posts->modal))
        <div id="popmodel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">{!! $posts->modal->title !!}</h5>
                        <button class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! $posts->modal->content !!}
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
    <!-- body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
    @parent
    {{-- <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('#popmodel').modal('show');
            }, 10000);
        })
    </script> --}}
    <!--================ End Footer Area =================-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        var popupSize = {
            width: 780,
            height: 550
        };
        $(document).on('click', '.social-button', function(e) {
            var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);
            var popup = window.open($(this).prop('href'), 'social',
                'width=' + popupSize.width + ',height=' + popupSize.height +
                ',left=' + verticalPos + ',top=' + horisontalPos +
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
            if (popup) {
                popup.focus();
                e.preventDefault();
            }
        });
        $('.submitMultopost').submit(function() {
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('post.comment.reply') }}",
                method: "post",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == true) {
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bx bx-check-circle',
                            msg: response.msg
                        });
                    } else {
                        Lobibox.notify('error', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bx bx-check-circle',
                            msg: response.msg
                        });
                    }
                }
            });
        });
    </script>
@endsection
