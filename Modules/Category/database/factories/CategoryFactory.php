<?php

namespace Modules\Category\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Enums\CategoryStatus;
use Modules\Category\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Category\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(CategoryStatus::getAllNames()),
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Indicate that the category should have a parent.
     *
     * @param \Modules\Category\Models\Category|null $parentCategory
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withParent(Category|null $parentCategory = null)
    {
        return $this->state(function (array $attributes) use ($parentCategory) {
            return [
                'parent_id' => $parentCategory?->id ?? Category::factory(),
            ];
        });
    }
}
