<div class="row">

    <x-translatable-textarea title="الوصف" name="description" :item="@$page"  size="6"></x-translatable-textarea>


</div>
<button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light">حفظ</button>
<a href="{{route('pages.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
