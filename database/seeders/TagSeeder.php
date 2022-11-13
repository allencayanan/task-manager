<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    private $tags = [
        'urgent',
        'backlog',
        'due on monday',
        'dev',
        'manager',
        'bug',
        'issue',
        'non-priority',
        'logs',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
