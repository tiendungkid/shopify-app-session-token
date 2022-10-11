<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Secomapp\Models\Shop;

class TestAppCommand extends Command
{
    protected $signature = 'app:test';

    public function handle()
    {
        $shop = Shop::find(7);
        $shopApi = new \Secomapp\Resources\Shop(generateClientApi($shop));
        dd($shopApi->get());
    }
}
