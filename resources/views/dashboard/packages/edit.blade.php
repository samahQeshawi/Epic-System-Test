@extends('dashboard.layout.main')
@section('title','تعديل باقة')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل باقة</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($package,['route'=>['packages.update',$package],'method'=>'PUT']) !!}
                                @include('dashboard.packages.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
