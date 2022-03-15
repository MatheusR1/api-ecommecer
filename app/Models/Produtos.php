<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Produtos extends Model
{
    use HasFactory;

    protected  $fillable = [];

    public function __construct()
    {
        $this->fillable = Schema::getColumnListing();
    }
}
