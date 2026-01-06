<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Products Table
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('item_code')->unique(); // Unique item identifier
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('sub_cat_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('name', 200); // Product name
            $table->string('slug')->nullable()->index(); // SEO-friendly URL
            $table->decimal('price', 10, 3)->default(0.000); // Product price
            $table->decimal('quantity', 10, 3)->default(0.000); // Quantity available
            $table->decimal('weight', 10, 3)->nullable()->default(1.000); // Weight of product
            $table->unsignedInteger('in_stock')->default(0); // Stock quantity
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete(); // Unit reference
            $table->boolean('status')->default(1); // Product status: 1 = Active, 0 = Inactive
            $table->string('image')->nullable(); // Main product image
            $table->text('description')->nullable(); // Description of the product
            $table->enum('type', ['single', 'configurable'])->default('single'); // Product type
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes(); // Soft delete support

            // Indexes for faster lookups
            $table->index(['category_id', 'sub_cat_id']);
        });

        // Product Variants Table (Replaces Product Children)
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete(); // Parent product
            $table->string('variant_name', 255); // Variant name (instead of duplicate 'name')
            $table->decimal('price', 10, 3)->default(0.000); // Price (can differ from parent)
            $table->decimal('quantity', 10, 3)->default(0.000); // Quantity
            $table->decimal('weight', 10, 3)->nullable()->default(1.000); // Weight
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete(); // Unit reference
            $table->unsignedInteger('in_stock')->default(0); // In stock quantity
            $table->string('image')->nullable(); // Image (if different from parent)
            $table->text('description')->nullable(); // Variant-specific description
            $table->boolean('status')->default(1); // Status: 1 = Active, 0 = Inactive
            $table->timestamps(); // Created_at and updated_at timestamps

            // Indexing for optimized lookups
            $table->index('product_id');
        });

        // Product Configurations Table
        Schema::create('product_configurations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete(); // Product reference

            // Boolean configuration flags (tinyInteger for storage efficiency)
            $table->boolean('is_subscribable')->default(0);
            $table->boolean('is_container')->default(0);
            $table->boolean('is_feature')->default(0);
            $table->boolean('is_taxable')->default(0);

            $table->timestamps(); // Created_at and updated_at timestamps

            // Index for faster lookups
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('product_configurations');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('products');
        Schema::enableForeignKeyConstraints();
    }
};
