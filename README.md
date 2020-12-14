# User-agent viewer

A website that shows which user agents viewed this website. The main goal of the project
is to get a better understanding of Laravel.

Users can search for particular URIs or specific user agents. Results are given in table form or as a JSON response.

There should also be a summary page with the top 10 user-agents of the last seven days.
An about page which explains the goal of this website.

## Pages in detail

Below the various pages in detail.

### Homepage

The homepage has a search bar where the user can request a URI or a user-agent. When he/she submits the
query it will look up the last N results ordered by time descending. This will be a get request to make it
easier to use as an API endpoint.


Example queries:

- From the last seven days give me the top 10 most visited URIs
- From the last seven days give me the top 10 most used user-agents
- Give me the top ten most used user-agents of all time
- Give me the top ten most visited URI of all time
- Give me only URIs that do not have valid URIs for this website
- Give me only URIs with status code 404, 403 or 500

### Summary page

The summary page will show general statistics of the top 10 most visited URIs and the top 10 user-agents.

### About page

Explains the reason of the project.
