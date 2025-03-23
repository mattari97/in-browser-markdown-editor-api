<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
            'body' => $this->createMarkdownBody(),
        ];
    }

    private function createMarkdownBody()
    {
        return implode("\n\n", [
            "# {$this->faker->sentence()}",
            $this->faker->paragraph(),
            '- ' . implode("\n- ", $this->faker->sentences(3)),
            "## {$this->faker->sentence()}",
            $this->faker->paragraph(),
            "```php\n\$value = \"Example Code\";\necho \$value;\n```",
            "## {$this->faker->sentence()}",
            $this->faker->paragraph(),
            $this->faker->paragraph(),
        ]);
    }
}
