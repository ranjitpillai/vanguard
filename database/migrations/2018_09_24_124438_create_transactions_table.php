<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->nullable()->change();
			$table->string('device_id')->nullable();
			$table->string('transaction_type')->nullable();
			$table->double('charge',11,11)->nullable();
			$table->string('service_type')->nullable();
			$table->string('phone_number')->nullable();
			$table->timestamp('created_at')->nullable()->change();
			$table->timestamp('updated_at')->nullable()->change();
			$table->string('name')->nullable();
			$table->longText('note')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
