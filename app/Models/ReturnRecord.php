<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnRecord extends Model
{
    protected $fillable = ['loan_id', 'returned_at', 'condition', 'notes'];
    protected function casts(): array { return ['returned_at' => 'datetime']; }
    public function loan(): BelongsTo { return $this->belongsTo(Loan::class); }
}
