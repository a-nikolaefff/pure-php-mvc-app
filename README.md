# pure-php-mvc-app

## Задание

Написать MVC приложение на чистом PHP без использования фреймворков.

Необходимо создать приложение-задачник.

Задачи состоят из:

* имени пользователя;
* е-mail;
* текста задачи;

Стартовая страница - список задач с возможностью сортировки по имени пользователя, email и статусу. Вывод задач нужно сделать страницами по 5 штук (с пагинацией). Видеть список задач и создавать новые может любой посетитель без регистрации.

Сделайте вход для администратора (логин "admin", пароль "123"). Администратор имеет возможность редактировать текст задачи и поставить галочку о выполнении. Выполненные задачи в общем списке выводятся с соответствующей отметкой "отредактировано администратором".

## Реализация
 
Разработанное приложение не использует PHP-фреймворков. Из библиотек использованы только pdo и mbstring. Интерфейс реализован на Bootstrap.

![Интерфейс](https://github.com/A-Nikolaefff/pure-php-mvc-app/blob/master/readme_assets/1.png)

## Демо
### Запуск
```
docker-compose up 
```

В состав репозитория включен sql-скрипт инициалирующий БД и заполняющий её данными. Скрипт запускается автоматически если база данных еще не существует.

### Возможные проблемы при запуске

Для корректной работы volumes докер-контейнера БД PostgreSQL необходимо,
что бы UID/GID пользователя внутри контейнера соответствовали значению
локального пользователя Linux. По умолчанию данный контейнер запускается
с UID/GID 1000/1000. В случае если UID/GID локального пользователя отличаются необходимо выполнить
команды ```export LOCAL_UID=$(id -u)``` и ```export LOCAL_GID=$(id -g)``` перед первым запуском контейнера.