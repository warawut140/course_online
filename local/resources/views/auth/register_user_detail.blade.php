@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script> --}}
    <link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">
    {{-- <script>
        function checkTypeUser(id) {
            if (id == 2) {
                $('#typeUser').show();
            } else {
                $('#typeUser').hide();
            }
        }
    </script> --}}
    <style>
        body {

}
.main {
    background-image: url("{{ asset('images/bgco.png') }}");
   background-repeat: no-repeat;
  background-size: auto;

  margin-right: 200px;
  margin-left: 200px;
}
.circleco{
    color:gray;
        border-radius: 50%;
           border: 2px solid gray;
}
        .bg-light2 {
            /* background-color: #8B0900;
                                        background-image: url("{{ asset('image/bg.png') }}"); */
            /* clear: both; */
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-left: 15px solid #8B0900;
                 background-color: white;
                     color: black;
        }

        .nav-pills a.nav-link {
            color: black;
            border-bottom: 1px solid #d9d9d9;
        }

        .select2-container .select2-selection--single {
            height: 30px;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #ffffff;
            text-align: center;
            white-space: nowrap;
            background-color: #8B0900;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
    </style>
@endsection
@section('content')
    <div id="app" class="main">

        {{-- begin #register --}}
        <div id="register-section1" class="bg-light2">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link <?php if ($type == '') {
                                echo 'active';
                            } ?>" id="v-pills-home-tab"
                                href="{{ url('register_user_detail') }}" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">BASIC INFORMATION</a>
                            <a class="nav-link <?php if ($type == 'web') {
                                echo 'active';
                            } ?>" id="v-pills-profile-tab"
                                href="{{ url('register_user_detail/web') }}" role="tab"
                                aria-controls="v-pills-profile" aria-selected="false">ON THE WEB</a>
                            <a class="nav-link <?php if ($type == 'job') {
                                echo 'active';
                            } ?>" id="v-pills-messages-tab"
                                href="{{ url('register_user_detail/job') }}" role="tab"
                                aria-controls="v-pills-messages" aria-selected="false">ABOUT ME</a>
                            <a class="nav-link <?php if ($type == 'receive') {
                                echo 'active';
                            } ?>" id="v-pills-settings-tab"
                                href="{{ url('register_user_detail/receive') }}" role="tab"
                                aria-controls="v-pills-settings" aria-selected="false">Education
                            </a>
                            <a class="nav-link <?php if ($type == 'course') {
                                echo 'active';
                            } ?>" id="v-pills-settings-tab"
                                href="{{ url('register_user_detail/course') }}" role="tab"
                                aria-controls="v-pills-settings" aria-selected="false">WORK EXPERIENCE
                            </a>
                        </div>
                        {{-- <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                          </div> --}}
                    </div>

                    @if ($type == '')
                        @include('auth.usertab.basic')
                    @endif
                    @if ($type == 'web')
                        @include('auth.usertab.on_web')
                    @endif
                    @if ($type == 'job')
                        @include('auth.usertab.job')
                    @endif
                    @if ($type == 'receive')
                        @include('auth.usertab.receive')
                    @endif

                    @if ($type == 'course')
                        @include('auth.usertab.course')
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal ข้อตกลงและเงื่อนไข-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ข้อตกลงและเงื่อนไข</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum
                    </div>
                </div>
            </div>
        </div>
        {{-- end #register --}}
    </div>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('select2/select2.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // $('#typeUser').hide();
            $('.select2').select2({
                width: '100%',
            });
            // CKEDITOR.replace('detail_scope');

        });


        $(function() {
            $(":checkbox[name=i_accept]").on("click", function() {
                var i_check = $(this).prop("checked");
                console.log(i_check);
                if (i_check == true) {
                    $("button[name=btn_send]").attr("disabled", false);
                } else {
                    $("button[name=btn_send]").attr("disabled", true);
                }
            });
        });
    </script>
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
@endsection
