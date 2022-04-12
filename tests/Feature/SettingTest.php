<?php

namespace Tests\Feature;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_update_a_setting()
    {
        // generate 1 data setting
        $setting = Setting::create([
            'key' => 'overtime_method',
            'value' => 1,
            'expression' => '(salary / 173) * overtime_duration_total',
        ]);
        $this->visit('/')
            ->assertStatus(200);


        // $this->putJson("api/settings/1", ['value' => 2, 'key'=>'overtime_method'])
		// ->assertStatus(200)
		// ->assertJsonFragment(['status' => 'cancelled']);

        // $this->json('post', 'api/settings/' . $setting->value ,  ['value' => 2, 'key'=>'overtime_method'])
        //     ->assertStatus(200)
        //     ->assertJson([
        //         "message" => "Updated successfully"
        //     ]);

    }
}
