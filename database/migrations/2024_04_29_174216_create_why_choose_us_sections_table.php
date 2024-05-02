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
        Schema::create('why_choose_us_sections', function (Blueprint $table) {
            $table->id();
            $table->string('icon_1');
            $table->string('title_1');
            $table->string('subtitle_1');

            $table->string('icon_2');
            $table->string('title_2');
            $table->string('subtitle_2');

            $table->string('icon_3');
            $table->string('title_3');
            $table->string('subtitle_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_us_sections');
    }
};
