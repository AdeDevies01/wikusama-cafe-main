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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cashier_id')->unsigned()->nullable();
            $table->bigInteger('table_id')->unsigned()->nullable();
            $table->string('customer_name', 100)->nullable();
            $table->string('note', 500)->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('total_payment')->nullable();
            $table->boolean('is_delivered')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('RESTRICT')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
