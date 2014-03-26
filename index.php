<?php
include('conf/config.php');
include('prepare.php');
include('actions/check_login.php');
?>

<div id="wrapper">
    <div id="loginWrapper">
        <div id="loginBox">
            <form action="<?php print 'actions/login.php'; ?>" name="login" class="autopost" method="post"> 

                <span width="100%" class="text-center block"><img src="public/img/learn2earn.png" alt="Learn2earn" width="225px" height="30px"></span>
                <?php /* echo $_CONFIG['base_url']; */ ?> 
                <span class="float-left"><label for="username">Username:</label></span><span class="float-right"><input type="text" name="username" id="username" class="input required"/></span><br /><br />
                <span class="float-left"><label for="password">Password:</label></span><span class="float-right"><input type="password" name="password" id="password" class="input required" /></span><br /><br />
                <button class="autopostSubmit" value="login">Login!</button>
                <div id="login-result"></div>
            </form>
        </div>	 
    </div>
</div>

<?php include('parts/footer.php'); ?> 