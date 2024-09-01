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
        Schema::create('s_tbs', function (Blueprint $table) {
            $table->id();
            $table->string('nuid');
            $table->string('bcl_id')->nullable();
            $table->string('category'); //HC/NL
            $table->string('status')->default('good'); //Good, Bad or any others types of error
            $table->string('is_stock')->nullable(); // yes = 0, No=1
            $table->string('remarks')->nullable(); // any kinds of notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_tbs');
    }
};
