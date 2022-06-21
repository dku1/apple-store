<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('old_price')->nullable()->after('price');
            $table->unsignedInteger('count')->after('price')->default(0);
            $table->unsignedInteger('sales')->after('count')->default(0);
            $table->unsignedInteger('subscribers')->after('sales')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table){
           $table->dropColumn(['old_price', 'count', 'sales', 'subscribers']);
        });
    }
};
