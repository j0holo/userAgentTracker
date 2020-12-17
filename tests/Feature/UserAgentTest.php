<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\UserAgents;

class UserAgentTest extends TestCase
{
    use RefreshDatabase;

    public function testTopTenUriOfWeek()
    {
        $userAgent = UserAgents::factory()->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
        ]);

        $results = UserAgents::topTenURIOfWeek();

        $this->assertEquals($userAgent->uri, $results[0]->uri);
        $this->assertEquals(1, $results[0]->count);
    }

    public function testTopTenUriOfWeekMultipleInsertsSameUri()
    {
        $default_uri = '/';
        $userAgents = UserAgents::factory()->count(5)->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
            'uri' => $default_uri,
        ]);

        $results = UserAgents::topTenURIOfWeek();

        foreach ($userAgents as $userAgent) {
            $this->assertEquals($userAgent->uri, $default_uri);
        }

        $this->assertEquals(5, $results[0]->count);
    }

    public function testTopTenUriOfWeekMultipleInsertsDifferentUri()
    {
        $uri_1 = '/';
        $uri_2 = '/admin';
        $userAgent1 = UserAgents::factory()->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
            'uri' => $uri_1,
        ]);
        $userAgent2 = UserAgents::factory()->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
            'uri' => $uri_2,
        ]);

        $results = UserAgents::topTenURIOfWeek();
        $this->assertEquals(1, $results[0]->count);
        $this->assertEquals(1, $results[1]->count);
    }

    public function testTopTenUserAgentsOfWeek()
    {
        $userAgent = UserAgents::factory()->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
        ]);

        $results = UserAgents::topTenUserAgentsOfWeek();


        $this->assertEquals($userAgent->user_agent, $results[0]->user_agent);
        $this->assertEquals(1, $results[0]->count);
    }

    public function testTopTenUserAgentsOfWeekMultipleInsertsSameAgent()
    {
        $default_agent = 'google.com';
        $userAgents = UserAgents::factory()->count(5)->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
            'user_agent' => $default_agent,
        ]);

        $results = UserAgents::topTenUserAgentsOfWeek();

        foreach ($userAgents as $userAgent) {
            $this->assertEquals($userAgent->user_agent, $default_agent);
        }

        $this->assertEquals(5, $results[0]->count);
    }

    public function testTopTenUserAgentsOfWeekMultipleInsertsDifferentAgents()
    {
        $userAgent1 = UserAgents::factory()->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
            'user_agent' => 'foo',
        ]);
        $userAgent2 = UserAgents::factory()->create([
            // The current timestamp, so the user_agent always shows up in the query.
            'visited_at' => date("Y-m-d H:i:s"),
            'user_agent' => 'bar',
        ]);

        $results = UserAgents::topTenUserAgentsOfWeek();
        $this->assertEquals(1, $results[0]->count);
        $this->assertEquals(1, $results[1]->count);
    }
}
