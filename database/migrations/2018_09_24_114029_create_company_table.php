<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
			$table->string('company_name')->nullable();
			$table->text('avatar')->nullable();
			$table->text('company_address')->nullable();
			$table->string('company_website')->nullable();
			$table->string('company_phone')->nullable();
			$table->string('company_code')->nullable();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
			$table->string('company_fax')->nullable();
			$table->string('street1')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('address')->nullable();
			$table->string('street2')->nullable();
			$table->string('postal_code')->nullable();
			$table->string('state_code')->nullable();
			$table->string('state_code')->nullable();
			$table->integer('country_id')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->string('google_plus')->nullable();
			$table->string('linked_in')->nullable();
			$table->string('dribbble')->nullable();
			$table->string('skype')->nullable();
			$table->text('company_details')->nullable();
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
        Schema::dropIfExists('company');
    }
}
