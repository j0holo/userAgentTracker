@extends('layouts.base')

@section('content')
    <div class="container mx-auto">
        <p>This website has two goals, one generic and one personal. As you may have already seen this site shows which
            user-agents requests which URIs of this website. You are free to use this information however you wish. Also
            available as a rest API with the <code>?json=true</code>
            query.</p>

        <p>The other goals is to get a better understanding of the fundamentals of Laravel 8. I've used Laravel 5 in the
            past on a single project where I mostly did the front end part with <a
                href="https://laravel.com/docs/8.x/blade">Laravel Blade</a> and <a
                href="https://v2.angular.io/docs/js/latest/">Angular 2</a> without TypeScript.</p>
    </div>
@endsection
