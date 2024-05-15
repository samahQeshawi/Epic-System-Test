<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdditionalPackage
 *
 * @property int $id
 * @property int|null $invitation_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invitation|null $invitation
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereCompanionsNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereInvitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalPackage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdditionalPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'package_id',
        'package_price',
        'invitations_num',
        'remaining_num',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
