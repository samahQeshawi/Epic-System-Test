@extends('dashboard.layout.main')
@section('title','تعديل عنصر')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل عنصر</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::model($page,['route'=>['pages.update',$page],'method'=>'PUT']) !!}
                                @include('dashboard.pages.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
