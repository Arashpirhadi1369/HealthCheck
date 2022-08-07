<?php

namespace App\Jobs;

use App\Models\Hamkaran;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class HealthCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Http::get("http://localhost:7001/oa");
        } catch (\Throwable $th) {
            $hamkaran = new Hamkaran();

            $hamkaran->save();

            exec('C:\bea\user_projects\domains\oadomain\bin\startWebLogic.cmd');
        }
    }
}
