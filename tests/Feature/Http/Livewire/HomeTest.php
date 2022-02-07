<?php

namespace Tests\Feature\Http\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSeeLivewire('home')
            ->assertSeeLivewire('components.navigation');
    }
}
