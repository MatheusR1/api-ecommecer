<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadosBrasileiros = array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO");

        for ($i = 0 , $j = 1; $i < count($estadosBrasileiros); $i++) {
            $j = $i + 1;
            Estado::create(
                [
                    'id' =>  $j,
                    'nome' => $estadosBrasileiros[$i]
                ]
            );
        }
    }
}
