<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT colors ON');
        try
        {
            $data = [
                [
                    'id' => 1,
                    'code' => '#3699FF'
                ],
                [
                    'id' => 2,
                    'code' => '#1BC5BD'
                ],
                [
                    'id' => 3,
                    'code' => '#FFA800'
                ],
                [
                    'id' => 4,
                    'code' => '#FFC700'
                ],
                [
                    'id' => 5,
                    'code' => '#F1416C'
                ],
                
            ];
    
            foreach ($data as $key => $value) {
                $color = Color::find($value['id']);
    
                if(empty($color))
                {
                    $color = new Color();
                }
    
                $color->id = $value['id'];
                $color->code = $value['code'];
                $color->save();
            }
            
            DB::commit();
            DB::unprepared('SET IDENTITY_INSERT colors OFF');            
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
