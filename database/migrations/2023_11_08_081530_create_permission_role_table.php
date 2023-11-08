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
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->uuid('role_id');
            $table->foreign('role_id')->references('id')->on('roles')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->uuid('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->boolean('is_active')->default(1)->comment("0:Blocked,1:Active");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
