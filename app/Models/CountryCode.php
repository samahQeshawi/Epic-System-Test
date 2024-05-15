<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class CountryCode extends Model
{
    use HasFactory ;

    public $table = 'country_code';

    protected $fillable = [
        'country',
        'country_code',
        'iso_codes',
    ];
    protected $appends = ['photo'];

    public function getPhotoAttribute(){
        $value = $this->iso_codes;
        $x = explode(' /', $value);

        $flag_name= strtolower($x[0]);
        return  asset('app_img/flags/'.$flag_name.'.svg');
    }

    public function flag(){
        $value = $this->iso_codes;
        $x = explode(' /', $value);

        $flag_name= strtolower($x[0]);
        return  asset('app_img/flags_png/'.$flag_name.'.png');
    }
}
