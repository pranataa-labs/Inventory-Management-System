<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_legacy_admin_path_returns_404(): void
    {
        $this->get('/admin')->assertStatus(404);
    }

    public function test_root_redirects_to_obfuscated_admin_panel(): void
    {
        $adminPrefix = env('ADMIN_PREFIX', 'inventaris-portal-mgmt');
        $response = $this->get('/');
        $response->assertRedirect('/' . $adminPrefix);
    }

    public function test_obfuscated_admin_panel_is_accessible(): void
    {
        $adminPrefix = env('ADMIN_PREFIX', 'inventaris-portal-mgmt');
        $response = $this->get('/' . $adminPrefix . '/login');
        $response->assertStatus(200);
    }
}
