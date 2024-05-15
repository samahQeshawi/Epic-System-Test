@extends('dashboard.layout.main')
@section('title','تعديل اشعار')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل اشعار</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($notify,['route'=>['notifications.update',$notify],'method'=>'PUT']) !!}
                                @include('dashboard.notifications.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
