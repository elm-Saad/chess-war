<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" type="image/svg" href="images/logo.png">
    <link  rel="stylesheet" href="CSS/adminStyle.css">
    <link  rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/display.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script defer src="JS/app.js"></script>


</head>
<body>
    <?php 
        include('inc/navbar.php');
    ?>
    <section>
        <div class="container">
            <h1><?php echo $h1_title ?> </h1>
            <p> <?php echo $p_title  ?></p>
        </div>
    </section>
    <hr/>