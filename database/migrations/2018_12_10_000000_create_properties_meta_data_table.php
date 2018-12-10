<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Sync\StructureFactory;

class CreatePropertiesMetaDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_meta_data', function (Blueprint $table) {

            $table->increments('id');

            $table->string('case_type',20)->index();

            $table->string('commcare_id', 255)->index();

            $table->json('attributes')->nullable();

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
        Schema::dropIfExists('properties_meta_data');
    }
}
