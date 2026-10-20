<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    protected $fillable = ['user_id', 'loan_date', 'due_date', 'status', 'notes'];

    protected function casts(): array
    {
        return ['loan_date' => 'date', 'due_date' => 'date'];
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function items(): HasMany { return $this->hasMany(LoanItem::class); }
    public function returnRecord(): HasOne { return $this->hasOne(ReturnRecord::class); }
}
