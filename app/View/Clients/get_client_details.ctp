<h2>Client Details</h2>
<?php
if (isset($clientDetails)) {
    echo $this->Html->tableCells(array($clientDetails['Client']));
} else {
    echo 'Client details not available.';
}
?>