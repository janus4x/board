<?php
require_once 'core/route.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'assets/class_db.php';
//Todo нужно вынести коннект к базе оттдельно
//Подключаю до либы
/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/
Route::start(); // запускаем маршрутизатор
