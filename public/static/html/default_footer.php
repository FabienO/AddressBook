        </div>
        <?php
        if(!empty($js_inc)) {
            foreach($js_inc as $js) {
                ?><script type="text/javascript" src="static/js/views/<?php echo $js; ?>.js"></script><?php
            }
        } ?>
    </body>
</html>
