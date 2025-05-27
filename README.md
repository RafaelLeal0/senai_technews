# SENAI TechNews

Portal de notícias desenvolvido para a rede escolar **SESI SENAI**, com foco na divulgação de projetos criados pelos alunos da instituição **SESI Caçapava**.

## 📋 Descrição

Este site foi criado para centralizar e compartilhar informações sobre os projetos desenvolvidos pelos estudantes do SESI SENAI. O projeto é um sistema web completo, utilizando **PHP**, **MySQL** e **HTML/CSS**.

---

## 🚀 Como instalar e rodar o projeto

Siga os passos abaixo para configurar o projeto em sua máquina local.

### ✅ Pré-requisitos

* **PHP** (versão 7.4 ou superior)
* **MySQL** ou **MariaDB**
* **Apache** (ou outro servidor compatível, como Nginx)
* **phpMyAdmin** (opcional, mas recomendado para importar o banco de dados)
* **Git**

---

## 🛠️ Passos para instalação

### 1. Clonar o repositório

Abra o terminal e execute o comando:

```bash
git clone https://github.com/RafaelLeal0/senai_technews.git
```

ou, se preferir, baixe o código ZIP diretamente pelo GitHub e extraia na pasta de sua preferência.

---

### 2. Configurar o servidor local

* Copie a pasta `senai_technews` clonada para o diretório `htdocs` do **XAMPP** ou diretório equivalente do seu servidor web.

Exemplo:

```
C:/xampp/htdocs/senai_technews
```

---

### 3. Criar o banco de dados

1. Abra o **phpMyAdmin** (normalmente em: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)).
2. Crie um banco de dados com o nome:

```
senai_technews
```

3. Importe o arquivo `senai_technews.sql` que está na raiz do projeto:

* Clique no banco de dados criado.
* Vá na aba **Importar**.
* Selecione o arquivo `senai_technews.sql`.
* Clique em **Executar**.

---

### 4. Configurar a conexão com o banco de dados

* Verifique o arquivo de configuração de conexão com o banco de dados.
* Normalmente esse arquivo se chama `config.php` ou está localizado em uma pasta `config`.
* Certifique-se de que as seguintes informações estão corretas:

```php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "senai_technews";
```

---

### 5. Acessar o projeto

Abra o navegador e acesse:

```
http://localhost/senai_technews
```

Pronto! O portal **SENAI TechNews** estará funcionando.

---

## 🧑‍💻 Tecnologias utilizadas

* **PHP**
* **MySQL**
* **HTML/CSS**
* **JavaScript**

---

## 🤝 Contribuição

Sinta-se à vontade para contribuir com melhorias ou sugerir novas funcionalidades.

1. Faça um **Fork** do projeto.
2. Crie uma branch com a sua feature:

```bash
git checkout -b minha-feature
```

3. Faça commit das suas alterações:

```bash
git commit -m 'Minha nova feature'
```

4. Faça push para a branch:

```bash
git push origin minha-feature
```

5. Abra um **Pull Request**.

---

## 📄 Licença

Este projeto é de uso educacional, para fins de aprendizagem e divulgação de projetos escolares.

---

## 📧 Contato

Caso tenha dúvidas ou sugestões, entre em contato:

* **Desenvolvedores**: Andrey Montibeller, Gustavo Martins, Rafael Leal, Rian Eduardo e Samuel Boaz
