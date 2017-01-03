<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePictureColumnNamesInPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->renameColumn('poster_picture_path','poster_picture');
            $table->renameColumn('picture1_path','screenshot1');
            $table->renameColumn('picture2_path','screenshot2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->renameColumn('poster_picture','poster_picture_path');
            $table->renameColumn('screenshot1','picture1_path');
            $table->renameColumn('screenshot2','picture2_path');
        });
    }
}
