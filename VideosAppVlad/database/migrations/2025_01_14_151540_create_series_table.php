<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the series
            $table->text('description')->nullable(); // Description of the series
            $table->string('image')->nullable(); // URL or path to the image
            $table->string('user_name'); // Name of the user who created the series
            $table->string('user_photo_url')->nullable(); // URL to the user's photo
            $table->timestamp('published_at')->nullable(); // Publication date
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
