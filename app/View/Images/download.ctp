<!-- app/View/Images/download.ctp -->

<h2>Download Image</h2>

<?php
if (isset($image['Image']['filename'])) {
    $base64Data = base64_encode($image['Image']['filename']);
    echo '<img src="data:image/png;base64,' . $base64Data . '" alt="Image">';
} else {
    echo 'No image found.';
}
?>

<p>
    <?php
    echo $this->Html->link(
        'Download Image',
        array('action' => 'download', $image['Image']['id']),
        array('class' => 'button')
    );
    ?>
</p>
