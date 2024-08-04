<?php

use Illuminate\Database\Schema\Blueprint;

use Flarum\Database\Migration;

return Migration::createTable(
    'ships_result',
    function (Blueprint $table) {
        $table->increments('id');
        $table->string("text");
        $table->string("reward");
        $table->integer("weight");
        $table->integer("sum");
    }
);

