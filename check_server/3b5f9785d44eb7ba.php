<?php
require("../dao/function.php");
if(clean_submit())
{
    echo "ok";
}
else
{
    echo "error";
}

?>