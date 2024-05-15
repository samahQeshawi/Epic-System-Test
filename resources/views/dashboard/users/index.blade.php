@extends('dashboard.layout.main')
@section('title','العملاء')

    @section('content')

    <div class="content-body">
        <!-- Description -->
        <section id="column-selectors">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">العملاء</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
{{--                                <button type="button" class="btn btn-primary mb-2 waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">--}}
{{--                                    <i class="feather icon-plus"></i>&nbsp; اضف عميل جديد--}}
{{--                                </button>--}}
                            {{--    <a  href="{{route('admin.users.create')}}" class="btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; اضف عميل جديد </a> --}}
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
{{--        @include('dashboard.users.modal')--}}
    </div>


@endsection
@include('dashboard.layout.datatables')
@push('scripts')
    {{$dataTable->scripts()}}
    {!! Html::script('vendor/datatables/buttons.server-side.js') !!}

@endpush
