<?php 

if(isset($_POST['sbtn']))
{
	$s=$_POST['seconds'];
	$imageName=$_POST['imgname'];

	if(file_exists($imageName) == 0)
	{
		exec('ffmpeg -i vid.mp4 -ss 00:00:'.$s.'.000 -vframes 1 '.$imageName.' 2>&1', $output);
		// echo "<pre>";
		// print_r($output); 

		if ((isset($output[39]) && strpos($output[39], 'Output file is empty') !== false ) || (strpos($output[23], 'Invalid duration specification') !== false )) {
    		echo 'invalid seconds.. please check the length of video.';
    		exec('ffmpeg -i vid.mp4 -ss 00:00:01.000 -vframes 1 '.$imageName.' 2>&1', $output);
		}

		if (isset($output[24]) &&strpos($output[24], 'Invalid argument') !== false) {
    		echo 'Incorrect format. please add extension of file.';
		}

	}
	else
	{
		echo "this filename already exists";
	}
	
}


?>

<html>
<head>
	
</head>
<body>
	<form name="frm1" method="post" action="#">
		<table>
			<tr>
				<td>Second</td>
				<td><input type="number" name="seconds"></td>
			</tr>
			<tr>
				<td>image name</td>
				<td><input type="text" name="imgname">(fill the name with image extension)</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="sbtn" value="Submit"></td>
			</tr>
		</table>
	</form>
	
</body>
</html>

<!-- // paste the ffmpeg in C:\ffmpeg directory

// set the environment variable - C:\ffmpeg\bin

 -->