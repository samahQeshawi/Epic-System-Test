
<div class="btn-group" role="group" aria-label="Basic example">
    <a class="btn btn-warning btn-icon"
       href="{{ route('ratings.edit', $id) }}">
        <i class="fa fa-pencil"></i></a>

    <a class="btn btn-danger btn-icon"
       href="{{ route('ratings.destroy', $id) }}">
        <i class="fa fa-remove"></i></a>

</div>
