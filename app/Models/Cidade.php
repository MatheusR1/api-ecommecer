<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Cidade extends Model
{
    use HasFactory;

    protected $table = 'cidades';

    protected  $fillable = [];

    public function __construct()
    {
        $this->fillable = Schema::getColumnListing($this->table);
    }
}
