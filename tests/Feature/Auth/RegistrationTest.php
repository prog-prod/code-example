<?php

namespace Tests\Feature\Auth;

use App\Facades\LogServiceFacade;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->withoutMiddleware(ThrottleRequests::class);
        $this->withoutExceptionHandling();
        $phone = '383343434333';
        $this->post(route('send-code'), [
            'phone' => $phone
        ]);
        $log = LogServiceFacade::getPhoneCodeLogByPhone($phone); // 34-34-34
        $code = $log->code;

        $this->post(route('verify-phone'), [
            'phone' => $phone,
            'code' => $code
        ]);

        $response = $this->post('/register', [
            'firstName' => 'Test User',
            'lastName' => 'Test User',
            'email' => 'test@example.com',
            'phone' => $phone,
            'confirm_phone_code' => $code,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
