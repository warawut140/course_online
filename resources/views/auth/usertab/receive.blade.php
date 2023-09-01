<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    <br>
    <h4 style="color:#8B0900;">Education</h4>
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
                  <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputPassword4">มหาวิทยาลัย</label>
                        <input name="lastname" type="text"  class="form-control" >
                    </div>
                   
                </div>
                <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">ระดับการศึกษา</label>
                        <input name="lastname" type="text"  class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">สาขา</label>
                        <input name="lastname" type="text"  class="form-control" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">วันที่เริ่ม</label>
                        <input name="firstname" type="date"  class="form-control"
                            id="inputEmail4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">วันสิ้นสุด</label>
                        <input name="lastname" type="date" class="form-control">
                    </div>
                </div>
              <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">เกรดเฉลี่ย</label>
                        <input name="firstname" type="text"  class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                    
                    </div>
                </div><br>
                            <div class="form-group" >
                                              <div class="form-row">
                                                  <div class="form-group col-md-3">
                                                       </div>
                                <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-outline-success w-100">Add Work Experience</button>
                                 </div>
                                <div class="form-group col-md-3">
                                <button type="cancel" class="btn btn-outline-danger w-100">Cancle</button>
                             </div>
                                </div>
                             </div>  
                    {{-- <div class="form-group" >
                        <button type="submit" style="background-color: #8B0900; color:white;" class="btn  w-100">Submit</button>
                     </div> --}}
                </form>
            </div>
        </div>
        <br>
 <div class="form-group" >
    <div class="form-row">
        <div class="form-group col-md-1">
                            
                             </div>

                               <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-outline-primary w-100">+ Add Education</button>
                             </div>
  </div>  </div>
</div>
