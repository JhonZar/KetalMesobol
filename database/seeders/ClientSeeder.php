<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create(['nombre' => 'Alicia Ramos', 'ci' => '48392012', 'direccion' => 'La Paz', 'telefono' => '79831245', 'email' => 'alicia@gmail.com']);
        Cliente::create(['nombre' => 'Mario Vargas', 'ci' => '23456789', 'direccion' => 'Cochabamba', 'telefono' => '70708090', 'email' => 'mariov@gmail.com']);
        Cliente::create(['nombre' => 'Carla Espinoza', 'ci' => '87654321', 'direccion' => 'Tarija', 'telefono' => '68675432', 'email' => 'carlae@gmail.com']);
        Cliente::create(['nombre' => 'Jorge Paredes', 'ci' => '54321678', 'direccion' => 'Potosi', 'telefono' => '75432109', 'email' => 'jorgep@gmail.com']);
        Cliente::create(['nombre' => 'Daniela Cruz', 'ci' => '19283746', 'direccion' => 'Oruro', 'telefono' => '76234567', 'email' => 'danielac@gmail.com']);
        Cliente::create(['nombre' => 'Roberto Blanco', 'ci' => '67584930', 'direccion' => 'Santa Cruz', 'telefono' => '65879432', 'email' => 'robertob@gmail.com']);
        Cliente::create(['nombre' => 'Elena Suárez', 'ci' => '98765432', 'direccion' => 'Sucre', 'telefono' => '79831212', 'email' => 'elenas@gmail.com']);
        Cliente::create(['nombre' => 'Pedro Zamora', 'ci' => '36925814', 'direccion' => 'Beni', 'telefono' => '73658941', 'email' => 'pedroz@gmail.com']);
        Cliente::create(['nombre' => 'Lucía Méndez', 'ci' => '15975328', 'direccion' => 'Pando', 'telefono' => '68247159', 'email' => 'luciam@gmail.com']);
    }
}
