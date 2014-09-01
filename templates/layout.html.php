<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $data['page-title']?>Bug Bash - Given enough minds, all bugs are shallow</title>
    <meta name="description" content="Bug Bash is a platform for testers to showcase their testing skills and to discover open-source projects that need exploratory testing. Let's pound-on-these-products, as a community to find bugs and show-off our automation skills.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="/css/bootswatch.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <script src="/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">Bug Bash</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="upcoming-bash">Upcoming Bashes <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <?php foreach ($data['bashes']['upcoming'] as $id=>$tile) {
                            echo bash_link($id, $tile);
                        }?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="past-bash">Past Bashes <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <?php foreach ($data['bashes']['past'] as $id=>$tile) {
                            echo bash_link($id, $tile);
                        }?>
                    </ul>
                </li>
                <li>
                    <a href="/#about_us">About Us</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://www.google.com/calendar/embed?src=bugbash.in%40gmail.com&ctz=Asia/Calcutta" target="_blank"><i class="fa fa-calendar solo"></i></a></li>
                <li><a href="https://plus.google.com/103867024485148277333/about" target="_blank"><i class="fa fa-google-plus solo"></i></a></li>
                <li><a href="https://www.facebook.com/bugbash.in" target="_blank"><i class="fa fa-facebook solo"></i></a></li>
                <li><a href="https://github.com/bugbash/" target="_blank"><i class="fa fa-github solo"></i></a></li>
                <li><a href="https://twitter.com/bugbash_in" target="_blank"><i class="fa fa-twitter solo"></i>&nbsp;@bugbash_in</a></li>
                <li><a href="mailto:bugbash.in@gmail.com?subject=BugBash"><i class="fa fa-envelope solo"></i>&nbsp;Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="container">
    <a name="top"></a>
    <?php echo display_flash_msg(); ?>
    <?php echo $content; ?>
    <footer>
        <div class="row">
            <div class="col-lg-12">

                <ul class="list-unstyled">
                    <li class="pull-right"><a href="#top">Back to top</a></li>
                </ul>
                <p>Made by <a href="http://nareshjain.com" rel="nofollow">Naresh Jain</a> and released under <a href="https://creativecommons.org/licenses/by-nc/3.0/" target="_blank">CC BY-NC 3.0</a> . Powered by <a href="https://github.com/phpish" target="_blank">PHPish</a>.</p>

                <p>Theme by <a href="http://thomaspark.me" rel="nofollow">Thomas Park</a>, based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a
                        href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

            </div>
        </div>

    </footer>

</div>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>
</body>
</html>
