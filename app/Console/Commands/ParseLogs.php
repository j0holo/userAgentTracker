<?php

namespace App\Console\Commands;

use App\Models\UserAgents;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ParseLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:parse {location=/var/log/nginx/access.log : The location of the log file that should be parsed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse a Nginx access log and store it in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = $this->argument('location');
        $contents = file($filename, FILE_SKIP_EMPTY_LINES);

        foreach ($contents as $content) {
            if (preg_match('~(?P<ipaddress>\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}) - (?P<remote_user>\w+|-) \[(?P<datetime>\d{2}\/[a-zA-Z]{3}\/\d{4}:\d{2}:\d{2}:\d{2} (\+|\-)\d{4})\] ((\"[A-Z]+ )(?P<uri>.+)(HTTP\/\d\.\d")) (?P<statuscode>\d{3}) (?P<bytessent>\d+) (["](?P<refferer>(\-)|(.+))["]) (["](?P<useragent>.+)["]) \".*\"$~', $content, $matches)) {
                print_r($matches);

                $c = Carbon::parse($matches['datetime']);
                $timestamp = $c->format('Y-m-d H:i:s');

                $agent = new UserAgents();
                $agent->uri = $matches['uri'];
                $agent->user_agent = $matches['useragent'];
                $agent->status_code = $matches['statuscode'];
                $agent->visited_at = $timestamp;
                $agent->save();
            }
        }
        return 0;
    }
}
