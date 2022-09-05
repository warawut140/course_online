{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
<br>
<h4 style="color:#8B0900;">คอร์สเรียนที่สร้าง</h4>
<div class="card">
    <div class="card-body">

        <div class="row">
            @foreach ($courses as $c)
                <div class="col-md-3">
                    <h6 class="text-orange text-left">{{ $c->name }}</h6>
                    <a href="{{ url('course_online_view/' . $c->id) }}">
                        <img src="{{ asset('images/profile/' . $c->image) }}" class="mw-100 mb-2">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- </div> --}}
