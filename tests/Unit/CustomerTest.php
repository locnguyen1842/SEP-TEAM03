<?php

namespace Tests\Unit;
use App\Customer;
use Tests\TestCase;
use App\Http\Controllers\PageController;
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
        Customer::query()->delete();
     }
    public function test_that_can_create_customer()
    {	

    	$data = [
        	'name'=>'Loc',
        	'email'=>'haimuoibon024@gmail.com',
        	'password'=>'password',
           
        	'phone'=>'01632530666',
        	
        	
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
