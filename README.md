# engineer_report
Simple Laravel app for input and check reports from engineers

обновите зависимости:
- composer update
- npm install

Затем соберите фронтенд командой
- npm run dev

или
- npm run prod

Через php artisan создайте новый ключ приложения. Создайте файл настроек .env по образцу .env.example

Обновите пароли для пользователей в файле database/seeders/UserSeeder.php

Выполните миграции и первичное наполнение базы данных
- php artisan migrate:fresh --seed
