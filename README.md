# 🚀 Gerador de CRUD Completo para Laravel

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-8%2B-FF2D20?logo=laravel)](https://laravel.com)

## 📋 Visão Geral

Pacote Laravel que automatiza a criação de CRUDs completos através de um único comando Artisan. Desenvolvido para aumentar significativamente a produtividade no desenvolvimento de aplicações Laravel.

## ✨ Recursos

- ✅ Geração automática de todos os componentes necessários para um CRUD completo
- ⚡ Tempo de execução: ~30 segundos (contra ~30 minutos manualmente)
- 🏗️ Estrutura organizada seguindo as melhores práticas do Laravel
- 🔄 Fácil customização através de stubs

## 🚀 Como Usar

Execute o seguinte comando no terminal:

```bash
php artisan make:full-crud NomeDoModel
```

### 📌 Opções Disponíveis

| Opção     | Descrição                          |
|-----------|----------------------------------|
| --table   | Nome personalizado da tabela      |
| --force   | Sobrescreve arquivos existentes   |

### Exemplo

```bash
php artisan make:full-crud Produto --table=produtos --force
```

## 🏗 Estrutura Gerada

O comando cria a seguinte estrutura de arquivos:

```
app/
├── Models/NomeDoModel.php
├── Http/
│   ├── Controllers/NomeDoModelController.php
│   ├── Requests/
│   │   ├── NomeDoModelIndexRequest.php
│   │   ├── NomeDoModelStoreRequest.php
│   │   └── NomeDoModelUpdateRequest.php
│   └── Services/NomeDoModelService.php
database/
└── migrations/YYYY_MM_DD_HHMMSS_create_nome_da_tabela_table.php
resources/
└── views/
    └── nome_do_model/
        ├── index.blade.php
        └── add-edit.blade.php
routes/
└── grupos/nome_do_model.php
```

## 🔍 Detalhes Técnicos

### 1. Model
- Classe Eloquent completa
- Configuração automática de:
  - Nome da tabela (plural snake_case)
  - Fillable fields (a serem definidos manualmente)
  - SoftDeletes habilitado por padrão

### 2. Controller
- Métodos RESTful padrão:
  - `index()`, `create()`, `store()`
  - `show()`, `edit()`, `update()`
  - `destroy()`
- Injeção automática do Service

### 3. Service Layer
- Separação da lógica de negócios
- Métodos para:
  - Listagem paginada
  - Busca por ID
  - Operações CRUD completas

### 4. Requests de Validação
- Classes separadas para cada operação:
  - IndexRequest: Filtros e listagem
  - StoreRequest: Validação na criação
  - UpdateRequest: Validação na atualização

### 5. Views
- Templates Blade responsivos
- Mensagens de feedback integradas
- Estrutura pronta para personalização

## 🛠️ Requisitos

- PHP 8.0+
- Laravel 8.0 ou superior
- Extensões PHP padrão do Laravel

## 🔄 Fluxo de Trabalho Recomendado

1. Execute o comando de geração
2. Edite a migration para adicionar colunas
3. Defina os campos `$fillable` no Model
4. Ajuste as validações nos Requests
5. Personalize as views conforme necessário
6. Execute as migrations

## 📄 Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## 👨💻 Autor

**Erickson Nascimento**

> "Automatize o repetitivo e foque no que realmente importa!" - Erickson Nascimento