@extends('layouts.navber')
@section('head')
    {{-- @include('sweetalert::alert') --}}
@endsection
@section('content')
    <div id="app">
        {{-- begin #Profile --}}
        <div id="traning-section1" class="bg-orange py-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 p-2">
                        <img src="{{ asset('images/profile/'.$profile->image_profile) }}" class="rounded-circle mb-2 mw-100" width="200" height="200"><br>
                    </div>
                    <div class="col-sm-8 p-2">
                        <h4>{{ $profile->firstname }} {{ $profile->lastname }} <a class="pointer" data-toggle="modal" data-target="#headprofile"><i class='fas fa-edit'></i></a></h4>
                        <h6>{{ $typeUser }}</h6>
                        <p><i class='fas fa-star'></i> <span>@if($profile->review_profile != null){{ $profile->review_profile }}@else 0.0 @endif</span>
                            <i class='fas fa-coins'></i> <span>@if($profile->coins != null){{ $profile->coins }}@else 0 @endif</span></p>
                        <a class="btn btn-dark" href="{{ url('chat') }}"><i class='fas fa-comment-alt'></i> ข้อความ</a>
                    </div>
                </div>
             </div>
        </div>

        <!-- Modal  Edit Profile-->
        <div class="modal fade" id="headprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            {{-- {!! Form::model($profile,['url' => ['profile/'.$profile->id],'method' => 'put' ,'files'=> true]) !!} --}}
                <input type="hidden" name="type" value="1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขโปรไฟล์</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Username</label>
                                {{-- {!!  Form::text('username',null,['class' => 'form-control' ]) !!} --}}
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">ชื่อจริง</label>
                                    {{-- {!!  Form::text('firstname',null,['class' => 'form-control' ]) !!} --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">นามสกุล</label>
                                    {{-- {!!  Form::text('lastname',null,['class' => 'form-control' ]) !!} --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">รูปภาพโปรไฟล์</label>
                                {{-- {!!  Form::file('image_profile',['class' => 'form-control']) !!} --}}
                                <br>
                                @if ($profile->image_profile != "")
                                    <center>
                                        <img src="{{ url('images/profile/'.$profile->image_profile) }}" style="width: 20%" alt="">
                                    </center>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                {{-- {!! Form::text('email', old('email'), ['class'=>'form-control']) !!} --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">เบอร์โทรติดต่อ</label>
                                {{-- {!!  Form::text('tel',null,['class' => 'form-control' ]) !!} --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">จังหวัด</label>
                                {{-- {!!  Form::select('provinces_id', $provinces, null, ['id' => 'provinces_id','class' => 'form-control' , 'placeholder' => 'ทั้งหมด' ]) !!} --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">วัน/เดือน/ปีเกิด</label>
                                {{-- {!!  Form::date('birthday',null,['class' => 'form-control' ]) !!} --}}
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">เปลี่ยนรหัสผ่านใหม่</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                {{--<div class="form-group col-md-6">--}}
                                    {{--<label for="inputPassword4" class="w-100">&nbsp;&nbsp;&nbsp;</label>--}}
                                    {{--<button class="btn btn-outline-primary">เปลี่ยน</button>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">บันทึก</button>
                        </div>
                    </div>
                </div>
            {{-- {!! Form::close() !!} --}}
        </div>

        <div id="traning-section2" class="bg-light">
            <div class="container py-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-deck mb-3">
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">ข้อมูลเบื้องต้น</div>
                                <div class="card-body p-2">
                                    <div class="form-group row small mb-0">
                                        <label for="staticEmail" class="col-sm-6 col-form-label">เป็นสมาชิกเมื่อ</label>
                                        <div class="col-sm-6 text-right">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ date('d/m/Y',strtotime($profile->created_at)) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row small mb-0">
                                        <label for="staticEmail" class="col-sm-6 col-form-label">ขายงานแล้ว</label>
                                        <div class="col-sm-6 text-right">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $portfolio_success }} ครั้ง">
                                        </div>
                                    </div>
                                    <div class="form-group row small mb-0">
                                        <label for="staticEmail" class="col-sm-6 col-form-label">อัตราการทำงานสำเร็จ</label>
                                        <div class="col-sm-6 text-right">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $percent }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">ยืนยันตัวตน <a class="pointer" data-toggle="modal" data-target="#verify"><i class='fas fa-edit'></i></a></div>
                                <div class="card-body p-2">
                                    @if($profile->image_card)
                                        <span class="fa-stack fa-md">
                                        <a href="{{ asset('images/profile/card/'.$profile->image_card) }}" download>
                                            <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                            <i class="far fa-address-card fa-stack-1x fa-inverse" title="สำเนาบัตรประชาชน"></i>
                                        </a>
                                        </span>
                                    @endif
                                    @if($profile->email)
                                    <span class="fa-stack fa-md">
                                  <i class="fas fa-circle fa-stack-2x text-black-50"></i>
                                  <i class="far fa-envelope fa-stack-1x fa-inverse" title="Email : {{ $profile->email }}"></i>
                                </span>
                                    @endif
                                @if($profile->tel)
                                <span class="fa-stack fa-md">
                                  <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                  <i class="fas fa-phone fa-stack-1x fa-inverse" title="เบอร์โทร : {{ $profile->tel }}"></i>
                                </span>
                                @endif
                                </div>
                            </div>
                            <!-- Modal ยืนยันตัวตน -->
                            <div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                {{-- {!! Form::model($profile,['url' => ['profile/'.$profile->id],'method' => 'put' ,'files'=> true]) !!} --}}
                                <input type="hidden" name="type" value="2">
                                <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ยืนยันตัวตนเพิ่มเติม</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">สำเนาบัตรประชาชน</label>
                                                    <input type="file" name="fileCard"  class="form-control-file" id="fileCard">
                                                </div>
                                                @if ($profile->image_card != "")
                                                    <center>
                                                           <span class="fa-stack fa-md">
                                                               <a href="{{ asset('images/profile/card/'.$profile->image_card) }}" download>
                                                                   <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                                                   <i class="far fa-address-card fa-stack-1x fa-inverse" title="สำเนาบัตรประชาชน"></i>
                                                               </a>
                                                            </span>
                                                    </center>
                                                @endif
                                                {{--<div class="form-group">--}}
                                                    {{--<label for="exampleFormControlFile1">เอกสารอื่นๆ</label>--}}
                                                    {{--<input type="file" class="form-control-file" id="exampleFormControlFile1">--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>
                                {{-- {!! Form::close() !!} --}}
                            </div>
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">ประสบการณ์การทำงาน <a class="pointer" data-toggle="modal" data-target="#experience"><i class='fas fa-edit'></i></a></div>
                                <div class="card-body p-2">
                                    <div class="form-group row small mb-0">
                                        <label for="staticEmail" class="col-sm-6 col-form-label">บริษัท</label>
                                        <div class="col-sm-6 text-right">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                   value="{{ ($profile->company == "")?'-':$profile->company }}">
                                        </div>
                                    </div>
                                    <div class="form-group row small mb-0">
                                        <label for="staticEmail" class="col-sm-6 col-form-label">รายละเอียด</label>
                                        @if($profile->details)
                                            <div class="col-sm-6 text-left">
                                            <a class="pointer" data-toggle="modal" data-target="#experience2">
                                                <i class='fas fa-eye'></i>
                                            </a>
                                            </div>
                                        @else
                                        <div class="col-sm-6 text-right">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="-">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Modal ประสบการณ์การทำงาน-->
                            <div class="modal fade" id="experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                {{-- {!! Form::model($profile,['url' => ['profile/'.$profile->id],'method' => 'put' ,'files'=> true]) !!} --}}
                                    <input type="hidden" name="type" value="3">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ประสบการณ์การทำงาน</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">บริษัท<span class="text-danger">*</span></label>
                                                    <input type="text" name="company" class="form-control" id="company" value="{{ $profile->company }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">รายละเอียด<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="details" name="details" rows="5">
                                                        <?php echo htmlspecialchars($profile->details); ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>
                                {{-- {!! Form::close() !!} --}}
                            </div>
                            <div class="modal fade" id="experience2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form>
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">รายละเอียด {{ ($profile->company == "")?'-':$profile->company }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    {!! $profile->details !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">ใบอนุญาตและรางวัล <a class="pointer" data-toggle="modal" data-target="#certifiacte"><i class='fas fa-edit'></i></a></div>
                                <div class="card-body p-2">
                                 @if($profile->filename_reference != null)
                                     <span class="fa-stack fa-md">
                                     <a href="{{ asset('images/profile/reference/'.$profile->filename_reference) }}" download>
                                         <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                         <i class="far fa-file-alt fa-stack-1x fa-inverse" title="เอกสารอ้างอิง/ใบอนุญาต"></i>
                                     </a></span>
                                 @endif
                                @if ($profile->filename_award != "")
                                    <span class="fa-stack fa-md">
                                      <a href="{{ asset('images/profile/reference/'.$profile->filename_award) }}" download>
                                        <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                  <i class="fas fa-award fa-stack-1x fa-inverse" title="รางวัล"></i>
                                     </a>
                                </span>
                                @endif
                                @if ($profile->filename_diploma != "")
                                <span class="fa-stack fa-md">
                                      <a href="{{ asset('images/profile/reference/'.$profile->filename_diploma) }}" download>
                                           <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                  <i class="far fa-address-card fa-stack-1x fa-inverse" title="ภาพประกาศนียบัตร"></i>
                                     </a>
                                </span>
                                 @endif
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="certifiacte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                {{-- {!! Form::model($profile,['url' => ['profile/'.$profile->id],'method' => 'put' ,'files'=> true]) !!} --}}
                                    <input type="hidden" name="type" value="4">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">เอกสารใบอนุญาติและรางวัล</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">ภาพใบอนุญาต</label>
                                                    <input type="file" class="form-control-file" id="filename_reference" name="filename_reference">
                                                    @if ($profile->filename_reference != "")
                                                        <center>
                                                           <span class="fa-stack fa-md">
                                                               <a href="{{ asset('images/profile/reference/'.$profile->filename_reference) }}" download>
                                                                   <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                                                   <i class="far fa-address-card fa-stack-1x fa-inverse" title="สำเนาบัตรประชาชน"></i>
                                                               </a>
                                                            </span>
                                                        </center>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">ภาพรางวัล</label>
                                                    <input type="file" class="form-control-file" id="filename_award" name="filename_award">
                                                    @if ($profile->filename_award != "")
                                                        <center>
                                                           <span class="fa-stack fa-md">
                                                               <a href="{{ asset('images/profile/reference/'.$profile->filename_award) }}" download>
                                                                   <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                                                   <i class="far fa-address-card fa-stack-1x fa-inverse" title="สำเนาบัตรประชาชน"></i>
                                                               </a>
                                                            </span>
                                                        </center>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">ภาพประกาศนียบัตร</label>
                                                    <input type="file" class="form-control-file" id="filename_diploma" name="filename_diploma">
                                                    @if ($profile->filename_diploma != "")
                                                        <center>
                                                           <span class="fa-stack fa-md">
                                                               <a href="{{ asset('images/profile/reference/'.$profile->filename_diploma) }}" download>
                                                                   <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                                                   <i class="far fa-address-card fa-stack-1x fa-inverse" title="สำเนาบัตรประชาชน"></i>
                                                               </a>
                                                            </span>
                                                        </center>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">บันทึก</button>
                                            </div>
                                        </div>
                                    </div>
                                {{-- {!! Form::close() !!} --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-deck mb-3">
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">อบรม</div>
                                <div class="card-body p-2">
                                    <p class="font-weight-bold">สอบออนไลน์ (คอร์ดหลัก)</p>
                                    <h6>สำหรับผู้ว่าจ้าง</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $courses2 }}%;" aria-valuenow="{{ $courses2 }}" aria-valuemin="0" aria-valuemax="100">{{ $courses2 }}%</div>
                                    </div>
                                    <h6>สำหรับผู้รับจ้าง</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $courses3 }}%;" aria-valuenow="{{ $courses3 }}" aria-valuemin="0" aria-valuemax="100">{{ $courses3 }}%</div>
                                    </div>
                                    <h6>สำหรับผู้รับเหมา</h6>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $courses4 }}%;" aria-valuenow="{{ $courses4 }}" aria-valuemin="0" aria-valuemax="100">{{ $courses4 }}%</div>
                                    </div>
                                    {{--<div class="bg-light p-1 my-1">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-8">--}}
                                                {{--<p class="mb-0">ชื่อบทความอบรม <span class="badge badge-primary font-weight-light">ประเภทxxx</span></p>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-4">--}}
                                                {{--<p class="text-black-50 mb-0">ดูครบ</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<br>--}}
                                    {{--<center>--}}
                                        {{--<button class="btn btn-sm btn-outline-secondary" style="width: 100%!important;">ดูเพิ่มเติม</button>--}}
                                    {{--</center>--}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-2 bg-transparent font-weight-bold">สอบออนไลน์ (คอร์ดหลัก)</div>
                                <div class="card-body p-2">
                                    @if(count($courseAnswer) > 0)
                                        <p class="font-weight-bold">ประวัติการเข้าสอบ</p>
                                        @foreach($courseAnswer as $key => $value)
                                           <div class="bg-light p-1 my-1">
                                               <div class="row">
                                                   <div class="col-md-8">
                                                       <p class="mb-0">{{ $value->course_name }}
                                                           {{--<span class="badge badge-primary font-weight-light">ประเภทxxx</span>--}}
                                                           <span class="badge badge-{{ $value->answer_css }} font-weight-light">{{ $value->answer_text }}</span></p>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <p class="text-black-50 mb-0">ทดสอบเมื่อ {{ date('d/m/Y',strtotime($value->answer_start_date)) }}</p>
                                                   </div>
                                               </div>
                                           </div>
                                        @endforeach
                                        <div id="divBoxComment" style="display:none;">
                                            @foreach($courseAnswer_skip as $key => $value)
                                                <div class="bg-light p-1 my-1">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p class="mb-0">{{ $value->course_name }}
                                                                {{--<span class="badge badge-primary font-weight-light">ประเภทxxx</span>--}}
                                                                <span class="badge badge-{{ $value->answer_css }} font-weight-light">{{ $value->answer_text }}</span></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p class="text-black-50 mb-0">ทดสอบเมื่อ {{ date('d/m/Y',strtotime($value->answer_start_date)) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <br>
                                        @if(count($courseAnswer_skip) > 0)
                                            <center>
                                                <button id="btnComment" class="btn btn-sm btn-outline-secondary"
                                                        onClick="showHideDiv()" style="width: 100%!important;">ดูเพิ่มเติม</button>
                                            </center>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($works) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-white p-2 mb-3">
                            <h5>งานของฉัน (<span>{{ count($works) }}</span>)</h5>
                            @foreach($works as $key => $work)
                            <div class="card mb-2">
                                <div class="row no-gutters">
                                    <div class="col-md-7">
                                        <div class="card-body p-2">
                                            <h6>{{ $work->title }}</h6>
                                            <small><i class="material-icons">&#xe417;</i> {{ $work->sum }} </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body p-2">
                                            <a href="{{ url('work/'.$work->id) }}" class="btn btn-sm btn-outline-secondary">ดูกระทู้</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card-body p-2">
                                            <p class="card-text"><small class="text-muted" id="text{{$key}}"></small></p>
                                            <script type="text/javascript">
                                                function getNumberOfDays(year, month) {
                                                    var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                    return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                }
                                                var timeA = new Date(); // วันเวลาปัจจุบัน
                                                var timeB = new Date("{{ $work->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
                                                // var day_count = getNumberOfDays(timeB.getFullYear() , timeB.getMonth());
                                                // console.log(day_count);
                                                var timeDifference = timeA.getTime() - timeB.getTime();
                                                if (timeDifference >= 0) {
                                                    timeDifference = timeDifference / 1000;
                                                    timeDifference = Math.floor(timeDifference);
                                                    var wan = Math.floor(timeDifference / 86400);
                                                    var l_wan = timeDifference % 86400;
                                                    var hour = Math.floor(l_wan / 3600);
                                                    var l_hour = l_wan % 3600;
                                                    var minute = Math.floor(l_hour / 60);
                                                    var second = l_hour % 60;
                                                    var showDate = document.getElementById('text{{$key}}');
                                                    if(wan >= 365){
                                                        //Year
                                                        var show_year = wan / 365;
                                                        showDate.innerHTML = show_year.toFixed(0)+" ปีที่ผ่านมา";
                                                    }else if(wan >= 30 && wan < 365){
                                                        //month
                                                        var show_month = wan / 30;
                                                        showDate.innerHTML = show_month.toFixed(0)+" เดือนที่ผ่านมา";
                                                    }else if(wan >=  7 && wan < 30){
                                                        //week
                                                        var show_week = wan / 7;
                                                        showDate.innerHTML = show_week.toFixed(0)+" สัปดาห์ทีผ่านมา";
                                                    }else if(hour >= 24 && wan <  7){
                                                        //date
                                                        var show_day = (wan * 24)/24;
                                                        showDate.innerHTML = show_day.toFixed(0)+" วันทีผ่านมา";
                                                    }else if(hour >= 0 && hour < 24){
                                                        //hour
                                                        showDate.innerHTML = hour+" ชั่วโมงผ่านมา";
                                                    }else if(minute > 0 && 0 <= hour){
                                                        //minute
                                                        showDate.innerHTML = minute+" นาทีผ่านมา";
                                                    }else if(second > 0 && 0 <= minute){
                                                        //second
                                                        showDate.innerHTML = second+" วินาทีผ่านมา";
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="container-fluid py-5 text-center middle">
                                <div class="row">
                                    <div class="pagination">
                                        {{$works->appends(['page_work' => $works->currentPage()])->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(count($projectAuction) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-white p-2 mb-3">
                            <h5>โครงการของฉัน (<span>{{ count($projectAuction) }}</span>)</h5>
                            @foreach($projectAuction as $key => $data)
                            <div class="card mb-2">
                                <div class="row no-gutters">
                                    <div class="col-md-5">
                                        <div class="card-body p-2">
                                            <h6>{{ $data->project_name }}</h6>
                                            <small><i class="material-icons">&#xe7ef;</i> {{ $data->sum }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body p-2">
                                            <day2 name="{{ $data->name_budding }}" project_id="{{ $data->id }}"
                                                       date="{{ $data->date_end }} {{ $data->time_end }}"></day2>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="card-body p-2">
                                            <a href="{{ url('projectauction/'.$data->id) }}"
                                               class="btn btn-sm btn-outline-secondary">ดูข้อมูล</a>
                                            {{-- @if( $data->name_budding != null) --}}
                                            <a href="{{ url('quotation/dashboard/'.$data->id) }}"
                                               class="btn btn-sm btn-outline-secondary">Dashboard</a>
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="card-body p-2">
                                            <p class="card-text"><small class="text-muted" id="text2{{$key}}"></small></p>
                                            <script type="text/javascript">
                                                function getNumberOfDays(year, month) {
                                                    var isLeap = ((year % 4) == 0 && ((year % 100) != 0 || (year % 400) == 0));
                                                    return [31, (isLeap ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
                                                }
                                                var timeA = new Date(); // วันเวลาปัจจุบัน
                                                var timeB = new Date("{{ $data->created_at }}"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
                                                // var day_count = getNumberOfDays(timeB.getFullYear() , timeB.getMonth());
                                                // console.log(day_count);
                                                var timeDifference = timeA.getTime() - timeB.getTime();
                                                if (timeDifference >= 0) {
                                                    timeDifference = timeDifference / 1000;
                                                    timeDifference = Math.floor(timeDifference);
                                                    var wan = Math.floor(timeDifference / 86400);
                                                    var l_wan = timeDifference % 86400;
                                                    var hour = Math.floor(l_wan / 3600);
                                                    var l_hour = l_wan % 3600;
                                                    var minute = Math.floor(l_hour / 60);
                                                    var second = l_hour % 60;
                                                    var showDate = document.getElementById('text2{{$key}}');
                                                    if(wan >= 365){
                                                        //Year
                                                        var show_year = wan / 365;
                                                        showDate.innerHTML = show_year.toFixed(0)+" ปีที่ผ่านมา";
                                                    }else if(wan >= 30 && wan < 365){
                                                        //month
                                                        var show_month = wan / 30;
                                                        showDate.innerHTML = show_month.toFixed(0)+" เดือนที่ผ่านมา";
                                                    }else if(wan >=  7 && wan < 30){
                                                        //week
                                                        var show_week = wan / 7;
                                                        showDate.innerHTML = show_week.toFixed(0)+" สัปดาห์ทีผ่านมา";
                                                    }else if(hour >= 24 && wan <  7){
                                                        //date
                                                        var show_day = (wan * 24)/24;
                                                        showDate.innerHTML = show_day.toFixed(0)+" วันทีผ่านมา";
                                                    }else if(hour >= 0 && hour < 24){
                                                        //hour
                                                        showDate.innerHTML = hour+" ชั่วโมงผ่านมา";
                                                    }else if(minute > 0 && 0 <= hour){
                                                        //minute
                                                        showDate.innerHTML = minute+" นาทีผ่านมา";
                                                    }else if(second > 0 && 0 <= minute){
                                                        //second
                                                        showDate.innerHTML = second+" วินาทีผ่านมา";
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="container-fluid py-5 text-center middle">
                                <div class="row">
                                    <div class="pagination">
                                        {{$projectAuction->appends(['page_project' => $projectAuction->currentPage()])->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


    {{-- end #Profile --}}
    <script src="{{ asset('js/app.js') }}" ></script>

@endsection
@section('script')
    <script type="text/javascript">
        function showHideDiv() {
            var srcElement = document.getElementById('divBoxComment');
            if (srcElement != null) {
                if (srcElement.style.display == "block") {
                    // console.log(1);
                    document.getElementById('divBoxComment').style.display = 'none';
                } else {
                    // console.log(2);
                    document.getElementById('btnComment').style.display = 'none';
                    document.getElementById('divBoxComment').style.display = 'block';
                }
                return false;
            }
        }
    </script>
    @if(session()->has('status'))
        <script>
            Swal({
                type: 'success',
                title: "<?php echo session()->get('status'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session()->has('gb_success'))
        <script>
            Swal({
                position: 'top-end',
                type: 'success',
                title: "<?php echo session()->get('gb_success'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session()->has('gb_error'))
        <script>
            Swal({
                position: 'top-end',
                type: 'error',
                title: "<?php echo session()->get('gb_error'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
