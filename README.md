# Instalação
Por favor, acesse [a página oficial de instalação do Laravel](https://laravel.com/docs/7.x/installation) para verificar os requisitos necessários para executar o projeto.

## 1. Clone o repositório
````
 git clone https://github.com/DCOMP-UFS/PRATICAS.ACUDIR-SE.git
````
## 2. Instale todas as dependências utilizando o composer
````
composer install
````
## 3. Copie o arquivo `.env.exemple` e faça as alterações de configuração necessárias no arquivo `.env`
````
cp .env.example .env
````
## 4. Gerar uma chave de aplicativo
````
php artisan key:generate
````
## 5. Execute o comando de migração e povoamento do banco de dados
````
php artisan migrate:refresh --seed
````
## 6. Inicie o servidor de desenvolvimento local
````
php artisan serve
````
