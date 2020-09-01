<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class TouristTest extends TestCase
{
    use RefreshDatabase;

    protected $locales;

    protected function setUp(): void
    {
        parent::setUp();

        $this->locales = locales();
    }

    /**
     * Check that tourist can view login form
     *
     * @return void
     */
    public function test_tourist_can_view_a_login_form()
    {
        $locales = locales();
        foreach($locales as $locale) {
            $route = localized_route('tourist.login', [], $locale);
            $response = $this->get($route);
            $response->assertStatus(200);
            $response->assertViewIs('tourist.login');
        }
    }


    /**
     * Check that tourist cannot view login form when authenticated
     *
     * @return void
     */
    public function test_tourist_cannot_view_a_login_form_when_authenticated()
    {
         $user = factory(User::class)->make();

         foreach($this->locales as $locale) {
            $route = localized_route('tourist.login', [], $locale);
            $response = $this->actingAs($user)->get($route);
            $localized_home = localized_route('/');
            $response->assertRedirect($localized_home);
         }
    }


    /**
     * Check that tourist can login with correct credentials
     *
     * @return void
     */
    public function test_tourist_can_login_with_correct_credentails()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'tourist-password'),
        ]);

        $response = $this->post('/tourist/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect(localized_route('tourist.home'));
        $this->assertAuthenticatedAs($user);
    }


    /**
     * Check that tourist cannot login with incorrect credentials
     *
     * @return void
     */
    public function test_tourist_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('tourist-password'),
        ]);

        $response = $this->from('/tourist/login')->post('/tourist/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/tourist/login');
        $errors = session('error');
        $this->assertEquals($errors, __("Incorrect e-mail address or password"));
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

}
