<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ArtistList</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
</head>
<body>

<!--Include the navbar on every page-->
<?php include 'navbar.php';
?>

<h1 style='padding-left: 50px'><u>Artists Data Lists</u></h1>
<?php include 'connection.php';
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/6/2016
 * Time: 3:47 PM
 */
$sql = "SELECT ArtistID,FirstName,LastName,YearOfBirth,YearOfDeath FROM artists ORDER BY LastName";
$result = $conn->query($sql);
$count = 1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $artist_id = $row["ArtistID"];
        echo "<a style='padding-left: 50px' href='Part02_SingleArtist.php?id=$artist_id'>".utf8_encode($row["FirstName"])." ".utf8_encode($row["LastName"])."(".$row["YearOfBirth"]."-".$row["YearOfDeath"].")"."</a><br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!-- Including the script at the end to lazy load-->
<?php include 'script_link.php';
?>

</body>
</html>