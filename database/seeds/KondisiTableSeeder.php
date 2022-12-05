<?php

use Illuminate\Database\Seeder;
use App\Models\Kondisi;
use Illuminate\Support\Facades\DB;

class KondisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT kondisi ON');
        try
        {
            $data = [
                [
                    'id' => 1,
                    'value' => '>',
                ],
                [
                    'id' => 2,
                    'value' => '=',
                ],
                [
                    'id' => 3,
                    'value' => '<',
                ],    
                [
                    'id' => 4,
                    'value' => '>=',
                ],    
                [
                    'id' => 5,
                    'value' => 'Optimal',
                ]                
            ];
    
            foreach ($data as $key => $value) {
                $kondisi = Kondisi::find($value['id']);
    
                if(empty($kondisi))
                {
                    $kondisi = new Kondisi();
                }
    
                $kondisi->id = $value['id'];
                $kondisi->value = $value['value'];
                $kondisi->save();
            }
            
            DB::commit();            
            DB::unprepared('SET IDENTITY_INSERT kondisi OFF');
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
