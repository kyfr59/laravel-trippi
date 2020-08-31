<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class TouristTest extends TestCase
{
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
    }
}
