<!-- User Card starts-->
<div class="card user-card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                <div class="user-avatar-section">
                    <div class="d-flex justify-content-start">
                        <img class="img-fluid rounded" src="{{@$rating->user->image}}" height="104" width="104" alt="User avatar" />
                        <div class="d-flex flex-column ml-1">
                            <div class="user-info mb-1">
                                <h4 class="mb-0">{{ @$rating->user->first_name ." ". @$rating->user->last_name}}</h4>
                                <span class="card-text">{{@$rating->user->email}}</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">

                    <div class="d-flex flex-wrap ">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">الحالة : </span>
                        </div>

                        <div class="custom-control custom-control-primary custom-switch">
                            <input type="checkbox" name="status"  class="custom-control-input" id="customSwitch3"
                            @if($rating->status == 'active') checked @endif/>
                            <label class="custom-control-label" for="customSwitch3"></label>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="check" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">التقييم : </span>
                        </div>
                        <p class="card-text mb-0">
                            @if(@$rating->rate == 5)
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                            @elseif(@$rating->rate == 4)
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" ></span>
                            @elseif(@$rating->rate == 3)
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star" ></span>
                            @elseif(@$rating->rate == 2)
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star" ></span>
                            @elseif(@$rating->rate == 1)
                                <span class="fa fa-star" style="color: orange;"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star" ></span>
                            @endif
                        </p>
                    </div>


                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">تاريخ الانشاء : </span>
                        </div>
                        <p class="card-text mb-0">{{@$rating->created_at->toDateTimeString()}}</p>
                    </div>

                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="flag" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">التعليق : </span>
                        </div>
                        <p class="card-text mb-0">{{@$rating->comment}}</p>
                    </div>






                </div>
            </div>
        </div>
    </div>
</div>

<!-- /User Card Ends-->
<button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light">حفظ</button>

<a href="{{route('ratings.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
