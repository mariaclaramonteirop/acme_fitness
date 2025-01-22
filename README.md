
# ACME Fitness E-Commerce


## Tecnologias
- PHP 7+
- Slim Framework
- Composer
- MySQL

## Instalação e Configuração

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/mariaclaramonteirop/acme_fitness.git
   cd acme_fitness
   ```

2. **Instale as dependências:**
   Certifique-se de que o [Composer](https://getcomposer.org/) está instalado e execute:
   ```bash
   composer install
   ```

3. **Configure o banco de dados:**
   - Crie um banco de dados no MySQL.
   - Importe o arquivo `sql.sql` fornecido no repositório.
   - Renomeie o arquivo `.env copy` que contém os dados do banco.

4. **Inicie o servidor local:**
   Com o Slim Framework configurado, você pode rodar o servidor embutido do PHP:
   ```bash
   php -S localhost:8080 -t public
   ```

5. **Teste as rotas:**
   Utilize ferramentas como Postman ou Insomnia para realizar requisições HTTP na API.

---

## Repositório
[ACME Fitness no GitHub](https://github.com/mariaclaramonteirop/acme_fitness)
```
