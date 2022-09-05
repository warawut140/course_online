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
                                <th class="op3center">ชื่อผู้เรียน</th>
                                <th class="op3center">แบบทดสอบ/Workshop</th>
                                <th class="op3center">ชื่อข้อสอบ</th>
                                <th class="op3center"></th>
                                <th class="op3center">สถานะ</th>
                            </tr>

                            @for ($i = 0; $i <= 29; $i++)
                                <tr>
                                    <td class="opcenter"> {{ $i + 1 }}</td>
                                    <td class="opcenter">Mrs. Malee  meena</td>
                                    <td class="opcenter">Workshop</td>
                                    <td class="opcenter">การเขียนโค้ดเบื้องต้น</td>
                                    <td class="opcenter"><i class="fa fa-file-text" aria-hidden="true"></i></td>
                                    <td class="opcenter">รอดำเนินการ</td>

                                </tr>
                            @endfor

                        </table>
                    </div>
            </div>


            </div>
        </div>
{{-- </div> --}}
