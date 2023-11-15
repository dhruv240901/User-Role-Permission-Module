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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')
            ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->foreign('updated_by')->references('id')->on('users')
            ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->foreign('deleted_by')->references('id')->on('users')
            ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->boolean('is_deleted')->default(0)->comment("0:No,1:Yes");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')
            ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->foreign('updated_by')->references('id')->on('users')
            ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->foreign('deleted_by')->references('id')->on('users')
            ->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->boolean('is_deleted')->default(0)->comment("0:No,1:Yes");
        });
    }
};
