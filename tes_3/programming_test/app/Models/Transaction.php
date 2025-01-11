<?php

namespace App\Models;

use App\Models\Transactiondetail;  // Pastikan nama model sesuai
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';  // Pastikan nama tabel benar
    protected $fillable = ['no_transaction', 'transaction_date'];

    public function transactionDetails() {
        // Gunakan nama relasi dalam bentuk jamak karena ini adalah relasi hasMany
        return $this->hasMany(Transactiondetail::class, 'transaction_id', 'id');
    }

    // Menggunakan withCount() untuk menghitung jumlah item
    public function getTotalItemAttribute() {
        return $this->transactionDetails()->count();
    }

    // Menggunakan withSum() untuk menghitung total quantity
    public function getTotalQuantityAttribute() {
        return $this->transactionDetails()->sum('quantity');
    }
}
