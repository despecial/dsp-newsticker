<?php
/**
 * Plugin Name: Newsticker
 * Description: Ein Newsticker Plugin mit Shortcode [newsticker] und Admin-Einstellungen
 * Version: 1.0.0
 * Author: despecial.com
 * Text Domain: newsticker
 */

if (!defined('ABSPATH')) {
    exit;
}

class NewstickerPlugin {
    
    private $plugin_url;
    private $plugin_path;
    
    public function __construct() {
        $this->plugin_url = plugin_dir_url(__FILE__);
        $this->plugin_path = plugin_dir_path(__FILE__);
        
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'settings_init'));
        add_shortcode('newsticker', array($this, 'shortcode_handler'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    }
    
    public static function activate() {
        $default_options = array(
            'active' => 1,
            'content' => '<span>LAST MINUTE ANGEBOT!</span><span>30% auf Alles</span><span>Packt eure Familie und Freunde ein!</span><span><a href="#"><strong>Jetzt shoppen & sparen!</strong></a></span>'
        );
        add_option('newsticker_options', $default_options);
    }
    
    public function add_admin_menu() {
        add_options_page(
            'Newsticker Einstellungen',
            'Newsticker',
            'edit_posts',
            'newsticker-settings',
            array($this, 'settings_page')
        );
    }
    
    public function admin_enqueue_scripts($hook) {
        if ($hook !== 'settings_page_newsticker-settings') {
            return;
        }
        wp_enqueue_style('newsticker-admin-style', $this->plugin_url . 'assets/admin.css', array(), '1.0.0');
    }
    
    public function settings_init() {
        register_setting('newsticker_settings', 'newsticker_options');
        add_settings_section(
            'newsticker_section',
            '', // Keine Überschrift!
            array($this, 'settings_section_callback'),
            'newsticker_settings'
        );
        add_settings_field(
            'newsticker_active',
            'Newsticker aktivieren',
            array($this, 'active_field_callback'),
            'newsticker_settings',
            'newsticker_section'
        );
        add_settings_field(
            'newsticker_content',
            'Newsticker Inhalt',
            array($this, 'content_field_callback'),
            'newsticker_settings',
            'newsticker_section'
        );
    }
    
    public function settings_section_callback() {
        echo '<p>Nutze <code>[newsticker]</code> als Shortcode in Seiten, Beiträgen oder Widgets.<br>Template: <code>&lt;?php echo do_shortcode(\'[newsticker]\'); ?&gt;</code></p>';
    }
    
    public function active_field_callback() {
        $options = get_option('newsticker_options');
        $active = isset($options['active']) ? $options['active'] : 0;
        echo '<div class="newsticker-toggle-wrapper">';
        echo '<input type="checkbox" id="newsticker_active" name="newsticker_options[active]" value="1" ' . checked(1, $active, false) . ' class="newsticker-toggle" />';
        echo '<label for="newsticker_active" class="newsticker-toggle-label">';
        echo '<span class="newsticker-toggle-slider"></span>';
        echo '</label>';
        echo '<span class="newsticker-toggle-text">Auf Webseite anzeigen</span>';
        echo '</div>';
    }
    
    public function content_field_callback() {
        $options = get_option('newsticker_options');
        $content = isset($options['content']) ? $options['content'] : '';
        echo '<div class="newsticker-editor-wrapper" style="max-width:640px;">';
        wp_editor($content, 'newsticker_content', array(
            'textarea_name' => 'newsticker_options[content]',
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => true,
            'quicktags' => true,
            'tinymce' => array(
                'toolbar1' => 'bold,italic,underline,link,unlink',
                'toolbar2' => '',
                'block_formats' => 'Absatz=p',
                'valid_elements' => 'b,strong,i,em,u,a[href|title|target|rel],p',
                'valid_children' => '+body[p]'
            ),
            'quicktags' => array(
                'buttons' => 'strong,em,link,ul,ol,li,code,close'
            )
        ));
        echo '</div>';
        echo '<p class="description">Erlaubte Formatierungen: <b>B</b>, <i>I</i>, <u>U</u>, <a href="#">Link</a>, Absatz dient als Trenner</p>';
    }
    
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Newsticker Einstellungen</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('newsticker_settings');
                do_settings_sections('newsticker_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    public function shortcode_handler($atts) {
        $options = get_option('newsticker_options');
        if (!isset($options['active']) || !$options['active']) {
            return '';
        }
        if (empty($options['content'])) {
            return '';
        }
        wp_enqueue_style('newsticker-style', $this->plugin_url . 'assets/newsticker.css', array(), '1.0.0');
        wp_enqueue_script('newsticker-script', $this->plugin_url . 'assets/newsticker.js', array(), '1.0.0', true);
        $content = wpautop($options['content']);
        $content = str_replace(array('<p>', '</p>'), array('<span>', '</span>'), $content);
        ob_start();
        ?>
        <div class="newsticker">
            <div class="newsticker__group">
                <?php echo $content; ?>
            </div>
            <div class="newsticker__group" aria-hidden="true">
                <?php echo $content; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

register_activation_hook(__FILE__, array('NewstickerPlugin', 'activate'));
new NewstickerPlugin();
