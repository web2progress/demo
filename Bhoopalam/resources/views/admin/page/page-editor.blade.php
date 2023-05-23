@extends('admin.layouts.layouts')
@section('header-link')
@section('title', 'Edit - Page')
@section('header-link')
@parent
<!-- custom link  -->
<link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
<script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>
<link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
<style>
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

    #main {
        transition: margin-right .5s;
    }

    .laraberg__editor {
        z-index: 9;
    }

    .laraberg__editor {
        z-index: 9;
    }

    .has-white-color {
        color: #ffffff;
    }

    .has-white-background-color {
        background-color: #ffffff;
    }

    .has-black-color {
        color: #000000;
    }

    .has-black-background-color {
        background-color: #000000;
    }

    .has-cyan-bluish-gray-color {
        color: #abb8c3;
    }

    .has-cyan-bluish-gray-background-color {
        background-color: #abb8c3;
    }

    .has-pale-pink-color {
        color: #f78da7;
    }

    .has-pale-pink-background-color {
        background-color: #f78da7;
    }

    .has-vivid-red-color {
        color: #cf2e2e;
    }

    .has-vivid-red-background-color {
        background-color: #cf2e2e;
    }

    .has-luminous-vivid-orange-color {
        color: #ff6900;
    }

    .has-luminous-vivid-orange-background-color {
        background-color: #ff6900;
    }

    .has-luminous-vivid-amber-color {
        color: #fcb900;
    }

    .has-luminous-vivid-amber-background-color {
        background-color: #fcb900;
    }

    .has-light-green-cyan-color {
        color: #7bdcb5;
    }

    .has-light-green-cyan-background-color {
        background-color: #7bdcb5;
    }

    .has-vivid-green-cyan-color {
        color: #00d084;
    }

    .has-vivid-green-cyan-background-color {
        background-color: #00d084;
    }

    .has-pale-cyan-blue-color {
        color: #8ed1fc;
    }

    .has-pale-cyan-blue-background-color {
        background-color: #8ed1fc;
    }

    .has-vivid-cyan-blue-color {
        color: #0693e3;
    }

    .has-vivid-cyan-blue-background-color {
        background-color: #0693e3;
    }

    .has-vivid-purple-color {
        color: #9b51e0;
    }

    .has-vivid-purple-background-color {
        background-color: #9b51e0;
    }

    .screenSize {
        position: relative;
    }

    .fullBoxBtn,
    .fullBoxBtn:focus {
        position: absolute;
        right: 52px;
        margin-top: 9px;
        cursor: pointer;
        z-index: 9;
        outline: 0 !important;
        box-shadow: 0 0 0 0.25rem rgb(255 255 255 / 25%);

    }

    .full-screen {
        position: fixed;
        top: 0;
        left: 0;
        background-color: white;
        z-index: 99999999;
        width: 100%;
        height: 100%;
        margin: 0px;
        border: none;

    }
</style>

