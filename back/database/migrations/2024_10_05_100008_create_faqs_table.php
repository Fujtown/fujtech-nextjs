<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('question'); // Column for the FAQ question
            $table->text('answer'); // Column for the FAQ answer
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('faqs'); // Drop the table if it exists
    }
};
