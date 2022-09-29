<?php

namespace Tests\Unit;

use App\Models\Author;
use Tests\TestCase;

class AuthorTest extends TestCase {
    /**
    * A basic unit test example.
    *
    * @return void
    */

    public function test_example() {
        $this->assertTrue( true );
    }

    //Check if create page exists

    public function test_create_form() {
        $response = $this->get( '/admin/authors/create' );
        $response->assertStatus( 302 );
    }

}
