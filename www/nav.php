<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="layout/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        padding-top: 250px;
        background-position:center;
        background-size:cover;
    }

    footer {
    margin: 50px 0;
    width:960px;     
    height:200px;
    }
    </style>


</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>

            <meta name="viewport" content="width=device-width, initial-scale=1"><style>
            body {
                font-family: "Lato", sans-serif;
            }

            .sidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 15px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }   

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
            </style>
            </head>
                <body>
                    <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <h3 style="color:white;">Add New Content:</h3>
                    <a href="People.php">Add Actor/Director</a>
                    <a href="Movie.php">Add Movie Information</a>
                    <a href="Comment.php">Add Comment To Movies</a>
                    <a href="Movie_Actor.php">Add Movie/Actor Relation</a>
                    <a href="Movie_Director.php">Add Movie/Director Relation</a>

                    <h3 style="color:white;">Browsing Content:</h3>
                    <a href="Information_Actor.php">Show Actor Information</a>
                    <a href="Information_Movie.php">Show Movie Information</a>

                    <h3 style="color:white;">Search:</h3>
                    <a href="Browsing.php">Search Actor/Movie</a>
                    </div>

                    <div class="collapse navbar-collapse" id="1">
                         <ul class="nav navbar-nav">
                            <li>
                                <a onclick="openNav()">&#9776; Menu</a>
                            </li>
                        </ul>
                    </div>

                    
                    <script>
                    function openNav() {
                        document.getElementById("mySidenav").style.width = "250px";
                    }

                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                    }
                    </script>
        </div>
    </nav>
