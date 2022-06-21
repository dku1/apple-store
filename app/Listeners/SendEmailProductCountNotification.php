<?php

namespace App\Listeners;

use App\Events\ProductCountUpdated;
use App\Mail\SendSubscribersMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailProductCountNotification
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
     * @param ProductCountUpdated $event
     * @return void
     */
    public function handle(ProductCountUpdated $event)
    {
        foreach ($event->product->getSubscribers() as $subscriber) {
            Mail::to($subscriber->email)->send(new SendSubscribersMail($event->product));
            $subscriber->status = 1;
            $subscriber->save();
        };
    }
}
