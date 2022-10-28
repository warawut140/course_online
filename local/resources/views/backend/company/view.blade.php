@extends('layouts.nevber-admin2')
@section('head')
@endsection
@section('content')

    <!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                จัดการข้อมูลผู้ประกอบการ
            </h2>
            @if (session('success'))
            <div id="icon-alert" class="p-5">
                <div class="preview">
                    <div class="alert alert-success show flex items-center mb-2 success" style="color:white;" role="alert"> <i
                            data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> {{ @session('success') }} </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div id="icon-alert" class="p-5">
                <div class="preview">
                    <div class="alert alert-danger show flex items-center mb-2 error" style="color:white;" role="alert"> <i
                            data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> {{ @session('error') }} </div>
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
        <form method="POST" action="{{ url('admin/company_store') }}" id="searchForm" enctype="multipart/form-data">
            @csrf

            <input name="data_id" type="hidden" class="form-control" value="{{ @$data->id }}"
                placeholder="กรุณาระบุข้อมูล">

            <div class="intro-y box py-10 sm:py-15 mt-5">
                <div class="px-5 mt-0">
                    <div class="font-medium text-left text-lg">แก้ไขข้อมูลผู้ประกอบการ</div>
                    {{-- <div class="text-slate-500 text-center mt-2">To start off, please enter your username, email address and password.</div> --}}
                </div>
                <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base">ข้อมูลผู้ประกอบการ</div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">

                        <div class="intro-y col-span-12 sm:col-span-3">
                            @if ($data)
                                <img src="{{ asset('images/profile/' . $data->image_profile) }}"
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
                            <label for="company">ชื่อบริษัท</label>
                            <input type="text" class="form-control" value="{{ $data->company }}" required name="company"
                                id="company" name="tel">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="services">ผลิตภัณฑ์/บริการ</label>
                            <input name="services" type="text" value="{{ $data->services }}" required
                                class="form-control" id="services">
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="emp_number">จำนวนพนักงานทั้งหมด</label>
                            <input name="emp_number" type="text" value="{{ $data->emp_number }}" required
                                class="form-control" id="emp_number">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="registration_number">เลขที่จดแจ้ง</label>
                            <input name="registration_number" type="text" value="{{ $data->registration_number }}"
                                class="form-control" id="registration_number">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="company_tel">เบอร์โทรติดต่อสำนักงาน</label>
                            <input name="company_tel" type="text" required value="{{ $data->company_tel }}"
                                class="form-control" id="company_tel">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="day_work">วันทำงาน</label>
                            <input name="day_work" type="text" value="{{ $data->day_work }}" class="form-control"
                                id="day_work">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="day_off">วันหยุด</label>
                            <input name="day_off" type="text" value="{{ $data->day_off }}" class="form-control">
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="company_address">สถานที่ตั้ง</label>
                            <textarea type="text" class="form-control" required name="company_address">{{ $data->company_address }}</textarea>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="bank_name">ธนาคาร</label>
                            <input name="bank_name" type="text" required value="{{ $data->bank_name }}"
                                class="form-control" id="bank_name">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="bank_number">เลขบัญชี <span
                                    style="color:rgb(47, 137, 255); font-size:10px;">ส่วนนี้สำหรับการโอนรายได้ค่าคอร์สเรียน</span></label>
                            <input name="bank_number" type="text" required value="{{ $data->bank_number }}"
                                class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="title_about_me">หัวข้อเกี่ยวกับเรา</label>
                            <input type="text" class="form-control" value="{{ @$data->title_about_me }}"
                                id="title_about_me" name="title_about_me">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="detail_about_me">รายละเอียดเกี่ยวกับเรา</label>
                            <textarea type="text" class="form-control" name="detail_about_me">{{ @$data->detail_about_me }}</textarea>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="exampleFormControlFile1">รูปภาพเกี่ยวกับบริษัทเพิ่มเติม</label>
                            <input type="file" class="form-control-file" id="company_img1" name="company_img1"><br>

                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                        @if($data->company_img1!='')
                        <img src="{{asset('images/profile/'.$data->company_img1)}}" width="300px" height="250px">
                        @endif
                        <input type="file" class="form-control-file" id="company_img2" name="company_img2"><br>
                        @if($data->company_img2!='')
                        <img src="{{asset('images/profile/'.$data->company_img2)}}" width="300px" height="250px">
                        @endif
                        <input type="file" class="form-control-file" id="company_img3" name="company_img3">
                        @if($data->company_img3!='')
                        <img src="{{asset('images/profile/'.$data->company_img3)}}" width="300px" height="250px">
                        @endif
                        </div>

                    </div>

                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <a href="{{ url('admin/company') }}" class="btn btn-secondary w-24">ย้อนกลับ</a>
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
