<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $needToMoveOldStock = ! Schema::hasColumn('products', 'good_stock');

        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'good_stock')) {
                $table->unsignedInteger('good_stock')->default(0)->after('stock');
            }

            if (! Schema::hasColumn('products', 'minor_damage_stock')) {
                $table->unsignedInteger('minor_damage_stock')->default(0)->after('good_stock');
            }

            if (! Schema::hasColumn('products', 'major_damage_stock')) {
                $table->unsignedInteger('major_damage_stock')->default(0)->after('minor_damage_stock');
            }
        });

        if ($needToMoveOldStock) {
            DB::table('products')->update([
                'good_stock' => DB::raw('COALESCE(stock, 0)'),
                'minor_damage_stock' => 0,
                'major_damage_stock' => 0,
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'major_damage_stock')) {
                $table->dropColumn('major_damage_stock');
            }

            if (Schema::hasColumn('products', 'minor_damage_stock')) {
                $table->dropColumn('minor_damage_stock');
            }

            if (Schema::hasColumn('products', 'good_stock')) {
                $table->dropColumn('good_stock');
            }
        });
    }
};
