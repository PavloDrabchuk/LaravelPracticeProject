<?php

namespace App\Jobs\Cart;

use App\Models\CartItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreCartItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $cart;

    /**
     * Create a new job instance.
     *
     * @param $request
     * @param $cart
     */
    public function __construct($request, $cart)
    {
        $this->request = $request;
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->saveCartItem();
    }

    private function saveCartItem()
    {
        CartItem::create([
            'cart_id' => $this->cart->id,
            'product_id' => $this->request['product_id'],
            'quantity' => $this->request['quantity'],
        ]);
    }
}
