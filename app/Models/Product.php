<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }

    public function getSubscribers()
    {
       return Subscriber::where('product_id', $this->id)->where('status', 0)->get();
    }


    public function addModifiers($modifiersIds)
    {
        foreach ($modifiersIds as $modifiersId){
            $this->modifiers()->attach($modifiersId, ['product_id' => $this->id]);
        }
    }

    public function countRemove($quantity): bool
    {
        if ($this->count >= $quantity){
            $this->count = $this->count - $quantity;
            $this->save();
            return true;
        }
        return false;
    }

    public function available(int $count = 1): bool
    {
        return $this->count >= $count;
    }

    public function isNew(): bool
    {
        return $this->new == 1;
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function isRecommend(): bool
    {
        return $this->recommend == 1;
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }

    public function isPopular(): bool
    {
        return $this->popular == 1;
    }

    public function scopePopular($query)
    {
        return $query->where('popular', 1);
    }

    public function issetFilter()
    {
        if ($this->isNew() or $this->isPopular() or $this->isRecommend()){
            return true;
        }
        return false;
    }
}
