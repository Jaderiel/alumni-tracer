<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdToReactions extends Migration
{
    public function up()
    {
        Schema::table('reactions', function (Blueprint $table) {
            $table->foreignId('group_id')->nullable()->constrained('group_forum')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reactions', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }
}

