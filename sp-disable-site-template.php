<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php
$spdp86_title = get_theme_mod('spdp86_title');
$spdp86_subtitle = get_theme_mod('spdp86_subtitle');

if(empty($spdp86_title)) $spdp86_title = 'Site is temporarily disabled.';
if(empty($spdp86_subtitle)) $spdp86_subtitle = 'The technical work is carried out on the website.';
?>

<body <?php body_class(); ?> >

	<div class="spdp86">
		<div class="spdp86_wrapp">
			<h1><?php echo esc_html($spdp86_title)?></h1>
			<p><?php echo esc_html($spdp86_subtitle)?></p>
		</div> 
	</div>

</body>
</html>