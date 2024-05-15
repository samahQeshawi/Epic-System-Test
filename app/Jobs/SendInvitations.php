<?php

namespace App\Jobs;

use App\Models\InviteesList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Invitation;
use Illuminate\Support\Facades\DB;


class SendInvitations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $invitationId;

    public function __construct($invitationId)
    {
        $this->invitationId = $invitationId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invitees = InviteesList::where('invitation_id', $this->invitationId)
            ->where('is_send',0)->get();


        foreach ($invitees as $invited) {
            // Send the message using WB
//            DB::insert("insert into test_send (text) values ($invited->id)");
//            $message_whatsapp ='اهلا  بك في تطبيق يباب 😀'. '\n' . 'رابط الدعوة هو ' . '\n' . $invited->link ;
            $message_whatsapp ='اهلا  بك في تطبيق يباب 😀'. '\n' . 'رابط الدعوة هو '  ;
            whatsapp($invited->phone, $message_whatsapp);
            // Wait for 30 seconds before sending the next message
            $invited->update(['is_send'=> 1]);

            sleep(30);
        }

    }
}
