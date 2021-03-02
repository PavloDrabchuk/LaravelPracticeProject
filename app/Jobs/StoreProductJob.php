<?php

namespace App\Jobs;

use App\Http\Controllers\PriceController;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->saveProduct();
    }

    private function saveProduct()
    {
        $color = Color::create([
            'name' => $this->request['color'],
        ]);

        $product = Product::create([

            'name' => [
                'ua' => $this->request['nameUA'],
                'en' => $this->request['nameEN'],
                'ru' => $this->request['nameRU'],
            ],
            'category_id' => $this->request['category'],
            'quantity' => $this->request['quantity'],
            'article' => $this->request['article'],
            'color_id' => $color->id,
        ]);

        (new PriceController)->convert($this->request['price'], $product, 'create');
    }
}
