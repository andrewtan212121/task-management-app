<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();;
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('task_name');
            $table->text('task_description');
            $table->bigInteger('user')->unsigned();
            $table->foreign('user')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('status')->default(0) ;
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
