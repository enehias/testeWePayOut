# Teste Para desenvolvedor Pleno-WePayOut
Desenvolvedor Ricardo Enehias

# Instalação
Configure previamente o ambiente, e o arquivo .env (**não esquece de setar QUEUE_CONNECTION=database**)

- Clone o projeto 
```
git clone https://github.com/enehias/testeWePayOut.git
```
- Acessar pasta do projeto
```
cd testeWePayOut
```
- Copiar arquivo .env.exemple .env
```
cp .env.example .env
```
- Rodar migrações e seeds
```
php artisan migrate:fresh --seed
```
- Rodar migrações de fila
```
php artisan queue:table
```
- Rodar aplicação e fila do laravel
```
php artisan serve
php artisan queue:work
```
***
- Usuário Inicial 
  - email: administrador1@administrador1.com
  - password: password
***
# Endpoints

Todas as rotas são protegidas com JWT(exceto login)

|Descrição | URI | Método |Payload | 
| ------| ------ | ------ |------ |
| Logar na aplicação| api/login | POST | - email: requerido, tipo email <br> -password:requerido, tipo texto  
| Deslogar da aplicação| api/logout | POST |Não se aplica
| Criar um pagamento | api/payment | POST | - code_bank: requerido, tipo texto, somento números, tamanho máximo 3 caracteres<br>- number_agency: requerido, tipo texto, somento números, tamanho máximo 4 caracteres<br>- number_account: requerido, tipo texto, somento números, tamanho máximo 15 caracteres<br>- value_payment: requerido, tipo numeric, tamanho máximo 100000 e mínimo 0.01|
| Listar todos os pagamentos na base de dados| api/payment | GET |Não se aplica
| Consultar um pagamento pelo id| api/payment/{id} | GET |id:número da invoice<br> ou<br> id do pagamento
| Criar um usuário|  api/user | POST | -name: requerido, min. caracteres :4. <br>-email: requerido, e único, tipo email. <br>-document: requerido, e único, tipo CPF ou CNPJ. <br>-password: requerido, min. caracteres :4.
| Listar todos os usuários|  api/user | GET |Não se aplica
| Deletar um usuário pelo id|  api/user/{id} | DELETE | id do usuário 
