<?php

use common\models\Apple;

/** @var Apple $apple */
if (!$apple->isFalled) {
    echo '<div class="apple_tree"></div>';
}
?>
    <div class="apple_image">
        <div class="apple_color"
             style="width: <?= 100 - $apple->eaten ?>%; background-color: <?= $apple->colorCode ?>;">
        </div>
        <div class="apple_wrapper"></div>
    </div>
<?php
if ($apple->isFalled) {
    echo '<div class="apple_ground"></div>';
}