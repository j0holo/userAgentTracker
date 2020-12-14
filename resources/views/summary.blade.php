@extends('layouts.base')

@section('content')
    <section class="container mx-auto">
        <div class="flex flex-col space-y-6">
            <div>
                <h2 class="text-xl">Top 10 most visited URIs this week</h2>
                <table class="border-collapse border border-gray-400">
                    <thead class="divide-y-1 divide-gray-400 divide-opacity-75">
                    <tr>
                        <th class="border-collapse border border-gray-400">URI</th>
                        <th class="border-collapse border border-gray-400">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topTenUriOfWeek as $uri)
                        <tr>
                            <td class="border-collapse border border-gray-400">{{ $uri->uri }}</td>
                            <td class="border-collapse border border-gray-400">{{ $uri->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <h2 class="text-xl">Top 10 most busiest user_agents this week</h2>
                <table class="border-collapse border border-gray-400">
                    <thead class="divide-y-1 divide-gray-400 divide-opacity-75">
                    <tr>
                        <th class="border-collapse border border-gray-400">User-agent</th>
                        <th class="border-collapse border border-gray-400 ">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topTenUserAgentsOfWeek as $user_agent)
                        <tr>
                            <td class="border-collapse border border-gray-400">{{ $user_agent->user_agent }}</td>
                            <td class="border-collapse border border-gray-400 ">{{ $user_agent->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <h2 class="text-xl">Top 10 most visited URIs of all time</h2>
                <table class="border-collapse border border-gray-400">
                    <thead class="divide-y-1 divide-gray-400 divide-opacity-75">
                    <tr>
                        <th class="border-collapse border border-gray-400">URI</th>
                        <th class="border-collapse border border-gray-400 ">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topTenURI as $uri)
                        <tr>
                            <td class="border-collapse border border-gray-400">{{ $uri->uri }}</td>
                            <td class="border-collapse border border-gray-400 ">{{ $uri->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <h2 class="text-xl">Top 10 most busiest user_agents of all time</h2>
                <table class="border-collapse border border-gray-400">
                    <thead class="divide-y-1 divide-gray-400 divide-opacity-75">
                    <tr>
                        <th class="border-collapse border border-gray-400">URI</th>
                        <th class="border-collapse border border-gray-400 ">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topTenUserAgents as $uri)
                        <tr>
                            <td class="border-collapse border border-gray-400">{{ $user_agent->user_agent }}</td>
                            <td class="border-collapse border border-gray-400 ">{{ $user_agent->count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
