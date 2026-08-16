<?php

use App\Enums\Status;
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
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('send_mail');
        });

        Schema::dropIfExists('subscribers');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('status')->default(Status::Active);
            $table->timestamps();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->boolean('send_mail')->default(false);
        });
    }
};
