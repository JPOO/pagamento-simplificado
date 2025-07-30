### Pagamento simplificado

Projeto de Pagamento simplicado desenvolvido como teste técnico para a empresa IXC Software.

## Instalação e execução

Instalar dependências do composer
``` bash
composer install
```

Configurar o banco de dados no .env,  as credenciais utiliadas são:
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=pagamento_simplificado
DB_USERNAME=root
DB_PASSWORD=
```

Migrar as tabelas do banco de dados
``` bash
php artisan migrate
```

Semear dados no banco de dados
```
php artisan db:seed
```

Iniciar servidor
``` bash
php artisan serve
```

Acessar aplicação pela URL local
```
 http://localhost:8000
```
