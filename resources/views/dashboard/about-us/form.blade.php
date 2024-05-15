<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="media mb-2">
                <img src="{{@$about->image ? @$about->image : url('app_img/ChoosePhoto.png') }}" alt="Banner Image"
                     class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="90"
                     width="100" id="editImage"/>
                <div class="media-body mt-50">

                    <div class="col-12 d-flex mt-1 px-0">
                        <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                            <span class="d-none d-sm-block">Choose File</span>
                            <input class="form-control" type="file" id="change-picture" hidden name="image"
                                   value="{{@$about->image}}"/>
                            <span class="d-block d-sm-none">
                                 <i class="mr-0" data-feather="edit"></i>
                            </span>
                        </label>
                        <button class="btn btn-outline-secondary d-block d-sm-none">
                            <i class="mr-0" data-feather="trash-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <p class="help-block"></p>
            @error('image')
            <span style="color: red">{{ $message }}</span>
            @enderror

        </div>
    </div>
</div>
<div class="row">
    <x-translatable title="العنوان" name="title" :item="@$about" size="6"></x-translatable>

</div>
<button type="submit" class="btn btn-success mr-1 mb-1 waves-effect waves-light">حفظ</button>
<a href="{{route('about-us.index')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">رجوع</a>
