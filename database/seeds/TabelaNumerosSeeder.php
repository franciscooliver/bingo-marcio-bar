<?php

use Illuminate\Database\Seeder;
use App\Bingo;

class TabelaNumerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_numeros = range(1,75);
        foreach ($array_numeros as $num){
            Bingo::create([
                "numeros" => $num
        ]);
        }
    }
}
