<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'email_verified_at', 'remember_token']);
            $table->string('address', 255)->nullable()->after('password');
            $table->string('city')->nullable()->after('address');
            $table->unsignedInteger('index')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'city', 'index']);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('name');
        });
    }
};
