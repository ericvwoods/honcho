<?php
/* Flash message in the Honcho colours (flashmsgcolor 1 = green, 0 = red).
   In v2, flashdata() clears itself after it is shown. */
$pm_flash_colour = (($_SESSION['flashmsgcolor'] ?? 1) == 1) ? 'lightseagreen' : 'crimson';
?>
<center><?= flashdata('<div style="font-weight: bold; font-size: 20px; color: ' . $pm_flash_colour . ';">', '</div>') ?></center>
