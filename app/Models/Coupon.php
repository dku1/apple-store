<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function isActive(): bool
    {
        return $this->status == 1;
    }

    public function isDisposable(): bool
    {
        return $this->disposable == 1;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDisposable($query)
    {
        return $query->where('disposable', 1);
    }

    public function issetDescription(): bool
    {
        return $this->description !== null;
    }

    public function isPercentage(): bool
    {
        return $this->type == 'percentage';
    }

    public function expirationDate(): bool
    {
        return Carbon::now()->format('d-m-Y') <= Carbon::parse($this->end_date)->format('d-m-Y');
    }

    public function deactivation()
    {
        $this->status = 0;
        $this->save();
    }

}
