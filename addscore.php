<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess warrior</title>
    <link rel="shortcut icon" type="image/svg" href="images/logo.png">
    <link  rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/addscore.css" >
    <link rel="stylesheet" href="CSS/display.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script defer src="JS/app.js"></script>


</head>
<body>
    <?php
        include('inc/navbar.php');
        require_once('inc/connectvars.php');
        require_once('inc/appvars.php');


        if(isset($_POST['submit'])){
            //connect to DB
            $databases=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD)
            or die('error connecting to mysql server');
            mysqli_select_db($databases,DB_NAME)
            or die('unable to locate guitar_war_db databases');

            //grab the data
            $name=mysqli_real_escape_string($databases,trim($_POST['name']));
            $score=mysqli_real_escape_string($databases,trim($_POST['score']));
            $screenshot=mysqli_real_escape_string($databases,trim($_POST['name'])) . time();;

            $screenshot_size=$_FILES['screenshot']['size'];
            $screenshot_type=$_FILES['screenshot']['type'];

            //check the CAPTCHA pass-phrase verification 
            $user_pass_phrase = sha1($_POST['verify']);
            if($_SESSION['pass_phrase'] == $user_pass_phrase){
                if(!empty($name) && is_numeric($score) && !empty($screenshot)){
                    // make sure that upload files are type img and less than 200 KB 
                    if( ( ($screenshot_type == 'images/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png') ) && ($screenshot_size > 0 ) && ($screenshot_size <= GW_MAXFILESIZE)){
                        if($_FILES['screenshot']['error'] == 0) {//check for upload error

                            //Move the file to the target upload folder
                            $target=GW_UPLOADPATH . $screenshot;
                            if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)){
                                //write the data to the database
                                $query="INSERT INTO chesswar ( date , name , score , screenshot ) VALUES (NOW(),'$name','$score','$screenshot')";
                                mysqli_query($databases,$query);
                                ?>
                                <div class="container ">
                                    <div class="cards card">
                                        <?php echo '<img class="img-tag" src="'. GW_UPLOADPATH . $screenshot . ' " alt="score image">'; ?>
                                        <div class="info d-flex">
                                            <span>name: <span class="value"><?php echo $name ?> </span></span>
                                            <span>score:  <span class="value"><?php echo $score  ?> </span></span>
                                        </div>
                                        <svg id="approved-check" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" style=" display: block; width: 30px; height: 30px;">
                                            <g viewBox="0 0 24 24">
                                                <linearGradient id="selectedGradient" gradientTransform="rotate(314.2)">
                                                    <stop offset="8.49%" stop-color="var(--selected-gradient-color1, currentColor)"></stop>
                                                    <stop offset="43.72%" stop-color="var(--selected-gradient-color2, currentColor)"></stop>
                                                    <stop offset="99.51%" stop-color="var(--selected-gradient-color3, currentColor)"></stop>
                                                </linearGradient>
                                                <path d="M16.867 17.3558C17.025 17.1659 17.0563 16.8706 16.9717 16.5861L16.4961 15.2266C17.3705 14.5616 18.4028 13.7068 19.4032 12.5041C22.9729 8.08367 21.3762 2.79302 21.3022 2.62442C21.2176 2.33986 20.9011 2.0766 20.6059 2.04524C20.4267 2.00324 17.2427 1.71099 14.1238 3.40058L14.0711 3.46388C13.0702 4.02353 12.1431 4.75179 11.248 5.8279C10.2477 7.03062 9.53182 8.14873 9.04789 9.24555L7.67716 8.96218C7.38195 8.93082 7.0974 9.01542 6.93944 9.20532L3.24255 12.8774C3.03194 13.1306 2.94793 13.4891 3.03253 13.7736C3.04318 13.8896 3.16978 13.9949 3.29638 14.1002C3.42298 14.2055 3.66554 14.3001 3.78149 14.2895L8.74676 14.2428C8.74676 14.2428 8.74676 14.2428 8.86272 14.2321C8.86272 14.2321 8.86272 14.2321 8.92602 14.2848C8.92602 14.2848 9.62173 14.2209 10.4446 14.9054C11.3309 15.6425 11.3841 16.2223 11.3841 16.2223C11.3947 16.3382 11.4054 16.4542 11.4793 16.6228L12.3797 21.3342C12.401 21.5661 12.5276 21.6714 12.6543 21.7768C12.7809 21.8821 12.8442 21.9347 13.0234 21.9767C13.3819 22.0607 13.7191 21.9128 13.8664 21.607L16.867 17.3558ZM19.8167 3.63782C19.9439 4.38619 20.135 5.83028 19.7676 7.55951L15.9696 4.40038C17.603 3.72419 19.0577 3.64906 19.8167 3.63782ZM7.82624 10.5855L8.41666 10.6482C8.19599 11.4285 8.08063 12.0823 8.00727 12.5567L5.78286 12.5271L7.82624 10.5855ZM9.66255 12.7555C9.79862 11.6906 10.3027 9.53958 12.5141 6.88094C13.0932 6.18464 13.7464 5.65693 14.4628 5.18188L19.4002 9.28875C19.1163 10.0164 18.7164 10.7547 18.0845 11.5143C15.8731 14.173 13.8499 15.0604 12.8276 15.3881C12.6057 14.8823 12.2046 14.3345 11.5083 13.7553C10.812 13.1761 10.137 12.8289 9.66255 12.7555ZM13.1453 16.9375C13.5984 16.7789 14.2202 16.5464 14.9473 16.1874L15.1798 16.8091L13.5269 19.1826L13.1453 16.9375ZM4.99899 19.9073C4.61919 19.5914 4.57659 19.1276 4.89251 18.7478L7.63042 15.4561C7.94633 15.0763 8.41014 15.0337 8.78995 15.3496C9.16975 15.6656 9.21235 16.1294 8.89643 16.5092L6.15852 19.8008C5.89526 20.1173 5.31549 20.1706 4.99899 19.9073ZM7.95047 19.5778C7.57066 19.2619 7.52807 18.7981 7.84398 18.4183L9.21294 16.7724C9.52885 16.3926 9.99266 16.35 10.3725 16.6659C10.7523 16.9819 10.7949 17.4457 10.479 17.8255L9.11 19.4713C8.84674 19.7878 8.33027 19.8937 7.95047 19.5778Z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <script src='JS/popUp.js'></script>
                                <?php                  
                                // Clear the score data to clear the form 
                                $name="";
                                $score="";
                                $screenshot="";
                                mysqli_close($databases);
                            }
                            else{
                                echo '<div class="container"><p class="error">Sorry, there was a problem uploading your screen shot image.</p></div>';
                            }
                        }
                    }
                    else {
                        echo '<div class="container"><p class="error ">the screen shot must be a GIF, JPEG, or PNG image file no ' . 
                        ' greater than 190 KB in size </p></div>';
                    }
                    //delete the temprary screen shot image file 
                    @unlink($_FILES['screenshot']['tmp_name']);
                }else{
                    echo '<div class="container"><p class="error"> Please enter all of the information Correctly to add your high score. </p></div>';
                }   
            }
            else{
                 echo '<div class="container"><p class="error"> Please enter the verification pass-phrase exactly as shown </p></div>';
            }
        }
    ?>  
<div class="container add-form">
    <h2>ADD score</h2>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="MAX_FILR_SIZE" value="199668">
        <div class="left">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="enter your name" value="<?php if(!empty($name)) echo $name;  ?>"> <br>
            <label for="score">score:</label>
            <input type="text" id="score" name="score" placeholder="enter your score" value="<?php if(!empty($score)) echo $score;  ?>">
            <input type="file" name="screenshot" id="screenshot"><br>
        </div>
        <div class="right">
            <label for="verify">verification: </label>
            <input type="text" name="verify" id="verify" placeholder="Enter the pass-phrase">
            <img src="captcha.php" alt="verification pass-phrase">
            <input type="submit" value="Add" name="submit">
        </div>
    </form>
</div>

</body>
</html>