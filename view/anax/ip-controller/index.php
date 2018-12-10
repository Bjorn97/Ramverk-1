<?php

namespace Anax\View;

?>
<div class="wrapper_ip">
    <form class="ip-test" method="get">
        <legend>ip</legend>
        <input type="text" name="ip" value="<?=$default?>"><br>
        <input type="submit" name="submit" value="validate"><br>
    <p><?= $res; ?></p><br>
    <p><?php 
    if ($num == 1) {
            echo(gethostbyaddr($adress));
    }
    ?>
    </p>
    <p><?php
    if ($location != "") {
        echo("type: " . $location->{'type'} . " country: " . $location->{'country_name'} .
        " city: " . $location->{'city'} . " Longitude: " .
        $location->{'longitude'} . " latitude: " . $location->{'latitude'});
    }
    ?>
    </p>

    <a href="<?= url("ipJSON?ip=1.1.1.1")?>">test 1.1.1.1</a><br>
    <a href="<?= url("ipJSON?ip=400.255.400.255")?>">test 400.255.400.255</a><br>
    <a href="<?= url("ipJSON?ip=2001%3a0db8%3a85a3%3a0000%3a0000%3a8a2e%3a0370%3a7334")?>">test 2001:0db8:85a3:0000:0000:8a2e:0370:7334.</a><br>

    <a href="ipJSON">api page</a>
</div>
<div class="wrapper_info">
    <div class="info1"><b>get:</b><p> Route to ipJSON</p> </div>
    <div class="info1"><b>input:</b><p> IP - address</p> </div>
    
</div>
