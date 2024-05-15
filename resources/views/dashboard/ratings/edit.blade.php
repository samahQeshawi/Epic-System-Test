@extends('dashboard.layout.main')
@section('title','تعديل حالة التقييم')
@section('content')
    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل حالة التقييم</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($rating,['route'=>['ratings.update',$rating],'method'=>'PUT']) !!}
                                @include('dashboard.ratings.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
