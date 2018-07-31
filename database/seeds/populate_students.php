<?php

use Illuminate\Database\Seeder;
use App\Student;

class populate_students extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name' => 'Eder',
            'email' => 'efranco23@gmailc.om',
            'ra' => 99023112
        ]);
        Student::create(['name' => 'João', 'email' => 'jb@email','ra' => 12233]);
        Student::create(['name' => 'Jessica', 'email' => 'jo@email','ra' => 1234]);
        Student::create(['name' => 'Elisson', 'email' => 'el@email','ra' => 22233]);
        Student::create(['name' => 'Rafael', 'email' => 'rf@email','ra' => 10022]);
    }
}
