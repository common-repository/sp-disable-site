<?php
class SpDisableSite{

	protected $templateName = 'sp-disable-site-template.php';
	protected $disableSite;

	function __construct(){
		//set value
		$this->disableSite = get_theme_mod('spdp86_disable_site');

		//hooks and filters
		add_action('plugins_loaded', array($this,'languageSupport'));
		add_action('after_setup_theme', array($this, 'removeStyle'));
		add_action('wp_head', array($this, 'enqueueStyle'),2);
		add_filter('template_include', array($this, 'setTemplate'), 99);
		add_action('customize_register', array($this, 'settingsPlugin'));
	}

	//language support
	function languageSupport() {
		load_plugin_textdomain('spdp86', false, dirname( plugin_basename( __FILE__ ) ).'/languages/');
	}

	//remove style
	public function removeStyle(){
		if($this->disableSite){
			remove_action('wp_head','wp_print_scripts');
			remove_action('wp_head','wp_print_head_scripts',9);
			remove_action('wp_head','wp_enqueue_scripts',1);
		}	
	}

	//register and enqueue styles
	public function enqueueStyle() {
		if($this->disableSite){
			wp_enqueue_style('spdp86-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,600,800|Open+Sans:400,300,600');
			wp_register_style('spdp86-style', plugins_url('assets/css/sp-disable-site.css', __FILE__), false, false, 'all');
			wp_enqueue_style('spdp86-style');
		}	
	}

	//set template
	public function setTemplate($template) {
		if($this->disableSite){
			$template = dirname( __FILE__ ).'/'.$this->templateName;
		}	
		return $template;
	}

	//sanitize checkbox for customizer
	public function spdp86_sanitize_checkbox($input){
        if ($input == 1) return 1;
    	else return ''; 
    }

    //customizer
	public function settingsPlugin($wp_customize){
		$wp_customize->add_section('spdp86_settings_section' , array(
			'title'    => __('SP Disable Site', 'spdp86'),
			'priority' => 99,
		));

		$wp_customize->add_setting('spdp86_disable_site', array(
			'capability' => 'edit_theme_options',
			'default' => '',
			'sanitize_callback' => array($this, 'spdp86_sanitize_checkbox'),
		));

		$wp_customize->add_control('spdp86_disable_site', array(
			'settings' => 'spdp86_disable_site',
			'label'    => __('Disable site', 'spdp86'),
			'section'  => 'spdp86_settings_section',
			'type'     => 'checkbox',
		));

		$wp_customize->add_setting('spdp86_title', array(
			'capability' => 'edit_theme_options',
			'default' => 'Site is temporarily disabled.',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('spdp86_title', array(
			'type' => 'input',
			'section' => 'spdp86_settings_section',
			'label' => __('Title', 'spdp86'),
		));

		$wp_customize->add_setting('spdp86_subtitle', array(
			'capability' => 'edit_theme_options',
			'default' => 'The technical work is carried out on the website.',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('spdp86_subtitle', array(
			'type' => 'input',
			'section' => 'spdp86_settings_section',
			'label' => __('Subtitle', 'spdp86'),
		));
	}
}

?>