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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('job_category_id');
            $table->foreignId('job_role_id');
            $table->foreignId('job_experience_id');
            $table->foreignId('education_id');
            $table->foreignId('job_type_id');
            $table->foreignId('salary_type_id');
            $table->string('title');
            $table->string('slug');
            $table->string('vacancies');
            $table->double('min_salary');
            $table->double('max_salary');
            $table->date('deadline');
            $table->text('description');
            $table->enum('status',['pending', 'active', 'expired']);
            $table->enum('apply_on',['app', 'email', 'custom_url']);
            $table->string('apply_email')->nullable();
            $table->string('apply_url')->nullable();
            $table->boolean('featured')->default(0);
            $table->date('featured_until')->nullable();
            $table->boolean('highlight')->default(0);
            $table->date('highlight_until')->nullable();
            $table->boolean('is_remote')->default(0);
            $table->integer('total_views')->default(0);
            $table->string('address');
            $table->foreignId('city');
            $table->foreignId('province');
            $table->foreignId('district');
            $table->enum('salary_mode', ['range', 'custom']);
            $table->string('company_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
