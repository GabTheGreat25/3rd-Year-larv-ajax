<?php

namespace App\Listeners;

use App\Events\SendOperator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\operator;
use Mail;
use DB;
class SendOperatorFired
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
     * @param  \App\Events\SendOperator  $event
     * @return void
     */
    public function handle(SendOperator $event)
    {

       $operator = $event->operator;
       $operator = operator::where('operator_id',$event->operator->operator_id)->first();

        Mail::send( 'email.user_notification', ['full_name' => $operator->full_name, 'age' => $operator->age], function($message) use ($operator) {
            $message->from('redframecamera@gmail.com.ph');
            $message->to(DB::table('operator')->leftJoin('users', 'users.id', '=', 'operator.user_id')->orderBy("operator.created_at", "DESC")->pluck('users.email')->first());
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}