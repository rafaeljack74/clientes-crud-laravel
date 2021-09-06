# Sobre o Projeto

Esse projeto foi desenvolvido com a intenção de ser um cadastro básico de clientes. Junto a isso há um cadastro de categorias pré-definidas as quais são vinculadas aos clientes.

# Tecnologias
Para o desenvolvimento desse projeto foram utilizados:
- Laravel 8;
- Bootstrap 5;
- jQuery 3 + Mask Plugin 1.14;
- SweetAlert2.

# Executando o Projeto
Após o clone do projeto, é necessário seguir os passos a seguir:

1 - Crie uma cópia do arquivo *".env.example"* e salve-o como *".env"*. Edite o arquivo salvo informando as tags de conexão com o banco de dados.
>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

2 - Salve e feche o arquivo. Agora instale as dependências do projeto através do **Composer**. Para isso, execute via CMD o comando abaixo no diretório do projeto.
>composer install

3 - Agora gere a chave da aplicação executando o comando abaixo:
>php artisan key:generate

4 - Crie a estrutura de banco de dados executando as migrations.
>php artisan migrate

5 - Popule a tabela de **Categorias** executando o seeder.
>php artisan db:seed

6 - Tudo pronto! Basta executar o comando abaixo e a aplicação estará acessível!
>php artisan serve
 
 Por padrão, o projeto é iniciado no endereço:
 >http://localhost:8000