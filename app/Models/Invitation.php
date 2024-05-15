<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;
use Carbon\Carbon;

/**
 * App\Models\Invitation
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $package_id
 * @property int|null $invitation_address_id
 * @property int|null $invitation_type_id
 * @property int|null $coupon_id
 * @property int $is_notice_before_time
 * @property int $is_notice_specified_date
 * @property string|null $specified_date
 * @property string $method_type
 * @property string $name
 * @property string $inviter_name
 * @property string $date_time
 * @property string $details
 * @property string $Qrcode
 * @property $this|false|string $image
 * @property string $Qrcode_place
 * @property int $is_logo_remove
 * @property string $coupon_val
 * @property string $package_price
 * @property string $logo_remove_price
 * @property string $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read mixed $remaining_num
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InviteesList> $invitees
 * @property-read int|null $invitees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InviteesList> $inviteesAccepted
 * @property-read int|null $invitees_accepted_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InviteesList> $inviteesAttendees
 * @property-read int|null $invitees_attendees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InviteesList> $inviteesRejected
 * @property-read int|null $invitees_rejected_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InviteesList> $inviteesWaiting
 * @property-read int|null $invitees_waiting_count
 * @property-read \App\Models\Package|null $package
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereCouponVal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereInvitationAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereInvitationTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereInviterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereIsLogoRemove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereIsNoticeBeforeTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereIsNoticeSpecifiedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereLogoRemovePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereMethodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation wherePackagePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereQrcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereQrcodePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereSpecifiedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invitation whereUserId($value)
 * @mixin \Eloquent
 */
class Invitation extends Model
{
    use HasFactory , ImageTrait ;

    protected $fillable = [
        'user_id',
        'package_id',
        'invitation_address_id',
        'invitation_type_id',
        'coupon_id',
        'is_notice_before_time',
        'is_notice_specified_date',
        'specified_date',
        'method_type',
        'name',
        'inviter_name',
        'date_time',
        'details',
        'Qrcode',
        'image',
        'Qrcode_place',
        'is_logo_remove',
        'coupon_val',
        'package_price',
        'logo_remove_price',
        'total',
        'additional_package_id',
        'additional_package_price',
    ];
    public function image()
    {
        return $this->image == '' ? asset('storage/images/default.jpg') :asset('storage/invitations/'. $this->image);
    }

    public function status()
    {
        $targetDate = Carbon::parse($this->date_time);
        $now = Carbon::now();
        if($targetDate < $now){
            return 'complete';
        }else{
            return 'waiting';
        }
    }


    public function user() {
        return $this->belongsTo(User::class);
    }
    public function package() {
        return $this->belongsTo(Package::class);
    }
    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }
    public function invitees()
    {
        return $this->hasMany(InviteesList::class);
    }

    public function inviteesWaiting()
    {
        return $this->hasMany(InviteesList::class)
            ->where('status','waiting');
    }
    public function inviteesAttendees()
    {
        return $this->hasMany(InviteesList::class)
            ->where('status','complete');
    }
    public function inviteesAccepted()
    {
        return $this->hasMany(InviteesList::class)
            ->where('status','accepted');
    }
    public function inviteesRejected()
    {
        return $this->hasMany(InviteesList::class)
            ->where('status','rejected');
    }

    public function getNumInvitationsAttribute() {

        $packages_data =AdditionalPackage::where('invitation_id',$this->id)->get();
        if($packages_data){
            $invitations_num = $packages_data->sum('invitations_num');
        }else{
            $invitations_num = $this->package->num_invitations;
        }
        return $invitations_num  ;
    }

    public function getRemainingNumAttribute() {
        $packages_data =AdditionalPackage::where('invitation_id',$this->id)->get();
        if($packages_data){
            $invitations_num = $packages_data->sum('invitations_num');
        }else{
            $invitations_num = $this->package->num_invitations;
        }
       $invitees_num = $this->invitees->count();
       return $invitations_num - $invitees_num ;
    }

    public function getRemainingDaysAttribute() {

        $targetDate = Carbon::parse($this->date_time);
        $now = Carbon::now();
        $diffInDays = $targetDate->diffForHumans($now);

        return $diffInDays;

    }

    public function getQrcodeAttribute($value){
        return $value == '' ? asset('storage/images/qrcode.svg') :asset('storage/images/'.$value);

    }


}
