<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;


class CategoryTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test retrieving all categories.
     *
     * @return void
     */

    public function test_GetAllCategories()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }


    /**
     * Test retrieving a specific category by ID.
     *
     * @return void
     */
    public function test_GetSingleCategoryById()
    {
        $category = Category::create([
            'name' => 'Home'
        ]);
        $response = $this->get('/api/categories/' . $category->id);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Test creating a new category.
     *
     * @return void
     */
    public function test_createNewCategory()
    {
        $category = Category::make([
            'name' => 'Home'
        ]);
        $category->save();
        $this->get('/api/categories/' . $category->id);
        self::assertTrue($category->count() == 1);
    }

    /**
     * Test updating an existing category.
     *
     * @return void
     */
    public function test_updatingCategory()
    {
        $oldCategory = Category::make([
            'name' => 'Home'
        ]);
        $oldCategory->save();

        $oldCategory->name = 'updatedCategory';
        $oldCategory->save();

        // apply assertion
        $updated = Category::where('name', 'Home')->get();
        $olderParentCategory = Category::where('name', 'parentCategory')->get();

        self::assertCount(1,$updated);
        self::assertCount(0,$olderParentCategory);
    }

    /**
     * Test deleting a category.
     *
     * @return void
     */
    public function test_deleteCategory(){
        $category = Category::create(['name'=>'Home']);

        $response = $this->delete('/api/categories/'.$category->id);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type','text/xml; charset=UTF-8');
    }

}
