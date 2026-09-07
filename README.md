# 🔐 Login Page PHP

Uma página de login simples desenvolvida com **PHP, HTML e CSS**, com sistema básico de autenticação de usuários.

## 📌 Sobre o projeto

Este projeto é uma **Login Page** feita em PHP, permitindo que o usuário informe seu e-mail/usuário e senha para acessar o sistema.

## 🚀 Tecnologias

* 🐘 PHP
* 🌐 HTML5
* 🗄️ MySQL



## ⚙️ Como executar

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/login-page.git
```

### 2. Entre na pasta

```bash
cd login-page
```

### 3. Configure o banco de dados

Importe o arquivo:

```text
sql
```

no seu MySQL.

Depois configure as informações do banco no arquivo PHP responsável pela conexão.

### 4. Inicie o servidor

Se estiver usando PHP instalado:

```bash
php -S localhost:8000
```

Depois acesse:

```text
http://localhost:8000
```

## 🔑 Funcionalidades

* ✅ Login de usuários
* ✅ Cadastro de usuários
* ✅ Senhas protegidas
* ✅ Sessão de usuário
* ✅ Logout
* ✅ Conexão com MySQL
* ✅ Interface responsiva

## 🛡️ Segurança

O projeto utiliza boas práticas básicas de segurança, como:

* `password_hash()` para armazenar senhas
* `password_verify()` para verificar senhas
* Sessões PHP
* Prepared Statements para consultas ao banco

> ⚠️ Este projeto é destinado principalmente para estudo e aprendizado. Para uso em produção, recomenda-se implementar proteções adicionais.





## 📄 Licença

Este projeto está disponível para fins de estudo e pode ser modificado conforme necessário.

---

⭐ Se este projeto foi útil para você, considere deixar uma estrela no repositório!
