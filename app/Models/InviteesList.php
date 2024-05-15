<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InviteesList
 *
 * @property int $id
 * @property int|null $invitation_id
 * @property string|null $title
 * @property string|null $name
 * @property int $companions_number
 * @property int|null $phone
 * @property string $link
 * @property string $status
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invitation|null $invitation
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList query()
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereCompanionsNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereInvitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InviteesList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InviteesList extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'title',
        'name',
        'companions_number',
        'phone',
        'link',
        'status',
        'reason',
        'serial_number',
        'is_send',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
