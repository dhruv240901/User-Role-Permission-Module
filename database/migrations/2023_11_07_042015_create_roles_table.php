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
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',51);
            $table->string('description',151);
            $table->boolean('is_active')->default(1)->comment("0:Blocked,1:Active");
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->uuid('created_by');
            // $table->foreign('created_by')->references('id')->on('users')
            // ->onDelete('CASCADE')->onUpdate('CASCADE');
            // $table->timestamp('created_at');
            // $table->uuid('updated_by')->nullable();
            // $table->foreign('updated_by')->references('id')->on('users')
            // ->onDelete('CASCADE')->onUpdate('CASCADE');
            // $table->timestamp('updated_at');
            // $table->uuid('deleted_by')->nullable();
            // $table->foreign('deleted_by')->references('id')->on('users')
            // ->onDelete('CASCADE')->onUpdate('CASCADE');
            // $table->timestamp('deleted_at')->nullable();
            // $table->boolean('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
