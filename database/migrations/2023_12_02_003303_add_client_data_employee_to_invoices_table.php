<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientDataEmployeeToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('client_phone')->nullable();
            $table->string('client_way_of_payment')->nullable();
            $table->integer('employee_id')->nullable()->unsigned();
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->removeColumn('client_phone');
            $table->removeColumn('client_way_of_payment');

            $table->dropForeign('employee_id');
            $table->removeColumn('invoices_employee_id_foreign');

        });
    }
}
