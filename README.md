# Projeto Laravel: Gerenciamento de Serviços Automotivos

## Descrição

Este projeto é uma aplicação web desenvolvida em **Laravel** para gerenciamento de clientes, veículos, mecânicos e serviços automotivos. Possui cadastro de clientes, carros, categorias de serviços, mecânicos e serviços realizados, com relacionamento **many-to-many** entre serviços e categorias.

---

## Tecnologias

* PHP 8.x
* Laravel 10.x
* SQLite (banco de dados de desenvolvimento)
* Blade Templates
* Bootstrap 5
* Font Awesome

---

## Funcionalidades

* Cadastro e listagem de **Clientes**.
* Cadastro e listagem de **Carros**, vinculados a clientes.
* Cadastro de **Categorias de Serviços**.
* Cadastro e listagem de **Mecânicos**.
* Cadastro de **Serviços**, associando múltiplas categorias a cada serviço.
* Pesquisa de serviços por cliente, telefone, placa do carro ou categoria.
* Relatórios simples e gráficos (via `ServicoChart`).

---

## Estrutura do Banco de Dados

* **clientes**: armazena dados do cliente (nome, CPF, telefone).
* **carros**: armazena dados do veículo (placa, marca, modelo) e referência ao cliente.
* **categoria_servicos**: categorias de serviços oferecidos.
* **mecanicos**: dados de mecânicos.
* **servicos**: registro de serviços realizados, com relacionamento many-to-many com categorias via **categoria_servico** (tabela pivô).

**Relacionamento Many-to-Many:**

```
servicos <-- categoria_servico --> categoria_servicos
```

---

## Instalação

1. Clone o repositório:

```bash
git clone <URL_DO_REPOSITORIO>
cd projetolaravel-A-L-2025-2
```

2. Instale as dependências via Composer:

```bash
composer install
```

3. Copie o arquivo de ambiente e gere a chave:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure o banco de dados SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/para/database.sqlite
```

> Obs: Crie o arquivo SQLite se ainda não existir:

```bash
touch database/database.sqlite
```

5. Rode migrations e seeders:

```bash
php artisan migrate:fresh --seed
```

6. Inicie o servidor local:

```bash
php artisan serve
```

Acesse em `http://127.0.0.1:8000`.

---

## Uso

* Acesse `/servico` para listar os serviços.
* Acesse `/servico/create` para cadastrar um novo serviço.
* Ao criar um serviço, selecione **cliente**, **carro** e **categorias** (múltiplas categorias podem ser selecionadas).
* Use o formulário de pesquisa para filtrar serviços por cliente, telefone, placa ou categoria.

---

## Observações

* O relacionamento entre **serviços** e **categorias** é feito via tabela pivô `categoria_servico`.
* As factories e seeders já estão preparadas para popular o banco com dados de teste.
* Não há coluna `categoria_id` na tabela `servicos`; todas as categorias são vinculadas via pivot table.

---

## Autor

**Angelo Antonio Lucietto e Lucas Ferron da Silva**
Projeto desenvolvido como atividade acadêmica/educacional.
