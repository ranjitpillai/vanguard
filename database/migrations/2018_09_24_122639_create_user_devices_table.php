<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false)->change();
			$table->text('device_id')->nullable(false)->change();
			$table->string('IMEI')->nullable(false)->change();
			$table->string('phone_number')->nullable(false)->change();
			$table->integer('country_code')->nullable(false)->change();
			$table->string('status')->nullable(false)->change();
			$table->integer('sms_token')->nullable(false)->change();
			$table->string('os_api_level')->nullable(false)->change();
			$table->string('device')->nullable(false)->change();
			$table->string('model')->nullable(false)->change();
			$table->string('manufacturer')->nullable(false)->change();
			$table->string('brand')->nullable(false)->change();
			$table->string('display')->nullable(false)->change();
			$table->string('os_version')->nullable(false)->change();
			$table->timestamp('created_at')->nullable(false)->change();
			$table->timestamp('updated_at')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_devices');
    }
}
