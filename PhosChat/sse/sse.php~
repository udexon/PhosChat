<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = date('r');
$my_string = read_shm();
echo "data: The server time is: {$time} shm {$my_string}\n\n";
flush();


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

