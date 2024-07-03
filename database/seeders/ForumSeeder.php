<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;

class ForumSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            'Bachelor of Arts in Broadcasting',
            'Bachelor of Science in Accountancy',
            'Bachelor of Science in Accounting Technology',
            'Bachelor of Science in Accounting Information Systems',
            'Bachelor of Science in Social Work',
            'Bachelor of Science in Information Systems',
            'Associate in Computer Technology',
            'Computer Technology',
            'Computer Programming',
            'Health Care Services',
            'International Cookery',
            'Mass Communication',
            'Nursing Student',
            'Office Management'
        ];

        foreach ($courses as $course) {
            Forum::create(['name' => $course]);
        }
    }
}

