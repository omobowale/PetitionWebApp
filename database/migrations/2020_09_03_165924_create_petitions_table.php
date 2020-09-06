<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->string('petition_title');
            $table->string('signature_target');
            $table->text('petition_description');
            $table->string('petition_preview_video')->nullable();
            $table->string('featured_video_url')->nullable();
            $table->string('video_headline')->nullable();
            $table->text('video_details')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('letter');
            $table->string('letter_recipient');
            $table->string('update_title')->nullable();
            $table->string('update_details')->nullable();
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
        Schema::dropIfExists('petitions');
    }
}
