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
        $this->cart = $cart;
    }

    public function getTotalCost()
    {
        $totalCost = 0;
        foreach ($this->cart->cartItems as $cartItem) {
            //$totalCost += $cartItem->quantity;
            $totalCost += $cartItem->product->prices->first()->value * $cartItem->quantity;
        }
        return $totalCost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('solar.power.plant.system@gmail.com', 'Laravel project')
            ->subject('Tours order')
            ->view('emails.tours-bought')
            ->with([
                'totalCost' => $this->getTotalCost(),
            ]);
    }
}
