@extends('dashboard.layout.main')
@section('title','اضافة نوع دعوة')
@section('content')

    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافة نوع دعوة</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::open(['route'=>'invitation-types.store']) !!}
                                    @include('dashboard.types.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
