<html <?php language_attributes(); ?>>

<head>
    <title>Dynomapper Login</title>
</head>
<body>

        <div id="wrap">
            <form name="dn-login" id="dn-login" method="post"
                  action="<?php echo home_url() . '/?login=dynomapper-login'; ?>">
                <p>
                    <label for="user_login">Username<br>
                        <input name="username" id="username" class="input" value="" size="20" type="text"></label>
                </p>

                <p>
                    <label for="user_pass">Password<br>
                        <input name="password" id="password" class="input" value="" size="20" type="password"></label>
                </p>

                <p class="submit">
                    <input name="dn-submit" id="dn-submit" value="Log In" type="submit">
                </p>
            </form>
        </div>


</body>
</html>