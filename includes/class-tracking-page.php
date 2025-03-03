<?php
class IndianPost_Tracking_Page {
    public function __construct() {
        add_shortcode('indianpost_tracking', [$this, 'display_tracking_form']);
    }

    public function display_tracking_form() {
        ob_start();
        ?>
        <form method="post">
            <input type="text" name="tracking_id" placeholder="Enter Tracking ID" required>
            <button type="submit">Track</button>
        </form>
        <?php
        if (!empty($_POST['tracking_id'])) {
            $tracking_data = (new IndianPost_API())->track_order($_POST['tracking_id']);
            echo "<p>Status: " . $tracking_data['status'] . "</p>";
        }
        return ob_get_clean();
    }
}
