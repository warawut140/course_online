@extends('layouts.nevber-admin2')
@section('head')
@endsection
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                จัดการข้อมูลนักเรียน
            </h2>
            @if (session('success'))
                <div id="icon-alert" class="p-5">
                    <div class="preview">
                        <div class="alert alert-success show flex items-center mb-2 success" style="color:white;"
                            role="alert"> <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i>
                            {{ @session('success') }} </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div id="icon-alert" class="p-5">
                    <div class="preview">
                        <div class="alert alert-danger show flex items-center mb-2 error" style="color:white;"
                            role="alert"> <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i>
                            {{ @session('error') }} </div>
                    </div>
                </div>
            @endif
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                {{-- <a href="{{ url('admin/course_type') }}" class="btn btn-primary shadow-md mr-2"><span
                        class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4"
                            data-lucide="corner-down-left"></i> </span> &nbsp;ย้อนกลับ</a> --}}
            </div>
        </div>
        <!-- BEGIN: Wizard Layout -->
        <form method="POST" action="{{ url('admin/student_store') }}" id="searchForm" enctype="multipart/form-data">
            @csrf

            <input name="data_id" type="hidden" class="form-control" value="{{ @$data->id }}"
                placeholder="กรุณาระบุข้อมูล">

            <div class="intro-y box py-10 sm:py-15 mt-5">
                <div class="px-5 mt-0">
                    <div class="font-medium text-left text-lg">แก้ไขข้อมูลนักเรียน</div>
                    {{-- <div class="text-slate-500 text-center mt-2">To start off, please enter your username, email address and password.</div> --}}
                </div>
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">ข้อมูลนักเรียน</div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                        <div class="intro-y col-span-12 sm:col-span-3">
                            @if (@$data)
                                <img src="{{ asset('images/profile/' . @$data->image_profile) }}"
                                    class="circleco mb-2 mw-100" width="200" height="200"><br>
                            @else
                                <img src="{{ asset('images/upload.png') }}" class="circleco mb-2 mw-100" width="200"
                                    height="200"><br>
                            @endif

                            <input type="hidden" name="type" value="basic">
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label for="input-wizard-1" class="form-label">รูปภาพโปรไฟล์</label>
                            <input type="file" class="form-control-file" id="image_profile" name="image_profile">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="firstname">ชื่อ</label>
                            <input name="firstname" type="text" required value="{{ @$data->firstname }}"
                                class="form-control" id="firstname">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="lastname">นามสกุล</label>
                            <input name="lastname" type="text" required value="{{ @$data->lastname }}"
                                class="form-control" id="lastname">
                        </div>


                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="username">username</label>
                            <input name="username" type="text" required value="{{ @$data->username }}"
                                class="form-control" id="username">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="password">รหัสผ่าน</label>
                            <input name="password" type="text" placeholder="ระบุหากต้องการแก้ไข" class="form-control"
                                id="password">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <input name="tel" type="text" required value="{{ @$data->tel }}" class="form-control"
                                id="tel">
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="title_me">แนะนำตัว</label>
                            <input name="title_me" type="text" required value="{{ @$data->title_me }}"
                                class="form-control" id="title_me">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="email">E-mail</label>
                            <input name="email" type="text" required value="{{ @$data->email }}"
                                class="form-control" id="email">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="date_of_birth">วัน/เดือน/ปีเกิด </label>
                            <input name="date_of_birth" type="date" required value="{{ @$data->date_of_birth }}"
                                class="form-control">
                        </div>


                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label for="date_of_birth">ที่อยู่ </label>
                            <textarea type="text" class="form-control" name="company_address">{{ @$data->company_address }}</textarea>
                        </div>

                    </div>

                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <a href="{{ url('admin/student') }}" class="btn btn-secondary w-24">ย้อนกลับ</a>
                        <button type="submit" onclick="return confirm('ยืนยันการทำรายการ?')"
                            class="btn btn-primary w-24 ml-2">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <!-- END: Wizard Layout -->
    </div>
    <!-- END: Content -->
@endsection
@section('script')
@endsection
