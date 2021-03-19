<?php

namespace App\Rules;

use App\Services\AppServices\AppService;
use Illuminate\Contracts\Validation\Rule;

class RenameAccountAvailable implements Rule
{
    protected AppService $appService;

    /**
     * Create a new rule instance.
     * @param int $service_id
     * @param int $account_id
     */
    public function __construct(
        protected int $service_id,
        protected int $account_id
    )
    {
        $this->appService = app(AppService::class);
    }

    /**
     * Determine if the validation rule passes.
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $service = $this->appService->appServiceRepository->find($this->service_id);
        if (!$service) return false;
        $account = $service->accounts()->whereNotIn('id', [$this->account_id])->whereName($value)->first();
        return !(bool)$account;
    }

    /**
     * Get the validation error message.
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute exist in this service !';
    }
}
