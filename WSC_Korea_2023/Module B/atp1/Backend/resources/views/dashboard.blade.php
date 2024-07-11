<x-head title='Dashbaord' />
    <body class="vw-100 vh-100 d-grid">
        <div class="d-flex justify-content-center align-items-center gap-3">
            <div class="card text-center mb-3 p-3">
               <h1>This is the dashboard!</h1>
               <h2>{{ Auth::user() }}</h2>
              </div>
        </div>
    </body>
</html>
