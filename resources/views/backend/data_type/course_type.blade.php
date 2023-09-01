@extends('layouts.nevber-admin2')
@section('head')
@endsection
@section('content')
    <!-- BEGIN: Content -->
    <div class="content">

        @if (session('success'))
            <div id="icon-alert" class="p-5">
                <div class="preview">
                    <div class="alert alert-success show flex items-center mb-2 success" style="color:white;" role="alert">
                        <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> {{ @session('success') }} </div>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div id="icon-alert" class="p-5">
                <div class="preview">
                    <div class="alert alert-danger show flex items-center mb-2 error" style="color:white;" role="alert">
                        <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> {{ @session('error') }} </div>
                </div>
            </div>
        @endif

        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                จัดการประเภทคอร์ส
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <a href="{{ url('admin/course_type/add') }}" class="btn btn-primary shadow-md mr-2"><span
                        class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>เพิ่มข้อมูล</a>
                {{-- <div class="dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-plus" class="w-4 h-4 mr-2"></i> New Category </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="users" class="w-4 h-4 mr-2"></i> New Group </a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            </div>
        </div>
        <!-- BEGIN: Striped Rows -->
        <div class="intro-y box mt-5">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                <h2 class="font-medium text-base mr-auto">
                    ตารางรายการประเภทคอร์ส
                </h2>
                <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                    {{-- <label class="form-check-label ml-0" for="show-example-8">Show example code</label>
            <input id="show-example-8" data-target="#striped-rows-table" class="show-code form-check-input mr-0 ml-3" type="checkbox"> --}}
                </div>
            </div>
            <div class="p-5" id="striped-rows-table">
                <div class="preview">
                    <div class="overflow-x-auto">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">รายการ</th>
                                    <th class="whitespace-nowrap">หลักสูตรแนะนำ</th>
                                    <th class="whitespace-nowrap">ผู้สร้าง</th>
                                    <th class="whitespace-nowrap">วันที่สร้าง</th>
                                    <th class="whitespace-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_type as $key => $st)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ @$st->name }}</td>
                                        <td>
                                            @if (@$st->recom_status == 1)
                                                ใช่
                                            @else
                                                ไม่ใช่
                                            @endif
                                        </td>
                                        <td>{{ @$st->Admin->name }}</td>

                                        <td>{{ @$st->created_at }}</td>
                                        <td>
                                            <a href="{{ url('admin/course_type/' . $st->id . '/view') }}"
                                                class="btn btn-sm btn-primary">จัดการ</a>
                                            <a href="{{ url('admin/course_type/' . $st->id . '/delete') }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('ยืนยันการลบ?')">ลบข้อมูล</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="source-code hidden">
                    <button data-target="#copy-striped-rows-table" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i
                            data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                    <div class="overflow-y-auto mt-3 rounded-md">
                        <pre class="source-preview" id="copy-striped-rows-table"> <code class="html"> HTMLOpenTagdiv class=&quot;overflow-x-auto&quot;HTMLCloseTag HTMLOpenTagtable class=&quot;table table-striped&quot;HTMLCloseTag HTMLOpenTagtheadHTMLCloseTag HTMLOpenTagtrHTMLCloseTag HTMLOpenTagth class=&quot;whitespace-nowrap&quot;HTMLCloseTag#HTMLOpenTag/thHTMLCloseTag HTMLOpenTagth class=&quot;whitespace-nowrap&quot;HTMLCloseTagFirst NameHTMLOpenTag/thHTMLCloseTag HTMLOpenTagth class=&quot;whitespace-nowrap&quot;HTMLCloseTagLast NameHTMLOpenTag/thHTMLCloseTag HTMLOpenTagth class=&quot;whitespace-nowrap&quot;HTMLCloseTagUsernameHTMLOpenTag/thHTMLCloseTag HTMLOpenTag/trHTMLCloseTag HTMLOpenTag/theadHTMLCloseTag HTMLOpenTagtbodyHTMLCloseTag HTMLOpenTagtrHTMLCloseTag HTMLOpenTagtdHTMLCloseTag1HTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTagAngelinaHTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTagJolieHTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTag@angelinajolieHTMLOpenTag/tdHTMLCloseTag HTMLOpenTag/trHTMLCloseTag HTMLOpenTagtrHTMLCloseTag HTMLOpenTagtdHTMLCloseTag2HTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTagBradHTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTagPittHTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTag@bradpittHTMLOpenTag/tdHTMLCloseTag HTMLOpenTag/trHTMLCloseTag HTMLOpenTagtrHTMLCloseTag HTMLOpenTagtdHTMLCloseTag3HTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTagCharlieHTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTagHunnamHTMLOpenTag/tdHTMLCloseTag HTMLOpenTagtdHTMLCloseTag@charliehunnamHTMLOpenTag/tdHTMLCloseTag HTMLOpenTag/trHTMLCloseTag HTMLOpenTag/tbodyHTMLCloseTag HTMLOpenTag/tableHTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Striped Rows -->
    </div>
    <!-- END: Content -->
@endsection
@section('script')
@endsection
