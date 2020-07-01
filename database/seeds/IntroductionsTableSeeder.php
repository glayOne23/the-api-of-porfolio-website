<?php

use App\Introduction;
use Illuminate\Database\Seeder;

class IntroductionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $introduction = Introduction::create([
            'name' => 'Jajang',
            'greatings' => json_encode(["Welcome", "Nice to meet you"]),
            'description' => 'I love to code and always eager to learn new things. Previously I have learned the PHP, java, python programming language. I have built some projects using Laravel and Django Rest Framework',
            'connect' => 'https://www.linkedin.com/in/muhammad-hammam-islami-832b35112/'
        ]);
    }
}
