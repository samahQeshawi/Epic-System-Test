<div class="col-12  row">
    <div class="col-6">
        <div class="form-group">
            <label>{{$title}} بالعربية </label>

            {!! Form::textarea($name."[ar]",(isset($item) and array_key_exists('ar',$item))? $item['ar']:null,['class'=>'form-control ckeditor','placeholder'=>$title.' بالعربية' ,'rows'=>4])!!}
            <p class="help-block"></p>
            @error($name.".ar")
            <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>{{$title}} بالانجليزية</label>
            {!! Form::textarea($name."[en]",(isset($item) and array_key_exists('en',$item))? $item['en']:null,['class'=>'form-control ckeditor','placeholder'=>$title.' بالانجليزية' ,'rows'=>4])!!}

            <p class="help-block"></p>
            @error($name.".en")
            <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
