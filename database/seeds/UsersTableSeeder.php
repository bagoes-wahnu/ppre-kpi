<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT users ON');
        try
        {
            $data = [
                [
                    'id' => 1,
                    'role_id' => 1,
                    'organization_id' => null,
                    'username' => 'admin',
                    'name' => 'Admin',
                    'password' => bcrypt('123456'),
                    'pic' => null,
                    'unit' => null
                ]
            ];

            foreach ($data as $key => $value) {
                $user = User::withoutGlobalScopes(['isActive', 'checkRoleIsActive'])->find($value['id']);
    
                if(empty($user))
                {
                    $user = new User();
                }
    
                $user->id = $value['id'];
                $user->role_id = $value['role_id'];
                $user->organization_id = $value['organization_id'];
                $user->username = $value['username'];
                $user->password = bcrypt('123456');
                $user->name = $value['name'];
                $user->pic = $value['pic'];
                $user->unit = $value['unit'];

                $user->save();
            }
            
            DB::unprepared('SET IDENTITY_INSERT users OFF');
            DB::commit();
        }
        catch(\Exception $ex)
        {
            DB::rollBack();
			echo $ex->getMessage() . "\n";
        }
    }
}
