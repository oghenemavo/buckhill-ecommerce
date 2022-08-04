<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('uuid', 36)->unique()->after('id');
            $table->string('first_name')->after('uuid');
            $table->string('last_name')->after('first_name');
            $table->tinyInteger('is_admin')->default(0)->after('last_name');
            $table->char('avatar', 36)->unique()->nullable()->after('password');
            $table->string('address')->after('avatar');
            $table->string('phone_number')->after('address');
            $table->tinyInteger('is_marketing')->default(0)->after('phone_number');
            $table->string('last_login_at')->nullable();

            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('is_admin');
            $table->dropColumn('avatar');
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
            $table->dropColumn('is_marketing');
            $table->dropColumn('last_login_at');
        });
    }
};
