@extends('dashboard.layout.main')
@section('title','تعديل طريقة')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل طريقة</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($method,['route'=>['methods.update',$method],'files'=>true,'method'=>'PUT', 'enctype' => 'multipart/form-data']) !!}
                                @include('dashboard.methods.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
