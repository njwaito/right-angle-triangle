<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrianglesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triangles', function (Blueprint $table) {
            $table->id();
            $table->decimal( 'theta', 8, 2 );
            $table->decimal( 'a', 8, 2 );
            $table->decimal( 'b', 8, 2 );
            $table->decimal( 'c', 8, 2 );
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
        Schema::dropIfExists('triangles');
    }
}
