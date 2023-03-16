# pure-php-mvc-app

Тестовое задание: написать MVC приложение на чистом PHP без использования фреймворков.

Необходимо создать приложение-задачник.

Задачи состоят из:

* имени пользователя;
* е-mail;
* текста задачи;

Стартовая страница - список задач с возможностью сортировки по имени пользователя, email и статусу. Вывод задач нужно сделать страницами по 5 штук (с пагинацией). Видеть список задач и создавать новые может любой посетитель без регистрации.

Сделать вход для администратора, который имеет возможность редактировать текст задачи и поставить галочку о выполнении. Выполненные задачи в общем списке выводятся с соответствующей отметкой.

## Запуск

```
docker-compose up 
```

В состав репозитория включен sql-скрипт инициалирующий БД и заполняющий её данными

## Реализация
 
Разработанное приложение не использует PHP-фреймворков. Из библиотек использованы только pdo и mbstring. Интерфейс реализован на Bootstrap.

![Интерфейс](https://https://github.com/A-Nikolaefff/pure-php-mvc-app/raw/master/readme_assets/1.png)
