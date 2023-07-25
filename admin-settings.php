<?php

if (!checkUserPermissions()) {
    return;
}

if (isset($_POST['modal_title'], $_POST['modal_content'])) {
    update_option('modal_title', $_POST['modal_title']);
    update_option('modal_content', $_POST['modal_content']);
}

// Fetch data
$modal_title = get_option('modal_title');
$modal_content = get_option('modal_content');

?>

    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post">
            <label for="modal_title">Modal Title</label>
            <input type="text" id="modal_title" name="modal_title" value="<?php echo $modal_title; ?>">
            <label for="modal_content">Modal Content</label>
            <?php
            $content = stripslashes($modal_content);
            $editor_id = 'modal_content';
            wp_editor($content, $editor_id);
            ?>
            <input type="submit" value="Save Changes">
        </form>
    </div>
<?php
