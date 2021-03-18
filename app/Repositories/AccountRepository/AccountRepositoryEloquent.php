<?php


namespace App\Repositories\AccountRepository;


use App\Models\Account;
use App\Repositories\Repository;

class AccountRepositoryEloquent extends Repository implements AccountRepository
{

    public function getModel(): string
    {
        return Account::class;
    }
}
