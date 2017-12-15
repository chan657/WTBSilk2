<?php

/**
 * This is Image component to resize image
 */
class ImageComponent extends Component {

    var $cacheDir = 'imagecache'; // relative to $uploadDir path
    var $uploadDir = 'uploads/';
    

    /**
     * Automatically upload an image and returns new image name
     *
     * @param string $oldImageName old image file name to delete it from server.
     * @param array $imageArray Full image array.
     * @param string $imagePath Path to the image file.
     * @param string $rename Image new name, default is null
     * @return mixed    Either string or false, depends on valid image.
     * @access public
     */
    public function upload($oldImageName = null, $imageArray, $imagePath, $rename = null) {
        //pr($imageArray);exit;

        if (is_uploaded_file($imageArray['tmp_name'])) {

            $filename = explode('.', $imageArray['name']);
            $ext = strtolower(end($filename));
            $imageArray['name'] = time() . ((!is_null($rename)) ? $rename . '.' . $ext : str_replace(" ", "-", $imageArray['name']));

            if ($ext === 'png' || $ext === 'jpeg' || $ext === 'jpg') {
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777);
                }
                if (!is_null($oldImageName)) {
                    $this->delete($oldImageName, $imagePath);
                }

                move_uploaded_file($imageArray['tmp_name'], $imagePath . '/' . $imageArray['name']);
            } else {
                echo 'Invalid image type. Upload only .png,.jpeg,.jpg image';
               // $this->Session->setFlash('Invalid image type. Upload only .png image', 'success');
              //  $this->Session->setFlash("Invalid image type. Upload only .png image");
                return false;
            }
        } else {
            echo 'Empty image file';
           // $this->Session->setFlash(__("Empty image file"));
            return false;
        }
        return $imageArray['name'];
    }

    /**
     * Delete the image from folder
     *
     * @param string $image image file name to delete it from server.
     * @param string $path Path to the image file.
     * @return mixed    Either true or false, depends on delete.
     * @access public
     */
    public function delete($image, $path) {
        if (!empty($image) && !empty($path)) {
            $oldImage = $path . '/' . $image;
            if (file_exists($oldImage))
                if (unlink($oldImage))
                    return true;
        }
        return false;
    }

    /**
     * Automatically resizes an image and returns formatted IMG tag
     *
     * @param string $path Path to the image file, relative to the webroot/img/ directory.
     * @param integer $width Image of returned image
     * @param integer $height Height of returned image
     * @param boolean $aspect Maintain aspect ratio (default: true)
     * @param array    $htmlAttributes Array of HTML attributes.
     * @param boolean $return Wheter this method should return a value or output it. This overrides AUTO_OUTPUT.
     * @return mixed    Either string or echos the value, depends on AUTO_OUTPUT and $return.
     * @access public
     */
    function resize($path, $width, $height, $aspect = true, $crop = false, $cropvars = array(), $autocrop = false, $htmlAttributes = array(), $return = false, $webrootPath, $onlyPath = false) {

        $types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp"); // used to determine image type
       
         $fullpath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . $this->themeWeb . $this->uploadDir;
         echo WWW_ROOT.'uploads'.DS.'hotels'.DS.$upload_dir;
         die;
        //$url = $fullpath.$path;
        //$url = "img/" . $path;
       $url = $path;
       // $webrootPath =  ROOT . DS . APP_DIR . DS . WEBROOT_DIR;
       echo $webrootPath = FULL_BASE_URL . '/silk/';



        if (!($size = getimagesize($url)))
            return; // image doesn't exist

        if ($width == $size[0] && $height == $size[1]) {
            //$webrootPath = FULL_BASE_URL . '/' . $webrootPath;
            $newPath = explode("$this->uploadDir", $path);
            $relfile = $webrootPath . $this->uploadDir . 'thumbs';
            //$relfile = $webrootPath . $this->uploadDir . $newPath[1];
        } else {
            if ($autocrop) {
                $multiplier = 1.0;
                while (($width * $multiplier < $size[0]) && ($height * $multiplier < $size[1])) {
                    $multiplier += .01;
                }

                // make SURE we don't run over
                $multiplier -= .01;

                $cropw = floor($width * $multiplier);
                $croph = floor($height * $multiplier);

                //echo("$cropw $croph $width $height $multiplier $size[0] $size[1] <br />");
                ///die();

                $xindent = ($size[0] - $cropw) / 2.0;
                $yindent = ($size[1] - $croph) / 2.0;

                $startx = floor($xindent);
                $endx = $size[0] - ceil($xindent);

                $starty = floor($yindent);
                $endy = $size[1] - ceil($yindent);

                //echo("$xindent, $yindent -> leads to: $startx, $starty start and $endx, $endy end");
                //die();

                $cropvars = array($startx, $starty, $endx, $endy);
            }

            if (($width > $size[0] || $height > $size[1]) && $autocrop) {

                $multiplier = 1.0;
                while (($width * $multiplier >= $size[0]) || ($height * $multiplier >= $size[1])) {
                    $multiplier -= .01;
                }

                $cropw = floor($width * $multiplier);
                $croph = floor($height * $multiplier);

                //echo("$cropw $croph $width $height $multiplier $size[0] $size[1] <br />");
                ///die();

                $xindent = ($size[0] - $cropw) / 2.0;
                $yindent = ($size[1] - $croph) / 2.0;

                $startx = floor($xindent);
                $endx = $size[0] - ceil($xindent);

                $starty = floor($yindent);
                $endy = $size[1] - ceil($yindent);

                //echo("$xindent, $yindent -> leads to: $startx, $starty start and $endx, $endy end");
                //die();

                $cropvars = array($startx, $starty, $endx, $endy);
            }

            // check that user supplied full start and stop coordinates
            if (sizeof($cropvars) == 4) {
                if ($cropvars[0] > $size[0] || $cropvars[1] > $size[1] || $cropvars[2] > $size[0] || $cropvars[3] > $size[1] || $cropvars[0] < 0 || $cropvars[1] < 0 || $cropvars[2] < 0 || $cropvars[3] < 0) {
                    $crop = false;
                }
            } else {
                $crop = false;
            }

            // temporarily set size to this for aspect checking
            if ($crop) {
                $tempsize = array($size[0], $size[1]);
                $size[0] = $cropvars[2] - $cropvars[0];
                $size[1] = $cropvars[3] - $cropvars[1];
            }

            if ($aspect) { // adjust to aspect
                if (($size[1] / $height) > ($size[0] / $width))  // $size[0]:width, [1]:height, [2]:type
                    $width = ceil(($size[0] / $size[1]) * $height);
                else
                    $height = ceil($width / ($size[0] / $size[1]));
            }

            // set size back
            if ($crop) {
                $size[0] = $tempsize[0];
                $size[1] = $tempsize[1];
            }

            if ($crop) {
                $cropstring = $cropvars[0] . $cropvars[1] . $cropvars[2] . $cropvars[3] . '_';
            } else {
                $cropstring = '';
            }

            $webrootPath = FULL_BASE_URL . '/' . $webrootPath;
            $relfile = $webrootPath . $this->themeWeb . $this->uploadDir . $this->cacheDir . '/' . $width . 'x' . $height . '_' . $cropstring . basename($path); // relative file
            $cachefile = $fullpath . $this->cacheDir . DS . $width . 'x' . $height . '_' . $cropstring . basename($path);  // location on server


            if (file_exists($cachefile)) {
                $csize = getimagesize($cachefile);
                $cached = ($csize[0] == $width && $csize[1] == $height); // image is cached
                if (@filemtime($cachefile) < @filemtime($url)) // check if up to date
                    $cached = false;
            } else {
                $cached = false;
            }

            if (!$cached) {
                $resize = ($size[0] > $width || $size[1] > $height) || ($size[0] < $width || $size[1] < $height);
            } else {
                $resize = false;
            }

            if ($resize) {
                $image = call_user_func('imagecreatefrom' . $types[$size[2]], $url);

                if ($crop) {
                    if (function_exists("imagecreatetruecolor") && ($tempcrop = imagecreatetruecolor($cropvars[2] - $cropvars[0], $cropvars[3] - $cropvars[1]))) {
                        imagecopyresampled($tempcrop, $image, 0, 0, $cropvars[0], $cropvars[1], $cropvars[2] - $cropvars[0], $cropvars[3] - $cropvars[1], $cropvars[2] - $cropvars[0], $cropvars[3] - $cropvars[1]);
                    } else {
                        $temp = imagecreate($cropvars[2] - $cropvars[0], $cropvars[3] - $cropvars[1]);
                        imagecopyresized($tempcrop, $image, 0, 0, $cropvars[0], $cropvars[1], $cropvars[2] - $cropvars[0], $cropvars[3] - $cropvars[1], $size[0], $size[1]);
                    }

                    $image = $tempcrop;
                }

                $size[0] = $cropvars[2] - $cropvars[0];
                $size[1] = $cropvars[3] - $cropvars[1];

                if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor($width, $height))) {
                    imagecopyresampled($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                } else {
                    $temp = imagecreate($width, $height);
                    imagecopyresized($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                }
                if ($types[$size[2]] == "jpeg") {
                    imagejpeg($temp, $cachefile, 90);
                } else {
                    call_user_func("image" . $types[$size[2]], $temp, $cachefile);
                }
                imagedestroy($image);
                imagedestroy($temp);
            }
            //return $this->output(sprintf($this->Html->image, $relfile, $this->Html->_parseAttributes($htmlAttributes, null, '', ' ')), $return);
        }
        if ($onlyPath) {
            return $relfile;
        }

        $htmlAttributes['src'] = $relfile;
        return $this->imageAttributes($htmlAttributes);
        //return '<img src="' . $relfile . '" alt="" />';
    }

    private function imageAttributes($htmlAttributes) {
        $imgAtr = array();

        if (!isset($htmlAttributes['src']) && empty($htmlAttributes['src']))
            return false;

        foreach ($htmlAttributes as $attribute => $value) {
            $imgAtr[] = "$attribute=" . '"' . $value . '"';
        }
        return "<img " . implode(' ', $imgAtr) . " />";
    }
    
    public function Fileupload($oldImageName = null, $imageArray, $imagePath, $rename = null) {
        //pr($imageArray);exit;

        if (is_uploaded_file($imageArray['tmp_name'])) {

            $filename = explode('.', $imageArray['name']);
            $ext = strtolower(end($filename));
            $imageArray['name'] = time() . ((!is_null($rename)) ? $rename . '.' . $ext : str_replace(" ", "-", $imageArray['name']));

            if ($ext === '.txt' || $ext === '.xlsx' || $ext === '.csv' || $ext === '.docx' || $ext === '.doc' || $ext === '.xls') {
                if (!is_dir($imagePath)) {
                    mkdir($imagePath, 0777);
                }
                if (!is_null($oldImageName)) {
                    $this->delete($oldImageName, $imagePath);
                }

                move_uploaded_file($imageArray['tmp_name'], $imagePath . '/' . $imageArray['name']);
            } else {
                echo 'Invalid image type. Upload only .txt,.xlsx,.xls,.docx,.doc,.csv image';
               // $this->Session->setFlash('Invalid image type. Upload only .png image', 'success');
              //  $this->Session->setFlash("Invalid image type. Upload only .png image");
                return false;
            }
        } else {
            echo 'Empty image file';
           // $this->Session->setFlash(__("Empty image file"));
            return false;
        }
        return $imageArray['name'];
    }
    
    	/**
	 * Creates resized copies of input image
	 * E.g;
	 *	 $this->Attachment->thumbnail($this->data['Model']['Attachment'], $upload_dir, 640, 480, false);
	 *
	 * @param $tmpfile array The image data array from the form
	 * @param upload_dir string The name of the parent folder of the images
	 * @param $maxw int Maximum width for resizing thumbnails
	 * @param $maxh int Maximum height for resizing thumbnails
	 * @param $crop string either 'resize', 'resizeCrop' or 'crop'
	 */
	public function thumbnail($tmpfile, $upload_dir, $maxw, $maxh, $crop = 'resize') {
		// Make sure the required directory exist; create it if necessary
            
		$upload_dir = WWW_ROOT.'uploads'.DS.'hotels'.DS.$upload_dir;
		if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
		/* Directory Separator for windows users */
		//$ds = (strcmp('\\', DS) == 0) ? '\\\\' : DS;
                $file_name = end(explode('/', $tmpfile));
                
                
		$this->resize_image($crop, $tmpfile, $upload_dir, $file_name, $maxw, $maxh, 85);
	}

	
	
	public function copyThumbRename($fromUrl,$oldname, $newName){
		$srcimg = $fromUrl.$oldname;
		
		list($oldWidth, $oldHeight, $type) = getimagesize($srcimg);

		$ext = $this->image_type_to_extension($type);
		
		switch($ext) {

				case 'gif' :

					$newName = $newName.".gif";

					break;

				case 'png' :

					$newName = $newName.".png";

					break;

				case 'jpg' :
				
					$newName = $newName.".jpg";
					
					break;
					
				case 'jpeg' :

					$newName = $newName.".jpeg";

					break;

				default :

					// image type is not a possible option

					return false;

					break;

				}
				
				
		$file = $srcimg;
		$newfile = $fromUrl.$newName;
		$imgName = $newName;
		if (!copy($file, $newfile)) {
			$imgName = "failed to copy";
		}
		
		return $imgName ;
	}
        
        /*
	* Creates resized image copy
	*
	* Parameters:
	* cType: Conversion type {resize (default) | resizeCrop (square) | crop (from center)}
	* tmpfile: original (tmp) file name
	* newName: include extension (if desired)
	* newWidth: the max width or crop width
	* newHeight: the max height or crop height
	* quality: the quality of the image
	*/
	public function resize_image($cType = 'resize', $tmpfile, $dst_folder, $dstname = false, $newWidth=false, $newHeight=false, $quality = 75) {
		$srcimg = $tmpfile;
               // $srcimg = 'C:\xampp\htdocs\silk\app\webroot/uploads/hotels/1470914687image7.jpg';
		list($oldWidth, $oldHeight, $type) = getimagesize($srcimg);
		$ext = $this->image_type_to_extension($type);
		// If file is writeable, create destination (tmp) image
		if (is_writeable($dst_folder)) {
			$dstimg = $dst_folder.DS.$dstname;
		} else {
			// if dst_folder not writeable, let developer know
			debug('You must allow proper permissions for image processing. And the folder has to be writable.');
			debug("Run 'chmod 755 $dst_folder', and make sure the web server is it's owner.");
			return $this->log_cakephp_error_and_return('No write permissions on attachments folder.');
		}
		/* Check if something is requested, otherwise do not resize */
		if ($newWidth or $newHeight) {
			/* Delete tmp file if it exists */
			if (file_exists($dstimg)) {
				//unlink($dstimg);
			} else {
				switch ($cType) {
				default:
				case 'resize':
					// Maintains the aspect ratio of the image and makes sure
					// that it fits within the maxW and maxH
					$widthScale  = 2;
					$heightScale = 2;
					/* Check if we're overresizing (or set new scale) */
					if ($newWidth) {
						if ($newWidth > $oldWidth) $newWidth = $oldWidth;
						$widthScale = $newWidth / $oldWidth;
					}
					if ($newHeight) {
						if ($newHeight > $oldHeight) $newHeight = $oldHeight;
						$heightScale = $newHeight / $oldHeight;
					}
					if ($widthScale < $heightScale) {
						$maxWidth  = $newWidth;
						$maxHeight = false;
					} elseif ($widthScale > $heightScale ) {
						$maxHeight = $newHeight;
						$maxWidth  = false;
					} else {
						$maxHeight = $newHeight;
						$maxWidth  = $newWidth;
					}
					if ($maxWidth > $maxHeight){
						$applyWidth  = $maxWidth;
						$applyHeight = ($oldHeight*$applyWidth)/$oldWidth;
					} elseif ($maxHeight > $maxWidth) {
						$applyHeight = $maxHeight;
						$applyWidth  = ($applyHeight*$oldWidth)/$oldHeight;
					} else {
						$applyWidth  = $maxWidth;
						$applyHeight = $maxHeight;
					}
					$startX = 0;
					$startY = 0;
					break;
				case 'resizeCrop':
					/* Check if we're overresizing (or set new scale) */
					/* resize to max, then crop to center */
					if ($newWidth > $oldWidth) $newWidth = $oldWidth;
						$ratioX = $newWidth / $oldWidth;
					if ($newHeight > $oldHeight) $newHeight = $oldHeight;
						$ratioY = $newHeight / $oldHeight;
					if ($ratioX < $ratioY) {
						$startX = round(($oldWidth - ($newWidth / $ratioY))/2);
						$startY = 0;
						$oldWidth  = round($newWidth / $ratioY);
						$oldHeight = $oldHeight;
					} else {
						$startX = 0;
						$startY = round(($oldHeight - ($newHeight / $ratioX))/2);
						$oldWidth  = $oldWidth;
						$oldHeight = round($newHeight / $ratioX);
					}
					$applyWidth  = $newWidth;
					$applyHeight = $newHeight;
					break;
				case 'crop':
					// straight centered crop
					$startY = ($oldHeight - $newHeight)/2;
					$startX = ($oldWidth - $newWidth)/2;
					$oldHeight   = $newHeight;
					$applyHeight = $newHeight;
					$oldWidth    = $newWidth;
					$applyWidth  = $newWidth;
					break;
				}
				switch($ext) {
				case 'gif' :
					$oldImage = imagecreatefromgif($srcimg);
					break;
				case 'png' :
					$oldImage = imagecreatefrompng($srcimg);
					break;
				case 'jpg' :
				case 'jpeg' :
					$oldImage = imagecreatefromjpeg($srcimg);
					break;
				default :
					// image type is not a possible option
					return false;
					break;
				}
				// Create new image
				$newImage = imagecreatetruecolor($applyWidth, $applyHeight);
				// Put old image on top of new image
				imagealphablending($newImage, false);
				imagesavealpha($newImage, true);
				imagecopyresampled($newImage, $oldImage, 0, 0, $startX, $startY, $applyWidth, $applyHeight, $oldWidth, $oldHeight);
				switch($ext) {
				case 'gif' :
					imagegif($newImage, $dstimg, $quality);
					break;
				case 'png' :
					imagepng($newImage, $dstimg, round($quality/10));
					break;
				case 'jpg' :
				case 'jpeg' :
					imagejpeg($newImage, $dstimg, $quality);
					break;
				default :
					return false;
					break;
				}
				imagedestroy($newImage);
				imagedestroy($oldImage);
				return true;
			}
		} else { /* Nothing requested */
			return false;
		}
	}
        
       public function image_type_to_extension($imagetype) {
		if (empty($imagetype)) return false;
		switch($imagetype) {
			case IMAGETYPE_TIFF_II : return 'tiff';
			case IMAGETYPE_TIFF_MM : return 'tiff';
			case IMAGETYPE_GIF  : return 'gif';
			case IMAGETYPE_JPEG : return 'jpg';
			case IMAGETYPE_PNG  : return 'png';
			case IMAGETYPE_SWF  : return 'swf';
			case IMAGETYPE_PSD  : return 'psd';
			case IMAGETYPE_BMP  : return 'bmp';
			case IMAGETYPE_JPC  : return 'jpc';
			case IMAGETYPE_JP2  : return 'jp2';
			case IMAGETYPE_JPX  : return 'jpf';
			case IMAGETYPE_JB2  : return 'jb2';
			case IMAGETYPE_SWC  : return 'swc';
			case IMAGETYPE_IFF  : return 'aiff';
			case IMAGETYPE_WBMP : return 'wbmp';
			case IMAGETYPE_XBM  : return 'xbm';
			default             : return false;
		}
	}


}

?>

