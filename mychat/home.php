<!DOCTYPE html>
<?php
session_start();
include("include/connection.php");

if (!isset($_SESSION['user_email'])) {
	header("location: signin.php");
}
else{ ?>
<html>
    <head>
    	<title>WebiChat - Home</title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	    <!-- jQuery library -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	    <!-- Latest compiled JavaScript -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/home.css">
    </head>
    <body>
        <div class="container main-section">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-sx-12 left-sidebar">
                    <div class="input-group searchbox">
                        <div class="input-group-btn">
                            <center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add new user</button></a></center>
                        </div>
                    </div>
                    <div class="left-chat">
                        <ul>
                            <?php 
                                include("include/get_users_data.php");
                            ?>
                        </ul>
                    </div>
                </div> 
                <div class="col-md-9 col-sm-9 col-xs-12 col-xs-12 right-sidebar">
                    <div class="row">
                        <!-- Getting the user information who is logged in -->
                        <?php 
                            $user = $_SESSION['user_email'];
                            $get_user = "SELECT * FROM users WHERE user_email='$user'";
                            $run_user = mysqli_query($con, $get_user);
                            $run = mysqli_fetch_array($run_user);

                            $user_id = $run['user_id'];
                            $user_name = $run['user_name'];
                        ?>
                        <!-- getting the user data on which user click -->
                        <?php 
                            if (isset($_GET['user_name'])) {
                                
                                global $con;

                                $get_username = $_GET['user_name'];
                                $get_user = "SELECT * FROM users WHERE user_name='$get_username'";

                                $run_user = mysqli_query($con, $get_user);

                                $row_user = mysqli_fetch_array($run_user);

                                $username = $row_user['user_name'];
                                $user_profile_image = $row_user['user_profile'];
                            }

                            $total_messages = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                            $run_messages = mysqli_query($con, $total_messages);
						    $total = mysqli_num_rows($run_messages);
                        ?>
                        <div class="col-md-12 right-header">
                            <div class="right-header-img">
                                <img src=<?php echo "$user_profile_image"; ?> alt="Profile Picture">
                            </div>
                            <div class="right-header-detail">
                                <form method="post">
                                    <p><?php echo "$username";  ?></p>
                                    <span><?php echo $total; ?> messages</span>&nbsp &nbsp
                                    <a style="margin=5px; padding=5px; background-color=white;" href="signin.php">Logout</a>
                                </form>
                                <?php
                                    if (isset($_POST['logout'])) {
                                        $update_msg = mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_name='$user_name'");
                                        
                                        exit();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                                    <?php
                                        $update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status='read' WHERE sender_sername='$username' AND receiver_username='$user_name'");

                                        $sel_msg = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER BY 1 ASC";

                                        $run_msg = mysqli_query($con, $sel_msg);

                                        while ($row = mysqli_fetch_array($run_msg)) {
                                            $sender_username = $row['sender_username'];
                                            $receiver_username = $row['receiver_username'];
                                            $msg_content = $row['msg_content'];
                                            $msg_date = $row['msg_date'];
                                        
                                    ?>
                                    <ul>
                                            <?php
                                                if ($user_name == $sender_username AND $username == $receiver_username) {
                                                    echo "
                                                        <li>
                                                            <div class='rightside-right-chat'>
                                                                <span> $username <small>$msg_date</small></span><br><br>
                                                                <p>$msg_content</p>
                                                        </li>
                                                    ";
                                                }
                                                else if ($user_name == $receiver_username AND $username == $sender_username) {
                                                    echo "
                                                        <li>
                                                            <div class='rightside-left-chat'>
                                                                <span> $username <small>$msg_date</small></span><br><br>
                                                                <p>$msg_content</p>
                                                        </li>
                                                    ";
                                                }
                                            ?>
                                    </ul>
                                    <?php
                                        }
                                    ?>
                        </div>
                    </div>
                    <div class="row"> 
                <div class="col-md-12 right-chat-textbox">
                    <form method="post">
                        <input autocomplete="off" type="text" name="msg_content" placeholder="Write Your Message Here.....">
						<button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                    </form>
                </div>          
            </div>
        </div>

		<?php
			if (isset($_POST['submit'])) {
				$msg = htmlentities($_POST['msg_content']);

				if ($msg == "") {
					echo "
						<div class='alert alert-danger'>
							<strong><center>Message was unable to send</center></strong>
						</div>
					";
				}

				else if (strlen($msg) > 100) {
					echo "
						<div class='alert alert-danger'>
							<strong><center>Message is TOO LONG. Use only 100 characters</center></strong>
						</div>
					";
				}

				else {
					$insert = "INSERT INTO users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date) VALUES ('$user_name', '$username', '$msg', 'unread', NOW());";

					$run_insert = mysqli_query($con, $insert);
				}
			}	
		?>

		<script>
			$('#scrolling_to_bottom').animate({
				scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				var height = $(window).height();
				$('.left-chat').css('height', (height - 92) + 'px');
				$('.right-header-contentChat').css('height', (height - 163) + 'px')
			});
		</script>

    </body>
</html> 
<?php } ?>