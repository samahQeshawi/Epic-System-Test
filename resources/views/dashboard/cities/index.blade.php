@extends('dashboard.layout.main')
@section('title','المدن')
@section('content')

    <div class="content-body">
        <!-- Description -->
        <section id="column-selectors">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">المدن</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <a  href="{{route('cities.create')}}" class="btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; اضف مدينة جديدة </a>
                                <div class="table-responsive">
                                    {{ $dataTable->table()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Description -->
    </div>
@endsection
@include('dashboard.layout.datatables')
@push('scripts')
    {{$dataTable->scripts()}}
    {!! Html::script('vendor/datatables/buttons.server-side.js') !!}

@endpush
