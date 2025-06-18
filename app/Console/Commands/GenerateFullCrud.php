<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class GenerateFullCrud extends Command
{
    protected $signature = 'make:full-crud 
                            {name : The name of the model (singular)}
                            {--table= : The table name (optional)}
                            {--force : Overwrite existing files}';
    
    protected $description = 'Generate complete CRUD structure (Model, Controller, Service, Requests, Views, Migration, Routes)';

    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $modelName = trim($this->argument('name'));
        $tableName = $this->option('table') ?: Str::snake(Str::plural($modelName));
        $force = $this->option('force');

        // Define all variables to replace in stubs
        $replacements = [
            '{{model}}' => $modelName,
            '{{modelLower}}' => Str::lower($modelName),
            '{{modelPlural}}' => Str::plural($modelName),
            '{{modelPluralLower}}' => Str::lower(Str::plural($modelName)),
            '{{table}}' => $tableName,
            '{{routeParam}}' => Str::lower($modelName),
        ];

        // Generate all components
        $this->generateModel($replacements, $force);
        $this->generateRequests($replacements, $force);
        $this->generateService($replacements, $force);
        $this->generateController($replacements, $force);
        $this->generateMigration($replacements, $force);
        $this->generateViews($replacements, $force);
        $this->generateRoutes($replacements, $force);

        // Add route to web.php
        $this->addRouteToWeb($modelName);
        
        // Executa as migrations automaticamente
        $this->call('migrate');

        $this->info("CRUD structure for {$modelName} generated successfully!");
    }

    protected function generateModel($replacements, $force)
    {
        $stub = $this->getStub('model');
        $content = $this->replacePlaceholders($stub, $replacements);
        
        $path = app_path("Models/{$replacements['{{model}}']}.php");
        
        $this->writeFile($path, $content, $force);
    }

    protected function generateRequests($replacements, $force)
    {
        $requestTypes = ['index', 'store', 'update'];
        
        foreach ($requestTypes as $type) {
            $stub = $this->getStub("requests/{$type}-request");
            $content = $this->replacePlaceholders($stub, $replacements);
            
            $directory = app_path("Http/Requests/{$replacements['{{model}}']}");
            if (!$this->filesystem->exists($directory)) {
                $this->filesystem->makeDirectory($directory, 0755, true);
            }
            
            $path = "{$directory}/{$type}{$replacements['{{model}}']}Request.php";
            $this->writeFile($path, $content, $force);
        }
    }

    protected function generateService($replacements, $force)
    {
        $stub = $this->getStub('service');
        $content = $this->replacePlaceholders($stub, $replacements);
        
        $path = app_path("Services/{$replacements['{{model}}']}Service.php");
        
        $this->writeFile($path, $content, $force);
    }

    protected function generateController($replacements, $force)
    {
        $stub = $this->getStub('controller');
        $content = $this->replacePlaceholders($stub, $replacements);
        
        $path = app_path("Http/Controllers/{$replacements['{{model}}']}Controller.php");
        
        $this->writeFile($path, $content, $force);
    }

    protected function generateMigration($replacements, $force)
    {
        $stub = $this->getStub('migration');
        $content = $this->replacePlaceholders($stub, $replacements);
        
        $tableName = $replacements['{{table}}'];
        $timestamp = date('Y_m_d_His');
        $fileName = "{$timestamp}_create_{$tableName}_table.php";
        
        $path = database_path("migrations/{$fileName}");
        
        $this->writeFile($path, $content, $force);
    }

    protected function generateViews($replacements, $force)
    {
        $viewTypes = ['index', 'add-edit'];
        
        foreach ($viewTypes as $type) {
            $stub = $this->getStub("views/{$type}");
            $content = $this->replacePlaceholders($stub, $replacements);
            
            $directory = resource_path("views/{$replacements['{{modelLower}}']}");
            if (!$this->filesystem->exists($directory)) {
                $this->filesystem->makeDirectory($directory, 0755, true);
                $this->info("Created directory: {$directory}");
            }
            
            $path = "{$directory}/{$type}.blade.php";
            $this->writeFile($path, $content, $force);
        }
    }

    protected function generateRoutes($replacements, $force)
    {
        $stub = $this->getStub('routes');
        $content = $this->replacePlaceholders($stub, $replacements);
        
        $directory = base_path('routes/grupos');
        if (!$this->filesystem->exists($directory)) {
            $this->filesystem->makeDirectory($directory, 0755, true);
        }
        
        $path = "{$directory}/{$replacements['{{modelLower}}']}.php";
        $this->writeFile($path, $content, $force);
    }

    protected function addRouteToWeb($modelName)
    {
        $webPath = base_path('routes/web.php');
        $modelLower = Str::lower($modelName);
        $routeCode = "Route::middleware('web')\n    ->group(function() {\n        require base_path('routes/grupos/{$modelLower}.php');\n    });";
        
        $content = $this->filesystem->get($webPath);
        
        // Check if route already exists
        if (strpos($content, "routes/grupos/{$modelLower}.php") === false) {
            $content .= "\n\n{$routeCode}\n";
            $this->filesystem->put($webPath, $content);
            $this->info("Route added to web.php");
        } else {
            $this->warn("Route already exists in web.php - skipped");
        }
    }

    protected function getStub($type)
    {
        $stubPath = base_path("stubs/{$type}.stub");
        
        if (!$this->filesystem->exists($stubPath)) {
            throw new \Exception("Stub not found: {$stubPath}");
        }
        
        return $this->filesystem->get($stubPath);
    }

    protected function replacePlaceholders($content, $replacements)
    {
        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            $content
        );
    }

    protected function writeFile($path, $content, $force)
    {
        if ($this->filesystem->exists($path) && !$force) {
            $this->warn("File already exists: {$path} (use --force to overwrite)");
            return false;
        }

        $this->filesystem->put($path, $content);
        $this->info("Created: {$path}");
        return true;
    }
}