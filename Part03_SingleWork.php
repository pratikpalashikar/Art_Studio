<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Single Work</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
    <style>

    </style>
</head>
<body>

    <!--Include the navbar on every page-->
    <?php include 'navbar.php';
    ?>

    <div class="container">
        <?php include 'connection.php';

            $imageFormat = ".jpg";
            $artWork_Id = $_GET["id"];
            //Artwork Id
            $sql_query  = "SELECT * FROM artworks WHERE ArtWorkID = $artWork_Id";
            $result = $conn->query($sql_query);

            if($result->num_rows==0 || $result->num_rows<0){
                echo "<script type='text/javascript'>
                    window.location.href = 'Error.php';
                </script>";
            }

            //Fetch one row
            $one_row = $result->fetch_assoc();
            //fetch multiple rows
            $multiple_rows = $result->fetch_assoc();
            //Artist first name, last name
            $artist_name_sql = "SELECT FirstName, LastName FROM artists WHERE ArtistID=".$one_row["ArtistID"];
            $name_result = $conn->query($artist_name_sql);
            $artist_name = $name_result->fetch_assoc();
            //Get the genre
            $artwork_genre_sql = "SELECT GenreName FROM genres WHERE GenreID IN (SELECT GenreID FROM artworkgenres WHERE ArtWorkID =  $artWork_Id)";
            $genre_result = $conn->query($artwork_genre_sql);
            //Get the artwork Subject
            $artwork_subject = "SELECT SubjectName FROM subjects WHERE SubjectId IN (SELECT SubjectID FROM artworksubjects WHERE ArtWorkID = $artWork_Id)";
            $subject_result = $conn->query($artwork_subject);
            //Artwork order
            $artwork_sql_order = "SELECT DateCreated FROM orders WHERE OrderID IN (SELECT OrderID FROM orderdetails WHERE ArtWorkID = $artWork_Id)";
            $order_result = $conn->query($artwork_sql_order);
        ?>
        <!--Row 1-->
        <!-- Heading and link to the single artist-->
        <div class="row">
            <div class="col-md-12">
                <?php
                echo "<h2 class='remove-margin-bottom'>".utf8_encode($one_row["Title"])."</h2>"
                ?>
            </div>
            <div class="col-md-12">
                <?php
                $artist_id = $one_row["ArtistID"];
                echo "<h5>By <a href='Part02_SingleArtist.php?id=$artist_id'>".utf8_encode($artist_name["FirstName"].$artist_name["LastName"])."</a></h5>"
                ?>
            </div>
        </div>
        <!--heading and link end-->

        <!--picture -->
        <div class="row">
            <div class="col-md-4">
                <a href="#" class="pop" data-toggle="modal" data-target="#artModel">
                    <?php
                    echo "<img src='images/art/works/medium/".$one_row["ImageFileName"].$imageFormat."' class='img-responsive img-thumbnail'>";
                    ?>
                </a>
            </div>
            <!--Picture description-->
            <!-- start of picture description -->
            <div class="col-md-6">
                <?php
                echo "<p>".utf8_encode($one_row["Description"])."</p>";
                $cost = number_format((float)$one_row["Cost"], 2, '.', '');
                echo "<h4 style='color: red'><strong>".$cost."</strong></h4>";
                ?>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-gift text-primary" aria-hidden="true"></span>
                        <span class="text-primary">Add to Wish List</span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-shopping-cart text-primary" aria-hidden="true"></span>
                        <span class="text-primary">Add to Shopping Cart</span>
                    </button>
                </div>
                <p></p>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Product Details</div>
                    <table class="table">
                        <tr>
                            <th scope="row">Date:</th>
                            <?php
                            echo "<td>".$one_row["YearOfWork"]."</td>";
                            ?>
                        </tr>
                        <tr>
                            <th scope="row">Medium:</th>
                            <?php
                            echo "<td>".utf8_encode($one_row["Medium"])."</td>";
                            ?>
                        </tr>
                        <tr>
                            <th scope="row">Dimension:</th>
                            <?php
                            echo "<td>".utf8_encode($one_row["Width"]."cm"."x".$one_row["Height"])."cm"."</td>";
                            ?>
                        </tr>
                        <tr>
                            <th scope="row">Home:</th>
                            <?php
                            echo "<td>".utf8_encode($one_row["OriginalHome"])."</td>";
                            ?>
                        </tr>
                        <tr>
                            <th scope="row">Genre:</th>
                            <td>
                                <?php
                                while($genre = $genre_result->fetch_assoc()){
                                    echo "<a>".utf8_encode($genre["GenreName"])."</a><br>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Subject:</th>
                            <td>
                                <?php
                                while($subject = $subject_result->fetch_assoc()){
                                    echo "<a>".utf8_encode($subject["SubjectName"])."</a><br>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--description end-->
            <!-- side table-->
            <div class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sales</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        while ($order_date = $order_result->fetch_assoc()){
                            echo "<a>".date('n/d/y', strtotime($order_date["DateCreated"]))."</a><br>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--side table end-->

        </div>
        <!--this div is the end of the container-->
    </div>



<div class="modal fade" id="artModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php
                    echo utf8_encode($one_row["Title"])." (".utf8_encode($one_row["YearOfWork"]).")   by  "." ".utf8_encode($artist_name["FirstName"].$artist_name["LastName"]);
                    ?>
                </h4>
            </div>
            <div class="modal-body">
                <?php
                 echo "<img width='100%' height='100%' src='images/art/works/medium/".$one_row["ImageFileName"].$imageFormat."'>";
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <!-- Including the script at the end to lazy load-->
    <?php include 'script_link.php';
    ?>

</body>
</html>