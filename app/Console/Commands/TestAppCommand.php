<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Secomapp\Models\Shop;

class TestAppCommand extends Command
{
    protected $signature = 'app:test';

    public function handle()
    {
        Shop::findByDomain('tiendungkid2.myshopfiy.com')->first()->delete();
    }
}
