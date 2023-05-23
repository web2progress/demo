      <!-- Search Form Start -->
      <!-- Search Form End -->
      <!-- Social Follow Start -->
      <div class="sticky-side">
 <!-- social media  -->
 <div class="category">
    <span class="m-category">Social Media</span>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="side-social d-flex justify-content-left">
            <a target="_blank" href="https://www.facebook.com/sspathakpcs/">
                <img src="{{ asset('frontend/images/facebook.svg') }}" alt="facebook icon"
                    class="img-fluid">
                Facebook
            </a>
            <a target="_blank" href="https://twitter.com/SHYAMSU92855828">
                <img src="{{ asset('frontend/images/twitter.svg') }}" alt="facebook icon"
                    class="img-fluid">
                Twitter
            </a>
        </div>
        <div class="side-social d-flex justify-content-left">
            <a target="_blank" target="_blank" href="https://www.instagram.com/pathakshyamsundar/">
                <img src="{{ asset('frontend/images/Instagram.svg') }}" alt="facebook icon"
                    class="img-fluid"> Instagram
            </a>
            <a target="_blank" href="https://api.whatsapp.com/send?phone=+919760800271&text=Hello..!">
                <img src="{{ asset('frontend/images/whatsapp.svg') }}" alt="facebook icon"
                    class="img-fluid">
                What's App
            </a>
        </div>
    </div>
</div>
<!-- category  -->
<div class="category mt-5">
    <span class="m-category">My category</span>
</div>
<div class="row" data-aos="flip-right">
    <div class="col-12">
        <div class="side-cat">
            @if (!empty($categories))
                @foreach ($categories as $Cat)
                    <a href="/categories/{{ $Cat->slug }}">{{ $Cat->title }}
                        <!-- count publice post bu status  -->
                        <span class="countDta">
                            {{ \App\Models\BLogPost::where('categories', 'LIKE', '%' . $Cat->id . '%')->where('status', 'publish')->count() }}
                        </span>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- latest  -->
<div class="mt-5">
    <h4 class="category"> <span class="m-category">Latest Post</span> </h4>
</div>
@foreach (\App\Models\BlogPost::where('status', 'publish')->orderBy('id', 'DESC')->take('5')->get() as $post)
<a href="{{ url('') }}/post/{{ $post->slug }}">
    <div class="card mt-3">
        <div class="row" data-aos="flip-right">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <img class="img-fluid w-100"
                    src="{{ $post->thumbnail ? $post->thumbnail : url('images/thumbnail.jpg') }}"
                    alt="{{ $post->title }}">
            </div>
            <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                <h4 class="h6">{{ $post->title }}</h4>
                <span>{{ $post->created_at->format('d-M-Y') }} <small
                        class="float-end badge badge-success mr-2"> <span class="fas fa-eye"></span>
                        {{ $post->view }}</small></span>
            </div>
        </div>
    </div>
</a>
@endforeach
<!-- ads  -->
      </div>
