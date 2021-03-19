<?php

namespace App\Rules;

use App\Services\AppServices\AppService;
use Illuminate\Contracts\Validation\Rule;

class UniqueAccountName implements Rule
{
    protected AppService $appService;

    /**
     * UniqueAccountName constructor.
     * @param int $service_id
     */
    public function __construct(protected int $service_id)
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
        $account = $service->whereName($value);
        return $account ? true : false;
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
