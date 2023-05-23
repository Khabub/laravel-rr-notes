<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notes>
 */
class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* $note = fake()->realText(100);
        $encryptedNote = Crypt::encryptString($note);

        $title = fake()->sentence(1);
        $encryptedTitle = Crypt::encryptString($title); */

        return [            
             'title' => fake()->sentence(1),
            // 'title' => $encryptedTitle,
            'note' => fake()->realText(100),
            // 'note' => $encryptedNote,
            'importance' => rand(1, 3),
        ];
    }
}
