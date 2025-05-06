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

        // $table->id();
        // $table->string('name');
        // $table->string('email')->unique();
        // $table->timestamp('email_verified_at')->nullable();
        // $table->string('password');
        // $table->enum('role', ['admin', 'user'])->default('user');
        // $table->rememberToken();
        // $table->timestamps();
        Schema::table('users', function (Blueprint $table) {
            $table->string('restaurant_name')->nullable()->after('name');
            $table->string('mobile_number')->nullable()->after('restaurant_name');
            $table->boolean('status')->default(0)->index()->after(column: 'role');
            $table->softDeletes();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('restaurant_name');
            $table->dropColumn('mobile_number');
            $table->dropColumn('status');
            $table->dropSoftDeletes();
        });
    }
};
