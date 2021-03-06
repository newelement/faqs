<?php
namespace Newelement\Faqs\Commands;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Newelement\Faqs\Traits\Seedable;
use Newelement\Faqs\FaqsServiceProvider;

class InstallCommand extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../../publishable/database/seeds/';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'faqs:install';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Faqs';

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
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
        $this->info('Publishing the Faqs assets, database, and config files');
        // Publish only relevant resources on install

        $this->call('vendor:publish', ['--provider' => FaqsServiceProvider::class]); // , '--tag' => $tags

        $this->info('Migrating the database tables into your application');
        $this->call('migrate', ['--force' => $this->option('force')]);
        $this->info('Dumping the autoloaded files and reloading all new files');

        $composer = $this->findComposer();
        $process = new Process([$composer.' dump-autoload']);
        $process->setTimeout(null);
        $process->setWorkingDirectory(base_path())->run();

        $this->info('Seeding data into the database');
        $this->call('db:seed', ['--class' => 'Newelement\\Faqs\\Database\\Seeds\\FaqsDatabaseSeeder']);

        $this->info('Clearing application cache...');
        \Storage::disk('public')->delete('assets/css/all.css');
        \Storage::disk('public')->delete('assets/js/all.js');
        $this->call('cache:clear');

        $this->info('Successfully installed Faqs. Enjoy!');
    }
}
