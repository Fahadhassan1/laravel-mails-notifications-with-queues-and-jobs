<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'user_id',
        'status'
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    // accessors
    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }
    // mutators
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '', $value);
    }
  
    public function category()
    {
        return $this->belongsToMany(Categories::class, 'category_product', 'product_id', 'category_id');
    }
}
