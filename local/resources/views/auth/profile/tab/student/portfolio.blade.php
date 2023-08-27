{{-- <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br> --}}
<br>
<h4 style="color:#8B0900;">PORTFOLIO</h4>
<div class="card">
    <div class="card-body">

        @if ($profile->portfolio1)
            <div class="row row-cols-lg-2 mb-8">
                <img src="{{ asset('images/profile/'.$profile->portfolio1) }}" alt="..."
                    class="img-fluid rounded mb-8">
            </div>
        @endif

        {{-- @if ($profile->portfolio1)
            <div class="form-group col-md-12">
                <img src="{{ asset('images/profile/'.$profile->portfolio1) }}" class="" width="60%" height="60%">
                <br>
            </div>
            @endif --}}
    </div>
</div>
{{-- </div> --}}
