<?php


	require __DIR__.'/vendor/autoload.php';

	use phpish\app;
	use phpish\mysql;
	use phpish\template;

	require __DIR__.'/conf/'.app\ENV.'.conf.php';

    include_once __DIR__ . "/models/session.php";
    include_once __DIR__ . "/models/bug-bash.php";
    include_once __DIR__ . "/models/attendee.php";
    include_once __DIR__ . "/templates/inc/helper.html.php";

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
        $data = BugBash::all();
        $data['page-title'] = '';
        $data['bashes'] = BugBash::listing();
        return template\compose("home.html", compact('data'), "layout.html");
    });

    app\any('/{bash_id}.*', function($req) {
        $bash_id = $req['matches']['bash_id'];
        if(BugBash::invalid_id($bash_id)){
            set_flash_msg('error', 'Sorry the requested Bug Bash does not exist');
            return app\response_302("/");
        }
        return app\next($req);
    });

    app\post('/{bash_id}/register', function($req) {
        $bash_id = $req['matches']['bash_id'];
        $response = Attendee::register($bash_id, $req['form']);
        set_flash_msg($response['status'], $response['msg']);
        return app\response_302("/$bash_id");
    });

    app\get('/{bash_id}', function($req) {
        $bash_id = $req['matches']['bash_id'];
        $data = BugBash::all();
        $bash_info = BugBash::fetch_info($bash_id);
        $data['page-title'] = $bash_info['title'] . " | ";
        $data['bashes'] = BugBash::listing();
        $data['bash_info'] = $bash_info;
        return template\compose("bash.html", compact('data'), "layout.html");
    });

?>