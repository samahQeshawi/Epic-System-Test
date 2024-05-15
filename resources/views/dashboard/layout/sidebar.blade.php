<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <ul class="nav navbar-nav flex-row " style="display: flex; justify-content: center">
        <li class="">
            <div class="" style="display: flex;justify-content: center">
                <a class=" " href="#">
                    <img class="" src="" style="height: auto;width: 120px" alt="">
                  {{--   الرئيسيه --}}
                </a>
            </div>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                    class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                    class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                    data-ticon="icon-disc"></i></a></li>
    </ul>

    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="#"><i class="feather icon-map">
                    </i><span class="menu-title" data-i18n="Starter kit">الرئيسيه</span></a>

            </li>


            <li class=" nav-item"><a href="{{route('users.index')}}"><i class="feather icon-user-check"></i><span class="menu-title"
                        data-i18n="Starter kit">ادارة المستخدمين</span></a>

            </li>
            <li class=" nav-item"><a href="{{route('cities.index')}}"><i class="feather icon-map"></i><span class="menu-title"
                        data-i18n="Starter kit">ادارة المدن</span></a>

            </li>
            <li class=" nav-item"><a href="{{route('packages.index')}}"><i class="feather icon-map"></i><span class="menu-title"
                        data-i18n="Starter kit">ادارة الباقات</span></a>

            </li>
            <li class=" nav-item"><a href="{{route('ratings.index')}}"><i class="feather icon-map"></i><span class="menu-title"
                        data-i18n="Starter kit">ادارة التقييمات</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('banners.index')}}"><i class="feather icon-image"></i><span class="menu-title"
                        data-i18n="Starter kit">ادارة البنرات</span></a>

            </li>

            <li class=" nav-item"><a href="{{route('designs.index')}}"><i class="feather icon-image"></i><span class="menu-title"
                        data-i18n="Starter kit">ادارة التصاميم</span></a>

            </li>

            <li class=" nav-item"><a href="{{route('invitation-types.index')}}"><i class="feather icon-image"></i><span class="menu-title"
                           data-i18n="Starter kit">نوع الدعوة</span></a>

            </li>

            <li class=" nav-item"><a href="{{route('methods.index')}}"><i class="feather icon-image"></i><span class="menu-title"
                          data-i18n="Starter kit">طرق الدعوة</span></a>

            </li>

            <li class=" nav-item"><a href="{{route('coupons.index')}}"><i class="feather icon-image"></i><span class="menu-title"
                           data-i18n="Starter kit">كوبونات الخصم</span></a>

            </li>
            <li class=" nav-item"><a href="{{route('about-us.index')}}"><i class="feather icon-credit-card"></i><span class="menu-title"
                        data-i18n="Starter kit">لماذا يباب ؟</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('pages.index')}}"><i class="feather icon-credit-card"></i><span class="menu-title"
                               data-i18n="Starter kit">الشروط والاحكام</span></a>
            </li>

            <li class=" nav-item"><a href="{{route('notifications.index')}}"><i class="feather icon-credit-card"></i>
                    <span class="menu-title"   data-i18n="Starter kit">الاشعارات</span></a>
            </li>


{{--            <li class=" nav-item">--}}
{{--                <a href="#"><i class="feather icon-map"></i><span class="menu-title"--}}
{{--                data-i18n="Starter kit">الاعدادات</span></a>--}}

{{--             </li>--}}



            <li class=" nav-item"><a href="#" onclick="$('#logout-form').submit()">
                    <i class="feather icon-power"></i>
                    <span class="menu-title" data-i18n="Starter kit">تسجيل الخروج</span>
                </a>
            </li>
            {!! Form::open(['route' => 'admin.logout', 'method' => 'POST', 'id' => 'logout-form']) !!}
            {!! Form::close() !!}
        </ul>
    </div>
</div>
