<?php

use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_vendor', static function (Blueprint $table) {
            $table->foreignIdFor(Location::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Vendor::class)->constrained()->cascadeOnDelete();
            $table->boolean('is_default')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_vendor');
    }
};
