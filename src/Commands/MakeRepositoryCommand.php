<?php

namespace HeroSeguros\HeroLaravelLibrary\Commands;

use Illuminate\Console\Command;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $args = $this->arguments();

            if ($args['model'] == null) {
                $this->error('Invalid arguments');
                return;
            }

            if (class_exists('App\\Models\\' . $args['model'])) {
                $this->error('Model not found');
                return;
            }

            $phpFileContent = file_get_contents(__DIR__ . '/../Templates/Repository.php');

            $phpFileContent = str_replace('%modelname%', $args['model'], $phpFileContent);

            $projectPath = app_path() ?? null;

            if (is_null($projectPath)) {
                $this->error('Project path not found');
                return;
            }

            if (!is_dir($projectPath . '/Repositories')) {
                mkdir($projectPath . '/Repositories');
            }

            if (file_exists($projectPath . '/Repositories/' . $args['model'] . 'Repository.php')) {
                $this->error('Repository already exists');
                return;
            }

            file_put_contents($projectPath . '/Repositories/' . $args['model'] . 'Repository.php', $phpFileContent);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
