# Instalação
Por favor, acesse [a página oficial de instalação do Laravel](https://laravel.com/docs/7.x/installation) para verificar os requisitos necessários para executar o projeto.

## 1. Clone o repositório
````
 git clone https://github.com/GeovanneAtanazio/gestor_certificados.git
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
## 6. Gere o link simbolico necessário para salvar os arquivos submetidos no sistema
````
php artisan storage:link
````
## 7. Inicie o servidor de desenvolvimento local
````
php artisan serve
````
## 8. Acesso ao sistema

### Gestores
````
'email'=> jj@unit.br,
'senha'  => 123456789,
````
````
'email'=> jd@unit.br,
'password'  =>  123456789,
````

### Alunos

````
'email'=> gabigol@unit.br,
'password'  =>  123456789
````
````
'email'=> de_arrascaeta@unit.br,
'password'  =>  123456789
````
````
'email'=> oto_pata_mar@unit.br,
'password'  =>  123456789
````
````
'email'=> vapo_vapo@unit.br,
'password'  =>  123456789
````
