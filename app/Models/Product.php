<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';

    protected $guarded = [];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // public function getImageUrlAttribute()
    // {
    //     // Cek apakah ada path gambar dan disknya adalah S3
    //     if ($this->image && config('filesystems.default') === 's3') {
    //         return Storage::disk('s3')->url($this->image);
    //     }
    //     // Jika tidak ada gambar atau disk bukan S3, atau URL lokal (jika Anda setup untuk itu)
    //     // Anda bisa return placeholder atau path lokal jika diperlukan
    //     return $this->image ? Storage::url($this->image) : asset('path/to/default/image.png');
    // }
}