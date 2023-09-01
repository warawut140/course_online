@extends('layouts.navber')
@section('head')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- <script src="https://rawgit.com/vuejs/vue/dev/dist/vue.js"></script> --}}
    <script>
        function checkTypeUser(id) {
            if (id == 2) {
                $('#typeUser').show();
            } else {
                $('#typeUser').hide();
            }
        }
    </script>
    <style>
        .bg-light2 {
            background-color: #8B0900;
            background-image: url("{{ asset('image/bg.png') }}");
        }
    </style>
@endsection
@section('content')
    <div id="app">
        {{-- begin #register --}}
        <div id="register-section1" class="bg-light2">
            <div class="container py-5">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">สมัครสมาชิก</h5>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ url('register_full') }}" id="searchForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- <div class="form-row align-items-center">
                                     <div class="col-auto">
                                         <label class="form-label" for="inlineFormInput">ประเภท</label>
                                     </div>
                                     <div class="col-auto">
                                         <div class="form-check mb-2">
                                             <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount1" value="1">
                                             <label class="form-check-label" for="autoSizingCheck">
                                                 ผู้ว่าจ้าง
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-auto">
                                         <div class="form-check mb-2">
                                             <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount2" value="2" onchange="checkTypeUser(2)">
                                             <label class="form-check-label" for="autoSizingCheck">
                                                 ผู้รับจ้าง
                                             </label>
                                         </div>
                                     </div>
                                     <div class="col-auto my-1" id="typeUser">
                                         <select class="form-control my-1 mr-sm-2" id="inlineFormCustomSelect" name="typeUser">
                                             <option selected>Choose...</option>
                                             <option value="1">Advisor</option>
                                             <option value="2">Designer</option>
                                             <option value="3">QS</option>
                                             <option value="4">QC</option>
                                         </select>
                                     </div>
                                     <div class="col-auto">
                                         <div class="form-check mb-2">
                                             <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="typeAccount3"  value="3">
                                             <label class="form-check-label" for="autoSizingCheck">
                                                 ผู้รับเหมา
                                             </label>
                                         </div>
                                     </div>
                                 </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ประเภท</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="typeAccount1"
                                                id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">ผู้เรียน</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="typeAccount1"
                                                id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">ผู้ประกอบการ</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputEmail4">คำนำหน้า</label>
                                            {{-- {!!  Form::select('prefixe_id', $prefixes, null, ['id' => 'prefixe_id','class' => 'form-control' , 'placeholder' => 'เลือก' ]) !!} --}}
                                            <?php
                                            $prefixes = App\Models\Prefix::select('name', 'id')->get();
                                            ?>
                                            <select class="form-control" name="prefixe_id" required>
                                                <option value="">เลือก</option>
                                                @foreach ($prefixes as $prefixe)
                                                    <option value="{{ $prefixe->id }}">{{ $prefixe->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="inputEmail4">ชื่อจริง</label>
                                            <input name="firstname" type="text" required class="form-control"
                                                id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">นามสกุล</label>
                                            <input name="lastname" type="text" required class="form-control"
                                                id="inputPassword4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">เบอร์โทร</label>
                                        <input type="text" class="form-control" required maxlength="10"
                                            id="exampleInputEmail1" name="tel">
                                    </div>
                                    <a href="ref"></a>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input id="name" type="text" required
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">อีเมล์</label>
                                        <input id="email" type="email" required
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">รหัสผ่าน</label>
                                        <input id="password" type="password" required
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ยืนยัน รหัสผ่าน</label>
                                        <input id="password-confirm" required type="password" class="form-control"
                                            name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">รูปประจำตัว</label>
                                        <input type="file" required class="form-control-file"
                                            id="exampleFormControlFile1" name="imageProfile">
                                    </div>
                                    {{-- <div class="form-group">
                                     <label for="exampleFormControlFile1">รูปสำเนาบัตรประชาชน</label>
                                     <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileCard">
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleFormControlFile1">เอกสารอ้างอิง/ใบอนุญาต เพื่อใช้ยืนยันตัวตน</label>
                                     <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileProfile">
                                 </div> --}}
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="i_accept" id="i_accept">
                                        <label class="form-check-label" for="exampleCheck1">ยอมรับ
                                            <a class="text-primary pointer" data-toggle="modal"
                                                data-target="#exampleModal">
                                                ข้อตกลงและเงื่อนไข</a> การสมัครสมาชิก
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn_send" id="btn_send"
                                            class="btn btn-success w-100" disabled="disabled">สมัครสมาชิก</button>
                                        {{-- <button type="button" name="btn_send" id="btn_send" class="btn btn-success w-100" data-toggle="modal" data-target="#otpModal"  disabled="disabled">สมัครสมาชิก</button> --}}
                                    </div>
                                    <modal-otp></modal-otp>
                                    <div class="form-group text-center">
                                        <p>มีบัญชีแล้ว? <a href="{{ url('login') }}">เข้าสู่ระบบ</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal ข้อตกลงและเงื่อนไข-->
        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ข้อตกลงและเงื่อนไข</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                        </button>
                    </div>
                    <div class="modal-body text-justify">
                        นโยบายความเป็นส่วนตัว <br>
                        Eduflix (เอ็ดดูฟลิกซ์) ให้ความสำคัญกับการคุ้มครองข้อมูลส่วนบุคคลของคุณ โดยนโยบายความเป็นส่วนตัวฉบับนี้ได้อธิบายแนวปฏิบัติเกี่ยวกับการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคล รวมถึงสิทธิต่าง ๆ ของเจ้าของข้อมูลส่วนบุคคล ตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล
                        <br>
                        การเก็บรวบรวมข้อมูลส่วนบุคคล  <br>
                        เราจะเก็บรวบรวมข้อมูลส่วนบุคคลที่ได้รับโดยตรงจากคุณผ่านช่องทาง ดังต่อไปนี้ <br>
                        •	การสมัครสมาชิก <br>
                        •	โทรศัพท์ <br>
                        •	อีเมล <br>
                        เราอาจเก็บรวบรวมข้อมูลส่วนบุคคลของคุณที่เราเข้าถึงได้จากแหล่งอื่น เช่น เสิร์ชเอนจิน โซเชียลมีเดีย หน่วยงานราชการ บุคคลภายนอกอื่นๆ เป็นต้น <br>

                        ประเภทข้อมูลส่วนบุคคลที่เก็บรวบรวม <br>
                        •	ข้อมูลส่วนบุคคล เช่น ชื่อ นามสกุล อายุ วันเดือนปีเกิด สัญชาติ เลขประจำตัวประชาชน หนังสือเดินทาง เป็นต้น <br>
                        •	ข้อมูลการติดต่อ เช่น ที่อยู่ หมายเลขโทรศัพท์ อีเมล เป็นต้น <br>
                        •	ข้อมูลบัญชี เช่น บัญชีผู้ใช้งาน ประวัติการใช้งาน เป็นต้น <br>
                        •	หลักฐานแสดงตัวตน เช่น สำเนาบัตรประจำตัวประชาชน สำเนาหนังสือเดินทาง เป็นต้น <br>
                        •	ข้อมูลการทำธุรกรรมและการเงิน เช่น ประวัติการสั่งซื้อ รายละเอียดบัตรเครดิต บัญชีธนาคาร เป็นต้น <br>
                        •	ข้อมูลทางเทคนิค เช่น IP Address, Cookie ID, ประวัติการใช้งานเว็บไซต์ (Activity Log) เป็นต้น <br>
                        •	ข้อมูลอื่นๆ เช่น รูปภาพ ภาพเคลื่อนไหว และข้อมูลอื่นใดที่ถือว่าเป็นข้อมูลส่วนบุคคลตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล <br>
                        เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลอ่อนไหว ดังต่อไปนี้ เมื่อเราได้รับความยินยอมโดยชัดแจ้งจากคุณ เว้นแต่กฎหมายกำหนดให้ทำได้  <br>

                        •	เชื้อชาติ <br>
                        •	เผ่าพันธุ์ <br>
                        •	ศาสนาหรือปรัชญา <br>
                        •	ข้อมูลสุขภาพ <br>
                        •	ความพิการ <br>
                        •	ข้อมูลสหภาพแรงงาน <br>
                        •	ข้อมูลชีวภาพ เช่น ข้อมูลภาพจำลองใบหน้า ข้อมูลจำลองม่านตา ข้อมูลจำลองลายนิ้วมือ <br>
                        ข้อมูลอื่นใดที่กระทบต่อข้อมูลส่วนบุคคลของคุณตามที่คณะกรรมการคุ้มครองข้อมูลส่วนบุคคลประกาศกำหนด <br>

                        ผู้เยาว์ <br>
                        หากคุณมีอายุต่ำกว่า 20 ปีหรือมีข้อจำกัดความสามารถตามกฎหมาย เราอาจเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เราอาจจำเป็นต้องให้พ่อแม่หรือผู้ปกครองของคุณให้ความยินยอมหรือที่กฎหมายอนุญาตให้ทำได้ หากเราทราบว่ามีการเก็บรวบรวมข้อมูลส่วนบุคคลจากผู้เยาว์โดยไม่ได้รับความยินยอมจากพ่อแม่หรือผู้ปกครอง เราจะดำเนินการลบข้อมูลนั้นออกจากเซิร์ฟเวอร์ของเรา
                        <br>
                        วิธีการเก็บรักษาข้อมูลส่วนบุคคล <br>
                        เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณในรูปแบบเอกสารและรูปแบบอิเล็กทรอนิกส์ <br>
                        <br>
                        เราเก็บรักษาข้อมูลส่วนบุคคลของคุณ ดังต่อไปนี้ <br>
                        •	เซิร์ฟเวอร์บริษัทของเราในประเทศไทย <br>
                        •	ผู้ให้บริการเซิร์ฟเวอร์ในต่างประเทศ <br>

                        การประมวลผลข้อมูลส่วนบุคคล <br>
                        เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณเพื่อวัตถุประสงค์ดังต่อไปนี้ <br>

                        •	เพื่อสร้างและจัดการบัญชีผู้ใช้งาน <br>
                        •	เพื่อจัดส่งสินค้าหรือบริการ <br>
                        •	เพื่อปรับปรุงสินค้า บริการ หรือประสบการณ์การใช้งาน <br>
                        •	เพื่อการบริหารจัดการภายในบริษัท <br>
                        •	เพื่อการตลาดและการส่งเสริมการขาย <br>
                        •	เพื่อการบริการหลังการขาย <br>
                        •	เพื่อรวบรวมข้อเสนอแนะ <br>
                        •	เพื่อชำระค่าสินค้าหรือบริการ <br>
                        •	เพื่อปฏิบัติตามข้อตกลงและเงื่อนไข (Terms and Conditions) <br>
                        •	เพื่อปฏิบัติตามกฎหมายและกฎระเบียบของหน่วยงานราชการ <br>

                        การเปิดเผยข้อมูลส่วนบุคคล <br>
                        เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณให้แก่ผู้อื่นภายใต้ความยินยอมของคุณหรือที่กฎหมายอนุญาตให้เปิดเผยได้ ดังต่อไปนี้
                        <br>
                        การบริหารจัดการภายในองค์กร <br>
                        เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณภายในบริษัทเท่าที่จำเป็นเพื่อปรับปรุงและพัฒนาสินค้าหรือบริการของเรา เราอาจรวบรวมข้อมูลภายในสำหรับสินค้าหรือบริการต่าง ๆ ภายใต้นโยบายนี้เพื่อประโยชน์ของคุณและผู้อื่นมากขึ้น
                        <br>
                        ผู้ให้บริการ <br>
                        เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณบางอย่างให้กับผู้ให้บริการของเราเท่าที่จำเป็นเพื่อดำเนินงานในด้านต่าง ๆ เช่น การชำระเงิน การตลาด การพัฒนาสินค้าหรือบริการ เป็นต้น ทั้งนี้ ผู้ให้บริการมีนโยบายความเป็นส่วนตัวของตนเอง
                        <br>
                        พันธมิตรทางธุรกิจ <br>
                        เราอาจเปิดเผยข้อมูลบางอย่างกับพันธมิตรทางธุรกิจเพื่อติดต่อและประสานงานในการให้บริการสินค้าหรือบริการ และให้ข้อมูลเท่าที่จำเป็นเกี่ยวกับความพร้อมใช้งานของสินค้าหรือบริการ
                        <br>
                        การบังคับใช้กฎหมาย <br>
                        ในกรณีที่มีกฎหมายหรือหน่วยงานราชการร้องขอ เราจะเปิดเผยข้อมูลส่วนบุคคลของคุณเท่าที่จำเป็นให้แก่หน่วยงานราชการ เช่น ศาล หน่วยงานราชการ เป็นต้น
                        <br>
                        การโอนข้อมูลส่วนบุคคลไปต่างประเทศ <br>
                        เราอาจเปิดเผยหรือโอนข้อมูลส่วนบุคคลของคุณไปยังบุคคล องค์กร หรือเซิร์ฟเวอร์ (Server) ที่ตั้งอยู่ในต่างประเทศ โดยเราจะดำเนินการตามมาตรการต่าง ๆ เพื่อให้มั่นใจว่าการโอนข้อมูลส่วนบุคคลของคุณไปยังประเทศปลายทางนั้นมีมาตรฐานการคุ้มครองข้อมูลส่วนบุคคลอย่างเพียงพอ หรือกรณีอื่น ๆ ตามที่กฎหมายกำหนด
                        <br>
                        ระยะเวลาจัดเก็บข้อมูลส่วนบุคคล <br>
                        เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณไว้ตามระยะเวลาที่จำเป็นในระหว่างที่คุณเป็นลูกค้าหรือมีความสัมพันธ์อยู่กับเราหรือตลอดระยะเวลาที่จำเป็นเพื่อให้บรรลุวัตถุประสงค์ที่เกี่ยวข้องกับนโยบายฉบับนี้ ซึ่งอาจจำเป็นต้องเก็บรักษาไว้ต่อไปภายหลังจากนั้น หากมีกฎหมายกำหนดไว้ เราจะลบ ทำลาย หรือทำให้เป็นข้อมูลที่ไม่สามารถระบุตัวตนของคุณได้ เมื่อหมดความจำเป็นหรือสิ้นสุดระยะเวลาดังกล่าว
                        <br>
                        สิทธิของเจ้าของข้อมูลส่วนบุคคล <br>
                        ภายใต้กฎหมายคุ้มครองข้อมูลส่วนบุคคล คุณมีสิทธิในการดำเนินการดังต่อไปนี้ <br>
                        สิทธิขอถอนความยินยอม (right to withdraw consent) หากคุณได้ให้ความยินยอม เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ ไม่ว่าจะเป็นความยินยอมที่คุณให้ไว้ก่อนวันที่กฎหมายคุ้มครองข้อมูลส่วนบุคคลใช้บังคับหรือหลังจากนั้น คุณมีสิทธิที่จะถอนความยินยอมเมื่อใดก็ได้ตลอดเวลา
                        สิทธิขอเข้าถึงข้อมูล (right to access) คุณมีสิทธิขอเข้าถึงข้อมูลส่วนบุคคลของคุณที่อยู่ในความรับผิดชอบของเราและขอให้เราทำสำเนาข้อมูลดังกล่าวให้แก่คุณ รวมถึงขอให้เราเปิดเผยว่าเราได้ข้อมูลส่วนบุคคลของคุณมาได้อย่างไร
                        สิทธิขอถ่ายโอนข้อมูล (right to data portability) คุณมีสิทธิขอรับข้อมูลส่วนบุคคลของคุณในกรณีที่เราได้จัดทำข้อมูลส่วนบุคคลนั้นอยู่ในรูปแบบให้สามารถอ่านหรือใช้งานได้ด้วยเครื่องมือหรืออุปกรณ์ที่ทำงานได้โดยอัตโนมัติและสามารถใช้หรือเปิดเผยข้อมูลส่วนบุคคลได้ด้วยวิธีการอัตโนมัติ รวมทั้งมีสิทธิขอให้เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นเมื่อสามารถทำได้ด้วยวิธีการอัตโนมัติ และมีสิทธิขอรับข้อมูลส่วนบุคคลที่เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นโดยตรง เว้นแต่ไม่สามารถดำเนินการได้เพราะเหตุทางเทคนิค
                        <br>
                        สิทธิขอคัดค้าน (right to object) คุณมีสิทธิขอคัดค้านการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณในเวลาใดก็ได้ หากการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณที่ทำขึ้นเพื่อการดำเนินงานที่จำเป็นภายใต้ประโยชน์โดยชอบด้วยกฎหมายของเราหรือของบุคคลหรือนิติบุคคลอื่น โดยไม่เกินขอบเขตที่คุณสามารถคาดหมายได้อย่างสมเหตุสมผลหรือเพื่อดำเนินการตามภารกิจเพื่อสาธารณประโยชน์
                        สิทธิขอให้ลบหรือทำลายข้อมูล (right to erasure/destruction) คุณมีสิทธิขอลบหรือทำลายข้อมูลส่วนบุคคลของคุณหรือทำให้ข้อมูลส่วนบุคคลเป็นข้อมูลที่ไม่สามารถระบุตัวคุณได้ หากคุณเชื่อว่าข้อมูลส่วนบุคคลของคุณถูกเก็บรวบรวม ใช้ หรือเปิดเผยโดยไม่ชอบด้วยกฎหมายที่เกี่ยวข้องหรือเห็นว่าเราหมดความจำเป็นในการเก็บรักษาไว้ตามวัตถุประสงค์ที่เกี่ยวข้องในนโยบายฉบับนี้ หรือเมื่อคุณได้ใช้สิทธิขอถอนความยินยอมหรือใช้สิทธิขอคัดค้านตามที่แจ้งไว้ข้างต้นแล้ว
                        สิทธิขอให้ระงับการใช้ข้อมูล (right to restriction of processing) คุณมีสิทธิขอให้ระงับการใช้ข้อมูลส่วนบุคคลชั่วคราวในกรณีที่เราอยู่ระหว่างตรวจสอบตามคำร้องขอใช้สิทธิขอแก้ไขข้อมูลส่วนบุคคลหรือขอคัดค้านของคุณหรือกรณีอื่นใดที่เราหมดความจำเป็นและต้องลบหรือทำลายข้อมูลส่วนบุคคลของคุณตามกฎหมายที่เกี่ยวข้องแต่คุณขอให้เราระงับการใช้แทน
                        สิทธิขอให้แก้ไขข้อมูล (right to rectification) คุณมีสิทธิขอแก้ไขข้อมูลส่วนบุคคลของคุณให้ถูกต้อง เป็นปัจจุบัน สมบูรณ์ และไม่ก่อให้เกิดความเข้าใจผิด
                        สิทธิร้องเรียน (right to lodge a complaint) คุณมีสิทธิร้องเรียนต่อผู้มีอำนาจตามกฎหมายที่เกี่ยวข้อง หากคุณเชื่อว่าการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เป็นการกระทำในลักษณะที่ฝ่าฝืนหรือไม่ปฏิบัติตามกฎหมายที่เกี่ยวข้อง
                        คุณสามารถใช้สิทธิของคุณในฐานะเจ้าของข้อมูลส่วนบุคคลข้างต้นได้ โดยติดต่อมาที่เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคลของเราตามรายละเอียดท้ายนโยบายนี้ เราจะแจ้งผลการดำเนินการภายในระยะเวลา 30 วัน นับแต่วันที่เราได้รับคำขอใช้สิทธิจากคุณ ตามแบบฟอร์มหรือวิธีการที่เรากำหนด ทั้งนี้ หากเราปฏิเสธคำขอเราจะแจ้งเหตุผลของการปฏิเสธให้คุณทราบผ่านช่องทางต่าง ๆ เช่น ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น
                        <br>
                        การโฆษณาและการตลาด <br>
                        เพื่อประโยชน์ในการได้รับสินค้าหรือบริการของเรา เราใช้ข้อมูลของคุณเพื่อวิเคราะห์และปรับปรุงสินค้าหรือบริการ และทำการตลาดผ่าน Google, Facebook, Pixel tracking code และอื่น ๆ เราใช้ข้อมูลดังกล่าวเพื่อให้สินค้าหรือบริการเหมาะสมกับคุณ
                        <br>
                        เราอาจส่งข้อมูลหรือจดหมายข่าวไปยังอีเมลของคุณ โดยมีวัตถุประสงค์เพื่อเสนอสิ่งที่น่าสนกับคุณ หากคุณไม่ต้องการรับการติดต่อสื่อสารจากเราผ่านทางอีเมลอีกต่อไป คุณสามารถกด “ยกเลิกการติดต่อ” ในลิงก์อีเมลหรือติดต่อมายังอีเมลของเราได้
                        <br>
                        เทคโนโลยีติดตามตัวบุคคล (Cookies) <br>
                        เพื่อเพิ่มประสบการณ์การใช้งานของคุณให้สมบูรณ์และมีประสิทธิภาพมากขึ้น เราใช้คุกกี้ (Cookies) หรือเทคโนโลยีที่คล้ายคลึงกัน เพื่อพัฒนาการเข้าถึงสินค้าหรือบริการ โฆษณาที่เหมาะสม และติดตามการใช้งานของคุณ เราใช้คุกกี้เพื่อระบุและติดตามผู้ใช้งานเว็บไซต์และการเข้าถึงเว็บไซต์ของเรา หากคุณไม่ต้องการให้มีคุกกี้ไว้ในคอมพิวเตอร์ของคุณ คุณสามารถตั้งค่าบราวเซอร์เพื่อปฏิเสธคุกกี้ก่อนที่จะใช้เว็บไซต์ของเราได้
                        <br>
                        ท่านสามารถศึกษาข้อมูลเพิ่มเติมเกี่ยวกับการใช้คุกกี้และการตั้งค่าคุกกี้ดังกล่าวได้ที่ นโยบายคุกกี้
                        <br>
                        การรักษาความมั่งคงปลอดภัยของข้อมูลส่วนบุคคล <br>
                        เราจะรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคลของคุณไว้ตามหลักการ การรักษาความลับ (confidentiality) ความถูกต้องครบถ้วน (integrity) และสภาพพร้อมใช้งาน (availability) ทั้งนี้ เพื่อป้องกันการสูญหาย เข้าถึง ใช้ เปลี่ยนแปลง แก้ไข หรือเปิดเผย นอกจากนี้เราจะจัดให้มีมาตรการรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคล ซึ่งครอบคลุมถึงมาตรการป้องกันด้านการบริหารจัดการ (administrative safeguard) มาตรการป้องกันด้านเทคนิค (technical safeguard) และมาตรการป้องกันทางกายภาพ (physical safeguard) ในเรื่องการเข้าถึงหรือควบคุมการใช้งานข้อมูลส่วนบุคคล (access control)
                        <br>
                        การแจ้งเหตุละเมิดข้อมูลส่วนบุคคล <br>
                        ในกรณีที่มีเหตุละเมิดข้อมูลส่วนบุคคลของคุณเกิดขึ้น เราจะแจ้งให้สำนักงานคณะกรรมการคุ้มครองข้อมูลส่วนบุคคลทราบโดยไม่ชักช้าภายใน 72 ชั่วโมง นับแต่ทราบเหตุเท่าที่สามารถกระทำได้ ในกรณีที่การละเมิดมีความเสี่ยงสูงที่จะมีผลกระทบต่อสิทธิและเสรีภาพของคุณ เราจะแจ้งการละเมิดให้คุณทราบพร้อมกับแนวทางการเยียวยาโดยไม่ชักช้าผ่านช่องทางต่าง ๆ เช่น เว็บไซต์ ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น
                        <br>
                        การแก้ไขเปลี่ยนแปลงนโยบายความเป็นส่วนตัว <br>
                        เราอาจแก้ไขเปลี่ยนแปลงนโยบายนี้เป็นครั้งคราว โดยคุณสามารถทราบข้อกำหนดและเงื่อนไขนโยบายที่มีการแก้ไขเปลี่ยนแปลงนี้ได้ผ่านทางเว็บไซต์ของเรา
                        <br>
                        นโยบายนี้แก้ไขล่าสุดและมีผลใช้บังคับตั้งแต่วันที่ 28 พฤษภาคม 2564
                        <br>
                        นโยบายความเป็นส่วนตัวของเว็บไซต์อื่น <br>
                        นโยบายความเป็นส่วนตัวฉบับนี้ใช้สำหรับการเสนอสินค้า บริการ และการใช้งานบนเว็บไซต์สำหรับลูกค้าของเราเท่านั้น หากคุณเข้าชมเว็บไซต์อื่นแม้จะผ่านช่องทางเว็บไซต์ของเรา การคุ้มครองข้อมูลส่วนบุคคลต่าง ๆ จะเป็นไปตามนโยบายความเป็นส่วนตัวของเว็บไซต์นั้น ซึ่งเราไม่มีส่วนเกี่ยวข้องด้วย
                        <br>
                        รายละเอียดการติดต่อ <br>
                        หากคุณต้องการสอบถามข้อมูลเกี่ยวกับนโยบายความเป็นส่วนตัวฉบับนี้ รวมถึงการขอใช้สิทธิต่าง ๆ คุณสามารถติดต่อเราหรือเจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคลของเราได้ ดังนี้
                        <br>
                        ผู้ควบคุมข้อมูลส่วนบุคคล <br>
                        บริษัท ..... จำกัด <br>
                        255 ชั้น 5 The Racquet Club ตึก 2 คลองตันเหนือ วัฒนา กรุงเทพมหานคร 10110 <br>
                        อีเมล dev.edufilx@gmail.com <br>
                        {{-- เว็บไซต์ https://readthecloud.co/ <br>
                        หมายเลขโทรศัพท์ 06-6115-1344 <br>

                        เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคล <br>
                        บริษัท ..... จำกัด <br>
                        255 ชั้น 5 The Racquet Club ตึก 2 คลองตันเหนือ วัฒนา กรุงเทพมหานคร 10110 <br>
                        อีเมล thecloud@cloudandground.com <br>
                        หมายเลขโทรศัพท์ 06-6115-1344 <br> --}}


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
    <script type="text/javascript">
        $(document).ready(function() {
            // console.log( "ready!" );
            // console.log($('#otp').val());
            $('#typeUser').hide();
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
