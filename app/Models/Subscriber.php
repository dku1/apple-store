<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscriber extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isEmailSigned($email, Product $product): bool
    {
        if (self::where('email', $email)->where('product_id', $product->id)->first()) {
            return true;
        }
        return false;
    }

    public static function getSubscribersByEmail($email)
    {
        return self::where('email', $email)->where('status', 0)->get();
    }
}
