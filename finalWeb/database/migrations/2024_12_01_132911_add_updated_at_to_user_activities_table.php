<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedAtToUserActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('user_activities', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable(); // Tambahkan kolom updated_at
        });
    }

    public function down()
    {
        Schema::table('user_activities', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });
    }
}

