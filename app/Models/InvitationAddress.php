<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InvitationAddress
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $place_address
 * @property string $governorate
 * @property string $region
 * @property string $widget
 * @property string $neighborhood
 * @property string $build_number
 * @property string $floor
 * @property string $lat
 * @property string $long
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereBuildNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereGovernorate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereNeighborhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress wherePlaceAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvitationAddress whereWidget($value)
 * @mixin \Eloquent
 */
class InvitationAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'place_address',
        'governorate',
        'region',
        'widget',
        'neighborhood',
        'build_number',
        'floor',
        'lat',
        'long',
    ];
}

