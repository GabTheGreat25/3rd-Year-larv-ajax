<?php

namespace App\Listeners;

use App\Events\SendClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\client;
use Mail;
use DB;
class SendClientFired
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
     * @param  \App\Events\SendClient  $event
     * @return void
     */
    public function handle(SendClient $event)
    {

       $client = $event->client;
       $client = client::where('client_id',$event->client->client_id)->first();

        Mail::send( 'email.user_notification', ['full_name' => $client->full_name, 'age' => $client->age], function($message) use ($client) {
            $message->from('redframecamera@gmail.com.ph');
            $message->to(DB::table('client')->leftJoin('users', 'users.id', '=', 'client.user_id')->orderBy("client.created_at", "DESC")->pluck('users.email')->first());
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}