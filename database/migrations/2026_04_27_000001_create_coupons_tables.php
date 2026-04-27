<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 12, 2);
            $table->text('description')->nullable();
            $table->boolean('show_on_website')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_blocked')->default(false);
            $table->timestamps();

            // $table->decimal('min_order_amount')->nullable();
            // $table->decimal('max_discount_amount')->nullable();
            // $table->integer('usage_limit')->nullable();
            // $table->integer('used_count')->default(0);
            // $table->integer('per_user_limit')->nullable();
            // $table->timestamp('starts_at')->nullable();
            // $table->timestamp('expires_at')->nullable();
            // $table->boolean('is_first_time_only')->default(false);
        });

        // Pivot columns match legacy int PKs on product_categories / products; no FK constraints for DB compatibility.
        Schema::create('coupon_user', function (Blueprint $table) {
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['coupon_id', 'user_id']);
        });

        Schema::create('coupon_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedInteger('category_id');
            $table->primary(['coupon_id', 'category_id']);
        });

        Schema::create('coupon_products', function (Blueprint $table) {
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedInteger('product_id');
            $table->primary(['coupon_id', 'product_id']);
        });

        // Schema::create('coupon_usages', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('coupon_id')->constrained('coupons')->cascadeOnDelete();
        //     $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        //     $table->foreignId('order_id')->nullable()->constrained('orders')->nullOnDelete();
        //     $table->decimal('discount_applied', 12, 2)->default(0);
        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupon_products');
        Schema::dropIfExists('coupon_categories');
        Schema::dropIfExists('coupon_user');
        Schema::dropIfExists('coupons');
    }
};
