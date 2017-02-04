<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Single Artist</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
</head>
<body>
<!--Include the navbar on every page-->
<?php include 'navbar.php';
?>

<?php include 'connection.php';
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/6/2016
 * Time: 3:47 PM
 */
//get the artist id
$artist_id = $_GET["id"];
$imageFormat = ".jpg";

//get the artist details
$sql = "SELECT * FROM artists where ArtistID=$artist_id";
$result = $conn->query($sql);

if($result->num_rows==0 || $result->num_rows<0){
    echo "<script type='text/javascript'>
        window.location.href = 'Error.php';
    </script>";
}



if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        echo "
        
        <div class='row'>  
        <div class='col-md-4' style='text-align: left;'>
        <h2 style='padding-left:50px'>" . utf8_encode($row["FirstName"]) . " " . utf8_encode($row["LastName"]) . " </h2>
        </div>
        </div>
        
        <div class='row'>        
        <!--This is the column for the artist pic and the artist name-->
        <div class='col-md-4' style='text-align: center'>
        <img src='images/art/artists/medium/".$artist_id.$imageFormat."' class='img-thumbnail'  width='304' height='236'>
        </div>
        
        <div class='col-md-6'>
        <p>" . utf8_encode($row["Details"]) . "</p>
        <a type='button' class='btn btn-default' style='color:#3BABEC;'> <span class='glyphicon glyphicon-heart'></span> Add to Favourite List</a>
        <br>
        <br>
        <div class='panel panel-default'>
        <div class='panel-heading'>
        <th>Artist Details</th>
        </div>
        <table class='table'>
         <tbody>
          <tr>
           <td>Date :</td>
           <td>" . $row["YearOfBirth"] . "-" . $row["YearOfDeath"] . "</td>
        </tr>
        <tr>
            <td>Nationality :</td>
            <td>". utf8_encode($row["Nationality"])."</td>
        </tr>
        <tr>
            <td>More Info:</td>
            <td><a href=".$row["ArtistLink"].">".$row["ArtistLink"]."</a></td>
        </tr>
        </tbody>
        </table>
    </div>
    </div>
    </div>
     <h3 style='padding-left:50px'>Art by ". utf8_encode($row["FirstName"]) . " " . utf8_encode($row["LastName"]) . "</h3>
    ";
    }
}

$sql2 = "SELECT ImageFileName,Title,YearOfWork,ArtWorkID FROM artworks where ArtistID=$artist_id";
$result = $conn->query($sql2);
$count = 0;
if ($result->num_rows > 0) {


    while ($row =$result->fetch_assoc()) {

       if($count%4==0){
           echo "<div style='padding-left: 50px' class='row'>";
       }

       echo "  
        <div class='col-md-3' style='padding: 20px' align='center'>
            <div class='thumbnail'>
            <a href='Part03_SingleWork.php?id=".$row["ArtWorkID"]."'>
            <img  src='images/art/works/square-thumbs/".$row["ImageFileName"].$imageFormat."' class='img-thumbnail' width='152' height='118'>
            <p>".utf8_encode($row["Title"]).",".utf8_encode($row["YearOfWork"])."</p>
            </a>
            <a type='button' class='btn btn-primary btn-sm' href='Part03_SingleWork.php?id=".$row["ArtWorkID"]."'>
                 <span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> View
            </a>
            <a type='button' class='btn btn-success btn-sm'>
                 <span class='glyphicon glyphicon-gift' aria-hidden='true'></span> Wish
            </a>
            <a type='button' class='btn btn-info btn-sm'>
                 <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Cart
            </a>
            </div>
        </div>
        ";

        $count++;

        if($count%4==0) {
            echo "</div>";
        }
    }
    echo "</div>";
}
?>
<!-- Including the script at the end to lazy load-->
<?php include 'script_link.php';
?>

</body>
</html>