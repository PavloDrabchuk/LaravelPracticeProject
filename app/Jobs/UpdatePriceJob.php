<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $value;
    protected $currency_id;
    protected $product;

    /**
     * Create a new job instance.
     *
     * @param $value
     * @param $currency_id
     * @param $product
     */
    public function __construct($value, $currency_id, $product)
    {
        $this->value = $value;
        $this->currency_id = $currency_id;
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->updatePrice();
    }

    private function updatePrice()
    {
        $this->product->prices()->where('currency_id', '=', $this->currency_id)->updateOrCreate([
            'currency_id' => $this->currency_id,
            'product_id' => $this->product->id,
        ],
            ['value' => round($this->value, 2)]);

    }
}
