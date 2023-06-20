<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('pagebuilder.storage.database.prefix') . 'page_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->string('locale', 50);
            $table->string('title', 255);
            $table->string('meta_title', 255);
            $table->string('meta_description', 255);
            $table->string('route', 255);
            $table->timestamps();
        });

        // Schema::(config('pagebuilder.storage.database.prefix') . 'page_translations', function (Blueprint $table) {
        //     $table->unique(array(`page_id`,`locale`));
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('pagebuilder.storage.database.prefix') . 'pages', function (Blueprint $table) {
            $table->string('route', 512)->unique()->after('name');
            $table->string('title', 256)->after('name');
        });

        Schema::dropIfExists(config('pagebuilder.storage.database.prefix') . 'page_translations');
    }
}
