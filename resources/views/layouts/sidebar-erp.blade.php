<nav id="sidebar-erp">
    <div class="sidebar-header">
        <h3>ERP</h3>
    </div>

    <ul class="list-unstyled components">
        @if($profile->statusType == 1)
            <li class="sidenav-item">
                <a href="{{ url('erp-home') }}">หน้าแรก</a>
            </li>
            <li class="sidenav-item">
                <a href="{{ url('erp-open') }}">ดำเนินการสำหรับผู้ซื้อ</a>
            </li>
            {{--<li class="sidenav-item">--}}
                {{--<a href="{{ url('erp-listOrder') }}">รายการสั่งซื้อ</a>--}}
            {{--</li>--}}
            <li class="sidenav-item">
                <a href="{{ url('erp-other') }}">บริการอื่นๆ</a>
            </li>
        @elseif($profile->statusType == 2)
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">จัดการร้านค้า</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    {{--<li>--}}
                        {{--<a href="{{ url('erp-priceSetup') }}">กำหนดราคาติดตั้ง</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{ url('erp-infoStore') }}">ข้อมูลร้านค้าและสินค้า</a>
                    </li>
                    <li>
                        <a href="{{ url('erp-purchaseOrder') }}">ใบสั่งซื้อ</a>
                    </li>
                    <li>
                        <a href="{{ url('erp-install') }}">งานที่ติดตั้ง</a>
                    </li>
                    <li>
                        <a href="{{ url('erp-service') }}">แจ้งบริการ</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</nav>