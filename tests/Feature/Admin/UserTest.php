<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Providers\RouteServiceProvider;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // 未ログインのユーザーが会員一覧ページにアクセスできない
    public function test_guest_cannot_access_admin_users_index()
    {
        
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'wrong_password',
        ]);
        $response = $this->get('/admin/users');

        $response->assertRedirect('/login');
    }

    // ログイン済みの一般ユーザーが会員一覧ページにアクセスできない
    public function test_regular_user_cannot_access_admin_users_index(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(403); // Forbidden
    }

    // ログイン済みの管理者が会員一覧ページにアクセスできる
    public function test_admin_can_access_admin_users_index(): void
    {
        $admin = new Admin();
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();
        
        $user = User::factory()->create();
        
        // 管理者としてログインして会員一覧ページにアクセスする  
        $response = $this->actingAs($admin)->get('/admin/users');
    
        $response->assertStatus(200);
    }
  
    // 未ログインのユーザーが会員詳細ページにアクセスできない
    public function test_guest_cannot_access_admin_users_show(): void
    {
        // $user = User::factory()->create();
    
        $response = $this->get("/admin/users/1");
    
        $response->assertRedirect('/login');
    }

    // ログイン済みの一般ユーザーが会員詳細ページにアクセスできない
    public function test_regular_user_cannot_access_admin_users_show(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'password',
        ]);       
        $response = $this->actingAs($user)->get("/admin/users/1");
    
        $response->assertStatus(403); // Forbidden
    }
    
    // ログイン済みの管理者が会員詳細ページにアクセスできる
    public function test_admin_can_access_admin_users_show(): void
    {
        $admin = new Admin();
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();
        
        $user = User::factory()->create();
       
        $response = $this->actingAs($admin)->get("/admin/users/1");
    
        $response->assertStatus(200);
    }
    

       
}
