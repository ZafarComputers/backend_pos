<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Zafar Computers API</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-ping">
                                <a href="#endpoints-GETapi-ping">GET api/ping</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-login">
                                <a href="#endpoints-GETapi-login">Show the login view.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-login">
                                <a href="#endpoints-POSTapi-login">Attempt to authenticate a new session.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-logout">
                                <a href="#endpoints-POSTapi-logout">Destroy an authenticated session.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-register">
                                <a href="#endpoints-GETapi-register">Show the registration view.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-register">
                                <a href="#endpoints-POSTapi-register">Create a new registered user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-roles">
                                <a href="#endpoints-GETapi-roles">GET api/roles</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-roles">
                                <a href="#endpoints-POSTapi-roles">POST api/roles</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-roles--role_id-">
                                <a href="#endpoints-GETapi-roles--role_id-">GET api/roles/{role_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-roles--role_id-">
                                <a href="#endpoints-PUTapi-roles--role_id-">PUT api/roles/{role_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-roles--role_id-">
                                <a href="#endpoints-DELETEapi-roles--role_id-">DELETE api/roles/{role_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-users">
                                <a href="#endpoints-GETapi-users">GET api/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-users">
                                <a href="#endpoints-POSTapi-users">POST api/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-users--user_id-">
                                <a href="#endpoints-PUTapi-users--user_id-">PUT api/users/{user_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-countries">
                                <a href="#endpoints-GETapi-countries">Display a paginated listing of countries.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-countries">
                                <a href="#endpoints-POSTapi-countries">Store a newly created country.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-countries--id-">
                                <a href="#endpoints-GETapi-countries--id-">Display the specified country.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-countries--id-">
                                <a href="#endpoints-PUTapi-countries--id-">Update the specified country.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-countries--id-">
                                <a href="#endpoints-DELETEapi-countries--id-">Remove the specified country.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-states">
                                <a href="#endpoints-GETapi-states">GET api/states</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-states">
                                <a href="#endpoints-POSTapi-states">POST api/states</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-states--id-">
                                <a href="#endpoints-GETapi-states--id-">GET api/states/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-states--id-">
                                <a href="#endpoints-PUTapi-states--id-">PUT api/states/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-states--id-">
                                <a href="#endpoints-DELETEapi-states--id-">DELETE api/states/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cities">
                                <a href="#endpoints-GETapi-cities">Display a paginated listing of all cities with their states and countries.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-cities">
                                <a href="#endpoints-POSTapi-cities">Store a newly created city in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cities--id-">
                                <a href="#endpoints-GETapi-cities--id-">Display the specified city with its state and country.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-cities--id-">
                                <a href="#endpoints-PUTapi-cities--id-">Update the specified city in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-cities--id-">
                                <a href="#endpoints-DELETEapi-cities--id-">Remove the specified city from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-customers">
                                <a href="#endpoints-GETapi-customers">Display a listing of customers with their city.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-customers">
                                <a href="#endpoints-POSTapi-customers">Store a newly created customer.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-customers--id-">
                                <a href="#endpoints-GETapi-customers--id-">Display the specified customer.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-customers--id-">
                                <a href="#endpoints-PUTapi-customers--id-">Update the specified customer.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-customers--id-">
                                <a href="#endpoints-DELETEapi-customers--id-">Remove the specified customer.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-employees">
                                <a href="#endpoints-GETapi-employees">Display a paginated listing of all employees with their cities.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-employees">
                                <a href="#endpoints-POSTapi-employees">Store a newly created employee in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-employees--id-">
                                <a href="#endpoints-GETapi-employees--id-">Display the specified employee.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-employees--id-">
                                <a href="#endpoints-PUTapi-employees--id-">Update the specified employee in storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-employees--id-">
                                <a href="#endpoints-DELETEapi-employees--id-">Remove the specified employee from storage.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-vendors">
                                <a href="#endpoints-GETapi-vendors">GET api/vendors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-vendors">
                                <a href="#endpoints-POSTapi-vendors">POST api/vendors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-vendors--id-">
                                <a href="#endpoints-GETapi-vendors--id-">GET api/vendors/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-vendors--id-">
                                <a href="#endpoints-PUTapi-vendors--id-">PUT api/vendors/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-vendors--id-">
                                <a href="#endpoints-DELETEapi-vendors--id-">DELETE api/vendors/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-categories">
                                <a href="#endpoints-GETapi-categories">GET api/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-categories">
                                <a href="#endpoints-POSTapi-categories">POST api/categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-categories--id-">
                                <a href="#endpoints-GETapi-categories--id-">GET api/categories/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-categories--id-">
                                <a href="#endpoints-PUTapi-categories--id-">PUT api/categories/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-categories--id-">
                                <a href="#endpoints-DELETEapi-categories--id-">DELETE api/categories/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-subcategories">
                                <a href="#endpoints-GETapi-subcategories">GET api/subcategories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-subcategories">
                                <a href="#endpoints-POSTapi-subcategories">POST api/subcategories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-subcategories--id-">
                                <a href="#endpoints-GETapi-subcategories--id-">GET api/subcategories/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-subcategories--id-">
                                <a href="#endpoints-PUTapi-subcategories--id-">PUT api/subcategories/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-subcategories--id-">
                                <a href="#endpoints-DELETEapi-subcategories--id-">DELETE api/subcategories/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-sizes">
                                <a href="#endpoints-GETapi-sizes">GET api/sizes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-sizes">
                                <a href="#endpoints-POSTapi-sizes">POST api/sizes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-sizes--id-">
                                <a href="#endpoints-GETapi-sizes--id-">GET api/sizes/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-sizes--id-">
                                <a href="#endpoints-PUTapi-sizes--id-">PUT api/sizes/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-sizes--id-">
                                <a href="#endpoints-DELETEapi-sizes--id-">DELETE api/sizes/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-colors">
                                <a href="#endpoints-GETapi-colors">GET api/colors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-colors">
                                <a href="#endpoints-POSTapi-colors">POST api/colors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-colors--id-">
                                <a href="#endpoints-GETapi-colors--id-">GET api/colors/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-colors--id-">
                                <a href="#endpoints-PUTapi-colors--id-">PUT api/colors/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-colors--id-">
                                <a href="#endpoints-DELETEapi-colors--id-">DELETE api/colors/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-seasons">
                                <a href="#endpoints-GETapi-seasons">GET api/seasons</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-seasons">
                                <a href="#endpoints-POSTapi-seasons">POST api/seasons</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-seasons--id-">
                                <a href="#endpoints-GETapi-seasons--id-">GET api/seasons/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-seasons--id-">
                                <a href="#endpoints-PUTapi-seasons--id-">PUT api/seasons/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-seasons--id-">
                                <a href="#endpoints-DELETEapi-seasons--id-">DELETE api/seasons/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-materials">
                                <a href="#endpoints-GETapi-materials">GET api/materials</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-materials">
                                <a href="#endpoints-POSTapi-materials">POST api/materials</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-materials--id-">
                                <a href="#endpoints-GETapi-materials--id-">GET api/materials/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-materials--id-">
                                <a href="#endpoints-PUTapi-materials--id-">PUT api/materials/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-materials--id-">
                                <a href="#endpoints-DELETEapi-materials--id-">DELETE api/materials/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-products">
                                <a href="#endpoints-GETapi-products">GET api/products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-products">
                                <a href="#endpoints-POSTapi-products">POST api/products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-purchases">
                                <a href="#endpoints-GETapi-purchases">GET api/purchases</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-purchases">
                                <a href="#endpoints-POSTapi-purchases">POST api/purchases</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-purchase_returns">
                                <a href="#endpoints-GETapi-purchase_returns">GET api/purchase_returns</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-purchase_returns">
                                <a href="#endpoints-POSTapi-purchase_returns">POST api/purchase_returns</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-purchase_return_details">
                                <a href="#endpoints-GETapi-purchase_return_details">GET api/purchase_return_details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-purchase_return_details">
                                <a href="#endpoints-POSTapi-purchase_return_details">POST api/purchase_return_details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos">
                                <a href="#endpoints-GETapi-pos">GET api/pos</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-pos">
                                <a href="#endpoints-POSTapi-pos">POST api/pos</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos--id-">
                                <a href="#endpoints-GETapi-pos--id-">GET api/pos/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-pos--id-">
                                <a href="#endpoints-PUTapi-pos--id-">PUT api/pos/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-pos--id-">
                                <a href="#endpoints-DELETEapi-pos--id-">DELETE api/pos/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos_details">
                                <a href="#endpoints-GETapi-pos_details">GET api/pos_details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-pos_details">
                                <a href="#endpoints-POSTapi-pos_details">POST api/pos_details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos_details--id-">
                                <a href="#endpoints-GETapi-pos_details--id-">GET api/pos_details/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-pos_details--id-">
                                <a href="#endpoints-PUTapi-pos_details--id-">PUT api/pos_details/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-pos_details--id-">
                                <a href="#endpoints-DELETEapi-pos_details--id-">DELETE api/pos_details/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos_returns">
                                <a href="#endpoints-GETapi-pos_returns">GET api/pos_returns</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-pos_returns">
                                <a href="#endpoints-POSTapi-pos_returns">POST api/pos_returns</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos_returns--id-">
                                <a href="#endpoints-GETapi-pos_returns--id-">GET api/pos_returns/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-pos_returns--id-">
                                <a href="#endpoints-PUTapi-pos_returns--id-">PUT api/pos_returns/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-pos_returns--id-">
                                <a href="#endpoints-DELETEapi-pos_returns--id-">DELETE api/pos_returns/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos_return_details">
                                <a href="#endpoints-GETapi-pos_return_details">GET api/pos_return_details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-pos_return_details">
                                <a href="#endpoints-POSTapi-pos_return_details">POST api/pos_return_details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-pos_return_details--id-">
                                <a href="#endpoints-GETapi-pos_return_details--id-">GET api/pos_return_details/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-pos_return_details--id-">
                                <a href="#endpoints-PUTapi-pos_return_details--id-">PUT api/pos_return_details/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-pos_return_details--id-">
                                <a href="#endpoints-DELETEapi-pos_return_details--id-">DELETE api/pos_return_details/{id}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: September 29, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>API documentation for POS, Purchases, Returns, and more.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-ping">GET api/ping</h2>

<p>
</p>



<span id="example-requests-GETapi-ping">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/ping" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/ping"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-ping">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;API is working!&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-ping" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-ping"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-ping"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-ping" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-ping">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-ping" data-method="GET"
      data-path="api/ping"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-ping', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-ping"
                    onclick="tryItOut('GETapi-ping');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-ping"
                    onclick="cancelTryOut('GETapi-ping');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-ping"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/ping</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-ping"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-ping"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-login">Show the login view.</h2>

<p>
</p>



<span id="example-requests-GETapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-login">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-login" data-method="GET"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-login"
                    onclick="tryItOut('GETapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-login"
                    onclick="cancelTryOut('GETapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-login">Attempt to authenticate a new session.</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"|]|{+-\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "|]|{+-"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
</span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="|]|{+-"
               data-component="body">
    <br>
<p>Example: <code>|]|{+-</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-logout">Destroy an authenticated session.</h2>

<p>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
</span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-register">Show the registration view.</h2>

<p>
</p>



<span id="example-requests-GETapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-register">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-register" data-method="GET"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-register"
                    onclick="tryItOut('GETapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-register"
                    onclick="cancelTryOut('GETapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-register">Create a new registered user.</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
</span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-roles">GET api/roles</h2>

<p>
</p>



<span id="example-requests-GETapi-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/roles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-roles">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-roles" data-method="GET"
      data-path="api/roles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-roles"
                    onclick="tryItOut('GETapi-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-roles"
                    onclick="cancelTryOut('GETapi-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-roles">POST api/roles</h2>

<p>
</p>



<span id="example-requests-POSTapi-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/roles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-roles">
</span>
<span id="execution-results-POSTapi-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-roles" data-method="POST"
      data-path="api/roles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-roles"
                    onclick="tryItOut('POSTapi-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-roles"
                    onclick="cancelTryOut('POSTapi-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-roles"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-roles--role_id-">GET api/roles/{role_id}</h2>

<p>
</p>



<span id="example-requests-GETapi-roles--role_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/roles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-roles--role_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-roles--role_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-roles--role_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-roles--role_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-roles--role_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-roles--role_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-roles--role_id-" data-method="GET"
      data-path="api/roles/{role_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-roles--role_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-roles--role_id-"
                    onclick="tryItOut('GETapi-roles--role_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-roles--role_id-"
                    onclick="cancelTryOut('GETapi-roles--role_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-roles--role_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/roles/{role_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-roles--role_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-roles--role_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>role_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="role_id"                data-endpoint="GETapi-roles--role_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the role. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-roles--role_id-">PUT api/roles/{role_id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-roles--role_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/roles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-roles--role_id-">
</span>
<span id="execution-results-PUTapi-roles--role_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-roles--role_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-roles--role_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-roles--role_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-roles--role_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-roles--role_id-" data-method="PUT"
      data-path="api/roles/{role_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-roles--role_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-roles--role_id-"
                    onclick="tryItOut('PUTapi-roles--role_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-roles--role_id-"
                    onclick="cancelTryOut('PUTapi-roles--role_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-roles--role_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/roles/{role_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-roles--role_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-roles--role_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>role_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="role_id"                data-endpoint="PUTapi-roles--role_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the role. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-roles--role_id-"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-roles--role_id-">DELETE api/roles/{role_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-roles--role_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/roles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/roles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-roles--role_id-">
</span>
<span id="execution-results-DELETEapi-roles--role_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-roles--role_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-roles--role_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-roles--role_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-roles--role_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-roles--role_id-" data-method="DELETE"
      data-path="api/roles/{role_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-roles--role_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-roles--role_id-"
                    onclick="tryItOut('DELETEapi-roles--role_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-roles--role_id-"
                    onclick="cancelTryOut('DELETEapi-roles--role_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-roles--role_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/roles/{role_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-roles--role_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-roles--role_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>role_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="role_id"                data-endpoint="DELETEapi-roles--role_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the role. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-users">GET api/users</h2>

<p>
</p>



<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-users">POST api/users</h2>

<p>
</p>



<span id="example-requests-POSTapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"architecto\",
    \"last_name\": \"architecto\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"-0pBNvYgxw\",
    \"role_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "architecto",
    "last_name": "architecto",
    "email": "zbailey@example.net",
    "password": "-0pBNvYgxw",
    "role_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users">
</span>
<span id="execution-results-POSTapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users" data-method="POST"
      data-path="api/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users"
                    onclick="tryItOut('POSTapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users"
                    onclick="cancelTryOut('POSTapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-users"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-users"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-users"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-users"
               value="-0pBNvYgxw"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>-0pBNvYgxw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role_id"                data-endpoint="POSTapi-users"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the roles table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-users--user_id-">PUT api/users/{user_id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-users--user_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/users/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"architecto\",
    \"last_name\": \"architecto\",
    \"role_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/users/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "architecto",
    "last_name": "architecto",
    "role_id": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-users--user_id-">
</span>
<span id="execution-results-PUTapi-users--user_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-users--user_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-users--user_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-users--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-users--user_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-users--user_id-" data-method="PUT"
      data-path="api/users/{user_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-users--user_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-users--user_id-"
                    onclick="tryItOut('PUTapi-users--user_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-users--user_id-"
                    onclick="cancelTryOut('PUTapi-users--user_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-users--user_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/users/{user_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-users--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-users--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="PUTapi-users--user_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-users--user_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PUTapi-users--user_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-users--user_id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role_id"                data-endpoint="PUTapi-users--user_id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the roles table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-countries">Display a paginated listing of countries.</h2>

<p>
</p>



<span id="example-requests-GETapi-countries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/countries" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/countries"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-countries">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Burkina Faso&quot;,
            &quot;code&quot;: &quot;SQ&quot;,
            &quot;currency&quot;: &quot;AED&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Antarctica (the territory South of 60 deg S)&quot;,
            &quot;code&quot;: &quot;BL&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Syrian Arab Republic&quot;,
            &quot;code&quot;: &quot;MP&quot;,
            &quot;currency&quot;: &quot;TND&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Moldova&quot;,
            &quot;code&quot;: &quot;SV&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Afghanistan&quot;,
            &quot;code&quot;: &quot;XQ&quot;,
            &quot;currency&quot;: &quot;GMD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Marshall Islands&quot;,
            &quot;code&quot;: &quot;IR&quot;,
            &quot;currency&quot;: &quot;DJF&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Vanuatu&quot;,
            &quot;code&quot;: &quot;FU&quot;,
            &quot;currency&quot;: &quot;CRC&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Saint Vincent and the Grenadines&quot;,
            &quot;code&quot;: &quot;JK&quot;,
            &quot;currency&quot;: &quot;NIO&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Holy See (Vatican City State)&quot;,
            &quot;code&quot;: &quot;LT&quot;,
            &quot;currency&quot;: &quot;TOP&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Palau&quot;,
            &quot;code&quot;: &quot;TL&quot;,
            &quot;currency&quot;: &quot;CAD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    ],
    &quot;pagination&quot;: {
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 10,
        &quot;last_page&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-countries" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-countries"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-countries"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-countries" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-countries">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-countries" data-method="GET"
      data-path="api/countries"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-countries', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-countries"
                    onclick="tryItOut('GETapi-countries');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-countries"
                    onclick="cancelTryOut('GETapi-countries');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-countries"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/countries</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-countries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-countries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-countries">Store a newly created country.</h2>

<p>
</p>



<span id="example-requests-POSTapi-countries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/countries" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"code\": \"ngzmiy\",
    \"currency\": \"vdljni\",
    \"status\": \"inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/countries"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "code": "ngzmiy",
    "currency": "vdljni",
    "status": "inactive"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-countries">
</span>
<span id="execution-results-POSTapi-countries" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-countries"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-countries"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-countries" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-countries">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-countries" data-method="POST"
      data-path="api/countries"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-countries', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-countries"
                    onclick="tryItOut('POSTapi-countries');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-countries"
                    onclick="cancelTryOut('POSTapi-countries');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-countries"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/countries</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-countries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-countries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-countries"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-countries"
               value="ngzmiy"
               data-component="body">
    <br>
<p>Must not be greater than 10 characters. Example: <code>ngzmiy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="POSTapi-countries"
               value="vdljni"
               data-component="body">
    <br>
<p>Must not be greater than 10 characters. Example: <code>vdljni</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-countries"
               value="inactive"
               data-component="body">
    <br>
<p>Example: <code>inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-countries--id-">Display the specified country.</h2>

<p>
</p>



<span id="example-requests-GETapi-countries--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/countries/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/countries/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-countries--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Burkina Faso&quot;,
        &quot;code&quot;: &quot;SQ&quot;,
        &quot;currency&quot;: &quot;AED&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-countries--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-countries--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-countries--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-countries--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-countries--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-countries--id-" data-method="GET"
      data-path="api/countries/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-countries--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-countries--id-"
                    onclick="tryItOut('GETapi-countries--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-countries--id-"
                    onclick="cancelTryOut('GETapi-countries--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-countries--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/countries/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-countries--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-countries--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-countries--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the country. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-countries--id-">Update the specified country.</h2>

<p>
</p>



<span id="example-requests-PUTapi-countries--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/countries/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"currency\": \"ngzmiy\",
    \"status\": \"active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/countries/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "currency": "ngzmiy",
    "status": "active"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-countries--id-">
</span>
<span id="execution-results-PUTapi-countries--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-countries--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-countries--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-countries--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-countries--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-countries--id-" data-method="PUT"
      data-path="api/countries/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-countries--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-countries--id-"
                    onclick="tryItOut('PUTapi-countries--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-countries--id-"
                    onclick="cancelTryOut('PUTapi-countries--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-countries--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/countries/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/countries/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-countries--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-countries--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-countries--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the country. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-countries--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="PUTapi-countries--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="PUTapi-countries--id-"
               value="ngzmiy"
               data-component="body">
    <br>
<p>Must not be greater than 10 characters. Example: <code>ngzmiy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-countries--id-"
               value="active"
               data-component="body">
    <br>
<p>Example: <code>active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-countries--id-">Remove the specified country.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-countries--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/countries/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/countries/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-countries--id-">
</span>
<span id="execution-results-DELETEapi-countries--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-countries--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-countries--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-countries--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-countries--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-countries--id-" data-method="DELETE"
      data-path="api/countries/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-countries--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-countries--id-"
                    onclick="tryItOut('DELETEapi-countries--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-countries--id-"
                    onclick="cancelTryOut('DELETEapi-countries--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-countries--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/countries/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-countries--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-countries--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-countries--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the country. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-states">GET api/states</h2>

<p>
</p>



<span id="example-requests-GETapi-states">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/states" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/states"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-states">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Georgia&quot;,
        &quot;country_id&quot;: 1,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Burkina Faso&quot;,
            &quot;code&quot;: &quot;SQ&quot;,
            &quot;currency&quot;: &quot;AED&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Ohio&quot;,
        &quot;country_id&quot;: 1,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Burkina Faso&quot;,
            &quot;code&quot;: &quot;SQ&quot;,
            &quot;currency&quot;: &quot;AED&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Virginia&quot;,
        &quot;country_id&quot;: 1,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Burkina Faso&quot;,
            &quot;code&quot;: &quot;SQ&quot;,
            &quot;currency&quot;: &quot;AED&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Tennessee&quot;,
        &quot;country_id&quot;: 1,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Burkina Faso&quot;,
            &quot;code&quot;: &quot;SQ&quot;,
            &quot;currency&quot;: &quot;AED&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;Tennessee&quot;,
        &quot;country_id&quot;: 1,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Burkina Faso&quot;,
            &quot;code&quot;: &quot;SQ&quot;,
            &quot;currency&quot;: &quot;AED&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;title&quot;: &quot;Florida&quot;,
        &quot;country_id&quot;: 2,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Antarctica (the territory South of 60 deg S)&quot;,
            &quot;code&quot;: &quot;BL&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;title&quot;: &quot;Illinois&quot;,
        &quot;country_id&quot;: 2,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Antarctica (the territory South of 60 deg S)&quot;,
            &quot;code&quot;: &quot;BL&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;title&quot;: &quot;Kentucky&quot;,
        &quot;country_id&quot;: 2,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Antarctica (the territory South of 60 deg S)&quot;,
            &quot;code&quot;: &quot;BL&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;title&quot;: &quot;Ohio&quot;,
        &quot;country_id&quot;: 2,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Antarctica (the territory South of 60 deg S)&quot;,
            &quot;code&quot;: &quot;BL&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;title&quot;: &quot;District of Columbia&quot;,
        &quot;country_id&quot;: 2,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Antarctica (the territory South of 60 deg S)&quot;,
            &quot;code&quot;: &quot;BL&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;title&quot;: &quot;South Dakota&quot;,
        &quot;country_id&quot;: 3,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Syrian Arab Republic&quot;,
            &quot;code&quot;: &quot;MP&quot;,
            &quot;currency&quot;: &quot;TND&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;title&quot;: &quot;Massachusetts&quot;,
        &quot;country_id&quot;: 3,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Syrian Arab Republic&quot;,
            &quot;code&quot;: &quot;MP&quot;,
            &quot;currency&quot;: &quot;TND&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;title&quot;: &quot;Oregon&quot;,
        &quot;country_id&quot;: 3,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Syrian Arab Republic&quot;,
            &quot;code&quot;: &quot;MP&quot;,
            &quot;currency&quot;: &quot;TND&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;title&quot;: &quot;Missouri&quot;,
        &quot;country_id&quot;: 3,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Syrian Arab Republic&quot;,
            &quot;code&quot;: &quot;MP&quot;,
            &quot;currency&quot;: &quot;TND&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;title&quot;: &quot;Florida&quot;,
        &quot;country_id&quot;: 3,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Syrian Arab Republic&quot;,
            &quot;code&quot;: &quot;MP&quot;,
            &quot;currency&quot;: &quot;TND&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;title&quot;: &quot;Minnesota&quot;,
        &quot;country_id&quot;: 4,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Moldova&quot;,
            &quot;code&quot;: &quot;SV&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;title&quot;: &quot;Missouri&quot;,
        &quot;country_id&quot;: 4,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Moldova&quot;,
            &quot;code&quot;: &quot;SV&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;title&quot;: &quot;Alaska&quot;,
        &quot;country_id&quot;: 4,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Moldova&quot;,
            &quot;code&quot;: &quot;SV&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;title&quot;: &quot;Utah&quot;,
        &quot;country_id&quot;: 4,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Moldova&quot;,
            &quot;code&quot;: &quot;SV&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;title&quot;: &quot;Minnesota&quot;,
        &quot;country_id&quot;: 4,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Moldova&quot;,
            &quot;code&quot;: &quot;SV&quot;,
            &quot;currency&quot;: &quot;OMR&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;title&quot;: &quot;Colorado&quot;,
        &quot;country_id&quot;: 5,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Afghanistan&quot;,
            &quot;code&quot;: &quot;XQ&quot;,
            &quot;currency&quot;: &quot;GMD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;title&quot;: &quot;Alaska&quot;,
        &quot;country_id&quot;: 5,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Afghanistan&quot;,
            &quot;code&quot;: &quot;XQ&quot;,
            &quot;currency&quot;: &quot;GMD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 23,
        &quot;title&quot;: &quot;Alabama&quot;,
        &quot;country_id&quot;: 5,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Afghanistan&quot;,
            &quot;code&quot;: &quot;XQ&quot;,
            &quot;currency&quot;: &quot;GMD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 24,
        &quot;title&quot;: &quot;Texas&quot;,
        &quot;country_id&quot;: 5,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Afghanistan&quot;,
            &quot;code&quot;: &quot;XQ&quot;,
            &quot;currency&quot;: &quot;GMD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 25,
        &quot;title&quot;: &quot;Rhode Island&quot;,
        &quot;country_id&quot;: 5,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Afghanistan&quot;,
            &quot;code&quot;: &quot;XQ&quot;,
            &quot;currency&quot;: &quot;GMD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 26,
        &quot;title&quot;: &quot;Oklahoma&quot;,
        &quot;country_id&quot;: 6,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Marshall Islands&quot;,
            &quot;code&quot;: &quot;IR&quot;,
            &quot;currency&quot;: &quot;DJF&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 27,
        &quot;title&quot;: &quot;Delaware&quot;,
        &quot;country_id&quot;: 6,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Marshall Islands&quot;,
            &quot;code&quot;: &quot;IR&quot;,
            &quot;currency&quot;: &quot;DJF&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 28,
        &quot;title&quot;: &quot;Florida&quot;,
        &quot;country_id&quot;: 6,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Marshall Islands&quot;,
            &quot;code&quot;: &quot;IR&quot;,
            &quot;currency&quot;: &quot;DJF&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 29,
        &quot;title&quot;: &quot;Florida&quot;,
        &quot;country_id&quot;: 6,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Marshall Islands&quot;,
            &quot;code&quot;: &quot;IR&quot;,
            &quot;currency&quot;: &quot;DJF&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 30,
        &quot;title&quot;: &quot;Rhode Island&quot;,
        &quot;country_id&quot;: 6,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Marshall Islands&quot;,
            &quot;code&quot;: &quot;IR&quot;,
            &quot;currency&quot;: &quot;DJF&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 31,
        &quot;title&quot;: &quot;Oregon&quot;,
        &quot;country_id&quot;: 7,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Vanuatu&quot;,
            &quot;code&quot;: &quot;FU&quot;,
            &quot;currency&quot;: &quot;CRC&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 32,
        &quot;title&quot;: &quot;North Dakota&quot;,
        &quot;country_id&quot;: 7,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Vanuatu&quot;,
            &quot;code&quot;: &quot;FU&quot;,
            &quot;currency&quot;: &quot;CRC&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 33,
        &quot;title&quot;: &quot;District of Columbia&quot;,
        &quot;country_id&quot;: 7,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Vanuatu&quot;,
            &quot;code&quot;: &quot;FU&quot;,
            &quot;currency&quot;: &quot;CRC&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 34,
        &quot;title&quot;: &quot;New Mexico&quot;,
        &quot;country_id&quot;: 7,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Vanuatu&quot;,
            &quot;code&quot;: &quot;FU&quot;,
            &quot;currency&quot;: &quot;CRC&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 35,
        &quot;title&quot;: &quot;Maine&quot;,
        &quot;country_id&quot;: 7,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:47.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Vanuatu&quot;,
            &quot;code&quot;: &quot;FU&quot;,
            &quot;currency&quot;: &quot;CRC&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 36,
        &quot;title&quot;: &quot;Delaware&quot;,
        &quot;country_id&quot;: 8,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Saint Vincent and the Grenadines&quot;,
            &quot;code&quot;: &quot;JK&quot;,
            &quot;currency&quot;: &quot;NIO&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 37,
        &quot;title&quot;: &quot;Missouri&quot;,
        &quot;country_id&quot;: 8,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Saint Vincent and the Grenadines&quot;,
            &quot;code&quot;: &quot;JK&quot;,
            &quot;currency&quot;: &quot;NIO&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 38,
        &quot;title&quot;: &quot;Alaska&quot;,
        &quot;country_id&quot;: 8,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Saint Vincent and the Grenadines&quot;,
            &quot;code&quot;: &quot;JK&quot;,
            &quot;currency&quot;: &quot;NIO&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 39,
        &quot;title&quot;: &quot;Arizona&quot;,
        &quot;country_id&quot;: 8,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Saint Vincent and the Grenadines&quot;,
            &quot;code&quot;: &quot;JK&quot;,
            &quot;currency&quot;: &quot;NIO&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 40,
        &quot;title&quot;: &quot;Maryland&quot;,
        &quot;country_id&quot;: 8,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Saint Vincent and the Grenadines&quot;,
            &quot;code&quot;: &quot;JK&quot;,
            &quot;currency&quot;: &quot;NIO&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 41,
        &quot;title&quot;: &quot;District of Columbia&quot;,
        &quot;country_id&quot;: 9,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Holy See (Vatican City State)&quot;,
            &quot;code&quot;: &quot;LT&quot;,
            &quot;currency&quot;: &quot;TOP&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 42,
        &quot;title&quot;: &quot;Ohio&quot;,
        &quot;country_id&quot;: 9,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Holy See (Vatican City State)&quot;,
            &quot;code&quot;: &quot;LT&quot;,
            &quot;currency&quot;: &quot;TOP&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 43,
        &quot;title&quot;: &quot;Maryland&quot;,
        &quot;country_id&quot;: 9,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Holy See (Vatican City State)&quot;,
            &quot;code&quot;: &quot;LT&quot;,
            &quot;currency&quot;: &quot;TOP&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 44,
        &quot;title&quot;: &quot;New Jersey&quot;,
        &quot;country_id&quot;: 9,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Holy See (Vatican City State)&quot;,
            &quot;code&quot;: &quot;LT&quot;,
            &quot;currency&quot;: &quot;TOP&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 45,
        &quot;title&quot;: &quot;Massachusetts&quot;,
        &quot;country_id&quot;: 9,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Holy See (Vatican City State)&quot;,
            &quot;code&quot;: &quot;LT&quot;,
            &quot;currency&quot;: &quot;TOP&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 46,
        &quot;title&quot;: &quot;Oregon&quot;,
        &quot;country_id&quot;: 10,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Palau&quot;,
            &quot;code&quot;: &quot;TL&quot;,
            &quot;currency&quot;: &quot;CAD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 47,
        &quot;title&quot;: &quot;Iowa&quot;,
        &quot;country_id&quot;: 10,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Palau&quot;,
            &quot;code&quot;: &quot;TL&quot;,
            &quot;currency&quot;: &quot;CAD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 48,
        &quot;title&quot;: &quot;Massachusetts&quot;,
        &quot;country_id&quot;: 10,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Palau&quot;,
            &quot;code&quot;: &quot;TL&quot;,
            &quot;currency&quot;: &quot;CAD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 49,
        &quot;title&quot;: &quot;Nebraska&quot;,
        &quot;country_id&quot;: 10,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Palau&quot;,
            &quot;code&quot;: &quot;TL&quot;,
            &quot;currency&quot;: &quot;CAD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 50,
        &quot;title&quot;: &quot;Rhode Island&quot;,
        &quot;country_id&quot;: 10,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
        &quot;country&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Palau&quot;,
            &quot;code&quot;: &quot;TL&quot;,
            &quot;currency&quot;: &quot;CAD&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-states" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-states"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-states"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-states" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-states">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-states" data-method="GET"
      data-path="api/states"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-states', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-states"
                    onclick="tryItOut('GETapi-states');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-states"
                    onclick="cancelTryOut('GETapi-states');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-states"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/states</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-states"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-states"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-states">POST api/states</h2>

<p>
</p>



<span id="example-requests-POSTapi-states">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/states" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"country_id\": \"architecto\",
    \"status\": \"inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/states"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "country_id": "architecto",
    "status": "inactive"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-states">
</span>
<span id="execution-results-POSTapi-states" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-states"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-states"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-states" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-states">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-states" data-method="POST"
      data-path="api/states"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-states', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-states"
                    onclick="tryItOut('POSTapi-states');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-states"
                    onclick="cancelTryOut('POSTapi-states');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-states"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/states</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-states"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-states"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-states"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country_id"                data-endpoint="POSTapi-states"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the countries table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-states"
               value="inactive"
               data-component="body">
    <br>
<p>Example: <code>inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-states--id-">GET api/states/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-states--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/states/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/states/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-states--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Georgia&quot;,
    &quot;country_id&quot;: 1,
    &quot;status&quot;: &quot;inactive&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
    &quot;country&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Burkina Faso&quot;,
        &quot;code&quot;: &quot;SQ&quot;,
        &quot;currency&quot;: &quot;AED&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-states--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-states--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-states--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-states--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-states--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-states--id-" data-method="GET"
      data-path="api/states/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-states--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-states--id-"
                    onclick="tryItOut('GETapi-states--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-states--id-"
                    onclick="cancelTryOut('GETapi-states--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-states--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/states/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-states--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-states--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-states--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the state. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-states--id-">PUT api/states/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-states--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/states/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"b\",
    \"country_id\": \"architecto\",
    \"status\": \"inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/states/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "b",
    "country_id": "architecto",
    "status": "inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-states--id-">
</span>
<span id="execution-results-PUTapi-states--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-states--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-states--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-states--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-states--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-states--id-" data-method="PUT"
      data-path="api/states/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-states--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-states--id-"
                    onclick="tryItOut('PUTapi-states--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-states--id-"
                    onclick="cancelTryOut('PUTapi-states--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-states--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/states/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/states/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-states--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-states--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-states--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the state. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-states--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country_id"                data-endpoint="PUTapi-states--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the countries table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-states--id-"
               value="inactive"
               data-component="body">
    <br>
<p>Example: <code>inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-states--id-">DELETE api/states/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-states--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/states/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/states/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-states--id-">
</span>
<span id="execution-results-DELETEapi-states--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-states--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-states--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-states--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-states--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-states--id-" data-method="DELETE"
      data-path="api/states/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-states--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-states--id-"
                    onclick="tryItOut('DELETEapi-states--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-states--id-"
                    onclick="cancelTryOut('DELETEapi-states--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-states--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/states/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-states--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-states--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-states--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the state. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-cities">Display a paginated listing of all cities with their states and countries.</h2>

<p>
</p>



<span id="example-requests-GETapi-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/cities" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cities"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cities">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Port Annaliseview&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maggioburgh&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Lake Jovanitown&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Seanmouth&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Mosciskiland&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Aniyahshire&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;North Karson&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;New Oran&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Harberfurt&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;West Garfieldton&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;state&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Georgia&quot;,
                &quot;country_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Burkina Faso&quot;,
                    &quot;code&quot;: &quot;SQ&quot;,
                    &quot;currency&quot;: &quot;AED&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
                }
            }
        }
    ],
    &quot;pagination&quot;: {
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 500,
        &quot;last_page&quot;: 50
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cities" data-method="GET"
      data-path="api/cities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cities"
                    onclick="tryItOut('GETapi-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cities"
                    onclick="cancelTryOut('GETapi-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-cities">Store a newly created city in storage.</h2>

<p>
</p>



<span id="example-requests-POSTapi-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/cities" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cities"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-cities">
</span>
<span id="execution-results-POSTapi-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-cities" data-method="POST"
      data-path="api/cities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-cities"
                    onclick="tryItOut('POSTapi-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-cities"
                    onclick="cancelTryOut('POSTapi-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/cities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-cities--id-">Display the specified city with its state and country.</h2>

<p>
</p>



<span id="example-requests-GETapi-cities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/cities/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cities/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cities--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Port Annaliseview&quot;,
        &quot;state_id&quot;: 1,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
        &quot;state&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Georgia&quot;,
            &quot;country_id&quot;: 1,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;country&quot;: {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;Burkina Faso&quot;,
                &quot;code&quot;: &quot;SQ&quot;,
                &quot;currency&quot;: &quot;AED&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cities--id-" data-method="GET"
      data-path="api/cities/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cities--id-"
                    onclick="tryItOut('GETapi-cities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cities--id-"
                    onclick="cancelTryOut('GETapi-cities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cities/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-cities--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the city. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-cities--id-">Update the specified city in storage.</h2>

<p>
</p>



<span id="example-requests-PUTapi-cities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/cities/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cities/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-cities--id-">
</span>
<span id="execution-results-PUTapi-cities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-cities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-cities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-cities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-cities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-cities--id-" data-method="PUT"
      data-path="api/cities/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-cities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-cities--id-"
                    onclick="tryItOut('PUTapi-cities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-cities--id-"
                    onclick="cancelTryOut('PUTapi-cities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-cities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/cities/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/cities/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-cities--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the city. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-cities--id-">Remove the specified city from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-cities--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/cities/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cities/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-cities--id-">
</span>
<span id="execution-results-DELETEapi-cities--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-cities--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-cities--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-cities--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-cities--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-cities--id-" data-method="DELETE"
      data-path="api/cities/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-cities--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-cities--id-"
                    onclick="tryItOut('DELETEapi-cities--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-cities--id-"
                    onclick="cancelTryOut('DELETEapi-cities--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-cities--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/cities/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-cities--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-cities--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the city. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-customers">Display a listing of customers with their city.</h2>

<p>
</p>



<span id="example-requests-GETapi-customers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/customers" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/customers"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-customers">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 3,
                &quot;title&quot;: &quot;Lake Jovanitown&quot;,
                &quot;state_id&quot;: 1,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;91139-8736077-9&quot;,
            &quot;name&quot;: &quot;Cristian Mills&quot;,
            &quot;email&quot;: &quot;hoyt62@example.org&quot;,
            &quot;address&quot;: &quot;1934 Randal Forks Apt. 621\nWellingtonmouth, CT 27443&quot;,
            &quot;city_id&quot;: 44,
            &quot;cell_no1&quot;: &quot;03906459816&quot;,
            &quot;cell_no2&quot;: &quot;03963968532&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 44,
                &quot;title&quot;: &quot;Brianview&quot;,
                &quot;state_id&quot;: 5,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;cnic&quot;: &quot;87905-7698002-1&quot;,
            &quot;name&quot;: &quot;Dr. Jovanny Robel&quot;,
            &quot;email&quot;: &quot;aerdman@example.org&quot;,
            &quot;address&quot;: &quot;70826 Kuhlman Ramp\nPort Katlyn, TX 66811&quot;,
            &quot;city_id&quot;: 46,
            &quot;cell_no1&quot;: &quot;03984147957&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 46,
                &quot;title&quot;: &quot;South Dante&quot;,
                &quot;state_id&quot;: 5,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;00619-3564902-8&quot;,
            &quot;name&quot;: &quot;Creola Haag&quot;,
            &quot;email&quot;: &quot;noelia.little@example.com&quot;,
            &quot;address&quot;: &quot;32077 Alicia Estate Suite 493\nReillychester, VT 57755-0706&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03324901271&quot;,
            &quot;cell_no2&quot;: &quot;03237685041&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 29,
                &quot;title&quot;: &quot;Runteport&quot;,
                &quot;state_id&quot;: 3,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;cnic&quot;: &quot;96220-0371880-0&quot;,
            &quot;name&quot;: &quot;Mrs. Belle Kemmer V&quot;,
            &quot;email&quot;: &quot;morar.valerie@example.org&quot;,
            &quot;address&quot;: &quot;25354 Frances Valleys Apt. 765\nSouth Emilie, AR 95895&quot;,
            &quot;city_id&quot;: 23,
            &quot;cell_no1&quot;: &quot;03320903760&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 23,
                &quot;title&quot;: &quot;Lebsackshire&quot;,
                &quot;state_id&quot;: 3,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;cnic&quot;: &quot;78669-4553364-3&quot;,
            &quot;name&quot;: &quot;Brooklyn O&#039;Connell&quot;,
            &quot;email&quot;: &quot;margret91@example.net&quot;,
            &quot;address&quot;: &quot;6577 Libby Keys\nJaydonton, AK 63471&quot;,
            &quot;city_id&quot;: 47,
            &quot;cell_no1&quot;: &quot;03426668525&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 47,
                &quot;title&quot;: &quot;Gutkowskistad&quot;,
                &quot;state_id&quot;: 5,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;cnic&quot;: &quot;28254-0274548-5&quot;,
            &quot;name&quot;: &quot;Kieran Hamill III&quot;,
            &quot;email&quot;: &quot;reyes42@example.org&quot;,
            &quot;address&quot;: &quot;39170 Floy Squares Apt. 016\nLake Nicolette, AK 09302-9984&quot;,
            &quot;city_id&quot;: 14,
            &quot;cell_no1&quot;: &quot;03041199971&quot;,
            &quot;cell_no2&quot;: &quot;03499062231&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 14,
                &quot;title&quot;: &quot;Mattiefort&quot;,
                &quot;state_id&quot;: 2,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;cnic&quot;: &quot;68322-4163861-5&quot;,
            &quot;name&quot;: &quot;Deangelo Crona DVM&quot;,
            &quot;email&quot;: &quot;feeney.alek@example.net&quot;,
            &quot;address&quot;: &quot;68591 Smitham Vista\nGulgowskimouth, KS 18419-6833&quot;,
            &quot;city_id&quot;: 5,
            &quot;cell_no1&quot;: &quot;03283648044&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 5,
                &quot;title&quot;: &quot;Mosciskiland&quot;,
                &quot;state_id&quot;: 1,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;cnic&quot;: &quot;02899-2558115-4&quot;,
            &quot;name&quot;: &quot;Dr. Maryam Wiegand Sr.&quot;,
            &quot;email&quot;: &quot;niko.champlin@example.net&quot;,
            &quot;address&quot;: &quot;8202 Kuvalis Stream\nEast Kirk, MN 25537-4921&quot;,
            &quot;city_id&quot;: 36,
            &quot;cell_no1&quot;: &quot;03695406057&quot;,
            &quot;cell_no2&quot;: &quot;03971062066&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 36,
                &quot;title&quot;: &quot;New Kenyattamouth&quot;,
                &quot;state_id&quot;: 4,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;cnic&quot;: &quot;65315-1316624-7&quot;,
            &quot;name&quot;: &quot;Richie Mann&quot;,
            &quot;email&quot;: &quot;sasha00@example.net&quot;,
            &quot;address&quot;: &quot;56584 Howe Road\nLake Davonteville, WA 81508-4119&quot;,
            &quot;city_id&quot;: 22,
            &quot;cell_no1&quot;: &quot;03250405061&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 22,
                &quot;title&quot;: &quot;Gleichnertown&quot;,
                &quot;state_id&quot;: 3,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
            }
        }
    ],
    &quot;pagination&quot;: {
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 20,
        &quot;last_page&quot;: 2
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-customers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-customers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-customers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-customers" data-method="GET"
      data-path="api/customers"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-customers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-customers"
                    onclick="tryItOut('GETapi-customers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-customers"
                    onclick="cancelTryOut('GETapi-customers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-customers"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/customers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-customers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-customers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-customers">Store a newly created customer.</h2>

<p>
</p>



<span id="example-requests-POSTapi-customers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/customers" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"cnic\": \"bngzmiyvdljnikhw\",
    \"name\": \"a\",
    \"email\": \"breitenberg.gilbert@example.com\",
    \"address\": \"u\",
    \"city_id\": \"architecto\",
    \"cell_no1\": \"n\",
    \"cell_no2\": \"g\",
    \"image_path\": \"z\",
    \"status\": \"active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/customers"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "cnic": "bngzmiyvdljnikhw",
    "name": "a",
    "email": "breitenberg.gilbert@example.com",
    "address": "u",
    "city_id": "architecto",
    "cell_no1": "n",
    "cell_no2": "g",
    "image_path": "z",
    "status": "active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-customers">
</span>
<span id="execution-results-POSTapi-customers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-customers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-customers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-customers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-customers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-customers" data-method="POST"
      data-path="api/customers"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-customers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-customers"
                    onclick="tryItOut('POSTapi-customers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-customers"
                    onclick="cancelTryOut('POSTapi-customers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-customers"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/customers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-customers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-customers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cnic</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cnic"                data-endpoint="POSTapi-customers"
               value="bngzmiyvdljnikhw"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>bngzmiyvdljnikhw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-customers"
               value="a"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>a</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-customers"
               value="breitenberg.gilbert@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>breitenberg.gilbert@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-customers"
               value="u"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>u</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city_id"                data-endpoint="POSTapi-customers"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the cities table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cell_no1</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cell_no1"                data-endpoint="POSTapi-customers"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 15 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cell_no2</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cell_no2"                data-endpoint="POSTapi-customers"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 15 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image_path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="image_path"                data-endpoint="POSTapi-customers"
               value="z"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>z</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-customers"
               value="active"
               data-component="body">
    <br>
<p>Example: <code>active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-customers--id-">Display the specified customer.</h2>

<p>
</p>



<span id="example-requests-GETapi-customers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/customers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/customers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-customers--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
        &quot;name&quot;: &quot;Dalton Bosco&quot;,
        &quot;email&quot;: &quot;alindgren@example.net&quot;,
        &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
        &quot;city_id&quot;: 3,
        &quot;cell_no1&quot;: &quot;03804492410&quot;,
        &quot;cell_no2&quot;: null,
        &quot;image_path&quot;: &quot;default.png&quot;,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Lake Jovanitown&quot;,
            &quot;state_id&quot;: 1,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:43.000000Z&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-customers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-customers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-customers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-customers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-customers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-customers--id-" data-method="GET"
      data-path="api/customers/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-customers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-customers--id-"
                    onclick="tryItOut('GETapi-customers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-customers--id-"
                    onclick="cancelTryOut('GETapi-customers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-customers--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/customers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-customers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-customers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-customers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the customer. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-customers--id-">Update the specified customer.</h2>

<p>
</p>



<span id="example-requests-PUTapi-customers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/customers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"address\": \"n\",
    \"city_id\": \"architecto\",
    \"cell_no1\": \"n\",
    \"cell_no2\": \"g\",
    \"image_path\": \"z\",
    \"status\": \"inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/customers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "address": "n",
    "city_id": "architecto",
    "cell_no1": "n",
    "cell_no2": "g",
    "image_path": "z",
    "status": "inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-customers--id-">
</span>
<span id="execution-results-PUTapi-customers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-customers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-customers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-customers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-customers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-customers--id-" data-method="PUT"
      data-path="api/customers/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-customers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-customers--id-"
                    onclick="tryItOut('PUTapi-customers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-customers--id-"
                    onclick="cancelTryOut('PUTapi-customers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-customers--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/customers/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/customers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-customers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-customers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-customers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the customer. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cnic</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cnic"                data-endpoint="PUTapi-customers--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-customers--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-customers--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-customers--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city_id"                data-endpoint="PUTapi-customers--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the cities table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cell_no1</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cell_no1"                data-endpoint="PUTapi-customers--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 15 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cell_no2</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cell_no2"                data-endpoint="PUTapi-customers--id-"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 15 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image_path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="image_path"                data-endpoint="PUTapi-customers--id-"
               value="z"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>z</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-customers--id-"
               value="inactive"
               data-component="body">
    <br>
<p>Example: <code>inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-customers--id-">Remove the specified customer.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-customers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/customers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/customers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-customers--id-">
</span>
<span id="execution-results-DELETEapi-customers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-customers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-customers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-customers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-customers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-customers--id-" data-method="DELETE"
      data-path="api/customers/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-customers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-customers--id-"
                    onclick="tryItOut('DELETEapi-customers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-customers--id-"
                    onclick="cancelTryOut('DELETEapi-customers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-customers--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/customers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-customers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-customers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-customers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the customer. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-employees">Display a paginated listing of all employees with their cities.</h2>

<p>
</p>



<span id="example-requests-GETapi-employees">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/employees" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/employees"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-employees">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;52153332214&quot;,
            &quot;first_name&quot;: &quot;Dave&quot;,
            &quot;last_name&quot;: &quot;McCullough&quot;,
            &quot;email&quot;: &quot;alden.harris@example.com&quot;,
            &quot;address&quot;: &quot;24554 Arlo Ramp\nLegrosshire, ME 71115&quot;,
            &quot;city_id&quot;: 301,
            &quot;cell_no1&quot;: &quot;+1 (501) 737-8154&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 301,
                &quot;title&quot;: &quot;West Juliachester&quot;,
                &quot;state_id&quot;: 31,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;47109867482&quot;,
            &quot;first_name&quot;: &quot;Gudrun&quot;,
            &quot;last_name&quot;: &quot;Ledner&quot;,
            &quot;email&quot;: &quot;gunnar.simonis@example.org&quot;,
            &quot;address&quot;: &quot;13847 Morar Springs\nNorth Nyasia, OR 81247-9492&quot;,
            &quot;city_id&quot;: 237,
            &quot;cell_no1&quot;: &quot;+13866854433&quot;,
            &quot;cell_no2&quot;: &quot;1-984-841-7325&quot;,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 237,
                &quot;title&quot;: &quot;East Crawfordview&quot;,
                &quot;state_id&quot;: 24,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;cnic&quot;: &quot;76444871216&quot;,
            &quot;first_name&quot;: &quot;Myrtie&quot;,
            &quot;last_name&quot;: &quot;Kuvalis&quot;,
            &quot;email&quot;: &quot;goldner.cali@example.com&quot;,
            &quot;address&quot;: &quot;1684 Torey Locks\nPort Amiya, AL 53683-4645&quot;,
            &quot;city_id&quot;: 63,
            &quot;cell_no1&quot;: &quot;1-571-628-3681&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 63,
                &quot;title&quot;: &quot;West Anissa&quot;,
                &quot;state_id&quot;: 7,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;59068540899&quot;,
            &quot;first_name&quot;: &quot;Taryn&quot;,
            &quot;last_name&quot;: &quot;Steuber&quot;,
            &quot;email&quot;: &quot;wisozk.beulah@example.com&quot;,
            &quot;address&quot;: &quot;597 Heaney Spur Apt. 229\nLake Faustino, ME 97542&quot;,
            &quot;city_id&quot;: 220,
            &quot;cell_no1&quot;: &quot;+1-458-881-6424&quot;,
            &quot;cell_no2&quot;: &quot;256.503.6570&quot;,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 220,
                &quot;title&quot;: &quot;East Casey&quot;,
                &quot;state_id&quot;: 22,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;cnic&quot;: &quot;21323542637&quot;,
            &quot;first_name&quot;: &quot;Kian&quot;,
            &quot;last_name&quot;: &quot;Haag&quot;,
            &quot;email&quot;: &quot;pablo36@example.org&quot;,
            &quot;address&quot;: &quot;9526 Lynch Valley\nKarelleport, NE 42512&quot;,
            &quot;city_id&quot;: 153,
            &quot;cell_no1&quot;: &quot;903-713-7541&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 153,
                &quot;title&quot;: &quot;Douglasbury&quot;,
                &quot;state_id&quot;: 16,
                &quot;status&quot;: &quot;inactive&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;cnic&quot;: &quot;03985451097&quot;,
            &quot;first_name&quot;: &quot;Destini&quot;,
            &quot;last_name&quot;: &quot;Marquardt&quot;,
            &quot;email&quot;: &quot;khilpert@example.com&quot;,
            &quot;address&quot;: &quot;93142 Harvey Terrace Suite 975\nNew Ashtyn, NJ 80765-8210&quot;,
            &quot;city_id&quot;: 32,
            &quot;cell_no1&quot;: &quot;+1.272.585.2505&quot;,
            &quot;cell_no2&quot;: &quot;1-985-586-7089&quot;,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 32,
                &quot;title&quot;: &quot;East Ike&quot;,
                &quot;state_id&quot;: 4,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 7,
            &quot;cnic&quot;: &quot;81846414776&quot;,
            &quot;first_name&quot;: &quot;Oscar&quot;,
            &quot;last_name&quot;: &quot;Rohan&quot;,
            &quot;email&quot;: &quot;waters.guadalupe@example.net&quot;,
            &quot;address&quot;: &quot;8283 Rath Dale Apt. 758\nFrederiqueburgh, AK 70528-2338&quot;,
            &quot;city_id&quot;: 32,
            &quot;cell_no1&quot;: &quot;813-864-6031&quot;,
            &quot;cell_no2&quot;: &quot;972.898.6726&quot;,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 32,
                &quot;title&quot;: &quot;East Ike&quot;,
                &quot;state_id&quot;: 4,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 8,
            &quot;cnic&quot;: &quot;68387923546&quot;,
            &quot;first_name&quot;: &quot;Gene&quot;,
            &quot;last_name&quot;: &quot;Borer&quot;,
            &quot;email&quot;: &quot;anabel47@example.org&quot;,
            &quot;address&quot;: &quot;89516 Auer Squares\nHowellview, AZ 59910-8897&quot;,
            &quot;city_id&quot;: 233,
            &quot;cell_no1&quot;: &quot;949-415-0484&quot;,
            &quot;cell_no2&quot;: &quot;1-320-529-5047&quot;,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 233,
                &quot;title&quot;: &quot;Kaydenmouth&quot;,
                &quot;state_id&quot;: 24,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 9,
            &quot;cnic&quot;: &quot;24550667826&quot;,
            &quot;first_name&quot;: &quot;Catalina&quot;,
            &quot;last_name&quot;: &quot;Frami&quot;,
            &quot;email&quot;: &quot;legros.bria@example.org&quot;,
            &quot;address&quot;: &quot;48857 Rupert Walk\nJaycebury, NY 66682-6861&quot;,
            &quot;city_id&quot;: 36,
            &quot;cell_no1&quot;: &quot;+15515522328&quot;,
            &quot;cell_no2&quot;: &quot;623-956-2754&quot;,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 36,
                &quot;title&quot;: &quot;New Kenyattamouth&quot;,
                &quot;state_id&quot;: 4,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 10,
            &quot;cnic&quot;: &quot;92024568466&quot;,
            &quot;first_name&quot;: &quot;Trenton&quot;,
            &quot;last_name&quot;: &quot;Pouros&quot;,
            &quot;email&quot;: &quot;efritsch@example.net&quot;,
            &quot;address&quot;: &quot;70188 Kris Dam Apt. 320\nCarterton, MI 27300&quot;,
            &quot;city_id&quot;: 318,
            &quot;cell_no1&quot;: &quot;1-732-261-7566&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: null,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;city&quot;: {
                &quot;id&quot;: 318,
                &quot;title&quot;: &quot;North Nevaborough&quot;,
                &quot;state_id&quot;: 32,
                &quot;status&quot;: &quot;active&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;
            }
        }
    ],
    &quot;pagination&quot;: {
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 40,
        &quot;last_page&quot;: 4
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-employees" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-employees"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-employees"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-employees" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-employees">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-employees" data-method="GET"
      data-path="api/employees"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-employees', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-employees"
                    onclick="tryItOut('GETapi-employees');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-employees"
                    onclick="cancelTryOut('GETapi-employees');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-employees"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/employees</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-employees">Store a newly created employee in storage.</h2>

<p>
</p>

<p>Validates the request data and creates a new employee record.</p>

<span id="example-requests-POSTapi-employees">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/employees" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/employees"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-employees">
</span>
<span id="execution-results-POSTapi-employees" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-employees"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-employees"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-employees" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-employees">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-employees" data-method="POST"
      data-path="api/employees"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-employees', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-employees"
                    onclick="tryItOut('POSTapi-employees');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-employees"
                    onclick="cancelTryOut('POSTapi-employees');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-employees"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/employees</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-employees--id-">Display the specified employee.</h2>

<p>
</p>



<span id="example-requests-GETapi-employees--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/employees/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/employees/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-employees--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;cnic&quot;: &quot;52153332214&quot;,
        &quot;first_name&quot;: &quot;Dave&quot;,
        &quot;last_name&quot;: &quot;McCullough&quot;,
        &quot;email&quot;: &quot;alden.harris@example.com&quot;,
        &quot;address&quot;: &quot;24554 Arlo Ramp\nLegrosshire, ME 71115&quot;,
        &quot;city_id&quot;: 301,
        &quot;cell_no1&quot;: &quot;+1 (501) 737-8154&quot;,
        &quot;cell_no2&quot;: null,
        &quot;image_path&quot;: null,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 301,
            &quot;title&quot;: &quot;West Juliachester&quot;,
            &quot;state_id&quot;: 31,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:48.000000Z&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-employees--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-employees--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-employees--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-employees--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-employees--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-employees--id-" data-method="GET"
      data-path="api/employees/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-employees--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-employees--id-"
                    onclick="tryItOut('GETapi-employees--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-employees--id-"
                    onclick="cancelTryOut('GETapi-employees--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-employees--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/employees/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-employees--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-employees--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-employees--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the employee. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-employees--id-">Update the specified employee in storage.</h2>

<p>
</p>

<p>Validates the request data and updates the employee record.</p>

<span id="example-requests-PUTapi-employees--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/employees/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/employees/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-employees--id-">
</span>
<span id="execution-results-PUTapi-employees--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-employees--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-employees--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-employees--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-employees--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-employees--id-" data-method="PUT"
      data-path="api/employees/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-employees--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-employees--id-"
                    onclick="tryItOut('PUTapi-employees--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-employees--id-"
                    onclick="cancelTryOut('PUTapi-employees--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-employees--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/employees/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/employees/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-employees--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-employees--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-employees--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the employee. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-employees--id-">Remove the specified employee from storage.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-employees--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/employees/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/employees/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-employees--id-">
</span>
<span id="execution-results-DELETEapi-employees--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-employees--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-employees--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-employees--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-employees--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-employees--id-" data-method="DELETE"
      data-path="api/employees/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-employees--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-employees--id-"
                    onclick="tryItOut('DELETEapi-employees--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-employees--id-"
                    onclick="cancelTryOut('DELETEapi-employees--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-employees--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/employees/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-employees--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-employees--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-employees--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the employee. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-vendors">GET api/vendors</h2>

<p>
</p>



<span id="example-requests-GETapi-vendors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vendors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;Trudie&quot;,
        &quot;last_name&quot;: &quot;Boyer&quot;,
        &quot;cnic&quot;: &quot;43866-4440150-6&quot;,
        &quot;address&quot;: &quot;8404 Jovan Plain Apt. 095\nHirthefurt, TX 27930-9837&quot;,
        &quot;city_id&quot;: 56,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 56,
            &quot;title&quot;: &quot;New Noel&quot;,
            &quot;state_id&quot;: 6,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;first_name&quot;: &quot;Theron&quot;,
        &quot;last_name&quot;: &quot;Monahan&quot;,
        &quot;cnic&quot;: &quot;84378-0855782-4&quot;,
        &quot;address&quot;: &quot;596 Abraham Via Apt. 036\nNorth Noemieburgh, NH 79773&quot;,
        &quot;city_id&quot;: 109,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 109,
            &quot;title&quot;: &quot;Waltershire&quot;,
            &quot;state_id&quot;: 11,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;first_name&quot;: &quot;Ally&quot;,
        &quot;last_name&quot;: &quot;McKenzie&quot;,
        &quot;cnic&quot;: &quot;09664-4521196-3&quot;,
        &quot;address&quot;: &quot;21606 Gibson Forks\nWest Felix, CA 46802&quot;,
        &quot;city_id&quot;: 151,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 151,
            &quot;title&quot;: &quot;New Kameron&quot;,
            &quot;state_id&quot;: 16,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;first_name&quot;: &quot;Liza&quot;,
        &quot;last_name&quot;: &quot;Howe&quot;,
        &quot;cnic&quot;: &quot;51707-4199768-7&quot;,
        &quot;address&quot;: &quot;79177 Abraham Fork Apt. 610\nKlockoshire, AK 28119-1884&quot;,
        &quot;city_id&quot;: 142,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 142,
            &quot;title&quot;: &quot;South Cesar&quot;,
            &quot;state_id&quot;: 15,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:45.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;first_name&quot;: &quot;Sherwood&quot;,
        &quot;last_name&quot;: &quot;Koepp&quot;,
        &quot;cnic&quot;: &quot;51961-4944141-4&quot;,
        &quot;address&quot;: &quot;97263 Marielle Shore Apt. 046\nEast Nash, IN 43033&quot;,
        &quot;city_id&quot;: 206,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 206,
            &quot;title&quot;: &quot;Gleichnershire&quot;,
            &quot;state_id&quot;: 21,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:46.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;first_name&quot;: &quot;Demetris&quot;,
        &quot;last_name&quot;: &quot;Toy&quot;,
        &quot;cnic&quot;: &quot;46484-5397127-8&quot;,
        &quot;address&quot;: &quot;4944 Goodwin Flats Suite 490\nNorth Jefferey, TN 54686&quot;,
        &quot;city_id&quot;: 425,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 425,
            &quot;title&quot;: &quot;Harveymouth&quot;,
            &quot;state_id&quot;: 43,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;first_name&quot;: &quot;Jasper&quot;,
        &quot;last_name&quot;: &quot;O&#039;Reilly&quot;,
        &quot;cnic&quot;: &quot;76193-8514358-6&quot;,
        &quot;address&quot;: &quot;3118 Cartwright Green\nAnkundington, AL 28625-5322&quot;,
        &quot;city_id&quot;: 424,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 424,
            &quot;title&quot;: &quot;Port Alvera&quot;,
            &quot;state_id&quot;: 43,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;first_name&quot;: &quot;Lane&quot;,
        &quot;last_name&quot;: &quot;Lynch&quot;,
        &quot;cnic&quot;: &quot;12965-7572639-2&quot;,
        &quot;address&quot;: &quot;2816 Stokes Tunnel\nJenkinsshire, SD 81015-3653&quot;,
        &quot;city_id&quot;: 399,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 399,
            &quot;title&quot;: &quot;Elisaland&quot;,
            &quot;state_id&quot;: 40,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:49.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;first_name&quot;: &quot;Velva&quot;,
        &quot;last_name&quot;: &quot;Zboncak&quot;,
        &quot;cnic&quot;: &quot;19243-4719242-8&quot;,
        &quot;address&quot;: &quot;131 Stevie Corner\nPort Burdette, KS 43132&quot;,
        &quot;city_id&quot;: 498,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 498,
            &quot;title&quot;: &quot;Zulaufshire&quot;,
            &quot;state_id&quot;: 50,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:51.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:51.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;first_name&quot;: &quot;Jennifer&quot;,
        &quot;last_name&quot;: &quot;Halvorson&quot;,
        &quot;cnic&quot;: &quot;77128-3464707-8&quot;,
        &quot;address&quot;: &quot;6924 Schuppe Gateway\nCatherineberg, MO 68335-8200&quot;,
        &quot;city_id&quot;: 447,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;city&quot;: {
            &quot;id&quot;: 447,
            &quot;title&quot;: &quot;Lake Maymieport&quot;,
            &quot;state_id&quot;: 45,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:50.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vendors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vendors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vendors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vendors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vendors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vendors" data-method="GET"
      data-path="api/vendors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vendors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vendors"
                    onclick="tryItOut('GETapi-vendors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vendors"
                    onclick="cancelTryOut('GETapi-vendors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vendors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vendors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vendors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vendors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-vendors">POST api/vendors</h2>

<p>
</p>



<span id="example-requests-POSTapi-vendors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"architecto\",
    \"last_name\": \"architecto\",
    \"cnic\": \"architecto\",
    \"city_id\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "architecto",
    "last_name": "architecto",
    "cnic": "architecto",
    "city_id": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendors">
</span>
<span id="execution-results-POSTapi-vendors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendors" data-method="POST"
      data-path="api/vendors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendors"
                    onclick="tryItOut('POSTapi-vendors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendors"
                    onclick="cancelTryOut('POSTapi-vendors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-vendors"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-vendors"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cnic</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cnic"                data-endpoint="POSTapi-vendors"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city_id"                data-endpoint="POSTapi-vendors"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the cities table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-vendors"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-vendors--id-">GET api/vendors/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-vendors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vendors--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;first_name&quot;: &quot;Trudie&quot;,
    &quot;last_name&quot;: &quot;Boyer&quot;,
    &quot;cnic&quot;: &quot;43866-4440150-6&quot;,
    &quot;address&quot;: &quot;8404 Jovan Plain Apt. 095\nHirthefurt, TX 27930-9837&quot;,
    &quot;city_id&quot;: 56,
    &quot;status&quot;: &quot;Inactive&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;city&quot;: {
        &quot;id&quot;: 56,
        &quot;title&quot;: &quot;New Noel&quot;,
        &quot;state_id&quot;: 6,
        &quot;status&quot;: &quot;active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:44.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vendors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vendors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vendors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vendors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vendors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vendors--id-" data-method="GET"
      data-path="api/vendors/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vendors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vendors--id-"
                    onclick="tryItOut('GETapi-vendors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vendors--id-"
                    onclick="cancelTryOut('GETapi-vendors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vendors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vendors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vendors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vendors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-vendors--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-vendors--id-">PUT api/vendors/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-vendors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/vendors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"architecto\",
    \"last_name\": \"architecto\",
    \"city_id\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "architecto",
    "last_name": "architecto",
    "city_id": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-vendors--id-">
</span>
<span id="execution-results-PUTapi-vendors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-vendors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-vendors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-vendors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-vendors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-vendors--id-" data-method="PUT"
      data-path="api/vendors/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-vendors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-vendors--id-"
                    onclick="tryItOut('PUTapi-vendors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-vendors--id-"
                    onclick="cancelTryOut('PUTapi-vendors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-vendors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/vendors/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/vendors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-vendors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-vendors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-vendors--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-vendors--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PUTapi-vendors--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cnic</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cnic"                data-endpoint="PUTapi-vendors--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city_id"                data-endpoint="PUTapi-vendors--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the cities table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-vendors--id-"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-vendors--id-">DELETE api/vendors/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-vendors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/vendors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-vendors--id-">
</span>
<span id="execution-results-DELETEapi-vendors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-vendors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-vendors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-vendors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-vendors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-vendors--id-" data-method="DELETE"
      data-path="api/vendors/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-vendors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-vendors--id-"
                    onclick="tryItOut('DELETEapi-vendors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-vendors--id-"
                    onclick="cancelTryOut('DELETEapi-vendors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-vendors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/vendors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-vendors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-vendors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-vendors--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-categories">GET api/categories</h2>

<p>
</p>



<span id="example-requests-GETapi-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Bridal&quot;,
        &quot;img_path&quot;: null,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Fancy&quot;,
        &quot;img_path&quot;: null,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Casual&quot;,
        &quot;img_path&quot;: null,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories" data-method="GET"
      data-path="api/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories"
                    onclick="tryItOut('GETapi-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories"
                    onclick="cancelTryOut('GETapi-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-categories">POST api/categories</h2>

<p>
</p>



<span id="example-requests-POSTapi-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"img_path\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "img_path": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-categories">
</span>
<span id="execution-results-POSTapi-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-categories" data-method="POST"
      data-path="api/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-categories"
                    onclick="tryItOut('POSTapi-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-categories"
                    onclick="cancelTryOut('POSTapi-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-categories"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>img_path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="img_path"                data-endpoint="POSTapi-categories"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-categories"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-categories--id-">GET api/categories/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Bridal&quot;,
    &quot;img_path&quot;: null,
    &quot;status&quot;: &quot;Active&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories--id-" data-method="GET"
      data-path="api/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories--id-"
                    onclick="tryItOut('GETapi-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories--id-"
                    onclick="cancelTryOut('GETapi-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-categories--id-">PUT api/categories/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"img_path\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "img_path": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-categories--id-">
</span>
<span id="execution-results-PUTapi-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-categories--id-" data-method="PUT"
      data-path="api/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-categories--id-"
                    onclick="tryItOut('PUTapi-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-categories--id-"
                    onclick="cancelTryOut('PUTapi-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/categories/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-categories--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>img_path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="img_path"                data-endpoint="PUTapi-categories--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-categories--id-"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-categories--id-">DELETE api/categories/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-categories--id-">
</span>
<span id="execution-results-DELETEapi-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-categories--id-" data-method="DELETE"
      data-path="api/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-categories--id-"
                    onclick="tryItOut('DELETEapi-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-categories--id-"
                    onclick="cancelTryOut('DELETEapi-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-subcategories">GET api/subcategories</h2>

<p>
</p>



<span id="example-requests-GETapi-subcategories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/subcategories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/subcategories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-subcategories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Lahnga&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 1,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Bridal&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 1,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Bridal&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;LongShirt&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 1,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Bridal&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Sharara&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 2,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Fancy&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;Garara&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 2,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Fancy&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;title&quot;: &quot;Shalwar Kameez&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 2,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Fancy&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;title&quot;: &quot;Lahga Choli&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 2,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Fancy&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;title&quot;: &quot;Readymade&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 3,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Casual&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;title&quot;: &quot;Unstitched&quot;,
        &quot;img_path&quot;: null,
        &quot;category_id&quot;: 3,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Casual&quot;,
            &quot;img_path&quot;: null,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-subcategories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-subcategories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-subcategories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-subcategories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-subcategories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-subcategories" data-method="GET"
      data-path="api/subcategories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-subcategories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-subcategories"
                    onclick="tryItOut('GETapi-subcategories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-subcategories"
                    onclick="cancelTryOut('GETapi-subcategories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-subcategories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/subcategories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-subcategories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-subcategories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-subcategories">POST api/subcategories</h2>

<p>
</p>



<span id="example-requests-POSTapi-subcategories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/subcategories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"img_path\": \"architecto\",
    \"category_id\": \"architecto\",
    \"status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/subcategories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "img_path": "architecto",
    "category_id": "architecto",
    "status": "Active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-subcategories">
</span>
<span id="execution-results-POSTapi-subcategories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-subcategories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-subcategories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-subcategories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-subcategories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-subcategories" data-method="POST"
      data-path="api/subcategories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-subcategories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-subcategories"
                    onclick="tryItOut('POSTapi-subcategories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-subcategories"
                    onclick="cancelTryOut('POSTapi-subcategories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-subcategories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/subcategories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-subcategories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-subcategories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-subcategories"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>img_path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="img_path"                data-endpoint="POSTapi-subcategories"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="POSTapi-subcategories"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the categories table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-subcategories"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-subcategories--id-">GET api/subcategories/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-subcategories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/subcategories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/subcategories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-subcategories--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Lahnga&quot;,
    &quot;img_path&quot;: null,
    &quot;category_id&quot;: 1,
    &quot;status&quot;: &quot;Active&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;category&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Bridal&quot;,
        &quot;img_path&quot;: null,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-subcategories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-subcategories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-subcategories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-subcategories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-subcategories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-subcategories--id-" data-method="GET"
      data-path="api/subcategories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-subcategories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-subcategories--id-"
                    onclick="tryItOut('GETapi-subcategories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-subcategories--id-"
                    onclick="cancelTryOut('GETapi-subcategories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-subcategories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/subcategories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-subcategories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-subcategories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-subcategories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the subcategory. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-subcategories--id-">PUT api/subcategories/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-subcategories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/subcategories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"img_path\": \"architecto\",
    \"category_id\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/subcategories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "img_path": "architecto",
    "category_id": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-subcategories--id-">
</span>
<span id="execution-results-PUTapi-subcategories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-subcategories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-subcategories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-subcategories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-subcategories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-subcategories--id-" data-method="PUT"
      data-path="api/subcategories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-subcategories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-subcategories--id-"
                    onclick="tryItOut('PUTapi-subcategories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-subcategories--id-"
                    onclick="cancelTryOut('PUTapi-subcategories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-subcategories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/subcategories/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/subcategories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-subcategories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-subcategories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-subcategories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the subcategory. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-subcategories--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>img_path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="img_path"                data-endpoint="PUTapi-subcategories--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category_id"                data-endpoint="PUTapi-subcategories--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the categories table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-subcategories--id-"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-subcategories--id-">DELETE api/subcategories/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-subcategories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/subcategories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/subcategories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-subcategories--id-">
</span>
<span id="execution-results-DELETEapi-subcategories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-subcategories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-subcategories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-subcategories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-subcategories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-subcategories--id-" data-method="DELETE"
      data-path="api/subcategories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-subcategories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-subcategories--id-"
                    onclick="tryItOut('DELETEapi-subcategories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-subcategories--id-"
                    onclick="cancelTryOut('DELETEapi-subcategories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-subcategories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/subcategories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-subcategories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-subcategories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-subcategories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the subcategory. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-sizes">GET api/sizes</h2>

<p>
</p>



<span id="example-requests-GETapi-sizes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/sizes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/sizes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-sizes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Small&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Medium&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Large&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Extra Large&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-sizes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-sizes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-sizes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-sizes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-sizes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-sizes" data-method="GET"
      data-path="api/sizes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-sizes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-sizes"
                    onclick="tryItOut('GETapi-sizes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-sizes"
                    onclick="cancelTryOut('GETapi-sizes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-sizes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/sizes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-sizes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-sizes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-sizes">POST api/sizes</h2>

<p>
</p>



<span id="example-requests-POSTapi-sizes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/sizes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/sizes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "status": "Active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-sizes">
</span>
<span id="execution-results-POSTapi-sizes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-sizes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-sizes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-sizes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-sizes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-sizes" data-method="POST"
      data-path="api/sizes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-sizes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-sizes"
                    onclick="tryItOut('POSTapi-sizes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-sizes"
                    onclick="cancelTryOut('POSTapi-sizes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-sizes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/sizes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-sizes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-sizes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-sizes"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-sizes"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-sizes--id-">GET api/sizes/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-sizes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/sizes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/sizes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-sizes--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Small&quot;,
    &quot;status&quot;: &quot;Active&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-sizes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-sizes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-sizes--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-sizes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-sizes--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-sizes--id-" data-method="GET"
      data-path="api/sizes/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-sizes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-sizes--id-"
                    onclick="tryItOut('GETapi-sizes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-sizes--id-"
                    onclick="cancelTryOut('GETapi-sizes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-sizes--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/sizes/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-sizes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-sizes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-sizes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the size. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-sizes--id-">PUT api/sizes/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-sizes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/sizes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/sizes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "Inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-sizes--id-">
</span>
<span id="execution-results-PUTapi-sizes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-sizes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-sizes--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-sizes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-sizes--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-sizes--id-" data-method="PUT"
      data-path="api/sizes/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-sizes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-sizes--id-"
                    onclick="tryItOut('PUTapi-sizes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-sizes--id-"
                    onclick="cancelTryOut('PUTapi-sizes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-sizes--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/sizes/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/sizes/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-sizes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-sizes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-sizes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the size. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-sizes--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-sizes--id-"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-sizes--id-">DELETE api/sizes/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-sizes--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/sizes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/sizes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-sizes--id-">
</span>
<span id="execution-results-DELETEapi-sizes--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-sizes--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-sizes--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-sizes--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-sizes--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-sizes--id-" data-method="DELETE"
      data-path="api/sizes/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-sizes--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-sizes--id-"
                    onclick="tryItOut('DELETEapi-sizes--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-sizes--id-"
                    onclick="cancelTryOut('DELETEapi-sizes--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-sizes--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/sizes/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-sizes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-sizes--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-sizes--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the size. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-colors">GET api/colors</h2>

<p>
</p>



<span id="example-requests-GETapi-colors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/colors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/colors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-colors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Red&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Blue&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Green&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Yellow&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;Black&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;title&quot;: &quot;White&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-colors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-colors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-colors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-colors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-colors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-colors" data-method="GET"
      data-path="api/colors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-colors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-colors"
                    onclick="tryItOut('GETapi-colors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-colors"
                    onclick="cancelTryOut('GETapi-colors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-colors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/colors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-colors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-colors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-colors">POST api/colors</h2>

<p>
</p>



<span id="example-requests-POSTapi-colors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/colors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/colors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "status": "Active"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-colors">
</span>
<span id="execution-results-POSTapi-colors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-colors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-colors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-colors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-colors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-colors" data-method="POST"
      data-path="api/colors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-colors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-colors"
                    onclick="tryItOut('POSTapi-colors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-colors"
                    onclick="cancelTryOut('POSTapi-colors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-colors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/colors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-colors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-colors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-colors"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-colors"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-colors--id-">GET api/colors/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-colors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/colors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/colors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-colors--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Red&quot;,
    &quot;status&quot;: &quot;Active&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-colors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-colors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-colors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-colors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-colors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-colors--id-" data-method="GET"
      data-path="api/colors/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-colors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-colors--id-"
                    onclick="tryItOut('GETapi-colors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-colors--id-"
                    onclick="cancelTryOut('GETapi-colors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-colors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/colors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-colors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-colors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-colors--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the color. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-colors--id-">PUT api/colors/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-colors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/colors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/colors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "Active"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-colors--id-">
</span>
<span id="execution-results-PUTapi-colors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-colors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-colors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-colors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-colors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-colors--id-" data-method="PUT"
      data-path="api/colors/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-colors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-colors--id-"
                    onclick="tryItOut('PUTapi-colors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-colors--id-"
                    onclick="cancelTryOut('PUTapi-colors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-colors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/colors/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/colors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-colors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-colors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-colors--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the color. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-colors--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-colors--id-"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-colors--id-">DELETE api/colors/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-colors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/colors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/colors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-colors--id-">
</span>
<span id="execution-results-DELETEapi-colors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-colors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-colors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-colors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-colors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-colors--id-" data-method="DELETE"
      data-path="api/colors/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-colors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-colors--id-"
                    onclick="tryItOut('DELETEapi-colors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-colors--id-"
                    onclick="cancelTryOut('DELETEapi-colors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-colors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/colors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-colors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-colors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-colors--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the color. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-seasons">GET api/seasons</h2>

<p>
</p>



<span id="example-requests-GETapi-seasons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/seasons" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/seasons"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-seasons">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Winter&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Summer&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Mid-Season&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-seasons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-seasons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-seasons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-seasons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-seasons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-seasons" data-method="GET"
      data-path="api/seasons"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-seasons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-seasons"
                    onclick="tryItOut('GETapi-seasons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-seasons"
                    onclick="cancelTryOut('GETapi-seasons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-seasons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/seasons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-seasons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-seasons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-seasons">POST api/seasons</h2>

<p>
</p>



<span id="example-requests-POSTapi-seasons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/seasons" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/seasons"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-seasons">
</span>
<span id="execution-results-POSTapi-seasons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-seasons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-seasons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-seasons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-seasons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-seasons" data-method="POST"
      data-path="api/seasons"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-seasons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-seasons"
                    onclick="tryItOut('POSTapi-seasons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-seasons"
                    onclick="cancelTryOut('POSTapi-seasons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-seasons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/seasons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-seasons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-seasons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-seasons"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-seasons"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-seasons--id-">GET api/seasons/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-seasons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/seasons/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/seasons/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-seasons--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Winter&quot;,
    &quot;status&quot;: &quot;Active&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-seasons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-seasons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-seasons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-seasons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-seasons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-seasons--id-" data-method="GET"
      data-path="api/seasons/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-seasons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-seasons--id-"
                    onclick="tryItOut('GETapi-seasons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-seasons--id-"
                    onclick="cancelTryOut('GETapi-seasons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-seasons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/seasons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-seasons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-seasons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-seasons--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the season. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-seasons--id-">PUT api/seasons/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-seasons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/seasons/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"Active\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/seasons/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "Active"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-seasons--id-">
</span>
<span id="execution-results-PUTapi-seasons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-seasons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-seasons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-seasons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-seasons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-seasons--id-" data-method="PUT"
      data-path="api/seasons/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-seasons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-seasons--id-"
                    onclick="tryItOut('PUTapi-seasons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-seasons--id-"
                    onclick="cancelTryOut('PUTapi-seasons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-seasons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/seasons/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/seasons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-seasons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-seasons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-seasons--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the season. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-seasons--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-seasons--id-"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-seasons--id-">DELETE api/seasons/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-seasons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/seasons/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/seasons/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-seasons--id-">
</span>
<span id="execution-results-DELETEapi-seasons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-seasons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-seasons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-seasons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-seasons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-seasons--id-" data-method="DELETE"
      data-path="api/seasons/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-seasons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-seasons--id-"
                    onclick="tryItOut('DELETEapi-seasons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-seasons--id-"
                    onclick="cancelTryOut('DELETEapi-seasons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-seasons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/seasons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-seasons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-seasons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-seasons--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the season. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-materials">GET api/materials</h2>

<p>
</p>



<span id="example-requests-GETapi-materials">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/materials" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/materials"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-materials">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Cotton&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Silk&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Linen&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Wool&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;Denim&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;title&quot;: &quot;Polyester&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;title&quot;: &quot;Fabric&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-materials" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-materials"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-materials"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-materials" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-materials">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-materials" data-method="GET"
      data-path="api/materials"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-materials', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-materials"
                    onclick="tryItOut('GETapi-materials');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-materials"
                    onclick="cancelTryOut('GETapi-materials');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-materials"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/materials</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-materials"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-materials"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-materials">POST api/materials</h2>

<p>
</p>



<span id="example-requests-POSTapi-materials">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/materials" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"architecto\",
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/materials"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "architecto",
    "status": "Inactive"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-materials">
</span>
<span id="execution-results-POSTapi-materials" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-materials"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-materials"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-materials" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-materials">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-materials" data-method="POST"
      data-path="api/materials"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-materials', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-materials"
                    onclick="tryItOut('POSTapi-materials');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-materials"
                    onclick="cancelTryOut('POSTapi-materials');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-materials"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/materials</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-materials"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-materials"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-materials"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-materials"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-materials--id-">GET api/materials/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-materials--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/materials/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/materials/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-materials--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;Cotton&quot;,
    &quot;status&quot;: &quot;Active&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-materials--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-materials--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-materials--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-materials--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-materials--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-materials--id-" data-method="GET"
      data-path="api/materials/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-materials--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-materials--id-"
                    onclick="tryItOut('GETapi-materials--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-materials--id-"
                    onclick="cancelTryOut('GETapi-materials--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-materials--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/materials/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-materials--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-materials--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-materials--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the material. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-materials--id-">PUT api/materials/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-materials--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/materials/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"Inactive\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/materials/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "Inactive"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-materials--id-">
</span>
<span id="execution-results-PUTapi-materials--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-materials--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-materials--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-materials--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-materials--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-materials--id-" data-method="PUT"
      data-path="api/materials/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-materials--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-materials--id-"
                    onclick="tryItOut('PUTapi-materials--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-materials--id-"
                    onclick="cancelTryOut('PUTapi-materials--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-materials--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/materials/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/materials/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-materials--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-materials--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-materials--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the material. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-materials--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-materials--id-"
               value="Inactive"
               data-component="body">
    <br>
<p>Example: <code>Inactive</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-materials--id-">DELETE api/materials/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-materials--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/materials/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/materials/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-materials--id-">
</span>
<span id="execution-results-DELETEapi-materials--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-materials--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-materials--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-materials--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-materials--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-materials--id-" data-method="DELETE"
      data-path="api/materials/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-materials--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-materials--id-"
                    onclick="tryItOut('DELETEapi-materials--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-materials--id-"
                    onclick="cancelTryOut('DELETEapi-materials--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-materials--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/materials/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-materials--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-materials--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-materials--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the material. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-products">GET api/products</h2>

<p>
</p>



<span id="example-requests-GETapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC034&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007700?text=fashion+ut&quot;,
        &quot;sub_category_id&quot;: 8,
        &quot;sale_price&quot;: &quot;4169.75&quot;,
        &quot;opening_stock_quantity&quot;: 27,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;2394080669430&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Readymade&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC871&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001144?text=fashion+nemo&quot;,
        &quot;sub_category_id&quot;: 2,
        &quot;sale_price&quot;: &quot;1485.00&quot;,
        &quot;opening_stock_quantity&quot;: 38,
        &quot;user_id&quot;: 9,
        &quot;barcode&quot;: &quot;6138467305179&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC980&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0066cc?text=fashion+quas&quot;,
        &quot;sub_category_id&quot;: 6,
        &quot;sale_price&quot;: &quot;2959.88&quot;,
        &quot;opening_stock_quantity&quot;: 44,
        &quot;user_id&quot;: 3,
        &quot;barcode&quot;: &quot;9707645296249&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Shalwar Kameez&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC895&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003344?text=fashion+qui&quot;,
        &quot;sub_category_id&quot;: 7,
        &quot;sale_price&quot;: &quot;4713.79&quot;,
        &quot;opening_stock_quantity&quot;: 10,
        &quot;user_id&quot;: 5,
        &quot;barcode&quot;: &quot;4881995636605&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Lahga Choli&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC198&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00eedd?text=fashion+enim&quot;,
        &quot;sub_category_id&quot;: 6,
        &quot;sale_price&quot;: &quot;4170.72&quot;,
        &quot;opening_stock_quantity&quot;: 6,
        &quot;user_id&quot;: 6,
        &quot;barcode&quot;: &quot;1441739426133&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Shalwar Kameez&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC165&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003311?text=fashion+adipisci&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;3429.42&quot;,
        &quot;opening_stock_quantity&quot;: 44,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;1278406927279&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC912&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee11?text=fashion+velit&quot;,
        &quot;sub_category_id&quot;: 6,
        &quot;sale_price&quot;: &quot;3343.25&quot;,
        &quot;opening_stock_quantity&quot;: 10,
        &quot;user_id&quot;: 3,
        &quot;barcode&quot;: &quot;4341105343361&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Shalwar Kameez&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC902&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff55?text=fashion+maiores&quot;,
        &quot;sub_category_id&quot;: 7,
        &quot;sale_price&quot;: &quot;3189.62&quot;,
        &quot;opening_stock_quantity&quot;: 15,
        &quot;user_id&quot;: 5,
        &quot;barcode&quot;: &quot;0053431460509&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Lahga Choli&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC855&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/000033?text=fashion+inventore&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;1109.24&quot;,
        &quot;opening_stock_quantity&quot;: 43,
        &quot;user_id&quot;: 2,
        &quot;barcode&quot;: &quot;6329370688866&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Unstitched&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC962&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc33?text=fashion+vitae&quot;,
        &quot;sub_category_id&quot;: 2,
        &quot;sale_price&quot;: &quot;4880.22&quot;,
        &quot;opening_stock_quantity&quot;: 31,
        &quot;user_id&quot;: 1,
        &quot;barcode&quot;: &quot;3141196651045&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC663&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd11?text=fashion+architecto&quot;,
        &quot;sub_category_id&quot;: 3,
        &quot;sale_price&quot;: &quot;4190.76&quot;,
        &quot;opening_stock_quantity&quot;: 5,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;4569645648894&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;LongShirt&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC719&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc99?text=fashion+eius&quot;,
        &quot;sub_category_id&quot;: 8,
        &quot;sale_price&quot;: &quot;3479.65&quot;,
        &quot;opening_stock_quantity&quot;: 45,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;5095142502715&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Readymade&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC740&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
        &quot;sub_category_id&quot;: 4,
        &quot;sale_price&quot;: &quot;2208.37&quot;,
        &quot;opening_stock_quantity&quot;: 42,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;2478892174105&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Sharara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC888&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001111?text=fashion+sit&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;1464.61&quot;,
        &quot;opening_stock_quantity&quot;: 33,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;5468834464392&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC243&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+ducimus&quot;,
        &quot;sub_category_id&quot;: 7,
        &quot;sale_price&quot;: &quot;4515.67&quot;,
        &quot;opening_stock_quantity&quot;: 35,
        &quot;user_id&quot;: 10,
        &quot;barcode&quot;: &quot;1021009187805&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Lahga Choli&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC346&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
        &quot;sub_category_id&quot;: 6,
        &quot;sale_price&quot;: &quot;1876.34&quot;,
        &quot;opening_stock_quantity&quot;: 26,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;7528746238967&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Shalwar Kameez&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC562&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007788?text=fashion+et&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;4612.13&quot;,
        &quot;opening_stock_quantity&quot;: 48,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;1220278102278&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC918&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+atque&quot;,
        &quot;sub_category_id&quot;: 4,
        &quot;sale_price&quot;: &quot;3552.95&quot;,
        &quot;opening_stock_quantity&quot;: 17,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;5373886232533&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Sharara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC548&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007799?text=fashion+ut&quot;,
        &quot;sub_category_id&quot;: 4,
        &quot;sale_price&quot;: &quot;4831.53&quot;,
        &quot;opening_stock_quantity&quot;: 11,
        &quot;user_id&quot;: 11,
        &quot;barcode&quot;: &quot;5188983942168&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Sharara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC313&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003333?text=fashion+et&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;2022.44&quot;,
        &quot;opening_stock_quantity&quot;: 48,
        &quot;user_id&quot;: 8,
        &quot;barcode&quot;: &quot;5887350312725&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Unstitched&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC952&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd55?text=fashion+non&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;1101.70&quot;,
        &quot;opening_stock_quantity&quot;: 40,
        &quot;user_id&quot;: 11,
        &quot;barcode&quot;: &quot;9722312796501&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Unstitched&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC392&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0099bb?text=fashion+est&quot;,
        &quot;sub_category_id&quot;: 8,
        &quot;sale_price&quot;: &quot;4535.28&quot;,
        &quot;opening_stock_quantity&quot;: 36,
        &quot;user_id&quot;: 8,
        &quot;barcode&quot;: &quot;1417056459727&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Readymade&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 23,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC105&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff11?text=fashion+molestiae&quot;,
        &quot;sub_category_id&quot;: 4,
        &quot;sale_price&quot;: &quot;4795.20&quot;,
        &quot;opening_stock_quantity&quot;: 22,
        &quot;user_id&quot;: 6,
        &quot;barcode&quot;: &quot;1980441298398&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Sharara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 24,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC674&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/008866?text=fashion+id&quot;,
        &quot;sub_category_id&quot;: 2,
        &quot;sale_price&quot;: &quot;2138.84&quot;,
        &quot;opening_stock_quantity&quot;: 40,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;9168269872378&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 25,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC873&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/005555?text=fashion+tempora&quot;,
        &quot;sub_category_id&quot;: 7,
        &quot;sale_price&quot;: &quot;2256.92&quot;,
        &quot;opening_stock_quantity&quot;: 24,
        &quot;user_id&quot;: 11,
        &quot;barcode&quot;: &quot;4840517133701&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Lahga Choli&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 26,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC470&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00bb44?text=fashion+voluptatem&quot;,
        &quot;sub_category_id&quot;: 2,
        &quot;sale_price&quot;: &quot;1014.79&quot;,
        &quot;opening_stock_quantity&quot;: 28,
        &quot;user_id&quot;: 1,
        &quot;barcode&quot;: &quot;1942275445683&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 27,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC064&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00aadd?text=fashion+sit&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;3871.22&quot;,
        &quot;opening_stock_quantity&quot;: 40,
        &quot;user_id&quot;: 11,
        &quot;barcode&quot;: &quot;1858406240150&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Unstitched&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 28,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC444&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00bb88?text=fashion+eos&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;3773.64&quot;,
        &quot;opening_stock_quantity&quot;: 15,
        &quot;user_id&quot;: 1,
        &quot;barcode&quot;: &quot;9433105209329&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 29,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC804&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/006677?text=fashion+aut&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;3517.74&quot;,
        &quot;opening_stock_quantity&quot;: 39,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;5010043501346&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 30,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC569&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022bb?text=fashion+atque&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;3393.82&quot;,
        &quot;opening_stock_quantity&quot;: 45,
        &quot;user_id&quot;: 3,
        &quot;barcode&quot;: &quot;1212083077025&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 31,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC143&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003399?text=fashion+non&quot;,
        &quot;sub_category_id&quot;: 2,
        &quot;sale_price&quot;: &quot;1844.69&quot;,
        &quot;opening_stock_quantity&quot;: 9,
        &quot;user_id&quot;: 11,
        &quot;barcode&quot;: &quot;6464086187637&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 32,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC471&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003388?text=fashion+perferendis&quot;,
        &quot;sub_category_id&quot;: 6,
        &quot;sale_price&quot;: &quot;1644.22&quot;,
        &quot;opening_stock_quantity&quot;: 16,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;0383275787990&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Shalwar Kameez&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 33,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC212&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/005577?text=fashion+reiciendis&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;2831.54&quot;,
        &quot;opening_stock_quantity&quot;: 19,
        &quot;user_id&quot;: 3,
        &quot;barcode&quot;: &quot;5969029939737&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Unstitched&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 3,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 34,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC052&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd00?text=fashion+dicta&quot;,
        &quot;sub_category_id&quot;: 5,
        &quot;sale_price&quot;: &quot;3860.35&quot;,
        &quot;opening_stock_quantity&quot;: 30,
        &quot;user_id&quot;: 7,
        &quot;barcode&quot;: &quot;1460658406033&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Garara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 35,
        &quot;title&quot;: &quot;Banarci&quot;,
        &quot;design_code&quot;: &quot;DC988&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff22?text=fashion+et&quot;,
        &quot;sub_category_id&quot;: 4,
        &quot;sale_price&quot;: &quot;4773.55&quot;,
        &quot;opening_stock_quantity&quot;: 38,
        &quot;user_id&quot;: 4,
        &quot;barcode&quot;: &quot;2665575457031&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Sharara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 36,
        &quot;title&quot;: &quot;Anarkali&quot;,
        &quot;design_code&quot;: &quot;DC336&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee22?text=fashion+et&quot;,
        &quot;sub_category_id&quot;: 7,
        &quot;sale_price&quot;: &quot;4646.44&quot;,
        &quot;opening_stock_quantity&quot;: 47,
        &quot;user_id&quot;: 9,
        &quot;barcode&quot;: &quot;9640637360910&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Lahga Choli&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 37,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC564&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0044ee?text=fashion+rerum&quot;,
        &quot;sub_category_id&quot;: 5,
        &quot;sale_price&quot;: &quot;4675.73&quot;,
        &quot;opening_stock_quantity&quot;: 10,
        &quot;user_id&quot;: 8,
        &quot;barcode&quot;: &quot;1353048111290&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Garara&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 2,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 38,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC014&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00bb55?text=fashion+enim&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;4124.91&quot;,
        &quot;opening_stock_quantity&quot;: 41,
        &quot;user_id&quot;: 10,
        &quot;barcode&quot;: &quot;5698027941366&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 39,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC087&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0044ff?text=fashion+rerum&quot;,
        &quot;sub_category_id&quot;: 1,
        &quot;sale_price&quot;: &quot;2557.15&quot;,
        &quot;opening_stock_quantity&quot;: 46,
        &quot;user_id&quot;: 5,
        &quot;barcode&quot;: &quot;4346055342914&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Lahnga&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 40,
        &quot;title&quot;: &quot;Maxi&quot;,
        &quot;design_code&quot;: &quot;DC952&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddff?text=fashion+quae&quot;,
        &quot;sub_category_id&quot;: 2,
        &quot;sale_price&quot;: &quot;1099.34&quot;,
        &quot;opening_stock_quantity&quot;: 32,
        &quot;user_id&quot;: 6,
        &quot;barcode&quot;: &quot;9398462028009&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;sub_category&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;img_path&quot;: null,
            &quot;category_id&quot;: 1,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products" data-method="GET"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products"
                    onclick="tryItOut('GETapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products"
                    onclick="cancelTryOut('GETapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-products">POST api/products</h2>

<p>
</p>



<span id="example-requests-POSTapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/products" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=b"\
    --form "design_code=n"\
    --form "sub_category_id=architecto"\
    --form "sale_price=39"\
    --form "opening_stock_quantity=84"\
    --form "user_id=architecto"\
    --form "barcode=architecto"\
    --form "status=Active"\
    --form "image=@C:\Users\Zafar Iqbal\AppData\Local\Temp\phpE7BC.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'b');
body.append('design_code', 'n');
body.append('sub_category_id', 'architecto');
body.append('sale_price', '39');
body.append('opening_stock_quantity', '84');
body.append('user_id', 'architecto');
body.append('barcode', 'architecto');
body.append('status', 'Active');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products">
</span>
<span id="execution-results-POSTapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products" data-method="POST"
      data-path="api/products"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products"
                    onclick="tryItOut('POSTapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products"
                    onclick="cancelTryOut('POSTapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-products"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>design_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="design_code"                data-endpoint="POSTapi-products"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-products"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Zafar Iqbal\AppData\Local\Temp\phpE7BC.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sub_category_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sub_category_id"                data-endpoint="POSTapi-products"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the sub_categories table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sale_price"                data-endpoint="POSTapi-products"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>opening_stock_quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="opening_stock_quantity"                data-endpoint="POSTapi-products"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user_id"                data-endpoint="POSTapi-products"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>barcode</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="barcode"                data-endpoint="POSTapi-products"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-products"
               value="Active"
               data-component="body">
    <br>
<p>Example: <code>Active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>Active</code></li> <li><code>Inactive</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-purchases">GET api/purchases</h2>

<p>
</p>



<span id="example-requests-GETapi-purchases">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/purchases" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/purchases"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-purchases">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;date&quot;: &quot;2017-10-02&quot;,
        &quot;ven_inv_no&quot;: &quot;INV051&quot;,
        &quot;ven_inv_date&quot;: &quot;2001-05-14&quot;,
        &quot;ven_inv_ref&quot;: &quot;quibusdam&quot;,
        &quot;description&quot;: &quot;Doloremque aut modi quis et ea voluptates est.&quot;,
        &quot;product_id&quot;: 18,
        &quot;discount_percent&quot;: &quot;11.00&quot;,
        &quot;discount_amt&quot;: &quot;463.12&quot;,
        &quot;inv_amount&quot;: &quot;1547.39&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;details&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;purchase_id&quot;: 1,
                &quot;product_id&quot;: 8,
                &quot;qty&quot;: 5,
                &quot;unit_price&quot;: &quot;494.41&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 8,
                    &quot;title&quot;: &quot;Anarkali&quot;,
                    &quot;design_code&quot;: &quot;DC902&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff55?text=fashion+maiores&quot;,
                    &quot;sub_category_id&quot;: 7,
                    &quot;sale_price&quot;: &quot;3189.62&quot;,
                    &quot;opening_stock_quantity&quot;: 15,
                    &quot;user_id&quot;: 5,
                    &quot;barcode&quot;: &quot;0053431460509&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 2,
                &quot;purchase_id&quot;: 1,
                &quot;product_id&quot;: 13,
                &quot;qty&quot;: 8,
                &quot;unit_price&quot;: &quot;389.62&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 13,
                    &quot;title&quot;: &quot;Long Shirt&quot;,
                    &quot;design_code&quot;: &quot;DC740&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
                    &quot;sub_category_id&quot;: 4,
                    &quot;sale_price&quot;: &quot;2208.37&quot;,
                    &quot;opening_stock_quantity&quot;: 42,
                    &quot;user_id&quot;: 7,
                    &quot;barcode&quot;: &quot;2478892174105&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 3,
                &quot;purchase_id&quot;: 1,
                &quot;product_id&quot;: 12,
                &quot;qty&quot;: 5,
                &quot;unit_price&quot;: &quot;444.78&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 12,
                    &quot;title&quot;: &quot;Long Shirt&quot;,
                    &quot;design_code&quot;: &quot;DC719&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc99?text=fashion+eius&quot;,
                    &quot;sub_category_id&quot;: 8,
                    &quot;sale_price&quot;: &quot;3479.65&quot;,
                    &quot;opening_stock_quantity&quot;: 45,
                    &quot;user_id&quot;: 4,
                    &quot;barcode&quot;: &quot;5095142502715&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            }
        ]
    },
    {
        &quot;id&quot;: 2,
        &quot;date&quot;: &quot;2006-08-21&quot;,
        &quot;ven_inv_no&quot;: &quot;INV682&quot;,
        &quot;ven_inv_date&quot;: &quot;1986-04-17&quot;,
        &quot;ven_inv_ref&quot;: &quot;aut&quot;,
        &quot;description&quot;: &quot;Voluptates quibusdam quo quis possimus fugit.&quot;,
        &quot;product_id&quot;: 1,
        &quot;discount_percent&quot;: &quot;1.00&quot;,
        &quot;discount_amt&quot;: &quot;224.59&quot;,
        &quot;inv_amount&quot;: &quot;4780.29&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;details&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;purchase_id&quot;: 2,
                &quot;product_id&quot;: 3,
                &quot;qty&quot;: 10,
                &quot;unit_price&quot;: &quot;302.96&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 3,
                    &quot;title&quot;: &quot;Maxi&quot;,
                    &quot;design_code&quot;: &quot;DC980&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0066cc?text=fashion+quas&quot;,
                    &quot;sub_category_id&quot;: 6,
                    &quot;sale_price&quot;: &quot;2959.88&quot;,
                    &quot;opening_stock_quantity&quot;: 44,
                    &quot;user_id&quot;: 3,
                    &quot;barcode&quot;: &quot;9707645296249&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 5,
                &quot;purchase_id&quot;: 2,
                &quot;product_id&quot;: 4,
                &quot;qty&quot;: 10,
                &quot;unit_price&quot;: &quot;333.57&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 4,
                    &quot;title&quot;: &quot;Banarci&quot;,
                    &quot;design_code&quot;: &quot;DC895&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003344?text=fashion+qui&quot;,
                    &quot;sub_category_id&quot;: 7,
                    &quot;sale_price&quot;: &quot;4713.79&quot;,
                    &quot;opening_stock_quantity&quot;: 10,
                    &quot;user_id&quot;: 5,
                    &quot;barcode&quot;: &quot;4881995636605&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 6,
                &quot;purchase_id&quot;: 2,
                &quot;product_id&quot;: 2,
                &quot;qty&quot;: 7,
                &quot;unit_price&quot;: &quot;134.21&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 2,
                    &quot;title&quot;: &quot;Banarci&quot;,
                    &quot;design_code&quot;: &quot;DC871&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001144?text=fashion+nemo&quot;,
                    &quot;sub_category_id&quot;: 2,
                    &quot;sale_price&quot;: &quot;1485.00&quot;,
                    &quot;opening_stock_quantity&quot;: 38,
                    &quot;user_id&quot;: 9,
                    &quot;barcode&quot;: &quot;6138467305179&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            }
        ]
    },
    {
        &quot;id&quot;: 3,
        &quot;date&quot;: &quot;2001-07-22&quot;,
        &quot;ven_inv_no&quot;: &quot;INV120&quot;,
        &quot;ven_inv_date&quot;: &quot;1980-12-19&quot;,
        &quot;ven_inv_ref&quot;: &quot;laboriosam&quot;,
        &quot;description&quot;: &quot;Ea alias magnam recusandae.&quot;,
        &quot;product_id&quot;: 11,
        &quot;discount_percent&quot;: &quot;6.00&quot;,
        &quot;discount_amt&quot;: &quot;296.20&quot;,
        &quot;inv_amount&quot;: &quot;4671.76&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;details&quot;: [
            {
                &quot;id&quot;: 7,
                &quot;purchase_id&quot;: 3,
                &quot;product_id&quot;: 16,
                &quot;qty&quot;: 7,
                &quot;unit_price&quot;: &quot;335.21&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 16,
                    &quot;title&quot;: &quot;Anarkali&quot;,
                    &quot;design_code&quot;: &quot;DC346&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
                    &quot;sub_category_id&quot;: 6,
                    &quot;sale_price&quot;: &quot;1876.34&quot;,
                    &quot;opening_stock_quantity&quot;: 26,
                    &quot;user_id&quot;: 4,
                    &quot;barcode&quot;: &quot;7528746238967&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 8,
                &quot;purchase_id&quot;: 3,
                &quot;product_id&quot;: 16,
                &quot;qty&quot;: 6,
                &quot;unit_price&quot;: &quot;457.77&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 16,
                    &quot;title&quot;: &quot;Anarkali&quot;,
                    &quot;design_code&quot;: &quot;DC346&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
                    &quot;sub_category_id&quot;: 6,
                    &quot;sale_price&quot;: &quot;1876.34&quot;,
                    &quot;opening_stock_quantity&quot;: 26,
                    &quot;user_id&quot;: 4,
                    &quot;barcode&quot;: &quot;7528746238967&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 9,
                &quot;purchase_id&quot;: 3,
                &quot;product_id&quot;: 16,
                &quot;qty&quot;: 9,
                &quot;unit_price&quot;: &quot;126.52&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 16,
                    &quot;title&quot;: &quot;Anarkali&quot;,
                    &quot;design_code&quot;: &quot;DC346&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
                    &quot;sub_category_id&quot;: 6,
                    &quot;sale_price&quot;: &quot;1876.34&quot;,
                    &quot;opening_stock_quantity&quot;: 26,
                    &quot;user_id&quot;: 4,
                    &quot;barcode&quot;: &quot;7528746238967&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            }
        ]
    },
    {
        &quot;id&quot;: 4,
        &quot;date&quot;: &quot;2007-12-16&quot;,
        &quot;ven_inv_no&quot;: &quot;INV242&quot;,
        &quot;ven_inv_date&quot;: &quot;2011-10-20&quot;,
        &quot;ven_inv_ref&quot;: &quot;vitae&quot;,
        &quot;description&quot;: &quot;Veniam minima dolorem quo cupiditate in.&quot;,
        &quot;product_id&quot;: 4,
        &quot;discount_percent&quot;: &quot;15.00&quot;,
        &quot;discount_amt&quot;: &quot;347.82&quot;,
        &quot;inv_amount&quot;: &quot;3950.33&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;details&quot;: [
            {
                &quot;id&quot;: 10,
                &quot;purchase_id&quot;: 4,
                &quot;product_id&quot;: 17,
                &quot;qty&quot;: 3,
                &quot;unit_price&quot;: &quot;101.86&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 17,
                    &quot;title&quot;: &quot;Maxi&quot;,
                    &quot;design_code&quot;: &quot;DC562&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007788?text=fashion+et&quot;,
                    &quot;sub_category_id&quot;: 1,
                    &quot;sale_price&quot;: &quot;4612.13&quot;,
                    &quot;opening_stock_quantity&quot;: 48,
                    &quot;user_id&quot;: 7,
                    &quot;barcode&quot;: &quot;1220278102278&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 11,
                &quot;purchase_id&quot;: 4,
                &quot;product_id&quot;: 20,
                &quot;qty&quot;: 4,
                &quot;unit_price&quot;: &quot;158.75&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 20,
                    &quot;title&quot;: &quot;Banarci&quot;,
                    &quot;design_code&quot;: &quot;DC313&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003333?text=fashion+et&quot;,
                    &quot;sub_category_id&quot;: 9,
                    &quot;sale_price&quot;: &quot;2022.44&quot;,
                    &quot;opening_stock_quantity&quot;: 48,
                    &quot;user_id&quot;: 8,
                    &quot;barcode&quot;: &quot;5887350312725&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 12,
                &quot;purchase_id&quot;: 4,
                &quot;product_id&quot;: 4,
                &quot;qty&quot;: 1,
                &quot;unit_price&quot;: &quot;287.79&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 4,
                    &quot;title&quot;: &quot;Banarci&quot;,
                    &quot;design_code&quot;: &quot;DC895&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003344?text=fashion+qui&quot;,
                    &quot;sub_category_id&quot;: 7,
                    &quot;sale_price&quot;: &quot;4713.79&quot;,
                    &quot;opening_stock_quantity&quot;: 10,
                    &quot;user_id&quot;: 5,
                    &quot;barcode&quot;: &quot;4881995636605&quot;,
                    &quot;status&quot;: &quot;Inactive&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            }
        ]
    },
    {
        &quot;id&quot;: 5,
        &quot;date&quot;: &quot;1982-11-30&quot;,
        &quot;ven_inv_no&quot;: &quot;INV720&quot;,
        &quot;ven_inv_date&quot;: &quot;2004-02-28&quot;,
        &quot;ven_inv_ref&quot;: &quot;quasi&quot;,
        &quot;description&quot;: &quot;Accusantium iste commodi qui ut.&quot;,
        &quot;product_id&quot;: 1,
        &quot;discount_percent&quot;: &quot;18.00&quot;,
        &quot;discount_amt&quot;: &quot;128.76&quot;,
        &quot;inv_amount&quot;: &quot;1036.09&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;details&quot;: [
            {
                &quot;id&quot;: 13,
                &quot;purchase_id&quot;: 5,
                &quot;product_id&quot;: 11,
                &quot;qty&quot;: 3,
                &quot;unit_price&quot;: &quot;439.72&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 11,
                    &quot;title&quot;: &quot;Maxi&quot;,
                    &quot;design_code&quot;: &quot;DC663&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd11?text=fashion+architecto&quot;,
                    &quot;sub_category_id&quot;: 3,
                    &quot;sale_price&quot;: &quot;4190.76&quot;,
                    &quot;opening_stock_quantity&quot;: 5,
                    &quot;user_id&quot;: 7,
                    &quot;barcode&quot;: &quot;4569645648894&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 14,
                &quot;purchase_id&quot;: 5,
                &quot;product_id&quot;: 7,
                &quot;qty&quot;: 8,
                &quot;unit_price&quot;: &quot;444.89&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 7,
                    &quot;title&quot;: &quot;Banarci&quot;,
                    &quot;design_code&quot;: &quot;DC912&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee11?text=fashion+velit&quot;,
                    &quot;sub_category_id&quot;: 6,
                    &quot;sale_price&quot;: &quot;3343.25&quot;,
                    &quot;opening_stock_quantity&quot;: 10,
                    &quot;user_id&quot;: 3,
                    &quot;barcode&quot;: &quot;4341105343361&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            },
            {
                &quot;id&quot;: 15,
                &quot;purchase_id&quot;: 5,
                &quot;product_id&quot;: 5,
                &quot;qty&quot;: 1,
                &quot;unit_price&quot;: &quot;494.50&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 5,
                    &quot;title&quot;: &quot;Banarci&quot;,
                    &quot;design_code&quot;: &quot;DC198&quot;,
                    &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00eedd?text=fashion+enim&quot;,
                    &quot;sub_category_id&quot;: 6,
                    &quot;sale_price&quot;: &quot;4170.72&quot;,
                    &quot;opening_stock_quantity&quot;: 6,
                    &quot;user_id&quot;: 6,
                    &quot;barcode&quot;: &quot;1441739426133&quot;,
                    &quot;status&quot;: &quot;Active&quot;,
                    &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
                }
            }
        ]
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-purchases" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-purchases"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-purchases"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-purchases" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-purchases">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-purchases" data-method="GET"
      data-path="api/purchases"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-purchases', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-purchases"
                    onclick="tryItOut('GETapi-purchases');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-purchases"
                    onclick="cancelTryOut('GETapi-purchases');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-purchases"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/purchases</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-purchases"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-purchases"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-purchases">POST api/purchases</h2>

