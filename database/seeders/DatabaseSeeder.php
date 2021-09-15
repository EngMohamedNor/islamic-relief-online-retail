<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        
DB::table('products')->insert([
    'name' => 'Sugar',
  'description' => 'High quality sugar',
    'photo' => 'https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fstatic.onecms.io%2Fwp-content%2Fuploads%2Fsites%2F19%2F2020%2F02%2F05%2Fsugar-spoon-hero-2000.jpg&q=85',
    'price' => 2.0
 ]);


DB::table('products')->insert([
    'name' => 'Salt',
 'description' => 'Organic Salt ',
    'photo' => 'https://cdn.pixabay.com/photo/2018/04/02/20/17/salt-3285024_1280.jpg',
    'price' => 0.4
 ]);


DB::table('products')->insert([
    'name' => 'Milk',
    'description' => 'High quality organic milk  ',
    'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6_mIphxreNMyEHXFYK0365t3XUkknPm7o2A&usqp=CAU',
    'price' => 1.50
 ]);


DB::table('products')->insert([
    'name' => 'Wheat flour',
 'description' => 'Grade A Wheat flour',
    'photo' => 'https://live.staticflickr.com/65535/50867817003_224d074b48_b.jpg',
    'price' => 2.0
 ]);




DB::table('products')->insert([
    'name' => 'Maize flour',
   'description' => 'Organic Maize flour',
    'photo' => 'https://live.staticflickr.com/65535/49941195222_89916192dc_b.jpg',
    'price' => 1.5
 ]);


DB::table('products')->insert([
    'name' => 'Cooking Oil',
'description' => 'High Quality Cooking Oil',
    'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScqrTR8XNdOthEaZ1N6dJQJ_lC2dhabBEh5g&usqp=CAU',
    'price' => 2.35
 ]);
    }
}
