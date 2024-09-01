<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('complain_id')->nullable(); // it will come from api
            $table->string('exchange_for')->nullable(); // exchange stb will store here
            $table->foreignId('transaction_type_id')->constrained('transaction_types', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('building_id')->constrained('buildings', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('stb_id')->constrained('s_tbs', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('technicians', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('transactions');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
