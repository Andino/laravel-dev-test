<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDtoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name} {properties?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DTO class similar of what the make:model does';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->argument('name');
        $properties = $this->argument('properties');

        $dtoDirectory = app_path('DTO');
        $dtoPath = "{$dtoDirectory}/{$name}.php";

        if (!File::exists($dtoDirectory)) {
            File::makeDirectory($dtoDirectory);
        }

        if (File::exists($dtoPath)) {
            $this->error('DTO already exists!');
            return;
        }

        $propertiesArray = $this->generatePropertiesString($properties);

        $stub = $this->generateStub($name, $propertiesArray);

        File::put($dtoPath, $stub);

        $this->info("DTO {$name} created successfully.");
    }

    /**
     * Creates the properties array list for the DTO.
     *
     * @param array $properties
     * @return string
     */
    protected function generatePropertiesString(array $properties): string
    {
        return collect($properties)
            ->map(function ($property) {
                [$type, $name] = explode(':', $property);
                return "public {$type} \${$name};";
            })
            ->implode("\n    ");
    }

    /**
     * Generate the stub content for the DTO class.
     *
     * @param string $name
     * @param string $propertiesString
     * @return string
    */
    protected function generateStub($name, $propertiesString): string
    {
        return <<<EOT
        <?php

        namespace App\DTO;

        use Spatie\DataTransferObject\DataTransferObject;

        class {$name} extends DataTransferObject
        {
            {$propertiesString}
        }
        
        EOT;
    }
}
