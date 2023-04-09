<?php
if (isset($_POST['delete'])) {
    $files = $_POST['delete'];
    foreach ($files as $file) {
        if (file_exists('applications/' . $file)) {
            unlink('applications/' . $file);
        }
    }
}
header('Location: index.php');
exit;
?>
