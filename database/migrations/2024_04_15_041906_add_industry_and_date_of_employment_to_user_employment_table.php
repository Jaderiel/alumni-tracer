<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndustryAndDateOfEmploymentToUserEmploymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_employment', function (Blueprint $table) {
            $table->string('industry')->nullable();
            $table->date('date_of_employment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_employment', function (Blueprint $table) {
            $table->dropColumn('industry');
            $table->dropColumn('date_of_employment');
        });
    }
}

