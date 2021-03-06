<?php
global $wpdb, $itsec_globals;
$config_file = ITSEC_Lib::get_config();
$htaccess = ITSEC_Lib::get_htaccess();
?>

<ul class="itsec-support">
<li>
	<h4><?php _e( 'User Information', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<ul>
		<li><?php _e( 'Public IP Address', 'it-l10n-ithemes-security-pro' ); ?>: <strong><a target="_blank"
		                                                            title="<?php _e( 'Get more information on this address', 'it-l10n-ithemes-security-pro' ); ?>"
		                                                            href="http://whois.domaintools.com/<?php echo ITSEC_Lib::get_ip(); ?>"><?php echo ITSEC_Lib::get_ip(); ?></a></strong>
		</li>
		<li><?php _e( 'User Agent', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo filter_var( $_SERVER['HTTP_USER_AGENT'], FILTER_SANITIZE_STRING ); ?></strong></li>
	</ul>
</li>

<li>
	<h4><?php _e( 'File System Information', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<ul>
		<li><?php _e( 'Website Root Folder', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo get_site_url(); ?></strong>
		</li>
		<li><?php _e( 'Document Root Path', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo filter_var( $_SERVER['DOCUMENT_ROOT'], FILTER_SANITIZE_STRING ); ?></strong></li>
		<?php
		if ( @is_writable( $htaccess ) ) {

			$copen  = '<font color="red">';
			$cclose = '</font>';
			$htaw   = __( 'Yes', 'it-l10n-ithemes-security-pro' );

		} else {

			$copen  = '';
			$cclose = '';
			$htaw   = __( 'No.', 'it-l10n-ithemes-security-pro' );

		}
		?>
		<li><?php _e( '.htaccess File is Writable', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo $copen . $htaw . $cclose; ?></strong></li>
		<?php
		if ( @is_writable( $config_file ) ) {

			$copen  = '<font color="red">';
			$cclose = '</font>';
			$wconf  = __( 'Yes', 'it-l10n-ithemes-security-pro' );

		} else {

			$copen  = '';
			$cclose = '';
			$wconf  = __( 'No.', 'it-l10n-ithemes-security-pro' );

		}
		?>
		<li><?php _e( 'wp-config.php File is Writable', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo $copen . $wconf . $cclose; ?></strong></li>
	</ul>
</li>

<li>
	<h4><?php _e( 'Database Information', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<?php
		$use_mysqli = $wpdb->use_mysqli;
		$mysql_server_version = $wpdb->get_var( "SELECT VERSION() AS version" );
		
		if ( $use_mysqli && is_callable( 'mysqli_get_client_info' ) ) {
			$mysql_client_version = mysqli_get_client_info();
		} else if ( ! $use_mysqli && is_callable( 'mysql_get_client_info' ) ) {
			$mysql_client_version = mysql_get_client_info();
		} else {
			$mysql_client_version = __( 'Unknown', 'unknown MySQL version', 'it-l10n-ithemes-security-pro' );
		}
		
		$sql_mode = $wpdb->get_var( "SHOW VARIABLES LIKE 'sql_mode'", 1 );
		
		if ( empty( $sql_mode ) ) {
			$sql_mode = __( 'Not Set', 'it-l10n-ithemes-security-pro' );
		}
	?>
	<ul>
		<li><?php _e( 'MySQL Database Version', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( $mysql_server_version ); ?></strong></li>
		<li><?php _e( 'MySQL Client Version', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( $mysql_client_version ); ?></strong></li>
		<li><?php _e( 'Database Host', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( DB_HOST ); ?></strong></li>
		<li><?php _e( 'Database Name', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( DB_NAME ); ?></strong></li>
		<li><?php _e( 'Database User', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( DB_USER ); ?></strong></li>
		<li><?php _e( 'Use MySQLi', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( $use_mysqli ? __( 'Yes', 'it-l10n-ithemes-security-pro' ) : __( 'No', 'it-l10n-ithemes-security-pro' ) ); ?></strong></li>
		<li><?php _e( 'SQL Mode', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo esc_html( $sql_mode ); ?></strong></li>
	</ul>
</li>

<li>
	<h4><?php _e( 'Server Information', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<?php $server_addr = array_key_exists( 'SERVER_ADDR', $_SERVER ) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR']; ?>
	<ul>
		<li><?php _e( 'Server / Website IP Address', 'it-l10n-ithemes-security-pro' ); ?>: <strong><a target="_blank"
		                                                                      title="<?php _e( 'Get more information on this address', 'it-l10n-ithemes-security-pro' ); ?>"
		                                                                      href="http://whois.domaintools.com/<?php echo $server_addr; ?>"><?php echo $server_addr; ?></a></strong>
		</li>
		<li><?php _e( 'Server Type', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo filter_var( filter_var( $_SERVER['SERVER_SOFTWARE'], FILTER_SANITIZE_STRING ), FILTER_SANITIZE_STRING ); ?></strong>
		</li>
		<li><?php _e( 'Operating System', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo PHP_OS; ?></strong></li>
		<li><?php _e( 'Browser Compression Supported', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo filter_var( $_SERVER['HTTP_ACCEPT_ENCODING'], FILTER_SANITIZE_STRING ); ?></strong></li>
		<?php
		// from backupbuddy

		$disabled_functions = @ini_get( 'disable_functions' );

		if ( $disabled_functions == '' || $disabled_functions === false ) {
			$disabled_functions = '<i>(' . __( 'none', 'it-l10n-ithemes-security-pro' ) . ')</i>';
		}

		$disabled_functions = str_replace( ', ', ',', $disabled_functions ); // Normalize spaces or lack of spaces between disabled functions.
		$disabled_functions_array = explode( ',', $disabled_functions );

		$php_uid = __( 'unavailable', 'it-l10n-ithemes-security-pro' );
		$php_user = __( 'unavailable', 'it-l10n-ithemes-security-pro' );

		if ( is_callable( 'posix_geteuid' ) && ( false === in_array( 'posix_geteuid', $disabled_functions_array ) ) ) {

			$php_uid = @posix_geteuid();

			if ( is_callable( 'posix_getpwuid' ) && ( false === in_array( 'posix_getpwuid', $disabled_functions_array ) ) ) {

				$php_user = @posix_getpwuid( $php_uid );
				$php_user = $php_user['name'];

			}
		}

		$php_gid = __( 'undefined', 'it-l10n-ithemes-security-pro' );

		if ( is_callable( 'posix_getegid' ) && ( false === in_array( 'posix_getegid', $disabled_functions_array ) ) ) {
			$php_gid = @posix_getegid();
		}

		?>
		<li><?php _e( 'PHP Process User (UID:GID)', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo $php_user . ' (' . $php_uid . ':' . $php_gid . ')'; ?></strong></li>
	</ul>
</li>

<li>
	<h4><?php _e( 'PHP Information', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<ul>
		<li><?php _e( 'PHP Version', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo PHP_VERSION; ?></strong></li>
		<li><?php _e( 'PHP Memory Usage', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo round( memory_get_usage() / 1024 / 1024, 2 ) . __( ' MB', 'it-l10n-ithemes-security-pro' ); ?></strong>
		</li>
		<?php
		if ( ini_get( 'memory_limit' ) ) {
			$memory_limit = filter_var( ini_get( 'memory_limit' ), FILTER_SANITIZE_STRING );
		} else {
			$memory_limit = __( 'N/A', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Memory Limit', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $memory_limit; ?></strong></li>
		<?php
		if ( ini_get( 'upload_max_filesize' ) ) {
			$upload_max = filter_var( ini_get( 'upload_max_filesize' ), FILTER_SANITIZE_STRING );
		} else {
			$upload_max = __( 'N/A', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Max Upload Size', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $upload_max; ?></strong></li>
		<?php
		if ( ini_get( 'post_max_size' ) ) {
			$post_max = filter_var( ini_get( 'post_max_size' ), FILTER_SANITIZE_STRING );
		} else {
			$post_max = __( 'N/A', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Max Post Size', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $post_max; ?></strong></li>
		<?php
		if ( ini_get( 'safe_mode' ) ) {
			$safe_mode = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$safe_mode = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Safe Mode', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $safe_mode; ?></strong></li>
		<?php
		if ( ini_get( 'allow_url_fopen' ) ) {
			$allow_url_fopen = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$allow_url_fopen = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Allow URL fopen', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $allow_url_fopen; ?></strong>
		</li>
		<?php
		if ( ini_get( 'allow_url_include' ) ) {
			$allow_url_include = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$allow_url_include = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Allow URL Include' ); ?>: <strong><?php echo $allow_url_include; ?></strong></li>
		<?php
		if ( ini_get( 'display_errors' ) ) {
			$display_errors = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$display_errors = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Display Errors', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $display_errors; ?></strong>
		</li>
		<?php
		if ( ini_get( 'display_startup_errors' ) ) {
			$display_startup_errors = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$display_startup_errors = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Display Startup Errors', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong><?php echo $display_startup_errors; ?></strong></li>
		<?php
		if ( ini_get( 'expose_php' ) ) {
			$expose_php = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$expose_php = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Expose PHP', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $expose_php; ?></strong></li>
		<?php
		if ( ini_get( 'register_globals' ) ) {
			$register_globals = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$register_globals = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Register Globals', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $register_globals; ?></strong></li>
		<?php
		if ( ini_get( 'max_execution_time' ) ) {
			$max_execute = filter_var( ini_get( 'max_execution_time' ) );
		} else {
			$max_execute = __( 'N/A', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Max Script Execution Time' ); ?>:
			<strong><?php echo $max_execute; ?> <?php _e( 'Seconds' ); ?></strong></li>
		<?php
		if ( ini_get( 'magic_quotes_gpc' ) ) {
			$magic_quotes_gpc = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$magic_quotes_gpc = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Magic Quotes GPC', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $magic_quotes_gpc; ?></strong></li>
		<?php
		if ( ini_get( 'open_basedir' ) ) {
			$open_basedir = __( 'On', 'it-l10n-ithemes-security-pro' );
		} else {
			$open_basedir = __( 'Off', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP open_basedir', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $open_basedir; ?></strong></li>
		<?php
		if ( is_callable( 'xml_parser_create' ) ) {
			$xml = __( 'Yes', 'it-l10n-ithemes-security-pro' );
		} else {
			$xml = __( 'No', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP XML Support', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $xml; ?></strong></li>
		<?php
		if ( is_callable( 'iptcparse' ) ) {
			$iptc = __( 'Yes', 'it-l10n-ithemes-security-pro' );
		} else {
			$iptc = __( 'No', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP IPTC Support', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $iptc; ?></strong></li>
		<?php
		if ( is_callable( 'exif_read_data' ) ) {
			$exif = __( 'Yes', 'it-l10n-ithemes-security-pro' ) . " ( V" . substr( phpversion( 'exif' ), 0, 4 ) . ")";
		} else {
			$exif = __( 'No', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'PHP Exif Support', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $exif; ?></strong></li>
		<?php $disabled_functions = str_replace( ',', ', ', $disabled_functions ); // Normalize spaces or lack of spaces between disabled functions. ?>
		<li><?php _e( 'Disabled PHP Functions', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $disabled_functions; ?></strong></li>
	</ul>
</li>

<li>
	<h4><?php _e( 'WordPress Configuration', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<ul>
		<?php
		if ( is_multisite() ) {
			$multSite = __( 'Multisite is enabled', 'it-l10n-ithemes-security-pro' );
		} else {
			$multSite = __( 'Multisite is NOT enabled', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( '	Multisite', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $multSite; ?></strong></li>
		<?php
		if ( get_option( 'permalink_structure' ) != '' ) {
			$copen               = '';
			$cclose              = '';
			$permalink_structure = __( 'Enabled', 'it-l10n-ithemes-security-pro' );
		} else {
			$copen               = '<font color="red">';
			$cclose              = '</font>';
			$permalink_structure = __( 'WARNING! Permalinks are NOT Enabled. Permalinks MUST be enabled for this plugin to function correctly', 'it-l10n-ithemes-security-pro' );
		}
		?>
		<li><?php _e( 'WP Permalink Structure', 'it-l10n-ithemes-security-pro' ); ?>:
			<strong> <?php echo $copen . $permalink_structure . $cclose; ?></strong></li>
		<li><?php _e( 'wp-config.php Location', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $config_file ?></strong></li>
		<?php $active_plugins = implode( ', ', get_option( 'active_plugins' ) ); ?>
		<li><?php _e( 'Active Plugins', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $active_plugins ?></strong></li>
		<li><?php _e( 'Content Directory', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo WP_CONTENT_DIR ?></strong></li>
	</ul>
</li>
<li>
	<h4><?php echo $itsec_globals['plugin_name'] . __( ' variables', 'it-l10n-ithemes-security-pro' ); ?></h4>
	<ul>
		<li><?php _e( 'Build Version', 'it-l10n-ithemes-security-pro' ); ?>: <strong><?php echo $itsec_globals['plugin_build']; ?></strong><br/>
			<em><?php _e( 'Note: this is NOT the same as the version number on the plugin page or WordPress.org page and is instead used for support.', 'it-l10n-ithemes-security-pro' ); ?></em>
		</li>
	</ul>
</li>
</ul>
