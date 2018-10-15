<?php

use Illuminate\Database\Seeder;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default permission roles
        DB::table('system_icons')->delete();

        //================
        //add countries icons
        $countriesIcons = array(
            'estonia' => '/assets/img/icons/countries/estonia.png',
            'finland' => '/assets/img/icons/countries/finland.png',
            'slovakia' => '/assets/img/icons/countries/slovakia.png',
            'spain' => '/assets/img/icons/countries/spain.png',
            'germany' => '/assets/img/icons/countries/germany.png',
        );

        foreach($countriesIcons as $iconkey => $iconpath){

            $countriesIcons = array(
                'category' => 'country',
                'iconkey' => $iconkey,
                'path' => $iconpath
            );
            DB::table('system_icons')->insert($countriesIcons);

        }

        //================
        //add system icons
        $countriesIcons = array(
            'add_to_db_icon' => '/assets/img/icons/system/add_to_db_icon.png',
            'addresses_icon' => '/assets/img/icons/system/addresses_icon.png',
            'buy_icon' => '/assets/img/icons/system/buy_icon.png',
            'company_found_icon' => '/assets/img/icons/system/company_found_icon.png',
            'email_icon' => '/assets/img/icons/system/email_icon.png',
            'fb_icon' => '/assets/img/icons/system/fb_icon.png',
            'gov_found' => '/assets/img/icons/system/gov_found.png',
            'linkedin_icon' => '/assets/img/icons/system/linkedin_icon.png',
            'organisation_found_icon' => '/assets/img/icons/system/organisation_found_icon.png',
            'report_error_icon' => '/assets/img/icons/system/report_error_icon.png',
            'twitter_icon' => '/assets/img/icons/system/twitter_icon.png',
            'www_icon' => '/assets/img/icons/system/www_icon.png',
        );

        foreach($countriesIcons as $iconkey => $iconpath){

            $countriesIcons = array(
                'category' => 'system',
                'iconkey' => $iconkey,
                'path' => $iconpath
            );
            DB::table('system_icons')->insert($countriesIcons);

        }

    }
}
