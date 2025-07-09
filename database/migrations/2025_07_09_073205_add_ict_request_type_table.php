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
        if (!Schema::hasTable('ict_service_requests')) {
            Schema::table('ict_service_requests', function (Blueprint $table) {
                $table->unsignedBigInteger('ict_service_request_type_id');
                $table->foreignId('ict_service_request_type_id')->constrained();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
