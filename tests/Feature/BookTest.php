<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service\BookService;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testTambahBuku(): void
    {
        $book = $this->app->make(BookService::class);
        self::assertEquals(1, $book->tambahBuku('contoh judul', 'contoh category', 'contoh penulis', 1));
    }
}
