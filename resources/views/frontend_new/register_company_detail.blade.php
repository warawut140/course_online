<!doctype html>
<html lang="th">

<head>
    @include('frontend_new.header')
</head>

<body>


    @include('frontend_new.menu')

    <div class="mb-8 sk-thumbnail img-ratio-7">
        <img src="{{ asset('assets/img/covers/cover-20.jpg') }}" alt="..." class="img-fluid">
    </div>

    <div class="container">

        @if (session('success'))
            <div class="p-3 mb-2 bg-success text-white success text-center">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="p-3 mb-2 bg-danger text-white error text-center">{{ session('error') }}</div>
        @endif

        <div class="row mb-8">
            <div class="col-lg-12 mb-12 mb-lg-0 position-relative">

                <!-- COURSE INFO TAB
                ================================================== -->
                <div class="border rounded shadow p-3 mb-6">
                    <ul id="pills-tab" class="nav nav-pills course-tab-v2 h5 mb-0 flex-nowrap overflow-auto"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == '') {
                                echo 'active';
                            } ?>" id="pills-overview-tab"
                                href="{{ url('register_company_detail') }}" role="tab"
                                aria-controls="pills-overview" aria-selected="true">BASIC INFORMATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'web') {
                                echo 'active';
                            } ?>" id="pills-overview-tab2"
                                href="{{ url('register_company_detail/web') }}" role="tab"
                                aria-controls="pills-overview2" aria-selected="true">ON THE WEB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'job') {
                                echo 'active';
                            } ?>" id="pills-overview-tab3"
                                href="{{ url('register_company_detail/job') }}" role="tab"
                                aria-controls="pills-overview3" aria-selected="true">Add a job
                                descriptionE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'receive') {
                                echo 'active';
                            } ?>" id="pills-overview-tab4"
                                href="{{ url('register_company_detail/receive') }}" role="tab"
                                aria-controls="pills-overview4" aria-selected="true">How would you like to
                                receive your applicants?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($type == 'course') {
                                echo 'active';
                            } ?>" id="pills-overview-tab5"
                                href="{{ url('register_company_detail/course') }}" role="tab"
                                aria-controls="pills-overview5" aria-selected="true">COURSE</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">

                    @if ($type == '')
                        @include('auth.tab.basic')
                    @endif
                    @if ($type == 'web')
                        @include('auth.tab.on_web')
                    @endif
                    @if ($type == 'job')
                        @include('auth.tab.job')
                    @endif
                    @if ($type == 'receive')
                        @include('auth.tab.receive')
                    @endif

                    @if ($type == 'course')
                        @include('auth.tab.course')
                    @endif

                </div>

            </div>
        </div>

    </div>


    </div>

    @include('frontend_new.footer')

    <script>
        ClassicEditor
            .create(document.querySelector('.detail_ck'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('.detail_ck2'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>
