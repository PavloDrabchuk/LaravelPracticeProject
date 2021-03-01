<?php

namespace App\Jobs;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuyToursJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cart;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handle()
    {
        if ($this->checkQuantity() && CartItem::whereCartId($this->cart->id)->first()) {
            $this->updateProductQuantity();
        } else {
            return response([
                "message" => "These tours are over."
            ], 400);
        }

        CartJob::dispatch($this->cart)
            ->onQueue('emails');

        return response(["message" => "Tours purchased successfully."], 200);
    }

    private function checkQuantity()
    {
        $checkQuantity = true;

        foreach ($this->cart->cartItems as $cartItem) {
            if ((Product::whereId($cartItem->product_id)->first()->quantity - $cartItem->quantity) < 0) {
                $checkQuantity = false;
                break;
            }
        }

        return $checkQuantity;
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
