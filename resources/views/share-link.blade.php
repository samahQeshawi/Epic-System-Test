<!DOCTYPE html>

<html dir="rtl">
<head>
    <!-- Meta Files -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="tag" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Files -->

    <!-- Title Files -->
    <title> YEBAB || يباب </title>
    <link rel="icon" href="">
    <!-- Title Files -->
    <!-- Css Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('share_link/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('share_link/css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('share_link/css/fontweb.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('share_link/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('share_link/css/media.css')}}">
</head>
<body>
<!-- JS Files -->
<div class="container">
    <div id="flash-messages">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissable fadeout-msg">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        @if(session()->has('fail'))
            <div class="alert alert-danger alert-dismissable fadeout-msg">
                <p>{{ session()->get('fail') }}</p>
            </div>
        @endif
    </div>


    <div class="Invinate text-center">
        <div class="text-center Logo-Company mb-3">
            <img src="{{asset('app_img/logo-1.png')}}">
        </div>
        <div class="Qr-Img">
{{--            <img src="{{asset('share_link/img/qr.png')}}">--}}
            {!! QrCode::size(170)->generate($user->id) !!}

            <p class="CairoMed text-center mt-3">no scanned</p>
        </div>
        <div class="from-person CairoMed mb-4">
            <p class="mb-0">
                <span>الداعي : السيد/ة &nbsp; &nbsp;</span>
                {{$user->invitation->inviter_name}}
            </p>
        </div>
        <div class="to-person CairoMed">
            <p>
                @if($user->title != null)
                    <span>{{$user->title}}  / </span>
                @else
                    <span>المدعو : السيد/ة &nbsp; &nbsp; </span>
                @endif
                      {{@$user->name}}
            </p>
        </div>
        <div class="from-person CairoMed mb-4">
            <p class="mb-0">
                <span>انت مدعو ل / </span>
                {{$user->invitation->name}}
            </p>
        </div>
        <div class="detail mb-4">
            <p class="CairoMed">مراسم الدعوة</p>
            <div class="CairoMed date">
                <p class="mb-0">
                    {{$user->invitation->date_time}}
                </p>
            </div>
        </div>
        <div class="detail mb-5">
            <p class="CairoMed">التفاصيل</p>
            <div class="box-details CairoReg">
                <p class="mb-0">
                    {{$user->invitation->details}}
                </p>
            </div>
        </div>
        <div class="btn-invinate CairoMed">
                <button class="btnConfirm btn me-2" id="acceptedForm" @if($user->status != 'waiting' )disabled @endif>تأكيد الحضور</button>

            <button  class="btnSorry btn ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
                     id="rejectedBtn" @if($user->status != 'waiting' )disabled @endif>اعتذار عن الحضور</button>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="text-white mb-3 CairoMed modalTxt">
                    هل أنت متأكد أنك تريد الاعتذار عن الحضور ؟
                </p>
                <form class="form" id='rejectedForm'  enctype="multipart/form-data" method="post">
                        @CSRF
                <input type="hidden" name="status" value="rejected" id="status">
                <textarea rows="6" placeholder="يمكنك اضافة سببب الاعتذار هنا (اختياري)..." name="reason" id="reason"
                                  class="text-white form-control p-2 CairoReg">

                </textarea>
                    <div class="CairoMed mt-4">
                        <button type="button" class="btn me-2 btn-confirm-sorryno" data-bs-dismiss="modal">لا</button>
                        <button type="submit" class="btn ms-2 btn-confirm-sorry" id="submit">نعم</button>
                    </div>
                </form>

                <p class="text-white mt-4 CairoMed modalTxt">
                    لا يمكن التراجع عن هذا الإجراء
                </p>
            </div>
        </div>
    </div>
</div>
<script rel="script" type="text/javascript" src="{{asset('share_link/js/jquery-3.5.1.min.js')}}"></script>
<script rel="script" type="text/javascript" src="{{asset('share_link/js/bootstrap.min.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#rejectedForm").submit( function (e) {
        e.preventDefault();
        var reason = $("#reason").val();
        var status = $("#status").val();

        $.ajax({
            url: "{!! URL::signedRoute('share-link',$user->id) !!}",
            method: 'POST',
            data: {
                reason :reason ,
                status :status
            },

            success: function (data) {

                if (data.status == 1) {
                    // show_toast_message("success", data.msg);
                    $("#exampleModal").modal("hide");
                    $("#rejectedForm")[0].reset();
                    $("#rejectedBtn").attr("disabled", true);
                    $("#acceptedForm").attr("disabled", true);

                    $('#flash-messages').html('<div class="alert alert-danger alert-dismissable fadeout-msg">' + data.message + '</div>');

                }
            },
            error: function () {
                $("#rejectedForm").find("button[type='submit']").attr("disabled", false);
            }
        });


    });

    $("#acceptedForm").click( function (e) {
        e.preventDefault();
        var status = 'accepted';

        $.ajax({
            url: "{!! URL::signedRoute('share-link',$user->id) !!}",
            method: 'POST',
            data: {
                status :status
            },

            success: function (data) {

                if (data.status == 1) {
                    $("#acceptedForm").attr("disabled", true);
                    $("#rejectedBtn").attr("disabled", true);

                    $('#flash-messages').html('<div class="alert alert-success alert-dismissable fadeout-msg">' + data.message + '</div>');


                }
            },
            error: function () {
            }
        });


    });

</script>
</body>
</html>


