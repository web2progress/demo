<div class="col-sm-3 border-right bg-primary text-light">
    <div class="row px-2">

        <h4 class="mt-4"> <i class="fa-solid fa-chart-line mr-2"></i>Dashboard</h4>
    </div>
</div>
@php
    $userProfile = App\Models\User::find(auth()->user()->id);
@endphp
<div class="col-sm-9 bg-primary text-light">
    <div class="row">
        <div class="user_profile d-flex justify-content-between">
            <div class=" d-flex">
                <div class="user_pic">
                    <img src="{{ asset('images/profile/') }}/{{ $userProfile->img ? $userProfile->img : 'avtar.png' }}"
                        width="100%" class="img-fluid profileImage">
                    <a href="#"
                        class="badge badge-light uploadprofile  @if (last(request()->segments()) !== 'profile') d-none @endif"
                        title="Edit Profile"><i class="fa fa-solid fa-pen-to-square"></i></a>
                    <input type="file" name="image" class="image imgupload d-none">
                    <div class="modal fade " id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Profile Upload</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="img-container">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <img id="image"
                                                    src="https://avatars0.githubusercontent.com/u/3456749">
                                            </div>
                                            <div class="col-md-5">
                                                <div class="preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="cropProfile">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4 px-4">
                    <h6 class="mb-1"> <span>{{ $userProfile->name . ' ' . $userProfile->last_name }}</span></h6>
                    <p class="mb-0">{{ $userProfile->number }}</p>
                </div>
            </div>
            <div>
                <h3 class="mt-3"> @yield('title')</h3>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-3 bg-dark text-light py-5">
    <div class="row">
        <div class="side-tab">
            <a href="{{ url('user/dashboard') }}" class="@if (last(request()->segments()) == 'dashboard') active @endif">Doshboard</a>
            <a href="{{ url('user/profile') }}" class="@if (last(request()->segments()) == 'profile') active @endif">Profile</a>
            <a href="{{ url('user/current-plan') }}" class="@if (last(request()->segments()) == 'current-plan') active @endif">Current
                Plan</a>
            <a href="{{ url('user/new-connection') }}" class="@if (last(request()->segments()) == 'new-connection') active @endif">New
                Connection</a>
            <a href="{{ url('user/upgrade-connection') }}"
                class="@if (last(request()->segments()) == 'upgrade-connection') active @endif">Upgrade Connection</a>
            <a href="{{ url('user/change-password') }}"
                class="@if (last(request()->segments()) == 'change-password') active @endif">Security</a>
        </div>
    </div>
</div>
