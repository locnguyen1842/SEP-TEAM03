<?php

use Illuminate\Database\Seeder;

class quan_huyen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quan_huyen')->delete();
        $json =file_get_contents("public/source/quan_huyen.json");
        $data = json_decode($json,true);
        foreach($data as $obj){
            $tableArray = [
            'name' =>$obj['name'],
            'slug' =>$obj['slug'],
            'type' =>$obj['type'],
            'name_with_type' =>$obj['name_with_type'],
            'path' =>$obj['path'],
            'path_with_type' =>$obj['path_with_type'],
            'parent_code' =>$obj['parent_code'],
            'code' =>$obj['code'],
             ]; 
            $icd = DB::table('quan_huyen')->insert($tableArray); 
        	// quan_huyen::create(array(
        	// 	'name' => $obj->name,
        	// 	'slug' => $obj->slug,
        	// 	'type' => $obj->type,
        	// 	'name_with_type' => $obj->name_with_type,
        	// 	'path' => $obj->path,
        	// 	'path_with_type' => $obj->path_with_type,
        	// 	'parent_code' => $obj->parent_code,
        	// 	'code' => $obj->code,

        	//  ));
        }  
    }
}
