<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAllCategories()
    {
        Category::factory()->count(5)->create();

        $response = $this->get('/categories');

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testGetCategoryById()
    {
        $category = Category::factory()->create();

        $response = $this->get('/categories/' . $category->id);

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testGetCategoryByIdNotFound()
    {
        $response = $this->get('/categories/999');

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testCreateCategory()
    {
        $data = [
            'name' => 'New Category',
            'parent_id' => null
        ];

        $response = $this->post('/categories', $data);

        $response->assertStatus(201)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testCreateCategoryWithParent()
    {
        $parent = Category::factory()->create();
        $data = [
            'name' => 'New Category',
            'parent_id' => $parent->id
        ];

        $response = $this->post('/categories', $data);

        $response->assertStatus(201)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testCreateCategoryWithInvalidParent()
    {
        $data = [
            'name' => 'New Category',
            'parent_id' => 999
        ];

        $response = $this->post('/categories', $data);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testUpdateCategory()
    {
        $category = Category::factory()->create();
        $data = [
            'name' => 'Updated Category'
        ];

        $response = $this->put('/categories/' . $category->id, $data);

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testUpdateCategoryNotFound()
    {
        $data = [
            'name' => 'Updated Category'
        ];

        $response = $this->put('/categories/999', $data);

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testDeleteCategory()
    {
        $category = Category::factory()->create();

        $response = $this->delete('/categories/' . $category->id);

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'text/xml');
    }

    public function testDeleteCategoryNotFound()
    {
        $response = $this->delete('/categories/999');

        $response->assertStatus(404)
            ->assertHeader('Content-Type', 'text/xml');
    }
}
