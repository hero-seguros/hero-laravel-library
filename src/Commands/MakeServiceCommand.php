<?php

namespace HeroSeguros\HeroLaravelLibrary\Commands;

use Illuminate\Console\Command;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {domain} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $args = $this->arguments();

            //Verificar se os arqumentos estão corretos
            if ($args['domain'] == null || $args['name'] == null) {
                $this->error('Invalid arguments');
                return;
            }

            if (!file_exists(__DIR__ . '/../../' . $args['domain'])) {
                mkdir(__DIR__ . '/../../' . $args['domain']);
            }
            $phpFileContent = file_get_contents(__DIR__ . '/../Templates/Service.php');

            $phpFileContent = str_replace('%domain%', $args['domain'], $phpFileContent);
            $phpFileContent = str_replace('%classname%', $args['name'], $phpFileContent);

            $projectPath = app_path() ?? null;

            if (is_null($projectPath)) {
                $this->error('Project path not found');
                return;
            }

            if (!is_dir($projectPath . '/Services')) {
                mkdir($projectPath . '/Services');
            }

            if (!is_dir($projectPath . '/Services/' . $args['domain'])) {
                mkdir($projectPath . '/Services/' . $args['domain']);
            }

            if (file_exists($projectPath . '/Services/' . $args['domain'] . '/' . $args['name'] . '.php')) {
                $this->error('Service already exists');
                return;
            }

            file_put_contents($projectPath . '/Services/' . $args['domain'] . '/' . $args['name'] . 'Service.php', $phpFileContent);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
