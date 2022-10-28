{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
<br>
<h4 style="color:#8B0900;">MY COURSE</h4>
<div class="card">
    <div class="card-body">

        <div class="form-group col-md-12">
            @foreach ($courses as $c)
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3">

                            <a href="{{ url('course_online_view/' . $c->id) }}">
                                <img src="{{ asset('images/profile/' . $c->image) }}" class="mw-100 mb-2">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-orange text-left">{{ $c->name }}</h6>
                            <p class="mb-3 text-left">
                                <font style="color:gray">{{ $c->detail }}</font>
                            </p>
                        </div>

                    </div>
                </div>{{-- end #work --}}
            @endforeach
        </div>
    </div>
</div>
{{-- </div> --}}
