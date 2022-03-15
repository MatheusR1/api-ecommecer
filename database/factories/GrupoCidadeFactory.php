<?php

namespace Database\Factories;

use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GrupoCidade>
 */
class GrupoCidadeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $estadosBrasileiros = array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO");
        $randomEstados  = rand(1, 26);
        $cidades = Cidade::all()->toArray();
        $randomCidades = rand(0,9);
        $grupoCidadeName = $estadosBrasileiros[$randomEstados] .'/'. $cidades[$randomCidades]['nome'];

        return [
            'nome' => $grupoCidadeName,
            'id_cidade' => $randomCidades == 0 ? 1 : $randomCidades,
            'id_campanha' => rand(1 , 10)
        ];
    }
}
