<?php
/**
 * @var $apple Apple
 */

use backend\models\Apple;

if (!$apple->isFalled) {
    echo '<div class="apple_tree"></div>';
}
?>
    <div class="apple_image">
        <div class="apple_color"
             style="width: <?php echo 100 - $apple->eaten ?>%; background-color: <?php echo $apple->colorCode ?>;">
        </div>
        <div class="apple_wrapper"></div>
    </div>
<?php
if ($apple->isFalled) {
    echo '<div class="apple_ground"></div>';
}