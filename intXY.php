<?php
// Copyright (c) 2009 Andrew Lang

// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:

// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
$lb = $_REQUEST['l'];	//lower limit of integration (ppm)
$ub = $_REQUEST['u'];  	//upper limit of integration (ppm)
$str_file=$_REQUEST['file'];
$str_file = "http://myserver.com/spectra/" . $str_file; // change the name of the server here to your server
$file=file($str_file);
if (!$file) {

	echo "file not found";
	exit;

}

$filestr=file_get_contents($str_file);

if (strpos($filestr,"OBSERVEFREQUENCY=")>0) {
$obfreq = trim(substr($filestr,strpos($filestr,"OBSERVEFREQUENCY=")+17,strpos($filestr,"##$DSEQ=")-(strpos($filestr,"OBSERVEFREQUENCY=")+17)));
} else {
$obfreq = 1;
}


$data = array(array());
$i=0;

foreach ($file as $line_num => $line) {
	if (strpos($line, ", ") > 0 ) { // data line
		$xydata = explode(", ",$line);
		$data[$i][0] = ($xydata[0]-$alx)/$obfreq; // x-coordinate
		$data[$i][1] = $xydata[1]; // y-coordinate
		$i += 1;
	}
}

$i=0;
$area = 0;
$baseline = 0;

while ($i < count($data)){
	$point1 = $data[$i][0];
	$point2 = $data[$i+1][0];
	if ($point1 <= $ub && $point2 >= $lb){
		$area += abs($point1-$point2)*($data[$i][1]+$data[$i+1][1])/2;
		if ($baseline == 0) {
		// get baseline correction data
		$y1 = $data[$i][1]; // y-coordinate
		$baseline += 1;
		}
		$y2 = $data[$i+1][1];
	}
	$i += 1;
}

$area = $area - abs($ub-$lb)*($y1+$y2)/2;
echo $area;
?>