@extends('layouts.navber')
@section('head')
    @include('sweetalert::alert')
    <link href="{{ asset('assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div id="app">

        {{-- begin #รายละเอียด --}}
        @include('frontend.head.head-budding')

        <div id="topicA-section2" class="bg-light">
            <div class="container-fluid py-4">
                {{-- แนะนำ ผู้ใช้--}}
                <div class="row pb-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="bg-white border p-2 p-xl-3 mb-2">
                            <div class="media">
                              <span class="fa-stack fa-3x mr-3 align-self-center">
                                  <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                  <i class="fas fa-users fa-stack-1x fa-inverse"></i>
                              </span>
                                <div class="media-body">
                                    <h2 class="mt-0 text-right text-primary stat-analyze">{{ count($data_dashboard) }}</h2>
                                    <p class="mb-0 text-right text-muted">จำนวนผู้เข้าร่วมประมูล</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="bg-white border p-2 p-xl-3 mb-2">
                            <div class="media">
                              <span class="fa-stack fa-3x mr-3 align-self-center">
                                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                  <i class="fas fa-money-bill-wave fa-stack-1x fa-inverse"></i>
                              </span>
                                <div class="media-body">
                                    <h2 class="mt-0 text-right text-danger stat-analyze ">{{ number_format($much,2) }}</h2>
                                    <p class="mb-0 text-right text-muted"><i class='far fa-caret-square-up'></i>
                                        ราคาเสนอสูงสุด</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="bg-white border p-2 p-xl-3 mb-2">
                            <div class="media">
                              <span class="fa-stack fa-3x mr-3 align-self-center">
                                  <i class="fas fa-circle fa-stack-2x text-success"></i>
                                  <i class="fas fa-money-bill-wave fa-stack-1x fa-inverse"></i>
                              </span>
                                <div class="media-body">
                                    <h2 class="mt-0 text-right text-success stat-analyze ">{{ number_format($low,2) }}</h2>
                                    <p class="mb-0 text-right text-muted"><i class='far fa-caret-square-down'></i>
                                        ราคาเสนอต่ำสุด</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="bg-white border p-2 p-xl-3 mb-2">
                            <div class="media">
                              <span class="fa-stack fa-3x mr-3 align-self-center">
                                  <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                  <i class="fas fa-check-double fa-stack-1x fa-inverse"></i>
                              </span>
                                <div class="media-body">
                                    <h2 class="mt-0 text-right text-warning stat-analyze">{{ $name }}</h2>
                                    <p class="mb-0 text-right text-muted">เจ้าที่ควรเลือก</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Install Machine --}}
                @if($projectAuctionWorks[0]->install_machine != null)
                    <div class="row pb-5">
                        <div class="col-lg-12">
                            <div class="bg-white border p-2 p-xl-3">
                                <h2>1.งานค่าเครื่องและติดตั้งแขวนเครื่อง</h2>
                                <p>-ค่าเครื่อง</p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>เจ้าผู้รับเหมา</th>
                                            <th>ราคา</th>
                                            <th>BTU/Hr</th>
                                            <th>แบรนด์</th>
                                            <th>FCU</th>
                                            <th>CDU</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;?>
                                        @for($j = 0 ; $j < count($machine);$j++)
                                            @if($i <= 4)
                                                <tr class="text-center">
                                                    <td>{{ $j+1 }}</td>
                                                    <td>{{ $machine[$j]->name }}</td>
                                                    <td>{{ number_format($machine[$j]->install_machine->sum) }}</td>
                                                    <td>{{ number_format($machine[$j]->install_machine->btu) }}</td>
                                                    <td>{{ $machine[$j]->install_machine->brand }}</td>
                                                    <td>{{ number_format($machine[$j]->install_machine->fcu) }}</td>
                                                    <td>{{ number_format($machine[$j]->install_machine->cud) }}</td>
                                                </tr>
                                                <?php $i++ ?>
                                            @endif
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <?php $i = 0;?>
                                            @foreach($machine as $key => $value)
                                                @if($i <= 2)
                                                    <div class="card mb-2">
                                                        <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                        @if($key == 0)
                                                            <div
                                                                class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 1)
                                                            <div
                                                                class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 2)
                                                            <div
                                                                class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @endif
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="inputAddress">ราคา</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           value="{{ number_format($value->install_machine->sum) }}">
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputEmail4">BTU</label>
                                                                        <input type="text" readonly
                                                                               class="form-control-plaintext-b"
                                                                               value="{{ number_format($value->install_machine->btu) }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4">FCU</label>
                                                                        <input type="text" readonly
                                                                               class="form-control-plaintext-b"
                                                                               value="{{ number_format($value->install_machine->fcu) }}">
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label for="inputPassword4">CDU</label>
                                                                        <input type="text" readonly
                                                                               class="form-control-plaintext-b"
                                                                               value="{{ number_format($value->install_machine->cud) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputAddress">แบรนด์</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           value="{{ $value->install_machine->brand }}">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if($i == 1 || $i == 2)
                                                        <div class="w-100 d-none d-sm-block d-lg-none"></div>
                                                    @endif
                                                    <?php $i++ ?>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12">
                                        <p>-ค่าติดตั้งแขวนเครื่อง</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>เจ้าผู้รับเหมา</th>
                                                    <th>ราคา</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 0;?>
                                                @foreach($data_dashboard as $key => $value)
                                                    @if($i <= 4)
                                                        <tr class="text-center">
                                                            <td>{{ $i+1 }}</td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ number_format($value->support_hanger) }}</td>
                                                        </tr>
                                                        <?php $i++ ?>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-2 col-12 align-self-center">
                                                        <h4>ราคา</h4>
                                                    </div>
                                                    @foreach($machine as $key => $value)
                                                        @if($i <= 2)
                                                            <div class="col-sm-2 col px-0">
                                                            <span class="fa-stack fa-2x">
                                                                @if($key == 0)
                                                                    <i class="far fa-circle fa-stack-2x text-success"></i>
                                                                    <h4 class="text-success fa-stack-1x">{{ $value->name }}</h4>
                                                                @elseif($key == 1)
                                                                    <i class="far fa-circle fa-stack-2x text-info"></i>
                                                                    <h4 class="text-info fa-stack-1x">{{ $value->name }}</h4>
                                                                @elseif($key == 2)
                                                                    <i class="far fa-primary fa-stack-2x text-success"></i>
                                                                    <h4 class="text-primary fa-stack-1x">{{ $value->name }}</h4>
                                                                @endif
                                                            </span>
                                                            </div>
                                                            @if($key >= 1)
                                                                <div class="col-sm-2 col-1 px-0 align-self-center">
                                                                    <i class='fas fa-chevron-left fa-1x text-secondary'></i>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2 col-12 align-self-center">
                                                        <h4>BTU</h4>
                                                    </div>
                                                    <?php $i = 0;?>
                                                    @foreach($btu_machine as $key => $value)
                                                        @if($i <= 2)
                                                            <div class="col-sm-2 col px-0">
                                                            <span class="fa-stack fa-2x">
                                                                @if($key == 0)
                                                                    <i class="far fa-circle fa-stack-2x text-success"></i>
                                                                    <h4 class="text-success fa-stack-1x">{{ $value->name }}</h4>
                                                                @elseif($key == 1)
                                                                    <i class="far fa-circle fa-stack-2x text-info"></i>
                                                                    <h4 class="text-info fa-stack-1x">{{ $value->name }}</h4>
                                                                @elseif($key == 2)
                                                                    <i class="far fa-primary fa-stack-2x text-success"></i>
                                                                    <h4 class="text-primary fa-stack-1x">{{ $value->name }}</h4>
                                                                @endif
                                                            </span>
                                                            </div>
                                                        @endif
                                                        @if($i <= 0)
                                                            <div class="col-sm-2 col-1 px-0 align-self-center">
                                                                <i class='fas fa-chevron-left fa-1x text-secondary'></i>
                                                            </div>
                                                        @endif
                                                        @if($i == 2)
                                                            <div class="col-sm-2 col-1 px-0 align-self-center">
                                                                <i class='fas fa-chevron-left fa-1x text-secondary'></i>
                                                            </div>
                                                        @endif
                                                        <?php $i++ ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @if($projectAuction->user_id == $user_id)
                                    <div class="text-center">
                                        <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#buyCourseModal"><i class="fa fa-bar-chart-o"></i>
                                            เปรียบเทียบแอร์
                                        </button>
                                        <div class="modal fade" id="buyCourseModal" tabindex="-1" role="dialog"
                                             aria-labelledby="buyCourseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="buyCourseModalLabel"><i
                                                                class="fa fa-bar-chart-o"></i> เปรียบเทียบแอร์</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true"><i
                                                                    class="material-icons">&#xe5cd;</i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body text-center">
                                                            <div class="row">

                                                                @for($i = 0 ; $i < count($machine);$i++)

                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr class="text-center">
                                                                        <th>ผู้รับเหงา</th>
                                                                        <th>Brand</th>
                                                                        <th>Type Air</th>
                                                                        <th>BTU</th>
                                                                        <th>จำนวน</th>
                                                                        <th>ราคากลาง</th>
                                                                        <th>ราคาในระบบ</th>
                                                                        <th>รวม</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $sum[$i] = 0; ?>
                                                                    {{--                                                                {{ $machine[$i]->install_machine[0] }}--}}
                                                                    @foreach($machine[$i]->install_machine[0]->sub_data as $key => $value)
                                                                        <tr>
                                                                            <td>{{ $machine[$i]->name }}</td>
                                                                            <td>
                                                                                @if($value->b_name == null)-
                                                                                @else {{  $value->b_name }}  @endif
                                                                            </td>
                                                                            <td>{{ $value->type_air  }}</td>
                                                                            <td>{{ $value->btu  }}</td>
                                                                            <td>{{ $value->qty  }}</td>
                                                                            <td>{{  number_format($value->price)  }}</td>
                                                                            <td>{{ number_format($value->materail_unitTotal / 2)  }}</td>
                                                                            <td>{{ number_format($value->materail_unitTotal)  }}</td>
                                                                            <?php $sum[$i] = +$value->materail_unitTotal + $sum[$i]; ?>
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr class="table-warning">
                                                                        <td colspan="7">รวม</td>
                                                                        <td>{{ number_format($sum[$i]) }}</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <hr>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
                {{-- Piping  --}}
                @if($projectAuctionWorks[0]->piping != null)
                    <div class="row pb-5">
                        <div class="col-sm-12">
                            <div class="bg-white border p-2 p-xl-3">
                                <h2>2.งานติดตั้งระบบท่อ</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="text-center">
                                            <th rowspan="2" class="align-middle">#</th>
                                            <th rowspan="2" class="align-middle">เจ้าผู้รับเหมา</th>
                                            <th rowspan="2" class="align-middle">ราคา</th>
                                            {{--<th rowspan="2" class="align-middle">ปริมาณ</th>--}}
                                            <th>แบรนด์</th>
                                        </tr>
                                        {{--<tr class="text-center">--}}
                                        {{--<th>Copper</th>--}}
                                        {{--<th>Drain</th>--}}
                                        {{--<th>Refrigerant</th>--}}
                                        {{--<th>Insolution</th>--}}
                                        {{--</tr>--}}
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;?>
                                        @for($j = 0 ; $j < count($piping);$j++)
                                            @if($i <= 4)
                                                <tr class="text-center">
                                                    <td>{{ $j+1 }}</td>
                                                    <td>{{ $piping[$j]->name }}</td>
                                                    <td>{{ number_format($piping[$j]->sum_piping) }}</td>
                                                    <td>
                                                        @foreach($piping[$j]->piping->brands as $value)
                                                            <img src="{{ asset('images/brand/'.$value->filename) }}"
                                                                 class="" alt="Responsive image"
                                                                 style="width: 100px;height: 50px;">
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <?php $i++ ?>
                                            @endif
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <?php $i = 0;?>
                                            @foreach($piping as $key => $value)
                                                @if($i <= 2)
                                                    <div class="card mb-2">
                                                        <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                        @if($key == 0)
                                                            <div
                                                                class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 1)
                                                            <div
                                                                class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 2)
                                                            <div
                                                                class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @endif
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="inputAddress"
                                                                           class="analyze">ราคา</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           id="staticEmail"
                                                                           value="{{ number_format($value->sum_piping) }}">
                                                                </div>
                                                                <div class="form-row">
                                                                    @foreach($value->piping->brands as $key => $valueB)
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputEmail4"
                                                                                   class="analyze">{{ $valueB->name }}</label>
                                                                            <img
                                                                                src="{{ asset('images/brand/'.$valueB->filename) }}"
                                                                                class="img-fluid"
                                                                                alt="Responsive image">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if($i == 1 || $i == 2)
                                                        <div class="w-100 d-none d-sm-block d-lg-none"></div>
                                                    @endif
                                                    <?php $i++ ?>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Control  --}}
                @if($projectAuctionWorks[0]->control != null)
                    <div class="row pb-5">
                        <div class="col-sm-12">
                            <div class="bg-white border p-2 p-xl-3">
                                <h2>3.งานติดตั้งระบบควบคุม</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="text-center">
                                            <th rowspan="2" class="align-middle">#</th>
                                            <th rowspan="2" class="align-middle">เจ้าผู้รับเหมา</th>
                                            <th rowspan="2" class="align-middle">ราคา</th>
                                            {{--<th class="align-middle border-right">ปริมาณ</th>--}}
                                            <th class="align-middle">แบรนด์</th>
                                        </tr>
                                        {{--<tr class="text-center">--}}
                                        {{--<th>รีโมต</th>--}}
                                        {{--<th>สาย</th>--}}
                                        {{--<th class="border-right">ท่อ</th>--}}
                                        {{--<th>Conduit</th>--}}
                                        {{--<th>Cable</th>--}}
                                        {{--</tr>--}}
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;?>
                                        @for($j = 0 ; $j < count($control);$j++)
                                            @if($i <= 4)
                                                <tr class="text-center">
                                                    <td>{{ $j+1 }}</td>
                                                    <td>{{ $control[$j]->name }}</td>
                                                    <td>{{ number_format($control[$j]->sum_control) }}</td>
                                                    <td>
                                                        @foreach($control[$j]->control->brands as $value)
                                                            <img src="{{ asset('images/brand/'.$value->filename) }}"
                                                                 class="" alt="Responsive image"
                                                                 style="width: 100px;height: 50px;">
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <?php $i++ ?>
                                            @endif
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <?php $i = 0;?>
                                            @foreach($control as $key => $value)
                                                @if($i <= 2)
                                                    <div class="card mb-2">
                                                        <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                        @if($key == 0)
                                                            <div
                                                                class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 1)
                                                            <div
                                                                class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 2)
                                                            <div
                                                                class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @endif
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="inputAddress"
                                                                           class="analyze">ราคา</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           id="staticEmail"
                                                                           value="{{ number_format($value->sum_control) }}">
                                                                </div>
                                                                <div class="form-row">
                                                                    @foreach($value->control->brands as $key => $valueB)
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputEmail4"
                                                                                   class="analyze">{{ $valueB->name }}</label>
                                                                            <img
                                                                                src="{{ asset('images/brand/'.$valueB->filename) }}"
                                                                                class="img-fluid"
                                                                                alt="Responsive image">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if($i == 1 || $i == 2)
                                                        <div class="w-100 d-none d-sm-block d-lg-none"></div>
                                                    @endif
                                                    <?php $i++ ?>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Duct Piping --}}
                @if($projectAuctionWorks[0]->duct_piping != null)
                    <div class="row pb-5">
                        <div class="col-sm-12">
                            <div class="bg-white border p-2 p-xl-3">
                                <h2>4.งานติดตั้งท่อลม</h2>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2" class="align-middle">#</th>
                                                    <th rowspan="2" class="align-middle">เจ้าผู้รับเหมา</th>
                                                    <th rowspan="2" class="align-middle">ราคา</th>
                                                    <th>แบรนด์</th>
                                                </tr>
                                                {{--<tr class="text-center">--}}
                                                {{--<th>Duct</th>--}}
                                                {{--<th>Insolution</th>--}}
                                                {{--<th>Grill</th>--}}
                                                {{--</tr>--}}
                                                </thead>
                                                <tbody>
                                                <?php $i = 0;?>
                                                @for($j = 0 ; $j < count($duct);$j++)
                                                    @if($i <= 4)
                                                        <tr class="text-center">
                                                            <td>{{ $j+1 }}</td>
                                                            <td>{{ $duct[$j]->name }}</td>
                                                            <td>{{ number_format($duct[$j]->sum_duct_piping) }}</td>
                                                            <td>
                                                                @foreach($main[$j]->duct->brands as $value)
                                                                    <img
                                                                        src="{{ asset('images/brand/'.$value->filename) }}"
                                                                        class="" alt="Responsive image"
                                                                        style="width: 100px;height: 50px;">
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <?php $i++ ?>
                                                    @endif
                                                @endfor
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <?php $i = 0;?>
                                            @foreach($duct as $key => $value)
                                                @if($i <= 2)
                                                    <div class="card mb-2">
                                                        <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                        @if($key == 0)
                                                            <div
                                                                class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 1)
                                                            <div
                                                                class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 2)
                                                            <div
                                                                class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @endif
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="inputAddress"
                                                                           class="analyze">ราคา</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           id="staticEmail"
                                                                           value="{{ number_format($value->sum_duct_piping) }}">
                                                                </div>
                                                                <div class="form-row">
                                                                    @foreach($value->duct->brands as $key => $valueB)
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputEmail4"
                                                                                   class="analyze">{{ $valueB->name }}</label>
                                                                            <img
                                                                                src="{{ asset('images/brand/'.$valueB->filename) }}"
                                                                                class="img-fluid"
                                                                                alt="Responsive image">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if($i == 1 || $i == 2)
                                                        <div class="w-100 d-none d-sm-block d-lg-none"></div>
                                                    @endif
                                                    <?php $i++ ?>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Main --}}
                @if($projectAuctionWorks[0]->main != null)
                    <div class="row pb-5">
                        <div class="col-sm-12">
                            <div class="bg-white border p-2 p-xl-3">
                                <h2>5.งานติดตั้งระบบเมนไฟฟ้า</h2>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2" class="align-middle">#</th>
                                                    <th rowspan="2" class="align-middle">เจ้าผู้รับเหมา</th>
                                                    <th rowspan="2" class="align-middle">ราคา</th>
                                                    <th>แบรนด์</th>
                                                </tr>
                                                {{--<tr class="text-center">--}}
                                                {{--<th>Cabel</th>--}}
                                                {{--</tr>--}}
                                                </thead>
                                                <tbody>
                                                <?php $i = 0;?>
                                                @for($j = 0 ; $j < count($main);$j++)
                                                    @if($i <= 4)
                                                        <tr class="text-center">
                                                            <td>{{ $j+1 }}</td>
                                                            <td>{{ $main[$j]->name }}</td>
                                                            <td>{{ number_format($main[$j]->sum_main) }}</td>
                                                            <td>
                                                                @foreach($main[$j]->main->brands as $value)
                                                                    <img
                                                                        src="{{ asset('images/brand/'.$value->filename) }}"
                                                                        class="" alt="Responsive image"
                                                                        style="width: 100px;height: 50px;">
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <?php $i++ ?>
                                                    @endif
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <?php $i = 0;?>
                                            @foreach($main as $key => $value)
                                                @if($i <= 2)
                                                    <div class="card mb-2">
                                                        <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                        @if($key == 0)
                                                            <div
                                                                class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 1)
                                                            <div
                                                                class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @elseif($key == 2)
                                                            <div
                                                                class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        @endif
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="inputAddress"
                                                                           class="analyze">ราคา</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           id="staticEmail"
                                                                           value="{{ number_format($value->sum_main) }}">
                                                                </div>
                                                                <div class="form-row">
                                                                    @foreach($value->main->brands as $key => $valueB)
                                                                        <div class="form-group col-md-3">
                                                                            <label for="inputEmail4"
                                                                                   class="analyze">{{ $valueB->name }}</label>
                                                                            <img
                                                                                src="{{ asset('images/brand/'.$valueB->filename) }}"
                                                                                class="img-fluid"
                                                                                alt="Responsive image">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if($i == 1 || $i == 2)
                                                        <div class="w-100 d-none d-sm-block d-lg-none"></div>
                                                    @endif
                                                    <?php $i++ ?>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Prelim and กำไร --}}
                <div class="row">
                    {{-- Prelim --}}
                    <div class="col-xl-6  col-lg-12 mb-5">
                        <div class="bg-white border p-2 p-xl-3">
                            <h2>6.Prelim ค่าดำเนินการ</h2>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="text-center">
                                                <th class="align-middle">#</th>
                                                <th class="align-middle">เจ้าผู้รับเหมา</th>
                                                <th class="align-middle">ราคา</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0;?>
                                            @for($j = 0 ; $j < count($prelim);$j++)
                                                @if($i <= 4)
                                                    <tr class="text-center">
                                                        <td>{{ $j+1 }}</td>
                                                        <td>{{ $prelim[$j]->name }}</td>
                                                        <td>{{ number_format($prelim[$j]->sum_prelim) }}</td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                @endif
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="card-deck">
                                        <?php $i = 0;?>
                                        @foreach($prelim as $key => $value)
                                            @if($i <= 2)
                                                <div class="card mb-2">
                                                    <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                    @if($key == 0)
                                                        <div
                                                            class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                    @elseif($key == 1)
                                                        <div
                                                            class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                    @elseif($key == 2)
                                                        <div
                                                            class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                    @endif
                                                    <div class="card-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="inputAddress" class="analyze">ราคา</label>
                                                                <input type="text" readonly
                                                                       class="form-control-plaintext-b" id="staticEmail"
                                                                       value="{{ number_format($value->sum_prelim) }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <?php $i++ ?>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- กำไร --}}
                    <div class="col-xl-6 col-lg-12 mb-5">
                        <div class="bg-white border p-2 p-xl-3">
                            <h2>7.Overhead กำไร</h2>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="text-center">
                                                <th class="align-middle">#</th>
                                                <th class="align-middle">เจ้าผู้รับเหมา</th>
                                                <th class="align-middle">ราคา</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0;?>
                                            @for($j = 0 ; $j < count($overhead);$j++)
                                                @if($i <= 4)
                                                    <tr class="text-center">
                                                        <td>{{ $j+1 }}</td>
                                                        <td>{{ $overhead[$j]->name }}</td>
                                                        <td>{{ number_format($overhead[$j]->overhead_sum,2) }}</td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                @endif
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="card-deck">
                                        <?php $i = 0;?>
                                        @foreach($overhead as $key => $value)
                                            @if($i <= 2)
                                                <div class="card mb-2">
                                                    <div class="text-center h5 mt-2">{{ $i+1 }}st</div>
                                                    @if($key == 0)
                                                        <div
                                                            class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                    @elseif($key == 1)
                                                        <div
                                                            class="rounded-circle bg-info text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                    @elseif($key == 2)
                                                        <div
                                                            class="rounded-circle bg-primary text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                    @endif
                                                    <div class="card-body">
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="inputAddress" class="analyze">ราคา</label>
                                                                <input type="text" readonly
                                                                       class="form-control-plaintext-b" id="staticEmail"
                                                                       value="{{ number_format($value->overhead_sum,2) }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <?php $i++ ?>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- chart --}}
                <div class="row pb-5">
                    <div class="col-sm-12">
                        <div class="bg-white border p-2 p-xl-3">
                            <h2>ราคารวมสุทธิ</h2>
                            {{--<img src="images/pic-graph.jpg" class="mw-100">--}}
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <dashboard :project_id="{{ $id }}"
                           :dashboard="{{ json_encode($data_dashboard) }}"
                           :owner_id="{{ $projectAuction->user_id }}"
                           :countdown="{{ $projectAuction->countDown }}"
                           :user_id="{{ $user_id }}">
                </dashboard>
                @if($projectAuction->user_id != $user_id)
                    <div class="text-center">
                        <div class="row pb-5">
                            <div class="col-lg-4 col-md-4"></div>
                            <div class="col-lg-4 col-md-4">
                                <div class="bg-white border p-2 p-xl-3 mb-2">
                                    <div class="media">
                                        <span class="fa-stack fa-3x mr-3 align-self-center">
                                          <i class="fas fa-circle fa-stack-2x text-success"></i>
                                          <i class="fas fa-money-bill-wave fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <div class="media-body">
                                            <h2 class="mt-0 text-right text-success stat-analyze ">{{ number_format($quick,2) }}</h2>
                                            <p class="mb-0 text-right text-muted"><i
                                                    class='far fa-caret-square-down'></i> เสนอราคาด่วน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4"></div>
                        </div>
                        <br>
                        {{-- <a href="{{ url('quotation/'.$id.'/edit') }}" class="btn btn-info"><i class="fa fa-gavel"></i>
                            แก้ไขเสนอราคา</a> --}}
                        <button class="btn btn-warning" data-toggle="modal" data-target="#buyCourseModal2"><i
                                class="fa fa-gavel"></i> เสนอราคาด่วน
                        </button>
                        <div class="modal fade" id="buyCourseModal2" tabindex="-1" role="dialog"
                             aria-labelledby="buyCourseModal2Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="buyCourseModal2Label"><i class="fa fa-gavel"></i>
                                            เสนอราคาด่วน</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="material-icons">&#xe5cd;</i></span>
                                        </button>
                                    </div>
                                    {!! Form::open(['url' => 'saveQuick' , 'files'=>true ,'data-parsley-validate'=>'true']) !!}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>กรุณาอ่าน !</strong> เสนอราคาด่วน แล้วต้องกลับไปแก้ไขเสนอราคา
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="project_id" name="project_id" value="{{ $id }}">
                                            <div class="col-md-12 col-sm-12">
                                                {!!  Form::number('price',null,['class' => 'form-control' ,'placeholder' => 'เสนอราคาด่วน' ,'step'=>'0.1' , 'data-parsley-required' => 'true']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">ปิด</a>
                                        {{--<a href="javascript:;" class="btn btn-sm btn-success">Action</a>--}}
                                        <?=  Form::submit('เสนอราคา', ['class' => 'btn btn-sm btn-success']);?>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{--  if owner project == user id login   --}}
                @if($projectAuction->user_id == $user_id)
                    <div class="row pb-5">
                        <div class="col-lg-12">
                            <div class="bg-white border p-2 p-xl-3">
                                <h2>เสนอราคาด่วน</h2>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>เจ้าผู้รับเหมา</th>
                                            <th>ราคา</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;?>
                                        @for($j = 0 ; $j < count($data_dashboard);$j++)
                                            @if($i <= 4)
                                                @if($data_dashboard[$j]->quick_price != 0)
                                                    <tr class="text-center">
                                                        <td>{{ $j+1 }}</td>
                                                        <td>{{ $data_dashboard[$j]->name }}</td>
                                                        <td>{{ number_format($data_dashboard[$j]->quick_price,2)  }}</td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                @endif
                                            @endif
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php $i = 0;?>
                        @foreach($profile_review as $key => $value)
                            @if($i <= 4)
                                <div class="col-xl-3 col-lg-12 mb-5">
                                    <div class="bg-white border p-2 p-xl-3">
                                        <div class="card mb-5">
                                            <div class="card-body">
                                                <div class="card-deck">
                                                    <div class="mb-2">
                                                        <div
                                                            class="rounded-circle bg-success text-center mx-auto my-2 analyze_name">{{ $value->name }}</div>
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="form-group">
                                                                    <label class="analyze">ราคา</label>
                                                                    <input type="text" readonly
                                                                           class="form-control-plaintext-b"
                                                                           value="{{ number_format($value->sum_all,2) }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        class="analyze">คะแนนจากความน่าเชื่อบริษัท</label>
                                                                    <div>
                                                                        <span
                                                                            class="fa fa-star @if($value->review_profile >= 1) checked @endif"></span>
                                                                        <span
                                                                            class="fa fa-star @if($value->review_profile >= 2) checked @endif"></span>
                                                                        <span
                                                                            class="fa fa-star @if($value->review_profile >= 3) checked @endif"></span>
                                                                        <span
                                                                            class="fa fa-star @if($value->review_profile >= 4) checked @endif"></span>
                                                                        <span
                                                                            class="fa fa-star @if($value->review_profile >= 5) checked @endif"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="analyze">ประสบการทำงาน</label>
                                                                    <p><b>{!! $value->exp_detail !!}</b></p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="analyze">การผ่านการอบรม
                                                                        สำหรับผู้รับเหมา</label>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-primary"
                                                                             role="progressbar"
                                                                             style="width: {{$value->course}}%;"
                                                                             aria-valuenow="{{$value->course}}"
                                                                             aria-valuemin="0"
                                                                             aria-valuemax="100">{{$value->course}}%
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{--<script src="/js/app.js" charset="utf-8"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script>
        // Create the chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            // subtitle: {
            //     text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
            // },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Air Condition System'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        // format: '{point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:45px"><b>{series.name}</b></span><br>',
                // pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
                {
                    name: "ราคาการประมูล",
                    colorByPoint: true,
                    data: [
                            <?php for ($i = 0 ; $i < count($data_dashboard);$i++){ ?>
                        {
                            name: "<?php echo $data_dashboard[$i]->name ?>",
                            y: <?php echo $data_dashboard[$i]->sum_all ?>,
                        },
                        <?php }?>
                    ]
                }
            ],
        });
    </script>
    <script src="{{ asset('assets/plugins/parsley/dist/parsley.js') }}"></script>
    @if(session()->has('status'))
        <script>
            Swal({
                type: 'success',
                title: "<?php echo session()->get('status'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session()->has('warning'))
        <script>
            Swal({
                type: 'info',
                title: "<?php echo session()->get('warning'); ?>",
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
@endsection
