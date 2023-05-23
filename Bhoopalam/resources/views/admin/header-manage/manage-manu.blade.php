@extends('admin.layouts.layouts')
@section('title', 'Menu')
@section('header-link')
    @parent
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body.dragging,
        body.dragging * {
            cursor: move !important;
            list-style: circle;
        }

        .dragged {
            position: absolute;
            opacity: 0.7;
            z-index: 2000;
        }

        ol.example li.placeholder {
            position: relative;
            /** More li styles **/
        }

        ol.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }

        .placeholder {
            height: 100px;
        }
    </style>
@endsection

@section('content')
    @parent
    <!-- body code  -->
    <div class="container-fluid">
        <h2><span>Menus</span></h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="content info-box">
                    @if (count($menus) > 0)
                        Select a menu to edit:
                        <form action="{{ url('/admin/manage-menus') }}" class="form-inline" method="get">
                            <div class="input-group mb-3">

                                <select name="id" class="form-control">
                                    @foreach ($menus as $menu)
                                        @if ($desiredMenu != '')
                                            <option value="{{ $menu->id }}"
                                                @if ($menu->id == $desiredMenu->id) selected @endif>{{ $menu->title }}
                                            </option>
                                        @else
                                            <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="input-group-text" id="basic-addon1"><button
                                        class="btn btn-sm btn-default btn-menu-select">Select</button></span>
                            </div>
                        </form>
                        or
                    @endif

                </div>
            </div>
            <div class="col-sm-3">
                <a href="{{ url('/admin/manage-menus?id=new') }}">Create a new menu</a>.
            </div>

        </div>
    </div>
    <div class="container-fluid">
        <div class="row" id="main-row">


            <div class="col-sm-4 cat-form @if (count($menus) == 0) disabled @endif">
                <h3><span>Add Menu Items</span></h3>

                <div class="mt-5" id="menu-items">
                    <div class="card card-default">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#categories-list" aria-expanded="false" aria-controls="categories-list">
                                Categories
                            </button>
                        </h2>
                        <div id="categories-list" class="accordion-collapse collapse show" aria-labelledby="headingTwo">
                            <div class="card-body">
                                <div class="card-body">
                                    @foreach ($categories as $cat)
                                        <p><input type="checkbox" name="select-category[]" value="{{ $cat->id }}">
                                            {{ $cat->title }}</p>
                                    @endforeach
                                </div>
                                <div class="card-footer btn-group" role="group" aria-label="Basic example">
                                    <span class="btn btn-sm btn-default"><input type="checkbox" id="select-all-categories">
                                        Select All</span>
                                    <button type="button" class="btn btn-info btn-sm" id="add-categories">Add to Menu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default mt-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#posts-list" aria-expanded="false" aria-controls="posts-list">
                                Posts
                            </button>
                        </h2>
                        <div id="posts-list" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                            <div class="card-body">
                                <div class="card-body">
                                    @foreach ($posts as $post)
                                        <p><input type="checkbox" name="select-post[]" value="{{ $post->id }}">
                                            {{ $post->title }}</p>
                                    @endforeach
                                </div>
                                <div class="card-footer btn-group" role="group" aria-label="Basic example">
                                    <span class="btn btn-sm btn-default"><input type="checkbox" id="select-all-posts">
                                        Select All</span>
                                    <button type="button" id="add-posts" class=" btn btn-info btn-sm">Add to Menu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default mt-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pages-list" aria-expanded="false" aria-controls="pages-list">
                                Pages
                            </button>
                        </h2>
                        <div id="pages-list" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                            <div class="card-body">
                                <div class="card-body">
                                    @foreach ($pages as $page)
                                        <p><input type="checkbox" name="select-pages[]" value="{{ $page->id }}">
                                            {{ $page->title }}</p>
                                    @endforeach
                                </div>
                                <div class="card-footer btn-group" role="group" aria-label="Basic example">
                                    <span class="btn btn-sm btn-default"><input type="checkbox" id="select-all-pages">
                                        Select All</span>
                                    <button type="button" id="add-pages" class=" btn btn-info btn-sm">Add to Menu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default mt-2">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#custom-links" aria-expanded="false" aria-controls="custom-links">
                                Custom Link
                            </button>
                        </h2>
                        <div id="custom-links" class="accordion-collapse collapse show" aria-labelledby="headingThree">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <span>URL</span>
                                        <input type="url" id="url" class="form-control" placeholder="https://">
                                    </div>
                                    <div class="form-group">
                                        <span>Link Text</span>
                                        <input type="text" id="linktext" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class=" btn btn-info btn-sm" id="add-custom-link">Add to
                                        Menu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 cat-view">
               
                <h3><span>Menu Structure</span></h3>
                @if ($menuitems == '')
                    <h4>Create New Menu</h4>
                    <form method="post" action="{{ url('/admin/create-menu') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-sm btn-primary">Create Menu</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div id="menu-content">
                        <div id="result"></div>
                        <div style="min-height: 240px;">
                            <p>Select categories, pages or add custom links to menus.</p>
                            @if ($desiredMenu != '')
                                <ul class="menu ui-sortable card-header" id="menuitems">
                                    @if (!empty($menuitems))
                                        @foreach ($menuitems as $key => $item)
                                            <li data-id="{{ $item->id }}" class="bg-light">
                                                <a href="#collapse{{ $item->id }}" data-bs-toggle="collapse"
                                                    class="menu-item-bar card-header d-flex py-3">
                                                    <span class="d-flex justify-content-between w-100">
                                                        <div class="">
                                                            <i class="lni lni-joomla-original"></i>
                                                            <span class="ml-2">
                                                                @if (empty($item->name))
                                                                    {{ $item->title }}
                                                                @else
                                                                    {{ $item->name }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <i class="lni lni-chevron-down mt-1"></i>
                                                    </span>
                                                </a>
                                                <div class="collapse" id="collapse{{ $item->id }}"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="input-box">
                                                        <form method="post"
                                                            action="{{ url('/admin/update-menuitem') }}/{{ $item->id }}">
                                                            {{ csrf_field() }}
                                                            <div class="form-group p-2">
                                                                <label>Link Name</label>
                                                                <input type="text" name="name"
                                                                    value="@if (empty($item->name)) {{ $item->title }} @else {{ $item->name }} @endif"
                                                                    class="form-control">
                                                            </div>
                                                            @if ($item->type == 'custom')
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="text" name="slug"
                                                                        value="{{ $item->slug }}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="target" value="_blank"
                                                                        @if ($item->target == '_blank') checked @endif>
                                                                    Open in a new tab
                                                                </div>
                                                            @endif
                                                            <div class="form-group p-2">
                                                                <button class="btn btn-sm btn-primary">Save</button>
                                                                <a href="{{ url('/admin/delete-menuitem') }}/{{ $item->id }}/{{ $key }}"
                                                                    class="btn btn-sm btn-danger">Delete</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <ul>
                                                    @if (isset($item->children))
                                                        @foreach ($item->children as $m)
                                                            @foreach ($m as $in => $data)
                                                                <li data-id="{{ $data->id }}" class="menu-item">
                                                                    <a href="#collapse{{ $data->id }}"
                                                                        data-bs-toggle="collapse"
                                                                        class="menu-item-bar card-header d-flex py-3 ">
                                                                        <div class="d-flex justify-content-between w-100">
                                                                            <div class="">
                                                                                <i class="lni lni-joomla-original"></i>
                                                                                <span class="ml-2">
                                                                                    @if (empty($data->name))
                                                                                        {{ $data->title }}
                                                                                    @else
                                                                                        {{ $data->name }}
                                                                                    @endif
                                                                                </span>
                                                                            </div>

                                                                            <i class="lni lni-chevron-down mt-1"></i>
                                                                        </div>
                                                                    </a>

                                                                    <div class="collapse p-2"
                                                                        id="collapse{{ $data->id }}">
                                                                        <div class="input-box">
                                                                            <form method="post"
                                                                                action="{{ url('/admin/update-menuitem') }}/{{ $data->id }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="form-group">
                                                                                    <label>Link Name</label>
                                                                                    <input type="text" name="name"
                                                                                        value="@if (empty($data->name)) {{ $data->title }} @else {{ $data->name }} @endif"
                                                                                        class="form-control">
                                                                                </div>
                                                                                @if ($data->type == 'custom')
                                                                                    <div class="form-group">
                                                                                        <label>URL</label>
                                                                                        <input type="text"
                                                                                            name="slug"
                                                                                            value="{{ $data->slug }}"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="checkbox"
                                                                                            name="target" value="_blank"
                                                                                            @if ($data->target == '_blank') checked @endif>
                                                                                        Open in a new tab
                                                                                    </div>
                                                                                @endif
                                                                                <div class="form-group">
                                                                                    <button class="btn btn-sm btn-primary">
                                                                                        Save
                                                                                    </button>
                                                                                    <a href="{{ url('/admin/delete-menuitem') }}/{{ $data->id }}/{{ $key }}/{{ $in }}"
                                                                                        class="btn btn-sm btn-danger">Delete</a>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <ul>
                                                                        @if (isset($data->children))
                                                                            @foreach ($data->children as $second_step)
                                                                                @foreach ($second_step as $in => $second)
                                                                                <li data-id="{{ $second->id }}"
                                                                                    class="menu-item">
                                                                                    <a href="#collapse{{ $second->id }}"
                                                                                        data-bs-toggle="collapse"
                                                                                        class="menu-item-bar card-header d-flex py-3 ">
                                                                                        <div
                                                                                            class="d-flex justify-content-between w-100">
                                                                                            <div class="">
                                                                                                <i
                                                                                                    class="lni lni-joomla-original"></i>
                                                                                                <span class="ml-2">
                                                                                                    @if (empty($second->name))
                                                                                                        {{ $second->title }}
                                                                                                    @else
                                                                                                        {{ $second->name }}
                                                                                                    @endif
                                                                                                </span>
                                                                                            </div>

                                                                                            <i
                                                                                                class="lni lni-chevron-down mt-1"></i>
                                                                                        </div>
                                                                                    </a>

                                                                                    <div class="collapse p-2"
                                                                                        id="collapse{{ $second->id }}">
                                                                                        <div class="input-box">
                                                                                            <form method="post"
                                                                                                action="{{ url('/admin/update-menuitem') }}/{{ $second->id }}">
                                                                                                {{ csrf_field() }}
                                                                                                <div
                                                                                                    class="form-group">
                                                                                                    <label>Link
                                                                                                        Name</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        name="name"
                                                                                                        value="@if (empty($second->name)) {{ $second->title }} @else {{ $second->name }} @endif"
                                                                                                        class="form-control">
                                                                                                </div>
                                                                                                @if ($second->type == 'custom')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>URL</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            name="slug"
                                                                                                            value="{{ $second->slug }}"
                                                                                                            class="form-control">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            name="target"
                                                                                                            value="_blank"
                                                                                                            @if ($second->target == '_blank') checked @endif>
                                                                                                        Open in a new
                                                                                                        tab
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div
                                                                                                    class="form-group">
                                                                                                    <button
                                                                                                        class="btn btn-sm btn-primary">
                                                                                                        Save
                                                                                                    </button>
                                                                                                    <a href="{{ url('/admin/delete-menuitem') }}/{{ $second->id }}/{{ $key }}/{{ $in }}"
                                                                                                        class="btn btn-sm btn-danger">Delete</a>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul></ul>
                                                                                </li>
                                                                                @endforeach
                                                                            @endforeach
                                                                        @endif

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endif
                        </div>
                        @if ($desiredMenu != '')
                            <div class="form-group menulocation">
                                <label class="mt-5"><b>Menu Location</b></label>
                                <p><label><input type="radio" name="location" value="1"
                                            @if ($desiredMenu->location == 1) checked @endif> Header</label></p>
                                <!-- <p><label><input type="radio" name="location" value="2" @if ($desiredMenu->location == 2) checked @endif> Main Navigation</label></p> -->
                            </div>
                            <div class="text-right">
                                <button class="btn btn-sm btn-primary" id="saveMenu">Save Menu</button>
                            </div>
                            <a class="btn btn-danger"
                                href="{{ url('/admin/delete-menu') }}/{{ $desiredMenu->id }}">Delete
                                Menu</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="d-none" id="serialize_output">
        @if ($desiredMenu)
            {{ $desiredMenu->content }}
        @endif
    </div>

@endsection

{{-- FOOTER --}}
@section('footer-script')
    @parent
    <!--================ End Footer Area =================-->
    <script src="{{ asset('assets/js/jquery-sortable.js') }}"></script>
    <script>
        $('#select-all-categories').click(function(event) {
            if (this.checked) {
                $('#categories-list :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('#categories-list :checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
    <script>
        $('#select-all-posts').click(function(event) {
            if (this.checked) {
                $('#posts-list :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('#posts-list :checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
     <script>
        $('#select-all-pages').click(function(event) {
            if (this.checked) {
                $('#pages-list :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('#pages-list :checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>

    @if ($desiredMenu)
        <script>
            $(document).ready(function() {
                $('#add-categories').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var n = $('input[name="select-category[]"]:checked').length;
                    var array = $('input[name="select-category[]"]:checked');
                    var ids = [];
                    for (i = 0; i < n; i++) {
                        ids[i] = array.eq(i).val();
                    }
                    if (ids.length == 0) {
                        return false;
                    }
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            ids: ids
                        },
                        url: "{{ url('/admin/add-categories-to-menu') }}",
                        success: function(res) {
                            location.reload();
                        }
                    })
                })
                $('#add-posts').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var n = $('input[name="select-post[]"]:checked').length;
                    var array = $('input[name="select-post[]"]:checked');
                    var ids = [];
                    for (i = 0; i < n; i++) {
                        ids[i] = array.eq(i).val();
                    }
                    if (ids.length == 0) {
                        return false;
                    }
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            ids: ids
                        },
                        url: "{{ url('/admin/add-post-to-menu') }}",
                        success: function(res) {
                            location.reload();
                        }
                    })
                })
                $('#add-pages').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var n = $('input[name="select-pages[]"]:checked').length;
                    var array = $('input[name="select-pages[]"]:checked');
                    var ids = [];
                    for (i = 0; i < n; i++) {
                        ids[i] = array.eq(i).val();
                    }
                    if (ids.length == 0) {
                        return false;
                    }
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            ids: ids
                        },
                        url: "{{ url('/admin/add-page-to-menu') }}",
                        success: function(res) {
                            location.reload();
                        }
                    })
                })
                $("#add-custom-link").click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var url = $('#url').val();
                    var link = $('#linktext').val();
                    if (url.length > 0 && link.length > 0) {
                        $.ajax({
                            type: "get",
                            data: {
                                menuid: menuid,
                                url: url,
                                link: link
                            },
                            url: "{{ url('/admin/add-custom-link') }}",
                            success: function(res) {
                                location.reload();
                            }
                        })
                    }
                })
            });
        </script>
        <script>
            $(document).ready(function() {
                var group = $("#menuitems").sortable({
                    group: 'serialization',
                    onDrop: function($item, container, _super) {
                        var data = group.sortable("serialize").get();
                        var jsonString = JSON.stringify(data, null, ' ');
                        $('#serialize_output').text(jsonString);
                        _super($item, container);
                    }
                });

                $('#saveMenu').click(function() {
                    var menuid = <?= $desiredMenu->id ?>;
                    var location = $('input[name="location"]:checked').val();
                    var newText = $("#serialize_output").text();
                    var data = JSON.parse($("#serialize_output").text());
                    $.ajax({
                        type: "get",
                        data: {
                            menuid: menuid,
                            data: data,
                            location: location
                        },
                        url: "{{ url('/admin/update-menu') }}",
                        success: function(res) {
                            window.location.reload();
                        }
                    })
                })

            })
        </script>
    @endif
@endsection
