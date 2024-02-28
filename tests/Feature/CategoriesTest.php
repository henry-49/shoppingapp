<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_categorypage_contains_empty_table(): void
    {
        $response = $this->get('/categories');

        $response->assertStatus(200);

        $response->assertSee(__('All Categories'));
    }


    public function test_categorypage_non_contains_empty_table(): void
    {
        /* Category::create([
            'category_name' => 'testCategory',
        ]); */

        $response = $this->get('/categories');

        $response->assertStatus(200);

        //$response->assertDontSee(__('All Categories'));
    }
}