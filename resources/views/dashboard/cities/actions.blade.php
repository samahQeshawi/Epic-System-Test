
<div class="btn-group" role="group" aria-label="Basic example">
        <a class="btn btn-warning btn-icon"
           href="{{ route('cities.edit', $id) }}">
            <i class="fa fa-pencil"></i></a>

    <a class="btn btn-danger btn-icon"
       onclick="delete_form(this)"
       data-href="{{ route('cities.destroy', $id) }}">
        <i class="fa fa-remove"></i></a>

</div>
