<!-- app/View/Imagevurl/client_images.ctp -->
<style>
    table {
        width: 50%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #f2f2f2; /* Set your desired background color */
    }
    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    img {
        max-width: 200px; /* Set your desired max-width for the image */
        max-height: 150px; /* Set your desired max-height for the image */
        display: block;
        margin: 0 auto; /* Center the image within its container */
    }
</style>

<!-- app/View/Imagevurl/client_images.ctp -->
<!-- ... your existing code ... -->

<?php if (isset($images)): ?>
    <h2>Images for Selected Client</h2>
    <table class="clientdetailstab">
        <!-- ... your existing table code ... -->
    </table>

    <!-- Display pagination links -->
    <div class="paginator">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('« Previous'); ?>
            <?php echo $this->Paginator->numbers(); ?>
            <?php echo $this->Paginator->next('Next »'); ?>
        </ul>
    </div>
<?php endif; ?>

