<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateProductQuantityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cart;

    /**
     * Create a new job instance.
     *
     * @param $cart
     */
    public function __construct($cart)
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
        $this->updateProductQuantity();
    }

    private function updateProductQuantity()
    {
        foreach ($this->cart->cartItems as $cartItem) {
            $quantity = Product::whereId($cartItem->product_id)->first()->quantity;

            Product::whereId($cartItem->product_id)->update([
                'quantity' => $quantity - $cartItem->quantity,
            ]);
        }
    }
}
