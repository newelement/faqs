<?php
use Illuminate\Database\Seeder;
use Newelement\Faqs\Traits\Seedable;
class FaqsDatabaseSeeder extends Seeder
{
    use Seedable;
    protected $seedersPath = __DIR__.'/';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->seed('MyTableSeeder');

    }
}
