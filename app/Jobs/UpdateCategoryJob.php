<?php

namespace App\Jobs;

use App\Http\Requests\StoreAndUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $category;

    /**
     * Create a new job instance.
     *
     * @param StoreAndUpdateCategoryRequest $request
     * @param Category $category
     */
    public function __construct($request, $category)
    {
        $this->request = $request;
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->updateCategory();
    }

    private function updateCategory()
    {
        $this->category->update([
            'name' => [
                'ua' => $this->request['nameUA'],
                'en' => $this->request['nameEN'],
                'ru' => $this->request['nameRU'],
            ],
        ]);
    }
}
