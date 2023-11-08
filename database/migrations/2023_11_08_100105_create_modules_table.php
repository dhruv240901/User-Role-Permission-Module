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
        Schema::create('modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('module_code',7);
            $table->string('name',64);
            $table->boolean('is_active')->default(1)->comment("0:Blocked,1:Active");
            $table->boolean('is_in_menu')->default(1);
            $table->integer('display_order')->default(1);
            $table->uuid('parent_id')->index()->nullable();
            // $table->foreign('parent_id')->references('id')->on('modules')
            // ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
