## Тестовое задание для соискателя на позицию php-разработчика (Laravel)

### Решение:  
Обязательно сидировать данные командой `php artisan migrate:fresh --seed`, это создаст тестовые товары и пользователя для входа в админ-панель  

Список страниц:
1. Главная страница `/` – на ней отображается список товаров  
2. Оформление заказа `/cart` – здесь добавленные товары и оформление заказа
3. Просмотр заказов `/dashboard` – административная часть, которая доступна только после логина, здесь список заказов с возможностью их удаления
4. Страница входа `/login` – авторизация, чтобы попасть в админ-панель

Данные для авторизации (доступно после сидирования командой `php artisan migrate:fresh --seed`):  
email: `test@admin.ru`  
password: `12345678`  

### Задание:  
```
Использовать, PHP 7+, Laravel 8+ и оформить в виде GIT-репозитория (Github/Gitlab/Bitbucket).  

Реализовать каталог товаров (любая продукция), где в блоке каждого товара должны быть:  
1. Название  
2. Цена  
3. Возможность выбрать кол-во  
4. Кнопка «Добавить в корзину»  
  
Вывод изображений товара и других, не указанных параметров, не требуется.  

Реализовать страницу оформления заказа, где должны присутствовать:  
1. Список товаров в корзине  
2. Общая стоимость всех товаров в заказе  
3. Кнопка «Оформить заказ»  

После нажатия на кнопку «Оформить заказ», он попадает в соответствующую таблицу, а покупателю выводится сообщение об успешно созданном заказе.  

Никаких доп. полей заказа заполнять не нужно.  

Реализовать страницу просмотра всех заказов, где должны присутствовать:  
1. Номер заказа  
2. Дата заказа  
3. Перечисленные через запятую названия товаров  
4. Общая стоимость всех товаров в заказе  
5. Итоговая стоимость всех заказов  

Будет плюсом, но не обязательно, возможность удаления заказа и закрытие этой страницы авторизацией. 

Сделать миграции на соответствующие таблицы.  

Использовать javascript и frontend-фреймворки не обязательно.  
```
