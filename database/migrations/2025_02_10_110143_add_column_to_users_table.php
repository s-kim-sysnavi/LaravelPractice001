<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('address', 'address1');

            $table->date('birth_date')->after('gender');
            $table->string('address2')->after('address1');
            $table->string('address3')->after('address2');
            $table->string('position')->nullable()->after('profile_image');
            $table->string('last_name_kana')->after('last_name');
            $table->string('first_name_kana')->after('first_name');
            // $table->integer('join_month')->after('join_year');
            // $table->integer('join_day')->after('join_month');
            $table->string('post_code', 7)->after('join_date');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // $table->renameColumn('address1', 'address');
            $table->dropColumn(['post_code', 'address2', 'address3', 'position', 'last_name_kana', 'first_name_kana', 'birth_date']);
        });
    }
};
