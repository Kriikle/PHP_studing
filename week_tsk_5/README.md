# Блог

## Задание #6.1
- Перепишите работу с базой данных в проекте из ВП №1 с использованием Eloquent ORM.
- Добавьте функционал создания, редактирования пользователей из админки.
- В БД должны храниться как минимум: email (уникальный), ссылка на изображение.

## Структура
- Для подключения файлов использутьеся autolader 
- Типичная MCV модели,контролеры,вью лежат в папке app
- Классы БД и routing,а также application лежат в src
- Для доступа к блогу нужно перейти оп сылке `http://localhost/blog` *авторизация необходима

## Миграции

- В файле migrations.php 
- Для выполнения миграции запустить файл 

## Изображения
- В БД храниться только путь до изображения
- Для каждого изображения генирируютсья уникалбные имена

##
- id администратора указываетсья в файле src/boostrap.php
