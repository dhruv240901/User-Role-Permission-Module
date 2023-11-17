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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name',51);
            $table->string('last_name',51)->nullable();
            $table->string('email',51)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',251);
            $table->boolean('is_active')->default(1)->comment("0:Blocked,1:Active");
            $table->boolean('is_first_login')->default(0)->comment("0:No,1:Yes");
            $table->string('code',6)->nullable();
            $table->enum('type',['admin','user'])->default('user');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
