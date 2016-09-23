<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function ( Blueprint $table )
        {
            $table->increments('id');
            $table->unsignedInteger('settingable_id')
                  ->nullable();
            $table->string('settingable_type')
                  ->nullable();
            $table->index([ 'settingable_id', 'settingable_type' ]);
            $table->string('key');
            $table->json('value');
            $table->softDeletes();
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
        Schema::drop('settings');
    }
}
