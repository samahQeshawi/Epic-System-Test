@extends('dashboard.layout.main')
@section('title','مشاهدة العميل')
@section('content')
    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">مشاهدة العميل</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <!-- User Card starts-->
                                <div class="card user-card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                                <div class="user-avatar-section">
                                                    <div class="d-flex justify-content-start">
                                                        <img class="img-fluid rounded" src="{{@$user->image}}" height="104" width="104" alt="User avatar" />
                                                        <div class="d-flex flex-column ml-1">
                                                            <div class="user-info mb-1">
                                                                <h4 class="mb-0">{{ @$user->first_name ." ". @$user->last_name}}</h4>
                                                                <span class="card-text">{{@$user->email}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <div class="d-flex align-items-center user-total-numbers">--}}
{{--                                                    <div class="d-flex align-items-center mr-2">--}}
{{--                                                        <div class="color-box bg-light-primary">--}}
{{--                                                            <i data-feather="dollar-sign" class="text-primary"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ml-1">--}}
{{--                                                            <h5 class="mb-0">0</h5>--}}
{{--                                                            <small>الدعوات المرقمة</small>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="color-box bg-light-success">--}}
{{--                                                            <i data-feather="trending-up" class="text-success"></i>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ml-1">--}}
{{--                                                            <h5 class="mb-0">0</h5>--}}
{{--                                                            <small>الدعوات من جهة اتصالك</small>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                                <div class="user-info-wrapper">
                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-feather="user" class="mr-1"></i>
                                                            <span class="card-text user-info-title font-weight-bold mb-0">Username</span>
                                                        </div>
                                                        <p class="card-text mb-0">{{ @$user->first_name .".". @$user->last_name}}</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="check" class="mr-1"></i>
                                                            <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                                        </div>
                                                        <p class="card-text mb-0">{{@$user->is_verify == 0 ? 'not active':'active'}}</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="star" class="mr-1"></i>
                                                            <span class="card-text user-info-title font-weight-bold mb-0">Code</span>
                                                        </div>
                                                        <p class="card-text mb-0">{{@$user->code}}</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="flag" class="mr-1"></i>
                                                            <span class="card-text user-info-title font-weight-bold mb-0">City</span>
                                                        </div>
                                                        <p class="card-text mb-0">{{$user->city_id != null ? @$user->city->getTranslation('name', 'ar') : '--'}}</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-feather="phone" class="mr-1"></i>
                                                            <span class="card-text user-info-title font-weight-bold mb-0">Phone</span>
                                                        </div>
                                                        <p class="card-text mb-0">{{@$user->phone}}</p>
                                                    </div>

                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-feather="flag" class="mr-1"></i>
                                                            <span class="card-text user-info-title font-weight-bold mb-0">Created at</span>
                                                        </div>
                                                        <p class="card-text mb-0">{{@$user->created_at->toDateTimeString()}}</p>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /User Card Ends-->
                                <a href="{{route('users.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
