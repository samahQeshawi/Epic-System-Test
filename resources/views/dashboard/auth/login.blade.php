<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title> Epic | تسجيل الدخول</title>
    {{--    <link rel="apple-touch-icon" href="{{ asset('assets/dashboard') }}/app-assets/images/ico/apple-icon-120.png">--}}
    {{--    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/dashboard') }}/app-assets/images/ico/favicon.ico">--}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
{!! Html::style('_dashboard/app-assets/vendors/css/vendors-rtl.min.css') !!}
<!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
{!! Html::style('_dashboard/app-assets/css-rtl/bootstrap.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/bootstrap-extended.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/colors.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/components.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/themes/dark-layout.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/themes/semi-dark-layout.css') !!}

<!-- BEGIN: Page CSS-->
{!! Html::style('_dashboard/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/core/colors/palette-gradient.css') !!}
{!! Html::style('_dashboard/app-assets/css-rtl/pages/authentication.css') !!}
<!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
{!! Html::style('_dashboard/app-assets/css-rtl/custom-rtl.css') !!}
{!! Html::style('_dashboard/assets/css/style-rtl.css') !!}
<!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">

            <section class="row flexbox-container">
                <div class="col-xl-8 col-11 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                <img src="{{ asset('_dashboard/login.png') }}" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 mb-0 px-2">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">تسجيل الدخول</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">مرحبا في لوحة تحكم موقع Epic System</p>
                                    <div class="card-content">



                                            @if(session()->has('success'))
                                                <div class="alert alert-success alert-dismissable fadeout-msg">
                                                    <p>{{ session()->get('success') }}</p>
                                                </div>
                                            @endif

                                            @if(session()->has('fail'))
                                                <div class="alert alert-danger alert-dismissable fadeout-msg">
                                                    <p>{{ session()->get('fail') }}</p>
                                                </div>
                                            @endif

                                            @if(session()->has('info'))
                                                <div class="alert alert-info alert-dismissable fadeout-msg">
                                                    <p>{{ session()->get('info') }}</p>
                                                </div>
                                            @endif
                                        @if(count($errors) > 0)
                                            <div class="alert alert-danger alert-dismissable">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="card-body pt-1">
                                            <form action="{{ route('admin.signIn') }}" method="post">
                                                @csrf
                                                <fieldset
                                                    class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="email" class="form-control" id="user-name" name="email"
                                                           placeholder="example@example.com" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="user-name">البريد الإلكتروني</label>
                                                </fieldset>

                                                <fieldset class="form-label-group position-relative has-icon-left">
                                                    <input type="password" class="form-control" name="password"
                                                           id="user-password" placeholder="********" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="user-password">كلمة المرور</label>
                                                </fieldset>

                                                <button type="submit" class="btn btn-primary float-right btn-inline">
                                                    تسجيل الدخول
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="login-footer"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
{!! Html::script('_dashboard/app-assets/vendors/js/vendors.min.js') !!}
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
{!! Html::script('_dashboard/app-assets/js/core/app-menu.js') !!}
{!! Html::script('_dashboard/app-assets/js/core/app.js') !!}
{!! Html::script('_dashboard/app-assets/js/scripts/components.js') !!}
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
