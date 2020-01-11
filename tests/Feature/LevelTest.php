<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LevelTest extends TestCase
{

    /**
     * Get a list of all levels
     * @return void
     */
    public function testGetLevels()
    {
        $response = $this->get('api/levels');

        $response->assertStatus(401);
    }
}
