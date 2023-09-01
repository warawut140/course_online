@extends('layouts.nevber-admin2')
@section('head')
@endsection
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                จัดการแบนเนอร์
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
        <form method="POST" action="{{ url('admin/banner/store') }}" enctype="multipart/form-data">
            @csrf

            <input name="data_id" type="hidden" class="form-control" value="{{ @$data->id }}"
                placeholder="กรุณาระบุข้อมูล">

            <div class="intro-y box py-10 sm:py-15 mt-5">
                <div class="px-5 mt-0">
                    <div class="font-medium text-left text-lg">เพิ่มแบนเนอร์</div>
                    {{-- <div class="text-slate-500 text-center mt-2">To start off, please enter your username, email address and password.</div> --}}
                </div>
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">ข้อมูลแบนเนอร์</div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-1" class="form-label">ชื่อแบนเนอร์</label>
                            <input id="input-wizard-1" name="name" type="text" class="form-control"
                                value="{{ @$data->name }}" required placeholder="กรุณาระบุข้อมูล">
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="input-wizard-1" class="form-label">รูปภาพ (1600x750 px)</label>
                            <input id="input-wizard-1" name="image" type="file" class="form-control" required
                                placeholder="กรุณาระบุข้อมูล">
                        </div>

                        @if (@$data)
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <img src="{{ asset('images/banner/' . @$data->image) }}" class="circleco mb-2 mw-100"
                                    width="1600" height="750">
                            </div>
                        @endif

                        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                            <a href="{{ url('admin/banner') }}" class="btn btn-secondary w-24">ย้อนกลับ</a>
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
