<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Design
 *
 * @property int $id
 * @property string|null $name
 * @property string $image
 * @property string $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Design newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Design newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Design query()
 * @method static \Illuminate\Database\Eloquent\Builder|Design whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Design whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Design whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Design whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Design whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Design whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Design extends Model
{
    use HasFactory , HasTranslations , ImageTrait;

    public $translatable = ['name','details'];

    protected $fillable = [
        'name',
        'image',
        'details',
    ];

}
