<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/offcanvas/">

    <style>
        footer {
            text-align: center;
        }
        #navbarsExampleDefault {
            display: none;
        }
    </style>
</head>
<body style="background:#D8D7D7">
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="/intro">Task Manager</a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="add">
                <a id="addLink" class="nav-link" href="add.php">Add Task</a>
            </li>
            <li class="nav-item" id="dash">
                <a id="doneLink" class="nav-link" href="/intro/done_tasks.php">Done Tasks</a>
            </li>
            </ul>
            <form id="searchForm" class="form-inline my-2 my-lg-0">
            <input id="searchBar" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button id="searchBtn" class="btn btn-outline-success my-2 my-sm-0">Search</button>
            </form>
        </div>
      </div>
    </nav>
    

    