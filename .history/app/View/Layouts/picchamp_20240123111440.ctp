<style>
.delete_table {
    width: 100%;
    border-collapse: collapse;
            margin-top: 20px;


            th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        } 
}
    
    
    </style>

    <div>
    <?php echo $this->fetch('content'); ?>
    </div>