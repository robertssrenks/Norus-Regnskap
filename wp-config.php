<?php

# Database Configuration
define( 'DB_NAME', 'norus-regnskap' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'xcvo_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '/)jhPu04o EkCJUpz4e8z?F;xmuX-~1?>oU&VK7|`8]-B[Pe&G7RL[,Fe**i3L2V');
define('SECURE_AUTH_KEY',  'h_5DLaoJhzf>~f@>W.gH;]RSZquv9yn*Yb^95%#H57Hmh|hEbzdOx}jr~-o]IUQ;');
define('LOGGED_IN_KEY',    '!sdwxPPiCZ8}l>:Zo3?hhJyVzi;;tvEe*w8BQ(IACw=7:JlA2*@Md>K6y8Tm{*^F');
define('NONCE_KEY',        ';,I}K:>IB2F@`&qx,U?nHW? ?_mYNjX>[>|g8U5@wdxr8 |Lt)*18X?Aok|*LSW1');
define('AUTH_SALT',        '=*Wc`D3Tf-&K|WLbtylH|eDYi1n.mT/A,=lrL&a2ca_zfla#W[Yjx[ku+vI*Svp_');
define('SECURE_AUTH_SALT', 'u|ZxYY&i*^hT:DE-Y6El^4t39)>OfKZ!wDDz)FQG:Tr]:*Y$W_>HY1Fj}Hsuh$@v');
define('LOGGED_IN_SALT',   ';1!J-m$|!qd?/bjmWDHLMD3]8RvG/`I7LQ&j-}T}3jR+-tMZ$~MF`{s`_[A8LXPv');
define('NONCE_SALT',       '+sl*V{^/=1eA.s_ip!kWS[6WKj O$0|^Spwtarc{fowg67L+5$jgG8nfK!H8UqM3');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'test5kebbeitno' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '127e311178638597bfea75232cdc4b751fe6d9a1' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '40264' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '178.79.134.114' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'test5.kebbeit.no', 1 => 'test5kebbeitno.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-40264', );

$wpe_special_ips=array ( 0 => '178.79.134.114', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
