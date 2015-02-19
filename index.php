<?php
    /**
     * Plugin Name: DYNO Mapper Login
     * Plugin URI: https://wordpress.org/plugins/dyno-mapper-login/
     * Description: Create simple Login page
     * Version: 1.0
     * Author: Dynomapper
     * Author URI: http://dynomapper.com
     */

    /**
     * DynomapperLogin Class
     */

    if (!class_exists('DynomapperLogin')) {

        class DynomapperLogin {


            /**
             * @var string Page Slug
             */
            public $queryParam = 'dynomapper-login';


            /**
             * Constructor
             */
            public function __construct() {

                // action to Create page if not exist
                add_action(
                    'init',
                    array($this, 'dynoMapperLoginPage')
                );

            }

            /**
             * Auto Login WP User
             * @param $username
             * @param $password
             *
             * @return array
             */
            public function dynomapperLogin( $username, $password) {

                $user = wp_authenticate($username, $password);
                if ( is_wp_error($user) ){
                    return array('code' => 0, 'message' => 'Failed');
                }else {
                    // Set auth cookies
                    wp_clear_auth_cookie();
                    wp_set_current_user($user->ID);
                    wp_set_auth_cookie($user->ID);
                    return array('code' => 1, 'message' => 'Success');
                }
            }


            /**
             *  Display Login Page if query = ?login=dynomapper-login
             */
            public function dynoMapperLoginPage() {

                // Do Nothing if user already Logged in
                if( is_user_logged_in() )
                    return;

                // Check if Login Parameter is set
                // and equals 'dynomapper-login'
                if( isset( $_REQUEST['login'] )
                    && ( $_REQUEST['login'] == $this->queryParam) )
                    {

                    // Check if Form is submit or not
                    if( isset( $_POST['dn-submit'] ) ){
                        // Get username
                        $username = $_POST['username'];
                        // Get password
                        $password = $_POST['password'];
                        // Do auto login
                        $result  = $this->dynomapperLogin( $username, $password );

                        if( $result['code'] ){ // Login Success
                            echo '<h2>'.$result['message'].'</h2>';
                        }
                        else{ // Login failed
                            echo '<h2>' . $result['message'] . '</h2>';
                            require_once 'dynomapper-login.php';
                        }
                    }else {
                        require_once 'dynomapper-login.php';
                    }
                    exit();
                }
            }
        }


        new DynomapperLogin();
    }
