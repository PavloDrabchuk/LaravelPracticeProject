<?php

namespace App\Jobs;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to_email = 'ravluk2000@gmail.com';

        $emails_json = json_decode(Admin::select('email')->get(), true);
        $emails = [];
        foreach ($emails_json as $key => $value) {
            //Log::info($value['email']);
            $emails[] = $value['email'];
        }
        $data = array('name' => "name", "body" => "A test mail");

        Mail::send([], $data, function ($message) use ($emails) {
            $message->to($emails)
                ->subject('Laravel Test Mail');
            $message->from('solar.power.plant.system@gmail.com', 'Test Mail');
        });

    }
}
