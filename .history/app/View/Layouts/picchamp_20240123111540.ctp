<style>
.delete_table {
    width: 100%;
    border-collapse: collapse;
     margin-top: 20px;
}

    .delete_table th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .delete_table th {
            background-color: #f2f2f2;
        }

        .delete_img {
            max-width: 100px;
            height: auto;
        } 
}
    
    
    </style>

    <div>
    <?php echo $this->fetch('content'); ?>
    </div>