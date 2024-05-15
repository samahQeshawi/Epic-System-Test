
<div class="btn-group" role="group" aria-label="Basic example">
    <a class="btn btn-info btn-icon"
       onclick="send_notify(this)"
       data-href="{{ route('notifications.send', $id) }}">
        <i class="fa fa-paper-plane"></i></a>

    <a class="btn btn-warning btn-icon"
       href="{{ route('notifications.edit', $id) }}">
        <i class="fa fa-pencil"></i></a>



    <a class="btn btn-danger btn-icon"
       onclick="delete_form(this)"
       data-href="{{ route('notifications.destroy', $id) }}">
        <i class="fa fa-remove"></i></a>

</div>
