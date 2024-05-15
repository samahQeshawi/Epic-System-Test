@extends('dashboard.layout.main')
@section('title','اضافة باقة')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافة باقة</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::open(['route'=>'packages.store']) !!}
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
