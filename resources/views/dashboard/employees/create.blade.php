@extends('dashboard.layout.main')
@section('title','اضافة موظف')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافة موظف</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::open(['route'=>'employees.store']) !!}
                                @include('dashboard.employees.form')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
