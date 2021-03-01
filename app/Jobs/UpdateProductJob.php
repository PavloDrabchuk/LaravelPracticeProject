<?php

namespace App\Jobs;

use App\Http\Controllers\PriceController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $product)
    {
        $this->request = $request;
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->updateProduct();
    }

    private function updateProduct()
    {
        $this->product->color()->update([
            'name' => $this->request['color'],
        ]);

        $this->product->update([
            'name' => [
                'ua' => $this->request['nameUA'],
                'en' => $this->request['nameEN'],
                'ru' => $this->request['nameRU'],
            ],
            'category_id' => $this->request['category'],
            'quantity' => $this->request['quantity'],
            'article' => $this->request['article'],
        ]);

        (new PriceController)->convert($this->request['price'], $this->product, 'update');
    }
}
