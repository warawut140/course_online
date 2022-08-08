@extends('layouts.navber')
@section('head')

@endsection
@section('content')
    {{-- begin #คู่มือการใช้งาน --}}
    <div class="jumbotron jumbotron-fluid mb-0">
        <div class="container">
            <h1 class="display-4">คู่มือการใช้งาน</h1>
            <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        </div>
    </div>
    <div id="index-section1" class="bg-white">
        <div class="container py-4">
            <h1 class="mb-3 text-center"><span class="text-orange">ผึ้งงาน</span> มีอะไร?</h1>
            <div class="row">
                <div class="col-sm my-2 col-4 text-center">
                    <img src="{{ asset('images/index-auction.png') }}" class="mw-100 mb-3">
                    <h4 class="text-orange">ประมูลงานระบบ</h4>
                </div>
                <div class="col-sm my-2 col-4 text-center">
                    <img src="{{ asset('images/index-findjob.png') }}" class="mw-100 mb-3">
                    <h4 class="text-orange">หางาน</h4>
                </div>
                <div class="col-sm my-2 col-4 text-center">
                    <img src="{{ asset('images/index-knowledge.png') }}" class="mw-100 mb-3">
                    <h4 class="text-orange">อบรม หาความรู้</h4>
                </div>

                <div class="col-sm-12">
                    <hr>
                    <h2 class="my-5 text-center"><span class="text-warning">ผึ้งงาน</span> ใช้ยังไง?</h2>

                    <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ผู้ว่าจ้าง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">ผู้รับจ้าง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">ผู้รับเหมา</a>
                        </li>
                    </ul>

                    <div class="tab-content mb-5" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/monitor.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">1.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/chat.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">2.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/presentation.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">3.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/hammer.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">4.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/goal.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">5.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/money.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">6.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/rating.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">7.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/monitor.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">1.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/chat.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">2.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/goal.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">3.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/money.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">4.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/rating.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">5.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/monitor.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">1.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/discount.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">2.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/chat.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">3.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/goal.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">4.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/money.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">5.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <img src="{{ asset('images/rating.png') }}" class="align-self-center mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0">6.Pulvinar vel faucibus, enim vehicula.</h5>
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Lorem ipsum dolor sit amet, dictum ullamcorper, aenean convallis, suspendisse velit ut.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Volutpat tempus sed, leo consequat, tempor lectus.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Ultricies elit ut, porttitor arcu consectetuer, duis libero a.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Amet fusce lacinia, ultricies tempor.</li>
                                                <li><span class="fa-li"><i class="fas fa-caret-right text-warning"></i></span>Nec vehicula, natoque eget.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end #คู่มือการใช้งาน --}}

@endsection
@section('script')
    <script>
        $('.bg-light').css({
            'min-height': $(window).height() - $('.navbar').height() - $('#section-footer').height()
        });
    </script>
@endsection