[![Solusoft](https://www.elw.com.br/skin/frontend/solusoft/default/images/logo-sga-soft.jpg "Solusoft")](https://www.elw.com.br/skin/frontend/solusoft/default/images/logo-sga-soft.jpg "Solusoft")

# Clientes - CRUD
##### Campos bd: código cliente, nome, cpf, sexo, email

- GET /clientes/
- GET /clientes/1
- POST /clientes/
- PUT /clientes/1
- DELETE /clientes/1

# Produtos - CRUD
##### Campos bd: código produto, nome, cor, tamanho, valor

- GET /produtos/
- GET /produtos/1
- POST /produtos/
- PUT /produtos/1
- DELETE /produtos/1

# Pedido - CRUD
##### Campos bd: código do pedido, data do pedido, observação, forma de pagamento (dinheiro, cartão, cheque).

- GET /pedidos/
- GET /pedidos/1
- POST /pedidos/
- PUT /pedidos/1
- DELETE /pedidos/1
- POST /pedidos/1/sendmail
- POST/pedidos/1/report

# Instalação
- Clonar o repositório no localhost;
- Na raiz do sistema acesse a pasta backend, incluir as dependências via: **composer install**;
    - Na mesma alter o nome do arquivo **.env.example** para **.env**
    - Execute o comando **php artisan key:generate --show** em seu terminal
    - Configure as variaveis de banco de dados de acordo com a suas informações do seu S.O 
        - DB_CONNECTION=mysql
        - DB_HOST=127.0.0.1
        - DB_PORT=3306
        - DB_DATABASE=solusoft
        - DB_USERNAME=root
        - DB_PASSWORD=
    - Para envio de e-mail (verifique as informações de seu servidor)
        - MAIL_DRIVER=smtp
        - MAIL_HOST=SeuSMTP
        - MAIL_PORT=587
        - MAIL_USERNAME=SeuUserName
        - MAIL_PASSWORD=SuaSenha
        - MAIL_ENCRYPTION=tls
        - MAIL_FROM_ADDRESS=SeuEmail
        - MAIL_FROM_NAME="Seu nome"
- Na raiz do sistema **frontend_2**, incluir as dependências via: **npm install**;
- Criar o banco de dados de nome **solusoft**
- Import o arquivo **solusoft.sql** para o banco criado
- Acesse a pasta **solusoft/backend** em seu terminal e execute o comando **php artisan serve**
- Acesse a pasta **solusoft/frontend_2** em seu terminal e execute o comando **npm run serve**,
- Ele te retornará uma url ex.:'http://localhost:8080/' acesse o seu browser 

## Ambiente de desenvolvimento
- Windows 10;
- PHP  7.1.26
- Mysql 5.0.12``
- Apache/2.4.37 (Win32) OpenSSL/1.0.2p 

## Frameworks utilizados
 - Laravel - 5.8
    - barryvdh/laravel-dompdf - "0.8.6"
 - Vue - 2.6
    - Axios
    - BootstrapVue



