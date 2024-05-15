
<!-- BEGIN: Vendor JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>{!! Html::script('_dashboard/app-assets/vendors/js/vendors.min.js') !!}
{!! Html::script('_dashboard/app-assets/vendors/js/extensions/tether.min.js') !!}
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->


<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
{!! Form::open(['id'=>'delete-form','method'=>'DELETE']) !!}
{!! Form::close() !!}
{!! Form::open(['id'=>'send-notify','method'=>'POST']) !!}
{!! Form::close() !!}
{!! Html::script('_dashboard/app-assets/js/core/app-menu.js') !!}
{!! Html::script('_dashboard/app-assets/js/core/app.js') !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

{!! Html::script('_dashboard\app-assets\js\core\libraries\bootstrap.min.js') !!}
{!! Html::script('_dashboard/app-assets/js/scripts/components.js') !!}
{!! Html::script('_dashboard/app-assets/vendors/js/pickers/pickadate/picker.js') !!}
{!! Html::script('_dashboard/app-assets/vendors/js/pickers/pickadate/picker.date.js') !!}
<script src="{{asset('_dashboard/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/v4-shims.js"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
    var lis = $('.check-active');
    lis.each(function (index) {
        if  ($(this).attr('href') === "{!!url('/')!!}" + window.location.pathname) {
            $(this).parent().addClass('active');
            // $(this).parent().parent().parent().addClass('active');
        }
    });
    function delete_form(element){
        let url=$(element).data('href');
        Swal.fire({
            title: 'هل تريد حذف العنصر ؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'احذف',
            cancelButtonText:'الغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form').attr('action',url).submit();
            }
        })
    }

    function send_notify(element){
        let url=$(element).data('href');
        Swal.fire({
            title: 'هل تريد ارسال الاشعار الان ؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ارسل',
            cancelButtonText:'الغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#send-notify').attr('action',url).submit();
            }
        })
    }

    $('.select2:not(n-select2)').select2({width:'100%'});
    $('.select2-multiple').select2({tags:true});

    $(document).ready(function () {
    });

    $('.pickadate').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-10y',
        rtl:true
    });
    $(".time").pickatime({
        format: 'HH:i'
    });
    $(document).ready(function ($) {
        $('[data-toggle="popover"]').popover(
            {
                trigger: 'focus'
            }
        );
        CKEDITOR.replace('ckeditor');
    });

</script>

<script>
    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#change-picture').on('change', function (e) {
        readURL(this, $('#editImage'));
    });

</script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@include('sweetalert::alert')
<!-- END: Page JS-->

