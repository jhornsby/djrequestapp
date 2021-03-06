<?php
include_once '../configuration.php';
include_once 'adminconfig.php';
include_once '../functions/functions.php';

// Don't want the menu to appear on these pages:
if ((curPageName()=="forgotpass.php") || (curPageName()=="resetpassword.php")) {
    return;
}

echo '<nav class="navbar navbar-static-top">';
echo '<div class="container-fluid">';
echo '<ul class="nav navbar-nav nav-pills">';
function level1Menu(){
echo '<li><a href="requests.php">All Requests</a></li>';
echo '<li><a href="user.php">Request Users</a></li>';
echo '<li><a href="password.php">Change Password</a></li>';
}

function level2Menu(){
echo '<li><a href="requests.php">All Requests</a></li>';
echo '<li><a href="user.php">Request Users</a></li>';
echo '<li><a href="admin.php">Events</a></li>';
echo '<li><a href="password.php">Change Password</a></li>';
}

function level3Menu(){
echo '<li><a href="requests.php">All Requests</a></li>';
echo '<li><a href="user.php">Request Users</a></li>';
echo '<li><a href="useradmin.php">System Users</a></li>';
echo '<li><a href="admin.php">Events</a></li>';
echo '<li><a  href="password.php">Change Password</a></li>';
}

$level = makeSafe($_COOKIE['adminlevel']);

switch ($level) {
    case 1:
        level1Menu();
        break;
    case 2:
        level2Menu();
        break;
    case 3:
        level3Menu();
        break;
}
//echo'<a href="logout.php" class="btn btn-danger btn pull-right" role="button">Log Out <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>';
echo '</ul>';
echo '<ul class="pull-right"><a href="logout.php"  class="btn btn-lg btn-danger" role="button">Log Out <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></ul>';
echo '</div>';
echo '</nav>';

?>

