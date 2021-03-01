<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class UpdateAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $admin;

    /**
     * Create a new job instance.
     *
     * @param $request
     * @param $admin
     */
    public function __construct($request, $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->updateAdmin();
    }

    private function updateAdmin()
    {
        $this->admin->update([
            'name' => $this->request['name'],
            'password' => Hash::make($this->request['password']),
        ]);
    }
}
