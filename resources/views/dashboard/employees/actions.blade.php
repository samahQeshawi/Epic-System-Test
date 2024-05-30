
{{--<a class="btn btn-primary btn-icon"--}}
{{--   href="{{ route('employees.show', $id) }}">--}}
{{--    <i class="fa fa-eye"></i></a>--}}


<div class="btn-group" role="group" aria-label="Basic example">
    <a class="btn btn-warning btn-icon"
       href="{{ route('employees.edit', $id) }}">
        <i class="fa fa-pencil"></i></a>

    <a class="btn btn-danger btn-icon"
       onclick="delete_form(this)"
       data-href="{{ route('employees.destroy', $id) }}">
        <i class="fa fa-remove"></i></a>

</div>
