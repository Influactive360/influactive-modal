<?php
// Check user capabilities
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}

// Save data
if ( isset( $_POST['modal_title'], $_POST['modal_content'] ) ) {
	update_option( 'modal_title', $_POST['modal_title'] );
	update_option( 'modal_content', $_POST['modal_content'] );
}

// Fetch data
$modal_title   = get_option( 'modal_title' );
$modal_content = get_option( 'modal_content' );

?>

    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="post">
            <label for="modal_title">Modal Title</label>
            <input type="text" id="modal_title" name="modal_title" value="<?php echo $modal_title; ?>">
            <label for="modal_content">Modal Content</label>
            <textarea id="modal_content" name="modal_content"><?php echo $modal_content; ?></textarea>
            <input type="submit" value="Save Changes">
        </form>
    </div>
<?php
