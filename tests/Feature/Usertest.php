<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Usertest extends TestCase
{   

    public function tesetGetSuccess(){
        $this->seed([UserSeeder::class]);
        $this->get('/api/users/current',[
            'Authorization'=>'test'
        ])->assertStatus(200)
            ->assertJson([
                'data'=>[
                    'username'=>'test',
                    'name'=>'test'
                ]
            ]);
    }
}
