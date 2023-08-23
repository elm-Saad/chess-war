<?php
    require_once('inc/authorize.php');
    $title = 'Remove Scores ';
    $h1_title ='<span>Remove</span> Scores Administration';
    $p_title = 'Below is a list of all chess Wars high Scores, Use this page to remove scores as needed';
    $action ='removescore.php';
    $AP_RE_choix = '<span>Remove</span>';
    include('inc/htmlHead.php');
    require_once('inc/connectvars.php');
    require_once('inc/appvars.php');

    // clicked on the remove url link from admin page 
    if( ( isset($_GET['id']) ) && ( isset($_GET['date']) ) && (isset($_GET['name']) ) && ( isset($_GET['score']) && ( isset($_GET['screenshot']) ) ) ){

        // grab the data
        $id = $_GET['id'];
        $date = $_GET['date'];
        $name = $_GET['name'];
        $score = $_GET['score'];
        $screenshot = $_GET['screenshot'];

    }
    else if( (isset($_POST['id'])) && (isset($_POST['score'])) && (isset($_POST['name'])) ){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $score = $_POST['score'];
        $screenshot = $_POST['screenshot'];
    }
    else {
        echo '<div class="container"><p class="error">Sorry no high score was specified for removal</p> </div>';
    }

    if(isset($_POST['submit'])){
        //Remove
        if($_POST['confirm'] =='yes'){
            //delete the screenshot image file from the server
            @unlink(GW_UPLOADPATH . $screenshot);

            //connect to the databases
            $databases=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD)
            or die('error connecting to mysql server');
            mysqli_select_db($databases,DB_NAME)
            or die('unable to locate guitar_war_db databases');

            //DELETE the score from the databases
            $query="DELETE FROM chesswar WHERE  id=$id LIMIT 1 ";
            mysqli_query($databases,$query);

            mysqli_close($databases);

            //confirm sucess 
            echo '<div class="container"><p class="success">The high score of ' . $score . ' for ' . $name .' was successfully removed</p></div>';
        }
        //do not remove 
        else{
            echo '<div class="container"><p class="error">the high score was not removed .</p></div>';
        }

    }else if(isset($id) && isset($name) && isset($date) && isset($score) &&  isset($screenshot)){

        //display the form 
        include('inc/formApproveRemove.php');
    }
    echo '<div class="container  back-to-admin-btn"><p><a href="Saad_Control_Panel.php">&lt;&lt; Back to admin page</a></p></div>';
?>

</body>
</html>