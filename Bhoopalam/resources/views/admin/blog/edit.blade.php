@extends('admin.layouts.layouts')
@section('title', 'Edit - Post')
@section('header-link')
    @parent
    <!-- custom link  -->
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">

    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <style>
        .wp-block {
            max-width: 100% !important;
        }

        .sidenav {
            height: 100%;
            width: 350px;
            background-color: #ffffff;
            z-index: 999;
            position: fixed;
            top: 0;
            padding: 10px;
            right: -350px;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }


        .sidenav .closebtn {
            position: absolute;
            top: 0;
            width: 45px;
            height: 45px;
            padding: 12px;
            line-height: 20px;
            border-radius: 40px;
            text-align: center;
            background-color: #8aff75;
            right: 25px;
            font-size: 36px;
            z-index: 9;
            cursor: pointer;
        }

        #main {
            transition: margin-right .5s;
        }

        .laraberg__editor {
            z-index: 9;
        }

        .laraberg__editor {
            z-index: 9;
        }

        .wp-block {
            max-width: 100% !important;
        }

        .sidenav {
            height: 100%;
            width: 350px;
            background-color: #ffffff;
            z-index: 999;
            position: fixed;
            top: 0;
            padding: 10px;
            right: -350px;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            width: 45px;
            height: 45px;
            padding: 12px;
            line-height: 20px;
            border-radius: 40px;
            text-align: center;
            background-color: #8aff75;
            right: 25px;
            font-size: 36px;
            z-index: 9;
            cursor: pointer;
        }

        

        @foreach (config('app.colors') as $color).has-{{ $color['slug'] }}-color {
            color: {!! $color['color'] !!};
        }

        .has-{{ $color['slug'] }}-background-color {
            background-color: {!! $color['color'] !!};
        }

        @endforeach
    </style>
