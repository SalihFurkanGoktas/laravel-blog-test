<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

	Schema::table('blogs', function (Blueprint $table) {
		$table->string('heading');
	});
