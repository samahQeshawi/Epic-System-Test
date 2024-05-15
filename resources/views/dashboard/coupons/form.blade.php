<div class="row">

    <x-translatable title="الاسم" name="name" :item="@$coupon" size="6"></x-translatable>

    <div class="col-12  row">
    <x-text title="الخصم" name="discount" size="6"></x-text>
    <x-text title="الكود" name="code" size="6"></x-text>
    </div>

    <div class="col-12  row">
    <x-date title="تاريخ الابتداء" name="start" size="6"></x-date>
    <x-date title="تاريخ الانتهاء" name="end" size="6"></x-date>
    </div>

</div>
<div class="row">
    <div class="col-12">
      <div class="form-group">
          <p class="card-text mb-0">الحالة</p>
          <div class="demo-inline-spacing">
              <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio1" name="status" value="active" class="custom-control-input" @if(@$coupon && @$coupon->status == 'active' || @$coupon == null) checked @endif />
                  <label class="custom-control-label" for="customRadio1">مفعل</label>
              </div>
              <div class="custom-control custom-radio">
                  <input type="radio" id="customRadio2" name="status" value="not_active"  class="custom-control-input" @if(@$coupon && @$coupon->status == 'not_active') checked @endif />
                  <label class="custom-control-label" for="customRadio2">غير مفعل</label>
              </div>

          </div>
{{--        <div class="custom-control custom-control-primary custom-switch">--}}
{{--            <p class="mb-50">الحالة</p>--}}
{{--            <input type="checkbox" name="status" checked class="custom-control-input" id="customSwitch3" />--}}
{{--            <label class="custom-control-label" for="customSwitch3"></label>--}}
{{--        </div>--}}
      </div>
    </div>
</div>

<button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light">حفظ</button>
<a href="{{route('coupons.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
