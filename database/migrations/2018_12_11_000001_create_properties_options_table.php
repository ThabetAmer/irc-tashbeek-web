<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Sync\StructureFactory;

class CreatePropertiesOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_options', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedInteger('property_meta_data_id')->index();

            $table->string('commcare_id', 255)->index();

            $table->json('name');

            $table->foreign('property_meta_data_id')->references('id')->on('properties_meta_data')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties_options');
    }
}
