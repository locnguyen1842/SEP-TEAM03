<?php

namespace Tests\Unit;
use App\Customer;
use Tests\TestCase;
use App\Address;
use App\Http\Controllers\HomeController;
use Hash;
use Session;
use App\Http\Controllers\Auth\CustomerLoginController;
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
        
    }
   public function test_success_create_customers(){


        $user = Customer::latest()->first();
        $user->address()->delete();
        $user->delete();
           $response= $this->post('dang-ky', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'address' =>'tran hung dao',
            'tinh_tp' =>'89',
            'quan_huyen' =>'883',
            'xa_phuong' =>'30463',
            'phone' =>'01632530666',
            'repassword' =>'secret',
            


        ]);

       

       $this->assertEquals('John Doe', $user->name);
       $this->assertEquals('john@example.com', $user->email);
       $this->assertTrue(Hash::check('secret', $user->password));
       

   }
}
