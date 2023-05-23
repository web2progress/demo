<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ env('APP_NAME') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="/admin/dashboard">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li
            class="{{ last(request()->segments()) == 'blog-post' ||
            last(request()->segments()) == 'blog-category' ||
            last(request()->segments()) == 'blog-tag' ||
            last(request()->segments()) == 'blog-draft' ||
            //   last(request()->segments()) == 'blog-modals' ||
            last(request()->segments()) == 'blog-comments' ||
            last(request()->segments()) == 'blog-recycler-bin'
                ? 'mm-active'
                : '' }} ">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Blogs <span
                        class="badge bg-primary">{{ \App\Models\BlogPost::where('status', 'draft')->count() }}</span>
                </div>
            </a>
            <ul
                class=" {{ last(request()->segments()) == 'blog-post' ||
                last(request()->segments()) == 'blog-category' ||
                last(request()->segments()) == 'blog-tag' ||
                //   last(request()->segments()) == 'blog-modals' ||
                last(request()->segments()) == 'blog-draft' ||
                last(request()->segments()) == 'blog-comments' ||
                last(request()->segments()) == 'blog-recycler-bin'
                    ? 'mm-collapse mm-show'
                    : '' }}">

                <li><a href="{{ route('blog-post.index') }}"
                        class="{{ last(request()->segments()) == 'blog-post' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i>Post</a>
                </li>
                <li><a href="{{ route('blog-category.index') }}"
                        class="{{ last(request()->segments()) == 'blog-category' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i>Categories</a>
                </li>
                <li><a href="{{ route('blog-tag.index') }}"
                        class="{{ last(request()->segments()) == 'blog-tag' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i>Tags</a>
                </li>
                {{-- <li><a href="{{ route('blog-modals.index') }}"
                       class="{{ last(request()->segments()) == 'blog-modas' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i>Modals</a>
                </li> --}}
                <li><a href="{{ route('blog-post.draft') }}"
                        class="{{ last(request()->segments()) == 'blog-draft' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i>Draft</a>
                </li>
                <li><a href="{{ route('blog-post.recycler-bin') }}"
                        class="{{ last(request()->segments()) == 'blog-recycler-bin' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i>Recycler Bin</a>
                </li>
                <li><a href="{{ route('blog-post.comments') }}"
                        class="{{ last(request()->segments()) == 'blog-comments' ? 'link-active' : '' }}"><i
                            class="bx bx-right-arrow-alt"></i> Comments <span class="ml-2 badge rounded-pill bg-danger">
                            {{ App\Models\Comment::where('status', '0')->count() }}
                        </span>

                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ url('/admin/create-page') }}">
                <div class="parent-icon"><i class='lni lni-files'></i>
                </div>
                <div class="menu-title">Create Page</div>
            </a>
        </li>



        {{-- front plans --}}

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-layout'></i>
                </div>
                <div class="menu-title">PLANS</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('plans.index') }}"><i class="bx bx-right-arrow-alt"></i>Website Plans</a>
                </li>

                <li>
                    <a href="{{ url('/customers') }}"> <i class="bx bx-right-arrow-alt"></i> Customers </a>
                    </li>
            </ul>
        </li>

       {{-- end plans --}}


        <li class="menu-label">Menu/Social/Slider</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-layout'></i>
                </div>
                <div class="menu-title">Header</div>
            </a>
            <ul>
                <li>
                    <a href="{{ url('/admin/manage-menu') }}"><i class="bx bx-right-arrow-alt"></i>Menu Management</a>
                </li>
                <li>
                    <a href="{{ url('/admin/media-&-icons') }}"><i class="bx bx-right-arrow-alt"></i>Media & Icons</a>
                </li>
                <li>
                    <a href="{{ route('manage-slider.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage slider</a>
                </li>

            </ul>
        </li>

        <li class="menu-label">Gallery</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-layout'></i>
                </div>
                <div class="menu-title">Gallery</div>
            </a>
            <ul>
                <li>
                    <a href="{{ url('/admin/create-album') }}"><i class="bx bx-right-arrow-alt"></i>Create Album</a>
                </li>
                <li>
                    <a href="{{ url('/admin/manage-gallery') }}"><i class="bx bx-right-arrow-alt"></i>Manage
                        Gallery</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="{{ url('/admin/news-latter') }}">
                <div class="parent-icon"><i class="lni lni-blackboard"></i></div>
                <div class="menu-title">News Latter</div>
            </a>
        </li>

        <li class="menu-label">All Enquiry</li>
        <li>
            <a href="{{ url('/admin/new-connection') }}">
                <div class="parent-icon"><i class="lni lni-envelope"></i>
                </div>
                <div class="menu-title"> Enquiry <span
                        class="badge bg-primary ml-2"> {{ \App\Models\StoreEnquiry::count() }} </span>
                </div>
            </a>
            <ul>
                {{-- <li>
                    <a href="{{ url('/admin/new-connection') }}"><i class="bx bx-right-arrow-alt"></i>New Connection <span class="badge bg-primary ml-2"> {{ \App\Models\StoreEnquiry::count() }} </span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="{{ url('/admin/upgrade-connection') }}"><i class="bx bx-right-arrow-alt"></i> Upgrade
                        Connection <span
                            class="badge bg-primary ml-2"> {{ \App\Models\ConnectionUpgrade::where('status', 'pending')->count() }} </span></a>
                </li>
                <li>
                    <a href="{{ url('/admin/active-connection') }}"><i class="bx bx-right-arrow-alt"></i> Active
                        Connection <span
                            class="badge bg-primary ml-2"> {{ \App\Models\ConnectionCurrent::count() }} </span></a>
                </li> --}}

            </ul>
        </li>

        {{-- <li>
            <a href="{{url('/admin/enquiry-details')}}">
                <div class="parent-icon"><i class="lni lni-envelope"></i></div>
                <div class="menu-title">All Enquiry</div>
            </a>
        </li> --}}
        <li>
            <a href="#" class="cacheClear">
                <div class="parent-icon"><i class="lni lni-spinner"></i></div>
                <div class="menu-title">Cache Clear</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
