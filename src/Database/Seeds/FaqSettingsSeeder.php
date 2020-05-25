<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Newelement\Faqs\Models\FaqSetting;

class FaqSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqSetting::firstOrCreate(
            [ 'setting_name' => 'enable_search' ],
            [ 'bool_value' => 0 ]
        );
        FaqSetting::firstOrCreate(
            [ 'setting_name' => 'show_groups' ],
            [ 'bool_value' => 0 ]
        );
        FaqSetting::firstOrCreate(
            [ 'setting_name' => 'display_style' ],
            [ 'string_value' => 'list' ]
        );
        FaqSetting::firstOrCreate(
            [ 'setting_name' => 'collapse_faqs' ],
            [ 'bool_value' => 1 ]
        );
        FaqSetting::firstOrCreate(
            [ 'setting_name' => 'helpful_voting' ],
            [ 'bool_value' => 0 ]
        );

        FaqSetting::firstOrCreate(
            [ 'setting_name' => 'no_results_message' ],
            [ 'text_value' => 'Sorry, no results found. Please contact our support department.' ]
        );
    }
}
