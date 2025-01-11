<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactiondetail extends Model
{
    protected $table = 'transactiondetails';  // Nama tabel sesuai dengan konvensi
    protected $fillable = ['transaction_id', 'item', 'quantity'];

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
}
