// start global session for saving the referer url
function start_session() {
    if(!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session', 1);

// get the referer url and save it to the session
function redirect_url() {
    if (! is_user_logged_in()) {
        $_SESSION['referer_url'] = wp_get_referer();
    } else {
        session_destroy();
    }
}
add_action( 'template_redirect', 'redirect_url' );

//login redirect to referer url
function login_redirect() {
    if (isset($_SESSION['referer_url'])) {
        wp_redirect($_SESSION['referer_url']);
    } else {
        wp_redirect(home_url());
    }
}
add_filter('woocommerce_login_redirect', 'login_redirect', 1100, 2);

/** end here */
