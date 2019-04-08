<?php
// Set up User Logging Admin
require_once( 'class-itsec-user-logging-admin.php' );
$itsec_user_logging_admin = new ITSEC_User_Logging_Admin();
$itsec_user_logging_admin->run( ITSEC_Core::get_instance() );

// Set up User Logging Scheduling
require_once( 'class-itsec-user-logging.php' );
$itsec_user_logging = new ITSEC_User_logging();
$itsec_user_logging->run();
