<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->nullable(); // 0 - черновик, 1 - подан на проверку, 2 - принят, 3 - Отклонён
            $table->string('reason', 255)->nullable();
            $table->unsignedTinyInteger('type_of_work')->nullable(); // тип работы
            $table->date('date_executed'); // дата выполнения работы
            $table->string('number_ticket', 255)->nullable(); // номер заявки
            $table->string('location', 64)->nullable(); // копируем из таблицы устройств или пользователей
            $table->string('address', 255)->nullable(); // копируем из таблицы устройств или пользователей
            $table->string('number_device', 64)->nullable();
            $table->integer('mileage')->nullable();
            $table->string('title_client', 128)->nullable(); // копируем из таблицы устройств -> клиентов
            $table->string('comment', 255)->nullable();
            $table->foreignId('user_id') // автор-сотрудник отчёта
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('moderator_id') // модератор
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
        Schema::dropIfExists('reports');
    }
}
