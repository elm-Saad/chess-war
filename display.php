<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess warrior</title>
    <link rel="shortcut icon" type="image/svg" href="images/logo.png">
    <link  rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/display.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script defer src="JS/app.js"></script>


</head>
<body>
    <?php 
        include('inc/navbar.php'); 
        require_once('inc/connectvars.php');
        require_once('inc/appvars.php');

        //Connect to DB 
        $databases=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD)
        or die('Error Connecting To The Server');
        mysqli_select_db($databases,DB_NAME)
        or die('Unable To Locate The DB');

        //get data 
        $query="SELECT * FROM chesswar WHERE approved = 1 ORDER BY score DESC, date ASC LIMIT 50";//must be ORDERED
        $data=mysqli_query($databases,$query);

        $row=mysqli_fetch_array($data);
        echo '<div class="container topscoreheader"><span>' . $row['score'] . '</span> <span class="tag">Top Score </span></div>';

    ?>
    <main>
        <section class="display-screen">
            <div class="container d-grid">
                <?php
                    include('inc/displaedCard.php');
                    $i=0;
                    while($row=mysqli_fetch_array($data)){
                        include('inc/displaedCard.php');
                    $i++;
                    }
                    mysqli_close($databases);
                ?>
            </div>
        </section>
    </main>
    <?php include('inc/footer.php') ?>
    <div class="addbox-bg d-flex-center" title="add your High Score" >
        <a class="d-flex-center" href="addscore.php">
            <svg width="20" height="20" xmlns="https://www.w3.org/2000/svg">
                <path d="M10 0.244141C9.58579 0.244141 9.25 0.579043 9.25 0.992167V9.22046H1C0.585786 9.22046 0.25 9.55536 0.25 9.96848C0.25 10.3816 0.585786 10.7165 1 10.7165H9.25V18.9448C9.25 19.3579 9.58579 19.6928 10 19.6928C10.4142 19.6928 10.75 19.3579 10.75 18.9448V10.7165H19C19.4142 10.7165 19.75 10.3816 19.75 9.96848C19.75 9.55536 19.4142 9.22046 19 9.22046H10.75V0.992167C10.75 0.579043 10.4142 0.244141 10 0.244141Z" fill-rule="evenodd">
                </path>
            </svg>
        </a>
    </div>
</body>
</html>