<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('code')->unique();
            $table->string('title');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('duration_value')->default(1);
            $table->enum('duration_type', ['day', 'month', 'year'])->default('month');
            $table->enum('user_type', ['buyer', 'seller'])->default('seller');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_default')->default(0);
            $table->boolean('is_featured_eligible')->default(0);
            $table->timestamps();
        });

        DB::table('memberships')->insert([
            [
                'code' => 1,
                'title' => 'General (Buyer)',
                'price' => 0,
                'duration_value' => 1,
                'duration_type' => 'month',
                'is_active' => 1,
                'is_default' => 0,
                'is_featured_eligible' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 2,
                'title' => 'Premium (Seller)',
                'price' => 0,
                'duration_value' => 1,
                'duration_type' => 'month',
                'is_active' => 1,
                'is_default' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 3,
                'title' => 'Basic (Seller)',
                'price' => 0,
                'duration_value' => 1,
                'duration_type' => 'month',
                'is_active' => 1,
                'is_default' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 4,
                'title' => 'Free (Seller)',
                'price' => 0,
                'duration_value' => 1,
                'duration_type' => 'month',
                'is_active' => 1,
                'is_default' => 1,
                'is_featured_eligible' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
