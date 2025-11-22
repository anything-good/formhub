<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $options = \App\Models\FieldOption::whereNull('value')->orWhere('value', '')->get();
        foreach ($options as $option) {
            $option->update(['value' => \Illuminate\Support\Str::slug($option->label)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed as this is a data fix
    }
};
