<?php


namespace App\Services\AccountService;


use App\Repositories\AccountRepository\AccountRepository;

class AccountServiceImplementing implements AccountService
{

    public function __construct(public AccountRepository $accountRepository)
    {
    }
}
