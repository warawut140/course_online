{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
    <br>
    <h4 style="color:#8B0900;">APPLICANT</h4>
    <div class="card">
        <div class="card-body">

            <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <th class="op3center"> </th>
                                <th class="op3center">ชื่อผู้สมัคร</th>
                                <th class="op3center">ตำแหน่งที่สมัคร</th>
                                <th class="op3center">วันที่สมัคร</th>
                                <th class="op3center">เบอร์โทรติดต่อ</th>
                                <th class="op3center">CV/RESUME</th>
                                <th class="op3center">คำถาม/แบบทดสอบ</th>
                                <th class="op3center">สถานะ</th>
                            </tr>

                            @for ($i = 0; $i <= 29; $i++)
                                <tr>
                                    <td class="opcenter"> {{ $i + 1 }}</td>
                                    <td class="opcenter">Peter</td>
                                    <td class="opcenter">UX/UI DESIGH{{ $i }}</td>
                                    <td class="opcenter">19/08/2022</td>
                                    <td class="opcenter">00-0000000</td>
                                    <td class="opcenter"><i class="fa fa-file-text" aria-hidden="true"></i></td>
                                    <td class="opcenter"><i class="fa fa-file-text" aria-hidden="true"> &nbsp&nbsp<i
                                                class="fa fa-file-text" aria-hidden="true"></i></i></td>
                                    <td class="opcenter">ส่งใบสมัครแล้ว</td>
                                </tr>
                            @endfor

                        </table>
                    </div>
            </div>


            </div>
        </div>
{{-- </div> --}}