@endsection
@section('content')
    @parent
    <div class="p-2">
        <form id="submit-page" action="javascript:void(0)" enctype="multipart/form-data" method="POST">
            @csrf
            <!-- body code  -->
            {{-- message --}}
            <div id="main">
                <div class="row">
                    <div class="col-sm-9 ">
                        <div class="row">
                            <!--    title-->
                            <div class="forms-inputs col-sm-6"> <span>Title*</span>
                                <input type="text" data-id="{{ $editPosts->id }}" name="title" id="title"
                                    data-column="title" class="form-control update" value="{{ $editPosts->title }}"
                                    autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Enter Title
                                </div>
                                <p class="text-danger ">{{ $errors->first('title') }}
                                <p>
                            </div>
                            <!--    slug-->
                            <div class="forms-inputs col-sm-6"> <span>SLUG*</span>
                                <input type="text" data-id="{{ $editPosts->id }}" name="slug" id="slug"
                                    data-column="slug" class="form-control update" value="{{ $editPosts->slug }}"
                                    autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Enter slug
                                </div>
                                <p class="text-danger">{{ $errors->first('slug') }}
                                <p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 pt-4">
                        <div class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="submit page">
                                <input type="hidden" id="current_status" name="status" value="{{ $editPosts->status }}">
                                <button type="submit" value="draft"
                                    class="btn btn-primary btn-sm clickUpdate">Draft</button>
                                <button type="submit" value="publish"
                                    class="btn btn-success btn-sm clickUpdate">publish</button>
                                <a href="#" class="btn btn-primary btn-sm" onclick="openNav()">&#9776; OPEN SEO</a>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="content" name="content" class="form-control">{{ $editPosts->content }}</textarea>
            </div>
            <div id="mySidenav" class="sidenav shadow">
                <span class="closebtn" onclick="closeNav()">&times;</span>
                <div class="">
                    <!-- SEO  Title     -->
                    <div class="mt-3">
                        <div class="forms-inputs">
                            <span class="mb-4">SEO Title</span>
                        </div>
                        <textarea data-id="{{ $editPosts->id }}"name="seo_title" data-column="seo_title" class="form-control update pt-3"
                            rows="3" placeholder="Title..">{{ $editPosts->seo_title }}</textarea>
                    </div>
                    <!-- keywords     -->
                    <div class="mt-4">
                        <div class="forms-inputs">
                            <span class="mb-4">SEO keywords</span>
                        </div>
                        <textarea data-id="{{ $editPosts->id }}" name="keyword" data-column="keyword" class="form-control update pt-3 keyword"
                            rows="5" placeholder="Type, any, keyword, using comma,">{{ $editPosts->keyword }}</textarea><span class="keyword-outer"><span id="keyword-miter">0</span> / 17</span>
                    </div>
                    <!-- Description     -->
                    <div class="mt-4">
                        <div class="forms-inputs">
                            <span class="mb-4">SEO Description</span>
                        </div>
                        <textarea data-id="{{ $editPosts->id }}" name="description" data-column="description"
                            class="form-control update pt-3 description" rows="5">{{ $editPosts->description }}</textarea>
                        <span class="description-outer"><span id="description-miter"></span> / 155</span>
                    </div>

                    <!-- Category -->
                    <div class="mt-5">
                        <div class="forms-inputs-select">
                            <span>SEO Category</span>
                        </div>
                        <select data-id="{{ $editPosts->id }}" id="choices-multiple-remove-button" class="catPost"
                            multiple>


                            {{-- get all category --}}
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    @if (!empty($editPosts->categories)) @foreach (explode(',', $editPosts->categories) as $data){{ $data == $cat->id ? 'selected' : '' }}@endforeach @endif>
                                    {{ $cat->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tags -->
                    <div class="mt-5">
                        <div class="forms-inputs-select">
                            <span>Tag</span>
                        </div>
                        <select data-id="{{ $editPosts->id }}" id="choices-multiple-remove-button" class="tagPost"
                            multiple>

                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if (!empty($editPosts->tags)) @foreach (explode(',', $editPosts->tags) as $data){{ $data == $tag->id ? 'selected' : '' }}@endforeach @endif>
                                    {{ $tag->title }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <!-- modals -->
                    <div class="mt-4">
                        <div class="forms-inputs-select">
                            <span>Select Pop Up Model</span>
                        </div>
                        <select data-id="{{ $editPosts->id }}" data-column="modal_id" class="form-control update">
                            <option value="">--select modal--</option>
                            @foreach ($modals as $modal)
                                <option value="{{ $modal->id }}"
                                    {{ $modal->id == $editPosts->modal_id ? 'selected' : '' }}>
                                    {{ $modal->title }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <!-- Thumbnail     -->
                    <div class="mt-4">
                        <input type="hidden" id="id" name="id" value="{{ $editPosts->id }}">
                        <span class="mb-4 bg-light">Thumbnail</span>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="thumbTR" data-input="thumb" data-preview="preview" class="btn  btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumb" data-id="{{ $editPosts->id }}" data-column="thumbnail"
                                name="thumbnail" class="form-control update" type="text"
                                value="{{ $editPosts->thumbnail }}">
                        </div>
                        <div id="preview">
                            <img id="image_preview" src="{{ $editPosts->thumbnail }}" alt="preview image"
                                style="max-height: 150px;">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end body code  -->
@endsection
<!--start FOOTER  -->
@section('footer-script')
    @parent
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        // toggled

        function openNav() {
            document.getElementById("mySidenav").style.right = "0px";
            //document.getElementById("main").style.marginRight = "250px";
            // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.right = "-350px";
            //document.getElementById("main").style.marginRight = "0";
            //document.body.style.backgroundColor = "white";
        }
    </script>
    <script>
        /**
         *  Laravel file manager
         * reprise du fonctionnement de la V1 de laraberg afin de prendre en compte FileManager
         *  getMediaType => getMediaType gère les formats de fichiers acceptés
         *  onSelect => onSelect gère l'action à effectuer lorsque l'utilisateur sélectionne un fichier
         *  openModal => openModal gère l'action à effectuer lorsque l'utilisateur clique sur le bouton
         *  openLFM => openLFM gère l'action à effectuer lorsque l'utilisateur ouvre la fenêtre de FileManager
         */
        class LaravelFilemanager extends Laraberg.wordpress.element.Component {
            constructor(props) {
                super(props)
                this.state = {
                    media: []
                }
            }
            getMediaType = (path) => {
                const video = ['mp4', 'm4v', 'mov', 'wmv', 'avi', 'mpg', 'ogv', '3gp', '3g2']
                const audio = ['mp3', 'm4a', 'ogg', 'wav']
                const extension = path.split('.').slice(-1).pop()
                if (video.includes(extension)) {
                    return 'video'
                } else if (audio.includes(extension)) {
                    return 'audio'
                } else {
                    return 'image'
                }
            }
            onSelect = (url, path) => {
                this.props.value = null
                const {
                    multiple,
                    onSelect
                } = this.props
                const media = {
                    url: url,
                    type: this.getMediaType(path)
                }
                if (multiple) {
                    this.state.media.push(media)
                }
                onSelect(multiple ? this.state.media : media)
            }
            openModal = () => {
                let type = 'file'
                if (this.props.allowedTypes.length === 1 && this.props.allowedTypes[0] === 'image') {
                    type = 'image'
                }
                this.openLFM(type, this.onSelect)
            }
            openLFM = (type, cb) => {
                const routePrefix = '/laravel-filemanager'
                window.open(routePrefix + '?type=' + type, 'FileManager', 'width=900,height=600')
                window.SetUrl = function(items) {
                    if (items[0]) {
                        cb(items[0].url, items[0].name)
                    }
                }
            }
            render() {
                const {
                    render
                } = this.props
                return render({
                    open: this.openModal
                })
            }
        }
        /**
         * désactivation du bouton de l'éditeur Gutenberg
         */
        elementRendered('.components-form-file-upload button', element => element.remove())
        /**
         * ajout de la fonctionnalité de mediaUpload
         * @param selector
         * @param callback
         * @returns {MutationObserver}
         */
        function elementRendered(selector, callback) {
            const renderedElements = []
            const observer = new MutationObserver((mutations) => {
                const elements = document.querySelectorAll(selector)
                elements.forEach(element => {
                    if (!renderedElements.includes(element)) {
                        renderedElements.push(element)
                        callback(element)
                    }
                })
            })
            observer.observe(document.documentElement, {
                childList: true,
                subtree: true
            })
            return observer
        }
        Laraberg.wordpress.hooks.addFilter(
            'editor.MediaUpload',
            'core/edit-post/components/media-upload/replace-media-upload',
            () => LaravelFilemanager
        )
        /**
         * définition d'un mediaUpload vide
         */
        const mediaUpload = ({
            filesList,
            onFileChange
        }) => {}

        window.onbeforeunload;
        Laraberg.init('content', {
            height: "500px", // OK
            mediaUpload: mediaUpload, //OK
            supportsLayout: true, //OK
            sidebar: true,
            setting: true,
            imageEditing: true,
            canLockBlocks: false,
            disableCustomColors: false,
            disableCustomGradients: true,
            disableCustomFontSizes: false,
            enableCustomLineHeight: true,
            enableCustomUnits: true,
            enableCustomSpacing: true,
            codeEditingEnabled: true,
            laravelFilemanager: true,
            laravelFilemanager: true,
            colors: @json(config('app.colors')),
            fontSizes: [{
                name: 'small',
                size: 12
            }, {
                name: 'normal',
                size: 14
            }, {
                name: 'large',
                size: 16
            }, {
                name: 'huge',
                size: 18
            }], //OK
        });


        // end custom block add

        // laravel filemanager
        $('#lfm').filemanager('image');
        $('#thumbTR').filemanager('image');
    </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            //keyword seo param
            var keyTarget = '.keyword';
            var keyLength = $(".keyword").val().split(",").length - 1;

            getKeyParm(keyLength, keyTarget);

            $('.keyword').keyup(function() {
                // get keyword lenth
                var keyLength = $(this).val().split(",").length - 1;
                getKeyParm(keyLength, keyTarget);
            });
            //description seo param
            var descTarget = '.description';
            var descLength = $(".description").val().length;
            getDescParm(descLength, descTarget);
            $('.description').keyup(function() {
                var descLength = $(this).val().length;
                getDescParm(descLength, descTarget);
            });
            // keyword param seo
            function getKeyParm(keyLength, keyTarget) {
                $('#keyword-miter').text(keyLength);
                if (keyLength < 2) {
                    $(keyTarget).css("border-image",
                        "linear-gradient(to right, #da9f9f 25%, #cceaea 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5"
                    );
                } else if (keyLength <= 6) {
                    $(keyTarget).css("border-image",
                        "linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5"
                    );
                } else if (keyLength <= 10) {
                    $(keyTarget).css("border-image",
                        " linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #1cc88a 50%,#1cc88a 50%, #cceaea 75%, #cceaea 75%) 5"
                    );
                } else if (keyLength <= 14) {
                    $(keyTarget).css("border-image",
                        "linear-gradient(to right, #11a616 25%, #11a616 25%, #4effb5 50%,#3ef69a 50%, #65f1b0 75%, #62efad 75%) 5"
                    );
                } else if (keyLength <= 17) {
                    $(keyTarget).css("border-image",
                        "linear-gradient(to right, #11a616 25%, #11a616 25%, #11a616 50%,#11a616 50%, #19ad24 75%, #11a616 75%) 5"
                    );
                } else if (keyLength <= 20) {
                    $(keyTarget).css("border-image",
                        "linear-gradient(to right, rgb(255 0 0) 25%, rgb(255 0 0) 25%, rgb(255 33 0) 50%, rgb(255 9 0) 50%, rgb(255 0 0) 75%, rgb(255 1 0) 75%) 5 / 1 / 0 stretch"
                    );
                }
            }
            //description param seo
            function getDescParm(descLength, descTarget) {
                $('#description-miter').text(descLength);
                if (descLength < 32) {
                    $(descTarget).css("border-image",
                        "linear-gradient(to right, #da9f9f 25%, #cceaea 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5"
                    );
                } else if (descLength <= 64) {
                    $(descTarget).css("border-image",
                        "linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5"
                    );
                } else if (descLength <= 96) {
                    $(descTarget).css("border-image",
                        " linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #1cc88a 50%,#1cc88a 50%, #cceaea 75%, #cceaea 75%) 5"
                    );
                } else if (descLength <= 128) {
                    $(descTarget).css("border-image",
                        "linear-gradient(to right, #11a616 25%, #11a616 25%, #4effb5 50%,#3ef69a 50%, #65f1b0 75%, #62efad 75%) 5"
                    );
                } else if (descLength <= 155) {
                    $(descTarget).css("border-image",
                        "linear-gradient(to right, #11a616 25%, #11a616 25%, #11a616 50%,#11a616 50%, #19ad24 75%, #11a616 75%) 5"
                    );
                } else if (descLength <= 160) {
                    $(descTarget).css("border-image",
                        "linear-gradient(to right, rgb(255 0 0) 25%, rgb(255 0 0) 25%, rgb(255 33 0) 50%, rgb(255 9 0) 50%, rgb(255 0 0) 75%, rgb(255 1 0) 75%) 5 / 1 / 0 stretch"
                    );
                }
            }
            // thumbnail post
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>

    <script>
        // multi select
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 10,
                searchResultLimit: 10,
                renderChoiceLimit: 10
            });
        });
        // post multi select
        jQuery(function() {
            jQuery(".catPost").change(function() {
                // var ids = $(this).val();
                var id = $(this).data("id");
                var category_id = $(this).val();
                //   alert(id+category_id);

                jQuery.ajax({
                    url: "{{ route('PostMultiCategory') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "category_id": category_id,
                        "id": id
                    },
                    success: function(data) {
                        $('#messageAlt').fadeIn().html('<span class="text-success alt">' +
                            data +
                            '</span>');
                        $(".loader").hide();
                    }
                });
            });

            // tags
            jQuery(".tagPost").change(function() {
                // var ids = $(this).val();
                var id = $(this).data("id");
                var tag_id = $(this).val();
                //   alert(id+category_id);

                jQuery.ajax({
                    url: "{{ route('PostMultiTag') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "tag_id": tag_id
                    },
                    success: function(data) {
                        $('#messageAlt').fadeIn().html('<span class="text-success alt">' +
                            data +
                            '</span>');
                        $(".loader").hide();
                    }
                });;
            });



        });


        $(document).ready(function() {
            // nav togggled
            $('.accordion').addClass('toggled');
            // udae data
            function update_data(id, column_title, value) {
                //alert(id+column_title+value);
                $.ajax({
                    url: "{{ route('updatePost') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        column_title: column_title,
                        value: value
                    },
                    success: function(data) {
                        $('#messageAlt').html('<div class="alert-success">' + data + '</div>');
                    }
                });
            }

            // update post
            $(document).on("change", '.update', function() {
                var id = $(this).data("id");
                var column_title = $(this).data("column");
                var value = $(this).val();
                update_data(id, column_title, value);
            });




            // update
            // post_update
            $('.clickUpdate').click(function() {
                $('#current_status').val($(this).val());
            });


            $('#submit-page').submit(function(e) {
                e.preventDefault()
                var formData = new FormData(this);

                // var status = $(this).val();
                // var id = $(this).data("id");
                // var content = Laraberg.getContent();
                // console.log(laraberg);
                $.ajax({
                    url: "{{ route('rePublishPost') }}",
                    type: "POST",
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
                            Lobibox.notify('warning', {
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




            // ckeditor ////////////////////////////////////////////////////
            // var editor = CKEDITOR.replace('editor', {
            //     height: 400,
            //     uiColor: '#CCEAEE',
            //     filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            //     filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            //     filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            //     filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            // });

            // editor.on("pluginsLoaded", function(event) {
            //     editor.on('contentDom', function(evt) {
            //         var editable = editor.editable();
            //         editable.attachListener(editable, 'keyup', function(e) {
            //             // do something
            //             var self = this;
            //             var id = $('#id').val();
            //             var column_title = 'content';
            //             var value = self.getData()
            //             update_data(id, column_title, value);
            //             // $('#messageAlt').text(value + id);
            //         });
            //     });
            // });
            // end ckeditor /////////////////////////
        });
    </script>
    <link href="{{ asset('frontend/choice/choices.min.css') }}" rel="stylesheet">
    <script src="{{ asset('frontend/choice/choices.min.js') }}"></script>
    <!-- ck editor  -->
    {{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}
    <script>
        setInterval(() => {
            $('.alt').slideUp();
        }, 5000);
    </script>

@endsection
