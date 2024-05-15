<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


/**
 * App\Models\AboutAs
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs query()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutAs whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AboutAs extends Model
{
    use HasFactory ,HasTranslations , ImageTrait;

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'image',
    ];

}
