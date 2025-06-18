<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandos Personalizados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .code-block {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.25rem;
            font-family: 'Courier New', Courier, monospace;
            margin: 1rem 0;
            overflow-x: auto;
        }
        .feature {
            margin: 2rem 0;
            padding: 1.5rem;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
        .footer {
            background-color: #212529;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><i class="bi bi-terminal me-2"></i> Comandos Personalizados</h1>
                    <p class="lead">Gerencie e execute comandos personalizados de forma simples e organizada</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="mb-4">Sobre o Projeto</h2>
                <p>Este é um sistema desenvolvido em Laravel para gerenciamento de comandos personalizados, permitindo:</p>
                
                <div class="feature">
                    <h3>
                        <i class="bi bi-code-slash feature-icon"></i>
                        Criação de Comandos</h3>
                    <p>Cadastre comandos personalizados com nome, descrição e o comando a ser executado.</p>
                </div>

                <div class="feature">
                    <h3>
                        <i class="bi bi-collection feature-icon"></i>
                        Organização por Grupos</h3>
                    <p>Organize seus comandos em grupos para melhor gerenciamento.</p>
                </div>

                <div class="feature">
                    <h3>
                        <i class="bi bi-shield-lock feature-icon"></i>
                        Segurança</h3>
                    <p>Controle de acesso para garantir que apenas usuários autorizados possam executar comandos.</p>
                </div>

                <h3 class="mt-5 mb-3">Como Usar</h3>
                <p>1. Clone o repositório:</p>
                <div class="code-block">
git clone https://github.com/EricksonFerreira/comandos_personalizados.git
cd comandos_personalizados
                    </div>

                <p>2. Instale as dependências:</p>
                <div class="code-block">
composer install
cp .env.example .env
php artisan key:generate
                </div>

                <p>3. Configure o banco de dados no arquivo <code>.env</code> e execute as migrações:</p>
                <div class="code-block">
php artisan migrate
                </div>

                <p>4. Execute o servidor de desenvolvimento:</p>
                <div class="code-block">
php artisan serve
                </div>

                <h3 class="mt-5 mb-3">Estrutura do Projeto</h3>
                <ul>
                    <li><code>app/Console/Commands/</code> - Comandos personalizados do Artisan</li>
                    <li><code>app/Http/Controllers/</code> - Controladores da aplicação</li>
                    <li><code>app/Models/</code> - Modelos Eloquent</li>
                    <li><code>database/migrations/</code> - Migrações do banco de dados</li>
                    <li><code>resources/views/</code> - Views da aplicação</li>
                    <li><code>routes/</code> - Rotas da aplicação</li>
                </ul>

                <div class="alert alert-info mt-5">
                    <h4><i class="bi bi-github me-2"></i> Contribuição</h4>
                    <p>Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e enviar pull requests.</p>
                    <a href="https://github.com/EricksonFerreira/comandos_personalizados" class="btn btn-outline-primary mt-2" target="_blank">
                        <i class="bi bi-github me-1"></i> Ver no GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2025 Comandos Personalizados. Todos os direitos reservados.</p>
                    <p class="mb-0 mt-2">
                        <a href="https://github.com/EricksonFerreira" class="text-white me-3" target="_blank">
                            <i class="bi bi-github"></i> GitHub
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>