<p>
</p>



<span id="example-requests-POSTapi-purchases">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/purchases" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date\": \"2025-09-29T15:16:04\",
    \"ven_inv_no\": \"architecto\",
    \"ven_inv_date\": \"2025-09-29T15:16:04\",
    \"ven_inv_ref\": \"architecto\",
    \"description\": \"Eius et animi quos velit et.\",
    \"product_id\": \"architecto\",
    \"discount_percent\": 39,
    \"discount_amt\": 84,
    \"inv_amount\": 12
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/purchases"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date": "2025-09-29T15:16:04",
    "ven_inv_no": "architecto",
    "ven_inv_date": "2025-09-29T15:16:04",
    "ven_inv_ref": "architecto",
    "description": "Eius et animi quos velit et.",
    "product_id": "architecto",
    "discount_percent": 39,
    "discount_amt": 84,
    "inv_amount": 12
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-purchases">
</span>
<span id="execution-results-POSTapi-purchases" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-purchases"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-purchases"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-purchases" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-purchases">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-purchases" data-method="POST"
      data-path="api/purchases"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-purchases', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-purchases"
                    onclick="tryItOut('POSTapi-purchases');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-purchases"
                    onclick="cancelTryOut('POSTapi-purchases');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-purchases"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/purchases</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-purchases"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-purchases"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTapi-purchases"
               value="2025-09-29T15:16:04"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:04</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ven_inv_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ven_inv_no"                data-endpoint="POSTapi-purchases"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ven_inv_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ven_inv_date"                data-endpoint="POSTapi-purchases"
               value="2025-09-29T15:16:04"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:04</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ven_inv_ref</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="ven_inv_ref"                data-endpoint="POSTapi-purchases"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-purchases"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTapi-purchases"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>discount_percent</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="discount_percent"                data-endpoint="POSTapi-purchases"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>discount_amt</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="discount_amt"                data-endpoint="POSTapi-purchases"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>inv_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inv_amount"                data-endpoint="POSTapi-purchases"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-purchase_returns">GET api/purchase_returns</h2>

