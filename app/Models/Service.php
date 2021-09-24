<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{

    protected $fillable = ['name', 'home_link'];

    /**
     * @return HasMany
     * @Description return accounts
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'service_id');
    }
}
