<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
    <link href="favicon.png" rel="shortcut icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('front/css/sbmenu.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/theme.css')}}">
    <title>Login Page</title>

</head>
<body>
  

    <!-- ly-register-section-start -->
    <section class="ly-register-section">
            @if (Session::has('error'))
                <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                    <strong>Error:</strong>{{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <script>
                    // Automatically close the error message after 5000 milliseconds (5 seconds)
                    setTimeout(function () {
                        document.getElementById('error-message').style.display = 'none';
                    }, 5000);
                </script>
                @endif
                @if (Session::has('success_message'))
                <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; top: 10px; right: 10px; width: 500px; z-index: 999;">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <script>
                    // Automatically close the error message after 5000 milliseconds (5 seconds)
                    setTimeout(function () {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000);
                </script>
                @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="main-img-box">
                                    <img src="{{asset('front/images/banner_images/login.png')}}" alt="main-img">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="ly-form-area">
                                    <h3 class="title">Welcome Back!</h3>
                                    <p class="desc">Welcome back, please enter your details.</p>
                                    <div class="social-login-box">
                                        <a href="{{ url('auth/google') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 128 128"><path fill="#fff" d="M44.59 4.21a63.28 63.28 0 0 0 4.33 120.9a67.6 67.6 0 0 0 32.36.35a57.13 57.13 0 0 0 25.9-13.46a57.44 57.44 0 0 0 16-26.26a74.33 74.33 0 0 0 1.61-33.58H65.27v24.69h34.47a29.72 29.72 0 0 1-12.66 19.52a36.16 36.16 0 0 1-13.93 5.5a41.29 41.29 0 0 1-15.1 0A37.16 37.16 0 0 1 44 95.74a39.3 39.3 0 0 1-14.5-19.42a38.31 38.31 0 0 1 0-24.63a39.25 39.25 0 0 1 9.18-14.91A37.17 37.17 0 0 1 76.13 27a34.28 34.28 0 0 1 13.64 8q5.83-5.8 11.64-11.63c2-2.09 4.18-4.08 6.15-6.22A61.22 61.22 0 0 0 87.2 4.59a64 64 0 0 0-42.61-.38"/><path fill="#e33629" d="M44.59 4.21a64 64 0 0 1 42.61.37a61.22 61.22 0 0 1 20.35 12.62c-2 2.14-4.11 4.14-6.15 6.22Q95.58 29.23 89.77 35a34.28 34.28 0 0 0-13.64-8a37.17 37.17 0 0 0-37.46 9.74a39.25 39.25 0 0 0-9.18 14.91L8.76 35.6A63.53 63.53 0 0 1 44.59 4.21"/><path fill="#f8bd00" d="M3.26 51.5a62.93 62.93 0 0 1 5.5-15.9l20.73 16.09a38.31 38.31 0 0 0 0 24.63q-10.36 8-20.73 16.08a63.33 63.33 0 0 1-5.5-40.9"/><path fill="#587dbd" d="M65.27 52.15h59.52a74.33 74.33 0 0 1-1.61 33.58a57.44 57.44 0 0 1-16 26.26c-6.69-5.22-13.41-10.4-20.1-15.62a29.72 29.72 0 0 0 12.66-19.54H65.27c-.01-8.22 0-16.45 0-24.68"/><path fill="#319f43" d="M8.75 92.4q10.37-8 20.73-16.08A39.3 39.3 0 0 0 44 95.74a37.16 37.16 0 0 0 14.08 6.08a41.29 41.29 0 0 0 15.1 0a36.16 36.16 0 0 0 13.93-5.5c6.69 5.22 13.41 10.4 20.1 15.62a57.13 57.13 0 0 1-25.9 13.47a67.6 67.6 0 0 1-32.36-.35a63 63 0 0 1-23-11.59A63.73 63.73 0 0 1 8.75 92.4"/></svg>
                                            <small>Login with Google</small>
                                        </a>
                                    </div>
                                    <div class="social-login-box">
                                        <a href="{{ url('auth/facebook') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="#1877f2" d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445"/><path fill="#fff" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165z"/></svg>
                                            <small>Login with Facebook</small>
                                        </a>
                                    </div>
                                    <div class="form-divider"><span>or</span></div>
                                    <form action="{{ url('admin/login') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="email" class="form-label">Username/email</label>
                                                <input type="text" name="email" id="email" class="form-control" placeholder="Your username/email. . ." aria-label="email">
                                            </div>
                                            <div class="col-lg-12 password-field">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="text" name="password" id="password" class="form-control" placeholder="Your Passowrd..." aria-label="password">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="currentColor"><path d="M12 15a3 3 0 1 0 0-6a3 3 0 0 0 0 6"/><path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69c.12.362.12.752 0 1.113c-1.487 4.471-5.705 7.697-10.677 7.697c-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113M17.25 12a5.25 5.25 0 1 1-10.5 0a5.25 5.25 0 0 1 10.5 0" clip-rule="evenodd"/></g></svg>
                                                <a href="#" class="blue-link">Blue</a>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="ly-button-3 register-btn">Log in</button>
                                                <div class="login-box">
                                                    <p>Don’t have an account?<a href="{{route('user.regiter')}}">Register now</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="ly-register-copyright">
                                    <p>© 2023 Made With <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3"/></svg> By company</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ly-register-section-end -->

    <script src="{{asset('front/js/jquery-3.6.0.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/sbmenu.js')}}"></script>
    <script src="{{asset('front/js/owl.carousel.js')}}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="{{asset('front/js/custom.js')}}"></script>
    </body>
    </html>
