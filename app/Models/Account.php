<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\NoReturn;

class Account extends Model
{
    protected $fillable = ['name', 'password', 'two_fa_code', 'color', 'attributes', 'description', 'service_id'];

    /**
     * @param string|null $value
     */
    #[NoReturn]
    public function setAttributesAttribute(?string $value)
    {
        $value = is_string($value) ? explode(',', $value) : [];
        $this->attributes['note_attributes'] = json_encode(array_values($value));
    }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
