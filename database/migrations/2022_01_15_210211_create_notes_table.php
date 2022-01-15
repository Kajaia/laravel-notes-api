<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')
                ->nullable();
            $table->string('color')
                ->default('bg-white');
            $table->boolean('pinned')
                ->default(0);
            $table->boolean('archived')
                ->default(0);
            $table->unsignedBigInteger('label_id')
                ->nullable();
            $table->foreign('label_id')
                ->references('id')
                ->on('labels');
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
        Schema::dropIfExists('notes');
    }
}
