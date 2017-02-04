<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
<meta charset="UTF-8">
<title>Assignment3 Default</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
</head>
<body>
<!--this is the content for the nav bar-->
<!--Include the navbar on every page-->
<?php include 'navbar.php';
?>
<!--this is the content for middle section of the page-->
<div class="jumbotron">
    <div style="padding-left: 20px; ">
        <h1>Welcome to Assignment #3</h1>
        <p>This is the third assignment by Pratik Palashikar for CSE5335</p>
    </div>
</div>
<div class="row">
    <div class="col-md-2 col-md-offset-1"><h3><span class="glyphicon glyphicon-info-sign"> </span>About Us</h3><p>What this is all about and other stuff</p>  <a href="AboutUs.php" type="button" class="btn btn-default" ><span class="glyphicon glyphicon glyphicon-link">VisitPage</span></a>
    </div>
    <div class="col-md-2"><h3><span class="glyphicon glyphicon-list"> </span>Artist List</h3><p>Displays artist name as links</p>  <a href="Part01_ArtistsDataList.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-link">VisitPage</span></a>
    </div>
    <div class="col-md-2"><h3><span class="glyphicon glyphicon-user"> </span> Single Artist</h3><p>Displays information for a single artist</p>  <a href="Part02_SingleArtist.php?id=19" type="button" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-link">VisitPage</span></a>
    </div>
    <div class="col-md-2"><h3><span class="glyphicon glyphicon-picture"> </span> Single Work</h3><p>Displays information for a single work</p>  <a href="Part03_SingleWork.php?id=394" type="button" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-link">VisitPage</span></a>
    </div>
    <div class="col-md-2"><h3><span class="glyphicon glyphicon-search"> </span> Search</h3><p>Perform search on artwork <tables></tables></p>  <a href="Part04_Search.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-link">VisitPage</span></a>
    </div>
</div>


<!-- Including the script at the end to lazy load-->
<?php include 'script_link.php';
?>

</body>
</html>