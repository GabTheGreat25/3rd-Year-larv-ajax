<?php

namespace App\Listeners;

use App\Events\SendAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\admin;
use Mail;
use DB;
class SendAdminFired
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
     * @param  \App\Events\SendAdmin  $event
     * @return void
     */
    public function handle(SendAdmin $event)
    {

       $admin = $event->admin;
       $admin = admin::where('admin_id',$event->admin->admin_id)->first();

        Mail::send( 'email.user_notification', ['full_name' => $admin->full_name, 'age' => $admin->age], function($message) use ($admin) {
            $message->from('redframecamera@gmail.com.ph');
            $message->to(DB::table('admin')->leftJoin('users', 'users.id', '=', 'admin.user_id')->orderBy("admin.created_at", "DESC")->pluck('users.email')->first());
            $message->subject('Thank you');
            $message->attach(public_path('/folder/thank_you.jpg'));
        });
    }
}