@extends('dashboard.layout.main')
@section('title','تعديل كوبون خصم')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل كوبون خصم</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($coupon,['route'=>['coupons.update',$coupon],'method'=>'PUT']) !!}
                                @include('dashboard.coupons.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
