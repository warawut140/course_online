@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    <div id="traning-section1" class="bg-orange py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 p-2">
                    <img src="{{ asset('images/profile/'.$profile->image_profile) }}" class="rounded-circle mb-2 mw-100" width="200" height="200"><br>
                </div>
                <div class="col-sm-8 p-2">
                    <h4>{{ $profile->firstname }} {{ $profile->lastname }} <a class="pointer" data-toggle="modal" data-target="#headprofile"><i class='fas fa-edit'></i></a></h4>
                    <h6>(
                        @if($profile->type_user_id != null)
                            {{ $typeUser1->name }}
                        @endif
                        @if($profile->type_user_id_2 != null || $profile->type_user_id_3 != null)
                            /
                        @endif
                        @if($profile->type_user_id_2 != null)
                            {{ $typeUser2->name }}
                            @if($profile->type_user_sub_id != null)
                                ประเภท sub
                            @endif
                        @endif
                        @if($profile->type_user_id_3 != null)
                            /
                        @endif
                        @if($profile->type_user_id_3 != null)
                            {{ $typeUser3->name }}
                        @endif
                    </h6>
                    <p>
                        <i class='fas fa-star'></i><span>@if($profile->review_profile != null){{ $profile->review_profile }}@else 0.0 @endif</span>
                        <i class='fas fa-coins'></i><span>@if($profile->coins != null){{ $profile->coins }}@else 0 @endif</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <div id="traning-section2" class="bg-light">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-deck mb-3">
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">สอบออนไลน์</div>
                                <div class="card-body p-2">
                                    <p class="font-weight-bold">ประวัติการเข้าสอบ</p>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-success font-weight-light">สอบผ่าน</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">สอบออนไลน์</div>
                                <div class="card-body p-2">
                                    <p class="font-weight-bold">ประวัติการเข้าสอบ</p>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-success font-weight-light">สอบผ่าน</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-light p-1 my-1">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-0">ชื่อบทความคอร์ส <span
                                                            class="badge badge-primary font-weight-light">ประเภทxxx</span>
                                                    <span class="badge badge-danger font-weight-light">สอบยังไม่ผ่าน</span>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-black-50 mb-0">ทดสอบเมื่อ วว/ดด/ปปปป</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end # --}}
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
@section('script')

@endsection

