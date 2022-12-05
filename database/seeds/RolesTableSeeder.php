<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT roles ON');
        try
        {
            $data = [
                [
                    'id' => 1,
                    'name' => 'Admin',
                    'slug' => 'admin',
                    'created_by' => null,
                    'updated_by' => null,
                    'deleted_by' => null
                ],
                [
                    'id' => 4,
                    'name' => 'Unit',
                    'slug' => 'unit',
                    'created_by' => null,
                    'updated_by' => null,
                    'deleted_by' => null
                ],
                [
                    'id' => 3,
                    'name' => 'Korporat',
                    'slug' => 'korporat',
                    'created_by' => null,
                    'updated_by' => null,
                    'deleted_by' => null
                ],
                [
                    'id' => 2,
                    'name' => 'Direksi',
                    'slug' => 'direksi',
                    'created_by' => null,
                    'updated_by' => null,
                    'deleted_by' => null
                ]
            ];
    
            foreach ($data as $key => $value) {
                $role = Role::withoutGlobalScope('isActive')->find($value['id']);
    
                if(empty($role))
                {
                    $role = new Role();
                }
    
                $role->id = $value['id'];
                $role->name = $value['name'];
                $role->slug = $value['slug'];
                $role->save();
            }
            
            DB::commit();        
            DB::unprepared('SET IDENTITY_INSERT roles OFF');    
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
