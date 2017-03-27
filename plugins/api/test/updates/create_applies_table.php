<?php namespace Api\Test\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAppliesTable extends Migration
{
    public function up()
    {
        Schema::create('api_test_applies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('test_title'); // add
            $table->string('test_contents')->nullable(); // add

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_test_applies');
    }
}
