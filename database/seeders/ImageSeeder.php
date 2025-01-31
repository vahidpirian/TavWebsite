<?php

namespace Database\Seeders;

use App\Models\Content\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = Image::count();

        if ($images == 0) {
            DB::table('images')->insert(
                [
                    [
                        'image' => 'app-assets/img/01.png',
                        'position' => 1,
                    ],
                    [
                        'image' => 'app-assets/img/02.png',
                        'position' => 2,
                    ],
                    [
                        'image' => 'app-assets/img/03.png',
                        'position' => 3,
                    ],
                ],
            );
        }


    }
}
