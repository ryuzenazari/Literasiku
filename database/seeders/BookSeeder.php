<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publication_year' => 2005,
                'category' => 'Novel',
                'pages' => 529,
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publication_year' => 1980,
                'category' => 'Novel',
                'pages' => 535,
            ],
            [
                'title' => 'Matematika Dasar',
                'author' => 'Dr. Bambang Soedjono',
                'publication_year' => 2020,
                'category' => 'Pendidikan',
                'pages' => 300,
            ],
            [
                'title' => 'Sejarah Indonesia',
                'author' => 'Prof. Sartono Kartodirdjo',
                'publication_year' => 2018,
                'category' => 'Sejarah',
                'pages' => 450,
            ],
            [
                'title' => 'Teknologi Informasi',
                'author' => 'Ir. Suharto',
                'publication_year' => 2022,
                'category' => 'Teknologi',
                'pages' => 280,
            ],
            [
                'title' => 'Fisika Modern',
                'author' => 'Dr. Albert Einstein',
                'publication_year' => 2019,
                'category' => 'Sains',
                'pages' => 400,
            ],
            [
                'title' => 'Petualangan Sherlock Holmes',
                'author' => 'Arthur Conan Doyle',
                'publication_year' => 1887,
                'category' => 'Fiksi',
                'pages' => 320,
            ],
            [
                'title' => 'Panduan Kewirausahaan',
                'author' => 'Prof. Ciputra',
                'publication_year' => 2021,
                'category' => 'Pendidikan',
                'pages' => 250,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
