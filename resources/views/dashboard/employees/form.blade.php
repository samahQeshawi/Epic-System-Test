<div class="row">


    <x-text title="الاسم الاول" name="first_name" :item="@$employee" size="6"></x-text>
    <x-text title="اسم العائلة" name="last_name" :item="@$employee" size="6"></x-text>
    <x-text title="رقم الموبايل" name="phone" :item="@$employee" size="6"></x-text>
    <x-email title="الايميل" name="email" :item="@$employee" size="6"></x-email>

        <div class="col-6">
            <div class="form-group">
                <label>المجموعة</label>
                <select name="group_id" class="form-control select2">
                    @foreach ($groups as $group)
                        <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                    @endforeach
                </select>
                <p class="help-block"></p>

            </div>
        </div>
</div>
<button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light">حفظ</button>
<a href="{{route('employees.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
