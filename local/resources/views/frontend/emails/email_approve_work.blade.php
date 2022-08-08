<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5> To : <strong>{{ $fullname }}</strong>,</h5>
                <div class="card-body" >
                    <hr>
                    <div align="center">
                        <h4>{{ $title }}</h4>
                        <img src="http://phungngan.com/image/logo-color.png" alt="W3Schools.com">
                        <br>
                        &nbsp;<small>(Admin phungngan)</small>
                        <br>
                        <h5>รายละเอียด</h5> {{ $title }}
                        <p><strong>ราคาตกลง</strong> : {{ $price }} </p>
                    </div>
                    <div align="left" style="margin-left: 150px">
                        <h5>ขอบเขตงาน</h5>
                        {!! $details !!}
                        ระยะเวลา : {{ $date }}
                        &nbsp;&nbsp;<p>&nbsp;&nbsp;<p>Click Link : <a href="{{ url($url) }}" target="_blank">คลิ๊กลิงค์ >>></a></p>
                    </div>
                    <hr>
                    <p>Thank you , </p>
                    <h4 style="color: #d58512">WebSite : phungngan.com</h4>
                    <p>xxxxxxxxxx</p>
                    <p> กรุงเทพฯ 10400</p>

                    <p>โทร. : 02-xxx-xxxx </p>
                    <p>โทรสาร : 02-xxx-xxxx</p>
                    <p>Email: xxx@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>



