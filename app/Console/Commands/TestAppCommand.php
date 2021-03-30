<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;

class TestAppCommand extends Command
{
    protected $signature = 'ok:test';
    protected $description = 'Test app';

    public function handle()
    {
        $query = 'youtube.com';
        Account::whereIN('service_id', [])
            ->orWhere("attributes", "LIKE", "%{$query}%")
            ->with('service')
            ->dd();
    }
}
