<?php

namespace App\Jobs\Category;

use App\Http\Requests\StoreAndUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param StoreAndUpdateCategoryRequest $request
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
        $this->saveCategory();
    }

    private function saveCategory()
    {
        Category::create([
            'name' => [
                'ua' => $this->request['nameUA'],
                'en' => $this->request['nameEN'],
                'ru' => $this->request['nameRU'],
            ],
        ]);
    }
}
