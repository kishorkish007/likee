Skip to content
 kishorkish007 / kishorbot
Learn Git and GitHub without any code!
Using the Hello World guide, you’ll start a branch, write comments, and open a pull request.


Code Issues 0 Pull requests 0 Projects 0 Actions Wiki Security
kishorbot/index.php / 
@kishorkish007 kishorkish007 Create index.php
ab91ffc 17 days ago
70 lines (63 sloc)  2.37 KB
 
<?php
set_time_limit(0);
include 'class_ig.php';
clear();
echo "
 *  OPTIMUS FEED LIKER [v3]
 *  STATUS @BETA
 *  AUTHOR @CEO.HARIRISHNAN
 *  WHATSAPP  +919920822286
 *  RECOMMENDED SLEEP 60s
  
    WELLCOME TO THE WORLD OF BOTZ
    
 * Use tools at your own risk.
 * Use this Tool for personal use, not for sale.
 * I am not responsible for your account using this tool.
 * Make sure your account has been verified (Email & Telp).
 
";
$username    = getUsername();
$password    = getPassword();
$sleep = rand(0,10) + getComment('[?]  Sleep in Seconds: ');
echo '    WELLCOME TO THE OPTIMUS WORLD OF BOTZ
TEAM OPTIMUS' . PHP_EOL . PHP_EOL;
$login = login($username, $password);
if ($login['status'] == 'success') {
    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
    $data_login = array(
        'username' => $login['username'],
        'csrftoken' => $login['csrftoken'],
        'sessionid' => $login['sessionid']
    );
    while (true) {
        $profile    = getHome($data_login);
        $data_array = json_decode($profile);
        $result     = $data_array->user->edge_web_feed_timeline;
        foreach ($result->edges as $items) {
            $id       = $items->node->id;
            $username = $items->node->owner->username;
            $like     = like($id, $data_login);
            if ($like['status'] == 'error') {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Error Like' . PHP_EOL;
                logout($data_login);
                $login = login($username, $password);
                if ($login['status'] == 'success') {
                    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
                    $data_login = array(
                        'username' => $login['username'],
                        'csrftoken' => $login['csrftoken'],
                        'sessionid' => $login['sessionid']
                    );
                }else{

                    die("Something went wrong");

                }
            } else {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Like Success' . PHP_EOL;
            }
            break;
        }
        echo '[+] [' . date("H:i:s") . '] Sleep for ' . $sleep . ' seconds [+]' . PHP_EOL;
        sleep( $sleep);
        echo '    WELLCOME TO THE WORLD OF BOTZ
' . PHP_EOL . PHP_EOL;
    }

} else

    echo json_encode($login);
© 2020 GitHub, Inc.
Terms
Privacy
Security
Status
Help
Contact GitHub
Pricing
API
Training
Blog
About
