<div class="container-fluid">
    <div class="page-header">
        <h3>Upload Image to S3 via Link(URL)</h3>
    </div>

    <div class="row-fluid">
        <div class="">
            <div class="row-fluid">
	            <div class="col-md-3 well well-sm text-center">
	                CSV File Header Format:
	                <small>
	                    <a href="files/test_image_file.csv">(<span class="glyphicon glyphicon-download" aria-hidden="true"></span> Sample file Here)
	                    </a>
                    </small>
                </div>
                <div class="col-md-9">
                    <div class="data">
                        <table class="table table-responsive table-bordered">
                            <tr class="header_row">
                                <th>SKU Code</th>
                                <th>Image 1</th>
                                <th>Image 2</th>
                                <th>Image 3</th>
                                <th>Image 4</th>
                                <th>Image 5</th>
                                <th>Image 6</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <p class="bg-info text-info" style="padding:10px;">
        Images will be uploaded to S3 from URL and will be renamed with SKU Code using underscore Like image_1.png, image_2.png
    </p>
    <form  class="form-inline" enctype="multipart/form-data" action="imagedownload.php" method="POST" style="padding:10px;">
        <div class="form-group" style="margin-right:10px;">
            <label>Choose a file to upload:</label>
            <input class="form-control" name="uploadedfile" type="file" />
        </div>
        <div class="form-group">
            <label>Select the folder to save:</label>
            <select name="folderName" class="form-control">
               <!-- <option value="">Select</option>
                <?php
               // $folderList = getFoldersList();
                if(!empty($folderList)){
                    foreach ($folderList as $key => $value) { ?>
                        <option value="<?php echo $key;?>"><?php echo $value; ?></option>
                <?php }
              }?> -->
                <option value="">Select Client</option>
                <?php
                //fetch client list from databse
                $chkQury = "SELECT name,s3_folder_name FROM clients order by name ASC";
                $resp = mysqli_query($con,$chkQury);
                if(mysqli_num_rows($resp)){
                     while($row = mysqli_fetch_assoc($resp)) { ?>
                         <option value="<?=$row['s3_folder_name']?>"><?=$row['s3_folder_name']?></option>
                    <? }
                 } ?>
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Upload File" />
        </div>
    </form>
    <hr />
    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $message = "";
        if(empty($_POST['folderName'])){?>

            <div class="clearfix"></div>
                <p class="alert alert-danger" style="padding:10px;">Please select a folder</p>
           <? exit;
        }else{
            $folderName = $_POST['folderName'];
        }
        $now = new DateTime('now');
        if(!is_dir('files'))
            mkdir("files", 0755,true);
        $target_path = "files/";
        if(!empty($_FILES['uploadedfile']['name'])){
            $extension = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
            if($extension!='csv'){?>
                <div class="clearfix"></div>
                <p class="alert alert-danger" style="padding:10px;">ERROR:The file "<?=basename( $_FILES['uploadedfile']['name'])?>" is not in the correct format, Please select a CSV file.</p>
                <?exit;
            }else{

            $target_path = $target_path . $now->format('YmdHis'). "_" .basename( $_FILES['uploadedfile']['name']);
            if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {?>
                <div class="clearfix"></div>
                <p class="bg-info text-info" style="padding:10px;">
                    <?=basename( $_FILES['uploadedfile']['name'])?> has been Uploaded Successfully
                </p>
            <? } else{
                $message .= "There was an error uploading the file,";
            }
        }
        }else{
            $message .= "Please select file";
        }
        if(!empty($message)){?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span><?=$message?>, Try Again
            </div>
        <? }
        if(!empty($_FILES['uploadedfile']['name'])){
                    $rows=parseCsv($target_path);
                    if($rows == false){
                        echo "<br/><span style='color:red;font-size: 20px;background-color: blanchedalmond;' >The file '".  basename( $_FILES['uploadedfile']['name']). "' contains duplicate entries of SKU code, Please correct it and upload again</span>";
                    }else{
                        if(!empty($rows)){
                        ?>
                        <div id='table' style="text-align:center;">
                            <table class="table table-responsive table-bordered table-hover">
                                <thead>
                                    <th>SKU Code</th>
                                    <th>Image 1</th>
                                    <th>Image 2</th>
                                    <th>Image 3</th>
                                    <th>Image 4</th>
                                    <th>Image 5</th>
                                    <th>Image 6</th>
                                </thead>
                                <tbody>
                                    <?php

                                        foreach($rows as $key => $val){?>
                                            <tr>
                                                <td><?php if(!empty($val['SKU Code']))
                                                        echo $val['SKU Code'];
                                                    else
                                                        echo 'N/A';?></td>
                                                <td>
                                                    <span id='<?php echo $val['SKU Code'];?>_1'>
                                                        <?php if(!empty($val['Image 1'])) echo $val['Image 1']; else echo 'N/A';?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span id='<?php echo $val['SKU Code'];?>_2'>
                                                        <?php if(!empty($val['Image 2'])) echo $val['Image 2']; else echo 'N/A';?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span id='<?php echo $val['SKU Code'];?>_3'>
                                                        <?php if(!empty($val['Image 3'])) echo $val['Image 3']; else echo 'N/A';?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span id='<?php echo $val['SKU Code'];?>_4'>
                                                        <?php if(!empty($val['Image 4'])) echo $val['Image 4']; else echo 'N/A';?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span id='<?php echo $val['SKU Code'];?>_5'>
                                                        <?php if(!empty($val['Image 5'])) echo $val['Image 5']; else echo 'N/A';?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span id='<?php echo $val['SKU Code'];?>_6'>
                                                        <?php if(!empty($val['Image 6'])) echo $val['Image 6']; else echo 'N/A';?>
                                                    </span>
                                                </td>
                                            </tr>
                                      <?php  }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }

                    }?>
                        <form style="text-align:center;" name="export" action="downloadCSV.php" method="post" onclick="downloadCSV()">
                            <input type="submit" value="Export table to CSV" style='display:none;' id='submitButton'class="btn btn-primary">
                            <input type="hidden" value="" name="table" id="tableData">
                        </form>
		    <?php
	    }
    } ?>
</div>