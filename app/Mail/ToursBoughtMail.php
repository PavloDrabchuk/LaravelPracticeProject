<?php

namespace App\Mail;

use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToursBoughtMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Cart
     */
    public $cart;

    /**
     * Create a new message instance.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart=$cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.tours-bought');
    }
}
