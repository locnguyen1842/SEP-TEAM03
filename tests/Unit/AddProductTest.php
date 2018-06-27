<?php

namespace Tests\Unit;
use App\product;
use App\productType;
use Tests\TestCase;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SupplierController;
use Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class CustomerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
     protected $customer;
     public function setUp(){
        parent::setUp();
        product::query()->delete();
     }
    public function test_Add_Product()
    {	

    	$data = [
        	'name'=>'Loc',
        	'id_Type'=>'haimuoibon024@gmail.com',
        	'SKU'=>'password',          
        	'unit_price'=>'01632530666',
            'new'=>'01632530666',
            'unit'=>'01632530666',
            'description'=>'01632530666',
            'promotion_price'=>'01632530666',
            'updated_at'=>'01632530666',
            'supplier_id'=>'01632530666',

        	
        	
        ];
        $controller = new PageController;
        $customer = new Customer($data);
        $customer->save();
        $this->assertEquals($data['name'],$customer->name);
        $this->assertEquals($data['email'],$customer->email);
        $this->assertEquals($data['password'],$customer->password);
        
        $this->assertEquals($data['phone'],$customer->phone);
        
       

    }
}
