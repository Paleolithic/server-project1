<?php 
    $unemptySess = !empty($_SESSION['LoggedIn']) && !empty($_SESSION['UserName']); 

    if ($unemptySess) {
        $username       = $_SESSION['UserName'];

        $Query = $con->prepare("SELECT Type FROM users WHERE UserName = ?");
        $Query->bind_param('s', $username);
        $Query->execute();
        $res = $Query->get_result();
        $row = $res->fetch_assoc();
        $type            = $row['Type'];
    }
?>
<header>
    <div class='container'>
        <div class='sixteen columns'>
            <h2 class='left'>Plushie Planet</h2>
            <nav class='right'>
                <ul>
                    <li><a <?php if($current == "home") { echo("class='current'"); } ?> href='index.php'>HOME</a></li>
                    <li><a <?php if($current == "cart") { echo("class='current'"); } ?> href='cart.php'>CART</a></li>
                    
                    <?php if ($unemptySess && $type == 1) { ?>
                        <li><a <?php if($current == "admin"){ echo("class='current'"); } ?> href='admin.php'>ADMIN</a></li>
                        <li><a href='signout.php' class='account'>SIGN OUT</a></li>

                    <?php } elseif ($unemptySess) { ?>
                        <li><a href='signout.php' class='account'>SIGN OUT</a></li>
                    
                    <?php } else { ?>
                        <li><a <?php if($current == "login"){ echo("class='current account'"); } else{ echo("class='account'"); } ?> href='login.php'>LOGIN</a></li>
                        <li><a <?php if($current == "register"){ echo("class='current account'"); }  else{ echo("class='account'"); } ?> href='register.php'>SIGN UP</a></li>
                    
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</header>