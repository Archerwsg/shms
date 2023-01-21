<!doctype html>
<?php
//$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$system_name  = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
?>

<html class="no-js" lang="">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>
        <?php echo get_phrase('login'); ?> | <?php echo $system_name; ?>
      </title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

	    <link rel="shortcut icon" href="<?php echo base_url('assets/login_page/img/favicon.png');?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css');?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/login_page/css/font-awesome.min.css');?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/login_page/css/normalize.css');?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/login_page/css/main.css');?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/login_page/css/style.css');?>">
      <script src="<?php echo base_url('assets/login_page/js/vendor/modernizr-2.8.3.min.js');?>"></script>
		  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
      <style>
          @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,800,700,300);
          @import url(https://fonts.googleapis.com/css?family=Squada+One);
          /* body {
            padding: 20px 80px;
            background: #eee url(https://subtlepatterns.com/patterns/extra_clean_paper.png);
          } */
          #logo {
            font-family: 'Open Sans', sans-serif;
            color: #555;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 150px;
            font-weight: 800;
            letter-spacing: -3px;
            line-height: 1;
            text-shadow: #EDEDED 3px 2px 0;
            position: relative;
          }
          #logo:after {
            content:"dreamdealer";
            position: absolute;
            left: 8px;
            top: 32px;
          }
          #logo:after {
            /*background: url(https://subtlepatterns.com/patterns/crossed_stripes.png) repeat;*/
            background-image: -webkit-linear-gradient(left top, transparent 0%, transparent 25%, #555 25%, #555 50%, transparent 50%, transparent 75%, #555 75%);
            background-size: 4px 4px;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            z-index: -5;
            display: block;
            text-shadow: none;
          }
          #menu {
            width: 1090px;
            height: 42px;
            list-style: none;
            margin: 10px 0 0 0; padding: 25px 10px;
            border-top: 4px double #AAA;
            border-bottom: 4px double #AAA;
            position: relative;
            text-align: center;
          }
          #menu li {
            display: inline-block;
            width: 173px;
            margin: 0 10px;
            position: relative;
            -webkit-transform: skewy(-3deg);
            -webkit-backface-visibility: hidden;
            -webkit-transition: 200ms all;
          }
          #menu li a {
            text-transform: uppercase;
            font-family: 'Squada One', cursive;
            font-weight: 800;
            display: block;
            background: #FFF;
            padding: 2px 10px;
            color: #333;
            font-size: 35px;
            text-align: center;
            text-decoration: none;
            position: relative;
            z-index: 1;
            text-shadow: 
                  1px 1px 0px #FFF, 
                  2px 2px 0px #999,
                  3px 3px 0px #FFF;
              background-image: -webkit-linear-gradient(top, transparent 0%, rgba(0,0,0,.05) 100%);
              -webkit-transition: 1s all;
              background-image: -webkit-linear-gradient(left top, 
                  transparent 0%, transparent 25%, 
                  rgba(0,0,0,.15) 25%, rgba(0,0,0,.15) 50%, 
                  transparent 50%, transparent 75%, 
                  rgba(0,0,0,.15) 75%);
            background-size: 4px 4px;
              box-shadow: 
                  0 0 0 1px rgba(0,0,0,.4) inset, 
                  0 0 20px -5px rgba(0,0,0,.4),
                  0 0 0px 3px #FFF inset;
          }
          #menu li:hover {
              width: 203px;
              margin: 0 -5px;
          }
          #menu a:hover {
            color: #d90075;
          }
          #menu li:after,
          #menu li:before {
            content: '';
            position: absolute;
            width: 50px;
            height: 100%;
            background: #BBB;
            -webkit-transform: skewY(8deg);
            x-index: -3;
              border-radius: 4px;
          }
          #menu li:after {
              background-image: -webkit-linear-gradient(left, transparent 0%, rgba(0,0,0,.4) 100%);
            right: 0;
            top: -4px; 
          }
          #menu li:before {
            left: 0;
            bottom: -4px;
              background-image: -webkit-linear-gradient(right, transparent 0%, rgba(0,0,0,.4) 100%);
          }
      </style>
    </head>
    <body>
		<div class="main-content-wrapper image-area" style="width:100%;">
			<div class="login-area">
				<div class="login">
          <div class="login-header">
            <div href="<?php echo site_url('login');?>" class="logo">
              <img src="<?php echo base_url('assets/login_page/img/logo.png');?>"  alt="">
              <!-- <h2 class="title"><?php echo $system_name; ?></h2> -->
            </div>
          </div>
          <div class="login-content">
            <form method="post" role="form" id="form_login"
              action="<?php echo site_url('login/validate_login');?>">
              <div class="form-group">
                <input type="text" class="input-field" name="email" placeholder="<?php echo get_phrase('email').'/'.get_phrase('username');?>"
                  required autocomplete="off">
              </div>
              <div class="form-group">
                <input type="password" class="input-field" name="password" placeholder="<?php echo get_phrase('password');?>"
                  required>
              </div>
              <button type="submit" class="btn btn-primary"><?php echo get_phrase('login'); ?><i class="fa fa-lock"></i></button>
            </form>

            <div class="login-bottom-links">
              <a href="<?php echo site_url('login/forgot_password');?>" class="link">
                <?php echo get_phrase('forgot_your_password'); ?> ?
              </a>
            </div>
          </div>
			  </div>
			</div>
			<div class=""></div>
		</div>

    <script src="<?php echo base_url('assets/login_page/js/vendor/jquery-1.12.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


    <?php if ($this->session->flashdata('login_error') != '') { ?>
      <script type="text/javascript">
        $.notify({
          // options
          title: '<strong><?php echo get_phrase('error');?>!!</strong>',
          message: '<?php echo $this->session->flashdata('login_error');?>'
          },{
          // settings
          type: 'danger'
        });
      </script>
    <?php } ?>

    </body>
</html>
