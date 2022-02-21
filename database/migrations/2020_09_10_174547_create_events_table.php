<?php

use App\Enums\EventStatus;
use App\Enums\EventPeopleAmount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->time('start_hour');
            $table->date('end_date')->nullable();
            $table->time('end_hour')->nullable();
            $table->time('professional_start_hour')->nullable();
            $table->time('professional_end_hour')->nullable();
            $table->enum('people_amount', EventPeopleAmount::getValues());
            $table->string('location');
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', EventStatus::getValues())->default(EventStatus::DisapprovedPayment);
            $table->unsignedInteger('promotion_id')->nullable();
            $table->string('promotion_code')->nullable();
            $table->decimal('promotion_price', 10, 2)->nullable();
            $table->unsignedInteger('professional_id')->nullable();
            $table->string('slug', 128);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_category_id');
            $table->foreign('event_category_id')->references('id')->on('event_categories');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
