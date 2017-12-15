<?php
	set_time_limit(3600);
	/*if (!isset($_GET['act']) || $_GET['act'] != 'del')
	{
		exit(1);
	}*/


//	$res = rmdir($dir);

//	echo "before deletion<br />";
	$files = scandir('.');
	/*echo "<pre>";
		print_r($files);
	echo "</pre>";*/


	foreach ($files as $indv_file)
	{
		if ($indv_file != '.' && $indv_file != '..' && $indv_file != 'cgi-bin')
		{
			if (is_dir($indv_file))
			{
//				echo "<br />top level deleting: $indv_file";
				deleteDir($indv_file);
				rmdir($indv_file);
			}
			elseif (is_file($indv_file))
			{
				unlink($indv_file);
			}
		}
	}

	function deleteDir($dir)
	{
//		echo "<br />within dir: $dir";
		$sub_files = scandir($dir);
		/*echo "<pre>";
			print_r($sub_files);
		echo "</pre>";*/

//		echo "<br /> entering foreach for $dir<br />";
		foreach ($sub_files as $indv_file1)
		{
//			echo "<br />within loop";
			if ($indv_file1 != '.' && $indv_file1 != '..')
			{
//				echo "<br />within if 1<br />";
//				echo "<br />is dir $dir/$indv_file1 = ".is_dir($dir.'/'.$indv_file1);
				if (is_dir($dir.'/'.$indv_file1))
				{
//					echo "<br />within if 2<br />";
//					echo "<br />sub level deleting: ".$dir.'/'.$indv_file;
//					echo "<br />tryig to call deleteDir on ".$dir.'/'.$indv_file1;
					deleteDir($dir.'/'.$indv_file1);
					rmdir($dir.'/'.$indv_file1);
				}
				elseif (is_file($dir.'/'.$indv_file1))
				{
//					echo "<br />within elseif<br />";
					unlink($dir.'/'.$indv_file1);
				}
			}
		}
		return true;
	}
?>
