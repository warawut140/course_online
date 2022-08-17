<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">ON THE WEB</h4>
    <div class="card">
        <div class="card-body">
            {{-- <h5 class="card-title text-center">สมัครสมาชิก</h5> --}}
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
            <form method="POST" action="{{ url('register_company_detail_basic_store') }}" id="searchForm"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    {{-- <label for="exampleInputEmail1"></label> --}}
                    <input type="text" class="form-control" placeholder="Link 1" id="exampleInputEmail1"
                        name="tel">
                </div>
                <div class="form-group">
                    {{-- <label for="exampleInputEmail1"></label> --}}
                    <input type="text" class="form-control" placeholder="Link 2" id="exampleInputEmail1"
                        name="tel">
                </div>
                <div class="form-group">
                    {{-- <label for="exampleInputEmail1"></label> --}}
                    <input type="text" class="form-control" placeholder="Link 3" id="exampleInputEmail1"
                        name="tel">
                </div>
                <div class="form-group">
                    {{-- <label for="exampleInputEmail1"></label> --}}
                    <input type="text" class="form-control" placeholder="Link 4" id="exampleInputEmail1"
                        name="tel">
                </div>

                <div class="form-group" >
                    <button type="submit" class="btn btn-outline-success w-100">บันทึก</button>
                 </div>
                </form>
            </div>
        </div>
</div>
