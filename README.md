------ задача ----------

Цель: разработать микросервис на Laravel для приложения Заметки (аналог Google Keep)

Функциональность: получить список заметок / добавить новую заметку / отредактировать старую заметку

Модель заметки простая: title + description + дата добавления + дата последнего редактирования

Заметки хранить в БД (можно выбрать любую SQL базу)

Выполнить проверку заметки, тексты в ней должны сродержать только латинские символы. 

При нарушении этого правила вернуть пользователю ошибку  

Подключить Swagger и получить страничку с описанием API в формате Swagger
Написать один Unit Test любой на выбор

Ждем чистенький и апрятный код с коментариями. Удачи

-------- создание --------

php artisan make:model Notes -mcr
// модель миграция контроллер

composer require "darkaonline/l5-swagger"
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

??
composer require "zircote/swagger-php:2.*"