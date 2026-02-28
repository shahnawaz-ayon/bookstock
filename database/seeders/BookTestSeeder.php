<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookTestSeeder extends Seeder
{
    public function run()
    {   $this->call([
        BookTestSeeder::class,]);
        // 1. Clear existing data to start fresh (Optional)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('books')->truncate();
        DB::table('authors')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Insert Fake Authors
        $authorId = DB::table('authors')->insertGetId([
            'name' => 'John Doe',
            'bio' => 'A famous mystery novelist.',
            'created_at' => now(),
        ]);

        // 3. Insert Fake Categories
        $categoryId = DB::table('categories')->insertGetId([
            'name' => 'Fiction',
            'created_at' => now(),
        ]);

        // 4. Insert Fake Books
        DB::table('books')->insert([
            // Change the null value to a string
            [
                'title' => 'Eloquent vs Query Builder',
                'isbn' => '978-0987654321',
                'author_id' => $authorId,
                'category_id' => $categoryId,
                'cover_image' => 'covers/default.png', // Don't use null here
                'published_at' => '2024-05-12',
                'description' => 'The ultimate battle.',
                'created_at' => now(),
            ],
            [
                'title' => 'Eloquent vs Query Builder',
                'isbn' => '978-0987654321',
                'author_id' => $authorId,
                'category_id' => $categoryId,
                'cover_image' => null,
                'published_at' => '2024-05-12',
                'description' => 'The ultimate battle.',
                'created_at' => now(),
            ]
        ]);
    }
}