<?php
    require_once('inc/authorize.php');
    $title = 'High Scores Administration';
    $h1_title ='High Scores Administration';
    $p_title = 'Below is a list of all chess Wars high Scores, Use this page to remove or approve scores as needed';
    include('inc/htmlHead.php');
?>

    <section class="display-screen">
        <div class="container d-grid">
    <?php

        require_once('inc/connectvars.php');
        require_once('inc/appvars.php');

        //connect to the DB
        $databases=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD)
        or die('error connecting to mysql server');
        mysqli_select_db($databases,DB_NAME)
        or die('unable to locate chess war databases');


        //Retrieve the score data from MYSQL
        $query="SELECT * FROM chesswar ORDER BY score DESC, date ASC";
        $data=mysqli_query($databases,$query);

        //loop through the array of score data, formating it as html
        echo '<table>';
        while($row=mysqli_fetch_array($data)){
    ?>
            <div class="cards">
                <?php 
                    if(is_file( GW_UPLOADPATH . $row['screenshot']) && filesize(  GW_UPLOADPATH . $row['screenshot'])>0){
                        echo '<img class="img-tag" src="'. GW_UPLOADPATH . $row['screenshot'] . '" alt="score image">';

                    }else{
                        echo '<img class="img-tag" src="'. GW_UPLOADPATH .'Unverified.png" alt="Unverified score">';
                    }
                ?>
                <div class="info d-flex">
                    <span>Score: <span class="value"><?php echo $row['score'] ?> </span></span>
                    <span>Name:  <span class="value"><?php echo $row['name']  ?> </span></span>
                    <span class="date"><?php echo $row['date']  ?>  </span>
                    <div class="btn-controller">
                        <?php echo '<a class="remove-btn" href="removescore.php?id=' . $row['id'] . ' &amp;date= ' . $row['date']. '&amp;name=' . $row['name'] . ' &amp;score=' . $row['score'] . ' &amp;screenshot=' . $row['screenshot'] . '">Remove</a>' ?>
                        <?php
                            if($row['approved'] == '0'){
                                echo '<a class="approve-btn" href="approved.php?id=' . $row['id'] . ' &amp;date= ' . $row['date']. '&amp;name=' . $row['name'] . ' &amp;score=' . $row['score'] . ' &amp;screenshot=' . $row['screenshot'] . '">Approve</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>  
        </div>
    </section>
</body>
</html>
