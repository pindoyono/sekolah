<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rombel(): BelongsTo
    {
        return $this->belongsTo(Rombel::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }
}
