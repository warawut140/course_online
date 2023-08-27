<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.png">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Lora:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('./assets/fonts/fontawesome/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/aos/dist/aos.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/choices.js/public/assets/styles/choices.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/flickity-fade/flickity-fade.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/flickity/dist/flickity.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/highlightjs/styles/vs2015.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/jarallax/dist/jarallax.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/libs/quill/dist/quill.core.css')}}" />

    <!-- Map -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.min.css">

    <title>Skola</title>

</head>
<body>

    <!-- MODALS
    ================================================== -->
    <!-- Modal Sidebar account -->
    <div class="modal fade" id="modalExample" tabindex="-1" role="dialog" aria-labelledby="modalExampleTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">

            <!-- Close -->
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>

            <!-- Heading -->
            <h2 class="fw-bold text-center mb-1" id="modalExampleTitle">
              Schedule a demo with us
            </h2>

            <!-- Text -->
            <p class="font-size-lg text-center text-muted mb-6 mb-md-8">
              We can help you solve company communication.
            </p>

            <!-- Form -->
            <form>
              <div class="row">
                <div class="col-12 col-md-6">

                  <!-- First name -->
                  <div class="form-label-group">
                    <input type="text" class="form-control form-control-flush" id="registrationFirstNameModal" placeholder="First name">
                    <label for="registrationFirstNameModal">First name</label>
                  </div>

                </div>
                <div class="col-12 col-md-6">

                  <!-- Last name -->
                  <div class="form-label-group">
                    <input type="text" class="form-control form-control-flush" id="registrationLastNameModal" placeholder="Last name">
                    <label for="registrationLastNameModal">Last name</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6">

                  <!-- Email -->
                  <div class="form-label-group">
                    <input type="email" class="form-control form-control-flush" id="registrationEmailModal" placeholder="Email">
                    <label for="registrationEmailModal">Email</label>
                  </div>

                </div>
                <div class="col-12 col-md-6">

                  <!-- Password -->
                  <div class="form-label-group">
                    <input type="password" class="form-control form-control-flush" id="registrationPasswordModal" placeholder="Password">
                    <label for="registrationPasswordModal">Password</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-12">

                  <!-- Submit -->
                  <button class="btn btn-block btn-primary mt-3 lift">
                    Request a demo
                  </button>

                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-sidebar left fade-left fade" id="accountModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Signin -->
                <div class="collapse show" id="collapseSignin" data-bs-parent="#accountModal">
                    <div class="modal-header">
                        <h5 class="modal-title">Log In to Your Skola Account!</h5>
                        <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                            <!-- Icon -->
                            <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Signin -->
                        <form class="mb-5">

                            <!-- Email -->
                            <div class="form-group mb-5">
                                <label for="modalSigninEmail">
                                    Username or Email
                                </label>
                                <input type="email" class="form-control" id="modalSigninEmail" placeholder="creativelayers">
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-5">
                                <label for="modalSigninPassword">
                                    Password
                                </label>
                                <input type="password" class="form-control" id="modalSigninPassword" placeholder="**********">
                            </div>

                            <div class="d-flex align-items-center mb-5 font-size-sm">
                                <div class="form-check">
                                    <input class="form-check-input text-gray-800" type="checkbox" id="autoSizingCheck">
                                    <label class="form-check-label text-gray-800" for="autoSizingCheck">
                                        Remember me
                                    </label>
                                </div>

                                <div class="ms-auto">
                                    <a class="text-gray-800" data-bs-toggle="collapse" href="#collapseForgotPassword" role="button" aria-expanded="false" aria-controls="collapseForgotPassword">Forgot Password</a>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary" type="submit">
                                LOGIN
                            </button>
                        </form>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-center">
                            Don't have an account? <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignup" role="button" aria-expanded="false" aria-controls="collapseSignup">Sign up</a>
                        </p>
                    </div>
                </div>

                <!-- Signup -->
                <div class="collapse" id="collapseSignup" data-bs-parent="#accountModal">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign Up and Start Learning!</h5>
                        <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                            <!-- Icon -->
                            <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Signup -->
                        <form class="mb-5">

                            <!-- Username -->
                            <div class="form-group mb-5">
                                <label for="modalSignupUsername">
                                    Username
                                </label>
                                <input type="text" class="form-control" id="modalSignupUsername" placeholder="John">
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-5">
                                <label for="modalSignupEmail">
                                    Username or Email
                                </label>
                                <input type="email" class="form-control" id="modalSignupEmail" placeholder="johndoe@creativelayers.com">
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-5">
                                <label for="modalSignupPassword">
                                    Password
                                </label>
                                <input type="password" class="form-control" id="modalSignupPassword" placeholder="**********">
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary" type="submit">
                                SIGN UP
                            </button>

                        </form>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-center">
                            Already have an account? <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignin" role="button" aria-expanded="true" aria-controls="collapseSignin">Log In</a>
                        </p>
                    </div>
                </div>

                <!-- Forgot Password -->
                <div class="collapse" id="collapseForgotPassword" data-bs-parent="#accountModal">
                    <div class="modal-header">
                        <h5 class="modal-title">Recover password!</h5>
                        <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                            <!-- Icon -->
                            <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Recover Password -->
                        <form class="mb-5">
                            <!-- Email -->
                            <div class="form-group">
                                <label for="modalForgotpasswordEmail">
                                    Email
                                </label>
                                <input type="email" class="form-control" id="modalForgotpasswordEmail" placeholder="johndoe@creativelayers.com">
                            </div>

                            <!-- Submit -->
                            <button class="btn btn-block btn-primary" type="submit">
                                RECOVER PASSWORD
                            </button>
                        </form>

                        <!-- Text -->
                        <p class="mb-0 font-size-sm text-center">
                            Remember your password? <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignin" role="button" aria-expanded="false" aria-controls="collapseSignin">Log In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sidebar cart -->
    <div class="modal modal-sidebar left fade-left fade" id="cartModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-4">
                    <h5 class="modal-title">Your Shopping Cart</h5>
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <ul class="list-group list-group-flush mb-5">
                        <li class="list-group-item border-bottom py-0">
                            <div class="d-flex py-5">
                                <div class="bg-gray-200 w-60p h-60p rounded-circle overflow-hidden"></div>

                                <div class="flex-grow-1 mt-1 ms-4">
                                    <h6 class="fw-normal mb-0">Basic of Nature</h6>
                                    <div class="font-size-sm">1 × $18.00</div>
                                </div>

                                <a href="#" class="d-inline-flex text-secondary">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0469 0H5.95294C5.37707 0 4.90857 0.4685 4.90857 1.04437V3.02872H6.16182V1.25325H9.83806V3.02872H11.0913V1.04437C11.0913 0.4685 10.6228 0 10.0469 0Z" fill="currentColor"/>
                                        <path d="M11.0492 5.51652L9.7968 5.47058L9.52527 12.8857L10.7777 12.9315L11.0492 5.51652Z" fill="currentColor"/>
                                        <path d="M8.62666 5.49353H7.37341V12.9087H8.62666V5.49353Z" fill="currentColor"/>
                                        <path d="M6.47453 12.8855L6.203 5.47034L4.95056 5.51631L5.22212 12.9314L6.47453 12.8855Z" fill="currentColor"/>
                                        <path d="M0.543091 2.4021V3.65535H1.849L2.885 15.4283C2.9134 15.7519 3.18434 16 3.50912 16H12.4697C12.7946 16 13.0657 15.7517 13.0939 15.4281L14.1299 3.65535H15.4569V2.4021H0.543091ZM11.8958 14.7468H4.08293L3.10706 3.65535H12.8719L11.8958 14.7468Z" fill="currentColor"/>
                                    </svg>

                                </a>
                            </div>
                        </li>

                        <li class="list-group-item border-bottom py-0">
                            <div class="d-flex py-5">
                                <div class="bg-gray-200 w-60p h-60p rounded-circle overflow-hidden"></div>

                                <div class="flex-grow-1 mt-1 ms-4">
                                    <h6 class="fw-normal mb-0">Color Harriet Tubman</h6>
                                    <div class="font-size-sm">1 × $18.00</div>
                                </div>

                                <a href="#" class="d-inline-flex text-secondary">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0469 0H5.95294C5.37707 0 4.90857 0.4685 4.90857 1.04437V3.02872H6.16182V1.25325H9.83806V3.02872H11.0913V1.04437C11.0913 0.4685 10.6228 0 10.0469 0Z" fill="currentColor"/>
                                        <path d="M11.0492 5.51652L9.7968 5.47058L9.52527 12.8857L10.7777 12.9315L11.0492 5.51652Z" fill="currentColor"/>
                                        <path d="M8.62666 5.49353H7.37341V12.9087H8.62666V5.49353Z" fill="currentColor"/>
                                        <path d="M6.47453 12.8855L6.203 5.47034L4.95056 5.51631L5.22212 12.9314L6.47453 12.8855Z" fill="currentColor"/>
                                        <path d="M0.543091 2.4021V3.65535H1.849L2.885 15.4283C2.9134 15.7519 3.18434 16 3.50912 16H12.4697C12.7946 16 13.0657 15.7517 13.0939 15.4281L14.1299 3.65535H15.4569V2.4021H0.543091ZM11.8958 14.7468H4.08293L3.10706 3.65535H12.8719L11.8958 14.7468Z" fill="currentColor"/>
                                    </svg>

                                </a>
                            </div>
                        </li>

                        <li class="list-group-item border-bottom py-0">
                            <div class="d-flex py-5">
                                <div class="bg-gray-200 w-60p h-60p rounded-circle overflow-hidden"></div>

                                <div class="flex-grow-1 mt-1 ms-4">
                                    <h6 class="fw-normal mb-0">Digital Photography</h6>
                                    <div class="font-size-sm">1 × $18.00</div>
                                </div>

                                <a href="#" class="d-inline-flex text-secondary">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0469 0H5.95294C5.37707 0 4.90857 0.4685 4.90857 1.04437V3.02872H6.16182V1.25325H9.83806V3.02872H11.0913V1.04437C11.0913 0.4685 10.6228 0 10.0469 0Z" fill="currentColor"/>
                                        <path d="M11.0492 5.51652L9.7968 5.47058L9.52527 12.8857L10.7777 12.9315L11.0492 5.51652Z" fill="currentColor"/>
                                        <path d="M8.62666 5.49353H7.37341V12.9087H8.62666V5.49353Z" fill="currentColor"/>
                                        <path d="M6.47453 12.8855L6.203 5.47034L4.95056 5.51631L5.22212 12.9314L6.47453 12.8855Z" fill="currentColor"/>
                                        <path d="M0.543091 2.4021V3.65535H1.849L2.885 15.4283C2.9134 15.7519 3.18434 16 3.50912 16H12.4697C12.7946 16 13.0657 15.7517 13.0939 15.4281L14.1299 3.65535H15.4569V2.4021H0.543091ZM11.8958 14.7468H4.08293L3.10706 3.65535H12.8719L11.8958 14.7468Z" fill="currentColor"/>
                                    </svg>

                                </a>
                            </div>
                        </li>
                    </ul>

                    <div class="d-flex mb-5">
                        <h5 class="mb-0 me-auto">Order Subtotal</h5>
                        <h5 class="mb-0">$121.87</h5>
                    </div>

                    <div class="d-md-flex justify-content-between">
                        <a href="#" class="d-block d-md-inline-block mb-4 mb-md-0 btn btn-primary btn-sm-wide">VIEW CART</a>
                        <a href="#" class="d-block d-md-inline-block btn btn-teal btn-sm-wide text-white">CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- NAVBAR
    ================================================== -->
    <header class="navbar navbar-expand-xl navbar-light bg-white border-bottom border-xl-0 py-2 py-xl-4">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand me-0" href="./index.html">
                <img src="./assets/img/brand.svg" class="navbar-brand-img" alt="...">
            </a>

            <!-- Vertical Menu -->
            <ul class="navbar-nav navbar-vertical ms-xl-4 d-none d-xl-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pb-4 mb-n4 px-0 pt-0" id="navbarVerticalMenu" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                        <div class="bg-primary rounded py-3 px-5 d-flex align-items-center">
                            <div class="me-3 ms-1 d-flex text-white">
                                <!-- Icon -->
                                <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="25" height="1" fill="currentColor"/>
                                    <rect y="8" width="15" height="1" fill="currentColor"/>
                                    <rect y="16" width="20" height="1" fill="currentColor"/>
                                </svg>

                            </div>
                            <span class="text-white fw-medium me-1">Courses</span>
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-md bg-primary rounded py-4 mt-4" aria-labelledby="navbarVerticalMenu">
                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5247 5.64759C10.3104 5.21736 9.6919 5.21322 9.47557 5.64759L5.37401 13.8898C5.28096 14.0767 5.29443 14.299 5.4094 14.4734L7.65635 17.8813V20.0493C7.65635 20.3729 7.91869 20.6352 8.24229 20.6352H11.7579C12.0815 20.6352 12.3439 20.3729 12.3439 20.0493V17.8813L14.5908 14.4734C14.7058 14.299 14.7192 14.0767 14.6262 13.8898L10.5247 5.64759ZM11.172 19.4633H8.82822V18.2915H11.172V19.4633ZM11.4424 17.1196H8.55779L6.57342 14.1099L9.41416 8.40131V14.1508C9.41416 14.4744 9.67651 14.7368 10.0001 14.7368C10.3237 14.7368 10.586 14.4744 10.586 14.1508V8.40131L13.4268 14.1099L11.4424 17.1196Z" fill="currentColor" fill-opacity="0.6"/>
                                        <path d="M18.2422 0.635132C17.4783 0.635132 16.827 1.12501 16.5852 1.80701H11.7578V1.22107C11.7578 0.897476 11.4955 0.635132 11.1719 0.635132H8.82812C8.50453 0.635132 8.24219 0.897476 8.24219 1.22107V1.80701H3.41484C3.17297 1.12501 2.52168 0.635132 1.75781 0.635132C0.788555 0.635132 0 1.42369 0 2.39294C0 3.3622 0.788555 4.15076 1.75781 4.15076C2.52168 4.15076 3.17297 3.66048 3.41484 2.97849H5.60676C2.87645 4.5465 1.17188 7.44322 1.17188 10.5961C1.17188 10.9197 1.43422 11.182 1.75781 11.182C2.08141 11.182 2.34375 10.9197 2.34375 10.5961C2.34375 7.06076 4.8359 3.98591 8.24219 3.18271V3.56482C8.24219 3.88841 8.50453 4.15076 8.82812 4.15076H11.1719C11.4955 4.15076 11.7578 3.88841 11.7578 3.56482V3.18267C15.1641 3.98591 17.6562 7.06076 17.6562 10.5961C17.6562 10.9197 17.9186 11.182 18.2422 11.182C18.5658 11.182 18.8281 10.9197 18.8281 10.5961C18.8281 7.44724 17.127 4.54884 14.3932 2.97888H16.5852C16.827 3.66087 17.4783 4.15076 18.2422 4.15076C19.2114 4.15076 20 3.3622 20 2.39294C20 1.42369 19.2114 0.635132 18.2422 0.635132ZM1.75781 2.97888C1.43473 2.97888 1.17188 2.71603 1.17188 2.39294C1.17188 2.06986 1.43473 1.80701 1.75781 1.80701C2.0809 1.80701 2.34375 2.06986 2.34375 2.39294C2.34375 2.71603 2.0809 2.97888 1.75781 2.97888ZM10.5859 2.97888H9.41406V1.80701H10.5859V2.97888ZM18.2422 2.97888C17.9191 2.97888 17.6562 2.71603 17.6562 2.39294C17.6562 2.06986 17.9191 1.80701 18.2422 1.80701C18.5653 1.80701 18.8281 2.06986 18.8281 2.39294C18.8281 2.71603 18.5653 2.97888 18.2422 2.97888Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Design
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.6062 4.12238C17.6014 4.12723 17.5965 4.12723 17.5917 4.12723H13.8383V3.02017C13.8383 1.94709 12.9497 1.06824 11.8767 1.06824H7.86113C6.78806 1.07309 5.91891 1.94709 5.92377 3.02017V4.12723H2.41321C1.08279 4.12723 0 5.20031 0 6.53073C0 6.53558 0 6.54044 0 6.54529V8.56035C0 9.39065 0.388444 10.1481 1.06822 10.59V16.4943C1.07308 17.8393 2.16072 18.9269 3.50571 18.9318H16.4943C17.8393 18.9269 18.9269 17.8393 18.9318 16.4943V10.59C19.6116 10.1481 20 9.38579 20 8.56035V6.54529C20.0049 5.21487 18.9318 4.13209 17.6062 4.12238ZM6.89488 3.02017C6.89002 2.4812 7.32217 2.0442 7.86113 2.03935H11.8767C12.4205 2.0442 12.8623 2.47635 12.8672 3.02017V4.12723H6.89488V3.02017ZM17.9655 16.4992C17.9607 17.31 17.3052 17.9655 16.4992 17.9655H3.50571C2.69483 17.9607 2.03933 17.3052 2.03933 16.4992V10.993L6.29765 12.2943C8.71085 13.0372 11.294 13.0372 13.7121 12.2943L17.9655 10.993V16.4992ZM19.0435 6.54044V8.56035H19.0337C19.0386 9.13816 18.6987 9.66256 18.1743 9.89562C18.1695 9.89562 18.1695 9.90048 18.1646 9.90048C18.1209 9.9199 18.0723 9.93932 18.0286 9.95389H18.0238L13.4256 11.362C11.1969 12.0466 8.81767 12.0466 6.58898 11.362L1.98592 9.95389C1.94222 9.93932 1.89852 9.92476 1.85482 9.90533C1.85482 9.90533 1.85967 9.90533 1.85967 9.90048C1.32071 9.67227 0.975965 9.14301 0.980821 8.55549V6.54044C0.975965 5.74898 1.61204 5.09834 2.4035 5.08863C2.40835 5.08863 2.41321 5.08863 2.42292 5.08863H17.6014C18.3928 5.08378 19.0386 5.72471 19.0435 6.52102C19.0435 6.52587 19.0435 6.53073 19.0435 6.54044Z" fill="currentColor" fill-opacity="0.6"/>
                                        <path d="M13.3965 7.0939C13.076 6.77829 12.6439 6.59863 12.1923 6.60349H7.81258C6.87545 6.60349 6.11313 7.36095 6.10828 8.30293C6.10828 8.7545 6.28793 9.18664 6.60354 9.50225C6.60354 9.50225 6.6084 9.50225 6.6084 9.50711C6.92887 9.82272 7.36101 10.0024 7.81258 10.0024H12.1923C13.1343 10.0024 13.8966 9.24005 13.8917 8.29807C13.8917 7.84651 13.7169 7.41922 13.3965 7.0939ZM12.1923 9.03126H7.81258C7.40956 9.03126 7.08424 8.70594 7.08424 8.30293C7.08424 7.89992 7.40956 7.5746 7.81258 7.5746H12.1923C12.5953 7.5746 12.9206 7.89992 12.9206 8.30293C12.9206 8.70594 12.5953 9.03126 12.1923 9.03126Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Business
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.2422 0.0397949H1.75781C0.788555 0.0397949 0 0.82835 0 1.79761V18.2039C0 19.1731 0.788555 19.9617 1.75781 19.9617H18.2422C19.2114 19.9617 20 19.1731 20 18.2039V1.79761C20 0.82835 19.2114 0.0397949 18.2422 0.0397949ZM1.75781 1.21167H18.2422C18.5653 1.21167 18.8281 1.47452 18.8281 1.79761V4.72729H1.17188V1.79761C1.17188 1.47452 1.43473 1.21167 1.75781 1.21167ZM18.2422 18.7898H1.75781C1.43473 18.7898 1.17188 18.5269 1.17188 18.2039V5.89917H18.8281V18.2039C18.8281 18.5269 18.5653 18.7898 18.2422 18.7898Z" fill="currentColor"/>
                                        <path d="M11.9887 7.70365C11.6912 7.57619 11.3468 7.71396 11.2193 8.01138L7.70367 16.2145C7.57616 16.5119 7.71398 16.8564 8.0114 16.9839C8.30894 17.1114 8.65335 16.9735 8.78078 16.6761L12.2964 8.47302C12.4239 8.17556 12.2861 7.83111 11.9887 7.70365Z" fill="currentColor"/>
                                        <path d="M6.94201 9.63397C6.73982 9.38128 6.37103 9.34034 6.11845 9.54249L3.18876 11.8862C2.89583 12.1205 2.89564 12.5669 3.18876 12.8013L6.11845 15.1451C6.37115 15.3473 6.73994 15.3062 6.94201 15.0536C7.14416 14.8009 7.10322 14.4321 6.85048 14.23L4.49275 12.3438L6.85048 10.4576C7.10322 10.2554 7.14416 9.88671 6.94201 9.63397Z" fill="currentColor"/>
                                        <path d="M16.8114 11.8863L13.8817 9.54251C13.629 9.34032 13.2602 9.38129 13.0581 9.63399C12.856 9.88668 12.8969 10.2554 13.1496 10.4575L15.5074 12.3438L13.1496 14.23C12.8969 14.4321 12.856 14.8009 13.0581 15.0536C13.2605 15.3065 13.6293 15.347 13.8817 15.145L16.8114 12.8013C17.1043 12.567 17.1045 12.1207 16.8114 11.8863Z" fill="currentColor"/>
                                        <path d="M2.96875 3.55469C3.29235 3.55469 3.55469 3.29235 3.55469 2.96875C3.55469 2.64515 3.29235 2.38281 2.96875 2.38281C2.64515 2.38281 2.38281 2.64515 2.38281 2.96875C2.38281 3.29235 2.64515 3.55469 2.96875 3.55469Z" fill="currentColor"/>
                                        <path d="M5.3125 3.55469C5.6361 3.55469 5.89844 3.29235 5.89844 2.96875C5.89844 2.64515 5.6361 2.38281 5.3125 2.38281C4.9889 2.38281 4.72656 2.64515 4.72656 2.96875C4.72656 3.29235 4.9889 3.55469 5.3125 3.55469Z" fill="currentColor"/>
                                        <path d="M7.65625 3.55469C7.97985 3.55469 8.24219 3.29235 8.24219 2.96875C8.24219 2.64515 7.97985 2.38281 7.65625 2.38281C7.33265 2.38281 7.07031 2.64515 7.07031 2.96875C7.07031 3.29235 7.33265 3.55469 7.65625 3.55469Z" fill="currentColor"/>
                                        <path d="M13.5156 3.55469H17.0312C17.3548 3.55469 17.6172 3.29234 17.6172 2.96875C17.6172 2.64516 17.3548 2.38281 17.0312 2.38281H13.5156C13.192 2.38281 12.9297 2.64516 12.9297 2.96875C12.9297 3.29234 13.192 3.55469 13.5156 3.55469Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Software Development
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.5717 0H4.16956C4.05379 0.00594643 3.94322 0.0496071 3.85456 0.124286L0.413131 3.57857C0.328167 3.65957 0.280113 3.77191 0.280274 3.88929V16.8514C0.281452 17.4853 0.794988 17.9988 1.42885 18H12.5717C13.1981 17.9989 13.7086 17.497 13.7203 16.8707V1.14857C13.7191 0.514714 13.2056 0.00117857 12.5717 0ZM8.18099 0.857143H10.6988V4.87714L9.80527 3.45214C9.76906 3.39182 9.71859 3.3413 9.65827 3.30514C9.45529 3.18337 9.19204 3.24916 9.07027 3.45214L8.18099 4.87071V0.857143ZM3.7367 1.46786V2.66143C3.73552 3.10002 3.38029 3.45525 2.9417 3.45643H1.74813L3.7367 1.46786ZM12.8546 16.86C12.8534 17.0157 12.7274 17.1417 12.5717 17.1429H1.42885C1.42665 17.1429 1.42445 17.143 1.42226 17.143C1.26486 17.1441 1.13635 17.0174 1.13527 16.86V4.32214H2.9417C3.85793 4.31979 4.60006 3.57766 4.60242 2.66143V0.857143H7.31527V5.23286C7.31345 5.42593 7.37688 5.61391 7.49527 5.76643C7.67533 5.99539 7.98036 6.08561 8.25599 5.99143L8.28813 5.98071C8.49272 5.89484 8.66356 5.7443 8.77456 5.55214L9.44099 4.48071L10.1074 5.55214C10.2184 5.7443 10.3893 5.89484 10.5938 5.98071C10.8764 6.0922 11.1987 6.00509 11.3867 5.76643C11.5051 5.61391 11.5685 5.42593 11.5667 5.23286V0.857143H12.5717C12.7266 0.858268 12.8523 0.982982 12.8546 1.13786V16.86Z" fill="currentColor"/>
                                        <path d="M10.7761 14.3143H3.22252C2.98584 14.3143 2.79395 14.5062 2.79395 14.7429C2.79395 14.9796 2.98584 15.1715 3.22252 15.1715H10.7761C11.0128 15.1715 11.2047 14.9796 11.2047 14.7429C11.2047 14.5062 11.0128 14.3143 10.7761 14.3143Z" fill="currentColor"/>
                                        <path d="M10.7761 12.2035H3.22252C2.98584 12.2035 2.79395 12.3954 2.79395 12.6321C2.79395 12.8687 2.98584 13.0606 3.22252 13.0606H10.7761C11.0128 13.0606 11.2047 12.8687 11.2047 12.6321C11.2047 12.3954 11.0128 12.2035 10.7761 12.2035Z" fill="currentColor"/>
                                        <path d="M10.7761 10.0928H3.22252C2.98584 10.0928 2.79395 10.2847 2.79395 10.5213C2.79395 10.758 2.98584 10.9499 3.22252 10.9499H10.7761C11.0128 10.9499 11.2047 10.758 11.2047 10.5213C11.2047 10.2847 11.0128 10.0928 10.7761 10.0928Z" fill="currentColor"/>
                                        <path d="M10.7761 7.98218H3.22252C2.98584 7.98218 2.79395 8.17407 2.79395 8.41075C2.79395 8.64743 2.98584 8.83932 3.22252 8.83932H10.7761C11.0128 8.83932 11.2047 8.64743 11.2047 8.41075C11.2047 8.17407 11.0128 7.98218 10.7761 7.98218Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Personal Development
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0C4.47715 0 0 4.47715 0 10C0 15.5229 4.47715 20 10 20C15.5229 20 20 15.5229 20 10C20 4.47715 15.5229 0 10 0ZM17.8937 6.25H10C9.75668 6.24934 9.51387 6.27238 9.275 6.31875L12.0813 1.50625C14.6328 2.13449 16.7668 3.87617 17.8937 6.25ZM12.5 10C12.5048 11.3807 11.3893 12.5038 10.0086 12.5086C8.62789 12.5134 7.50477 11.3979 7.5 10.0172C7.49523 8.63648 8.6107 7.51336 9.99141 7.50859C10.8075 7.50578 11.5737 7.90152 12.0438 8.56875L12.0938 8.6375C12.3582 9.04277 12.4993 9.51609 12.5 10ZM10 1.25C10.2563 1.25 10.5125 1.25 10.7625 1.2875L6.9625 7.8125C6.83379 7.98977 6.72086 8.17801 6.625 8.375L3.86875 3.75C5.50613 2.1457 7.7077 1.24805 10 1.25ZM1.25 10C1.25043 8.10965 1.86699 6.27098 3.00625 4.7625L6.25 10.1875C6.29629 11.0459 6.63609 11.8623 7.2125 12.5H1.5875C1.3543 11.6875 1.24063 10.8453 1.25 10ZM2.10625 13.75H10C10.2433 13.7507 10.4861 13.7276 10.725 13.6812L7.91875 18.4937C5.36723 17.8655 3.23316 16.1238 2.10625 13.75ZM10 18.75C9.74375 18.75 9.4875 18.75 9.2375 18.7125L13.0375 12.1875C13.309 11.8108 13.5082 11.387 13.625 10.9375L16.75 15.5875C15.084 17.5953 12.6089 18.7549 10 18.75ZM13.125 7.98125L13.0375 7.85L12.9875 7.775C12.9167 7.67918 12.8396 7.58543 12.7563 7.49375H18.3813C19.0941 9.84641 18.7737 12.3912 17.5 14.4938L13.125 7.98125Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Photography
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.7859 0.164169C17.6493 0.0430309 17.468 -0.0150898 17.2864 0.00408285L5.71501 1.28978C5.3893 1.32583 5.14284 1.6011 5.14288 1.92877V13.3845C4.56001 13.0365 3.89315 12.8542 3.21431 12.8573C1.44194 12.8574 0 14.0107 0 15.4288C0 16.8469 1.44195 18.0002 3.21427 18.0002C4.9866 18.0002 6.42854 16.8469 6.42854 15.4288V5.72165L16.7143 4.57543V12.0969C16.1312 11.7495 15.4644 11.5679 14.7857 11.5717C13.0133 11.5717 11.5714 12.725 11.5714 14.1431C11.5714 15.5612 13.0134 16.7145 14.7857 16.7145C16.558 16.7145 18 15.5612 18 14.1431V0.64311C18 0.460272 17.9221 0.286098 17.7859 0.164169ZM3.21427 16.7145C2.169 16.7145 1.2857 16.1256 1.2857 15.4288C1.2857 14.732 2.169 14.1431 3.21427 14.1431C4.25954 14.1431 5.14284 14.732 5.14284 15.4288C5.14284 16.1256 4.25958 16.7145 3.21427 16.7145ZM14.7857 15.4288C13.7404 15.4288 12.8571 14.8399 12.8571 14.1431C12.8571 13.4462 13.7404 12.8574 14.7857 12.8574C15.831 12.8574 16.7143 13.4462 16.7143 14.1431C16.7143 14.8399 15.831 15.4288 14.7857 15.4288ZM16.7143 3.28201L6.42854 4.42503V2.50738L16.7143 1.36116V3.28201Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Audio + Music
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21.3555 10.3555H19.4219C19.0659 10.3555 18.7773 10.644 18.7773 11C18.7773 11.356 19.0659 11.6445 19.4219 11.6445H21.3555C21.7114 11.6445 22 11.356 22 11C22 10.644 21.7114 10.3555 21.3555 10.3555Z" fill="currentColor"/>
                                        <path d="M20.5222 14.4114L19.2331 13.1223C18.9815 12.8707 18.5733 12.8707 18.3216 13.1223C18.0699 13.374 18.0699 13.7821 18.3216 14.0338L19.6107 15.3229C19.8624 15.5746 20.2705 15.5746 20.5222 15.3229C20.7739 15.0712 20.7739 14.6631 20.5222 14.4114Z" fill="currentColor"/>
                                        <path d="M20.5222 6.67703C20.2705 6.42536 19.8624 6.42536 19.6107 6.67703L18.3216 7.96609C18.0699 8.2178 18.0699 8.62588 18.3216 8.87759C18.5733 9.1293 18.9814 9.12926 19.2331 8.87759L20.5222 7.58853C20.7739 7.33682 20.7739 6.92874 20.5222 6.67703Z" fill="currentColor"/>
                                        <path d="M14.9102 2.62109C13.942 2.62109 13.1379 3.33631 12.9982 4.26611L12.4102 4.85405C11.3869 5.87735 9.87993 6.48828 8.37891 6.48828H4.51172C3.67146 6.48828 2.95505 7.02715 2.68898 7.77734H2.57812C1.15655 7.77734 0 8.93389 0 10.3555C0 11.777 1.15655 12.9336 2.57812 12.9336H2.68898C2.8835 13.482 3.31873 13.9173 3.86719 14.1118V17.4453C3.86719 18.5115 4.73464 19.3789 5.80082 19.3789C6.86697 19.3789 7.73438 18.5115 7.73438 17.4453V14.2227H8.37891C9.87989 14.2227 11.3869 14.8336 12.4102 15.8569L12.9982 16.4448C13.1379 17.3746 13.9421 18.0898 14.9102 18.0898C15.9763 18.0898 16.8438 17.2224 16.8438 16.1562V4.55469C16.8438 3.4885 15.9763 2.62109 14.9102 2.62109ZM2.57812 11.6445C1.86734 11.6445 1.28906 11.0663 1.28906 10.3555C1.28906 9.64468 1.86734 9.06641 2.57812 9.06641V11.6445ZM6.44531 17.4453C6.44531 17.8007 6.15618 18.0898 5.80078 18.0898C5.44539 18.0898 5.15625 17.8007 5.15625 17.4453V14.2227H6.44531V17.4453ZM7.73438 12.9336H4.51172C4.15632 12.9336 3.86719 12.6445 3.86719 12.2891V8.42187C3.86719 8.06648 4.15632 7.77734 4.51172 7.77734H7.73438V12.9336ZM12.9766 14.6242C11.8877 13.6819 10.4877 13.0963 9.01914 12.9628L9.01918 7.74808C10.4877 7.61462 11.8877 7.02909 12.9766 6.08665V14.6242ZM15.5547 16.1562C15.5547 16.5116 15.2656 16.8008 14.9102 16.8008H14.9102C14.5548 16.8008 14.2656 16.5116 14.2656 16.1562V4.55469C14.2656 4.19929 14.5548 3.91016 14.9102 3.91016C15.2656 3.91016 15.5547 4.19929 15.5547 4.55469V16.1562Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Marketing
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown-item dropright">
                            <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                <div class="me-4 d-flex text-white icon-xs">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.0833 1.80566H4.08796C3.03241 1.81029 2.17593 2.66678 2.17593 3.72696V3.75011H1.91667C0.861111 3.75011 0.00462963 4.60196 0 5.65752V16.2733C0.00462963 17.3288 0.856482 18.1899 1.91667 18.1946H15.912C16.9676 18.1899 17.8241 17.3334 17.8241 16.2733V16.2501H18.0833C19.1389 16.2501 19.9954 15.3983 20 14.3427V3.72696C19.9954 2.66678 19.1435 1.81029 18.0833 1.80566ZM15.912 17.2686H1.91667C1.37037 17.264 0.930556 16.8196 0.925926 16.2733V5.65752C0.930556 5.11585 1.37037 4.67603 1.91667 4.67603H15.912C16.4537 4.67603 16.8981 5.11122 16.8981 5.65752V8.30566C16.8148 8.32418 16.7315 8.33344 16.6528 8.33344H13.9815C12.5278 8.33344 11.3472 9.514 11.3472 10.9677C11.3472 12.4214 12.5278 13.602 13.9815 13.6066H16.6481C16.7315 13.602 16.8148 13.5927 16.8935 13.5834L16.8981 16.2733C16.8981 16.8196 16.4583 17.264 15.912 17.2686ZM19.0741 14.3427C19.0694 14.8844 18.6296 15.3242 18.0833 15.3242H17.8241V13.2501C18.0231 13.1159 18.2037 12.9492 18.3565 12.764L19.0741 11.8381V14.3427ZM17.625 12.2038C17.3935 12.5047 17.0324 12.6807 16.6528 12.6853H13.9815C13.037 12.6807 12.2731 11.9168 12.2731 10.9723C12.2731 10.0279 13.037 9.264 13.9815 9.25937H16.6481C16.9676 9.25937 17.2824 9.18992 17.5694 9.05103C17.875 8.90752 18.1435 8.68992 18.3519 8.4214L19.0694 7.49548L19.0741 10.3242L17.625 12.2038ZM19.0741 5.98159L17.8241 7.5927V5.65752C17.8241 4.60196 16.9676 3.75011 15.912 3.75011H3.10185V3.72696C3.10185 3.18066 3.54167 2.73622 4.08796 2.73159H18.0833C18.6296 2.73622 19.0694 3.18066 19.0741 3.72696V5.98159Z" fill="currentColor"/>
                                        <path d="M15.0185 10.5093H13.9074C13.6528 10.5093 13.4445 10.7176 13.4445 10.9722C13.4445 11.2269 13.6528 11.4352 13.9074 11.4352H15.0185C15.2732 11.4352 15.4815 11.2269 15.4815 10.9722C15.4815 10.7176 15.2732 10.5093 15.0185 10.5093Z" fill="currentColor"/>
                                    </svg>

                                </div>
                                Finance & Accounting
                            </a>

                            <div class="dropdown-menu ps-3 top-0 pe-0 py-0 shadow-none bg-transparent">
                                <div class="dropdown-menu-md bg-primary rounded dropdown-menu-inner">
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        All Business
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Finance
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Entrepreneurship
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Communications
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v5.html">
                                        Management
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Sales
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Operations
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Search -->
            <form class="d-none d-wd-flex ms-5 w-xl-450p">
                <div class="input-group border rounded">
                    <div class="input-group-prepend">
                        <button class="btn btn-sm my-2 my-sm-0 text-secondary icon-xs d-flex align-items-center" type="submit">
                            <!-- Icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z" fill="currentColor"/>
                                <path d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z" fill="currentColor"/>
                            </svg>

                        </button>
                    </div>
                    <input class="form-control form-control-sm border-0 ps-0" type="search" placeholder="What do you want to learn ?" aria-label="Search">
                </div>
            </form>

            <!-- Collapse -->
            <div class="collapse navbar-collapse z-index-lg" id="navbarCollapse">

                <!-- Toggler -->
                <button class="navbar-toggler outline-0 text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- Icon -->
                    <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                        <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                    </svg>

                </button>

                <!-- Navigation -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown dropdown-full-width">
                        <a class="nav-link dropdown-toggle" id="navbarLandings" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Home
                        </a>
                        <div class="dropdown-menu border-xl shadow-none dropdown-full pt-xl-7 px-xl-8" aria-labelledby="navbarLandings">
                            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./index.html" target="_blank">
                                        <img src="./assets/img/menu/home-v1.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v1</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v2.html" target="_blank">
                                        <img src="./assets/img/menu/home-v2.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v2</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v3.html" target="_blank">
                                        <img src="./assets/img/menu/home-v3.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v3</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v4.html" target="_blank">
                                        <img src="./assets/img/menu/home-v4.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v4</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v5.html" target="_blank">
                                        <img src="./assets/img/menu/home-v5.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v5</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v6.html" target="_blank">
                                        <img src="./assets/img/menu/home-v6.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v6</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v7.html" target="_blank">
                                        <img src="./assets/img/menu/home-v7.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v7</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v8.html" target="_blank">
                                        <img src="./assets/img/menu/home-v8.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v8</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v9.html" target="_blank">
                                        <img src="./assets/img/menu/home-v9.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v9</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v10.html" target="_blank">
                                        <img src="./assets/img/menu/home-v10.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v10</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v11.html" target="_blank">
                                        <img src="./assets/img/menu/home-v11.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v11</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v12.html" target="_blank">
                                        <img src="./assets/img/menu/home-v12.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v12</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v13.html" target="_blank">
                                        <img src="./assets/img/menu/home-v13.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v13</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v14.html" target="_blank">
                                        <img src="./assets/img/menu/home-v14.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v14</h6>
                                    </a>
                                </div>
                                <div class="col mb-5 col-wd-auto">
                                    <!-- List -->
                                    <a class="dropdown-item" href="./home-v15.html" target="_blank">
                                        <img src="./assets/img/menu/home-v15.jpg" class="img-fluid shadow rounded border d-flex mx-auto mb-5 h-md-152" alt="...">
                                        <!-- Heading -->
                                        <h6 class="text-center mb-0">Home v15</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarCourses" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Courses
                        </a>
                        <div class="dropdown-menu border-xl shadow-none dropdown-menu-lg" aria-labelledby="navbarCourses">
                            <div class="row gx-0">
                                <div class="col-md-4">
                                    <!-- Heading -->
                                    <h5 class="dropdown-header">
                                        Courses List
                                    </h5>

                                    <!-- List -->
                                    <a class="dropdown-item" href="./course-list-v1.html">
                                        Courses List v1
                                    </a>
                                    <a class="dropdown-item" href="./course-list-v2.html">
                                        Courses List v2
                                    </a>
                                    <a class="dropdown-item" href="./course-list-v3.html">
                                        Courses List v3
                                    </a>
                                    <a class="dropdown-item" href="./course-list-v4.html">
                                        Courses List v4
                                    </a>
                                    <a class="dropdown-item" href="./course-list-v5.html">
                                        Courses List v5
                                    </a>
                                    <a class="dropdown-item mb-5" href="./course-list-v6.html">
                                        Courses List v6
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <!-- Heading -->
                                    <h5 class="dropdown-header">
                                        Courses Single
                                    </h5>

                                    <!-- List -->
                                    <a class="dropdown-item" href="./course-single-v1.html">
                                        Courses Single v1
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v2.html">
                                        Courses Single v2
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v3.html">
                                        Courses Single v3
                                    </a>
                                    <a class="dropdown-item" href="./course-single-v4.html">
                                        Courses Single v4
                                    </a>
                                    <a class="dropdown-item mb-5" href="./course-single-v5.html">
                                        Courses Single v5
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <!-- Heading -->
                                    <h5 class="dropdown-header">
                                        Lesson Single
                                    </h5>

                                    <!-- List -->
                                    <a class="dropdown-item" href="./lesson-single-v1.html">
                                        Lesson Single v1
                                    </a>
                                    <a class="dropdown-item mb-5" href="./lesson-single-v2.html">
                                        Lesson Single v2
                                    </a>

                                    <!-- Heading -->
                                    <h5 class="dropdown-header">
                                        Instructors
                                    </h5>

                                    <!-- List -->
                                    <a class="dropdown-item" href="./instructors-list-v1.html">
                                        Instructors List v1
                                    </a>
                                    <a class="dropdown-item" href="./instructors-list-v2.html">
                                        Instructors List v2
                                    </a>
                                    <a class="dropdown-item mb-5 mb-lg-0" href="./instructors-single.html">
                                        Instructors Single
                                    </a>
                                </div>
                            </div>
                        </div> <!-- / .row -->
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarPages" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Pages
                        </a>
                        <div class="dropdown-menu border-xl shadow-none dropdown-menu-lg" aria-labelledby="navbarPages">
                            <div class="row gx-0">
                                <div class="col-6">
                                    <div class="row gx-0">
                                        <div class="col-12 col-lg-6">
                                            <!-- List -->
                                            <a class="dropdown-item" href="./event-list.html">
                                                Event List
                                            </a>
                                            <a class="dropdown-item" href="./event-single.html">
                                                Event Single
                                            </a>
                                            <a class="dropdown-item" href="./gallery.html">
                                                Gallery
                                            </a>
                                            <a class="dropdown-item mb-5 mb-lg-0" href="./pricing.html">
                                                Pricing
                                            </a>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <!-- List -->
                                            <a class="dropdown-item" href="./about-v1.html">
                                                About v1
                                            </a>
                                            <a class="dropdown-item" href="./about-v2.html">
                                                About v2
                                            </a>
                                            <a class="dropdown-item" href="./contact-us.html">
                                                Contact us
                                            </a>
                                            <a class="dropdown-item mb-5 mb-lg-0" href="./terms-of-service.html">
                                                Terms of Service
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row gx-0">
                                        <div class="col-12 col-lg-6">
                                            <!-- List -->
                                            <a class="dropdown-item" href="./faq.html">
                                                FAQ
                                            </a>
                                            <a class="dropdown-item" href="./login.html">
                                                Login
                                            </a>
                                            <a class="dropdown-item" href="./register.html">
                                                Register
                                            </a>
                                            <a class="dropdown-item mb-5 mb-lg-0" href="./become-instructor.html">
                                                Become an Instructor
                                            </a>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <!-- List -->
                                            <a class="dropdown-item" href="./coming-soon.html">
                                                Coming Soon
                                            </a>
                                            <a class="dropdown-item mb-5 mb-lg-0" href="./404.html">
                                                404
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- / .row -->
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarBlog" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Blog
                        </a>
                        <ul class="dropdown-menu border-xl shadow-none" aria-labelledby="navbarBlog">
                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    Blog Grid
                                </a>
                                <div class="dropdown-menu border-xl shadow-none">
                                    <a class="dropdown-item" href="./blog-grid-v1.html">
                                        Grid v1
                                    </a>
                                    <a class="dropdown-item" href="./blog-grid-v2.html">
                                        Grid v2
                                    </a>
                                </div>
                            </li>
                            <li class="dropdown-item dropright">
                                <a class="dropdown-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                                    Blog List
                                </a>
                                <div class="dropdown-menu border-xl shadow-none">
                                    <a class="dropdown-item" href="./blog-list-v1.html">
                                        List v1
                                    </a>
                                    <a class="dropdown-item" href="./blog-list-v2.html">
                                        List v2
                                    </a>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="./blog-single.html">
                                    Blog Single
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarShop" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Shop
                        </a>
                        <ul class="dropdown-menu border-xl shadow-none" aria-labelledby="navbarShop">
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="./shop-cart.html">
                                    Shop Cart
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="./shop-checkout.html">
                                    Shop Checkout
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="./shop-list.html">
                                    Shop List
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="./shop-single.html">
                                    Shop Single
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a class="dropdown-link" href="./shop-order-completed.html">
                                    Shop Order Completed
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDocumentation" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Documentation
                        </a>
                        <div class="dropdown-menu border-xl shadow-none dropdown-menu-md" aria-labelledby="navbarDocumentation">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item" href="./docs/index.html">

                                    <!-- Icon -->
                                    <div class="display-4 text-primary">
                                        <i class="fas fa-clipboard"></i>
                                    </div>

                                    <!-- Content -->
                                    <div class="ms-4">

                                        <!-- Heading -->
                                        <h5 class="text-primary mb-n1">
                                            Documentation
                                        </h5>

                                        <!-- Text -->
                                        <p class="font-size-sm text-gray-700 mb-0">
                                            Customizing and building
                                        </p>

                                    </div>

                                </a>
                                <a class="list-group-item" href="./docs/alerts.html">

                                    <!-- Icon -->
                                    <div class="display-4 text-primary">
                                        <i class="fas fa-th-large"></i>
                                    </div>

                                    <!-- Content -->
                                    <div class="ms-4">

                                        <!-- Heading -->
                                        <h5 class="text-primary mb-n1">
                                            Components
                                        </h5>

                                        <!-- Text -->
                                        <p class="font-size-sm text-gray-700 mb-0">
                                            Full list of components
                                        </p>

                                    </div>

                                </a>
                                <a class="list-group-item" href="./docs/changelog.html">

                                    <!-- Icon -->
                                    <div class="display-4 text-primary">
                                        <i class="fas fa-file-alt"></i>
                                    </div>

                                    <!-- Content -->
                                    <div class="ms-4">

                                        <!-- Heading -->
                                        <h5 class="text-primary mb-n1">
                                            Changelog
                                        </h5>

                                        <!-- Text -->
                                        <p class="font-size-sm text-gray-700 mb-0">
                                            Keep track of changes
                                        </p>

                                    </div>

                                    <!-- Badge -->
                                    <span class="badge badge-pill badge-primary-soft ms-auto">
                                        1.0
                                    </span>

                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Search, Account & Cart -->
            <ul class="navbar-nav flex-row ms-auto ms-xl-0 me-n2 me-md-n4">
                <li class="nav-item border-0 px-0 d-none d-370-block d-xl-none">
                    <a class="nav-link d-flex px-3 px-md-4 search-mobile text-secondary icon-xs" data-bs-toggle="collapse" href="#collapseSearchMobile" role="button" aria-expanded="false" aria-controls="collapseSearchMobile">
                        <!-- Icon -->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z" fill="currentColor"/>
                            <path d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z" fill="currentColor"/>
                        </svg>


                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                        </svg>

                    </a>

                    <div class="collapse position-absolute right-0 left-0" id="collapseSearchMobile">
                        <div class="card card-body p-4 mt-7 shadow-dark">
                            <!-- Search -->
                            <form class="w-100">
                                <div class="input-group border rounded">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm text-secondary icon-xs d-flex align-items-center" type="submit">
                                            <!-- Icon -->
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.8477 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.8477 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.8477 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z" fill="currentColor"/>
                                                <path d="M19.762 18.6121L15.1007 13.9509C14.7831 13.6332 14.2687 13.6332 13.9511 13.9509C13.6335 14.2682 13.6335 14.7831 13.9511 15.1005L18.6124 19.7617C18.7712 19.9205 18.9791 19.9999 19.1872 19.9999C19.395 19.9999 19.6032 19.9205 19.762 19.7617C20.0796 19.4444 20.0796 18.9295 19.762 18.6121Z" fill="currentColor"/>
                                            </svg>

                                        </button>
                                    </div>
                                    <input class="form-control form-control-sm border-0 ps-0" type="search" placeholder="What do you want to learn ?" aria-label="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                </li>

                <li class="nav-item border-0 px-0">
                    <!-- Button trigger account modal -->
                    <a href="#" class="nav-link d-flex px-3 px-md-4 text-secondary icon-xs" data-bs-toggle="modal" data-bs-target="#accountModal">
                        <!-- Icon -->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.2252 3.0777C15.3376 1.10738 12.7258 -0.0045765 9.99712 0.000444175C4.48284 -0.00650109 0.00695317 4.45809 7.91636e-06 9.97242C-0.00342287 12.6991 1.1084 15.3085 3.07726 17.1948C3.08299 17.2005 3.08512 17.209 3.09082 17.2141C3.14864 17.2698 3.21148 17.3169 3.27005 17.3705C3.43071 17.5133 3.59138 17.6611 3.76061 17.7989C3.85128 17.8703 3.94554 17.9417 4.03838 18.0074C4.19833 18.1266 4.35828 18.2459 4.52535 18.3558C4.6389 18.4273 4.756 18.4986 4.87236 18.5701C5.02658 18.6629 5.18012 18.7564 5.33936 18.8414C5.47434 18.9128 5.61211 18.9742 5.74922 19.0392C5.89917 19.1106 6.04698 19.182 6.20049 19.2462C6.354 19.3105 6.50826 19.3605 6.6639 19.4162C6.81954 19.4719 6.9538 19.5233 7.10304 19.569C7.27157 19.6197 7.44436 19.6589 7.61573 19.7011C7.75853 19.736 7.89706 19.776 8.04416 19.8046C8.24123 19.8439 8.44117 19.8689 8.64112 19.896C8.76467 19.9132 8.88534 19.9374 9.01027 19.9496C9.33732 19.9817 9.66718 19.9996 9.99992 19.9996C10.3327 19.9996 10.6626 19.9817 10.9896 19.9496C11.1146 19.9374 11.2352 19.9132 11.3587 19.896C11.5587 19.8689 11.7586 19.8439 11.9557 19.8046C12.0985 19.776 12.2413 19.7332 12.3841 19.7011C12.5555 19.6589 12.7283 19.6196 12.8968 19.569C13.046 19.5233 13.1903 19.4676 13.3359 19.4162C13.4816 19.3648 13.6473 19.3091 13.7994 19.2462C13.9514 19.1834 14.1007 19.1098 14.2506 19.0392C14.3877 18.9742 14.5256 18.9128 14.6605 18.8414C14.8197 18.7564 14.9732 18.6629 15.1275 18.5701C15.2439 18.4986 15.361 18.4337 15.4745 18.3558C15.6416 18.2459 15.8016 18.1267 15.9615 18.0074C16.0543 17.936 16.1485 17.8717 16.2392 17.7989C16.4085 17.6632 16.5691 17.519 16.7298 17.3705C16.7883 17.3169 16.8512 17.2698 16.909 17.2141C16.9147 17.2091 16.9169 17.2005 16.9226 17.1948C20.9046 13.38 21.04 7.05955 17.2252 3.0777ZM15.6203 16.4472C15.4904 16.5614 15.3561 16.6699 15.2205 16.7749C15.1405 16.8363 15.0605 16.897 14.9784 16.9556C14.8491 17.0491 14.7178 17.1377 14.5842 17.2226C14.4871 17.2848 14.3879 17.3447 14.2879 17.4033C14.1622 17.4747 14.0344 17.5461 13.9051 17.6175C13.7909 17.676 13.6745 17.7311 13.5574 17.7853C13.4403 17.8396 13.3111 17.8974 13.1847 17.9481C13.0583 17.9988 12.924 18.0467 12.7919 18.0909C12.6713 18.1323 12.5506 18.1752 12.4285 18.2116C12.2857 18.2544 12.1364 18.2894 11.9886 18.3251C11.8729 18.3522 11.7587 18.383 11.6416 18.4058C11.4724 18.4387 11.2996 18.4615 11.1261 18.4851C11.0275 18.4979 10.9297 18.5158 10.8304 18.5258C10.5562 18.5522 10.2784 18.5679 9.99783 18.5679C9.71722 18.5679 9.43945 18.5522 9.16524 18.5258C9.066 18.5158 8.96818 18.4979 8.8696 18.4851C8.6961 18.4615 8.5233 18.4387 8.35406 18.4058C8.23696 18.383 8.1227 18.3523 8.00705 18.3251C7.85924 18.2894 7.71213 18.2537 7.5672 18.2116C7.44512 18.1752 7.32441 18.1323 7.20375 18.0909C7.07166 18.0452 6.93953 17.9988 6.811 17.9481C6.68248 17.8974 6.5611 17.8417 6.43826 17.7853C6.31542 17.7289 6.20476 17.6761 6.09054 17.6175C5.9613 17.5504 5.83348 17.4797 5.7078 17.4033C5.60784 17.3448 5.50856 17.2848 5.41145 17.2226C5.27794 17.1377 5.14653 17.0491 5.01729 16.9556C4.93516 16.897 4.8552 16.8363 4.77521 16.7749C4.63952 16.6699 4.5053 16.5607 4.37535 16.4472C4.34393 16.4236 4.31536 16.3936 4.28469 16.3664C4.31661 13.9374 5.87708 11.7926 8.17843 11.0146C9.32912 11.562 10.6651 11.562 11.8158 11.0146C14.1171 11.7926 15.6776 13.9374 15.7096 16.3664C15.6796 16.3936 15.651 16.4208 15.6203 16.4472ZM7.50716 5.7256C8.2803 4.3506 10.0217 3.86272 11.3967 4.63586C12.7717 5.409 13.2596 7.15038 12.4864 8.52538C12.2299 8.98159 11.8529 9.35856 11.3967 9.61511C11.3931 9.61511 11.3888 9.61511 11.3845 9.61938C11.1952 9.72477 10.9951 9.80954 10.7876 9.87217C10.7505 9.88288 10.7162 9.89715 10.6769 9.90644C10.6055 9.92501 10.5305 9.93786 10.457 9.9507C10.3185 9.97493 10.1784 9.98898 10.0378 9.99283H9.95641C9.81588 9.98898 9.67576 9.97493 9.53727 9.9507C9.46585 9.93786 9.39016 9.92501 9.31736 9.90644C9.2795 9.89715 9.24594 9.88288 9.2067 9.87217C8.99922 9.80954 8.79911 9.72481 8.60974 9.61938L8.5969 9.61511C7.2219 8.84197 6.73402 7.10059 7.50716 5.7256ZM16.9763 14.9505C16.518 12.8133 15.1107 11.0014 13.1532 10.0286C14.7534 8.28555 14.6375 5.57535 12.8944 3.97522C11.1514 2.3751 8.44117 2.49099 6.84104 4.23404C5.33677 5.8727 5.33677 8.38998 6.84104 10.0286C4.88361 11.0014 3.47624 12.8133 3.01802 14.9505C0.27991 11.0937 1.18681 5.74744 5.04365 3.00933C8.90048 0.271226 14.2467 1.17813 16.9848 5.03496C18.0141 6.48481 18.5666 8.21907 18.5658 9.99714C18.5658 11.7737 18.01 13.5057 16.9763 14.9505Z" fill="currentColor"/>
                        </svg>

                    </a>
                </li>

                <li class="nav-item border-0 px-0">
                    <!-- Button trigger cart modal -->
                    <a href="#" class="nav-link d-flex px-3 px-md-4 position-relative text-secondary icon-xs" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <span class="badge badge-primary rounded-circle fw-bold badge-float mt-n1 ms-n2 px-0 w-16" style="font-size: 8px;">2</span>
                        <!-- Icon -->
                        <svg width="13" height="15" viewBox="0 0 13 15" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.2422 3.51562H10.4567C10.2239 1.53873 8.53839 0 6.5 0C4.46161 0 2.7761 1.53873 2.54334 3.51562H0.757812C0.434199 3.51562 0.171875 3.77795 0.171875 4.10156V14.4141C0.171875 14.7377 0.434199 15 0.757812 15H12.2422C12.5658 15 12.8281 14.7377 12.8281 14.4141V4.10156C12.8281 3.77795 12.5658 3.51562 12.2422 3.51562ZM6.5 1.17188C7.89113 1.17188 9.04939 2.18716 9.27321 3.51562H3.72679C3.95062 2.18716 5.10887 1.17188 6.5 1.17188ZM11.6562 13.8281H1.34375V4.6875H2.51562V6.44531C2.51562 6.76893 2.77795 7.03125 3.10156 7.03125C3.42518 7.03125 3.6875 6.76893 3.6875 6.44531V4.6875H9.3125V6.44531C9.3125 6.76893 9.57482 7.03125 9.89844 7.03125C10.2221 7.03125 10.4844 6.76893 10.4844 6.44531V4.6875H11.6562V13.8281Z" fill="currentColor"/>
                        </svg>

                    </a>
                </li>
            </ul>

            <!-- Toggler -->
            <button class="navbar-toggler ms-4 ms-md-5 shadow-none bg-teal text-white icon-xs p-0 outline-0 h-40p w-40p d-flex d-xl-none place-flex-center" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Icon -->
                <svg width="25" height="17" viewBox="0 0 25 17" xmlns="http://www.w3.org/2000/svg">
                    <rect width="25" height="1" fill="currentColor"/>
                    <rect y="8" width="15" height="1" fill="currentColor"/>
                    <rect y="16" width="20" height="1" fill="currentColor"/>
                </svg>

            </button>
        </div>
    </header>


    <!-- HERO
    ================================================== -->
    <section class="py-4 py-md-13 position-relative bg-white">
        <!-- Cursor position parallax -->
        <div class="position-absolute right-0 left-0 top-0 bottom-0">
            <div class="cs-parallax">
                <div class="cs-parallax-layer" data-depth="0.1">
                    <img class="img-fluid" src="assets/img/parallax/layer-01.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.3">
                    <img class="img-fluid" src="assets/img/parallax/layer-02.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="assets/img/parallax/layer-03.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="assets/img/parallax/layer-04.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.4">
                    <img class="img-fluid" src="assets/img/parallax/layer-05.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.3">
                    <img class="img-fluid" src="assets/img/parallax/layer-06.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="assets/img/parallax/layer-07.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.2">
                    <img class="img-fluid" src="assets/img/parallax/layer-08.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.4">
                    <img class="img-fluid" src="assets/img/parallax/layer-09.svg" alt="Layer">
                </div>
                <div class="cs-parallax-layer" data-depth="0.3">
                    <img class="img-fluid" src="assets/img/parallax/layer-10.svg" alt="Layer">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2" data-aos="fade-in" data-aos-delay="50">

                    <!-- Image -->
                    <img src="assets/img/illustrations/illustration-1.png" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="...">

                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 px-md-0">
                    <!-- Heading -->
                    <h1 class="display-2" data-aos="fade-left" data-aos-duration="150">
                        Learn From <span class="text-orange fw-bold">Anywhere</span>
                    </h1>

                    <!-- Text -->
                    <p class="lead pe-md-8 text-capitalize" data-aos="fade-up" data-aos-duration="200">
                        Technology is bringing a massive wave of evolution on learning things in different ways.
                    </p>

                    <!-- Buttons -->
                    <a href="./course-list-v1.html" class="btn btn-wide btn-slide slide-primary shadow mb-4 mb-md-0 me-md-5" data-aos-duration="200" data-aos="fade-up">GET STARTED</a>
                    <a href="./course-list-v1.html" class="btn btn-primary btn-wide lift d-none d-lg-inline-block" data-aos-duration="200" data-aos="fade-up">VIEW COURSES</a>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <!-- FEATURED PRODUCT
    ================================================== -->
    <section class="pt-5 pb-9 py-md-11">
        <div class="container">
            <div class="row align-items-center mb-5" data-aos="fade-up">
                <div class="col-md mb-2 mb-md-0">
                    <h1 class="mb-1">Featured Courses</h1>
                    <p class="font-size-lg text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <select class="form-select form-select-sm text-primary fw-medium shadow" data-choices>
                        <option>All Subjects</option>
                        <option>Another option</option>
                        <option>Something else here</option>
                    </select>
                </div>
            </div>

            <div class="mx-n4" data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7" data-aos="fade-up" data-aos-delay="50" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-2 sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <div class="badge-float sk-fade-top top-0 right-0 mt-4 me-4">
                                <a href="./course-single-v1.html" class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 me-1 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                    <!-- Icon -->
                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.8856 8.64995C17.7248 8.42998 13.8934 3.26379 8.99991 3.26379C4.10647 3.26379 0.274852 8.42998 0.114223 8.64974C-0.0380743 8.85843 -0.0380743 9.14147 0.114223 9.35016C0.274852 9.57013 4.10647 14.7363 8.99991 14.7363C13.8934 14.7363 17.7248 9.5701 17.8856 9.35034C18.0381 9.14169 18.0381 8.85843 17.8856 8.64995ZM8.99991 13.5495C5.39537 13.5495 2.27345 10.1206 1.3493 8.99965C2.27226 7.87771 5.38764 4.4506 8.99991 4.4506C12.6043 4.4506 15.726 7.8789 16.6505 9.00046C15.7276 10.1224 12.6122 13.5495 8.99991 13.5495Z" fill="currentColor"/>
                                        <path d="M8.9999 5.43958C7.03671 5.43958 5.43945 7.03683 5.43945 9.00003C5.43945 10.9632 7.03671 12.5605 8.9999 12.5605C10.9631 12.5605 12.5603 10.9632 12.5603 9.00003C12.5603 7.03683 10.9631 5.43958 8.9999 5.43958ZM8.9999 11.3736C7.69103 11.3736 6.62629 10.3089 6.62629 9.00003C6.62629 7.6912 7.69107 6.62642 8.9999 6.62642C10.3087 6.62642 11.3735 7.6912 11.3735 9.00003C11.3735 10.3089 10.3088 11.3736 8.9999 11.3736Z" fill="currentColor"/>
                                    </svg>

                                </a>
                                <a href="./course-single-v1.html" class="btn btn-xs btn-dark text-white rounded-circle lift opacity-dot-7 p-2 d-inline-flex justify-content-center align-items-center w-36 h-36">
                                    <!-- Icon -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.2437 1.20728C10.0203 1.20728 8.87397 1.66486 7.99998 2.48357C7.12598 1.66486 5.97968 1.20728 4.7563 1.20728C2.13368 1.20728 0 3.341 0 5.96366C0 7.2555 0.425164 8.52729 1.26366 9.74361C1.91197 10.6841 2.80887 11.5931 3.92937 12.4454C5.809 13.8753 7.66475 14.6543 7.74285 14.6867L7.99806 14.7928L8.25384 14.6881C8.33199 14.6562 10.1889 13.8882 12.0696 12.4635C13.1907 11.6142 14.0881 10.7054 14.7367 9.7625C15.575 8.54385 16 7.26577 16 5.96371C16 3.341 13.8663 1.20728 11.2437 1.20728ZM8.00141 13.3353C6.74962 12.7555 1.33966 10.0142 1.33966 5.96366C1.33966 4.07969 2.87237 2.54698 4.75634 2.54698C5.827 2.54698 6.81558 3.03502 7.46862 3.88598L8.00002 4.57845L8.53142 3.88598C9.18446 3.03502 10.173 2.54698 11.2437 2.54698C13.1276 2.54698 14.6604 4.07969 14.6604 5.96366C14.6603 10.0433 9.25265 12.7613 8.00141 13.3353Z" fill="currentColor"/>
                                    </svg>

                                </a>
                            </div>

                            <a href="./course-single-v1.html" class="card-img sk-thumbnail d-block">
                                <img class="rounded shadow-light-lg" src="assets/img/products/product-1.jpg" alt="...">
                            </a>

                            <span class="badge sk-fade-bottom badge-lg badge-orange badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                <span class="text-white text-uppercase fw-bold font-size-xs">BEST SELLER</span>
                            </span>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                            <a href="./instructors-single.html" class="d-block">
                                <div class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                    <img src="assets/img/avatars/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>

                            <!-- Preheading -->
                            <a href="./course-single-v1.html"><span class="mb-1 d-inline-block text-gray-800">Photography</span></a>


                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="./course-single-v1.html" class="d-block stretched-link"><h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">Fashion Photography From Professional</h4></a>

                                <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                    <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                        <div class="rating" style="width:50%;"></div>
                                    </div>

                                    <div class="font-size-sm">
                                        <span>5.45 (5.8k+ reviews)</span>
                                    </div>
                                </div>

                                <div class="row mx-n2 align-items-end mh-50">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">5 lessons</div>
                                                </div>
                                            </li>
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                            <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">8h 12m</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-auto px-2 text-right">
                                        <del class="font-size-sm">$959</del>
                                        <ins class="h4 mb-0 d-block mb-lg-n1">$415.99</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7" data-aos="fade-up" data-aos-delay="100" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-2 sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./course-single-v1.html" class="card-img sk-thumbnail d-block">
                                <img class="rounded shadow-light-lg" src="assets/img/products/product-2.jpg" alt="...">
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                            <a href="./instructors-single.html" class="">
                                <div class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                    <img src="assets/img/avatars/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>

                            <!-- Preheading -->
                            <a href="./course-single-v1.html"><span class="mb-1 d-inline-block text-gray-800">Development</span></a>

                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="./course-single-v1.html" class="d-block stretched-link"><h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">The Complete JavaScript Course 2020: Build Real Projects!</h4></a>

                                <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                    <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                        <div class="rating" style="width:50%;"></div>
                                    </div>

                                    <div class="font-size-sm">
                                        <span>5.45 (5.8k+ reviews)</span>
                                    </div>
                                </div>

                                <div class="row mx-n2 align-items-end mh-50">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">5 lessons</div>
                                                </div>
                                            </li>
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                            <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">8h 12m</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-auto px-2 text-right">
                                        <del class="font-size-sm">$959</del>
                                        <ins class="h4 mb-0 d-block mb-lg-n1">$21.99</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7" data-aos="fade-up" data-aos-delay="150" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-2 sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="#" class="card-img sk-thumbnail d-block">
                                <img class="rounded shadow-light-lg" src="assets/img/products/product-3.jpg" alt="...">
                            </a>

                            <span class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4">
                                <span class="text-white text-uppercase fw-bold font-size-xs">Featured</span>
                            </span>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                            <a href="./instructors-single.html" class="">
                                <div class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                    <img src="assets/img/avatars/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>

                            <!-- Preheading -->
                            <a href="./course-single-v1.html"><span class="mb-1 d-inline-block text-gray-800">Photography</span></a>

                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="./course-single-v1.html" class="d-block stretched-link"><h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">Learn Figma: User Interface Design Essentials - UI/UX Design</h4></a>

                                <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                    <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                        <div class="rating" style="width:50%;"></div>
                                    </div>

                                    <div class="font-size-sm">
                                        <span>5.45 (5.8k+ reviews)</span>
                                    </div>
                                </div>

                                <div class="row mx-n2 align-items-end mh-50">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">5 lessons</div>
                                                </div>
                                            </li>
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex icon-uxs text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                            <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">8h 12m</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-auto px-2 text-right">
                                        <del class="font-size-sm">$959</del>
                                        <ins class="h4 mb-0 d-block mb-lg-n1">$129.99</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7" data-aos="fade-up" data-aos-delay="200" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-2 sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./course-single-v1.html" class="card-img sk-thumbnail d-block">
                                <img class="rounded shadow-light-lg" src="assets/img/products/product-4.jpg" alt="...">
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                            <a href="./instructors-single.html" class="">
                                <div class="avatar avatar-xl badge-float position-absolute top-0 right-0 mt-n6 me-5 rounded-circle shadow border border-white border-w-lg">
                                    <img src="assets/img/avatars/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>

                            <!-- Preheading -->
                            <a href="./course-single-v1.html"><span class="mb-1 d-inline-block text-gray-800">Photography</span></a>

                            <!-- Heading -->
                            <div class="position-relative">
                                <a href="./course-single-v1.html" class="d-block stretched-link"><h4 class="line-clamp-2 h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-2">The Complete Financial Analyst Course 2020</h4></a>

                                <div class="d-lg-flex align-items-end flex-wrap mb-n1">
                                    <div class="star-rating mb-2 mb-lg-0 me-lg-3">
                                        <div class="rating" style="width:50%;"></div>
                                    </div>

                                    <div class="font-size-sm">
                                        <span>5.45 (5.8k+ reviews)</span>
                                    </div>
                                </div>

                                <div class="row mx-n2 align-items-end mh-50">
                                    <div class="col px-2">
                                        <ul class="nav mx-n3">
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex">
                                                        <!-- Icon -->
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.1947 7.06802L14.6315 7.9985C14.2476 7.31186 13.712 6.71921 13.0544 6.25992C12.8525 6.11877 12.6421 5.99365 12.4252 5.88303C13.0586 5.25955 13.452 4.39255 13.452 3.43521C13.452 1.54098 11.9124 -1.90735e-06 10.0197 -1.90735e-06C8.12714 -1.90735e-06 6.58738 1.54098 6.58738 3.43521C6.58738 4.39255 6.98075 5.25955 7.61414 5.88303C7.39731 5.99365 7.1869 6.11877 6.98502 6.25992C6.32752 6.71921 5.79178 7.31186 5.40787 7.9985L2.8447 7.06802C2.33612 6.88339 1.79688 7.26044 1.79688 7.80243V16.5178C1.79688 16.8465 2.00256 17.14 2.31155 17.2522L9.75312 19.9536C9.93073 20.018 10.1227 20.0128 10.2863 19.9536L17.7278 17.2522C18.0368 17.14 18.2425 16.8465 18.2425 16.5178V7.80243C18.2425 7.26135 17.704 6.88309 17.1947 7.06802ZM10.0197 1.5625C11.0507 1.5625 11.8895 2.40265 11.8895 3.43521C11.8895 4.46777 11.0507 5.30792 10.0197 5.30792C8.98866 5.30792 8.14988 4.46777 8.14988 3.43521C8.14988 2.40265 8.98866 1.5625 10.0197 1.5625ZM9.23844 18.1044L3.35938 15.9703V8.91724L9.23844 11.0513V18.1044ZM10.0197 9.67255L6.90644 8.54248C7.58164 7.51892 8.75184 6.87042 10.0197 6.87042C11.2875 6.87042 12.4577 7.51892 13.1329 8.54248L10.0197 9.67255ZM16.68 15.9703L10.8009 18.1044V11.0513L16.68 8.91724V15.9703Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">5 lessons</div>
                                                </div>
                                            </li>
                                            <li class="nav-item px-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2 d-flex text-secondary">
                                                        <!-- Icon -->
                                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                            <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                        </svg>

                                                    </div>
                                                    <div class="font-size-sm">8h 12m</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-auto px-2 text-right">
                                        <del class="font-size-sm">$959</del>
                                        <ins class="h4 mb-0 d-block mb-lg-n1">$415.99</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES
    ================================================== -->
    <section class="py-5 py-md-11 bg-white">
        <div class="container">
            <div class="row align-items-end mb-md-7 mb-4" data-aos="fade-up">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Trending Categories</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                </div>
                <div class="col-md-auto">
                    <a href="./course-list-v3.html" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z" fill="currentColor"/>
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-lg-3 row-cols-xl-4">
                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-bezier-curve"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Design</h5>
                            <p class="mb-0 line-clamp-1">Over 960 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="100">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Business</h5>
                            <p class="mb-0 line-clamp-1">Over 43 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="150">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Software Development</h5>
                            <p class="mb-0 line-clamp-1">Over 1209 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="200">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Personal Development</h5>
                            <p class="mb-0 line-clamp-1">Over 921 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="250">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-camera"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Photography</h5>
                            <p class="mb-0 line-clamp-1">Over 693 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="300">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-music"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Audio + Music</h5>
                            <p class="mb-0 line-clamp-1">Over 53 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="350">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Marketing</h5>
                            <p class="mb-0 line-clamp-1">Over 12 Courses</p>
                        </div>
                    </a>
                </div>

                <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="400">
                    <!-- Card -->
                    <a href="./course-list-v3.html" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                        <!-- Image -->
                        <div class="position-relative text-light">
                            <div class="position-absolute bottom-0 right-0 left-0 icon-h-p">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <!-- Icon BG -->
                            <svg width="116" height="82" viewBox="0 0 116 82" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9238 65.8391C11.9238 65.8391 20.4749 72.4177 35.0465 70.036C49.6182 67.6542 75.9897 78.4406 75.9897 78.4406C75.9897 78.4406 90.002 85.8843 104.047 79.2427C118.093 72.6012 115.872 58.8253 115.872 58.8253C115.743 56.8104 115.606 46.9466 97.5579 22.0066C91.0438 13.0024 84.1597 6.97958 75.9458 3.74641C58.8245 -2.99096 37.7881 -0.447684 22.9067 9.81852C15.5647 14.8832 7.65514 22.0695 3.0465 31.5007C-7.27017 52.6135 11.9238 65.8391 11.9238 65.8391Z" fill="currentColor"/>
                            </svg>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-6">
                            <h5 class="mb-0 line-clamp-1">Finance & Accounting</h5>
                            <p class="mb-0 line-clamp-1">Over 322 Courses</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL
    ================================================== -->
    <section class="pt-5 pt-md-11 pb-9">
        <div class="container">
            <div class="text-center mb-2" data-aos="fade-up">
                <h1 class="mb-1">What our students have to say</h1>
                <p class="font-size-lg text-capitalize mb-0">Discover your perfect program in our courses.</p>
            </div>

            <div class="mx-n4" data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                <div class="col-12 col-md-6 col-xl-4 py-md-7 py-3" data-aos="fade-up" data-aos-delay="50" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-6 lift-md">
                        <!-- Image -->
                        <div class="card-zoom">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-custom me-5">
                                    <img src="assets/img/avatars/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <h5 class="mb-0">Albert Cole</h5>
                                    <span>Designer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0">
                            <p class="mb-0 text-capitalize">“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4 py-md-7 py-3" data-aos="fade-up" data-aos-delay="100" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-6 lift-md">
                        <!-- Image -->
                        <div class="card-zoom">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-custom me-5">
                                    <img src="assets/img/avatars/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <h5 class="mb-0">Alison Dawn</h5>
                                    <span>WordPress Developer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0">
                            <p class="mb-0 text-capitalize">“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4 py-md-7 py-3" data-aos="fade-up" data-aos-delay="150" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-6 lift-md">
                        <!-- Image -->
                        <div class="card-zoom">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-custom me-5">
                                    <img src="assets/img/avatars/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <h5 class="mb-0">Daniel Parker</h5>
                                    <span>Front-end Developer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0">
                            <p class="mb-0 text-capitalize">“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4 py-md-7 py-3" data-aos="fade-up" data-aos-delay="200" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card border shadow p-6 lift-md">
                        <!-- Image -->
                        <div class="card-zoom">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-custom me-5">
                                    <img src="assets/img/avatars/avatar-4.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <h5 class="mb-0">Albert Cole</h5>
                                    <span>Designer</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0">
                            <p class="mb-0 text-capitalize">“ I believe in lifelong learning and Skola is a great place to learn from experts. I've learned a lot and recommend it to all my friends “</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BRAND
    ================================================== -->
    <div class="py-2 pt-md-5 pb-md-10">
        <div class="container">
            <div class="row row-cols-3 row-cols-md-5 text-center w-xl-80 mx-xl-auto justify-content-center align-items-center" data-aos="fade-up">
                <div class="col-md mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="50">
                    <div class="mw-100p mx-auto">
                        <!-- Image -->
                        <svg viewBox="0 0 100 34" xmlns="http://www.w3.org/2000/svg">
                        	<path fill="#000000" d="M15,19.1c-0.1,0-0.2,0.1-0.3,0.1c-0.2,0-0.6-0.9-0.7-1.5c-0.5,0.5-1.4,1.5-3.2,1.5c-2.3,0-3.7-1.5-3.7-3.8
                        		c0-4.2,4.5-4.2,6.5-4.2v-0.8c0-1.1-0.2-1.8-1.8-1.8c-1.4,0-2.8,0.7-3.1,0.7c-0.1,0-0.2-0.1-0.2-0.2L7.9,7.7c0-0.1-0.1-0.2-0.1-0.3
                        		c0-0.6,2.5-1.2,4.4-1.2c3.1,0,4.3,1.4,4.3,4v4.7c0,2.4,0.6,2.7,0.6,3.2c0,0.1-0.1,0.2-0.2,0.2L15,19.1z M13.5,13.3
                        		c-0.6,0-3.5-0.2-3.5,2c0,1,0.7,1.7,1.6,1.7c0.9,0,1.6-0.6,1.9-0.9V13.3z M35.9,18.4c0,0.3-0.1,0.3-0.3,0.3H33
                        		c-0.3,0-0.3-0.1-0.3-0.3v-7.6c0-0.9-0.1-2.1-1-2.1c-1,0-1.9,0.7-2.2,1v8.6c0,0.3,0,0.3-0.3,0.3h-2.5c-0.3,0-0.3-0.1-0.3-0.3v-7.6
                        		c0-0.9-0.1-2.1-1-2.1c-1,0-1.9,0.7-2.2,1v8.6c0,0.3,0,0.3-0.3,0.3h-2.5c-0.3,0-0.3-0.1-0.3-0.3V11c0-3.5-0.5-3.3-0.5-3.8
                        		c0-0.1,0.1-0.2,0.3-0.3l1.9-0.6c0.1,0,0.3-0.1,0.4-0.1c0.3,0,0.5,0.5,0.8,1.7c0.7-0.6,1.8-1.7,3.8-1.7c1.1,0,2.2,0.7,2.5,1.7
                        		c0.7-0.6,1.8-1.7,3.9-1.7c2.3,0,2.9,1.7,2.9,3.9V18.4z M46.4,19.1c-0.1,0-0.2,0.1-0.3,0.1c-0.2,0-0.6-0.9-0.7-1.5
                        		c-0.5,0.5-1.4,1.5-3.2,1.5c-2.3,0-3.7-1.5-3.7-3.8c0-4.2,4.5-4.2,6.5-4.2v-0.8c0-1.1-0.2-1.8-1.8-1.8c-1.4,0-2.8,0.7-3.1,0.7
                        		c-0.1,0-0.2-0.1-0.2-0.2l-0.5-1.5c0-0.1-0.1-0.2-0.1-0.3c0-0.6,2.5-1.2,4.4-1.2c3.1,0,4.3,1.4,4.3,4v4.7c0,2.4,0.6,2.7,0.6,3.2
                        		c0,0.1-0.1,0.2-0.2,0.2L46.4,19.1z M44.9,13.3c-0.6,0-3.5-0.2-3.5,2c0,1,0.7,1.7,1.6,1.7c0.9,0,1.6-0.6,1.9-0.9V13.3z M59,18.5
                        		c-0.1,0.2-0.2,0.3-0.3,0.3h-8.3c-0.1,0-0.2-0.1-0.2-0.2v-1.8l5.7-7.5h-5c-0.1,0-0.2-0.1-0.2-0.3V7c0-0.2,0.1-0.3,0.3-0.3h7.9
                        		c0.2,0,0.4,0.1,0.4,0.2v1.9l-5.6,7.4h5.7c0.5,0,0.5,0.2,0.5,0.2c0,0.1-0.1,0.2-0.1,0.3L59,18.5z M65.9,18.4c0,0.3,0,0.3-0.3,0.3
                        		h-2.5c-0.3,0-0.3-0.1-0.3-0.3V8.9h-1.9c-0.3,0-0.3-0.1-0.3-0.3V7c0-0.3,0.1-0.3,0.3-0.3h4.7c0.3,0,0.3,0.1,0.3,0.3V18.4z M64.3,5.1
                        		c-1.1,0-2.1-0.9-2.1-2c0-1.1,0.9-2,2.1-2c1.1,0,2,0.9,2,2C66.4,4.1,65.4,5.1,64.3,5.1z M79.6,18.4c0,0.3,0,0.3-0.3,0.3h-2.5
                        		c-0.3,0-0.3-0.1-0.3-0.3v-7.6c0-0.9-0.1-2.1-1.4-2.1c-1,0-1.9,0.7-2.2,1v8.6c0,0.3,0,0.3-0.3,0.3H70c-0.3,0-0.3-0.1-0.3-0.3V11
                        		c0-3.5-0.5-3.3-0.5-3.8c0-0.1,0.1-0.2,0.3-0.3l1.9-0.6c0.1,0,0.3-0.1,0.4-0.1c0.3,0,0.5,0.5,0.8,1.7c0.7-0.6,1.8-1.7,3.8-1.7
                        		c1.4,0,3.2,0.6,3.2,3.6V18.4z M92.3,14c0,1.6,0.1,4.2,0.1,5.5c0,2.7-1.3,4.4-4.8,4.4c-1.9,0-5.2-0.8-5.2-1.3c0-0.2,0-0.3,0.1-0.5
                        		l0.5-1.5c0-0.2,0.1-0.2,0.3-0.2c0.3,0,1.8,1,4,1c1.7,0,2-0.7,2-2.1c0-0.9-0.1-1.5-0.1-1.6c-0.4,0.2-1.3,0.9-3,0.9
                        		c-2.8,0-4.3-2.3-4.3-6c0-4,1.7-6.4,4.7-6.4c1.8,0,2.5,0.8,3,1.2c0.1-0.2,0.5-1.2,0.9-1.2c0.1,0,0.2,0,0.2,0L92.8,7
                        		C92.9,7,93,7.1,93,7.2c0,0.3-0.7,1.2-0.7,3.1V14z M89.3,9.6c-0.3-0.2-0.8-0.7-2-0.7c-1.5,0-2.1,1.4-2.1,3.7c0,2.2,0.5,3.6,2,3.6
                        		c1.3,0,1.9-0.6,2.1-0.8V9.6z"/>
                        	<path fill="#FF9900" d="M74.2,25.3c-6.6,5-16.1,7.7-24.3,7.7c-11.5,0-21.8-4.4-29.7-11.7c-0.6-0.6-0.1-1.4,0.7-0.9
                        		c8.5,5.1,18.9,8.2,29.7,8.2c7.3,0,15.3-1.6,22.6-4.8C74.4,23.2,75.3,24.5,74.2,25.3 M77,22.1c-0.8-1.1-5.6-0.5-7.7-0.3
                        		c-0.6,0.1-0.7-0.5-0.2-0.9c3.8-2.7,9.9-1.9,10.6-1c0.7,0.9-0.2,7.3-3.7,10.4c-0.5,0.5-1.1,0.2-0.8-0.4C76,27.8,77.8,23.2,77,22.1"/>
                        </svg>

                    </div>
                </div>
                <div class="col-md mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="mw-100p mx-auto">
                        <!-- Image -->
                        <svg viewBox="0 0 100 34" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#FF5A5F" d="M31.5,23.4c-1-1.1-1.5-2.5-1.5-4.2c0-1.7,0.5-3.1,1.5-4.1c1-1.1,2.2-1.6,3.7-1.6c1.5,0,2.7,0.6,3.4,1.9v-1.7
                        	h2.8v11.2h-2.8V23c-0.8,1.4-2,2-3.5,2C33.7,25,32.5,24.5,31.5,23.4z M37.8,21.6c0.6-0.6,0.9-1.4,0.9-2.4s-0.3-1.8-0.9-2.4
                        	c-0.6-0.6-1.3-0.9-2-0.9c-0.8,0-1.5,0.3-2,0.9c-0.6,0.6-0.9,1.4-0.9,2.4c0,1,0.3,1.8,0.9,2.4c0.6,0.6,1.3,0.9,2,0.9
                        	C36.5,22.5,37.2,22.2,37.8,21.6z M46.3,10.7c0,0.5-0.2,0.9-0.5,1.2c-0.3,0.3-0.7,0.5-1.2,0.5c-0.5,0-0.9-0.2-1.2-0.5
                        	c-0.3-0.3-0.5-0.8-0.5-1.2s0.2-0.9,0.5-1.2C43.7,9.2,44.1,9,44.6,9c0.5,0,0.9,0.2,1.2,0.5C46.1,9.8,46.3,10.3,46.3,10.7z M43.2,24.8
                        	V13.6H46v11.2H43.2z M50.6,13.6v2c0.7-1.4,1.8-2.1,3.2-2.1v2.9h-0.7c-0.8,0-1.5,0.2-1.9,0.6s-0.6,1.2-0.6,2.2v5.6h-2.8V13.6H50.6z
                        	 M57.4,15.3c0.8-1.3,1.9-1.9,3.4-1.9c1.5,0,2.7,0.5,3.7,1.6c1,1.1,1.5,2.5,1.5,4.2c0,1.7-0.5,3.1-1.5,4.2c-1,1.1-2.2,1.6-3.7,1.6
                        	s-2.6-0.7-3.5-2v1.9h-2.8v-15h2.8V15.3z M62.3,21.6c0.6-0.6,0.9-1.4,0.9-2.4c0-1-0.3-1.8-0.9-2.4s-1.3-0.9-2-0.9
                        	c-0.8,0-1.5,0.3-2,0.9c-0.6,0.6-0.9,1.4-0.9,2.4s0.3,1.8,0.9,2.4c0.6,0.6,1.3,0.9,2,0.9C61,22.5,61.7,22.2,62.3,21.6z M67.8,23.4
                        	c-1.1-1.1-1.6-2.5-1.6-4.2c0-1.7,0.5-3.1,1.6-4.2c1.1-1.1,2.4-1.6,4-1.6s2.9,0.5,4,1.6c1.1,1.1,1.6,2.4,1.6,4.2
                        	c0,1.7-0.5,3.1-1.6,4.2c-1.1,1.1-2.4,1.6-4.1,1.6S68.9,24.5,67.8,23.4z M71.9,22.6c0.8,0,1.4-0.3,2-0.9c0.6-0.6,0.8-1.4,0.8-2.5
                        	c0-1.1-0.3-1.9-0.8-2.5c-0.6-0.6-1.2-0.9-2-0.9s-1.4,0.3-2,0.9s-0.8,1.4-0.8,2.5c0,1.1,0.3,1.9,0.8,2.5
                        	C70.4,22.3,71.1,22.6,71.9,22.6z M81.4,15.3c0.8-1.3,1.9-1.9,3.4-1.9c1.5,0,2.7,0.5,3.7,1.6c1,1.1,1.5,2.5,1.5,4.2
                        	c0,1.7-0.5,3.1-1.5,4.2c-1,1.1-2.2,1.6-3.7,1.6c-1.5,0-2.6-0.7-3.5-2v1.9h-2.8v-15h2.8V15.3z M86.3,21.6c0.6-0.6,0.9-1.4,0.9-2.4
                        	c0-1-0.3-1.8-0.9-2.4s-1.3-0.9-2-0.9c-0.8,0-1.5,0.3-2,0.9c-0.6,0.6-0.9,1.4-0.9,2.4s0.3,1.8,0.9,2.4c0.6,0.6,1.3,0.9,2,0.9
                        	C85.1,22.5,85.7,22.2,86.3,21.6z M15.5,29.8c0.1,0.1,0.3,0.2,0.5,0.2s0.4-0.1,0.5-0.2C20,26.4,26,19,26,14c0-5.5-4.5-10-10-10
                        	S6,8.5,6,14C6,19,12.1,26.4,15.5,29.8z M16,5.5c4.7,0,8.5,3.8,8.5,8.4c0,4.9-6.5,12.1-8.5,14.2c-2-2.1-8.5-9.3-8.5-14.2
                        	C7.5,9.3,11.3,5.5,16,5.5z M16.2,19.2c2.6-0.9,5.1-3.1,5.1-6.1c0-1.7-1.4-3-3.1-3c-0.9,0-1.7,0.4-2.3,1c-0.6-0.6-1.4-1-2.3-1
                        	c-1.7,0-3.1,1.4-3.1,3c0,3,2.6,5.2,5.1,6.1c0.1,0,0.2,0,0.2,0C16.1,19.3,16.2,19.3,16.2,19.2z M12.2,13.2c0-0.8,0.7-1.5,1.5-1.5
                        	c0.8,0,1.5,0.7,1.5,1.5c0,0.4,0.3,0.8,0.8,0.8c0.4,0,0.8-0.3,0.8-0.8c0-0.8,0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5
                        	c0,2.7-3,4.2-3.8,4.5C15.1,17.3,12.2,15.9,12.2,13.2L12.2,13.2z"/>
                        </svg>

                    </div>
                </div>
                <div class="col-md mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="150">
                    <div class="mw-100p mx-auto">
                        <!-- Image -->
                        <svg viewBox="0 0 100 34" xmlns="http://www.w3.org/2000/svg">
                        <g>
                        	<g>
                        		<path fill="#E43D91" d="M15.2,27c-1,0-1.8-0.9-1.6-2l2.8-16.6C16.6,7.6,17.3,7,18.1,7c1,0,1.8,0.9,1.6,2l-2.8,16.6
                        			C16.7,26.4,16,27,15.2,27L15.2,27z"/>
                        		<path fill="#E43D91" d="M15.2,25l2.8-16.6c0.1-0.5,0.4-0.9,0.8-1.2C18.7,7.1,18.4,7,18.1,7c-0.8,0-1.5,0.6-1.6,1.4L13.6,25
                        			c-0.2,1,0.6,2,1.6,2c0.3,0,0.6-0.1,0.8-0.2C15.5,26.4,15.1,25.8,15.2,25z"/>
                        	</g>
                        	<g>
                        		<path fill="#009ADD" d="M22.9,27c-1,0-1.8-0.9-1.6-2l2.8-16.6C24.3,7.6,25,7,25.8,7c1,0,1.8,0.9,1.6,2l-2.8,16.6
                        			C24.4,26.4,23.7,27,22.9,27L22.9,27z"/>
                        		<path fill="#009ADD" d="M22.9,25l2.8-16.6c0.1-0.5,0.4-0.9,0.8-1.2C26.3,7.1,26.1,7,25.8,7c-0.8,0-1.5,0.6-1.6,1.4L21.3,25
                        			c-0.2,1,0.6,2,1.6,2c0.3,0,0.6-0.1,0.8-0.2C23.1,26.5,22.8,25.8,22.9,25L22.9,25z"/>
                        	</g>
                        	<g>
                        		<path fill="#FEDE3A" d="M11.4,12.8c0.1-0.8,0.8-1.4,1.7-1.4h16.3c1,0,1.8,1,1.7,2c-0.1,0.8-0.8,1.4-1.7,1.4H13
                        			C12,14.8,11.2,13.8,11.4,12.8L11.4,12.8z"/>
                        		<path fill="#FEDE3A" d="M29.3,13.1H13c-0.6,0-1.2-0.3-1.5-0.9c-0.1,0.2-0.2,0.4-0.2,0.6c-0.2,1,0.6,2,1.7,2h16.3
                        			c0.8,0,1.5-0.6,1.7-1.4c0.1-0.4,0-0.8-0.2-1.1C30.5,12.8,29.9,13.1,29.3,13.1L29.3,13.1z"/>
                        	</g>
                        	<g>
                        		<path fill="#A2F2B3" d="M11,20.6c0.1-0.8,0.8-1.4,1.7-1.4H29c1,0,1.8,1,1.7,2c-0.1,0.8-0.8,1.4-1.7,1.4H12.7
                        			C11.6,22.6,10.8,21.7,11,20.6z"/>
                        		<path fill="#A2F2B3" d="M29,20.9H12.7c-0.6,0-1.2-0.3-1.5-0.9c-0.1,0.2-0.2,0.4-0.2,0.6c-0.2,1,0.6,2,1.7,2H29c0.8,0,1.5-0.6,1.7-1.4
                        			c0.1-0.4,0-0.8-0.2-1.1C30.1,20.6,29.6,20.9,29,20.9L29,20.9z"/>
                        	</g>
                        </g>
                        <path stroke="#000000" stroke-miterlimit="10" d="M35.5,24.8c-0.3-0.2-0.5-0.5-0.5-0.9c0-0.3,0.1-0.5,0.3-0.8c0.2-0.2,0.5-0.3,0.8-0.3c0.2,0,0.3,0,0.5,0.1
                        	c0.6,0.3,1.2,0.4,1.7,0.6c0.6,0.1,1.2,0.2,2,0.2c2,0,3-0.6,3-1.9c0-0.4-0.2-0.7-0.7-0.9c-0.5-0.2-1.2-0.5-2.3-0.7
                        	c-1.1-0.3-2-0.5-2.7-0.8c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.7-1.3-0.7-2.2c0-1.3,0.5-2.3,1.4-3.1c0.9-0.8,2.2-1.2,3.9-1.2
                        	c1.4,0,2.7,0.2,4,0.7c0.3,0.1,0.5,0.2,0.6,0.4c0.1,0.2,0.2,0.4,0.2,0.6c0,0.3-0.1,0.5-0.3,0.8c-0.2,0.2-0.5,0.3-0.8,0.3
                        	c-0.1,0-0.2,0-0.4-0.1c-1.1-0.3-2.1-0.5-3.1-0.5c-1,0-1.8,0.2-2.3,0.5c-0.6,0.3-0.8,0.8-0.8,1.4c0,0.5,0.3,0.9,0.8,1.2
                        	c0.5,0.3,1.3,0.5,2.4,0.7c1.1,0.3,1.9,0.5,2.6,0.8c0.7,0.3,1.3,0.7,1.7,1.2c0.5,0.6,0.7,1.3,0.7,2.2c0,1.1-0.5,2.1-1.4,2.8
                        	c-0.9,0.8-2.2,1.1-3.9,1.1C38.6,26,37,25.6,35.5,24.8z M47.7,25.5c-0.2-0.2-0.4-0.5-0.4-0.9V7.2c0-0.3,0.1-0.6,0.4-0.9
                        	C48,6.1,48.3,6,48.6,6c0.4,0,0.7,0.1,0.9,0.3c0.2,0.2,0.4,0.5,0.4,0.9v17.4c0,0.3-0.1,0.6-0.4,0.9c-0.2,0.2-0.5,0.3-0.9,0.3
                        	C48.3,25.9,48,25.7,47.7,25.5z M53.9,25.5c-0.7-0.3-1.2-0.8-1.6-1.4c-0.4-0.6-0.6-1.3-0.6-2.1c0-1.3,0.5-2.4,1.6-3.2
                        	c1.1-0.8,2.6-1.2,4.7-1.2h3.3v-0.2c0-1.2-0.3-2-0.9-2.6c-0.6-0.5-1.5-0.8-2.8-0.8c-0.7,0-1.3,0.1-1.8,0.2c-0.5,0.1-1.1,0.3-1.8,0.5
                        	c-0.1,0-0.3,0.1-0.4,0.1c-0.3,0-0.5-0.1-0.7-0.3c-0.2-0.2-0.3-0.4-0.3-0.7c0-0.5,0.2-0.8,0.7-1c1.5-0.6,3.1-1,4.7-1
                        	c1.3,0,2.3,0.3,3.2,0.8c0.9,0.5,1.5,1.2,1.9,1.9c0.4,0.8,0.6,1.7,0.6,2.6v7.6c0,0.3-0.1,0.6-0.4,0.9c-0.2,0.2-0.5,0.3-0.9,0.3
                        	c-0.3,0-0.6-0.1-0.9-0.3c-0.2-0.2-0.4-0.5-0.4-0.9V24c-1.3,1.4-3.1,2-5.1,2C55.3,26,54.5,25.8,53.9,25.5z M59.3,23.3
                        	c0.7-0.4,1.4-0.9,1.9-1.4v-2.3h-3c-2.7,0-4.1,0.7-4.1,2.1c0,0.6,0.2,1.2,0.7,1.6c0.4,0.4,1.2,0.6,2.2,0.6
                        	C57.8,23.9,58.6,23.7,59.3,23.3z M68.7,25.1c-1.1-0.6-1.9-1.4-2.4-2.5c-0.6-1.1-0.9-2.3-0.9-3.7c0-1.4,0.3-2.6,0.9-3.7
                        	c0.6-1.1,1.4-1.9,2.4-2.5c1.1-0.6,2.3-0.9,3.7-0.9c1.4,0,2.6,0.3,3.7,0.9c1.1,0.6,1.9,1.4,2.5,2.5c0.6,1.1,0.9,2.3,0.9,3.7
                        	c0,1.4-0.3,2.6-0.9,3.7c-0.6,1.1-1.4,1.9-2.5,2.5S73.8,26,72.4,26C71,26,69.7,25.7,68.7,25.1z M74.5,23.3c0.7-0.3,1.2-0.9,1.7-1.6
                        	c0.4-0.7,0.7-1.7,0.7-2.8c0-1.1-0.2-2-0.7-2.8c-0.4-0.7-1-1.3-1.7-1.6c-0.7-0.3-1.4-0.5-2.1-0.5c-0.8,0-1.5,0.2-2.2,0.5
                        	c-0.7,0.3-1.2,0.9-1.7,1.6c-0.4,0.7-0.7,1.7-0.7,2.8c0,1.1,0.2,2.1,0.7,2.8c0.4,0.7,1,1.3,1.7,1.6c0.7,0.3,1.4,0.5,2.2,0.5
                        	C73.1,23.8,73.8,23.6,74.5,23.3z M81.5,25.5c-0.2-0.2-0.4-0.5-0.4-0.9V7.2c0-0.3,0.1-0.6,0.4-0.9C81.8,6.1,82.1,6,82.4,6
                        	s0.6,0.1,0.9,0.4c0.2,0.2,0.4,0.5,0.4,0.9v11l6.5-5.9c0.3-0.2,0.5-0.3,0.8-0.3c0.4,0,0.7,0.1,0.9,0.3c0.2,0.2,0.3,0.5,0.3,0.8
                        	c0,0.3-0.2,0.6-0.5,0.9l-3.9,3.5l4.9,6.4c0.2,0.2,0.3,0.5,0.3,0.7c0,0.4-0.1,0.6-0.4,0.9c-0.2,0.2-0.5,0.3-0.9,0.3
                        	c-0.2,0-0.4,0-0.5-0.1c-0.2-0.1-0.3-0.2-0.5-0.4L86,19.1l-2.4,2.1v3.5c0,0.3-0.1,0.6-0.4,0.9c-0.2,0.2-0.5,0.3-0.9,0.3
                        	S81.8,25.7,81.5,25.5z"/>
                        </svg>

                    </div>
                </div>
                <div class="col-md mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="mw-100p mx-auto">
                        <!-- Image -->
                        <svg viewBox="0 0 100 34" xmlns="http://www.w3.org/2000/svg">
                        	<path fill="#0096DA" d="M20.2,7h-6.6v7H9.6v3.6h3.9v7.7h4.7v-7.7h0.6h1.3c3.7,0,5.8-2,5.8-5.5C26,8.9,23.9,7,20.2,7z M20,14h-1.1 h-0.6v-3.4H20c1,0,1.6,0.6,1.6,1.7C21.6,13.4,21,14,20,14z"/>
                        	<polygon fill="#002B86" points="13.6,14 13.6,7 11.9,8.7 11.9,14"/>
                        	<path fill="#002B86" d="M20,14c1,0,1.6-0.6,1.6-1.7c0-1.1-0.6-1.7-1.6-1.7h-1.7v1.7h0.1C19.3,12.3,19.9,12.9,20,14C19.9,14,19.9,14,20,14L20,14z"/>
                        	<path fill="#002B86" d="M20.2,17.6h-1.3h-0.6v1.7h0.3c2,0,3.6-0.7,4.7-1.7c0.5-0.5,1.1-1.1,1.6-1.8C23.9,17,22.3,17.6,20.2,17.6z"/>
                        	<polygon fill="#002B86" points="13.6,17.6 9.6,17.6 9.6,14 8,15.7 8,19.3 11.9,19.3 11.9,27 16.6,27 18.3,25.3 13.6,25.3"/>
                        	<path fill="#002B86" stroke="#002B86" stroke-miterlimit="#002B86" d="M32,7h3.3c1.5,0,2.6,0.2,3.3,0.7c0.6,0.4,1.1,0.9,1.5,1.6c0.4,0.7,0.5,1.5,0.5,2.3c0,1.2-0.3,2.2-1,3.1 c-1,1.3-2.5,2-4.7,2h-1.8l-0.8,6.6H30L32,7z M34.2,9.2l-0.7,5.3h1.6c1,0,1.8-0.3,2.3-0.8c0.5-0.5,0.8-1.2,0.8-2.2 c0-1.6-1-2.3-3-2.3H34.2z"/>
                        	<path fill="#002B86" stroke="#002B86" stroke-miterlimit="#002B86" d="M51.4,13.4l-1.2,9.9h-2.4l0.1-1.1c-1,0.9-2.1,1.3-3.1,1.3c-1.3,0-2.4-0.4-3.3-1.3c-0.8-0.9-1.3-2.1-1.3-3.5 c0-1.6,0.5-3,1.4-4c1-1,2.2-1.6,3.8-1.6c0.7,0,1.3,0.1,1.8,0.3c0.5,0.2,1,0.6,1.6,1.2l0.2-1.3H51.4z M48.5,18 c0-0.9-0.3-1.6-0.8-2.1c-0.5-0.6-1.2-0.8-2-0.8c-0.9,0-1.6,0.3-2.2,1c-0.6,0.7-0.9,1.5-0.9,2.5c0,0.9,0.2,1.6,0.7,2.1 c0.5,0.6,1.1,0.8,1.9,0.8c0.9,0,1.6-0.3,2.3-1C48.2,19.9,48.5,19,48.5,18z"/>
                        	<path fill="#002B86" stroke="#002B86" stroke-miterlimit="#002B86" d="M63.5,13.4L54.4,29h-2.7l4.1-6.9l-3.6-8.7h2.5l2.5,6.4l3.6-6.4H63.5z"/>
                        	<path fill="#0096DA" stroke="#0096DA" stroke-miterlimit="#0096DA" d="M67.4,7h3.3c1.5,0,2.6,0.2,3.3,0.7c0.6,0.4,1.1,0.9,1.5,1.6c0.4,0.7,0.5,1.5,0.5,2.3c0,1.2-0.3,2.2-1,3.1 c-1,1.3-2.5,2-4.7,2h-1.8l-0.8,6.6h-2.4L67.4,7z M69.5,9.2l-0.7,5.3h1.6c1,0,1.8-0.3,2.3-0.8c0.5-0.5,0.8-1.2,0.8-2.2 c0-1.6-1-2.3-3-2.3H69.5z"/>
                        	<path fill="#0096DA" stroke="#0096DA" stroke-miterlimit="#0096DA" d="M86.7,13.4l-1.2,9.9h-2.4l0.1-1.1c-1,0.9-2.1,1.3-3.1,1.3c-1.3,0-2.4-0.4-3.3-1.3c-0.8-0.9-1.3-2.1-1.3-3.5 c0-1.6,0.5-3,1.4-4c1-1,2.2-1.6,3.8-1.6c0.7,0,1.3,0.1,1.8,0.3c0.5,0.2,1,0.6,1.6,1.2l0.2-1.3H86.7z M83.8,18 c0-0.9-0.3-1.6-0.8-2.1c-0.5-0.6-1.2-0.8-2-0.8c-0.9,0-1.6,0.3-2.2,1c-0.6,0.7-0.9,1.5-0.9,2.5c0,0.9,0.2,1.6,0.7,2.1 c0.5,0.6,1.1,0.8,1.9,0.8c0.9,0,1.6-0.3,2.3-1C83.5,19.9,83.8,19,83.8,18z"/>
                        	<path fill="#0096DA" stroke="#0096DA" stroke-miterlimit="#0096DA" d="M91.3,13.4L90,23.3h-2.4l1.2-9.9H91.3z M92,8.6c0,0.3-0.1,0.6-0.4,0.9c-0.2,0.2-0.5,0.4-0.9,0.4 c-0.3,0-0.7-0.1-0.9-0.4c-0.2-0.3-0.4-0.6-0.4-0.9c0-0.3,0.1-0.6,0.4-0.9c0.2-0.2,0.5-0.4,0.9-0.4c0.3,0,0.7,0.1,0.9,0.4 C91.9,8,92,8.3,92,8.6z"/>
                        </svg>

                    </div>
                </div>
                <div class="col-md mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="250">
                    <div class="mw-100p mx-auto">
                        <!-- Image -->
                        <svg viewBox="0 0 100 34" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#1DD05D" d="M29.3,17c0,6.6-5.4,12-12.1,12C10.4,29,5,23.6,5,17c0-6.6,5.4-12,12.1-12C23.8,5,29.3,10.4,29.3,17z M17.1,11.5
                        	c-3.2,0-6.1,1.5-7.9,3.9l1.1,1.1c1.5-2.1,4-3.4,6.8-3.4c2.8,0,5.3,1.4,6.8,3.4l1.1-1.1C23.2,13,20.4,11.5,17.1,11.5z M17.1,14.1
                        	c-2.6,0-4.9,1.3-6.3,3.2l1.1,1.1c1.1-1.7,3-2.8,5.2-2.8c2.2,0,4.1,1.1,5.2,2.8l1.1-1.1C22,15.4,19.7,14.1,17.1,14.1z M17.1,16.8
                        	c-1.8,0-3.4,1-4.3,2.5l1.1,1.1c0.5-1.2,1.7-2.1,3.1-2.1c1.4,0,2.6,0.9,3.1,2.1l1.1-1.1C20.6,17.8,19,16.8,17.1,16.8z M17.1,22.8
                        	l1.9-1.9c-0.5-0.5-1.2-0.8-1.9-0.8c-0.8,0-1.4,0.3-1.9,0.8L17.1,22.8z M39.1,24.2c2.9,0,4.9-1.5,4.9-4v0c0-2.2-1.5-3.2-4.4-3.9
                        	c-2.6-0.6-3.2-1.1-3.2-2.1v0c0-0.9,0.8-1.6,2.2-1.6c1.1,0,2.1,0.3,3.1,1c0.2,0.1,0.4,0.2,0.6,0.2c0.6,0,1.1-0.5,1.1-1.1
                        	c0-0.5-0.3-0.8-0.5-0.9c-1.2-0.8-2.6-1.2-4.3-1.2c-2.7,0-4.6,1.6-4.6,3.9v0c0,2.5,1.6,3.3,4.5,4c2.5,0.6,3.1,1.1,3.1,2.1v0
                        	c0,1-0.9,1.7-2.4,1.7c-1.5,0-2.7-0.5-3.8-1.4c-0.2-0.1-0.4-0.2-0.7-0.2c-0.6,0-1.1,0.5-1.1,1.1c0,0.4,0.2,0.7,0.5,0.9
                        	C35.5,23.7,37.2,24.2,39.1,24.2z M45.5,26.1c0,0.7,0.5,1.2,1.2,1.2c0.7,0,1.2-0.5,1.2-1.2v-3.6c0.7,0.9,1.8,1.8,3.5,1.8
                        	c2.4,0,4.8-1.9,4.8-5.3v0c0-3.4-2.4-5.3-4.8-5.3c-1.7,0-2.7,0.8-3.5,1.9V15c0-0.7-0.5-1.2-1.2-1.2c-0.7,0-1.2,0.5-1.2,1.2V26.1z
                        	 M50.8,22.2c-1.6,0-3-1.3-3-3.2v0c0-1.9,1.4-3.2,3-3.2s2.9,1.3,2.9,3.2v0C53.7,21,52.4,22.2,50.8,22.2z M60.5,24.3
                        	c1.6,0,2.6-0.7,3.3-1.5v0.4c0,0.5,0.5,1,1.1,1c0.6,0,1.1-0.5,1.1-1.1v-5c0-1.3-0.3-2.4-1.1-3.1c-0.7-0.7-1.9-1.1-3.4-1.1
                        	c-1.3,0-2.3,0.2-3.3,0.6c-0.3,0.1-0.6,0.5-0.6,0.9c0,0.5,0.4,1,1,1c0.1,0,0.2,0,0.4-0.1c0.6-0.2,1.4-0.4,2.3-0.4
                        	c1.7,0,2.5,0.8,2.5,2.2v0.2c-0.8-0.2-1.6-0.4-2.8-0.4c-2.5,0-4.2,1.1-4.2,3.3v0C56.9,23.2,58.6,24.3,60.5,24.3z M61.2,22.6
                        	c-1.1,0-2-0.6-2-1.5v0c0-1.1,0.9-1.7,2.4-1.7c0.9,0,1.7,0.2,2.3,0.4v0.7C63.9,21.7,62.7,22.6,61.2,22.6z M71.3,24.2
                        	c0.6,0,1.1-0.1,1.6-0.3c0.3-0.1,0.6-0.5,0.6-0.9c0-0.5-0.5-1-1-1c-0.1,0-0.3,0.1-0.6,0.1c-0.8,0-1.3-0.4-1.3-1.3v-5h1.8
                        	c0.6,0,1-0.4,1-1c0-0.6-0.5-1-1-1h-1.8v-1.7c0-0.6-0.5-1.2-1.2-1.2c-0.7,0-1.2,0.5-1.2,1.2v1.7H68c-0.6,0-1,0.4-1,1c0,0.6,0.4,1,1,1
                        	h0.4v5.3C68.4,23.5,69.6,24.2,71.3,24.2z M74.9,11.3c0,0.7,0.6,1.2,1.3,1.2c0.8,0,1.3-0.5,1.3-1.2v-0.1c0-0.7-0.6-1.1-1.3-1.1
                        	c-0.8,0-1.3,0.4-1.3,1.1V11.3z M75,23c0,0.7,0.5,1.2,1.2,1.2c0.7,0,1.2-0.5,1.2-1.2v-8c0-0.7-0.5-1.2-1.2-1.2S75,14.3,75,15V23z
                        	 M80,23c0,0.6,0.5,1.2,1.2,1.2c0.7,0,1.2-0.5,1.2-1.2v-7.1h1.8c0.5,0,1-0.4,1-1s-0.4-1-1-1h-1.8v-0.6c0-1.1,0.5-1.5,1.4-1.5
                        	c0.2,0,0.3,0,0.5,0c0.5,0,1-0.4,1-1c0-0.5-0.4-0.9-0.8-1C84,10,83.6,9.9,83.2,9.9c-1,0-1.8,0.3-2.3,0.8c-0.5,0.5-0.8,1.4-0.8,2.5V14
                        	h-0.4c-0.5,0-1,0.4-1,1s0.4,1,1,1H80V23z M87.7,27.2c1.7,0,2.6-0.8,3.5-2.8l3.8-8.9c0-0.1,0.1-0.4,0.1-0.6c0-0.6-0.5-1.1-1.1-1.1
                        	c-0.6,0-0.9,0.4-1.1,0.9l-2.6,6.7l-2.8-6.7c-0.2-0.5-0.5-0.9-1.1-0.9c-0.7,0-1.2,0.5-1.2,1.1c0,0.2,0.1,0.4,0.1,0.6l3.8,8.4L89,24.1
                        	c-0.4,0.8-0.8,1.1-1.5,1.1c-0.3,0-0.5-0.1-0.8-0.1c-0.1,0-0.2-0.1-0.4-0.1c-0.5,0-1,0.4-1,1c0,0.6,0.4,0.8,0.7,1
                        	C86.5,27.1,87,27.2,87.7,27.2z"/>
                        </svg>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EVENTS
    ================================================== -->
    <section class="bg-white py-5 pt-md-11 pb-md-10">
        <div class="container">
            <div class="row align-items-end mb-4 mb-md-7">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Upcoming Events</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <a href="./event-list.html" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z" fill="currentColor"/>
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-lg-2">
                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="./event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="assets/img/events/event-1.jpg" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="./event-single.html" class="d-block mb-2"><h5 class="line-clamp-2 h-xl-52 mb-1">Elegant Light Box Paper Cut Dioramas New Design Conference</h5></a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z" fill="currentColor"/>
                                                        <path d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="./event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="assets/img/events/event-2.jpg" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="./event-single.html" class="d-block mb-2"><h5 class="line-clamp-2 h-xl-52 mb-1">Lambeth Safeguarding: Understanding Contextual Harm</h5></a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z" fill="currentColor"/>
                                                        <path d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="./event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="assets/img/events/event-3.jpg" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="./event-single.html" class="d-block mb-2"><h5 class="line-clamp-2 h-xl-52 mb-1">Discover Law - Get into the best UK law schools</h5></a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z" fill="currentColor"/>
                                                        <path d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="./event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="assets/img/events/event-4.jpg" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="./event-single.html" class="d-block mb-2"><h5 class="line-clamp-2 h-xl-52 mb-1">Undergraduate Open Day – Holloway Campus - 3 July 2020</h5></a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z" fill="currentColor"/>
                                                        <path d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="./event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="assets/img/events/event-5.jpg" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="./event-single.html" class="d-block mb-2"><h5 class="line-clamp-2 h-xl-52 mb-1">"Introduction to Law" Open Day with Bristows</h5></a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z" fill="currentColor"/>
                                                        <path d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="./event-single.html" class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="assets/img/events/event-6.jpg" alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="./event-single.html" class="d-block mb-2"><h5 class="line-clamp-2 h-xl-52 mb-1">Kingston College undergraduate Open Events 2019-20</h5></a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z" fill="currentColor"/>
                                                        <path d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z" fill="currentColor"/>
                                                        <path d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z" fill="currentColor"/>
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INSTRUCTORS
    ================================================== -->
    <section class="py-5 py-md-11">
        <div class="container">
            <div class="row align-items-end mb-3 mb-md-5" data-aos="fade-up">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Top Rating Instructors</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <a href="./instructors-list-v1.html" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z" fill="currentColor"/>
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="mx-n3 mx-md-n4" data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="./instructors-single.html" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img class="rounded shadow-light-lg img-fluid" src="assets/img/instructors/instructor-1.jpg" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="./instructors-single.html" class="d-block"><h5 class="mb-0">Jack Wilson</h5></a>
                            <span class="font-size-d-sm">Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="./instructors-single.html" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img class="rounded shadow-light-lg img-fluid" src="assets/img/instructors/instructor-2.jpg" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="./instructors-single.html" class="d-block"><h5 class="mb-0">Anna Richard</h5></a>
                            <span class="font-size-d-sm">Travel Bloger</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="./instructors-single.html" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img class="rounded shadow-light-lg img-fluid" src="assets/img/instructors/instructor-3.jpg" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="./instructors-single.html" class="d-block"><h5 class="mb-0">Kathelen Monero</h5></a>
                            <span class="font-size-d-sm">Designer</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="./instructors-single.html" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img class="rounded shadow-light-lg img-fluid" src="assets/img/instructors/instructor-4.jpg" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="./instructors-single.html" class="d-block"><h5 class="mb-0">Kristen Pala</h5></a>
                            <span class="font-size-d-sm">User Experience Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="./instructors-single.html" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img class="rounded shadow-light-lg img-fluid" src="assets/img/instructors/instructor-2.jpg" alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="./instructors-single.html" class="d-block"><h5 class="mb-0">Anna Richard</h5></a>
                            <span class="font-size-d-sm">Travel Bloger</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG
    ================================================== -->
    <section class="bg-white py-5 py-md-11">
        <div class="container">
            <div class="row align-items-end mb-4 mb-md-7" data-aos="fade-up">
                <div class="col-md mb-4 mb-md-0">
                    <h1 class="mb-1">Latest News</h1>
                    <p class="font-size-lg mb-0 text-capitalize">Discover your perfect program in our courses.</p>
                </div>
                <div class="col-md-auto">
                    <a href="./blog-grid-v1.html" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z" fill="currentColor"/>
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-md-2 row-cols-lg-3">
                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./blog-single.html" class="card-img d-block sk-thumbnail img-ratio-3"><img class="rounded shadow-light-lg img-fluid" src="assets/img/post/post-1.jpg" alt="..."></a>

                            <a href="./blog-single.html" class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">Figma</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="./blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z" fill="currentColor"/>
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">Jack Wilson</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="./blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z" fill="currentColor"/>
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">06 April, 2020</div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="./blog-single.html" class="d-block"><h5 class="line-clamp-2 h-48 h-lg-52">The Best Destinations to Begin Your Round the World Trip</h5></a>
                        </div>
                    </div>
                </div>

                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./blog-single.html" class="card-img d-block sk-thumbnail img-ratio-3"><img class="rounded shadow-light-lg img-fluid" src="assets/img/post/post-2.jpg" alt="..."></a>

                            <a href="./blog-single.html" class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">Adobe XD</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="./blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z" fill="currentColor"/>
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">Jack Wilson</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="./blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z" fill="currentColor"/>
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">06 April, 2020</div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="./blog-single.html" class="d-block"><h5 class="line-clamp-2 h-48 h-lg-52">An Indigenous Anatolian Syllabic Script From 3500 Years Ago</h5></a>
                        </div>
                    </div>
                </div>

                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="./blog-single.html" class="card-img d-block sk-thumbnail img-ratio-3"><img class="rounded shadow-light-lg img-fluid" src="assets/img/post/post-3.jpg" alt="..."></a>

                            <a href="./blog-single.html" class="badge badge-lg sk-fade-bottom badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">Photoshop</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="./blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z" fill="currentColor"/>
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">Jack Wilson</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="./blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z" fill="currentColor"/>
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">06 April, 2020</div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="./blog-single.html" class="d-block"><h5 class="line-clamp-2 h-48 h-lg-52">10 Best Countries to Visit for Beginner Travelers</h5></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL ACTION
    ================================================== -->
    <section class="py-6 py-md-11 border-top border-bottom jarallax" data-jarallax data-speed=".8" style="background-image: url(assets/img/illustrations/illustration-1.jpg)">
        <div class="container text-center py-xl-4" data-aos="fade-up">
            <h1 class="text-capitalize">Get personal learning recommendations</h1>
            <div class="font-size-lg mb-md-6 mb-4">Enhance your skills with best Online courses</div>
            <div class="mx-auto">
                <a href="./course-list-v1.html" class="btn btn-primary btn-x-wide lift d-inline-block">GET STARTED NOW</a>
            </div>
        </div>
    </section>

    <!-- FOOTER
    ================================================== -->
    <footer class="pt-8 pt-md-11 bg-white">
        <div class="container">
            <div class="row" id="accordionFooter">
                <div class="col-12 col-md-4 col-lg-4">

                    <!-- Brand -->
                    <img src="./assets/img/brand.svg" alt="..." class="footer-brand img-fluid mb-4 h-60p">

                    <!-- Text -->
                    <p class="text-gray-800 mb-4 font-size-sm-alone">
                        329 Queensberry Street, North Melbourne VIC 3051, Australia.
                    </p>

                    <div class="mb-4">
                        <a href="tel:1234567890" class="text-gray-800 font-size-sm-alone">123 456 7890</a>
                    </div>

                    <div class="mb-4">
                        <a href="mailto:support@skola.com" class="text-gray-800 font-size-sm-alone">support@skola.com</a>
                    </div>

                    <!-- Social -->
                    <ul class="list-unstyled list-inline list-social mb-4 mb-md-0">
                        <li class="list-inline-item list-social-item">
                            <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item">
                            <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item">
                            <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="list-inline-item list-social-item">
                            <a href="#" class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-md-4 col-lg-2">
                    <div class="mb-5 mb-xl-0 footer-accordion">

                        <!-- Heading -->
                        <div id="widgetOne">
                            <h5 class="mb-5">
                                <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseOne" aria-expanded="true" aria-controls="widgetcollapseOne">
                                    Our Company
                                    <span class="ms-auto text-dark">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor"/>
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor"/>
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </button>
                            </h5>
                        </div>

                        <div id="widgetcollapseOne" class="collapse show" aria-labelledby="widgetOne" data-parent="#accordionFooter">
                            <!-- List -->
                            <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-6 mb-md-8 mb-lg-0">
                                <li class="mb-3">
                                    <a href="./about-v1.html" class="text-reset">
                                        Our Company
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./about-v2.html" class="text-reset">
                                        About Us
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./contact-us.html" class="text-reset">
                                        Contact Us
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./contact-us.html" class="text-reset">
                                        Community
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v1.html" class="text-reset">
                                        Student Perks
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./blog-grid-v1.html" class="text-reset">
                                        Blog
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./pricing.html" class="text-reset">
                                        Affiliate Program
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./contact-us.html" class="text-reset">
                                        Careers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-2">
                    <div class="mb-5 mb-xl-0 ms-xl-6 footer-accordion">

                        <!-- Heading -->
                        <div id="widgetTwo">
                            <h5 class="mb-5">
                                <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseTwo" aria-expanded="false" aria-controls="widgetcollapseTwo">
                                    Topics
                                    <span class="ms-auto text-dark">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor"/>
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor"/>
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </button>
                            </h5>
                        </div>

                        <div id="widgetcollapseTwo" class="collapse" aria-labelledby="widgetTwo" data-parent="#accordionFooter">
                            <!-- List -->
                            <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-6 mb-md-8 mb-lg-0">
                                <li class="mb-3">
                                    <a href="./course-list-v2.html" class="text-reset">
                                        HTML
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v2.html" class="text-reset">
                                        CSS
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v6.html" class="text-reset">
                                        Design
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v5.html" class="text-reset">
                                        JavaScript
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v4.html" class="text-reset">
                                        Ruby
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v1.html" class="text-reset">
                                        PHP
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v3.html" class="text-reset">
                                        Android
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v4.html" class="text-reset">
                                        Development Tools
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./course-list-v6.html" class="text-reset">
                                        Business
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 offset-md-4 col-lg-2 offset-lg-0">
                    <div class="mb-5 mb-xl-0 ms-xl-6 footer-accordion">

                        <!-- Heading -->
                        <div id="widgetThree">
                            <h5 class="mb-5">
                                <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseThree" aria-expanded="false" aria-controls="widgetcollapseThree">
                                    Tracks
                                    <span class="ms-auto text-dark">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor"/>
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor"/>
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </button>
                            </h5>
                        </div>

                        <div id="widgetcollapseThree" class="collapse" aria-labelledby="widgetThree" data-parent="#accordionFooter">
                            <!-- List -->
                            <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-0">
                                <li class="mb-3">
                                    <a href="./lesson-single-v1.html" class="text-reset">
                                        Web Design
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./lesson-single-v2.html" class="text-reset">
                                        Web Development
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./lesson-single-v1.html" class="text-reset">
                                        Rails Development
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./lesson-single-v2.html" class="text-reset">
                                        PHP Development
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./lesson-single-v1.html" class="text-reset">
                                        Android Development
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./lesson-single-v2.html" class="text-reset">
                                        Starting a Business
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-2 d-xl-flex">
                    <div class="mb-5 mb-xl-0 ms-xl-auto footer-accordion">

                        <!-- Heading -->
                        <div id="widgetFour">
                            <h5 class="mb-5">
                                <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseFour" aria-expanded="false" aria-controls="widgetcollapseFour">
                                    Support
                                    <span class="ms-auto text-dark">
                                        <!-- Icon -->
                                        <svg width="15" height="2" viewBox="0 0 15 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="15" height="2" fill="currentColor"/>
                                        </svg>

                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 7H15V9H0V7Z" fill="currentColor"/>
                                            <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </button>
                            </h5>
                        </div>

                        <div id="widgetcollapseFour" class="collapse" aria-labelledby="widgetFour" data-parent="#accordionFooter">
                            <!-- List -->
                            <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-0">
                                <li class="mb-3">
                                    <a href="./docs/index.html" class="text-reset">
                                        Documentation
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./docs/index.html" class="text-reset">
                                        Forums
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./docs/index.html" class="text-reset">
                                        Language Packs
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="./docs/changelog.html" class="text-reset">
                                        Release Status
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-md-5">
                    <div class="border-top pb-5 pt-6 py-md-4 text-center text-xl-start d-flex flex-column d-md-block d-xl-flex flex-xl-row align-items-center">
                        <p class="text-gray-800 font-size-sm-alone d-block mb-0 mb-md-2 mb-xl-0 order-1 order-md-0 px-9 px-md-0">Copyright © 2021 CreativeLayers. All Right Reserved.</p>

                        <div class="ms-xl-auto d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center">
                            <ul class="navbar-nav flex-row flex-wrap font-size-sm-alone mb-3 mb-md-0 mx-n4 me-md-5 justify-content-center justify-content-lg-start order-1 order-md-0">
                                <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                    <a href="./index.html" class="nav-link px-4 fw-normal text-gray-800">Home</a>
                                </li>
                                <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                    <a href="./terms-of-service.html" class="nav-link px-4 fw-normal text-gray-800">Site Map</a>
                                </li>
                                <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                    <a href="./terms-of-service.html" class="nav-link px-4 fw-normal text-gray-800">Privacy policy</a>
                                </li>
                                <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                    <a href="./terms-of-service.html" class="nav-link px-4 fw-normal text-gray-800">Web Use Policy</a>
                                </li>
                                <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                    <a href="./terms-of-service.html" class="nav-link px-4 fw-normal text-gray-800">Cookie Policy</a>
                                </li>
                            </ul>

                            <select class="form-select form-select-sm font-size-sm-alone shadow min-width-140 text-left mb-4 mb-md-0" data-choices>
                                <option>English</option>
                                <option>Tamil</option>
                                <option>French</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </footer>


    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="./assets/libs/aos/dist/aos.js"></script>
    <script src="./assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="./assets/libs/countup.js/dist/countUp.min.js"></script>
    <script src="./assets/libs/dropzone/dist/min/dropzone.min.js"></script>
    <script src="./assets/libs/flickity/dist/flickity.pkgd.min.js"></script>
    <script src="./assets/libs/flickity-fade/flickity-fade.js"></script>
    <script src="./assets/libs/highlightjs/highlight.pack.min.js"></script>
    <script src="./assets/libs/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="./assets/libs/isotope-layout/dist/isotope.pkgd.min.js"></script>
    <script src="./assets/libs/jarallax/dist/jarallax.min.js"></script>
    <script src="./assets/libs/jarallax/dist/jarallax-video.min.js"></script>
    <script src="./assets/libs/jarallax/dist/jarallax-element.min.js"></script>
    <script src="./assets/libs/parallax-js/dist/parallax.min.js"></script>
    <script src="./assets/libs/quill/dist/quill.min.js"></script>
    <script src="./assets/libs/smooth-scroll/dist/smooth-scroll.min.js"></script>
    <script src="./assets/libs/typed.js/lib/typed.min.js"></script>

    <!-- Map -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Theme JS -->
    <script src="./assets/js/theme.min.js"></script>


</body>
</html>
