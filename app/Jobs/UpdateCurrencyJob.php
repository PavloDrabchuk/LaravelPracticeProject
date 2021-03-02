<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCurrencyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $currency;

    /**
     * Create a new job instance.
     *
     * @param $request
     * @param $currency
     */
    public function __construct($request, $currency)
    {
        $this->request = $request;
        $this->currency = $currency;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->updateCurrency();
    }

    private function updateCurrency()
    {
        $this->currency->update([
            'code' => $this->request['code'],
            'sign' => $this->request['sign'],
        ]);
    }
}
