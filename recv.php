<?php
/**
 * Written by Mr.Alireza Saeidipour
 */
// db connection details
const DATABASE = [
    '',
    '',
    '',
    '',
    0
];
// Check if the important parameters are posted !
if(!isset($_POST['first_name'])
    || !isset($_POST['last_name'])
    || !isset($_POST['stuid'])
    || !isset($_POST['cellphone_num'])
    || !isset($_POST['uni_level'])
    || !isset($_POST['my_job'])
    || !isset($_POST['my_time'])
    || !isset($_POST['computer_status'])
    || !isset($_POST['skill_type'])
    || !isset($_POST['skill_translate'])
    || !isset($_POST['skill_theme_design'])
    || !isset($_POST['skill_mysql'])
    || !isset($_POST['skill_html_css'])
    || !isset($_POST['skill_js'])
    || !isset($_POST['skill_php'])
    || !isset($_POST['skill_cs']))
    die('0');
// Check if the provided first name is valid
$data['first_name'] = addslashes($_POST['first_name']);
$len = strlen($data['first_name']);
if($len > 32 || $len < 4 || !mb_check_encoding($data['first_name'], 'UTF-8'))
    die('0');
// Check if the provided last name is valid
$data['last_name'] = addslashes($_POST['last_name']);
$len = strlen($data['last_name']);
if($len > 64 || $len < 8 || !mb_check_encoding($data['last_name'], 'UTF-8'))
    die('0');
// Check if the provided student-id is valid
$data['stuid'] = addslashes($_POST['stuid']);
$len = strlen($data['stuid']);
if($len != 9 || !is_numeric($data['stuid']) || $data['stuid'][0] != '9')
    die('0');
// Check if the provided cellphone number is valid
$data['cellphone_num'] = addslashes($_POST['cellphone_num']);
$len = strlen($data['cellphone_num']);
if(!is_numeric($data['cellphone_num']))
    die('0');
if($len == 10) {
    if($data['cellphone_num'][0] != '9')
        die('0');
}
else if($len == 11) {
    if($data['cellphone_num'][0] != '0' || $data['cellphone_num'][1] != '9')
        die('0');
    $data['cellphone_num'] = substr($data['cellphone_num'], 1);
}
else die('0');
// Check if the Github address is provided
if(isset($_POST['github_addr'])) {
    $data['github_addr'] = addslashes($_POST['github_addr']);
    $len = strlen($data['github_addr']);
    if($len < 2 || $len > 256 || !filter_var($data['github_addr'], FILTER_VALIDATE_URL))
        die('0');
}
// Check if the CV address is provided
if(isset($_POST['cv_addr'])) {
    $data['cv_addr'] = addslashes($_POST['cv_addr']);
    $len = strlen($data['cv_addr']);
    if($len < 2 || $len > 256 || !filter_var($data['cv_addr'], FILTER_VALIDATE_URL))
        die('0');
}
// Check if the SOP address is provided
if(isset($_POST['sop_addr'])) {
    $data['sop_addr'] = addslashes($_POST['sop_addr']);
    $len = strlen($data['sop_addr']);
    if($len < 2 || $len > 256 || !filter_var($data['sop_addr'], FILTER_VALIDATE_URL))
        die('0');
}
// Check if the provided uni-level is valid (university level)
switch (($data['uni_level'] = $_POST['uni_level'])) {
    case '0':case '1':break;
    default:
        die('0');
}
// Check if the job is provided
switch (($data['my_job'] = $_POST['my_job'])) {
    case '0':case '1':case '2':break;
    default:
        die('0');
}
// Check if the time is provided
switch (($data['my_time'] = $_POST['my_time'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':break;
    default:
        die('0');
}
// Check if the computer-status is provided
switch (($data['computer_status'] = $_POST['computer_status'])) {
    case '0':case '1':case '2':break;
    default:
        die('0');
}
// Check if the typing-skill is provided
switch (($data['skill_type'] = $_POST['skill_type'])) {
    case '0':case '1':case '2':break;
    default:
        die('0');
}
// Check if the translate-skill is provided
switch (($data['skill_translate'] = $_POST['skill_translate'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':break;
    default:
        die('0');
}
// Check if the theme-design-skill is provided
switch (($data['skill_theme_design'] = $_POST['skill_theme_design'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':break;
    default:
        die('0');
}
// Check if the theme-design-skill is provided
switch (($data['skill_theme_design'] = $_POST['skill_theme_design'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':break;
    default:
        die('0');
}
// Check if the mysql-skill is provided
switch (($data['skill_mysql'] = $_POST['skill_mysql'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':break;
    default:
        die('0');
}
// Check if the html-css-skill is provided
switch (($data['skill_html_css'] = $_POST['skill_html_css'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':case '7':break;
    default:
        die('0');
}
// Check if the javascript-skill is provided
switch (($data['skill_js'] = $_POST['skill_js'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':case '7':case '8':case '9':break;
    default:
        die('0');
}
// Check if the php-skill is provided
switch (($data['skill_php'] = $_POST['skill_php'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':case '7':case '8':case '9':break;
    default:
        die('0');
}
// Check if the CS-skill is provided
switch (($data['skill_cs'] = $_POST['skill_cs'])) {
    case '0':case '1':case '2':case '3':case '4':case '5':case '6':case '7':case '8':case '9':break;
    default:
        die('0');
}
// Check the courses
for ($i = 1; $i <= 17; $i++) {
    $course_name = 'course_'.$i;
    if(isset($_POST[$course_name])) {
        switch (($data[$course_name] = $_POST[$course_name])) {
            case '0':case '1':break;
            default:
                die('0');
        }
    }
}
// Database server connection
if(!($db_conn = mysqli_connect(DATABASE[0], DATABASE[1], DATABASE[2], DATABASE[3], DATABASE[4])))
    die('0');
// Create query
$data['ip'] = ip2long($_SERVER['REMOTE_ADDR']);
$data['time'] = strtotime('now');
$query = "INSERT INTO `stu` (";
foreach ($data as $key => $val)
    $query .= "`".$key."`,";
$query[strlen($query)-1] = ')';
$query .= ' VALUES (';
foreach ($data as $key => $val)
    $query .= "'".$val."',";
$query[strlen($query)-1] = ')';
// Send query to database server
if(!mysqli_query($db_conn, $query))
    die('0');
// Close database connection
mysqli_close($db_conn);
// Exit Success
die('1');
