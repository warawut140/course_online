    <style>
      .gray {
            color: #fff;
            background-color: #8B0900;
        }
    </style>
<div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-8 offset-md-2">
    
    <br>
    <h4 style="color:#8B0900;">WORK EXPERIENCE</h4>
 <br>

     <div class="card gray" style="background-color: #D3D3D3;">
        <div class="card-body" >
            <div class="form-row">
                      <div class="form-group col-md-11">
             <h5><b>
               JS Engineering And Mechanical Co.Ltd 
            </b></h5>
            <p>UX/UI & Graphic Designer | April 2022 - September 2022 | Thailand</p>
            </div> 
            <div class="form-group col-md-1">
   <button><i class="fa fa-pen"></i></button>
</div>
                </div>
      </div>  </div>  <br>
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
                      <div class="form-group col-md-6">
                        <label for="inputPassword4">บริษัท / องค์กร</label>
                        <input name="lastname" type="text"  class="form-control" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">เว็บไซต์</label>
                        <input name="lastname" type="text"  class="form-control" >
                    </div>
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">ตำแหน่งที่ตั้ง</label>
                    <textarea type="text" class="form-control" rows="3" name="ssxx"></textarea>
                    </div>
                <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="inputPassword4">ตำแหน่งงาน</label>
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
             
             <div class="form-group">
                    <label for="exampleInputEmail1">รายละเอียดงาน</label>
                    <textarea type="text" class="form-control" rows="3" name="ssxx"></textarea>
                    </div>
               <br>
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
                                <button type="submit" class="btn btn-outline-primary w-100">+ Add Experience</button>
                             </div>
  </div>  </div>
</div>
