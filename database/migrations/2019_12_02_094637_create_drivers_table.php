<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone')->unique();
            $table->string('city', 50);
            $table->string('language', 25)->nullable();
            $table->string('referral_code', 25)->nullable();
            $table->text('car_id')->nullable();
            $table->string('social_security', 50)->nullable();
            $table->text('driver_license_photo')->nullable();
            $table->text('driver_license_number')->nullable();
            $table->text('taxi_license_photo')->nullable();
            $table->text('taxi_license_number')->nullable();
            $table->date('taxi_license_expires')->nullable()->comment('expires:year,month,day');
            $table->text('taxi_license_traffic_auth')->nullable();
            $table->string('avatar')->nullable();
            $table->string('company_certificate', 50)->nullable();
            //step 5
            $table->string('invoice_form', 50)->nullable();
            $table->string('company_name', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('organization_number', 50)->nullable();
            $table->string('tax_number', 50)->nullable();
            $table->string('account_holder', 50)->nullable();
            $table->string('bank_account_number', 50)->nullable();
            $table->string('bic_swift', 50)->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
