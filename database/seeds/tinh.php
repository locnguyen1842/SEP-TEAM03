<?php


use Illuminate\Database\Seeder;

class tinh extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tinh_tp')->delete();
        $json = file_get_contents("public/source/tinh_tp.json");
        $data = json_decode($json,true);
        foreach($data as $obj){
            $tableArray = [
            'name' =>$obj['name'],
            'slug' =>$obj['slug'],
            'type' =>$obj['type'],
            'name_with_type' =>$obj['name_with_type'],
            'code' =>$obj['code'],
             ]; 
        	// DB::table('tinh_tp')->insert(array(
        	// 	'name' => $obj->name,
        	// 	'slug' => $obj->slug,
        	// 	'type' => $obj->type,
        	// 	'name_with_type' => $obj->name_with_type,
        	// 	'code' => $obj->code

        	//  ));
            $icd = DB::table('tinh_tp')->insert($tableArray ); 
        }
    }
}
