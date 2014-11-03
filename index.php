<?php
/** query2view reads a flatfile of and then displays output, or error if the
 *  necessary id is not passed. stealth by default, not noise.
 *  
 *  example: /query2view/?_id=default&my-heading1&another-heading-in-order
 *
 */

include_once '../lib/shared.php';
include_once '../lib/file.php';
include_once '../lib/file-updates.php';
include_once '../lib/header.php';

?>
<div class="wrapper">
<?php

$db = '../query2update/db/' . $configs['_id'] . '.csv';
$updates = get_updates( $db );
if ( FALSE == $updates )
{
    echo '<h4 class="alert alert-danger">Could not read updates.</h4>' . "\n";
} else {

    $inputs = array("_time" => $now,"_ip" => $configs['_ip']) + $inputs;

    $headers = array_keys($inputs);

    $body_display = 
        '<table class="table table-striped table-bordered table-hover">' . 
        "\n";
    $body_display .= get_updates_table( $updates, $headers );
    $body_display .= "</table>\n";

    echo $body_display;
}

?>

</div>
<?php

include_once '../lib/footer.php';
