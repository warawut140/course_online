<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{{ asset("image/Admin-icon.png") }}" alt="" /></a>
                </div>
                <div class="info">
                    {{ Auth::user()->name }}
                    <small>
                        ผู้ดูแลระบบ (Admin)
                    </small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">จัดการข้อมูลของ phungngan {{ Request::segment(2) }}</li>
            <li class="{{ Request::segment(2) === 'home' ||  Request::segment(2) == ''? 'active' : null }}">
                <a href="{{ url('/admin') }}"><i class="fa fa-dashboard (alias)"></i> <span>โครงการ</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-gavel"></i>
                    <span>ข้อมูลโครงการ</span>
                </a>
                <ul class="sub-menu">
                    <li class="has-sub">
                        <a href="javascript:;"><b class="caret pull-right"></b>AIR Condition System</a>
                        <ul class="sub-menu">
                            <li><a href="javascript:;">โครงการ (ระยะประมูล)</a></li>
                            <li><a href="javascript:;">โครงการ (เริ่มทำโครงการ)</a></li>
                            <li><a href="javascript:;">โครงการ (โครงการเสร็จ)</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="{{ url('/admin') }}"><i class="fa fa-bullhorn"></i> <span>ประกาศ</span></a></li>
            <li><a href="{{ url('/admin') }}"><i class="fa fa-file-movie-o (alias)"></i> <span>อบรมและสาระ</span></a></li>
            <li><a href="{{ url('/admin') }}"><i class="fa fa-file-text-o"></i> <span>สอบออนไลน์</span></a></li>
            <li><a href="{{ url('/admin') }}"><i class="fa fa-newspaper-o"></i> <span>ปรึกษาและแนะนำ</span></a></li>


            <li class="nav-header">จัดการข้อมูลของ มาตรฐาน (ราคากลาง)</li>
            <li class="{{ Request::segment(2) === 'brands' ? 'active' : null }}">
                <a href="{{ url('/admin/brands') }}"><i class="fa fa-shopping-cart"></i> <span>Brand Product</span></a>
            </li>

            <li class="has-sub
                {{ Request::segment(2) === 'percents' ? 'active' : null }}
                {{ Request::segment(2) === 'install-machine' ? 'active' : null }}
                {{ Request::segment(2) === 'piping' ? 'active' : null }}
                {{ Request::segment(2) === 'control' ? 'active' : null }}
                {{ Request::segment(2) === 'duct-piping' ? 'active' : null }}
                {{ Request::segment(2) === 'main' ? 'active' : null }}
                ">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-gavel"></i>
                    <span>ข้อมูลโครงการ</span>
                </a>
                <ul class="sub-menu">
                    <li class="has-sub
                        {{--{{ Request::segment(2) === 'percents' ? 'active' : null }}--}}
                        {{ Request::segment(2) === 'install-machine' ? 'active' : null }}
                        {{ Request::segment(2) === 'piping' ? 'active' : null }}
                        {{ Request::segment(2) === 'control' ? 'active' : null }}
                        {{ Request::segment(2) === 'duct-piping' ? 'active' : null }}
                        {{ Request::segment(2) === 'main' ? 'active' : null }}
                            ">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            AIR Condition System
                        </a>
                        <ul class="sub-menu">
                            {{--<li class="{{ Request::segment(2) === 'percents' ? 'active' : null }}">--}}
                                {{--<a href="{{ url('/admin/percents') }}">(%)</a>--}}
                            {{--</li>--}}
                            <li class="{{ Request::segment(2) === 'install-machine' ? 'active' : null }}">
                                <a href="{{ url('/admin/install-machine') }}">Install Machine</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'piping' ? 'active' : null }}">
                                <a href="{{ url('/admin/piping') }}">Piping</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'control' ? 'active' : null }}">
                                <a href="{{ url('/admin/control') }}">Control</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'duct-piping' ? 'active' : null }}">
                                <a href="{{ url('/admin/duct-piping') }}">Duct piping</a>
                            </li>
                            <li class="{{ Request::segment(2) === 'main' ? 'active' : null }}">
                                <a href="{{ url('/admin/main') }}">Main  Electrical</a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            Menu 1.2
                        </a>
                        <ul class="sub-menu">
                            {{--<li><a href="{{ url('/admin/') }}">(%)</a></li>--}}
                            <li><a href="{{ url('/admin/') }}">มาตรฐาน(ราคากลาง)</a></li>
                        </ul>
                    </li>
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            Menu 1.3
                        </a>
                        <ul class="sub-menu">
                            {{--<li><a href="{{ url('/admin/') }}">(%)</a></li>--}}
                            <li><a href="{{ url('/admin/') }}">มาตรฐาน(ราคากลาง)</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::segment(2) === 'tags' ? 'active' : null }}">
                <a href="{{ url('/admin/tags') }}"><i class="fa fa-tags"></i> <span>Tag งานของระบบ</span></a>
            </li>

            <li class="nav-header">จัดการข้อมูลของ สมาชิกระบบ</li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-group (alias)"></i>
                    <span>จัดการข้อมูลสมาชิกระบบ</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ url('/admin/') }}">ข้อมูลผู้ดูแลระบบ</a></li>
                    <li><a href="{{ url('/admin/') }}">ข้อมูลสมาชิก</a></li>
                    <li><a href="{{ url('/admin/') }}">Reset password</a></li>
                </ul>
            </li>
            <!-- begin sidebar minify button -->
            {{--<li class="sidebar-minify-btn" ></li>--}}
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
<script>

</script>