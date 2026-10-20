<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $fillable = ['code', 'name', 'category', 'stock', 'condition'];

    public function loanItems(): HasMany { return $this->hasMany(LoanItem::class); }
}
