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
        Schema::create('permission_module', function (Blueprint $table) {
            $table->id();
            $table->uuid('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->uuid('module_id');
            $table->foreign('module_id')->references('id')->on('modules')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->boolean('add_access')->default(0);
            $table->boolean('edit_access')->default(0);
            $table->boolean('delete_access')->default(0);
            $table->boolean('view_access')->default(0);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_module');
    }
};
