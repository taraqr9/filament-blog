<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->string('email')->nullable()->change();
        });

        foreach (DB::table('users')->whereNull('username')->get(['id', 'name', 'email']) as $user) {
            $base = Str::slug($user->email ? Str::before($user->email, '@') : $user->name, '_') ?: 'user';
            $username = $base;
            $suffix = 1;

            while (DB::table('users')->where('username', $username)->exists()) {
                $username = $base.'_'.(++$suffix);
            }

            DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->string('email')->nullable(false)->change();
        });
    }
};
