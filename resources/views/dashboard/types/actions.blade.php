
<div class="btn-group" role="group" aria-label="Basic example">
    <a class="btn btn-warning btn-icon"
       href="{{ route('invitation-types.edit', $id) }}">
        <i class="fa fa-pencil"></i></a>

    <a class="btn btn-danger btn-icon"
       onclick="delete_form(this)"
       data-href="{{ route('invitation-types.destroy', $id) }}">
        <i class="fa fa-remove"></i></a>

</div>
