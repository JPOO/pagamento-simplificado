# Pagamento simplificado

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

## Validações

### Validações de usuários

- Cadastro de usuários de diferentes n;';iveis;
- Validação de usuário e unicidade por cpf-cpnj e e-mail;
- Autenticação de usuário com validação de senha;

### Validações de transação e carteira

- Verifica se usuário que realiza a transferência é tipo Comum;
- Verifica se o usuário que recebe a trasnferência é valido (não posso enviar para mim mesmo);
- Verifica valor minimo a ser transferido (não faz sentido enviar R$ 0,00);
- Verifica se usuário que realiza a transferência tem o dinheiro necessário proposto;
- Verifica se o usuário que recebe transferência é válido;
- Verifica se a transação está autorizada pelo serviço externo;
- Atualiza os valores nas carteiras conforme transferência.
- Envia e-mail para o usuário que recebe a transferência em caso de sucesso;
