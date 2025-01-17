<?php

namespace Backpack\Generators\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class RequestBackpackCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backpack:request';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a backpack templated request';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        // check if base_path('stubs/backpack/generators/request.stub') exists, and use that
        if (file_exists(base_path('stubs/backpack/generators/request.stub'))) {
            return base_path('stubs/backpack/generators/request.stub');
        }

        return __DIR__.'/../stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests';
    }
}
