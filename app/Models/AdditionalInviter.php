<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdditionalInviter
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $invitation_id
 * @property string $email
 * @property int $invitations_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereInvitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereInvitationsNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalInviter whereUserId($value)
 * @mixin \Eloquent
 */
class AdditionalInviter extends Model
{
    use HasFactory;

}
