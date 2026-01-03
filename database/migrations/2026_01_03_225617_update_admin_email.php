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
        \App\Models\User::where('email', 'admin@sigovariedades.com')
            ->update(['email' => 'silvanadsc15@gmail.com']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\User::where('email', 'silvanadsc15@gmail.com')
            ->update(['email' => 'admin@sigovariedades.com']);
    }
};
