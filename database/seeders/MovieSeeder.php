<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            [
                'title' => 'Soul',
                'genre' => 'Comedy, Fantasy',
                'rate_per_day' => '50.00',
            ],
            [
                'title' => 'Kingsman: The Secret Service',
                'genre' => 'Action',
                'rate_per_day' => '100.00',
            ],
            [
                'title' => 'Trolls',
                'genre' => 'Comedy',
                'rate_per_day' => '50.00',
            ],
            [
                'title' => "Howl's Moving Castle",
                'genre' => 'Fantasy',
                'rate_per_day' => '50.00',
            ],
            [
                'title' => 'Spirited Away',
                'genre' => 'Fantasy',
                'rate_per_day' => '50.00',
            ],
            [
                'title' => 'The Notebook',
                'genre' => 'Romance',
                'rate_per_day' => '100.00',
            ],
            [
                'title' => 'Mean Girls',
                'genre' => 'Drama',
                'rate_per_day' => '50.00',
            ],
            [
                'title' => 'Barbie',
                'genre' => 'Drama, Comedy',
                'rate_per_day' => '100.00',
            ],
        ];

        foreach($data as $d){
            Movie::create($d);
        }
    }
}
