@extends('layouts.base')

@section('content')
    <section class="container mx-auto">
        <form class="mb-8" action="{{ route('home') }}" method="get">
            <div class="space-y-2">
                <input class="border-2 rounded border-gray-400 block" type="text" name="uri" id="" placeholder="URI">
                <label for="uri">Wildcard is available wit the <code>%</code> character.</label>
                <input class="border-2 rounded border-gray-400 block" type="text" name="user_agent" id="" placeholder="User-Agent">
                <label for="user_agent">Wildcard is available wit the <code>%</code> character.</label>
                <input class="border-2 rounded border-gray-400 block" type="text" name="status_code" id="" placeholder="Status code">
                <div class="block">
                    <label for="json">JSON response</label>
                    <input type="checkbox" name="json" id="json">
                </div>
                <input class="border-1 rounded bg-blue-500 text-white px-5 py-1 block" type="submit" value="Search">
            </div>

        </form>

        {{-- The result variable is by default filled with the summary otherwise with the response of the query --}}
        @if (isset($results))
            <table class="table-auto" id="user-agent-table">
                <thead class="divide-y-1 divide-gray-400 divide-opacity-75">
                <tr>
                    <th onclick="sortTable(0)">URI</th>
                    <th onclick="sortTable(1)">User-agent</th>
                    <th onclick="sortTable(2)">Status code</th>
                    <th onclick="sortTable(3)">Visited at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->uri }}</td>
                        <td>{{ $result->user_agent }}</td>
                        <td>{{ $result->status_code }}</td>
                        <td>{{ $result->visited_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $results->links() }}
        @else
        <p>No results found.</p>
        @endif
    </section>

    <script>
        function sortTable(n) {
            let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("user-agent-table");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
@endsection
