<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Campanha extends Model
{
    use HasFactory;

    protected $table = 'campanhas';

    protected  $fillable = [];

    public function __construct()
    {
        $this->fillable = Schema::getColumnListing($this->table);
    }
}
