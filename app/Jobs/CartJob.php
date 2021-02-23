<?php

namespace App\Jobs;

use App\Mail\ToursBoughtMail;
use App\Models\Admin;
use App\Models\Cart;
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

    protected  $cart;

    /**
     * Create a new job instance.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emails_json = json_decode(Admin::select('email')->get(), true);
        $emails = [];
        foreach ($emails_json as $key => $value) {
            $emails[] = $value['email'];
        }

        Log::info('cart'.$this->cart);

        //Mail::to('ravluk2000@gmail.com')->send(new ToursBoughtMail($this->cart));
        Mail::to($emails)->send(new ToursBoughtMail($this->cart));

    }
}
