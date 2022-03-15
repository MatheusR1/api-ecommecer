<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class GrupoCidade extends Model
{
    use HasFactory;

    protected $table  = 'grupo_cidades';

    protected  $fillable = [];

    public function __construct()
    {
        $this->fillable = Schema::getColumnListing($this->table);   
    }

    public static function validadorCidadeCampanha(Array $ids) : bool
    {
        return self::where('id_cidade', $ids['id_cidade'])
            ->where('id_campanha', $ids['id_estado'])
            ->exists();
    }
}
