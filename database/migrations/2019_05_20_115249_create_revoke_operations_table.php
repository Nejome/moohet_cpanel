<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevokeOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revoke_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('revoke_order_id');
            $table->string('sender_account_number');
            $table->string('transaction_id');
            $table->date('transaction_date');
            $table->foreign('revoke_order_id')->references('id')->on('revoke_orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revoke_operations');
    }
}
