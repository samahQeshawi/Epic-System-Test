<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Method
 *
 * @property int $id
 * @property string|null $name
 * @property string $image
 * @property string $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Method newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Method newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Method query()
 * @method static \Illuminate\Database\Eloquent\Builder|Method whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Method whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Method whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Method whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Method whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Method whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Method extends Model
{
    use HasFactory , HasTranslations , ImageTrait;

    public $translatable = ['title','details'];

    protected $fillable = [
        'title',
        'image',
        'details',
    ];

}
