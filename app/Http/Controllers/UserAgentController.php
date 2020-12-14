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
        $query = UserAgents::query();

        $query->when(request('uri'), function ($q) {
            return $q->where('uri', 'LIKE', '%' . request('uri') . '%');
        });

        $query->when(request('user_agent'), function ($q) {
            return $q->where('user_agent', 'LIKE', '%' . request('user_agent') . '%');
        });

        $query->when(request('status_code'), function ($q) {
            return $q->where('status_code', request('status_code'));
        });

        $results = $query->simplePaginate(35);

        if (request('json') === "on") {
            return response()->json($results);
        }
        return view('home', ['results' => $results]);
    }

    /**
     * Show a page with various statistics of user-agents that visited this website.
     * For now the following queries are used for statistics:
     * - From the last seven days give me the top 10 most visited URIs
     * - From the last seven days give me the top 10 most used user-agents
     * - Give me the top ten most used user-agents of all time
     * - Give me the top ten most visited URI of all time
     *
     * @param Request $request
     * @return View
     */
    public function summary(Request $request): View
    {
        $topTenURIOfWeek = DB::table('user_agents')
            ->selectRaw('uri, count(*) as count')
            ->whereRaw('DATEDIFF(NOW(), visited_at) < 7')
            ->groupBy('uri')
            ->orderByRaw('count(*)', 'desc')
            ->limit(10)
            ->get();

        $topTenUserAgentsOfWeek = DB::table('user_agents')
            ->selectRaw('user_agent, count(*) as count')
            ->whereRaw('DATEDIFF(NOW(), visited_at) < 7')
            ->groupBy('user_agent')
            ->orderByRaw('count(*) desc')
            ->limit(10)
            ->get();

        $topTenURI = DB::table('user_agents')
            ->selectRaw('uri, count(*) as count')
            ->groupBy('uri')
            ->orderByRaw('count(*) desc')
            ->limit(10)
            ->get();

        $topTenUserAgents = DB::table('user_agents')
            ->selectRaw('user_agent, count(*) as count')
            ->groupBy('user_agent')
            ->orderByRaw('count(*) desc')
            ->limit(10)
            ->get();

        return view('summary', [
            'topTenUriOfWeek' => $topTenURIOfWeek,
            'topTenUserAgentsOfWeek' => $topTenUserAgentsOfWeek,
            'topTenURI' => $topTenURI,
            'topTenUserAgents' => $topTenUserAgents,
        ]);
    }
}
