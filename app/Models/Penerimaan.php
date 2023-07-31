<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Carbon;

class Penerimaan extends Model
{
    use HasFactory;
    protected $table = "penerimaan";
    protected $tanggal_kegiatan = ['tanggal'];
    protected $fillable = ['no_kwitansi', 'nama', 'tanggal', 'keterangan', 'jumlah', 'created_user'];

    // public function getTanggalAttribute() {
    //     return Carbon::parse($this->attributes['tanggal'])->translatedFormat('l, d F Y');
    // }
}
