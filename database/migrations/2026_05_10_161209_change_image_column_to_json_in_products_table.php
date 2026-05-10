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
        // Convert existing strings to JSON arrays
        $products = DB::table('products')->get();
        foreach ($products as $product) {
            if ($product->image && !str_starts_with($product->image, '[')) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['image' => json_encode([$product->image])]);
            }
        }

        Schema::table('products', function (Blueprint $table) {
            $table->json('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};
