<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Customer name
            $table->string('email')->unique(); // Unique email
            $table->string('phone')->nullable(); // Optional phone number
            $table->string('company')->nullable(); // Optional company name
            $table->enum('status', ['active', 'inactive'])->default('active'); // Customer status
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user who created/owns the customer
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