<p>
</p>



<span id="example-requests-GETapi-purchase_returns">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/purchase_returns" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/purchase_returns"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-purchase_returns">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;date&quot;: &quot;1996-02-27&quot;,
        &quot;vendor_id&quot;: 10,
        &quot;description&quot;: &quot;Optio dolorum autem atque voluptate sunt ad.&quot;,
        &quot;product_id&quot;: 1,
        &quot;return_inv_amount&quot;: &quot;383.43&quot;,
        &quot;purchase_id&quot;: 2,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 10,
            &quot;first_name&quot;: &quot;Jennifer&quot;,
            &quot;last_name&quot;: &quot;Halvorson&quot;,
            &quot;cnic&quot;: &quot;77128-3464707-8&quot;,
            &quot;address&quot;: &quot;6924 Schuppe Gateway\nCatherineberg, MO 68335-8200&quot;,
            &quot;city_id&quot;: 447,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC034&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007700?text=fashion+ut&quot;,
            &quot;sub_category_id&quot;: 8,
            &quot;sale_price&quot;: &quot;4169.75&quot;,
            &quot;opening_stock_quantity&quot;: 27,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2394080669430&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;2006-08-21&quot;,
            &quot;ven_inv_no&quot;: &quot;INV682&quot;,
            &quot;ven_inv_date&quot;: &quot;1986-04-17&quot;,
            &quot;ven_inv_ref&quot;: &quot;aut&quot;,
            &quot;description&quot;: &quot;Voluptates quibusdam quo quis possimus fugit.&quot;,
            &quot;product_id&quot;: 1,
            &quot;discount_percent&quot;: &quot;1.00&quot;,
            &quot;discount_amt&quot;: &quot;224.59&quot;,
            &quot;inv_amount&quot;: &quot;4780.29&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;date&quot;: &quot;1988-04-19&quot;,
        &quot;vendor_id&quot;: 9,
        &quot;description&quot;: &quot;Qui perspiciatis quibusdam vel est reprehenderit iste nihil.&quot;,
        &quot;product_id&quot;: 7,
        &quot;return_inv_amount&quot;: &quot;1486.45&quot;,
        &quot;purchase_id&quot;: 4,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 9,
            &quot;first_name&quot;: &quot;Velva&quot;,
            &quot;last_name&quot;: &quot;Zboncak&quot;,
            &quot;cnic&quot;: &quot;19243-4719242-8&quot;,
            &quot;address&quot;: &quot;131 Stevie Corner\nPort Burdette, KS 43132&quot;,
            &quot;city_id&quot;: 498,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC912&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee11?text=fashion+velit&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;3343.25&quot;,
            &quot;opening_stock_quantity&quot;: 10,
            &quot;user_id&quot;: 3,
            &quot;barcode&quot;: &quot;4341105343361&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 4,
            &quot;date&quot;: &quot;2007-12-16&quot;,
            &quot;ven_inv_no&quot;: &quot;INV242&quot;,
            &quot;ven_inv_date&quot;: &quot;2011-10-20&quot;,
            &quot;ven_inv_ref&quot;: &quot;vitae&quot;,
            &quot;description&quot;: &quot;Veniam minima dolorem quo cupiditate in.&quot;,
            &quot;product_id&quot;: 4,
            &quot;discount_percent&quot;: &quot;15.00&quot;,
            &quot;discount_amt&quot;: &quot;347.82&quot;,
            &quot;inv_amount&quot;: &quot;3950.33&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;date&quot;: &quot;1986-02-05&quot;,
        &quot;vendor_id&quot;: 2,
        &quot;description&quot;: &quot;Fugit ab voluptatibus sed beatae delectus qui qui.&quot;,
        &quot;product_id&quot;: 12,
        &quot;return_inv_amount&quot;: &quot;1903.44&quot;,
        &quot;purchase_id&quot;: 3,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 2,
            &quot;first_name&quot;: &quot;Theron&quot;,
            &quot;last_name&quot;: &quot;Monahan&quot;,
            &quot;cnic&quot;: &quot;84378-0855782-4&quot;,
            &quot;address&quot;: &quot;596 Abraham Via Apt. 036\nNorth Noemieburgh, NH 79773&quot;,
            &quot;city_id&quot;: 109,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 12,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC719&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc99?text=fashion+eius&quot;,
            &quot;sub_category_id&quot;: 8,
            &quot;sale_price&quot;: &quot;3479.65&quot;,
            &quot;opening_stock_quantity&quot;: 45,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5095142502715&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 3,
            &quot;date&quot;: &quot;2001-07-22&quot;,
            &quot;ven_inv_no&quot;: &quot;INV120&quot;,
            &quot;ven_inv_date&quot;: &quot;1980-12-19&quot;,
            &quot;ven_inv_ref&quot;: &quot;laboriosam&quot;,
            &quot;description&quot;: &quot;Ea alias magnam recusandae.&quot;,
            &quot;product_id&quot;: 11,
            &quot;discount_percent&quot;: &quot;6.00&quot;,
            &quot;discount_amt&quot;: &quot;296.20&quot;,
            &quot;inv_amount&quot;: &quot;4671.76&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;date&quot;: &quot;2002-07-25&quot;,
        &quot;vendor_id&quot;: 6,
        &quot;description&quot;: &quot;Unde eum explicabo rem asperiores totam eius.&quot;,
        &quot;product_id&quot;: 13,
        &quot;return_inv_amount&quot;: &quot;920.71&quot;,
        &quot;purchase_id&quot;: 2,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 6,
            &quot;first_name&quot;: &quot;Demetris&quot;,
            &quot;last_name&quot;: &quot;Toy&quot;,
            &quot;cnic&quot;: &quot;46484-5397127-8&quot;,
            &quot;address&quot;: &quot;4944 Goodwin Flats Suite 490\nNorth Jefferey, TN 54686&quot;,
            &quot;city_id&quot;: 425,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;2006-08-21&quot;,
            &quot;ven_inv_no&quot;: &quot;INV682&quot;,
            &quot;ven_inv_date&quot;: &quot;1986-04-17&quot;,
            &quot;ven_inv_ref&quot;: &quot;aut&quot;,
            &quot;description&quot;: &quot;Voluptates quibusdam quo quis possimus fugit.&quot;,
            &quot;product_id&quot;: 1,
            &quot;discount_percent&quot;: &quot;1.00&quot;,
            &quot;discount_amt&quot;: &quot;224.59&quot;,
            &quot;inv_amount&quot;: &quot;4780.29&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;date&quot;: &quot;1980-03-03&quot;,
        &quot;vendor_id&quot;: 3,
        &quot;description&quot;: &quot;Laboriosam expedita provident aut excepturi reiciendis ut ipsum.&quot;,
        &quot;product_id&quot;: 13,
        &quot;return_inv_amount&quot;: &quot;1756.33&quot;,
        &quot;purchase_id&quot;: 3,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 3,
            &quot;first_name&quot;: &quot;Ally&quot;,
            &quot;last_name&quot;: &quot;McKenzie&quot;,
            &quot;cnic&quot;: &quot;09664-4521196-3&quot;,
            &quot;address&quot;: &quot;21606 Gibson Forks\nWest Felix, CA 46802&quot;,
            &quot;city_id&quot;: 151,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 3,
            &quot;date&quot;: &quot;2001-07-22&quot;,
            &quot;ven_inv_no&quot;: &quot;INV120&quot;,
            &quot;ven_inv_date&quot;: &quot;1980-12-19&quot;,
            &quot;ven_inv_ref&quot;: &quot;laboriosam&quot;,
            &quot;description&quot;: &quot;Ea alias magnam recusandae.&quot;,
            &quot;product_id&quot;: 11,
            &quot;discount_percent&quot;: &quot;6.00&quot;,
            &quot;discount_amt&quot;: &quot;296.20&quot;,
            &quot;inv_amount&quot;: &quot;4671.76&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;date&quot;: &quot;2017-01-14&quot;,
        &quot;vendor_id&quot;: 6,
        &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
        &quot;product_id&quot;: 6,
        &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
        &quot;purchase_id&quot;: 4,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 6,
            &quot;first_name&quot;: &quot;Demetris&quot;,
            &quot;last_name&quot;: &quot;Toy&quot;,
            &quot;cnic&quot;: &quot;46484-5397127-8&quot;,
            &quot;address&quot;: &quot;4944 Goodwin Flats Suite 490\nNorth Jefferey, TN 54686&quot;,
            &quot;city_id&quot;: 425,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC165&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003311?text=fashion+adipisci&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3429.42&quot;,
            &quot;opening_stock_quantity&quot;: 44,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1278406927279&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 4,
            &quot;date&quot;: &quot;2007-12-16&quot;,
            &quot;ven_inv_no&quot;: &quot;INV242&quot;,
            &quot;ven_inv_date&quot;: &quot;2011-10-20&quot;,
            &quot;ven_inv_ref&quot;: &quot;vitae&quot;,
            &quot;description&quot;: &quot;Veniam minima dolorem quo cupiditate in.&quot;,
            &quot;product_id&quot;: 4,
            &quot;discount_percent&quot;: &quot;15.00&quot;,
            &quot;discount_amt&quot;: &quot;347.82&quot;,
            &quot;inv_amount&quot;: &quot;3950.33&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;date&quot;: &quot;2017-04-13&quot;,
        &quot;vendor_id&quot;: 5,
        &quot;description&quot;: &quot;Voluptatem vitae temporibus non nostrum unde quis deserunt.&quot;,
        &quot;product_id&quot;: 17,
        &quot;return_inv_amount&quot;: &quot;592.36&quot;,
        &quot;purchase_id&quot;: 3,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 5,
            &quot;first_name&quot;: &quot;Sherwood&quot;,
            &quot;last_name&quot;: &quot;Koepp&quot;,
            &quot;cnic&quot;: &quot;51961-4944141-4&quot;,
            &quot;address&quot;: &quot;97263 Marielle Shore Apt. 046\nEast Nash, IN 43033&quot;,
            &quot;city_id&quot;: 206,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 17,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC562&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007788?text=fashion+et&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;4612.13&quot;,
            &quot;opening_stock_quantity&quot;: 48,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1220278102278&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 3,
            &quot;date&quot;: &quot;2001-07-22&quot;,
            &quot;ven_inv_no&quot;: &quot;INV120&quot;,
            &quot;ven_inv_date&quot;: &quot;1980-12-19&quot;,
            &quot;ven_inv_ref&quot;: &quot;laboriosam&quot;,
            &quot;description&quot;: &quot;Ea alias magnam recusandae.&quot;,
            &quot;product_id&quot;: 11,
            &quot;discount_percent&quot;: &quot;6.00&quot;,
            &quot;discount_amt&quot;: &quot;296.20&quot;,
            &quot;inv_amount&quot;: &quot;4671.76&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;date&quot;: &quot;1976-05-30&quot;,
        &quot;vendor_id&quot;: 10,
        &quot;description&quot;: &quot;Voluptas quia sequi provident tempora consequatur reiciendis itaque ipsum.&quot;,
        &quot;product_id&quot;: 16,
        &quot;return_inv_amount&quot;: &quot;952.52&quot;,
        &quot;purchase_id&quot;: 2,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 10,
            &quot;first_name&quot;: &quot;Jennifer&quot;,
            &quot;last_name&quot;: &quot;Halvorson&quot;,
            &quot;cnic&quot;: &quot;77128-3464707-8&quot;,
            &quot;address&quot;: &quot;6924 Schuppe Gateway\nCatherineberg, MO 68335-8200&quot;,
            &quot;city_id&quot;: 447,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC346&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1876.34&quot;,
            &quot;opening_stock_quantity&quot;: 26,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;7528746238967&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;2006-08-21&quot;,
            &quot;ven_inv_no&quot;: &quot;INV682&quot;,
            &quot;ven_inv_date&quot;: &quot;1986-04-17&quot;,
            &quot;ven_inv_ref&quot;: &quot;aut&quot;,
            &quot;description&quot;: &quot;Voluptates quibusdam quo quis possimus fugit.&quot;,
            &quot;product_id&quot;: 1,
            &quot;discount_percent&quot;: &quot;1.00&quot;,
            &quot;discount_amt&quot;: &quot;224.59&quot;,
            &quot;inv_amount&quot;: &quot;4780.29&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;date&quot;: &quot;2000-02-21&quot;,
        &quot;vendor_id&quot;: 2,
        &quot;description&quot;: &quot;Quos dolore consectetur sed voluptatum odio consequatur.&quot;,
        &quot;product_id&quot;: 10,
        &quot;return_inv_amount&quot;: &quot;200.46&quot;,
        &quot;purchase_id&quot;: 4,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 2,
            &quot;first_name&quot;: &quot;Theron&quot;,
            &quot;last_name&quot;: &quot;Monahan&quot;,
            &quot;cnic&quot;: &quot;84378-0855782-4&quot;,
            &quot;address&quot;: &quot;596 Abraham Via Apt. 036\nNorth Noemieburgh, NH 79773&quot;,
            &quot;city_id&quot;: 109,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC962&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc33?text=fashion+vitae&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;4880.22&quot;,
            &quot;opening_stock_quantity&quot;: 31,
            &quot;user_id&quot;: 1,
            &quot;barcode&quot;: &quot;3141196651045&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 4,
            &quot;date&quot;: &quot;2007-12-16&quot;,
            &quot;ven_inv_no&quot;: &quot;INV242&quot;,
            &quot;ven_inv_date&quot;: &quot;2011-10-20&quot;,
            &quot;ven_inv_ref&quot;: &quot;vitae&quot;,
            &quot;description&quot;: &quot;Veniam minima dolorem quo cupiditate in.&quot;,
            &quot;product_id&quot;: 4,
            &quot;discount_percent&quot;: &quot;15.00&quot;,
            &quot;discount_amt&quot;: &quot;347.82&quot;,
            &quot;inv_amount&quot;: &quot;3950.33&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;date&quot;: &quot;1994-09-21&quot;,
        &quot;vendor_id&quot;: 7,
        &quot;description&quot;: &quot;Et ipsa necessitatibus consequatur eius.&quot;,
        &quot;product_id&quot;: 7,
        &quot;return_inv_amount&quot;: &quot;616.77&quot;,
        &quot;purchase_id&quot;: 5,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;vendor&quot;: {
            &quot;id&quot;: 7,
            &quot;first_name&quot;: &quot;Jasper&quot;,
            &quot;last_name&quot;: &quot;O&#039;Reilly&quot;,
            &quot;cnic&quot;: &quot;76193-8514358-6&quot;,
            &quot;address&quot;: &quot;3118 Cartwright Green\nAnkundington, AL 28625-5322&quot;,
            &quot;city_id&quot;: 424,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC912&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee11?text=fashion+velit&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;3343.25&quot;,
            &quot;opening_stock_quantity&quot;: 10,
            &quot;user_id&quot;: 3,
            &quot;barcode&quot;: &quot;4341105343361&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;purchase&quot;: {
            &quot;id&quot;: 5,
            &quot;date&quot;: &quot;1982-11-30&quot;,
            &quot;ven_inv_no&quot;: &quot;INV720&quot;,
            &quot;ven_inv_date&quot;: &quot;2004-02-28&quot;,
            &quot;ven_inv_ref&quot;: &quot;quasi&quot;,
            &quot;description&quot;: &quot;Accusantium iste commodi qui ut.&quot;,
            &quot;product_id&quot;: 1,
            &quot;discount_percent&quot;: &quot;18.00&quot;,
            &quot;discount_amt&quot;: &quot;128.76&quot;,
            &quot;inv_amount&quot;: &quot;1036.09&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-purchase_returns" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-purchase_returns"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-purchase_returns"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-purchase_returns" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-purchase_returns">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-purchase_returns" data-method="GET"
      data-path="api/purchase_returns"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-purchase_returns', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-purchase_returns"
                    onclick="tryItOut('GETapi-purchase_returns');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-purchase_returns"
                    onclick="cancelTryOut('GETapi-purchase_returns');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-purchase_returns"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/purchase_returns</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-purchase_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-purchase_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-purchase_returns">POST api/purchase_returns</h2>

<p>
</p>



<span id="example-requests-POSTapi-purchase_returns">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/purchase_returns" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date\": \"2025-09-29T15:16:04\",
    \"vendor_id\": \"architecto\",
    \"description\": \"Eius et animi quos velit et.\",
    \"product_id\": \"architecto\",
    \"return_inv_amount\": 39,
    \"purchase_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/purchase_returns"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date": "2025-09-29T15:16:04",
    "vendor_id": "architecto",
    "description": "Eius et animi quos velit et.",
    "product_id": "architecto",
    "return_inv_amount": 39,
    "purchase_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-purchase_returns">
</span>
<span id="execution-results-POSTapi-purchase_returns" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-purchase_returns"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-purchase_returns"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-purchase_returns" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-purchase_returns">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-purchase_returns" data-method="POST"
      data-path="api/purchase_returns"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-purchase_returns', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-purchase_returns"
                    onclick="tryItOut('POSTapi-purchase_returns');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-purchase_returns"
                    onclick="cancelTryOut('POSTapi-purchase_returns');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-purchase_returns"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/purchase_returns</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-purchase_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-purchase_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTapi-purchase_returns"
               value="2025-09-29T15:16:04"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:04</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="vendor_id"                data-endpoint="POSTapi-purchase_returns"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the vendors table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-purchase_returns"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTapi-purchase_returns"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>return_inv_amount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="return_inv_amount"                data-endpoint="POSTapi-purchase_returns"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>purchase_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="purchase_id"                data-endpoint="POSTapi-purchase_returns"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the purchases table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-purchase_return_details">GET api/purchase_return_details</h2>

<p>
</p>



<span id="example-requests-GETapi-purchase_return_details">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/purchase_return_details" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/purchase_return_details"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-purchase_return_details">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;purchase_return_id&quot;: 6,
        &quot;product_id&quot;: 6,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;984.04&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 6,
            &quot;date&quot;: &quot;2017-01-14&quot;,
            &quot;vendor_id&quot;: 6,
            &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
            &quot;product_id&quot;: 6,
            &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC165&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003311?text=fashion+adipisci&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3429.42&quot;,
            &quot;opening_stock_quantity&quot;: 44,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1278406927279&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;purchase_return_id&quot;: 2,
        &quot;product_id&quot;: 20,
        &quot;qty&quot;: 6,
        &quot;pur_price&quot;: &quot;317.97&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;1988-04-19&quot;,
            &quot;vendor_id&quot;: 9,
            &quot;description&quot;: &quot;Qui perspiciatis quibusdam vel est reprehenderit iste nihil.&quot;,
            &quot;product_id&quot;: 7,
            &quot;return_inv_amount&quot;: &quot;1486.45&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 20,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC313&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003333?text=fashion+et&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;2022.44&quot;,
            &quot;opening_stock_quantity&quot;: 48,
            &quot;user_id&quot;: 8,
            &quot;barcode&quot;: &quot;5887350312725&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;purchase_return_id&quot;: 6,
        &quot;product_id&quot;: 15,
        &quot;qty&quot;: 8,
        &quot;pur_price&quot;: &quot;337.72&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 6,
            &quot;date&quot;: &quot;2017-01-14&quot;,
            &quot;vendor_id&quot;: 6,
            &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
            &quot;product_id&quot;: 6,
            &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC243&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+ducimus&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4515.67&quot;,
            &quot;opening_stock_quantity&quot;: 35,
            &quot;user_id&quot;: 10,
            &quot;barcode&quot;: &quot;1021009187805&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;purchase_return_id&quot;: 7,
        &quot;product_id&quot;: 15,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;1554.08&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 7,
            &quot;date&quot;: &quot;2017-04-13&quot;,
            &quot;vendor_id&quot;: 5,
            &quot;description&quot;: &quot;Voluptatem vitae temporibus non nostrum unde quis deserunt.&quot;,
            &quot;product_id&quot;: 17,
            &quot;return_inv_amount&quot;: &quot;592.36&quot;,
            &quot;purchase_id&quot;: 3,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC243&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+ducimus&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4515.67&quot;,
            &quot;opening_stock_quantity&quot;: 35,
            &quot;user_id&quot;: 10,
            &quot;barcode&quot;: &quot;1021009187805&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;purchase_return_id&quot;: 3,
        &quot;product_id&quot;: 5,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;1639.05&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 3,
            &quot;date&quot;: &quot;1986-02-05&quot;,
            &quot;vendor_id&quot;: 2,
            &quot;description&quot;: &quot;Fugit ab voluptatibus sed beatae delectus qui qui.&quot;,
            &quot;product_id&quot;: 12,
            &quot;return_inv_amount&quot;: &quot;1903.44&quot;,
            &quot;purchase_id&quot;: 3,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC198&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00eedd?text=fashion+enim&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;4170.72&quot;,
            &quot;opening_stock_quantity&quot;: 6,
            &quot;user_id&quot;: 6,
            &quot;barcode&quot;: &quot;1441739426133&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;purchase_return_id&quot;: 8,
        &quot;product_id&quot;: 6,
        &quot;qty&quot;: 8,
        &quot;pur_price&quot;: &quot;1102.29&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 8,
            &quot;date&quot;: &quot;1976-05-30&quot;,
            &quot;vendor_id&quot;: 10,
            &quot;description&quot;: &quot;Voluptas quia sequi provident tempora consequatur reiciendis itaque ipsum.&quot;,
            &quot;product_id&quot;: 16,
            &quot;return_inv_amount&quot;: &quot;952.52&quot;,
            &quot;purchase_id&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC165&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003311?text=fashion+adipisci&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3429.42&quot;,
            &quot;opening_stock_quantity&quot;: 44,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1278406927279&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;purchase_return_id&quot;: 2,
        &quot;product_id&quot;: 8,
        &quot;qty&quot;: 6,
        &quot;pur_price&quot;: &quot;514.51&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;1988-04-19&quot;,
            &quot;vendor_id&quot;: 9,
            &quot;description&quot;: &quot;Qui perspiciatis quibusdam vel est reprehenderit iste nihil.&quot;,
            &quot;product_id&quot;: 7,
            &quot;return_inv_amount&quot;: &quot;1486.45&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC902&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff55?text=fashion+maiores&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;3189.62&quot;,
            &quot;opening_stock_quantity&quot;: 15,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;0053431460509&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;purchase_return_id&quot;: 8,
        &quot;product_id&quot;: 19,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;1651.69&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 8,
            &quot;date&quot;: &quot;1976-05-30&quot;,
            &quot;vendor_id&quot;: 10,
            &quot;description&quot;: &quot;Voluptas quia sequi provident tempora consequatur reiciendis itaque ipsum.&quot;,
            &quot;product_id&quot;: 16,
            &quot;return_inv_amount&quot;: &quot;952.52&quot;,
            &quot;purchase_id&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 19,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC548&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007799?text=fashion+ut&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;4831.53&quot;,
            &quot;opening_stock_quantity&quot;: 11,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;5188983942168&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;purchase_return_id&quot;: 6,
        &quot;product_id&quot;: 13,
        &quot;qty&quot;: 8,
        &quot;pur_price&quot;: &quot;209.58&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 6,
            &quot;date&quot;: &quot;2017-01-14&quot;,
            &quot;vendor_id&quot;: 6,
            &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
            &quot;product_id&quot;: 6,
            &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;purchase_return_id&quot;: 1,
        &quot;product_id&quot;: 2,
        &quot;qty&quot;: 8,
        &quot;pur_price&quot;: &quot;928.10&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 1,
            &quot;date&quot;: &quot;1996-02-27&quot;,
            &quot;vendor_id&quot;: 10,
            &quot;description&quot;: &quot;Optio dolorum autem atque voluptate sunt ad.&quot;,
            &quot;product_id&quot;: 1,
            &quot;return_inv_amount&quot;: &quot;383.43&quot;,
            &quot;purchase_id&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC871&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001144?text=fashion+nemo&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1485.00&quot;,
            &quot;opening_stock_quantity&quot;: 38,
            &quot;user_id&quot;: 9,
            &quot;barcode&quot;: &quot;6138467305179&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;purchase_return_id&quot;: 2,
        &quot;product_id&quot;: 8,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;359.11&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;1988-04-19&quot;,
            &quot;vendor_id&quot;: 9,
            &quot;description&quot;: &quot;Qui perspiciatis quibusdam vel est reprehenderit iste nihil.&quot;,
            &quot;product_id&quot;: 7,
            &quot;return_inv_amount&quot;: &quot;1486.45&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC902&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff55?text=fashion+maiores&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;3189.62&quot;,
            &quot;opening_stock_quantity&quot;: 15,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;0053431460509&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;purchase_return_id&quot;: 8,
        &quot;product_id&quot;: 19,
        &quot;qty&quot;: 6,
        &quot;pur_price&quot;: &quot;1344.96&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 8,
            &quot;date&quot;: &quot;1976-05-30&quot;,
            &quot;vendor_id&quot;: 10,
            &quot;description&quot;: &quot;Voluptas quia sequi provident tempora consequatur reiciendis itaque ipsum.&quot;,
            &quot;product_id&quot;: 16,
            &quot;return_inv_amount&quot;: &quot;952.52&quot;,
            &quot;purchase_id&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 19,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC548&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007799?text=fashion+ut&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;4831.53&quot;,
            &quot;opening_stock_quantity&quot;: 11,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;5188983942168&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;purchase_return_id&quot;: 9,
        &quot;product_id&quot;: 5,
        &quot;qty&quot;: 8,
        &quot;pur_price&quot;: &quot;903.10&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 9,
            &quot;date&quot;: &quot;2000-02-21&quot;,
            &quot;vendor_id&quot;: 2,
            &quot;description&quot;: &quot;Quos dolore consectetur sed voluptatum odio consequatur.&quot;,
            &quot;product_id&quot;: 10,
            &quot;return_inv_amount&quot;: &quot;200.46&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC198&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00eedd?text=fashion+enim&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;4170.72&quot;,
            &quot;opening_stock_quantity&quot;: 6,
            &quot;user_id&quot;: 6,
            &quot;barcode&quot;: &quot;1441739426133&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;purchase_return_id&quot;: 9,
        &quot;product_id&quot;: 18,
        &quot;qty&quot;: 2,
        &quot;pur_price&quot;: &quot;319.38&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 9,
            &quot;date&quot;: &quot;2000-02-21&quot;,
            &quot;vendor_id&quot;: 2,
            &quot;description&quot;: &quot;Quos dolore consectetur sed voluptatum odio consequatur.&quot;,
            &quot;product_id&quot;: 10,
            &quot;return_inv_amount&quot;: &quot;200.46&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 18,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC918&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+atque&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;3552.95&quot;,
            &quot;opening_stock_quantity&quot;: 17,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5373886232533&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;purchase_return_id&quot;: 6,
        &quot;product_id&quot;: 16,
        &quot;qty&quot;: 1,
        &quot;pur_price&quot;: &quot;1118.44&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 6,
            &quot;date&quot;: &quot;2017-01-14&quot;,
            &quot;vendor_id&quot;: 6,
            &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
            &quot;product_id&quot;: 6,
            &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC346&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1876.34&quot;,
            &quot;opening_stock_quantity&quot;: 26,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;7528746238967&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;purchase_return_id&quot;: 8,
        &quot;product_id&quot;: 13,
        &quot;qty&quot;: 6,
        &quot;pur_price&quot;: &quot;608.31&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 8,
            &quot;date&quot;: &quot;1976-05-30&quot;,
            &quot;vendor_id&quot;: 10,
            &quot;description&quot;: &quot;Voluptas quia sequi provident tempora consequatur reiciendis itaque ipsum.&quot;,
            &quot;product_id&quot;: 16,
            &quot;return_inv_amount&quot;: &quot;952.52&quot;,
            &quot;purchase_id&quot;: 2,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;purchase_return_id&quot;: 7,
        &quot;product_id&quot;: 3,
        &quot;qty&quot;: 1,
        &quot;pur_price&quot;: &quot;1238.57&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 7,
            &quot;date&quot;: &quot;2017-04-13&quot;,
            &quot;vendor_id&quot;: 5,
            &quot;description&quot;: &quot;Voluptatem vitae temporibus non nostrum unde quis deserunt.&quot;,
            &quot;product_id&quot;: 17,
            &quot;return_inv_amount&quot;: &quot;592.36&quot;,
            &quot;purchase_id&quot;: 3,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC980&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0066cc?text=fashion+quas&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;2959.88&quot;,
            &quot;opening_stock_quantity&quot;: 44,
            &quot;user_id&quot;: 3,
            &quot;barcode&quot;: &quot;9707645296249&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;purchase_return_id&quot;: 6,
        &quot;product_id&quot;: 12,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;1964.74&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 6,
            &quot;date&quot;: &quot;2017-01-14&quot;,
            &quot;vendor_id&quot;: 6,
            &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
            &quot;product_id&quot;: 6,
            &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 12,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC719&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc99?text=fashion+eius&quot;,
            &quot;sub_category_id&quot;: 8,
            &quot;sale_price&quot;: &quot;3479.65&quot;,
            &quot;opening_stock_quantity&quot;: 45,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5095142502715&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;purchase_return_id&quot;: 2,
        &quot;product_id&quot;: 11,
        &quot;qty&quot;: 6,
        &quot;pur_price&quot;: &quot;1825.07&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 2,
            &quot;date&quot;: &quot;1988-04-19&quot;,
            &quot;vendor_id&quot;: 9,
            &quot;description&quot;: &quot;Qui perspiciatis quibusdam vel est reprehenderit iste nihil.&quot;,
            &quot;product_id&quot;: 7,
            &quot;return_inv_amount&quot;: &quot;1486.45&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 11,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC663&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd11?text=fashion+architecto&quot;,
            &quot;sub_category_id&quot;: 3,
            &quot;sale_price&quot;: &quot;4190.76&quot;,
            &quot;opening_stock_quantity&quot;: 5,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;4569645648894&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;purchase_return_id&quot;: 6,
        &quot;product_id&quot;: 2,
        &quot;qty&quot;: 3,
        &quot;pur_price&quot;: &quot;938.28&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;purchase_return&quot;: {
            &quot;id&quot;: 6,
            &quot;date&quot;: &quot;2017-01-14&quot;,
            &quot;vendor_id&quot;: 6,
            &quot;description&quot;: &quot;Ullam quidem aut corporis esse vel qui ut.&quot;,
            &quot;product_id&quot;: 6,
            &quot;return_inv_amount&quot;: &quot;1271.59&quot;,
            &quot;purchase_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC871&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001144?text=fashion+nemo&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1485.00&quot;,
            &quot;opening_stock_quantity&quot;: 38,
            &quot;user_id&quot;: 9,
            &quot;barcode&quot;: &quot;6138467305179&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-purchase_return_details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-purchase_return_details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-purchase_return_details"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-purchase_return_details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-purchase_return_details">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-purchase_return_details" data-method="GET"
      data-path="api/purchase_return_details"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-purchase_return_details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-purchase_return_details"
                    onclick="tryItOut('GETapi-purchase_return_details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-purchase_return_details"
                    onclick="cancelTryOut('GETapi-purchase_return_details');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-purchase_return_details"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/purchase_return_details</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-purchase_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-purchase_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-purchase_return_details">POST api/purchase_return_details</h2>

<p>
</p>



<span id="example-requests-POSTapi-purchase_return_details">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/purchase_return_details" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"purchase_return_id\": \"architecto\",
    \"product_id\": \"architecto\",
    \"qty\": 22,
    \"pur_price\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/purchase_return_details"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "purchase_return_id": "architecto",
    "product_id": "architecto",
    "qty": 22,
    "pur_price": 84
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-purchase_return_details">
</span>
<span id="execution-results-POSTapi-purchase_return_details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-purchase_return_details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-purchase_return_details"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-purchase_return_details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-purchase_return_details">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-purchase_return_details" data-method="POST"
      data-path="api/purchase_return_details"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-purchase_return_details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-purchase_return_details"
                    onclick="tryItOut('POSTapi-purchase_return_details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-purchase_return_details"
                    onclick="cancelTryOut('POSTapi-purchase_return_details');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-purchase_return_details"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/purchase_return_details</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-purchase_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-purchase_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>purchase_return_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="purchase_return_id"                data-endpoint="POSTapi-purchase_return_details"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the purchase_returns table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTapi-purchase_return_details"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>qty</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="qty"                data-endpoint="POSTapi-purchase_return_details"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pur_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="pur_price"                data-endpoint="POSTapi-purchase_return_details"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-pos">GET api/pos</h2>

<p>
</p>



<span id="example-requests-GETapi-pos">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;customer_id&quot;: 11,
        &quot;inv_date&quot;: &quot;1991-08-03&quot;,
        &quot;inv_amout&quot;: &quot;4943.41&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;247.17&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 11,
            &quot;cnic&quot;: &quot;86703-7103340-7&quot;,
            &quot;name&quot;: &quot;Audreanne Dicki&quot;,
            &quot;email&quot;: &quot;vsipes@example.org&quot;,
            &quot;address&quot;: &quot;1511 Enrique Stream Suite 392\nSouth Jerelland, NJ 79408-7063&quot;,
            &quot;city_id&quot;: 33,
            &quot;cell_no1&quot;: &quot;03903932950&quot;,
            &quot;cell_no2&quot;: &quot;03230608787&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;customer_id&quot;: 7,
        &quot;inv_date&quot;: &quot;1985-11-22&quot;,
        &quot;inv_amout&quot;: &quot;3303.24&quot;,
        &quot;tax&quot;: &quot;100.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;165.16&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 7,
            &quot;cnic&quot;: &quot;28254-0274548-5&quot;,
            &quot;name&quot;: &quot;Kieran Hamill III&quot;,
            &quot;email&quot;: &quot;reyes42@example.org&quot;,
            &quot;address&quot;: &quot;39170 Floy Squares Apt. 016\nLake Nicolette, AK 09302-9984&quot;,
            &quot;city_id&quot;: 14,
            &quot;cell_no1&quot;: &quot;03041199971&quot;,
            &quot;cell_no2&quot;: &quot;03499062231&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;customer_id&quot;: 16,
        &quot;inv_date&quot;: &quot;1992-04-25&quot;,
        &quot;inv_amout&quot;: &quot;4335.12&quot;,
        &quot;tax&quot;: &quot;0.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;216.76&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 16,
            &quot;cnic&quot;: &quot;15331-1478721-6&quot;,
            &quot;name&quot;: &quot;Jabari McLaughlin&quot;,
            &quot;email&quot;: &quot;bettye.johnson@example.org&quot;,
            &quot;address&quot;: &quot;45027 Schneider Road\nLake Larue, NC 59402&quot;,
            &quot;city_id&quot;: 34,
            &quot;cell_no1&quot;: &quot;03873249578&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;customer_id&quot;: 5,
        &quot;inv_date&quot;: &quot;1980-06-09&quot;,
        &quot;inv_amout&quot;: &quot;541.40&quot;,
        &quot;tax&quot;: &quot;100.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;27.07&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 5,
            &quot;cnic&quot;: &quot;96220-0371880-0&quot;,
            &quot;name&quot;: &quot;Mrs. Belle Kemmer V&quot;,
            &quot;email&quot;: &quot;morar.valerie@example.org&quot;,
            &quot;address&quot;: &quot;25354 Frances Valleys Apt. 765\nSouth Emilie, AR 95895&quot;,
            &quot;city_id&quot;: 23,
            &quot;cell_no1&quot;: &quot;03320903760&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;customer_id&quot;: 16,
        &quot;inv_date&quot;: &quot;1988-03-04&quot;,
        &quot;inv_amout&quot;: &quot;2508.63&quot;,
        &quot;tax&quot;: &quot;0.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;125.43&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 16,
            &quot;cnic&quot;: &quot;15331-1478721-6&quot;,
            &quot;name&quot;: &quot;Jabari McLaughlin&quot;,
            &quot;email&quot;: &quot;bettye.johnson@example.org&quot;,
            &quot;address&quot;: &quot;45027 Schneider Road\nLake Larue, NC 59402&quot;,
            &quot;city_id&quot;: 34,
            &quot;cell_no1&quot;: &quot;03873249578&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;customer_id&quot;: 2,
        &quot;inv_date&quot;: &quot;2021-06-15&quot;,
        &quot;inv_amout&quot;: &quot;2786.45&quot;,
        &quot;tax&quot;: &quot;0.00&quot;,
        &quot;discPer&quot;: &quot;10.00&quot;,
        &quot;discount&quot;: &quot;278.65&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;91139-8736077-9&quot;,
            &quot;name&quot;: &quot;Cristian Mills&quot;,
            &quot;email&quot;: &quot;hoyt62@example.org&quot;,
            &quot;address&quot;: &quot;1934 Randal Forks Apt. 621\nWellingtonmouth, CT 27443&quot;,
            &quot;city_id&quot;: 44,
            &quot;cell_no1&quot;: &quot;03906459816&quot;,
            &quot;cell_no2&quot;: &quot;03963968532&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;customer_id&quot;: 1,
        &quot;inv_date&quot;: &quot;2015-04-21&quot;,
        &quot;inv_amout&quot;: &quot;1654.39&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;82.72&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;customer_id&quot;: 10,
        &quot;inv_date&quot;: &quot;2012-08-08&quot;,
        &quot;inv_amout&quot;: &quot;4492.61&quot;,
        &quot;tax&quot;: &quot;100.00&quot;,
        &quot;discPer&quot;: &quot;10.00&quot;,
        &quot;discount&quot;: &quot;449.26&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 10,
            &quot;cnic&quot;: &quot;65315-1316624-7&quot;,
            &quot;name&quot;: &quot;Richie Mann&quot;,
            &quot;email&quot;: &quot;sasha00@example.net&quot;,
            &quot;address&quot;: &quot;56584 Howe Road\nLake Davonteville, WA 81508-4119&quot;,
            &quot;city_id&quot;: 22,
            &quot;cell_no1&quot;: &quot;03250405061&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;customer_id&quot;: 11,
        &quot;inv_date&quot;: &quot;1978-04-18&quot;,
        &quot;inv_amout&quot;: &quot;921.54&quot;,
        &quot;tax&quot;: &quot;0.00&quot;,
        &quot;discPer&quot;: &quot;0.00&quot;,
        &quot;discount&quot;: &quot;0.00&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 11,
            &quot;cnic&quot;: &quot;86703-7103340-7&quot;,
            &quot;name&quot;: &quot;Audreanne Dicki&quot;,
            &quot;email&quot;: &quot;vsipes@example.org&quot;,
            &quot;address&quot;: &quot;1511 Enrique Stream Suite 392\nSouth Jerelland, NJ 79408-7063&quot;,
            &quot;city_id&quot;: 33,
            &quot;cell_no1&quot;: &quot;03903932950&quot;,
            &quot;cell_no2&quot;: &quot;03230608787&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;customer_id&quot;: 15,
        &quot;inv_date&quot;: &quot;2015-05-04&quot;,
        &quot;inv_amout&quot;: &quot;725.86&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;0.00&quot;,
        &quot;discount&quot;: &quot;0.00&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 15,
            &quot;cnic&quot;: &quot;55907-5454996-9&quot;,
            &quot;name&quot;: &quot;Arvilla Greenholt III&quot;,
            &quot;email&quot;: &quot;lbarrows@example.com&quot;,
            &quot;address&quot;: &quot;1788 Lavinia Drive Apt. 130\nSchusterfort, NH 88432-8792&quot;,
            &quot;city_id&quot;: 30,
            &quot;cell_no1&quot;: &quot;03054197739&quot;,
            &quot;cell_no2&quot;: &quot;03719509573&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;customer_id&quot;: 2,
        &quot;inv_date&quot;: &quot;1991-11-22&quot;,
        &quot;inv_amout&quot;: &quot;3704.34&quot;,
        &quot;tax&quot;: &quot;100.00&quot;,
        &quot;discPer&quot;: &quot;0.00&quot;,
        &quot;discount&quot;: &quot;0.00&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;91139-8736077-9&quot;,
            &quot;name&quot;: &quot;Cristian Mills&quot;,
            &quot;email&quot;: &quot;hoyt62@example.org&quot;,
            &quot;address&quot;: &quot;1934 Randal Forks Apt. 621\nWellingtonmouth, CT 27443&quot;,
            &quot;city_id&quot;: 44,
            &quot;cell_no1&quot;: &quot;03906459816&quot;,
            &quot;cell_no2&quot;: &quot;03963968532&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;customer_id&quot;: 19,
        &quot;inv_date&quot;: &quot;2004-08-27&quot;,
        &quot;inv_amout&quot;: &quot;2899.35&quot;,
        &quot;tax&quot;: &quot;0.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;144.97&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 19,
            &quot;cnic&quot;: &quot;50156-8936437-8&quot;,
            &quot;name&quot;: &quot;Price Langosh&quot;,
            &quot;email&quot;: &quot;rzemlak@example.org&quot;,
            &quot;address&quot;: &quot;79383 Gottlieb Well\nNew Maxie, UT 26094-9620&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03047064429&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;customer_id&quot;: 17,
        &quot;inv_date&quot;: &quot;2020-01-12&quot;,
        &quot;inv_amout&quot;: &quot;1873.58&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;10.00&quot;,
        &quot;discount&quot;: &quot;187.36&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 17,
            &quot;cnic&quot;: &quot;13074-1900895-9&quot;,
            &quot;name&quot;: &quot;Prof. Joanny Christiansen&quot;,
            &quot;email&quot;: &quot;rhermann@example.net&quot;,
            &quot;address&quot;: &quot;8102 Judy Mall Suite 108\nMrazfurt, ME 04610-3291&quot;,
            &quot;city_id&quot;: 13,
            &quot;cell_no1&quot;: &quot;03834471510&quot;,
            &quot;cell_no2&quot;: &quot;03513799186&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;customer_id&quot;: 12,
        &quot;inv_date&quot;: &quot;2018-04-12&quot;,
        &quot;inv_amout&quot;: &quot;1713.62&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;0.00&quot;,
        &quot;discount&quot;: &quot;0.00&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 12,
            &quot;cnic&quot;: &quot;19810-4834938-3&quot;,
            &quot;name&quot;: &quot;Michale Russel&quot;,
            &quot;email&quot;: &quot;pamela.flatley@example.net&quot;,
            &quot;address&quot;: &quot;94808 Cora Burg\nNew Eusebioland, KS 71227-8972&quot;,
            &quot;city_id&quot;: 43,
            &quot;cell_no1&quot;: &quot;03576260823&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;customer_id&quot;: 1,
        &quot;inv_date&quot;: &quot;1987-08-04&quot;,
        &quot;inv_amout&quot;: &quot;4601.16&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;230.06&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;customer_id&quot;: 7,
        &quot;inv_date&quot;: &quot;2015-09-11&quot;,
        &quot;inv_amout&quot;: &quot;3240.68&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;0.00&quot;,
        &quot;discount&quot;: &quot;0.00&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 7,
            &quot;cnic&quot;: &quot;28254-0274548-5&quot;,
            &quot;name&quot;: &quot;Kieran Hamill III&quot;,
            &quot;email&quot;: &quot;reyes42@example.org&quot;,
            &quot;address&quot;: &quot;39170 Floy Squares Apt. 016\nLake Nicolette, AK 09302-9984&quot;,
            &quot;city_id&quot;: 14,
            &quot;cell_no1&quot;: &quot;03041199971&quot;,
            &quot;cell_no2&quot;: &quot;03499062231&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;customer_id&quot;: 3,
        &quot;inv_date&quot;: &quot;1980-12-27&quot;,
        &quot;inv_amout&quot;: &quot;2888.61&quot;,
        &quot;tax&quot;: &quot;100.00&quot;,
        &quot;discPer&quot;: &quot;10.00&quot;,
        &quot;discount&quot;: &quot;288.86&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 3,
            &quot;cnic&quot;: &quot;87905-7698002-1&quot;,
            &quot;name&quot;: &quot;Dr. Jovanny Robel&quot;,
            &quot;email&quot;: &quot;aerdman@example.org&quot;,
            &quot;address&quot;: &quot;70826 Kuhlman Ramp\nPort Katlyn, TX 66811&quot;,
            &quot;city_id&quot;: 46,
            &quot;cell_no1&quot;: &quot;03984147957&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;customer_id&quot;: 4,
        &quot;inv_date&quot;: &quot;1997-01-29&quot;,
        &quot;inv_amout&quot;: &quot;3840.61&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;0.00&quot;,
        &quot;discount&quot;: &quot;0.00&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;00619-3564902-8&quot;,
            &quot;name&quot;: &quot;Creola Haag&quot;,
            &quot;email&quot;: &quot;noelia.little@example.com&quot;,
            &quot;address&quot;: &quot;32077 Alicia Estate Suite 493\nReillychester, VT 57755-0706&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03324901271&quot;,
            &quot;cell_no2&quot;: &quot;03237685041&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;customer_id&quot;: 6,
        &quot;inv_date&quot;: &quot;1994-06-03&quot;,
        &quot;inv_amout&quot;: &quot;2383.87&quot;,
        &quot;tax&quot;: &quot;50.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;119.19&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 6,
            &quot;cnic&quot;: &quot;78669-4553364-3&quot;,
            &quot;name&quot;: &quot;Brooklyn O&#039;Connell&quot;,
            &quot;email&quot;: &quot;margret91@example.net&quot;,
            &quot;address&quot;: &quot;6577 Libby Keys\nJaydonton, AK 63471&quot;,
            &quot;city_id&quot;: 47,
            &quot;cell_no1&quot;: &quot;03426668525&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;customer_id&quot;: 2,
        &quot;inv_date&quot;: &quot;2001-09-21&quot;,
        &quot;inv_amout&quot;: &quot;2363.38&quot;,
        &quot;tax&quot;: &quot;100.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;118.17&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;91139-8736077-9&quot;,
            &quot;name&quot;: &quot;Cristian Mills&quot;,
            &quot;email&quot;: &quot;hoyt62@example.org&quot;,
            &quot;address&quot;: &quot;1934 Randal Forks Apt. 621\nWellingtonmouth, CT 27443&quot;,
            &quot;city_id&quot;: 44,
            &quot;cell_no1&quot;: &quot;03906459816&quot;,
            &quot;cell_no2&quot;: &quot;03963968532&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos" data-method="GET"
      data-path="api/pos"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos"
                    onclick="tryItOut('GETapi-pos');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos"
                    onclick="cancelTryOut('GETapi-pos');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-pos">POST api/pos</h2>

<p>
</p>



<span id="example-requests-POSTapi-pos">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/pos" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"customer_id\": \"architecto\",
    \"inv_date\": \"2025-09-29T15:16:04\",
    \"inv_amout\": 39,
    \"tax\": 84,
    \"discPer\": 12,
    \"discount\": 77
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "customer_id": "architecto",
    "inv_date": "2025-09-29T15:16:04",
    "inv_amout": 39,
    "tax": 84,
    "discPer": 12,
    "discount": 77
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-pos">
</span>
<span id="execution-results-POSTapi-pos" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-pos"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-pos"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-pos" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-pos">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-pos" data-method="POST"
      data-path="api/pos"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-pos', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-pos"
                    onclick="tryItOut('POSTapi-pos');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-pos"
                    onclick="cancelTryOut('POSTapi-pos');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-pos"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/pos</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-pos"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-pos"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_id"                data-endpoint="POSTapi-pos"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the customers table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>inv_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="inv_date"                data-endpoint="POSTapi-pos"
               value="2025-09-29T15:16:04"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:04</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>inv_amout</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inv_amout"                data-endpoint="POSTapi-pos"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tax</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tax"                data-endpoint="POSTapi-pos"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>discPer</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="discPer"                data-endpoint="POSTapi-pos"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>discount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="discount"                data-endpoint="POSTapi-pos"
               value="77"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>77</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-pos--id-">GET api/pos/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-pos--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Pos] architecto&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos--id-" data-method="GET"
      data-path="api/pos/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos--id-"
                    onclick="tryItOut('GETapi-pos--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos--id-"
                    onclick="cancelTryOut('GETapi-pos--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-pos--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the po. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-pos--id-">PUT api/pos/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-pos--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/pos/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"customer_id\": \"architecto\",
    \"inv_date\": \"2025-09-29T15:16:04\",
    \"inv_amout\": 39,
    \"tax\": 84,
    \"discPer\": 12,
    \"discount\": 77
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "customer_id": "architecto",
    "inv_date": "2025-09-29T15:16:04",
    "inv_amout": 39,
    "tax": 84,
    "discPer": 12,
    "discount": 77
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-pos--id-">
</span>
<span id="execution-results-PUTapi-pos--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-pos--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-pos--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-pos--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-pos--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-pos--id-" data-method="PUT"
      data-path="api/pos/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-pos--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-pos--id-"
                    onclick="tryItOut('PUTapi-pos--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-pos--id-"
                    onclick="cancelTryOut('PUTapi-pos--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-pos--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/pos/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-pos--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-pos--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-pos--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the po. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_id"                data-endpoint="PUTapi-pos--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the customers table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>inv_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="inv_date"                data-endpoint="PUTapi-pos--id-"
               value="2025-09-29T15:16:04"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:04</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>inv_amout</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="inv_amout"                data-endpoint="PUTapi-pos--id-"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tax</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tax"                data-endpoint="PUTapi-pos--id-"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>discPer</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="discPer"                data-endpoint="PUTapi-pos--id-"
               value="12"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>discount</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="discount"                data-endpoint="PUTapi-pos--id-"
               value="77"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>77</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-pos--id-">DELETE api/pos/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-pos--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/pos/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-pos--id-">
</span>
<span id="execution-results-DELETEapi-pos--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-pos--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-pos--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-pos--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-pos--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-pos--id-" data-method="DELETE"
      data-path="api/pos/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-pos--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-pos--id-"
                    onclick="tryItOut('DELETEapi-pos--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-pos--id-"
                    onclick="cancelTryOut('DELETEapi-pos--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-pos--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/pos/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-pos--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-pos--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-pos--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the po. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-pos_details">GET api/pos_details</h2>

<p>
</p>



<span id="example-requests-GETapi-pos_details">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos_details" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_details"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos_details">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;pos_id&quot;: 12,
        &quot;product_id&quot;: 9,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;2363.37&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 12,
            &quot;customer_id&quot;: 19,
            &quot;inv_date&quot;: &quot;2004-08-27&quot;,
            &quot;inv_amout&quot;: &quot;2899.35&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;144.97&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC855&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/000033?text=fashion+inventore&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;1109.24&quot;,
            &quot;opening_stock_quantity&quot;: 43,
            &quot;user_id&quot;: 2,
            &quot;barcode&quot;: &quot;6329370688866&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;pos_id&quot;: 15,
        &quot;product_id&quot;: 12,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;2286.27&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 15,
            &quot;customer_id&quot;: 1,
            &quot;inv_date&quot;: &quot;1987-08-04&quot;,
            &quot;inv_amout&quot;: &quot;4601.16&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;230.06&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 12,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC719&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc99?text=fashion+eius&quot;,
            &quot;sub_category_id&quot;: 8,
            &quot;sale_price&quot;: &quot;3479.65&quot;,
            &quot;opening_stock_quantity&quot;: 45,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5095142502715&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;pos_id&quot;: 20,
        &quot;product_id&quot;: 8,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;1386.83&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 20,
            &quot;customer_id&quot;: 2,
            &quot;inv_date&quot;: &quot;2001-09-21&quot;,
            &quot;inv_amout&quot;: &quot;2363.38&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;118.17&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC902&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff55?text=fashion+maiores&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;3189.62&quot;,
            &quot;opening_stock_quantity&quot;: 15,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;0053431460509&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;pos_id&quot;: 3,
        &quot;product_id&quot;: 18,
        &quot;qty&quot;: 3,
        &quot;sale_price&quot;: &quot;2374.16&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 3,
            &quot;customer_id&quot;: 16,
            &quot;inv_date&quot;: &quot;1992-04-25&quot;,
            &quot;inv_amout&quot;: &quot;4335.12&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;216.76&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 18,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC918&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+atque&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;3552.95&quot;,
            &quot;opening_stock_quantity&quot;: 17,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5373886232533&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;pos_id&quot;: 13,
        &quot;product_id&quot;: 18,
        &quot;qty&quot;: 3,
        &quot;sale_price&quot;: &quot;4894.49&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 13,
            &quot;customer_id&quot;: 17,
            &quot;inv_date&quot;: &quot;2020-01-12&quot;,
            &quot;inv_amout&quot;: &quot;1873.58&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;10.00&quot;,
            &quot;discount&quot;: &quot;187.36&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 18,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC918&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+atque&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;3552.95&quot;,
            &quot;opening_stock_quantity&quot;: 17,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5373886232533&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;pos_id&quot;: 13,
        &quot;product_id&quot;: 9,
        &quot;qty&quot;: 1,
        &quot;sale_price&quot;: &quot;4998.18&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 13,
            &quot;customer_id&quot;: 17,
            &quot;inv_date&quot;: &quot;2020-01-12&quot;,
            &quot;inv_amout&quot;: &quot;1873.58&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;10.00&quot;,
            &quot;discount&quot;: &quot;187.36&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC855&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/000033?text=fashion+inventore&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;1109.24&quot;,
            &quot;opening_stock_quantity&quot;: 43,
            &quot;user_id&quot;: 2,
            &quot;barcode&quot;: &quot;6329370688866&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;pos_id&quot;: 12,
        &quot;product_id&quot;: 4,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;261.36&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 12,
            &quot;customer_id&quot;: 19,
            &quot;inv_date&quot;: &quot;2004-08-27&quot;,
            &quot;inv_amout&quot;: &quot;2899.35&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;144.97&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC895&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003344?text=fashion+qui&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4713.79&quot;,
            &quot;opening_stock_quantity&quot;: 10,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;4881995636605&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;pos_id&quot;: 9,
        &quot;product_id&quot;: 15,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;2453.46&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 9,
            &quot;customer_id&quot;: 11,
            &quot;inv_date&quot;: &quot;1978-04-18&quot;,
            &quot;inv_amout&quot;: &quot;921.54&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC243&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+ducimus&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4515.67&quot;,
            &quot;opening_stock_quantity&quot;: 35,
            &quot;user_id&quot;: 10,
            &quot;barcode&quot;: &quot;1021009187805&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;pos_id&quot;: 4,
        &quot;product_id&quot;: 16,
        &quot;qty&quot;: 1,
        &quot;sale_price&quot;: &quot;366.05&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 4,
            &quot;customer_id&quot;: 5,
            &quot;inv_date&quot;: &quot;1980-06-09&quot;,
            &quot;inv_amout&quot;: &quot;541.40&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;27.07&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC346&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1876.34&quot;,
            &quot;opening_stock_quantity&quot;: 26,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;7528746238967&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;pos_id&quot;: 1,
        &quot;product_id&quot;: 14,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;3705.80&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 1,
            &quot;customer_id&quot;: 11,
            &quot;inv_date&quot;: &quot;1991-08-03&quot;,
            &quot;inv_amout&quot;: &quot;4943.41&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;247.17&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 14,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC888&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001111?text=fashion+sit&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;1464.61&quot;,
            &quot;opening_stock_quantity&quot;: 33,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;5468834464392&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;pos_id&quot;: 14,
        &quot;product_id&quot;: 11,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;1202.65&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 14,
            &quot;customer_id&quot;: 12,
            &quot;inv_date&quot;: &quot;2018-04-12&quot;,
            &quot;inv_amout&quot;: &quot;1713.62&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 11,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC663&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd11?text=fashion+architecto&quot;,
            &quot;sub_category_id&quot;: 3,
            &quot;sale_price&quot;: &quot;4190.76&quot;,
            &quot;opening_stock_quantity&quot;: 5,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;4569645648894&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;pos_id&quot;: 2,
        &quot;product_id&quot;: 4,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;2369.04&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 2,
            &quot;customer_id&quot;: 7,
            &quot;inv_date&quot;: &quot;1985-11-22&quot;,
            &quot;inv_amout&quot;: &quot;3303.24&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;165.16&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC895&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003344?text=fashion+qui&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4713.79&quot;,
            &quot;opening_stock_quantity&quot;: 10,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;4881995636605&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;pos_id&quot;: 2,
        &quot;product_id&quot;: 17,
        &quot;qty&quot;: 3,
        &quot;sale_price&quot;: &quot;4362.34&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 2,
            &quot;customer_id&quot;: 7,
            &quot;inv_date&quot;: &quot;1985-11-22&quot;,
            &quot;inv_amout&quot;: &quot;3303.24&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;165.16&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 17,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC562&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007788?text=fashion+et&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;4612.13&quot;,
            &quot;opening_stock_quantity&quot;: 48,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1220278102278&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;pos_id&quot;: 5,
        &quot;product_id&quot;: 8,
        &quot;qty&quot;: 4,
        &quot;sale_price&quot;: &quot;1972.13&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 5,
            &quot;customer_id&quot;: 16,
            &quot;inv_date&quot;: &quot;1988-03-04&quot;,
            &quot;inv_amout&quot;: &quot;2508.63&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;125.43&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC902&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff55?text=fashion+maiores&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;3189.62&quot;,
            &quot;opening_stock_quantity&quot;: 15,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;0053431460509&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;pos_id&quot;: 18,
        &quot;product_id&quot;: 15,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;2482.43&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 18,
            &quot;customer_id&quot;: 4,
            &quot;inv_date&quot;: &quot;1997-01-29&quot;,
            &quot;inv_amout&quot;: &quot;3840.61&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC243&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddaa?text=fashion+ducimus&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4515.67&quot;,
            &quot;opening_stock_quantity&quot;: 35,
            &quot;user_id&quot;: 10,
            &quot;barcode&quot;: &quot;1021009187805&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;pos_id&quot;: 7,
        &quot;product_id&quot;: 13,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;3880.66&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 7,
            &quot;customer_id&quot;: 1,
            &quot;inv_date&quot;: &quot;2015-04-21&quot;,
            &quot;inv_amout&quot;: &quot;1654.39&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;82.72&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;pos_id&quot;: 13,
        &quot;product_id&quot;: 10,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;4986.34&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 13,
            &quot;customer_id&quot;: 17,
            &quot;inv_date&quot;: &quot;2020-01-12&quot;,
            &quot;inv_amout&quot;: &quot;1873.58&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;10.00&quot;,
            &quot;discount&quot;: &quot;187.36&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC962&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00cc33?text=fashion+vitae&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;4880.22&quot;,
            &quot;opening_stock_quantity&quot;: 31,
            &quot;user_id&quot;: 1,
            &quot;barcode&quot;: &quot;3141196651045&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;pos_id&quot;: 14,
        &quot;product_id&quot;: 16,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;132.45&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 14,
            &quot;customer_id&quot;: 12,
            &quot;inv_date&quot;: &quot;2018-04-12&quot;,
            &quot;inv_amout&quot;: &quot;1713.62&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC346&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1876.34&quot;,
            &quot;opening_stock_quantity&quot;: 26,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;7528746238967&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;pos_id&quot;: 3,
        &quot;product_id&quot;: 2,
        &quot;qty&quot;: 1,
        &quot;sale_price&quot;: &quot;2830.76&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 3,
            &quot;customer_id&quot;: 16,
            &quot;inv_date&quot;: &quot;1992-04-25&quot;,
            &quot;inv_amout&quot;: &quot;4335.12&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;216.76&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC871&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001144?text=fashion+nemo&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1485.00&quot;,
            &quot;opening_stock_quantity&quot;: 38,
            &quot;user_id&quot;: 9,
            &quot;barcode&quot;: &quot;6138467305179&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;pos_id&quot;: 11,
        &quot;product_id&quot;: 16,
        &quot;qty&quot;: 3,
        &quot;sale_price&quot;: &quot;161.88&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 11,
            &quot;customer_id&quot;: 2,
            &quot;inv_date&quot;: &quot;1991-11-22&quot;,
            &quot;inv_amout&quot;: &quot;3704.34&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC346&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1876.34&quot;,
            &quot;opening_stock_quantity&quot;: 26,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;7528746238967&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;pos_id&quot;: 15,
        &quot;product_id&quot;: 2,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;295.03&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 15,
            &quot;customer_id&quot;: 1,
            &quot;inv_date&quot;: &quot;1987-08-04&quot;,
            &quot;inv_amout&quot;: &quot;4601.16&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;230.06&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC871&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/001144?text=fashion+nemo&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1485.00&quot;,
            &quot;opening_stock_quantity&quot;: 38,
            &quot;user_id&quot;: 9,
            &quot;barcode&quot;: &quot;6138467305179&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;pos_id&quot;: 17,
        &quot;product_id&quot;: 7,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;3483.86&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 17,
            &quot;customer_id&quot;: 3,
            &quot;inv_date&quot;: &quot;1980-12-27&quot;,
            &quot;inv_amout&quot;: &quot;2888.61&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;10.00&quot;,
            &quot;discount&quot;: &quot;288.86&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC912&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee11?text=fashion+velit&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;3343.25&quot;,
            &quot;opening_stock_quantity&quot;: 10,
            &quot;user_id&quot;: 3,
            &quot;barcode&quot;: &quot;4341105343361&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 23,
        &quot;pos_id&quot;: 12,
        &quot;product_id&quot;: 13,
        &quot;qty&quot;: 4,
        &quot;sale_price&quot;: &quot;2088.26&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 12,
            &quot;customer_id&quot;: 19,
            &quot;inv_date&quot;: &quot;2004-08-27&quot;,
            &quot;inv_amout&quot;: &quot;2899.35&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;144.97&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 24,
        &quot;pos_id&quot;: 18,
        &quot;product_id&quot;: 20,
        &quot;qty&quot;: 5,
        &quot;sale_price&quot;: &quot;3162.53&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 18,
            &quot;customer_id&quot;: 4,
            &quot;inv_date&quot;: &quot;1997-01-29&quot;,
            &quot;inv_amout&quot;: &quot;3840.61&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 20,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC313&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003333?text=fashion+et&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;2022.44&quot;,
            &quot;opening_stock_quantity&quot;: 48,
            &quot;user_id&quot;: 8,
            &quot;barcode&quot;: &quot;5887350312725&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 25,
        &quot;pos_id&quot;: 2,
        &quot;product_id&quot;: 19,
        &quot;qty&quot;: 4,
        &quot;sale_price&quot;: &quot;2909.67&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 2,
            &quot;customer_id&quot;: 7,
            &quot;inv_date&quot;: &quot;1985-11-22&quot;,
            &quot;inv_amout&quot;: &quot;3303.24&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;165.16&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 19,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC548&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/007799?text=fashion+ut&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;4831.53&quot;,
            &quot;opening_stock_quantity&quot;: 11,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;5188983942168&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 26,
        &quot;pos_id&quot;: 9,
        &quot;product_id&quot;: 13,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;3720.14&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 9,
            &quot;customer_id&quot;: 11,
            &quot;inv_date&quot;: &quot;1978-04-18&quot;,
            &quot;inv_amout&quot;: &quot;921.54&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;0.00&quot;,
            &quot;discount&quot;: &quot;0.00&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC740&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0077ee?text=fashion+voluptas&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;2208.37&quot;,
            &quot;opening_stock_quantity&quot;: 42,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;2478892174105&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 27,
        &quot;pos_id&quot;: 6,
        &quot;product_id&quot;: 16,
        &quot;qty&quot;: 2,
        &quot;sale_price&quot;: &quot;884.02&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 6,
            &quot;customer_id&quot;: 2,
            &quot;inv_date&quot;: &quot;2021-06-15&quot;,
            &quot;inv_amout&quot;: &quot;2786.45&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;10.00&quot;,
            &quot;discount&quot;: &quot;278.65&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC346&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022ff?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1876.34&quot;,
            &quot;opening_stock_quantity&quot;: 26,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;7528746238967&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 28,
        &quot;pos_id&quot;: 15,
        &quot;product_id&quot;: 5,
        &quot;qty&quot;: 1,
        &quot;sale_price&quot;: &quot;2064.59&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 15,
            &quot;customer_id&quot;: 1,
            &quot;inv_date&quot;: &quot;1987-08-04&quot;,
            &quot;inv_amout&quot;: &quot;4601.16&quot;,
            &quot;tax&quot;: &quot;50.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;230.06&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC198&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00eedd?text=fashion+enim&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;4170.72&quot;,
            &quot;opening_stock_quantity&quot;: 6,
            &quot;user_id&quot;: 6,
            &quot;barcode&quot;: &quot;1441739426133&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 29,
        &quot;pos_id&quot;: 3,
        &quot;product_id&quot;: 5,
        &quot;qty&quot;: 4,
        &quot;sale_price&quot;: &quot;1200.35&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 3,
            &quot;customer_id&quot;: 16,
            &quot;inv_date&quot;: &quot;1992-04-25&quot;,
            &quot;inv_amout&quot;: &quot;4335.12&quot;,
            &quot;tax&quot;: &quot;0.00&quot;,
            &quot;discPer&quot;: &quot;5.00&quot;,
            &quot;discount&quot;: &quot;216.76&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC198&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00eedd?text=fashion+enim&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;4170.72&quot;,
            &quot;opening_stock_quantity&quot;: 6,
            &quot;user_id&quot;: 6,
            &quot;barcode&quot;: &quot;1441739426133&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 30,
        &quot;pos_id&quot;: 17,
        &quot;product_id&quot;: 6,
        &quot;qty&quot;: 3,
        &quot;sale_price&quot;: &quot;2558.96&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;pos&quot;: {
            &quot;id&quot;: 17,
            &quot;customer_id&quot;: 3,
            &quot;inv_date&quot;: &quot;1980-12-27&quot;,
            &quot;inv_amout&quot;: &quot;2888.61&quot;,
            &quot;tax&quot;: &quot;100.00&quot;,
            &quot;discPer&quot;: &quot;10.00&quot;,
            &quot;discount&quot;: &quot;288.86&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC165&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003311?text=fashion+adipisci&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3429.42&quot;,
            &quot;opening_stock_quantity&quot;: 44,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1278406927279&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos_details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos_details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos_details"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos_details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos_details">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos_details" data-method="GET"
      data-path="api/pos_details"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos_details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos_details"
                    onclick="tryItOut('GETapi-pos_details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos_details"
                    onclick="cancelTryOut('GETapi-pos_details');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos_details"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos_details</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-pos_details">POST api/pos_details</h2>

<p>
</p>



<span id="example-requests-POSTapi-pos_details">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/pos_details" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pos_id\": \"architecto\",
    \"product_id\": \"architecto\",
    \"qty\": 22,
    \"sale_price\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_details"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pos_id": "architecto",
    "product_id": "architecto",
    "qty": 22,
    "sale_price": 84
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-pos_details">
</span>
<span id="execution-results-POSTapi-pos_details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-pos_details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-pos_details"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-pos_details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-pos_details">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-pos_details" data-method="POST"
      data-path="api/pos_details"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-pos_details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-pos_details"
                    onclick="tryItOut('POSTapi-pos_details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-pos_details"
                    onclick="cancelTryOut('POSTapi-pos_details');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-pos_details"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/pos_details</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-pos_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-pos_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pos_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pos_id"                data-endpoint="POSTapi-pos_details"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the pos table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTapi-pos_details"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>qty</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="qty"                data-endpoint="POSTapi-pos_details"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sale_price"                data-endpoint="POSTapi-pos_details"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-pos_details--id-">GET api/pos_details/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-pos_details--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos_details/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_details/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos_details--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;pos_id&quot;: 12,
    &quot;product_id&quot;: 9,
    &quot;qty&quot;: 5,
    &quot;sale_price&quot;: &quot;2363.37&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
    &quot;pos&quot;: {
        &quot;id&quot;: 12,
        &quot;customer_id&quot;: 19,
        &quot;inv_date&quot;: &quot;2004-08-27&quot;,
        &quot;inv_amout&quot;: &quot;2899.35&quot;,
        &quot;tax&quot;: &quot;0.00&quot;,
        &quot;discPer&quot;: &quot;5.00&quot;,
        &quot;discount&quot;: &quot;144.97&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;
    },
    &quot;product&quot;: {
        &quot;id&quot;: 9,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC855&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/000033?text=fashion+inventore&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;1109.24&quot;,
        &quot;opening_stock_quantity&quot;: 43,
        &quot;user_id&quot;: 2,
        &quot;barcode&quot;: &quot;6329370688866&quot;,
        &quot;status&quot;: &quot;Active&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos_details--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos_details--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos_details--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos_details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos_details--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos_details--id-" data-method="GET"
      data-path="api/pos_details/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos_details--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos_details--id-"
                    onclick="tryItOut('GETapi-pos_details--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos_details--id-"
                    onclick="cancelTryOut('GETapi-pos_details--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos_details--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos_details/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-pos_details--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos detail. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-pos_details--id-">PUT api/pos_details/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-pos_details--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/pos_details/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pos_id\": \"architecto\",
    \"product_id\": \"architecto\",
    \"qty\": 22,
    \"sale_price\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_details/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pos_id": "architecto",
    "product_id": "architecto",
    "qty": 22,
    "sale_price": 84
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-pos_details--id-">
</span>
<span id="execution-results-PUTapi-pos_details--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-pos_details--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-pos_details--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-pos_details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-pos_details--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-pos_details--id-" data-method="PUT"
      data-path="api/pos_details/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-pos_details--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-pos_details--id-"
                    onclick="tryItOut('PUTapi-pos_details--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-pos_details--id-"
                    onclick="cancelTryOut('PUTapi-pos_details--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-pos_details--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/pos_details/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-pos_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-pos_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-pos_details--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos detail. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pos_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pos_id"                data-endpoint="PUTapi-pos_details--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the pos table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="PUTapi-pos_details--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>qty</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="qty"                data-endpoint="PUTapi-pos_details--id-"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sale_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sale_price"                data-endpoint="PUTapi-pos_details--id-"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-pos_details--id-">DELETE api/pos_details/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-pos_details--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/pos_details/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_details/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-pos_details--id-">
</span>
<span id="execution-results-DELETEapi-pos_details--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-pos_details--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-pos_details--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-pos_details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-pos_details--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-pos_details--id-" data-method="DELETE"
      data-path="api/pos_details/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-pos_details--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-pos_details--id-"
                    onclick="tryItOut('DELETEapi-pos_details--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-pos_details--id-"
                    onclick="cancelTryOut('DELETEapi-pos_details--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-pos_details--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/pos_details/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-pos_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-pos_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-pos_details--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos detail. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-pos_returns">GET api/pos_returns</h2>

<p>
</p>



<span id="example-requests-GETapi-pos_returns">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos_returns" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_returns"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos_returns">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;customer_id&quot;: 6,
        &quot;invRet_date&quot;: &quot;1995-11-27&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8492&quot;,
        &quot;return_inv_amout&quot;: &quot;1944.20&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 6,
            &quot;cnic&quot;: &quot;78669-4553364-3&quot;,
            &quot;name&quot;: &quot;Brooklyn O&#039;Connell&quot;,
            &quot;email&quot;: &quot;margret91@example.net&quot;,
            &quot;address&quot;: &quot;6577 Libby Keys\nJaydonton, AK 63471&quot;,
            &quot;city_id&quot;: 47,
            &quot;cell_no1&quot;: &quot;03426668525&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 2,
        &quot;customer_id&quot;: 17,
        &quot;invRet_date&quot;: &quot;2005-07-07&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-9324&quot;,
        &quot;return_inv_amout&quot;: &quot;2159.56&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 17,
            &quot;cnic&quot;: &quot;13074-1900895-9&quot;,
            &quot;name&quot;: &quot;Prof. Joanny Christiansen&quot;,
            &quot;email&quot;: &quot;rhermann@example.net&quot;,
            &quot;address&quot;: &quot;8102 Judy Mall Suite 108\nMrazfurt, ME 04610-3291&quot;,
            &quot;city_id&quot;: 13,
            &quot;cell_no1&quot;: &quot;03834471510&quot;,
            &quot;cell_no2&quot;: &quot;03513799186&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;customer_id&quot;: 9,
        &quot;invRet_date&quot;: &quot;2024-10-30&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-1598&quot;,
        &quot;return_inv_amout&quot;: &quot;2086.35&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 9,
            &quot;cnic&quot;: &quot;02899-2558115-4&quot;,
            &quot;name&quot;: &quot;Dr. Maryam Wiegand Sr.&quot;,
            &quot;email&quot;: &quot;niko.champlin@example.net&quot;,
            &quot;address&quot;: &quot;8202 Kuvalis Stream\nEast Kirk, MN 25537-4921&quot;,
            &quot;city_id&quot;: 36,
            &quot;cell_no1&quot;: &quot;03695406057&quot;,
            &quot;cell_no2&quot;: &quot;03971062066&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;customer_id&quot;: 4,
        &quot;invRet_date&quot;: &quot;2022-04-15&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-4300&quot;,
        &quot;return_inv_amout&quot;: &quot;1181.89&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;00619-3564902-8&quot;,
            &quot;name&quot;: &quot;Creola Haag&quot;,
            &quot;email&quot;: &quot;noelia.little@example.com&quot;,
            &quot;address&quot;: &quot;32077 Alicia Estate Suite 493\nReillychester, VT 57755-0706&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03324901271&quot;,
            &quot;cell_no2&quot;: &quot;03237685041&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;customer_id&quot;: 4,
        &quot;invRet_date&quot;: &quot;2018-11-11&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-1692&quot;,
        &quot;return_inv_amout&quot;: &quot;4788.58&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;00619-3564902-8&quot;,
            &quot;name&quot;: &quot;Creola Haag&quot;,
            &quot;email&quot;: &quot;noelia.little@example.com&quot;,
            &quot;address&quot;: &quot;32077 Alicia Estate Suite 493\nReillychester, VT 57755-0706&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03324901271&quot;,
            &quot;cell_no2&quot;: &quot;03237685041&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;customer_id&quot;: 12,
        &quot;invRet_date&quot;: &quot;1975-06-25&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-2780&quot;,
        &quot;return_inv_amout&quot;: &quot;275.11&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 12,
            &quot;cnic&quot;: &quot;19810-4834938-3&quot;,
            &quot;name&quot;: &quot;Michale Russel&quot;,
            &quot;email&quot;: &quot;pamela.flatley@example.net&quot;,
            &quot;address&quot;: &quot;94808 Cora Burg\nNew Eusebioland, KS 71227-8972&quot;,
            &quot;city_id&quot;: 43,
            &quot;cell_no1&quot;: &quot;03576260823&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;customer_id&quot;: 12,
        &quot;invRet_date&quot;: &quot;2003-03-19&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-9717&quot;,
        &quot;return_inv_amout&quot;: &quot;4936.56&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 12,
            &quot;cnic&quot;: &quot;19810-4834938-3&quot;,
            &quot;name&quot;: &quot;Michale Russel&quot;,
            &quot;email&quot;: &quot;pamela.flatley@example.net&quot;,
            &quot;address&quot;: &quot;94808 Cora Burg\nNew Eusebioland, KS 71227-8972&quot;,
            &quot;city_id&quot;: 43,
            &quot;cell_no1&quot;: &quot;03576260823&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;customer_id&quot;: 2,
        &quot;invRet_date&quot;: &quot;1999-02-06&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8803&quot;,
        &quot;return_inv_amout&quot;: &quot;1530.16&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;91139-8736077-9&quot;,
            &quot;name&quot;: &quot;Cristian Mills&quot;,
            &quot;email&quot;: &quot;hoyt62@example.org&quot;,
            &quot;address&quot;: &quot;1934 Randal Forks Apt. 621\nWellingtonmouth, CT 27443&quot;,
            &quot;city_id&quot;: 44,
            &quot;cell_no1&quot;: &quot;03906459816&quot;,
            &quot;cell_no2&quot;: &quot;03963968532&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;customer_id&quot;: 19,
        &quot;invRet_date&quot;: &quot;2011-12-20&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7611&quot;,
        &quot;return_inv_amout&quot;: &quot;136.17&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 19,
            &quot;cnic&quot;: &quot;50156-8936437-8&quot;,
            &quot;name&quot;: &quot;Price Langosh&quot;,
            &quot;email&quot;: &quot;rzemlak@example.org&quot;,
            &quot;address&quot;: &quot;79383 Gottlieb Well\nNew Maxie, UT 26094-9620&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03047064429&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;customer_id&quot;: 20,
        &quot;invRet_date&quot;: &quot;2008-03-18&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8645&quot;,
        &quot;return_inv_amout&quot;: &quot;671.69&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 20,
            &quot;cnic&quot;: &quot;12154-7971885-1&quot;,
            &quot;name&quot;: &quot;Delphine Bechtelar&quot;,
            &quot;email&quot;: &quot;upton.damon@example.net&quot;,
            &quot;address&quot;: &quot;2269 Rosie Trafficway Suite 053\nJalenmouth, OK 61890-8841&quot;,
            &quot;city_id&quot;: 21,
            &quot;cell_no1&quot;: &quot;03992552102&quot;,
            &quot;cell_no2&quot;: &quot;03046941700&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;customer_id&quot;: 18,
        &quot;invRet_date&quot;: &quot;2012-01-06&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-2579&quot;,
        &quot;return_inv_amout&quot;: &quot;1791.03&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 18,
            &quot;cnic&quot;: &quot;62821-7084399-1&quot;,
            &quot;name&quot;: &quot;Curt Kuhn&quot;,
            &quot;email&quot;: &quot;coy.hilpert@example.net&quot;,
            &quot;address&quot;: &quot;956 Rice Common\nHavenland, TX 33220&quot;,
            &quot;city_id&quot;: 17,
            &quot;cell_no1&quot;: &quot;03223032303&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;customer_id&quot;: 4,
        &quot;invRet_date&quot;: &quot;2012-01-19&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-5909&quot;,
        &quot;return_inv_amout&quot;: &quot;778.03&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;00619-3564902-8&quot;,
            &quot;name&quot;: &quot;Creola Haag&quot;,
            &quot;email&quot;: &quot;noelia.little@example.com&quot;,
            &quot;address&quot;: &quot;32077 Alicia Estate Suite 493\nReillychester, VT 57755-0706&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03324901271&quot;,
            &quot;cell_no2&quot;: &quot;03237685041&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;customer_id&quot;: 2,
        &quot;invRet_date&quot;: &quot;1982-03-19&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-1554&quot;,
        &quot;return_inv_amout&quot;: &quot;1432.33&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 2,
            &quot;cnic&quot;: &quot;91139-8736077-9&quot;,
            &quot;name&quot;: &quot;Cristian Mills&quot;,
            &quot;email&quot;: &quot;hoyt62@example.org&quot;,
            &quot;address&quot;: &quot;1934 Randal Forks Apt. 621\nWellingtonmouth, CT 27443&quot;,
            &quot;city_id&quot;: 44,
            &quot;cell_no1&quot;: &quot;03906459816&quot;,
            &quot;cell_no2&quot;: &quot;03963968532&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;customer_id&quot;: 17,
        &quot;invRet_date&quot;: &quot;1977-08-28&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7994&quot;,
        &quot;return_inv_amout&quot;: &quot;4035.63&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 17,
            &quot;cnic&quot;: &quot;13074-1900895-9&quot;,
            &quot;name&quot;: &quot;Prof. Joanny Christiansen&quot;,
            &quot;email&quot;: &quot;rhermann@example.net&quot;,
            &quot;address&quot;: &quot;8102 Judy Mall Suite 108\nMrazfurt, ME 04610-3291&quot;,
            &quot;city_id&quot;: 13,
            &quot;cell_no1&quot;: &quot;03834471510&quot;,
            &quot;cell_no2&quot;: &quot;03513799186&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;customer_id&quot;: 1,
        &quot;invRet_date&quot;: &quot;2000-07-29&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-4701&quot;,
        &quot;return_inv_amout&quot;: &quot;1289.77&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;customer_id&quot;: 13,
        &quot;invRet_date&quot;: &quot;2003-09-16&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7025&quot;,
        &quot;return_inv_amout&quot;: &quot;4921.27&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 13,
            &quot;cnic&quot;: &quot;59903-3328030-7&quot;,
            &quot;name&quot;: &quot;Mr. Duncan O&#039;Hara Sr.&quot;,
            &quot;email&quot;: &quot;lura84@example.org&quot;,
            &quot;address&quot;: &quot;4953 Torphy Glens Apt. 170\nHarrisport, OH 71762&quot;,
            &quot;city_id&quot;: 33,
            &quot;cell_no1&quot;: &quot;03015006803&quot;,
            &quot;cell_no2&quot;: &quot;03579055161&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;customer_id&quot;: 7,
        &quot;invRet_date&quot;: &quot;1984-05-15&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-4923&quot;,
        &quot;return_inv_amout&quot;: &quot;966.67&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 7,
            &quot;cnic&quot;: &quot;28254-0274548-5&quot;,
            &quot;name&quot;: &quot;Kieran Hamill III&quot;,
            &quot;email&quot;: &quot;reyes42@example.org&quot;,
            &quot;address&quot;: &quot;39170 Floy Squares Apt. 016\nLake Nicolette, AK 09302-9984&quot;,
            &quot;city_id&quot;: 14,
            &quot;cell_no1&quot;: &quot;03041199971&quot;,
            &quot;cell_no2&quot;: &quot;03499062231&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;customer_id&quot;: 7,
        &quot;invRet_date&quot;: &quot;2023-04-05&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7565&quot;,
        &quot;return_inv_amout&quot;: &quot;4803.73&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 7,
            &quot;cnic&quot;: &quot;28254-0274548-5&quot;,
            &quot;name&quot;: &quot;Kieran Hamill III&quot;,
            &quot;email&quot;: &quot;reyes42@example.org&quot;,
            &quot;address&quot;: &quot;39170 Floy Squares Apt. 016\nLake Nicolette, AK 09302-9984&quot;,
            &quot;city_id&quot;: 14,
            &quot;cell_no1&quot;: &quot;03041199971&quot;,
            &quot;cell_no2&quot;: &quot;03499062231&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;customer_id&quot;: 19,
        &quot;invRet_date&quot;: &quot;1998-05-30&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-4707&quot;,
        &quot;return_inv_amout&quot;: &quot;4195.66&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 19,
            &quot;cnic&quot;: &quot;50156-8936437-8&quot;,
            &quot;name&quot;: &quot;Price Langosh&quot;,
            &quot;email&quot;: &quot;rzemlak@example.org&quot;,
            &quot;address&quot;: &quot;79383 Gottlieb Well\nNew Maxie, UT 26094-9620&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03047064429&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;customer_id&quot;: 17,
        &quot;invRet_date&quot;: &quot;1977-05-22&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8875&quot;,
        &quot;return_inv_amout&quot;: &quot;2582.23&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:03:02.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 17,
            &quot;cnic&quot;: &quot;13074-1900895-9&quot;,
            &quot;name&quot;: &quot;Prof. Joanny Christiansen&quot;,
            &quot;email&quot;: &quot;rhermann@example.net&quot;,
            &quot;address&quot;: &quot;8102 Judy Mall Suite 108\nMrazfurt, ME 04610-3291&quot;,
            &quot;city_id&quot;: 13,
            &quot;cell_no1&quot;: &quot;03834471510&quot;,
            &quot;cell_no2&quot;: &quot;03513799186&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 21,
        &quot;customer_id&quot;: 6,
        &quot;invRet_date&quot;: &quot;1999-08-30&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7340&quot;,
        &quot;return_inv_amout&quot;: &quot;4462.48&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:47.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 6,
            &quot;cnic&quot;: &quot;78669-4553364-3&quot;,
            &quot;name&quot;: &quot;Brooklyn O&#039;Connell&quot;,
            &quot;email&quot;: &quot;margret91@example.net&quot;,
            &quot;address&quot;: &quot;6577 Libby Keys\nJaydonton, AK 63471&quot;,
            &quot;city_id&quot;: 47,
            &quot;cell_no1&quot;: &quot;03426668525&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 22,
        &quot;customer_id&quot;: 4,
        &quot;invRet_date&quot;: &quot;2011-11-09&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-2118&quot;,
        &quot;return_inv_amout&quot;: &quot;2008.14&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 4,
            &quot;cnic&quot;: &quot;00619-3564902-8&quot;,
            &quot;name&quot;: &quot;Creola Haag&quot;,
            &quot;email&quot;: &quot;noelia.little@example.com&quot;,
            &quot;address&quot;: &quot;32077 Alicia Estate Suite 493\nReillychester, VT 57755-0706&quot;,
            &quot;city_id&quot;: 29,
            &quot;cell_no1&quot;: &quot;03324901271&quot;,
            &quot;cell_no2&quot;: &quot;03237685041&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 23,
        &quot;customer_id&quot;: 1,
        &quot;invRet_date&quot;: &quot;1996-11-23&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8582&quot;,
        &quot;return_inv_amout&quot;: &quot;2290.29&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 24,
        &quot;customer_id&quot;: 20,
        &quot;invRet_date&quot;: &quot;1992-06-24&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-1423&quot;,
        &quot;return_inv_amout&quot;: &quot;1609.31&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 20,
            &quot;cnic&quot;: &quot;12154-7971885-1&quot;,
            &quot;name&quot;: &quot;Delphine Bechtelar&quot;,
            &quot;email&quot;: &quot;upton.damon@example.net&quot;,
            &quot;address&quot;: &quot;2269 Rosie Trafficway Suite 053\nJalenmouth, OK 61890-8841&quot;,
            &quot;city_id&quot;: 21,
            &quot;cell_no1&quot;: &quot;03992552102&quot;,
            &quot;cell_no2&quot;: &quot;03046941700&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 25,
        &quot;customer_id&quot;: 17,
        &quot;invRet_date&quot;: &quot;2020-08-01&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-5557&quot;,
        &quot;return_inv_amout&quot;: &quot;4030.55&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 17,
            &quot;cnic&quot;: &quot;13074-1900895-9&quot;,
            &quot;name&quot;: &quot;Prof. Joanny Christiansen&quot;,
            &quot;email&quot;: &quot;rhermann@example.net&quot;,
            &quot;address&quot;: &quot;8102 Judy Mall Suite 108\nMrazfurt, ME 04610-3291&quot;,
            &quot;city_id&quot;: 13,
            &quot;cell_no1&quot;: &quot;03834471510&quot;,
            &quot;cell_no2&quot;: &quot;03513799186&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 26,
        &quot;customer_id&quot;: 9,
        &quot;invRet_date&quot;: &quot;2010-01-28&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-6875&quot;,
        &quot;return_inv_amout&quot;: &quot;4543.39&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 9,
            &quot;cnic&quot;: &quot;02899-2558115-4&quot;,
            &quot;name&quot;: &quot;Dr. Maryam Wiegand Sr.&quot;,
            &quot;email&quot;: &quot;niko.champlin@example.net&quot;,
            &quot;address&quot;: &quot;8202 Kuvalis Stream\nEast Kirk, MN 25537-4921&quot;,
            &quot;city_id&quot;: 36,
            &quot;cell_no1&quot;: &quot;03695406057&quot;,
            &quot;cell_no2&quot;: &quot;03971062066&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 27,
        &quot;customer_id&quot;: 14,
        &quot;invRet_date&quot;: &quot;2014-07-31&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-3873&quot;,
        &quot;return_inv_amout&quot;: &quot;3114.39&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 14,
            &quot;cnic&quot;: &quot;92023-0006111-7&quot;,
            &quot;name&quot;: &quot;Agustina Carter&quot;,
            &quot;email&quot;: &quot;istrosin@example.net&quot;,
            &quot;address&quot;: &quot;2201 Bahringer Valleys Suite 906\nLeannaview, KS 14527&quot;,
            &quot;city_id&quot;: 45,
            &quot;cell_no1&quot;: &quot;03789540748&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 28,
        &quot;customer_id&quot;: 13,
        &quot;invRet_date&quot;: &quot;1990-09-15&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-9782&quot;,
        &quot;return_inv_amout&quot;: &quot;4608.85&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 13,
            &quot;cnic&quot;: &quot;59903-3328030-7&quot;,
            &quot;name&quot;: &quot;Mr. Duncan O&#039;Hara Sr.&quot;,
            &quot;email&quot;: &quot;lura84@example.org&quot;,
            &quot;address&quot;: &quot;4953 Torphy Glens Apt. 170\nHarrisport, OH 71762&quot;,
            &quot;city_id&quot;: 33,
            &quot;cell_no1&quot;: &quot;03015006803&quot;,
            &quot;cell_no2&quot;: &quot;03579055161&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 29,
        &quot;customer_id&quot;: 1,
        &quot;invRet_date&quot;: &quot;1975-07-25&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-3723&quot;,
        &quot;return_inv_amout&quot;: &quot;4184.20&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 30,
        &quot;customer_id&quot;: 12,
        &quot;invRet_date&quot;: &quot;2022-10-02&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-5725&quot;,
        &quot;return_inv_amout&quot;: &quot;4816.70&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 12,
            &quot;cnic&quot;: &quot;19810-4834938-3&quot;,
            &quot;name&quot;: &quot;Michale Russel&quot;,
            &quot;email&quot;: &quot;pamela.flatley@example.net&quot;,
            &quot;address&quot;: &quot;94808 Cora Burg\nNew Eusebioland, KS 71227-8972&quot;,
            &quot;city_id&quot;: 43,
            &quot;cell_no1&quot;: &quot;03576260823&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 31,
        &quot;customer_id&quot;: 15,
        &quot;invRet_date&quot;: &quot;1972-02-15&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8574&quot;,
        &quot;return_inv_amout&quot;: &quot;3652.04&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 15,
            &quot;cnic&quot;: &quot;55907-5454996-9&quot;,
            &quot;name&quot;: &quot;Arvilla Greenholt III&quot;,
            &quot;email&quot;: &quot;lbarrows@example.com&quot;,
            &quot;address&quot;: &quot;1788 Lavinia Drive Apt. 130\nSchusterfort, NH 88432-8792&quot;,
            &quot;city_id&quot;: 30,
            &quot;cell_no1&quot;: &quot;03054197739&quot;,
            &quot;cell_no2&quot;: &quot;03719509573&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 32,
        &quot;customer_id&quot;: 8,
        &quot;invRet_date&quot;: &quot;2024-07-16&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-9675&quot;,
        &quot;return_inv_amout&quot;: &quot;4521.02&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 8,
            &quot;cnic&quot;: &quot;68322-4163861-5&quot;,
            &quot;name&quot;: &quot;Deangelo Crona DVM&quot;,
            &quot;email&quot;: &quot;feeney.alek@example.net&quot;,
            &quot;address&quot;: &quot;68591 Smitham Vista\nGulgowskimouth, KS 18419-6833&quot;,
            &quot;city_id&quot;: 5,
            &quot;cell_no1&quot;: &quot;03283648044&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 33,
        &quot;customer_id&quot;: 17,
        &quot;invRet_date&quot;: &quot;1971-06-23&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-2717&quot;,
        &quot;return_inv_amout&quot;: &quot;2038.05&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 17,
            &quot;cnic&quot;: &quot;13074-1900895-9&quot;,
            &quot;name&quot;: &quot;Prof. Joanny Christiansen&quot;,
            &quot;email&quot;: &quot;rhermann@example.net&quot;,
            &quot;address&quot;: &quot;8102 Judy Mall Suite 108\nMrazfurt, ME 04610-3291&quot;,
            &quot;city_id&quot;: 13,
            &quot;cell_no1&quot;: &quot;03834471510&quot;,
            &quot;cell_no2&quot;: &quot;03513799186&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 34,
        &quot;customer_id&quot;: 9,
        &quot;invRet_date&quot;: &quot;2020-06-07&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7241&quot;,
        &quot;return_inv_amout&quot;: &quot;4309.13&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 9,
            &quot;cnic&quot;: &quot;02899-2558115-4&quot;,
            &quot;name&quot;: &quot;Dr. Maryam Wiegand Sr.&quot;,
            &quot;email&quot;: &quot;niko.champlin@example.net&quot;,
            &quot;address&quot;: &quot;8202 Kuvalis Stream\nEast Kirk, MN 25537-4921&quot;,
            &quot;city_id&quot;: 36,
            &quot;cell_no1&quot;: &quot;03695406057&quot;,
            &quot;cell_no2&quot;: &quot;03971062066&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 35,
        &quot;customer_id&quot;: 20,
        &quot;invRet_date&quot;: &quot;2007-01-07&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-1164&quot;,
        &quot;return_inv_amout&quot;: &quot;1647.87&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 20,
            &quot;cnic&quot;: &quot;12154-7971885-1&quot;,
            &quot;name&quot;: &quot;Delphine Bechtelar&quot;,
            &quot;email&quot;: &quot;upton.damon@example.net&quot;,
            &quot;address&quot;: &quot;2269 Rosie Trafficway Suite 053\nJalenmouth, OK 61890-8841&quot;,
            &quot;city_id&quot;: 21,
            &quot;cell_no1&quot;: &quot;03992552102&quot;,
            &quot;cell_no2&quot;: &quot;03046941700&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 36,
        &quot;customer_id&quot;: 18,
        &quot;invRet_date&quot;: &quot;2012-10-15&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-1497&quot;,
        &quot;return_inv_amout&quot;: &quot;3479.64&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 18,
            &quot;cnic&quot;: &quot;62821-7084399-1&quot;,
            &quot;name&quot;: &quot;Curt Kuhn&quot;,
            &quot;email&quot;: &quot;coy.hilpert@example.net&quot;,
            &quot;address&quot;: &quot;956 Rice Common\nHavenland, TX 33220&quot;,
            &quot;city_id&quot;: 17,
            &quot;cell_no1&quot;: &quot;03223032303&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 37,
        &quot;customer_id&quot;: 18,
        &quot;invRet_date&quot;: &quot;1984-10-26&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-3005&quot;,
        &quot;return_inv_amout&quot;: &quot;748.61&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 18,
            &quot;cnic&quot;: &quot;62821-7084399-1&quot;,
            &quot;name&quot;: &quot;Curt Kuhn&quot;,
            &quot;email&quot;: &quot;coy.hilpert@example.net&quot;,
            &quot;address&quot;: &quot;956 Rice Common\nHavenland, TX 33220&quot;,
            &quot;city_id&quot;: 17,
            &quot;cell_no1&quot;: &quot;03223032303&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 38,
        &quot;customer_id&quot;: 3,
        &quot;invRet_date&quot;: &quot;2013-10-12&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-6085&quot;,
        &quot;return_inv_amout&quot;: &quot;1961.84&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 3,
            &quot;cnic&quot;: &quot;87905-7698002-1&quot;,
            &quot;name&quot;: &quot;Dr. Jovanny Robel&quot;,
            &quot;email&quot;: &quot;aerdman@example.org&quot;,
            &quot;address&quot;: &quot;70826 Kuhlman Ramp\nPort Katlyn, TX 66811&quot;,
            &quot;city_id&quot;: 46,
            &quot;cell_no1&quot;: &quot;03984147957&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 39,
        &quot;customer_id&quot;: 20,
        &quot;invRet_date&quot;: &quot;1984-07-25&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-8949&quot;,
        &quot;return_inv_amout&quot;: &quot;2527.81&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 20,
            &quot;cnic&quot;: &quot;12154-7971885-1&quot;,
            &quot;name&quot;: &quot;Delphine Bechtelar&quot;,
            &quot;email&quot;: &quot;upton.damon@example.net&quot;,
            &quot;address&quot;: &quot;2269 Rosie Trafficway Suite 053\nJalenmouth, OK 61890-8841&quot;,
            &quot;city_id&quot;: 21,
            &quot;cell_no1&quot;: &quot;03992552102&quot;,
            &quot;cell_no2&quot;: &quot;03046941700&quot;,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:59.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 40,
        &quot;customer_id&quot;: 1,
        &quot;invRet_date&quot;: &quot;2014-02-19&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-5388&quot;,
        &quot;return_inv_amout&quot;: &quot;3834.24&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;customer&quot;: {
            &quot;id&quot;: 1,
            &quot;cnic&quot;: &quot;16333-4529430-3&quot;,
            &quot;name&quot;: &quot;Dalton Bosco&quot;,
            &quot;email&quot;: &quot;alindgren@example.net&quot;,
            &quot;address&quot;: &quot;690 Kautzer Shore\nLakinland, VT 14845&quot;,
            &quot;city_id&quot;: 3,
            &quot;cell_no1&quot;: &quot;03804492410&quot;,
            &quot;cell_no2&quot;: null,
            &quot;image_path&quot;: &quot;default.png&quot;,
            &quot;status&quot;: &quot;inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos_returns" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos_returns"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos_returns"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos_returns" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos_returns">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos_returns" data-method="GET"
      data-path="api/pos_returns"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos_returns', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos_returns"
                    onclick="tryItOut('GETapi-pos_returns');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos_returns"
                    onclick="cancelTryOut('GETapi-pos_returns');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos_returns"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos_returns</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-pos_returns">POST api/pos_returns</h2>

<p>
</p>



<span id="example-requests-POSTapi-pos_returns">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/pos_returns" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"customer_id\": \"architecto\",
    \"invRet_date\": \"2025-09-29T15:16:05\",
    \"pos_inv_no\": \"n\",
    \"return_inv_amout\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_returns"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "customer_id": "architecto",
    "invRet_date": "2025-09-29T15:16:05",
    "pos_inv_no": "n",
    "return_inv_amout": 84
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-pos_returns">
</span>
<span id="execution-results-POSTapi-pos_returns" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-pos_returns"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-pos_returns"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-pos_returns" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-pos_returns">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-pos_returns" data-method="POST"
      data-path="api/pos_returns"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-pos_returns', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-pos_returns"
                    onclick="tryItOut('POSTapi-pos_returns');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-pos_returns"
                    onclick="cancelTryOut('POSTapi-pos_returns');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-pos_returns"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/pos_returns</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-pos_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-pos_returns"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_id"                data-endpoint="POSTapi-pos_returns"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the customers table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>invRet_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="invRet_date"                data-endpoint="POSTapi-pos_returns"
               value="2025-09-29T15:16:05"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pos_inv_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pos_inv_no"                data-endpoint="POSTapi-pos_returns"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>return_inv_amout</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="return_inv_amout"                data-endpoint="POSTapi-pos_returns"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-pos_returns--id-">GET api/pos_returns/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-pos_returns--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos_returns/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_returns/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos_returns--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;customer_id&quot;: 6,
    &quot;invRet_date&quot;: &quot;1995-11-27&quot;,
    &quot;pos_inv_no&quot;: &quot;POS-8492&quot;,
    &quot;return_inv_amout&quot;: &quot;1944.20&quot;,
    &quot;created_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-28T15:03:01.000000Z&quot;,
    &quot;customer&quot;: {
        &quot;id&quot;: 6,
        &quot;cnic&quot;: &quot;78669-4553364-3&quot;,
        &quot;name&quot;: &quot;Brooklyn O&#039;Connell&quot;,
        &quot;email&quot;: &quot;margret91@example.net&quot;,
        &quot;address&quot;: &quot;6577 Libby Keys\nJaydonton, AK 63471&quot;,
        &quot;city_id&quot;: 47,
        &quot;cell_no1&quot;: &quot;03426668525&quot;,
        &quot;cell_no2&quot;: null,
        &quot;image_path&quot;: &quot;default.png&quot;,
        &quot;status&quot;: &quot;inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T15:02:58.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos_returns--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos_returns--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos_returns--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos_returns--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos_returns--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos_returns--id-" data-method="GET"
      data-path="api/pos_returns/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos_returns--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos_returns--id-"
                    onclick="tryItOut('GETapi-pos_returns--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos_returns--id-"
                    onclick="cancelTryOut('GETapi-pos_returns--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos_returns--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos_returns/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos_returns--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos_returns--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-pos_returns--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos return. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-pos_returns--id-">PUT api/pos_returns/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-pos_returns--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/pos_returns/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"customer_id\": \"architecto\",
    \"invRet_date\": \"2025-09-29T15:16:05\",
    \"pos_inv_no\": \"n\",
    \"return_inv_amout\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_returns/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "customer_id": "architecto",
    "invRet_date": "2025-09-29T15:16:05",
    "pos_inv_no": "n",
    "return_inv_amout": 84
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-pos_returns--id-">
</span>
<span id="execution-results-PUTapi-pos_returns--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-pos_returns--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-pos_returns--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-pos_returns--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-pos_returns--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-pos_returns--id-" data-method="PUT"
      data-path="api/pos_returns/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-pos_returns--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-pos_returns--id-"
                    onclick="tryItOut('PUTapi-pos_returns--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-pos_returns--id-"
                    onclick="cancelTryOut('PUTapi-pos_returns--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-pos_returns--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/pos_returns/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-pos_returns--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-pos_returns--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-pos_returns--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos return. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>customer_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="customer_id"                data-endpoint="PUTapi-pos_returns--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the customers table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>invRet_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="invRet_date"                data-endpoint="PUTapi-pos_returns--id-"
               value="2025-09-29T15:16:05"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-09-29T15:16:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pos_inv_no</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pos_inv_no"                data-endpoint="PUTapi-pos_returns--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>return_inv_amout</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="return_inv_amout"                data-endpoint="PUTapi-pos_returns--id-"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-pos_returns--id-">DELETE api/pos_returns/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-pos_returns--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/pos_returns/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_returns/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-pos_returns--id-">
</span>
<span id="execution-results-DELETEapi-pos_returns--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-pos_returns--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-pos_returns--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-pos_returns--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-pos_returns--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-pos_returns--id-" data-method="DELETE"
      data-path="api/pos_returns/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-pos_returns--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-pos_returns--id-"
                    onclick="tryItOut('DELETEapi-pos_returns--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-pos_returns--id-"
                    onclick="cancelTryOut('DELETEapi-pos_returns--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-pos_returns--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/pos_returns/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-pos_returns--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-pos_returns--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-pos_returns--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos return. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-pos_return_details">GET api/pos_return_details</h2>

<p>
</p>



<span id="example-requests-GETapi-pos_return_details">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos_return_details" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_return_details"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos_return_details">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;pos_return_id&quot;: 21,
        &quot;product_id&quot;: 21,
        &quot;qty&quot;: 10,
        &quot;return_unit_price&quot;: &quot;197.31&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 21,
            &quot;customer_id&quot;: 6,
            &quot;invRet_date&quot;: &quot;1999-08-30&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-7340&quot;,
            &quot;return_inv_amout&quot;: &quot;4462.48&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:47.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:47.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 21,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC952&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd55?text=fashion+non&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;1101.70&quot;,
            &quot;opening_stock_quantity&quot;: 40,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;9722312796501&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 3,
        &quot;pos_return_id&quot;: 23,
        &quot;product_id&quot;: 23,
        &quot;qty&quot;: 5,
        &quot;return_unit_price&quot;: &quot;337.78&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 23,
            &quot;customer_id&quot;: 1,
            &quot;invRet_date&quot;: &quot;1996-11-23&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-8582&quot;,
            &quot;return_inv_amout&quot;: &quot;2290.29&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 23,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC105&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff11?text=fashion+molestiae&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;4795.20&quot;,
            &quot;opening_stock_quantity&quot;: 22,
            &quot;user_id&quot;: 6,
            &quot;barcode&quot;: &quot;1980441298398&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 4,
        &quot;pos_return_id&quot;: 24,
        &quot;product_id&quot;: 24,
        &quot;qty&quot;: 1,
        &quot;return_unit_price&quot;: &quot;163.79&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 24,
            &quot;customer_id&quot;: 20,
            &quot;invRet_date&quot;: &quot;1992-06-24&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-1423&quot;,
            &quot;return_inv_amout&quot;: &quot;1609.31&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 24,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC674&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/008866?text=fashion+id&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;2138.84&quot;,
            &quot;opening_stock_quantity&quot;: 40,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;9168269872378&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 5,
        &quot;pos_return_id&quot;: 25,
        &quot;product_id&quot;: 25,
        &quot;qty&quot;: 3,
        &quot;return_unit_price&quot;: &quot;392.44&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 25,
            &quot;customer_id&quot;: 17,
            &quot;invRet_date&quot;: &quot;2020-08-01&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-5557&quot;,
            &quot;return_inv_amout&quot;: &quot;4030.55&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 25,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC873&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/005555?text=fashion+tempora&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;2256.92&quot;,
            &quot;opening_stock_quantity&quot;: 24,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;4840517133701&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 6,
        &quot;pos_return_id&quot;: 26,
        &quot;product_id&quot;: 26,
        &quot;qty&quot;: 9,
        &quot;return_unit_price&quot;: &quot;180.62&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 26,
            &quot;customer_id&quot;: 9,
            &quot;invRet_date&quot;: &quot;2010-01-28&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-6875&quot;,
            &quot;return_inv_amout&quot;: &quot;4543.39&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 26,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC470&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00bb44?text=fashion+voluptatem&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1014.79&quot;,
            &quot;opening_stock_quantity&quot;: 28,
            &quot;user_id&quot;: 1,
            &quot;barcode&quot;: &quot;1942275445683&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 7,
        &quot;pos_return_id&quot;: 27,
        &quot;product_id&quot;: 27,
        &quot;qty&quot;: 10,
        &quot;return_unit_price&quot;: &quot;350.03&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 27,
            &quot;customer_id&quot;: 14,
            &quot;invRet_date&quot;: &quot;2014-07-31&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-3873&quot;,
            &quot;return_inv_amout&quot;: &quot;3114.39&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 27,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC064&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00aadd?text=fashion+sit&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;3871.22&quot;,
            &quot;opening_stock_quantity&quot;: 40,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;1858406240150&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 8,
        &quot;pos_return_id&quot;: 28,
        &quot;product_id&quot;: 28,
        &quot;qty&quot;: 9,
        &quot;return_unit_price&quot;: &quot;75.81&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 28,
            &quot;customer_id&quot;: 13,
            &quot;invRet_date&quot;: &quot;1990-09-15&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-9782&quot;,
            &quot;return_inv_amout&quot;: &quot;4608.85&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 28,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC444&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00bb88?text=fashion+eos&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3773.64&quot;,
            &quot;opening_stock_quantity&quot;: 15,
            &quot;user_id&quot;: 1,
            &quot;barcode&quot;: &quot;9433105209329&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 9,
        &quot;pos_return_id&quot;: 29,
        &quot;product_id&quot;: 29,
        &quot;qty&quot;: 1,
        &quot;return_unit_price&quot;: &quot;269.16&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 29,
            &quot;customer_id&quot;: 1,
            &quot;invRet_date&quot;: &quot;1975-07-25&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-3723&quot;,
            &quot;return_inv_amout&quot;: &quot;4184.20&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 29,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC804&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/006677?text=fashion+aut&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3517.74&quot;,
            &quot;opening_stock_quantity&quot;: 39,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;5010043501346&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 10,
        &quot;pos_return_id&quot;: 30,
        &quot;product_id&quot;: 30,
        &quot;qty&quot;: 10,
        &quot;return_unit_price&quot;: &quot;180.19&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 30,
            &quot;customer_id&quot;: 12,
            &quot;invRet_date&quot;: &quot;2022-10-02&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-5725&quot;,
            &quot;return_inv_amout&quot;: &quot;4816.70&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 30,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC569&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0022bb?text=fashion+atque&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;3393.82&quot;,
            &quot;opening_stock_quantity&quot;: 45,
            &quot;user_id&quot;: 3,
            &quot;barcode&quot;: &quot;1212083077025&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 11,
        &quot;pos_return_id&quot;: 31,
        &quot;product_id&quot;: 31,
        &quot;qty&quot;: 9,
        &quot;return_unit_price&quot;: &quot;380.13&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 31,
            &quot;customer_id&quot;: 15,
            &quot;invRet_date&quot;: &quot;1972-02-15&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-8574&quot;,
            &quot;return_inv_amout&quot;: &quot;3652.04&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 31,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC143&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003399?text=fashion+non&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1844.69&quot;,
            &quot;opening_stock_quantity&quot;: 9,
            &quot;user_id&quot;: 11,
            &quot;barcode&quot;: &quot;6464086187637&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 12,
        &quot;pos_return_id&quot;: 32,
        &quot;product_id&quot;: 32,
        &quot;qty&quot;: 8,
        &quot;return_unit_price&quot;: &quot;233.24&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 32,
            &quot;customer_id&quot;: 8,
            &quot;invRet_date&quot;: &quot;2024-07-16&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-9675&quot;,
            &quot;return_inv_amout&quot;: &quot;4521.02&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 32,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC471&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/003388?text=fashion+perferendis&quot;,
            &quot;sub_category_id&quot;: 6,
            &quot;sale_price&quot;: &quot;1644.22&quot;,
            &quot;opening_stock_quantity&quot;: 16,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;0383275787990&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 13,
        &quot;pos_return_id&quot;: 33,
        &quot;product_id&quot;: 33,
        &quot;qty&quot;: 8,
        &quot;return_unit_price&quot;: &quot;218.41&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 33,
            &quot;customer_id&quot;: 17,
            &quot;invRet_date&quot;: &quot;1971-06-23&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-2717&quot;,
            &quot;return_inv_amout&quot;: &quot;2038.05&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 33,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC212&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/005577?text=fashion+reiciendis&quot;,
            &quot;sub_category_id&quot;: 9,
            &quot;sale_price&quot;: &quot;2831.54&quot;,
            &quot;opening_stock_quantity&quot;: 19,
            &quot;user_id&quot;: 3,
            &quot;barcode&quot;: &quot;5969029939737&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 14,
        &quot;pos_return_id&quot;: 34,
        &quot;product_id&quot;: 34,
        &quot;qty&quot;: 4,
        &quot;return_unit_price&quot;: &quot;95.22&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 34,
            &quot;customer_id&quot;: 9,
            &quot;invRet_date&quot;: &quot;2020-06-07&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-7241&quot;,
            &quot;return_inv_amout&quot;: &quot;4309.13&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 34,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC052&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd00?text=fashion+dicta&quot;,
            &quot;sub_category_id&quot;: 5,
            &quot;sale_price&quot;: &quot;3860.35&quot;,
            &quot;opening_stock_quantity&quot;: 30,
            &quot;user_id&quot;: 7,
            &quot;barcode&quot;: &quot;1460658406033&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 15,
        &quot;pos_return_id&quot;: 35,
        &quot;product_id&quot;: 35,
        &quot;qty&quot;: 5,
        &quot;return_unit_price&quot;: &quot;440.11&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 35,
            &quot;customer_id&quot;: 20,
            &quot;invRet_date&quot;: &quot;2007-01-07&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-1164&quot;,
            &quot;return_inv_amout&quot;: &quot;1647.87&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 35,
            &quot;title&quot;: &quot;Banarci&quot;,
            &quot;design_code&quot;: &quot;DC988&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ff22?text=fashion+et&quot;,
            &quot;sub_category_id&quot;: 4,
            &quot;sale_price&quot;: &quot;4773.55&quot;,
            &quot;opening_stock_quantity&quot;: 38,
            &quot;user_id&quot;: 4,
            &quot;barcode&quot;: &quot;2665575457031&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 16,
        &quot;pos_return_id&quot;: 36,
        &quot;product_id&quot;: 36,
        &quot;qty&quot;: 7,
        &quot;return_unit_price&quot;: &quot;104.89&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 36,
            &quot;customer_id&quot;: 18,
            &quot;invRet_date&quot;: &quot;2012-10-15&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-1497&quot;,
            &quot;return_inv_amout&quot;: &quot;3479.64&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 36,
            &quot;title&quot;: &quot;Anarkali&quot;,
            &quot;design_code&quot;: &quot;DC336&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ee22?text=fashion+et&quot;,
            &quot;sub_category_id&quot;: 7,
            &quot;sale_price&quot;: &quot;4646.44&quot;,
            &quot;opening_stock_quantity&quot;: 47,
            &quot;user_id&quot;: 9,
            &quot;barcode&quot;: &quot;9640637360910&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 17,
        &quot;pos_return_id&quot;: 37,
        &quot;product_id&quot;: 37,
        &quot;qty&quot;: 9,
        &quot;return_unit_price&quot;: &quot;321.72&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 37,
            &quot;customer_id&quot;: 18,
            &quot;invRet_date&quot;: &quot;1984-10-26&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-3005&quot;,
            &quot;return_inv_amout&quot;: &quot;748.61&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 37,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC564&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0044ee?text=fashion+rerum&quot;,
            &quot;sub_category_id&quot;: 5,
            &quot;sale_price&quot;: &quot;4675.73&quot;,
            &quot;opening_stock_quantity&quot;: 10,
            &quot;user_id&quot;: 8,
            &quot;barcode&quot;: &quot;1353048111290&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 18,
        &quot;pos_return_id&quot;: 38,
        &quot;product_id&quot;: 38,
        &quot;qty&quot;: 3,
        &quot;return_unit_price&quot;: &quot;319.28&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 38,
            &quot;customer_id&quot;: 3,
            &quot;invRet_date&quot;: &quot;2013-10-12&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-6085&quot;,
            &quot;return_inv_amout&quot;: &quot;1961.84&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 38,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC014&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00bb55?text=fashion+enim&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;4124.91&quot;,
            &quot;opening_stock_quantity&quot;: 41,
            &quot;user_id&quot;: 10,
            &quot;barcode&quot;: &quot;5698027941366&quot;,
            &quot;status&quot;: &quot;Inactive&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 19,
        &quot;pos_return_id&quot;: 39,
        &quot;product_id&quot;: 39,
        &quot;qty&quot;: 9,
        &quot;return_unit_price&quot;: &quot;221.59&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 39,
            &quot;customer_id&quot;: 20,
            &quot;invRet_date&quot;: &quot;1984-07-25&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-8949&quot;,
            &quot;return_inv_amout&quot;: &quot;2527.81&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 39,
            &quot;title&quot;: &quot;Long Shirt&quot;,
            &quot;design_code&quot;: &quot;DC087&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/0044ff?text=fashion+rerum&quot;,
            &quot;sub_category_id&quot;: 1,
            &quot;sale_price&quot;: &quot;2557.15&quot;,
            &quot;opening_stock_quantity&quot;: 46,
            &quot;user_id&quot;: 5,
            &quot;barcode&quot;: &quot;4346055342914&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    },
    {
        &quot;id&quot;: 20,
        &quot;pos_return_id&quot;: 40,
        &quot;product_id&quot;: 40,
        &quot;qty&quot;: 1,
        &quot;return_unit_price&quot;: &quot;464.25&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;pos_return&quot;: {
            &quot;id&quot;: 40,
            &quot;customer_id&quot;: 1,
            &quot;invRet_date&quot;: &quot;2014-02-19&quot;,
            &quot;pos_inv_no&quot;: &quot;POS-5388&quot;,
            &quot;return_inv_amout&quot;: &quot;3834.24&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        },
        &quot;product&quot;: {
            &quot;id&quot;: 40,
            &quot;title&quot;: &quot;Maxi&quot;,
            &quot;design_code&quot;: &quot;DC952&quot;,
            &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00ddff?text=fashion+quae&quot;,
            &quot;sub_category_id&quot;: 2,
            &quot;sale_price&quot;: &quot;1099.34&quot;,
            &quot;opening_stock_quantity&quot;: 32,
            &quot;user_id&quot;: 6,
            &quot;barcode&quot;: &quot;9398462028009&quot;,
            &quot;status&quot;: &quot;Active&quot;,
            &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos_return_details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos_return_details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos_return_details"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos_return_details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos_return_details">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos_return_details" data-method="GET"
      data-path="api/pos_return_details"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos_return_details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos_return_details"
                    onclick="tryItOut('GETapi-pos_return_details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos_return_details"
                    onclick="cancelTryOut('GETapi-pos_return_details');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos_return_details"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos_return_details</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-pos_return_details">POST api/pos_return_details</h2>

<p>
</p>



<span id="example-requests-POSTapi-pos_return_details">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/pos_return_details" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pos_return_id\": \"architecto\",
    \"product_id\": \"architecto\",
    \"qty\": 22,
    \"return_unit_price\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_return_details"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pos_return_id": "architecto",
    "product_id": "architecto",
    "qty": 22,
    "return_unit_price": 84
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-pos_return_details">
</span>
<span id="execution-results-POSTapi-pos_return_details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-pos_return_details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-pos_return_details"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-pos_return_details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-pos_return_details">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-pos_return_details" data-method="POST"
      data-path="api/pos_return_details"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-pos_return_details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-pos_return_details"
                    onclick="tryItOut('POSTapi-pos_return_details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-pos_return_details"
                    onclick="cancelTryOut('POSTapi-pos_return_details');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-pos_return_details"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/pos_return_details</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-pos_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-pos_return_details"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pos_return_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pos_return_id"                data-endpoint="POSTapi-pos_return_details"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the pos_returns table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="POSTapi-pos_return_details"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>qty</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="qty"                data-endpoint="POSTapi-pos_return_details"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>return_unit_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="return_unit_price"                data-endpoint="POSTapi-pos_return_details"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-pos_return_details--id-">GET api/pos_return_details/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-pos_return_details--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/pos_return_details/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_return_details/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pos_return_details--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;pos_return_id&quot;: 21,
    &quot;product_id&quot;: 21,
    &quot;qty&quot;: 10,
    &quot;return_unit_price&quot;: &quot;197.31&quot;,
    &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
    &quot;pos_return&quot;: {
        &quot;id&quot;: 21,
        &quot;customer_id&quot;: 6,
        &quot;invRet_date&quot;: &quot;1999-08-30&quot;,
        &quot;pos_inv_no&quot;: &quot;POS-7340&quot;,
        &quot;return_inv_amout&quot;: &quot;4462.48&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:47.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:47.000000Z&quot;
    },
    &quot;product&quot;: {
        &quot;id&quot;: 21,
        &quot;title&quot;: &quot;Long Shirt&quot;,
        &quot;design_code&quot;: &quot;DC952&quot;,
        &quot;image_path&quot;: &quot;https://via.placeholder.com/640x480.png/00dd55?text=fashion+non&quot;,
        &quot;sub_category_id&quot;: 9,
        &quot;sale_price&quot;: &quot;1101.70&quot;,
        &quot;opening_stock_quantity&quot;: 40,
        &quot;user_id&quot;: 11,
        &quot;barcode&quot;: &quot;9722312796501&quot;,
        &quot;status&quot;: &quot;Inactive&quot;,
        &quot;created_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-29T11:41:48.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pos_return_details--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pos_return_details--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pos_return_details--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pos_return_details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pos_return_details--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pos_return_details--id-" data-method="GET"
      data-path="api/pos_return_details/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pos_return_details--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pos_return_details--id-"
                    onclick="tryItOut('GETapi-pos_return_details--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pos_return_details--id-"
                    onclick="cancelTryOut('GETapi-pos_return_details--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pos_return_details--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pos_return_details/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pos_return_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pos_return_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-pos_return_details--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos return detail. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-pos_return_details--id-">PUT api/pos_return_details/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-pos_return_details--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/pos_return_details/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pos_return_id\": \"architecto\",
    \"product_id\": \"architecto\",
    \"qty\": 22,
    \"return_unit_price\": 84
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_return_details/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pos_return_id": "architecto",
    "product_id": "architecto",
    "qty": 22,
    "return_unit_price": 84
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-pos_return_details--id-">
</span>
<span id="execution-results-PUTapi-pos_return_details--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-pos_return_details--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-pos_return_details--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-pos_return_details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-pos_return_details--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-pos_return_details--id-" data-method="PUT"
      data-path="api/pos_return_details/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-pos_return_details--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-pos_return_details--id-"
                    onclick="tryItOut('PUTapi-pos_return_details--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-pos_return_details--id-"
                    onclick="cancelTryOut('PUTapi-pos_return_details--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-pos_return_details--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/pos_return_details/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/pos_return_details/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-pos_return_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-pos_return_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-pos_return_details--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos return detail. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pos_return_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pos_return_id"                data-endpoint="PUTapi-pos_return_details--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the pos_returns table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="product_id"                data-endpoint="PUTapi-pos_return_details--id-"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>qty</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="qty"                data-endpoint="PUTapi-pos_return_details--id-"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>return_unit_price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="return_unit_price"                data-endpoint="PUTapi-pos_return_details--id-"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-pos_return_details--id-">DELETE api/pos_return_details/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-pos_return_details--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/pos_return_details/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/pos_return_details/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-pos_return_details--id-">
</span>
<span id="execution-results-DELETEapi-pos_return_details--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-pos_return_details--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-pos_return_details--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-pos_return_details--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-pos_return_details--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-pos_return_details--id-" data-method="DELETE"
      data-path="api/pos_return_details/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-pos_return_details--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-pos_return_details--id-"
                    onclick="tryItOut('DELETEapi-pos_return_details--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-pos_return_details--id-"
                    onclick="cancelTryOut('DELETEapi-pos_return_details--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-pos_return_details--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/pos_return_details/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-pos_return_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-pos_return_details--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-pos_return_details--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the pos return detail. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
