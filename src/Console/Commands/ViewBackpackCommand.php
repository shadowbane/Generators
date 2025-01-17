<?php

namespace Backpack\Generators\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ViewBackpackCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backpack:view';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:view {name} {--plain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a backpack templated view';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('plain')) {
            // check if base_path('stubs/backpack/generators/view-plain.stub') exists, and use that
            if (file_exists(base_path('stubs/backpack/generators/view-plain.stub'))) {
                return base_path('stubs/backpack/generators/view-plain.stub');
            }

            return __DIR__.'/../stubs/view-plain.stub';
        }

        // check if base_path('stubs/backpack/generators/view.stub') exists, and use that
        if (file_exists(base_path('stubs/backpack/generators/view.stub'))) {
            return base_path('stubs/backpack/generators/view.stub');
        }

        return __DIR__.'/../stubs/view.stub';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $name = $this->getNameInput();

        $path = $this->getPath($name);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already existed!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $name
     * @return bool
     */
    protected function alreadyExists($name)
    {
        return $this->files->exists($this->getPath($name));
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->laravel['path'].'/../resources/views/'.str_replace('\\', '/', $name).'.blade.php';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        return $this->files->get($this->getStub());
    }
}
