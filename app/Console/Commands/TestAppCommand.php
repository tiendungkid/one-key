<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class TestAppCommand extends Command
{
    protected $signature = 'ok:test';
    protected $description = 'Test app';

    public function handle()
    {
    }
}
