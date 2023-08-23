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
    </div>
    <svg viewBox="0 0 20 20" preserveAspectRatio="xMidYMid meet" focusable="false" style="pointer-events: none; display: block; width:30px; height: 30px;">
        <g>
            <path d="M10,1 L18,4.27272727 L18,9.18181818 C18,13.7227273 14.5866667,17.9690909 10,19 C5.41333333,17.9690909 2,13.7227273 2,9.18181818 L2,9.18181818 L2,4.27272727 L10,1 Z M13.57,6.38363636 L8.44444444,11.7754545 L6.43,9.66454545 L5.33333333,10.8181818 L8.44444444,14.0909091 L14.6666667,7.54545455 L13.57,6.38363636z">
            </path>
        </g>
    </svg>
</div>