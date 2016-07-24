<?php
/* config.php */
function dbcon()
{
    @mysql_connect("localhost", "root", "") or die(mysql_error());
    @mysql_select_db("interact") or die(mysql_error());
}
?>