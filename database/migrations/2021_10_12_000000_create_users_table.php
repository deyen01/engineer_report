<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('family', 255)->nullable(); // фамилия сотрудника
            $table->string('name', 255)->nullable(); // имя сотрудника
            $table->string('ibn', 255)->nullable(); // отчество сотрудника
            $table->string('inn', 12)->nullable(); // ИНН сотрудника
            $table->foreignId('position_id') // должность сотрудника
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('tel', 12)->nullable();
            $table->foreignId('location_id') // мун.образование , где живёт сотрудник
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('address', 255)->nullable(); // адрес проживания сотрудника
            $table->foreignId('branch_id') // филиал
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->unsignedTinyInteger('access_level')->default(0); // 0 - обычный, 1 - модератор, 2 - администратор
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('enabled')->default(TRUE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
