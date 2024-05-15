<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\InvitationType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InvitationType extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
    ];
}
