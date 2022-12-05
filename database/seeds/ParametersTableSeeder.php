<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Parameter;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT setting_parameters ON');
        try
        {
            $data = [
                [
                    'id' => 1,
                    'key_setting' => 'minimal',
                    'value' => 0,
                ],
                [
                    'id' => 2,
                    'key_setting' => 'maksimal',
                    'value' => 0,
                ],                
            ];
    
            foreach ($data as $key => $value) {
                $parameter = Parameter::find($value['id']);
    
                if(empty($parameter))
                {
                    $parameter = new Parameter();
                }
    
                $parameter->id = $value['id'];
                $parameter->key_setting = $value['key_setting'];
                $parameter->value = $value['value'];
                $parameter->save();
            }
            
            DB::commit();            
            DB::unprepared('SET IDENTITY_INSERT setting_parameters OFF');
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