@endsection
@section('content')
@parent
<!-- body code  -->
{{-- message --}}
<div id="messageAlt"></div>
<div class="container-fluid product-ourt">
    <form id="submit-page" action="javascript:void(0)" enctype="multipart/form-data" method="POST">
        @csrf
        <div id="main">
            <div class="row">
                <div class="col-sm-9">
                    <div class="d-flex">
                        <!--    title-->
                        <div class="forms-inputs w-100"> <span>Title*</span>
                            <input type="text" data-id="{{ $editPages->id }}" data-column="title" class="form-control update" name="title" value="{{ $editPages->title }}" autocomplete="off" required>
                            <div class="invalid-feedback">
                                Enter Title
                            </div>
                            <p class="text-danger ">{{ $errors->first('title') }}
                            <p>
                        </div>

                        <!--    url-->
                        <div class="forms-inputs w-100"> <span>URL*</span>
                            <input type="text" data-id="{{ $editPages->id }}" data-column="slug" class="form-control update" name="slug" value="{{ $editPages->slug }}" autocomplete="off" required>
                            <div class="invalid-feedback">
                                Enter url
                            </div>
                            <p class="text-danger">{{ $errors->first('url') }}
                            <p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 pt-4">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <input type="hidden" id="current_status" name="status" value="{{ $editPages->status }}">
                            <button type="submit" value="draft" class="btn btn-primary btn-sm clickUpdate">Draft</button>
                            <button type="submit" value="publish" class="btn btn-success btn-sm clickUpdate">publish</button>
                            <a href="#" class="btn btn-primary btn-sm" onclick="openNav()">&#9776; OPEN
                                SEO</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screenSize">
                <button type="button" value="off" class="btn btn-primary fullBoxBtn"> <i class="fadeIn animated bx bx-expand"></i> </button>
                <textarea id="content" name="content" class="form-control">{{ $editPages->content }}</textarea>
            </div>
        </div>

        <div id="mySidenav" class="sidenav shadow">
            <span class="closebtn" onclick="closeNav()">&times;</span>
            <div class="">
                <!-- keywords     -->
                <div class="w-100 mt-4">
                    <div class="forms-inputs-select">
                        <span class="mb-4">keywords</span>
                    </div>
                    <textarea data-id="{{ $editPages->id }}" name="keyword" data-column="keyword" class="form-control update pt-3 keyword" rows="3" placeholder="Type, any, keyword, using comma,">{{ $editPages->keyword }}</textarea>
                    <span class="keyword-outer"><span id="keyword-miter">0</span> / 17</span>
                </div>
                <!-- Description     -->
                <div class="mt-5">
                    <div class="forms-inputs-select">
                        <span class="mb-4">Description</span>
                    </div>
                    <textarea data-id="{{ $editPages->id }}" name="description" data-column="description" class="form-control update pt-3 description" rows="3">{{ $editPages->description }}</textarea>
                    <span class="description-outer"><span id="description-miter"></span> / 155</span>
                </div>


                <!-- Thumbnail     -->
                <div class="mt-4">
                    <input type="hidden" id="id" name="id" value="{{ $editPages->id }}">
                    <span class="mb-4">Thumbnail</span>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="thumbTR" data-input="thumb" data-preview="preview" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumb" data-id="{{ $editPages->id }}" data-column="thumbnail" name="thumbnail" class="form-control update" type="text" value="{{ $editPages->thumbnail }}">
                    </div>
                    <div id="preview">
                        <img class="img-fluid" id="image_preview" src="{{ $editPages->thumbnail ? $editPages->thumbnail : asset('assets/images/thumbnail.jpg') }}" alt="preview image">
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
{{-- <script>
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
        const options = {
            height: "500px", // OK
            alignWide: true, //OK
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
            colors: {
                background: '#f5f5f5',
            },
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
        }
        Laraberg.init('content', options);
    </script> --}}
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



    $(document).ready(function() {
        // nav togggled
        $('.accordion').addClass('toggled');
        // udae data
        function update_data(id, column_title, value) {
            //alert(id+column_title+value);
            $.ajax({
                url: "{{ route('page.updatepage') }}",
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
                url: "{{ route('rePublishPage') }}",
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

    });
</script>
<link href="{{ asset('frontend/choice/choices.min.css') }}" rel="stylesheet">
<script src="{{ asset('frontend/choice/choices.min.js') }}"></script>

<script>
    setInterval(() => {
        $('.alt').slideUp();
    }, 5000);

    $(document).on('click', '.fullBoxBtn', function() {
        if ($(this).val() == "off") {
            $(this).val('on');
            $('.screenSize').addClass('full-screen');
            $(this).html('<i class="fadeIn animated bx bx-collapse"></i>');
        } else {
            $('.screenSize').removeClass('full-screen');
            $(this).val('off');
            $(this).html('<i class="fadeIn animated bx bx-expand"></i>');
        }
    });
</script>

@endsection
