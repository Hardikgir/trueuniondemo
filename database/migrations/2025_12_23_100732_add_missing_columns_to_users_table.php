<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check which columns exist first
        $existingColumns = [];
        try {
            $columns = DB::select("SHOW COLUMNS FROM users");
            foreach ($columns as $column) {
                $existingColumns[] = $column->Field;
            }
        } catch (\Exception $e) {
            // If we can't check, just try to add all columns
        }

        Schema::table('users', function (Blueprint $table) use ($existingColumns) {
            // Add basic columns
            if (!in_array('full_name', $existingColumns)) {
                try {
                    $table->string('full_name')->nullable()->after('name');
                } catch (\Exception $e) {}
            }
            if (!in_array('profile_image', $existingColumns)) {
                try {
                    $table->string('profile_image')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('gender', $existingColumns)) {
                try {
                    $table->string('gender')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('height', $existingColumns)) {
                try {
                    $table->string('height')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('weight', $existingColumns)) {
                try {
                    $table->string('weight')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('dob', $existingColumns)) {
                try {
                    $table->date('dob')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('birth_time', $existingColumns)) {
                try {
                    $table->string('birth_time')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('birth_place', $existingColumns)) {
                try {
                    $table->string('birth_place')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('raashi', $existingColumns)) {
                try {
                    $table->string('raashi')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('caste', $existingColumns)) {
                try {
                    $table->string('caste')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('nakshtra', $existingColumns)) {
                try {
                    $table->string('nakshtra')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('naadi', $existingColumns)) {
                try {
                    $table->string('naadi')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('marital_status', $existingColumns)) {
                try {
                    $table->string('marital_status')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('mother_tongue', $existingColumns)) {
                try {
                    $table->string('mother_tongue')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('physically_handicap', $existingColumns)) {
                try {
                    $table->string('physically_handicap')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('diet', $existingColumns)) {
                try {
                    $table->string('diet')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('languages_known', $existingColumns)) {
                try {
                    $table->text('languages_known')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('employed_in', $existingColumns)) {
                try {
                    $table->string('employed_in')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('annual_income', $existingColumns)) {
                try {
                    $table->string('annual_income')->nullable();
                } catch (\Exception $e) {}
            }
            if (!in_array('mobile_number', $existingColumns)) {
                try {
                    $table->string('mobile_number')->nullable()->unique();
                } catch (\Exception $e) {}
            }
            if (!in_array('google_id', $existingColumns)) {
                try {
                    $table->string('google_id')->nullable()->unique();
                } catch (\Exception $e) {}
            }
            if (!in_array('role', $existingColumns)) {
                try {
                    $table->enum('role', ['user', 'admin'])->default('user');
                } catch (\Exception $e) {}
            }
            
            // Foreign key columns
            if (!in_array('highest_education_id', $existingColumns)) {
                try {
                    $table->foreignId('highest_education_id')->nullable()->constrained('highest_qualification_master')->onDelete('set null');
                } catch (\Exception $e) {}
            }
            if (!in_array('education_id', $existingColumns)) {
                try {
                    $table->foreignId('education_id')->nullable()->constrained('education_master')->onDelete('set null');
                } catch (\Exception $e) {}
            }
            if (!in_array('occupation_id', $existingColumns)) {
                try {
                    $table->foreignId('occupation_id')->nullable()->constrained('occupation_master')->onDelete('set null');
                } catch (\Exception $e) {}
            }
            if (!in_array('country_id', $existingColumns)) {
                try {
                    $table->foreignId('country_id')->nullable()->constrained('country_manage')->onDelete('set null');
                } catch (\Exception $e) {}
            }
            if (!in_array('state_id', $existingColumns)) {
                try {
                    $table->foreignId('state_id')->nullable()->constrained('state_master')->onDelete('set null');
                } catch (\Exception $e) {}
            }
            if (!in_array('city_id', $existingColumns)) {
                try {
                    $table->foreignId('city_id')->nullable()->constrained('city_master')->onDelete('set null');
                } catch (\Exception $e) {}
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'full_name', 'profile_image', 'gender', 'height', 'weight', 'dob',
                'birth_time', 'birth_place', 'raashi', 'caste', 'nakshtra', 'naadi',
                'marital_status', 'mother_tongue', 'physically_handicap', 'diet',
                'languages_known', 'highest_education_id', 'education_id', 'employed_in',
                'occupation_id', 'annual_income', 'country_id', 'state_id', 'city_id',
                'mobile_number', 'google_id', 'role'
            ];
            
            foreach ($columns as $column) {
                try {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                } catch (\Exception $e) {}
            }
        });
    }
};
