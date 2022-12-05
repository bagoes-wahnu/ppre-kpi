<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MappingScore;

class MappingScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT setting_mapping_scores ON');

        try
        {
            $data = [
                [
                    'id' => 1,
                    'name' => 'Mapping A',
                    'description' => 'High',
                    'min_value' => 0,
                    'max_value' => 0,
                ],
                [
                    'id' => 2,
                    'name' => 'Mapping B',
                    'description' => 'High - Medium',
                    'min_value' => 0,
                    'max_value' => 0,
                ],
                [
                    'id' => 3,
                    'name' => 'Mapping C',
                    'description' => 'Medium',
                    'min_value' => 0,
                    'max_value' => 0,
                ],
                [
                    'id' => 4,
                    'name' => 'Mapping D',
                    'description' => 'Medium - Low',
                    'min_value' => 0,
                    'max_value' => 0,
                ],
                [
                    'id' => 5,
                    'name' => 'Mapping E',
                    'description' => 'Low',
                    'min_value' => 0,
                    'max_value' => 0,
                ],
                               
            ];
    
            foreach ($data as $key => $value) {
                $mapping_score = MappingScore::find($value['id']);
    
                if(empty($mapping_score))
                {
                    $mapping_score = new MappingScore();
                }
    
                $mapping_score->id = $value['id'];
                $mapping_score->name = $value['name'];
                $mapping_score->description = $value['description'];
                $mapping_score->min_value = $value['min_value'];
                $mapping_score->max_value = $value['max_value'];
                $mapping_score->save();
            }
            
            DB::commit();            
            DB::unprepared('SET IDENTITY_INSERT setting_mapping_scores OFF');

        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
