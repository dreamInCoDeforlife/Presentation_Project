<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleBioTagsLocationLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function($table) {
          $table->string('title')->default('None');
          $table->string('bio')->default('None');
          $table->string('tags')->default('None');
          $table->string('location')->default('None');
          $table->string('linkedin')->default('None');
          $table->string('instagram')->default('None');
          $table->string('twitter')->default('None');
          $table->string('facebook')->default('None');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
