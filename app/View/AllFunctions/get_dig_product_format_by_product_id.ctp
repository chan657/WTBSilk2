<?php
                                                        if ($DataArray['DigMediaProduct']['product_delivery_format']) {
                                                            $filePath = $this->webroot . 'uploads/DigMediaProducts';
                                                            $path = $filePath . '/' . $DataArray['DigMediaProduct']['product_delivery_format'];
                                                        
?>
<a href="<?php echo $path;?>">File Format</a>
<input type="hidden" name="data[DigMediaTask][format2]" value="<?php echo $DataArray['DigMediaProduct']['product_delivery_format'];?>" />
<?php
} 
                                              

                                                        ?>
 