<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
    <style>
        .searchBackground {
            padding: 10px 13px;
            margin-bottom: 14px;
            background-color: #e8e8ee;
            border: 1px solid #c4c4d2;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<!-- Including the script at the end to lazy load-->
<?php include 'script_link.php';
?>
<!--Include the navbar on every page-->
<?php include 'navbar.php';
?>
<!--Search  Result UI-->
<div class="container">
    <div class="row">
        <h1>Search Results</h1>
        <!--show the ruler-->
        <hr>
        <div class="searchBackground">
            <input type="radio" id="TitleRadioButton"
                             value="1"
                             name="filter" "> Filter by Title : <br>
            <input type="text" id="title" class="form-control" style="display: none"/>
            <br />
            <input type="radio" id="DescRadioButton"
                   value="2"
                   name="filter"> Filter by Description : <br>
            <input type="text" id="desc" class="form-control" style="display: none"/>
            <br />
            <input type="radio" id="NoFilterRadioButton"
                   value="3"
                   name="filter"> No Filter (show all artworks) : <br>
            <!--<input type="text" id="nofilter" class="form-control" style="display: none"/>-->
            <br/>
            <button id="filterButton" class="btn btn-primary">Filter</button>

        </div>
        <?php include 'connection.php';
        $title = filter_input(INPUT_GET,'title',FILTER_SANITIZE_SPECIAL_CHARS);
        $desc = filter_input(INPUT_GET,'desc',FILTER_SANITIZE_SPECIAL_CHARS);
        $nofilter = filter_input(INPUT_GET,'nofilter',FILTER_SANITIZE_SPECIAL_CHARS);
        if($title!=null && $title!=""){
            //set the radio button value and the description text field
            echo "<script type='text/javascript'>
                $(document).ready(function() {
                  $('#TitleRadioButton').prop('checked', true);
                  $('#title').css('display','block');
                  $('#title').val('".$title."')
                })
            </script>";
            $sql_query ="SELECT Title, Description, ImageFileName, ArtWorkID FROM ArtWorks WHERE Title LIKE '"."%".$title."%'";
        }else if ($desc!=null && $desc!=""){
            //set the radio button value and the description text field
            echo "<script type='text/javascript'>
                $(document).ready(function() {
                  $('#DescRadioButton').prop('checked', true);
                  $('#desc').css('display','block');
                  $('#desc').val('".$desc."');
                })
            </script>";
            $sql_query = "SELECT Title, Description, ImageFileName, ArtWorkID FROM ArtWorks WHERE Description LIKE '"."%".$desc."%'";
        }else if ($nofilter!=null && $nofilter!=""){
            //set the radio button value and the description text field
            echo "<script type='text/javascript'>
                $(document).ready(function() {
                  $('#NoFilterRadioButton').prop('checked', true);
                })
            </script>";
            $sql_query = "SELECT Title, Description, ImageFileName, ArtWorkID FROM ArtWorks";
        }





        $imageFormat = ".jpg";
        if($title!=null || $desc!=null || strcmp($nofilter,'all')==0){
            $result = $conn->query($sql_query);

            //Highlight the words in the description
            $tempArray = array();
            while($row = $result->fetch_assoc()){
                $tempArray[] = $row;
            }

            for($i=0;$i<count($tempArray);$i++){
                $description = utf8_encode($tempArray[$i]["Description"]);
                $description = str_replace(utf8_encode($desc),"<span style='background:yellow '>".$desc."</span>",utf8_encode($description));
                $tempArray[$i]["Description"] = $description;
                echo "
                <div class='row' style='padding: 10px;'>
                    <div class='col-md-2' style='text-align: left'>
                       <a href='Part03_SingleWork.php?id=".$tempArray[$i]["ArtWorkID"]."'><img src='images/art/works/square-medium/".$tempArray[$i]["ImageFileName"].$imageFormat."' ".$tempArray[$i]["Title"]." /></a>
                    </div>
                    <div class='col-md-6' style='text-align:left'>
                       <a href='Part03_SingleWork.php?id=".$tempArray[$i]["ArtWorkID"]."'>".utf8_encode($tempArray[$i]["Title"])."</a>
                            <p>".utf8_encode($tempArray[$i]["Description"])."</p> 
                    </div>
               </div>
                   ";
            }
        }
        ?>
    </div>
</div>
</body>
</html>
