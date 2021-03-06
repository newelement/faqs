<?php
namespace Newelement\Faqs\Commands;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Newelement\Faqs\Traits\Seedable;
use Newelement\Faqs\FaqsServiceProvider;

class UpdateCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../../publishable/database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'faqs:update';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the FAQs package';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            ['with-data', null, InputOption::VALUE_NONE, 'Install with default data', null],
        ];
    }

    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }
        return 'composer';
    }
    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    public function handle(Filesystem $filesystem)
    {
        $this->info('Updating assets, database, views and config files...');

        $this->info('Migrating any database changes...');
        $this->call('migrate', ['--force' => $this->option('force')]);

        $this->info('Dumping the autoloaded files and reloading all new files...');
        $composer = $this->findComposer();
        $process = new Process([$composer.' dump-autoload']);
        $process->setTimeout(null);
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Seeding data into the database');
        $this->call('db:seed', ['--class' => 'Newelement\\Faqs\\Database\\Seeds\\FaqsDatabaseSeeder']);

        $initData = $this->ask('Do you want to update the theme views? CAUTION this will overwrite any views you may have altered. If you do not update the views you may need to update them manually. See documentation for more info. [Y/N]');

        if( $initData === 'y' || $initData === 'Y' ){
            $this->call('vendor:publish', ['--provider' => 'Newelement\Faqs\FaqsServiceProvider', '--tag' => 'views', '--force' => true ]);
        }
        $this->call('vendor:publish', ['--provider' => 'Newelement\Faqs\FaqsServiceProvider', '--tag' => 'adminviews', '--force' => true ]);

        $this->info('Updating assets...');
        $this->call('vendor:publish', ['--provider' => 'Newelement\Faqs\FaqsServiceProvider', '--tag' => 'public', '--force' => true ]);

        $this->info('Clearing application cache...');
        \Storage::disk('public')->delete('assets/css/all.css');
        \Storage::disk('public')->delete('assets/js/all.js');
        $this->call('cache:clear');

        $this->info('Successfully updated Faqs.');

    }
}
