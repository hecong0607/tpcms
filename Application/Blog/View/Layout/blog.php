<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <include file="Layout:blog/head"/>
    <style type="text/css">
        html ,body{height: 100%;}
    </style>
</head>
<body>
<div id="wrapper" >
    <include file="Layout:blog/header"/>
    <div id="content_area">
        <div id="content_area_content">
            <div id="left_content">
                {__CONTENT__}
            </div>
            <div id="sidebar">
                <include file="Layout:blog/right"/>
            </div>
        </div>
    </div>
</div>
<include file="Layout:blog/foot"/>
</body>
</html>