<?php

namespace Tests\Feature;

use App\Http\Controllers\CartItemController;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Tests\TestCase;

class CartItemControllerTest extends TestCase
{
    public function test_index_function()
    {
        $this->assertNull((new CartItemController())->index());
    }

    public function test_show_function()
    {
        $this->assertNull((new CartItemController())->show(new CartItem()));
    }

    public function test_update_function()
    {
        $this->assertNull((new CartItemController())->update(new Request(), new CartItem()));
    }
}
