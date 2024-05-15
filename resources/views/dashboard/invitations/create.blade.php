@extends('dashboard.layout.main')
@section('title','اضافة عميل')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissable fadeout-msg">
            <p>{{ session()->get('success') }}</p>
        </div>
    @endif
    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافة عميل</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                {!! Form::open(['route'=>'admin.users.store']) !!}
                                    @include('dashboard.users.form')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
