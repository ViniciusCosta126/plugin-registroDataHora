<?php
function rdt_enqueue_scripts()
{
    $url_css = plugin_dir_url(__FILE__) . 'css/';
    wp_enqueue_style('main-css', $url_css . 'main.css', array(), null, 'all');

    $url_js = plugin_dir_url(__FILE__) . 'js/';
    wp_enqueue_script('form-js', $url_js . 'formSubmit.js', array(), null, 1);
}
add_action('wp_enqueue_scripts', 'rdt_enqueue_scripts');

function registrarDataEHora($atts)
{
    $default = array(
        'texto' => 'Registrar data e hora no banco de dados',
    );

    $a = shortcode_atts($default, $atts);
    return  '
        <form id="form-register" action="' . get_site_url() . '/wp-admin/admin-ajax.php?action=insert_register_bd" method="POST">
            <input name="data" type="text"  hidden value="' . date('d-m-Y H:i:s') . ' ">
            <button id="submit" type="submit">' . $a['texto'] . '</button>
        </form> ';
}

add_shortcode('registrarHorario', 'registrarDataEHora');

add_action('wp_ajax_insert_register_bd', 'insert_register_bd');
add_action('wp_ajax_nopriv_insert_register_bd', 'insert_register_bd');

function insert_register_bd()
{
    $data  = json_decode(file_get_contents('php://input'), true);

    global $wpdb;

    $tablename = $wpdb->prefix . 'registros_hora';
    $data_input = sanitize_text_field($data['data']);

    if ($wpdb->get_var("SHOW TABLES LIKE '$tablename'") != $tablename) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $tablename (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            data_registro varchar(255) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    $result = $wpdb->insert(
        $tablename,
        array(
            'data_registro' => $data_input
        )
    );
    if ($result != false) {
        wp_send_json_success(array('messsage' => $data));
    } else {
        wp_send_json_error(array('message' => "Erro ao incluir data"));
    }
}
