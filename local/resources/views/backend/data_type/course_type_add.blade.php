@extends('layouts.nevber-admin2')
@section('head')
@endsection
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                จัดการประเภทคอร์ส
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                {{-- <a href="{{ url('admin/course_type') }}" class="btn btn-primary shadow-md mr-2"><span
                        class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4"
                            data-lucide="corner-down-left"></i> </span> &nbsp;ย้อนกลับ</a> --}}
            </div>
        </div>
        <!-- BEGIN: Wizard Layout -->
        <form method="POST" action="{{ url('admin/course_type/store') }}">
        @csrf

        <input name="data_id" type="hidden" class="form-control" value="{{@$data->id}}" placeholder="กรุณาระบุข้อมูล">

        <div class="intro-y box py-10 sm:py-15 mt-5">
            <div class="px-5 mt-0">
                <div class="font-medium text-left text-lg">เพิ่มประเภทคอร์ส</div>
                {{-- <div class="text-slate-500 text-center mt-2">To start off, please enter your username, email address and password.</div> --}}
            </div>
            <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                <div class="font-medium text-base">ข้อมูลประเภทคอร์ส</div>
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label for="input-wizard-1" class="form-label">ชื่อประเภทคอร์ส</label>
                        <input id="input-wizard-1" name="name" type="text" class="form-control" value="{{@$data->name}}" required placeholder="กรุณาระบุข้อมูล">
                    </div>

                    <div class="intro-y col-span-12 sm:col-span-12">
                        <label for="input-wizard-1" class="form-label">รายละเอียด</label>
                        <textarea type="text" class="form-control" name="detail">{{ @$data->detail }}</textarea>
                    </div>

                    <div class="intro-y col-span-12 sm:col-span-12">
                        <label for="input-wizard-1" class="form-label">หลักสูตรแนะนำ &nbsp;</label>
                       <select class="form-caontrol" id="input-wizard-1" name="recom_status">
                        <option value="1" <?php if(@$data->recom_status==1){echo 'selected';} ?>>ใช่</option>
                        <option value="0" <?php if(@$data->recom_status==0){echo 'selected';} ?>>ไม่ใช่</option>
                       </select>
                    </div>

                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <a href="{{ url('admin/course_type') }}" class="btn btn-secondary w-24">ย้อนกลับ</a>
                        <button type="submit" onclick="return confirm('ยืนยันการทำรายการ?')" class="btn btn-primary w-24 ml-2">บันทึกข้อมูล</button>
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
