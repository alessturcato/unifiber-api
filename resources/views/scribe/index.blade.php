<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Api Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">
    <script src="{{ asset("vendor/scribe/js/theme-default-3.11.1.js") }}"></script>

    <link rel="stylesheet"
          href="//unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="//unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    <script src="//cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
    <script>
        var baseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.11.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">
<a href="#" id="nav-button">
      <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
      </span>
</a>
<div class="tocify-wrapper">
        <img src="1" alt="logo" class="logo" style="padding-top: 10px;" width="230px"/>
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: October 4 2021</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost:8301</code></pre>

        <h1>Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header in the form <strong><code>"Basic {credentials}"</code></strong>. The value of <code>{credentials}</code> should be your username/id and your password, joined with a colon (:), and then base64-encoded.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="endpoints">Endpoints</h1>

    

            <h2 id="endpoints-POSTapi-v1-coperture_unifiber-registra">Registra una nuova copertura nel database.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-coperture_unifiber-registra">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "http://localhost:8301/api/v1/coperture_unifiber/registra" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Basic YWRtaW46YWRtaW4uMTIz"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8301/api/v1/coperture_unifiber/registra"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Basic YWRtaW46YWRtaW4uMTIz",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
</span>

<span id="example-responses-POSTapi-v1-coperture_unifiber-registra">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;id_scala&quot;: [
            &quot;id scala &egrave; un campo obbligatorio.&quot;
        ],
        &quot;regione&quot;: [
            &quot;regione &egrave; un campo obbligatorio.&quot;
        ],
        &quot;provincia&quot;: [
            &quot;provincia &egrave; un campo obbligatorio.&quot;
        ],
        &quot;comune&quot;: [
            &quot;comune &egrave; un campo obbligatorio.&quot;
        ],
        &quot;comune_descrizione&quot;: [
            &quot;comune descrizione &egrave; un campo obbligatorio.&quot;
        ],
        &quot;indirizzo&quot;: [
            &quot;indirizzo &egrave; un campo obbligatorio.&quot;
        ],
        &quot;codice_via&quot;: [
            &quot;codice via &egrave; un campo obbligatorio.&quot;
        ],
        &quot;id_building&quot;: [
            &quot;id building &egrave; un campo obbligatorio.&quot;
        ],
        &quot;pop&quot;: [
            &quot;pop &egrave; un campo obbligatorio.&quot;
        ],
        &quot;id_pop&quot;: [
            &quot;id pop &egrave; un campo obbligatorio.&quot;
        ],
        &quot;stato_building&quot;: [
            &quot;stato building &egrave; un campo obbligatorio.&quot;
        ],
        &quot;stato_scala_palazzina&quot;: [
            &quot;stato scala palazzina &egrave; un campo obbligatorio.&quot;
        ],
        &quot;id_egon_civico&quot;: [
            &quot;id egon civico &egrave; un campo obbligatorio.&quot;
        ],
        &quot;id_egon_strada&quot;: [
            &quot;id egon strada &egrave; un campo obbligatorio.&quot;
        ],
        &quot;idzona&quot;: [
            &quot;idzona &egrave; un campo obbligatorio.&quot;
        ],
        &quot;denom_zona&quot;: [
            &quot;denom zona &egrave; un campo obbligatorio.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-coperture_unifiber-registra" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-coperture_unifiber-registra"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-coperture_unifiber-registra"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-coperture_unifiber-registra" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-coperture_unifiber-registra"></code></pre>
</span>
<form id="form-POSTapi-v1-coperture_unifiber-registra" data-method="POST"
      data-path="api/v1/coperture_unifiber/registra"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Authorization":"Basic YWRtaW46YWRtaW4uMTIz"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-coperture_unifiber-registra', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-coperture_unifiber-registra"
                    onclick="tryItOut('POSTapi-v1-coperture_unifiber-registra');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-coperture_unifiber-registra"
                    onclick="cancelTryOut('POSTapi-v1-coperture_unifiber-registra');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-coperture_unifiber-registra" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/coperture_unifiber/registra</code></b>
        </p>
                    </form>

            <h2 id="endpoints-GETapi-v1-coperture_unifiber-storico--id-">Controllo lo storico di una copertura.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-coperture_unifiber-storico--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8301/api/v1/coperture_unifiber/storico/magnam" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Basic YWRtaW46YWRtaW4uMTIz"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8301/api/v1/coperture_unifiber/storico/magnam"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Basic YWRtaW46YWRtaW4uMTIz",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
</span>

<span id="example-responses-GETapi-v1-coperture_unifiber-storico--id-">
    </span>
<span id="execution-results-GETapi-v1-coperture_unifiber-storico--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-coperture_unifiber-storico--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-coperture_unifiber-storico--id-"></code></pre>
</span>
<span id="execution-error-GETapi-v1-coperture_unifiber-storico--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-coperture_unifiber-storico--id-"></code></pre>
</span>
<form id="form-GETapi-v1-coperture_unifiber-storico--id-" data-method="GET"
      data-path="api/v1/coperture_unifiber/storico/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Authorization":"Basic YWRtaW46YWRtaW4uMTIz"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-coperture_unifiber-storico--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-coperture_unifiber-storico--id-"
                    onclick="tryItOut('GETapi-v1-coperture_unifiber-storico--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-coperture_unifiber-storico--id-"
                    onclick="cancelTryOut('GETapi-v1-coperture_unifiber-storico--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-coperture_unifiber-storico--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/coperture_unifiber/storico/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="id"
               data-endpoint="GETapi-v1-coperture_unifiber-storico--id-"
               data-component="url" required  hidden>
    <br>
<p>The ID of the storico.</p>            </p>
                    </form>

            <h2 id="endpoints-POSTapi-v1-coperture_unifiber-ricerca">Ricerca delle coperture</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-coperture_unifiber-ricerca">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "http://localhost:8301/api/v1/coperture_unifiber/ricerca" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Authorization: Basic YWRtaW46YWRtaW4uMTIz"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "http://localhost:8301/api/v1/coperture_unifiber/ricerca"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Basic YWRtaW46YWRtaW4uMTIz",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
</span>

<span id="example-responses-POSTapi-v1-coperture_unifiber-ricerca">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;provincia&quot;: [
            &quot;provincia &egrave; un campo obbligatorio.&quot;
        ],
        &quot;comune&quot;: [
            &quot;comune &egrave; un campo obbligatorio.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-coperture_unifiber-ricerca" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-coperture_unifiber-ricerca"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-coperture_unifiber-ricerca"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-coperture_unifiber-ricerca" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-coperture_unifiber-ricerca"></code></pre>
</span>
<form id="form-POSTapi-v1-coperture_unifiber-ricerca" data-method="POST"
      data-path="api/v1/coperture_unifiber/ricerca"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Authorization":"Basic YWRtaW46YWRtaW4uMTIz"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-coperture_unifiber-ricerca', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-coperture_unifiber-ricerca"
                    onclick="tryItOut('POSTapi-v1-coperture_unifiber-ricerca');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-coperture_unifiber-ricerca"
                    onclick="cancelTryOut('POSTapi-v1-coperture_unifiber-ricerca');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-coperture_unifiber-ricerca" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/coperture_unifiber/ricerca</code></b>
        </p>
                    </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var exampleLanguages = ["bash","javascript"];
        setupLanguages(exampleLanguages);
    });
</script>
</body>
</html>