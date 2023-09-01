@extends('layouts.navber')
@section('head')
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.1.99/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/css/swiper.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
@endsection
@section('content')
    {{-- begin #รายละเอียด ประกาศหางาน --}}
    <div id="article-section1" class="bg-light">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body p-2 text-center">
                                    <img class="card-img-top rounded-circle"
                                         src="{{ asset('images/profile/'.$works->image_profile) }}"
                                         alt="Card image cap" style="width:100px;height:100px;object-fit:cover;">
                                    <h6 class="card-title">{{ $works->firstname }} {{ $works->lastname }} <i class='fas fa-check-circle text-success'></i></h6>
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <img src="{{ asset('images/icon-eye.png') }}">
                                            <p class="mb-1">เข้าชม</p>
                                            <h5>{{ $view }}</h5>
                                        </div>
                                        <div class="col-sm-4 text-center border-left border-right">
                                            <img src="{{ asset('images/icon-boxindex.png') }}">
                                            <p class="mb-1">งานที่ได้</p>
                                            <h5>{{ $portfolio_all }}</h5>
                                        </div>
                                        <div class="col-sm-4 text-center">
                                            <img src="{{ asset('images/icon-like.png') }}">
                                            <p class="mb-1">สำเร็จ</p>
                                            <h5>{{ round($percent) }}%</h5>
                                        </div>
                                    </div>
                                    <a class="btn btn-warning w-100 mt-2" href="{{ url('chat') }}"><i class='far fa-comment-dots'></i> ส่งข้อความ</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <h3>แก้ไขข้อมูลกระทู้งาน</h3>
                            <br>
                            <div id="app">
                                <form action="{{  URL::to('work/'.$id) }}" method="POST" enctype="multipart/form-data">
                                    <input name="_method" type="hidden" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">ชื่อกระทู้</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <input type="text" class="form-control" id="title" name="title" value="รับงานออกแบบวิศวะกรรมประปา" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">ประเภทกระทู้</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div class="form-check form-check-inline">
                                                <input id="type_wp_id" name="type_wp_id" type="radio" value="1" class="form-check-input" <?php echo ($works->tpye_wp_id == 1)?'checked':'' ?>>
                                                <label for="inlineCheckbox1" class="form-check-label" >หาผู้รับจ้าง</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="type_wp_id" name="type_wp_id" type="radio" value="2" class="form-check-input" <?php echo ($works->tpye_wp_id == 2)?'checked':'' ?>>
                                                <label for="inlineCheckbox2" class="form-check-label">หาผู้รับเหมา</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="type_wp_id" name="type_wp_id" type="radio" value="3" class="form-check-input" <?php echo ($works->tpye_wp_id == 3)?'checked':'' ?>>
                                                <label for="inlineCheckbox2" class="form-check-label">หางาน</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">หมวดหมู่</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            @foreach($works->tags as $keyB => $dataB)
                                                <input id="del_tags[{{ $keyB }}]" type="checkbox" name="del_tags[{{ $keyB }}]" value="{{ $dataB->id }}" /> <span class="badge badge-primary">{{ $dataB->name }}</span> <br>
                                            @endforeach
                                            <input type="hidden" name="count_tag" value="{{ count($works->tags) }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">เเพิ่มข้อมูล</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div v-for="(row , index) in rows" :row="row">
                                                <select name="tags[]" id="tags[]" class="form-control">
                                                    <option selected disabled value="">กรุณาเลือก</option>
                                                    @foreach($tags2 as $data)
                                                        <option value="{{ $data->id }}" >{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button v-on:click="addRow(1)" type="button" class="btn btn-outline-secondary"><i
                                                            class='fas fa-plus'></i></button>
                                                <button v-on:click="removeRow(0)" type="button" class="btn btn-outline-secondary"><i
                                                            class='fas fa-minus'></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">รายละเอียดข้อมูล</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <textarea rows="5" name="detail_data" id="detail_data" class="form-control">{!! $works->detail_data !!}</textarea>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">ภาพผลงาน</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <small>เลือกภาพที่ลบ</small>
                                            <br>
                                            @if($work_gallery != null)
                                                @foreach($work_gallery as $key => $data)
                                                    <input id="del_image[{{ $key }}]" type="radio" name="del_image[{{ $key }}]" value="{{ $data->id }}" />
                                                    <img src="{{  asset('images/gallery-work/'.$data->filename)  }}" style="width: 40%"><br>
                                                @endforeach
                                                <input type="hidden" name="count_gallery" value="{{ count($work_gallery) }}">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">เพิ่ม ภาพผลงาน</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <input type="file" class="form-control" id="work_gallery[]" name="work_gallery[]" multiple>
                                        </div>
                                        <br>
                                        <hr>
                                        <h4 class="form-group col-md-12">รายละเอียดการให้บริการ</h4><br>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">เลือกข้อมูลลบ</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            @if($services != null)
                                                @foreach($services as $key => $data)
                                                    <input id="del_services[{{ $key }}]" type="checkbox" name="del_services[{{ $key }}]" value="{{ $data->id }}" /> {{ $data->detail }} <br>
                                                @endforeach
                                                    <input type="hidden" name="count_services" value="{{ count($services) }}">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">เพิ่ม รายละเอียดการให้บริการ</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div v-for="(row , index) in rows2" :row="row">
                                                <input type="text" class="form-control" name="listService[]" id="listService[]">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button v-on:click="addRow2(1)" type="button" class="btn btn-outline-secondary"><i
                                                            class='fas fa-plus'></i></button>
                                                <button v-on:click="removeRow2(0)" type="button" class="btn btn-outline-secondary">
                                                    <i class='fas fa-minus'></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">ระยะเวลาในการทำงาน</label>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input  type="text" class="form-control" id="time_work" name="time_work" value="{{ $works->time_work }}">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <p>/ วัน</p>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">ราคาเริ่มต้น</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select id="price_range_id" name="price_range" class="form-control">
                                                <option selected disabled value="">กรุณาเลือก</option>
                                                @foreach($priceRange as $data)
                                                    <option  value="{{ $data->id }}" <?php echo ($data->id == $works->price_range_id)?'selected':'' ?>>{{ $data->price }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">รายละเอียดราคาเพิ่มเติม</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <textarea rows="5" name="detail_price" id="detail_price" class="form-control">{!! $works->detail_price !!}</textarea>
                                        </div>
                                        <br>
                                        <hr>
                                        <h4 class="form-group col-md-12">ขั้นตอนการทำงาน</h4><br>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">เลือกข้อมูลลบ</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            @if($procedures != null)
                                                @foreach($procedures as $key => $data)
                                                    <input id="del_procedures[{{ $key }}]" type="checkbox" name="del_procedures[{{ $key }}]" value="{{ $data->id }}" /> {{ $data->detail }} <br>
                                                @endforeach
                                                    <input type="hidden" name="count_procedures" value="{{ count($procedures) }}">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">เพิ่ม ขั้นตอนการทำงาน</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <div v-for="(row , index) in rows3" :row="row">
                                                <input type="text" class="form-control" name="work_procedures[]" id="work_procedures[]">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button v-on:click="addRow3(1)" type="button" class="btn btn-outline-secondary"><i
                                                            class='fas fa-plus'></i></button>
                                                <button v-on:click="removeRow3(0)" type="button" class="btn btn-outline-secondary">
                                                    <i class='fas fa-minus'></i></button>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="font-weight-bold">สถานที่ปฏิบัติงาน</label>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <select id="provinces_id" name="provinces_id" class="form-control">
                                                <option selected disabled value="">กรุณาเลือก</option>
                                                @foreach($provinces as $data)
                                                    <option  value="{{ $data->PROVINCE_ID }}" <?php echo ($data->PROVINCE_ID == $works->provinces_id)?'selected':'' ?>>{{ $data->PROVINCE_NAME }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group  col-md-4"></div>
                                        <div class="form-group  col-md-4">
                                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                        </div>
                                        <div class="form-group  col-md-4"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- end #รายละเอียด ประกาศหางาน --}}
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
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
    <script>
        $(function(){

            var swiper = new Swiper('.carousel-gallery .swiper-container', {
                effect: 'slide',
                speed: 900,
                slidesPerView: 3,
                spaceBetween: 20,
                simulateTouch: true,
                autoplay: {
                    delay: 5000,
                    stopOnLastSlide: false,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.carousel-gallery .swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    // when window width is <= 320px
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 5
                    },
                    // when window width is <= 480px
                    425: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    // when window width is <= 640px
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }
                }
            }); /*http://idangero.us/swiper/api/*/

        });
    </script>
@endsection