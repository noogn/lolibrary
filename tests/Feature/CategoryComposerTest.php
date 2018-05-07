<?php

namespace Tests\Feature;

use Mockery;
use App\Category;
use App\Composers\Categories;
use Illuminate\View\View;

class CategoryComposerTest extends TestCase
{
    /**
     * Test the categories view composer works.
     *
     * @return void
     */
    public function testCategoryComposing()
    {
        $mock = Mockery::mock(View::class);
        $mock->shouldReceive('with')->once()->andReturnUsing(function ($key, $value) {
            $this->assertEquals('categories', $key);
            $this->assertEquals(Category::all()->toSelectArray(), $value);
        });

        $composer = new Categories();
        $composer->compose($mock);
    }
}
