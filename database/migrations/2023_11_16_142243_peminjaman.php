<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            
            $table->string('user_name');
            $table->foreign('user_name')->references('name')->on('users');

            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');

            $table->boolean('is_confirmed');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_peminjaman_disetujui')->nullable();
            
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
