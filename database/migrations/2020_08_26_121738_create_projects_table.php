<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('destination');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('code_departement', 3);
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->text('description');
            $table->enum('level', [ Project::SEUL,
                                    Project::EN_COUPLE,
                                    Project::EN_FAMILLE,
                                    Project::ENTRE_AMIS]);
            $table->enum('budget', [Project::BUDGET_SERRE,
                                    Project::BUDGET_MOYEN,
                                    Project::BUDGET_A_LAISE,
                                    Project::BUDGET_TRES_A_LAISE]);
            $table->text('categories');
            $table->boolean('contact');
            $table->text('telephone');
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
        Schema::dropIfExists('projects');
    }
}
