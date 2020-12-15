<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

/**
 * Class UserAgents
 * @package App\Models
 */
class UserAgents extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Get the user agents based on the form data that is given by the user.
     * @param string $uri
     * @param string $user_agent
     * @param string $status_code
     * @return Paginator
     */
    public static function getRequestedUserAgents(string $uri, string $user_agent, string $status_code): Paginator
    {
        $query = UserAgents::query();

        $query->when($uri, function ($q) use ($uri) {
            return $q->where('uri', 'LIKE', $uri);
        });

        $query->when($user_agent, function ($q) use ($user_agent) {
            return $q->where('user_agent', 'LIKE', $user_agent);
        });

        $query->when($status_code, function ($q) use ($status_code) {
            return $q->where('status_code', $status_code);
        });

        return $query->simplePaginate(35);
    }

    /**
     * Return the top ten most requested URIs of the week.
     * @return Collection
     */
    public static function topTenURIOfWeek(): Collection
    {
        return DB::table('user_agents')
            ->selectRaw('uri, count(*) as count')
            ->whereRaw('DATEDIFF(NOW(), visited_at) < 7')
            ->groupBy('uri')
            ->orderByRaw('count(*)', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Return the top ten most used user agents of the week.
     * @return Collection
     */
    public static function topTenUserAgentsOfWeek(): Collection
    {
        return DB::table('user_agents')
            ->selectRaw('user_agent, count(*) as count')
            ->whereRaw('DATEDIFF(NOW(), visited_at) < 7')
            ->groupBy('user_agent')
            ->orderByRaw('count(*) desc')
            ->limit(10)
            ->get();
    }

    /**
     * Return the top ten most requested URIs of all time.
     * @return Collection
     */
    public static function topTenURI(): Collection
    {
        return DB::table('user_agents')
            ->selectRaw('uri, count(*) as count')
            ->groupBy('uri')
            ->orderByRaw('count(*) desc')
            ->limit(10)
            ->get();
    }

    /**
     * Return the top ten most used user agents of all time.
     * @return Collection
     */
    public static function topTenUserAgents(): Collection
    {
        return DB::table('user_agents')
            ->selectRaw('user_agent, count(*) as count')
            ->groupBy('user_agent')
            ->orderByRaw('count(*) desc')
            ->limit(10)
            ->get();
    }
}
