<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToVideosTable extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            // Step 1: Add the column as nullable
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Step 2: Update existing records to set a default user_id (e.g., 1)
        DB::table('videos')->update(['user_id' => 1]);

        Schema::table('videos', function (Blueprint $table) {
            // Step 3: Make the column non-nullable and add the foreign key constraint
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
