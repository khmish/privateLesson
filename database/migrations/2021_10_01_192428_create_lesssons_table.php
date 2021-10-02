<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLesssonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('lesssons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('users');
            $table->foreignId('teacher_id')->nullable()->constrained('users');
            $table->foreignId('subject_id')->constrained();
            $table->timestamp('date_execution');
            $table->string('state');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesssons');
    }
}
