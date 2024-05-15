<div class="row">

    <x-translatable title="الاسم" name="name" :item="@$package" size="6"></x-translatable>
    <div class="col-12  row">
    <x-text title="السعر" name="price" size="6"></x-text>
    <x-text title="عدد الدعوات" name="num_invitations" size="6"></x-text>
    </div>
    <x-translatable-textarea title="الوصف" name="details" :item="@$package"  size="6"></x-translatable-textarea>




</div>
<button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light">حفظ</button>
<a href="{{route('packages.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
