<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupForumIdToReactionsTable extends Migration
{
    public function up()
    {
        Schema::table('reactions', function (Blueprint $table) {
            $table->foreignId('group_forum_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reactions', function (Blueprint $table) {
            $table->dropForeign(['group_forum_id']);
            $table->dropColumn('group_forum_id');
        });
    }
}