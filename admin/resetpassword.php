<?php
include_once '../configuration.php';
include_once '../functions/functions.php';
$error=''; // Variable To Store Error Message
$ak=$_GET['ak'];
$id=$_GET['userid'];


$tm = time()-86400;
$conn = mysqli_connect($host, $username, $password, $db);
$id=mysqli_real_escape_string($conn, $id);
$ak=mysqli_real_escape_string($conn, $ak);

    $query = mysqli_query($conn, "SELECT id FROM systemUserKey WHERE pkey='$ak' AND id='$id'  AND time > '$tm' AND status='pending'");
    $rows = mysqli_num_rows($query);
    if ($rows <> 1) {
                         echo "Wrong activation";
                         exit;
                    }
//password resetting form will go here

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DJ Request System Administration</title>
<meta name="keywords" content=""/>
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function(){
        // Function for loading the grid
        function LoadGrid() {
                var gridder = $('#as_gridder');
                var UrlToPass = 'action=load';
                gridder.html('loading..');
                $.ajax({
                        url : 'resetpasswordajax.php',
                        type : 'POST',
                        data : UrlToPass,
                        success: function(responseText) {
                                gridder.html(responseText);
                        }
                });
        }


        LoadGrid(); // Load the grid on page loads

        // Same as the above blur() when user hits the 'Enter' key
        $('body').delegate('.gridder_input', 'keypress', function(e){
                if(e.keyCode == '13') {
                        var ThisElement = $(this);
                        ThisElement.hide();
                        ThisElement.prev('span').show().html($(this).val()).prop('title', $(this).val());
                        var UrlToPass = 'action=update&value='+ThisElement.val()+'&crypto='+ThisElement.prop('name');
                        $.ajax({
                                url : 'passwordajax.php',
                                type : 'POST',
                                data : UrlToPass
                        });
                }
        });
        // Pass the values to ajax page to add the values
        $('body').delegate('#changepassword', 'click', function(){
                // Do insert validation here
                // Pass the form data to the ajax page
                var data = $('#changepassform').serialize();
                $.ajax({
                        url : 'resetpasswordajax.php',
                        type : 'POST',
                        data : data,
                        success: function(data) {
                            if(data.status.indexOf("sqlerror") >=0) {
                                alert ("SQL error.");
                                return false;
                            }
                                LoadGrid();
                        }
                });
                return false;
        });
});
</script>
</head>

<body>
<div class="as_wrapper">
<div id="logo">&nbsp;</div>
<?php echo "Welcome, " . $adminrealname; ?>
        <h1 class="h1"><a href="">Change Your Password</a></h1>
        <div class="as_grid_container">
            <div class="as_gridder" id="as_gridder"></div> <!-- GRID LOADER -->
        </div>
</div>
</body>
</html>

