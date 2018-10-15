<?php

use Illuminate\Database\Seeder;

class AccessTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add default permission roles
        DB::table('cc_accesstypes')->delete();

        //================
        //add access types
        $accessTypes = array(
            '0' => 'data is taken from open source',
            '1' => 'data is taken from closed database',
            '2' => 'data is taken from third party service',
            '3' => 'data is reported by person / company / himself'
        );

        foreach($accessTypes as $accessType => $desciption){

            $accessTypeRow = array(
                'access_type' => $accessType,
                'description' => $desciption
            );
            DB::table('cc_accesstypes')->insert($accessTypeRow);

        }

    }
}
