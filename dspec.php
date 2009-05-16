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

// Begin Code
// Usage: http://www.myserver.com/dspec.php?file=spectrum.jdx
$file = $_REQUEST['file']; // get the name of the spectrum file
?>
<html>
<head>
<title><?php echo $file; ?></title>
<script language="javascript" type="text/javascript">
//<![CDATA[


function MyCallBack(x, y) {
  alert("ESTIMATE-> " + x + " "+ y);
}

function MyPeakCallBack(x1, y1, x2, y2, index) {
  alert("ACTUAL-> " + x1 + ", " + y1 + ", "+ x2 + ", "+ y2 + ", " + index);
}

//]]>
</script>
</head>
<body>
<script language="JavaScript" type="text/javascript" src="JSVfunctions.js"></script>

jspecview.applet.JSVApplet will appear below in a Java enabled browser.<br /><br />

<script language="javascript" type="text/javascript">
//<![CDATA[
  jsvls="load <?php echo $file; ?>; interface single; reverseplot true; coordcallbackfunctionname MyDXCallback;";
  insertJSVObject("jspecview.jar","JSVApplet","647","400",jsvls);
//]]>
</script>
</body>
</html>
