<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul artikel
            $table->string('slug')->unique(); // Slug yang unik untuk URL
            $table->text('content'); // Isi konten artikel
            $table->json('call_to_action')->nullable(); // Call to action berupa array
            $table->string('banner_image')->nullable(); // Path gambar banner
            $table->boolean('is_published')->default(false); // Status publikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
