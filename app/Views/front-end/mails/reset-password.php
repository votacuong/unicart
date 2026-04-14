<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
		<style>
			.form-item{
				width: 100%;
				height: auto;
				display:inline-block;
			}
			.css1{
				font-size: 25px;
				font-weight: 200;
				float: left;
				width: 100%;
				color: #000000;
				z-index: 99;
				text-align: center;
			}
			.logo{
				width: 100%;
				text-align: center;
			}
			.logo img{
				width: 40px;
				margin: auto;
			}
			.css2{
				float: right;
				width: 50%;
				position: absolute;
				top: 100px;
				z-index: 1;
			}
			.css2 img{
				width: 100%;
			}
			.css3{
				font-size: 16px;
				font-weight: 500;
				float: left;
				width: 100%;
				text-align: left;
				margin-top: 30px;
			}
			.text-bold{
				font-weight: bold;
				display: inline;
			}
			.css14{
				font-size: 15px;
				font-weight: bold;
				float: left;
				width: 100%;
				text-decoration: unset;
			}
			.css15{
				width: 100%;
				margin-top: 70px;
			}
			.css15 img{
				width: 40px;
			}
			.clearfix{
				width: 100%;
				height: 10px;
				margin: 0px;
				padding: 0px;
				border: unset;
			}
			.css4{
				font-size: 15px;
				float: left;
				width: 100%;
			}
			.css5{
				font-size: 25px;
				float: left;
				width: 100%;
				font-weight: bold;
				margin-top: 20px;
				margin-bottom: 20px;
			}
			.form-footer{
				background:#f5f5f5;
				color:#000000;
			}
			.abbora{
				color:#ffffff;
				width: 50%;
				clear: both;
				display: inline-block;
				padding-left: 20px;
				align-content: start;
			}
			.abbora img{
				width: 30px;
			}
			.footer-line{
				margin: auto;
				margin-top: 20px;
				margin-bottom: 20px;
				background:#dddddd;
				height: 1px;
				width: 97%;
				clear: both;
			}
			.footer-tab-left{
				width: 50%;
				display: inline-block;
				float: left;
			}
			.footer-tab-left div{
				margin-left: 20px;
			}
			.footer-tab-right{
				width: 50%;
				display: inline-block;
				float: right;
				text-align: right;
			}
			.footer-tab-right p{
				margin-right: 20px;
			}
			.form-top{
				width: 100%;
				margin-top: 20px;
				background:none;
				margin-bottom: 20px;
			}
			.css6{
				font-size: 15px;
				float: left;
				width: 50%;
				margin-bottom: 30px;
			}
			.css31{
				font-size: 15px;
				float: left;
				width: 100%;
				text-align: left;
				margin-bottom: 30px;
			}
			.cssunsubscribe{
				font-size: 8px;
				width: 100%;
			}
			.abbora-footer {
text-align: center;
color: #666;
font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial,
sans-serif;
font-size: 14px;
line-height: 1.6;
max-width: 600px;
margin: 60px auto 20px;
padding-top: 30px;
border-top: 1px solid #eee;
}
.abbora-footer a {
color: #7b5cff; /* Abbora violet accent */
text-decoration: none;
transition: opacity 0.2s ease-in-out;
}
.abbora-footer a:hover {
opacity: 0.7;
}
.abbora-footer .support {
	font-size: 15px;
color: #333;
margin-bottom: 8px;
}
.abbora-footer .social {
margin: 10px 0;
font-weight: 500;
}
.abbora-footer .disclaimer {
font-size: 12.5px;
color: #999;
margin: 20px 0;
line-height: 1.5;
text-align: center;
width: 100%;
}
.abbora-footer .copy {
font-size: 12px;
color: #aaa;
margin-top: 10px;
text-align:center;
width: 100%;
}
@media (max-width: 600px) {
.abbora-footer {
padding: 20px 15px;
}
.abbora-footer .support {
font-size: 14px;
}
.social-icons {
display: block;
align-items: center;
gap: 14px;
margin-top: 6px;
}
social-icons img {
width: 22px;
height: 22px;
object-fit: contain;
transition: opacity 0.2s ease-in-out;
}
.social-icons img:hover {
opacity: 0.7;
}
}
.social-icons img{
	width: 40px;
}
		</style>
	</head>
	
	<body style="padding: 20px;">
		<div class="form-item">
			<div class="logo">
				<img src="cid:img0" />
			</div>
		</div>
		<div class="form-item form-top">
			<div class="css1">
				<?php VLang::__e('RESET_11');?>
			</div>
			<div class="css3">
				<?php VLang::__e('RESET_2');?> <?php echo $data['username'];?>,
			</div>
		</div>
		<div class="form-item">
			<div class="css4">
				<?php VLang::__e('RESET_13');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-item">
			<div class="css4">
				<?php echo $data['password'];?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-item">
			<div class="css4">
				<?php VLang::__e('RESET_4');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-item">
			<div class="css4">
				<?php VLang::__e('RESET_5');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="form-item">
			<div class="css6">
				<?php VLang::__e('RESET_6');?>
			</div>
		</div>
		<div class="clearfix"></div>
		<footer class="abbora-footer">
			<p class="copy">© UniCart. All rights reserved.</p>
		</footer>
	</body>
</html>