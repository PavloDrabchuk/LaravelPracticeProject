<?php

namespace App\Jobs;

use App\Models\Price;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StorePriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $value;
    protected $currency_id;
    protected $product_id;

    /**
     * Create a new job instance.
     *
     * @param $value
     * @param $currency_id
     * @param $product_id
     */
    public function __construct($value, $currency_id, $product_id)
    {
        $this->value = $value;
        $this->currency_id = $currency_id;
        $this->product_id = $product_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->savePrice();
    }

    private function savePrice()
    {
        Price::create([
            'value' => $this->value,
            'currency_id' => $this->currency_id,
            'product_id' => $this->product_id,
        ]);
    }
}
