1 -

copy .env.example .env

2 -

*Adicionar no .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=tarefa
DB_USERNAME=root
DB_PASSWORD=123

3 -

php artisan key:generate

4 -

php artisan migrate