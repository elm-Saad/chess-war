<section>
    <div class="container form ">
        <h3>Are you sure you want to <?php echo $AP_RE_choix ?> the following high score ?</h3>
        <div class="info">
            <div class="d-flex box-style">
                <span>name</span>
                <span>Date</span>
                <span>Score</span>
            </div>
            <div class="d-flex box-style">
                <span><?php echo $name ?></span>
                <span><?php echo $date ?></span>
                <span><?php echo $score ?></span>
            </div>
        </div>
        <form class="d-flex" method="post" action="<?php echo $action ?>">
            <label for="yes">Yes</label>
            <input type="radio" name="confirm" value="yes" id="yes">
            <label for="NO">No</label>
            <input type="radio" name="confirm" value="No" checked="checked" id="no">
            <input type="submit" name="submit" value="submit" >

            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="name" value="<?php echo $name ?>">
            <input type="hidden" name="score" value="<?php echo $score ?>">
            <input type="hidden" name="screenshot" value="<?php echo $screenshot ?>">

        </form>
    </div>
</section>