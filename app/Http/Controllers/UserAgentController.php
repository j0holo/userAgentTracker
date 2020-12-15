<?php

namespace App\Http\Controllers;

use App\Models\UserAgents;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAgentController extends Controller
{
    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function get(Request $request)
    {
        $results = UserAgents::getRequestedUserAgents(
            request('uri', ''),
            request('user_agent', ''),
            request('status_code', '')
        );

        if (request('json') === 'on' or \request('json') === 'true') {
            return response()->json($results);
        }
        return view('home', ['results' => $results]);
    }

    /**
     * Show a page with various statistics of user-agents that visited this website.
     *
     * @param Request $request
     * @return View
     */
    public function summary(Request $request): View
    {
        return view('summary', [
            'topTenUriOfWeek' => UserAgents::topTenURIOfWeek(),
            'topTenUserAgentsOfWeek' => UserAgents::topTenUserAgentsOfWeek(),
            'topTenURI' => UserAgents::topTenURI(),
            'topTenUserAgents' => UserAgents::topTenUserAgents(),
        ]);
    }
}
