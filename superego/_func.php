<?

function do_create($user) {

    // need to check, if user already created...

    // create questions in table
    for ($i=1;$i<112;$i++) {
        $q = "INSERT INTO entries (username, q_num) VALUES ('".$user."', '".$i."'); ";
        $r = mysql_query($q);
        if(!$r) {
            //echo "Failed!\n";
            //exit(1);
        };
    };

    return 1;
};


function do_replace($content) {
    global $q_arr;

    foreach ($q_arr as $q) {
       $content = str_replace($q,"",$content);
    };
    $content = trim($content,"\n\r ");

    return $content;
};


?>
