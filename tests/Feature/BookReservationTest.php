<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_library(){

        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'cool title',
            'author'=> 'author1'
        ]);

        $response->assertOk();

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required(){
        $response = $this->post('/books', [
            'title' => '',
            'author'=> 'author1'
        ]);
        $response->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_author_is_required(){

        $response = $this->post('/books', [
            'title' => 'Cool title',
            'author'=> ''
        ]);
        $response->assertSessionHasErrors('author');

    }

    /** @test */
    public function a_book_can_be_updated(){

        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool title',
            'author'=> 'Victor'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/'.$book->id, [
            'title' => 'New title',
            'author'=> 'New Author'
        ]);


        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
    }


}
