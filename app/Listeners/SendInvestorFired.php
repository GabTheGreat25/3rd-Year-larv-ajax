<?php

namespace App\Listeners;

use App\Events\SendInvestor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\investor;
use Mail;
use DB;
class SendInvestorFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendInvestor  $event
     * @return void
     */
    public function handle(SendInvestor $event)
    {

       $investor = $event->investor;
       $investor = investor::where('investor_id',$event->investor->investor_id)->first();

        Mail::send( 'email.user_notification', ['full_name' => $investor->full_name, 'age' => $investor->age], function($message) use ($investor) {
            $message->from('redframecamera@gmail.com.ph');
            $message->to(DB::table('investor')->leftJoin('users', 'users.id', '=', 'investor.user_id')->orderBy("investor.created_at", "DESC")->pluck('users.email')->first());
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}