<?php


	require __DIR__.'/vendor/autoload.php';

	use phpish\app;
	use phpish\mysql;
	use phpish\template;

	require __DIR__.'/conf/'.app\ENV.'.conf.php';

    include_once __DIR__ . "/models/session.php";

    function set_flash_msg($type, $msg) {
        Session::set_alert(array('msg'=>$msg, 'type'=>$type));
    }

    function display_flash_msg() {
        $alert_msg = Session::get_alert();
        if(!empty($alert_msg)) {
            $msg_block = "<div class='alert alert-" . $alert_msg['type'] . "'>
            <div class='close' data-dismiss='alert'>&times;</div>
            <span>" . $alert_msg['msg'] . "</span>
        </div>";
            Session::remove_alert();
            return $msg_block;
        }
        return "";
    }


    app\any('.*', function($req) {
        session_start();
        mysql\connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);
        return app\next($req);
    });

    app\get('/', function($req) {
        include_once __DIR__ . "/models/bug-bash.php";
        $data = BugBash::all();
        return template\compose("main.html", compact('data'), "layout.html");
    });

    app\post('/register', function($req) {
        include_once __DIR__ . "/models/attendee.php";
        $response = Attendee::register($req['form']);
        set_flash_msg($response['status'], $response['msg']);
        return app\response_302("/");
    });

?>