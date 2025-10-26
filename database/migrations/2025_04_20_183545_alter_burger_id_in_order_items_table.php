<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBurgerIdInOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // 1. Supprimer la contrainte de clé étrangère
            $table->dropForeign(['burger_id']);
            
            // 2. Modifier la colonne
            $table->string('burger_id')->nullable()->change();
            
            // 3. Recréer la contrainte si nécessaire (optionnel)
            // $table->foreign('burger_id')->references('id')->on('burgers');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Pour le rollback
            $table->dropForeign(['burger_id']);
            $table->string('burger_id')->nullable(false)->change();
            // $table->foreign('burger_id')->references('id')->on('burgers');
        });
    }
}