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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('type');
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'stripe_status']);
        });

        Schema::create('subscription_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id');
            $table->string('stripe_id')->unique();
            $table->string('stripe_product');
            $table->string('stripe_price');
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->index(['subscription_id', 'stripe_price']);
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // START PERMISSION

        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
        // END PERMISSION

        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->unsignedBigInteger('specie_id');
            $table->timestamps();

            $table->foreign('specie_id')->references('id')->on('species');
            $table->softDeletes();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name',50);
            $table->char('gender',1);
            $table->date('birth');
            $table->string('code',20);
            $table->unsignedBigInteger('breed_id');
            $table->string('species')->nullable(); // Added
            $table->integer('age')->nullable(); // Added
            $table->float('weight')->nullable(); // Added
            $table->integer('status')->default(1);
            $table->string('image')->nullable();
            $table->text('character')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });

        Schema::create('species_diseases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('specie_id');
            $table->unsignedBigInteger('disease_id');
            $table->timestamps();

            $table->foreign('specie_id')->references('id')->on('species');
            $table->foreign('disease_id')->references('id')->on('diseases');
        });

        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->json('disease',500);
            $table->string('lot');
            $table->date('application');
            $table->date('next');
            $table->string('vcode');
            $table->unsignedBigInteger('pet_id');
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });

        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('description',300);
            $table->unsignedBigInteger('pet_id');
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });

        Schema::create('walk_routines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->integer('DayOfWeek');
            $table->time('time');
            $table->string('description',300);
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });

        Schema::create('diets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->integer('DayOfWeek');
            $table->time('time');
            $table->string('description',300);
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });

        Schema::create('operation_types', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });

        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->string('description',500);
            $table->string('repetition');
            $table->datetime('start');
            $table->datetime('end')->nullable();
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });

        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('type');
            $table->datetime('date');
            $table->string('preop');
            $table->text('description');
            $table->text('result');
            $table->text('complications')->nullable();
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('type')->references('id')->on('operation_types');
        });

        Schema::create('vet_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->string('description',300);
            $table->datetime('date');
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
        });

        Schema::create('test_types', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });

        Schema::create('medical_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('type');
            $table->datetime('date');
            $table->string('description',300);
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('type')->references('id')->on('test_types');
        });

        Schema::create('rates',function (Blueprint $table) {
            $table->id();
            $table->string('stripe_id');
            $table->float('price');
            $table->string('type',1);
            $table->string('group',5);
            $table->string('title',50);
            $table->string('description');
            $table->json('functions');
            $table->json('limits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_items');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('personal_access_tokens');

        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
        Schema::dropIfExists('species');
        Schema::dropIfExists('breeds');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('diseases');
        Schema::dropIfExists('species_diseases');
        Schema::dropIfExists('vaccines');
        Schema::dropIfExists('allergies');
        Schema::dropIfExists('walk_routines');
        Schema::dropIfExists('diets');
        Schema::dropIfExists('operations');
        Schema::dropIfExists('treatments');
        Schema::dropIfExists('surgeries');
        Schema::dropIfExists('vet_visits');
        Schema::dropIfExists('test_types');
        Schema::dropIfExists('medical_tests');
        Schema::dropIfExists('rates');
    }
};
