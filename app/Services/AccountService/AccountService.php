<?php


namespace App\Services\AccountService;


use App\Repositories\AccountRepository\AccountRepository;

/**
 * @property AccountRepository $accountRepository
 */
interface AccountService
{
    /**
     * AccountService constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository);

    /**
     * @return string
     */
    public function export(): string;

    /**
     * @param string $filePath
     * @return int
     */
    public function import(string $filePath): int;
}
