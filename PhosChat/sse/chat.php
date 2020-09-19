<?php

// watch_chat();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
$my_string = read_shm();

/*
if (isset($_SESSION['t']))
   $log = var_src(glob("../auth/log/*"))." ".$_SESSION['t'];
else {
   $log = var_src(glob("../auth/log/*"));
}
*/

$log = "";
$NN = $_GET['NN'];
$GREP_CMD = 'grep \'"to":"'. $NN .'"\' -r --exclude=\*'. $NN .'\* ../auth/log';
$log = shell_exec($GREP_CMD);

$la = explode(":", $log);
$log = $log." ".$la[0];
     
// $log = "../auth/chat_log";

// $ftime = filemtime($log);

echo "data: The server time is: {$time} shm {$my_string}\n\n";

echo "data: NN={$_GET['NN']} file {$la[0]} watch {$log} shm {$my_string}\n\n";

echo "data: \n\n";

file_put_contents("o_log", json_encode($log));

system("rm ".$la[0]);

$_SESSION['t'] = $time;

flush();



function var_src($b)
{
//    return preg_replace("/\\s+/", " ", var_export($b, true)) . "\n";
    return preg_replace("/\\s+/", " ", var_export($b, true)) . " ";
}

function watch_chat()
{
// Open an inotify instance
$fd = inotify_init();

$log = "../auth/chat_log";
// Watch __FILE__ for metadata changes (e.g. mtime)
// $watch_descriptor = inotify_add_watch($fd, $argv[1], IN_ATTRIB);

$watch_descriptor = inotify_add_watch($fd, $log, IN_MODIFY);


// generate an event
// touch(__FILE__);

// Read events
$events = inotify_read($fd);
// print_r($events);
}

function read_shm()
{
// Create 100 byte shared memory block with system id of 0xff3
$shm_id = shmop_open(0xff3, "c", 0644, 100);
if (!$shm_id) {
    echo "Couldn't create shared memory segment\n";
}

// Get shared memory block's size
$shm_size = shmop_size($shm_id);
echo "SHM Block Size: " . $shm_size . " has been created.\n";

// Now lets read the string back
$my_string = shmop_read($shm_id, 0, $shm_size);
if (!$my_string) {
    echo "Couldn't read from shared memory block\n";
}
// echo "The data inside shared memory was: " . $my_string . "\n";
return $my_string;
}

?>

