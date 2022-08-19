
<?php
//Before
CONST testConstanta = 'asd';
$user_name = "Igor";

function show_something(){ RETURN 'SOMETHING';}

if (1==1) echo 'hi';

?>

<?php
//Config file input
include 'config.php';//Igor is global so its in config php

//Constanta for test using
const TEST_CONSTANTA = 'asd';

/*
Function smt do smt
@No input
@No return
*/
function show_something_n(){
	return 'SOMETHING';
}

if  (true){
	echo 'hi';
}

?>