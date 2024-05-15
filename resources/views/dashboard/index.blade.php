@extends('dashboard.layout.main')
@push('styles')
    <link rel="stylesheet" href="{{asset('_dashboard/app-assets/vendors/css/charts/apexcharts.css')}}">
@endpush
@section('title','الرئيسيه')

@section('content')

    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card bg-analytics text-white">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <img src="{{ asset('_dashboard/app-assets/images/elements/decore-left.png') }}"
                                     class="img-left" alt="
            card-img-left">
                                <img src="{{ asset('_dashboard/app-assets/images/elements/decore-right.png') }}"
                                     class="img-right" alt="
            card-img-right">
                                <div class="avatar avatar-xl bg-primary shadow mt-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-award white font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-2 text-black-50">مرحبا {{auth('admin')->user()->name}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-user text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\User::count()}}</h2>
                                <p class="mb-0 line-ellipsis"> المستخدمين</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-user-cog text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\User::count()}}</h2>
                                <p class="mb-0 line-ellipsis"> مقدمين الخدمات</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-store text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\Branch::count()}}</h2>
                                <p class="mb-0 line-ellipsis"> الفروع</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-credit-card text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\Subscription::count()}}</h2>
                                <p class="mb-0 line-ellipsis"> الاشتراكات</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-hourglass-end text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\User::whereHas('subscription',function ($q){
                                        $q->where('end_at',"<=",now());})->count()}}</h2>
                                <p class="mb-0 line-ellipsis"> عدد الاشتراكات المنتهية</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-credit-card text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\Order::count()}}</h2>
                                <p class="mb-0 line-ellipsis">عدد الخصومات</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-credit-card text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\Order::sum('total')}}</h2>
                                <p class="mb-0 line-ellipsis"> اجمالي المدفوعات</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-credit-card text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\Order::sum('discount')}}</h2>
                                <p class="mb-0 line-ellipsis">اجمالي الخصومات</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-user text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\User::whereHas('subscription',function ($q){
                                            $q->where('type','personal');
                                        })->count()}}</h2>
                                <p class="mb-0 line-ellipsis"> عدد الاشتركات الفردية</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-users text-danger fa-2x"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{\App\Models\User::whereHas('subscription',function ($q){
                                            $q->where('type','family');
                                        })->count()}}</h2>
                                <p class="mb-0 line-ellipsis"> عدد الاشتركات العائلية</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="col-xl-2 col-md-4 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-user-md text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Doctor::count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> طالبين الاستشارة</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-4 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-newspaper-o text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Blog::count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> المقالات</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-file-text-o text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Reservation::count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> الملفات المرضية</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-question-circle text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Contact::whereNotNull('user_id')->count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> اسال المستشار</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-2 col-md-4 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-medkit text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Medicine::count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> الادوية</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-question-circle text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Course::count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> الدوارات</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6 ">
                                    <div class="card text-center">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                                    <div class="avatar-content">
                                                        <i class="fa fa-tasks text-danger fa-2x"></i>
                                                    </div>
                                                </div>
                                                <h2 class="text-bold-700">{{\App\Models\Question::count()}}</h2>
                                                <p class="mb-0 line-ellipsis"> الاسئلة الشائعة</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}

            </div>
        </section>
        <!-- Dashboard Analytics end -->
    </div>

@endsection
@push('scripts')
    <script src="{{asset('_dashboard/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>

    {{--
        <script>
            var subscriptions_values=@json($subscriptions['count']);
            var  subscriptions_dates=@json($subscriptions['dates']);
            var reservations_values=@json($reservations['count']);
            var  reservations_dates=@json($reservations['dates']);

            var $primary = '#7367F0',
                $success = '#28C76F',
                $danger = '#EA5455',
                $warning = '#FF9F43',
                $info = '#00cfe8',
                $label_color_light = '#dae1e7';

            var themeColors = [$primary, $success, $danger, $warning, $info];

            var subscriptions = {
                chart: {
                    height: 350,
                    type: 'area',
                },
                colors: themeColors,
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                series: [{
                    name: 'الحجوزات',
                    data: subscriptions_values
                }],
                legend: {
                    offsetY: -10
                },
                xaxis: {
                    // type: 'datetime',
                    categories: subscriptions_dates,
                },
                yaxis: {
                    opposite: true
                },
                tooltip: {
                    x: {
                        format: 'MM/yy'
                    },
                }
            }
            var subscriptions_chart = new ApexCharts(
                document.querySelector("#subscriptions-area-chart"),
                subscriptions
            );
            subscriptions_chart.render();

            var reservations = {
                chart: {
                    height: 350,
                    type: 'area',
                },
                colors: themeColors,
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                series: [{
                    name: 'الحجوزات',
                    data: reservations_values
                }],
                legend: {
                    offsetY: -10
                },
                xaxis: {
                    // type: 'datetime',
                    categories: reservations_dates,
                },
                yaxis: {
                    opposite: true
                },
                tooltip: {
                    x: {
                        format: 'MM/yy'
                    },
                }
            }
            var reservations_chart = new ApexCharts(
                document.querySelector("#reservations-area-chart"),
                reservations
            );
            reservations_chart.render();
        </script>
    --}}
@endpush
