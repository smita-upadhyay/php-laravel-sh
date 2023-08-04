<?php

namespace Tests\Feature;
use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /** @test */
    public function test_view_books(){
        $response=$this->get('/books');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_view_form(){
        $response=$this->get('/books/form');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_create_books_without_data(){
        $response=$this->post('/books/create');
        $response->assertStatus(500);
    }

    public function test_store_new_book(){
        $response=$this->post('/books/create',[
            'title' => 'Book6',
            'author' => 'Shubham J',
            'price' => '159'
        ]);

        $response->assertRedirect('/books');
    }

    public function test_edit(){
        $response=$this->get('/books/update');
        $response->assertStatus(200);
        // $response->assertRedirect('/');
    }

    public function test_welcome(){
        $response=$this->get('/');
        $response->assertStatus(200);
    }

    public function test_delete_book(){
        $book=Books::first();
        // $this->deleteJson('book.delete',$book->book_id)->assertStatus(200);
        $response=$this->get('/books/delete/29');
        // $response->assertRedirect('/books');
        $response->assertStatus(302);
        // $this->assertCount(1,Books::all());
    }

    // public function test_delete(){
    //     $b=Books::all();
    //     $response=$this->;
    // }

    public function test_database(){
        $this->assertDatabaseHas('books',[
            'author' => 'Shubham J'
        ]);
    }

    public function test_missing_db_records(){
        $this->assertDatabaseMissing('books',[
            'author' => 'john'
        ]);
    }
}
