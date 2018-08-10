<?php
$myfile = fopen("logs/logs.txt", "r") or die("Unable to open file!");
// echo fread($myfile,filesize("logs/logs.txt"));
$newEntry = false;
while(!feof($myfile)) {
    $nl = fgets($myfile);
    // $line = -1;
    // var_dump($test);
    // preg_match('^[0-9]{2}-[0-9]{2}-[0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$',$test,$yes);
    preg_match('/\d{4}-\d{2}-\d{2} \d{1,2}:\d{2}:\d{2}/', $nl, $date);
    // if(preg_match('^[0-9]{2}-[0-9]{2}-[0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$',$test)){
    //         echo '<br><br>DATE<br><br>';
    // }else {
    //     echo 'nope';
    // }
    // $entry = "";
    if(!empty($date)) {
        $newEntry = true;
        // $line = 0;
        // $entry = $date[0] . "<br>";
        $entry = "";
    }
    if($newEntry){
        // echo '1';
        // var_dump($nl);
        // echo '<br>';
        if(trim($nl) === '///end of entry///'){
            // echo '2';
            $newEntry = false;
            echo $entry . '<br>';
        } else {
            // echo '3';
            if (strpos($nl, 'message from') === 0) {
                if(strpos($nl, 'Mr') === 0 || strpos($nl, 'Ms') === 0) {
                    $nl = substr($nl, 15);
                }else {
                    $nl = substr($nl, 16);
                }
                // $nl=explode("(",$nl);
                // $nl = $nl[0];
                // $nl=explode(" ",$nl);
                // $nl = $nl[0];
                $nl = explode("(",explode(" ",$nl)[0])[0];
            }
            $entry .= $nl . '<br>';
        }
        // if($line === 0) {
        //     $entry = 'substr<br>';
        //     $line ++;
        // }
        // if($line === 1) {
        //     $entry .= 'Subject :<br>';
        //     $line ++;
        // }
        // if($line === 2) {
        //     $entry .= $nl . '<br>';
        //     $line ++;
        // }
        // if($line === 3) {
        //     echo 'Message :<br>';
        //     $line ++;
        // }
        // if($line > 3) {
        //     echo 'Message<br>';
            // while($nl != $date[0]) {
            //     echo $nl;
            //     $line++;
            // }
        //     $newEntry = false;
        // }
    // var_dump($nl);
    // echo $entry;
    }
    // var_dump($date);
    // echo '<br>';
    // echo $date[0] . "<br>";
    // echo $test . "<br>";
}
fclose($myfile);
?>