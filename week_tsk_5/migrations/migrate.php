<?php

include_once('../vendor/autoload.php');
require "../src/boostrap.php";

use Illuminate\Database\Capsule\Manager as Capsule;

if (!Capsule::schema()->hasTable('users')){
	Capsule::schema()->create('users', function ($table) {
		$table->increments('id');
		$table->string('login');
		$table->string('email')->unique();
		$table->string('password');
		$table->string('api_key')->nullable()->unique();
		$table->rememberToken();
		$table->timestamps();
	});
}

if (!Capsule::schema()->hasTable('blogs')){
	Capsule::schema()->create('blogs', function ($table) {
		$table->increments('id');
		$table->string('name');
		$table->string('text');
		$table->string('image')->nullable();
		$table->unsignedInteger('user_id');
		$table->foreign('user_id')->references('id')->on('users')
			->onUpdate('cascade')
			->onDelete('cascade');
		$table->timestamps();
	});
}

if (!Capsule::schema()->hasTable('blogs')){
	Capsule::schema()->create('auths', function ($table) {
		$table->increments('id');
		$table->string('session');
		$table->unsignedInteger('user_id');
		$table->foreign('user_id')->references('id')->on('users')
			->onUpdate('cascade')
			->onDelete('cascade');
		$table->timestamps();
	});
}
