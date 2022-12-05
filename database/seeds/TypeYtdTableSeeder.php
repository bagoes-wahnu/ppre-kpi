<?php

use Illuminate\Database\Seeder;
use App\Models\TypeYtd;
use Illuminate\Support\Facades\DB;

class TypeYtdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT type_ytd ON');
        try
        {
            $data = [
                [
                    'id' => 1,
                    'value' => 'Accumulated',
                ],
                [
                    'id' => 2,
                    'value' => 'Average',
                ],
                [
                    'id' => 3,
                    'value' => 'Last Value',
                ],    
                [
                    'id' => 4,
                    'value' => 'Min',
                ],    
                [
                    'id' => 5,
                    'value' => 'Max',
                ]                
            ];
    
            foreach ($data as $key => $value) {
                $typeYtd = TypeYtd::find($value['id']);
    
                if(empty($typeYtd))
                {
                    $typeYtd = new TypeYtd();
                }
    
                $typeYtd->id = $value['id'];
                $typeYtd->value = $value['value'];
                $typeYtd->save();
            }
            
            DB::commit();            
            DB::unprepared('SET IDENTITY_INSERT type_ytd OFF');
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
