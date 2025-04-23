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
        Schema::create('expense_data', function (Blueprint $table) {
            $table->id();
            $table->string('expense_category',10);
            $table->string('expense_name',255)->nullable();
            $table->string('payment_method',20);
            $table->date('expense_date');
            $table->bigInteger('expence_amount');
            $table->string('expense_description',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_data');
    }
};
