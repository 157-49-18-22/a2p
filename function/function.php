<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$siteTitle = 'Full_ecom';
session_start();
define('SITE_URL', 'https://pink-sheep-796549.hostingersite.com/');
define('SITE_TITLE', 'Ssts');
function getPDOObject()
{
	$dsn = 'mysql:host=localhost;dbname=u435351083_cms;charset=utf8mb4';
	$user = 'u435351083_jms';
	$pass = 'Maydivjms1@3';
	$pdo = new PDO($dsn, $user, $pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$pdo->setAttribute(PDO::ATTR_PERSISTENT, true);

	return $pdo;
}

function makeurlnamebynameCategory($str)
{
    //$lowertext = preg_replace('/[^A-Za-z0-9\-]/', '', $lowertext);
    $inputstring = trim(strip_tags($str));
    $lowertext = strtolower($inputstring);
    $lowertext = str_replace("  ", "-", $lowertext);
    $lowertext = str_replace(" ", "-", $lowertext);
    $lowertext = str_replace("&", "and", $lowertext);
    $lowertext = str_replace("/", "-", $lowertext);
    $lowertext = str_replace("`", "-", $lowertext);
    $lowertext = str_replace("~", "-", $lowertext);
    $lowertext = str_replace("!", "-", $lowertext);
    $lowertext = str_replace("@", "-", $lowertext);
    $lowertext = str_replace("#", "-", $lowertext);
    $lowertext = str_replace("$", "-", $lowertext);
    $lowertext = str_replace("^", "-", $lowertext);
    $lowertext = str_replace("&", "-", $lowertext);
    $lowertext = str_replace("*", "-", $lowertext);
    $lowertext = str_replace("(", "-", $lowertext);
    $lowertext = str_replace(")", "-", $lowertext);
    $lowertext = str_replace("_", "-", $lowertext);
    $lowertext = str_replace("-", "-", $lowertext);
    $lowertext = str_replace("|", "-", $lowertext);
    $lowertext = str_replace("{", "-", $lowertext);
    $lowertext = str_replace("}", "-", $lowertext);
    $lowertext = str_replace("[", "-", $lowertext);
    $lowertext = str_replace("]", "-", $lowertext);
    $lowertext = str_replace(":", "-", $lowertext);
    $lowertext = str_replace(";", "-", $lowertext);
    $lowertext = str_replace("<", "-", $lowertext);
    $lowertext = str_replace(">", "-", $lowertext);
    // Remove replacing dot with hyphen
    // $lowertext = str_replace(".", "-", $lowertext);
    $lowertext = str_replace("?", "-", $lowertext);
    $lowertext = str_replace("%", "percent", $lowertext);
    $lowertext = str_replace("--", "-", $lowertext);
    $lowertext = str_replace("---", "-", $lowertext);
    $lowertext = str_replace(" ", "-", $lowertext);
    $lowertext = str_replace("'", "-", $lowertext);
    $lowertext = str_replace(",", "-", $lowertext);
    // Remove extra dot replacing
    // $lowertext = str_replace(".", "-", $lowertext);
    return $lowertext;
}


function makeurlnormal($str)
{
	//$lowertext = preg_replace('/[^A-Za-z0-9\-]/', '', $lowertext);
	$inputstring = trim(strip_tags($str));
	$lowertext = strtolower($inputstring);
	$lowertext = str_replace("  ", " ", $lowertext);
	$lowertext = str_replace(" ", " ", $lowertext);
	$lowertext = str_replace("&", "and", $lowertext);
	$lowertext = str_replace("/", " ", $lowertext);
	$lowertext = str_replace("`", " ", $lowertext);
	$lowertext = str_replace("~", " ", $lowertext);
	$lowertext = str_replace("!", " ", $lowertext);
	$lowertext = str_replace("@", " ", $lowertext);
	$lowertext = str_replace("#", " ", $lowertext);
	$lowertext = str_replace("$", " ", $lowertext);
	$lowertext = str_replace("^", " ", $lowertext);
	$lowertext = str_replace("&", " ", $lowertext);
	$lowertext = str_replace("*", " ", $lowertext);
	$lowertext = str_replace("(", " ", $lowertext);
	$lowertext = str_replace(")", " ", $lowertext);
	$lowertext = str_replace("_", " ", $lowertext);
	$lowertext = str_replace("-", " ", $lowertext);
	$lowertext = str_replace("|", " ", $lowertext);
	$lowertext = str_replace("{", " ", $lowertext);
	$lowertext = str_replace("}", " ", $lowertext);
	$lowertext = str_replace("[", " ", $lowertext);
	$lowertext = str_replace("]", " ", $lowertext);
	$lowertext = str_replace(":", " ", $lowertext);
	$lowertext = str_replace(";", " ", $lowertext);
	$lowertext = str_replace("<", " ", $lowertext);
	$lowertext = str_replace(">", " ", $lowertext);
	$lowertext = str_replace(".", " ", $lowertext);
	$lowertext = str_replace("?", " ", $lowertext);
	$lowertext = str_replace("%", "percent", $lowertext);
	$lowertext = str_replace("--", " ", $lowertext);
	$lowertext = str_replace("---", " ", $lowertext);
	$lowertext = str_replace(" ", " ", $lowertext);
	$lowertext = str_replace("'", " ", $lowertext);
	$lowertext = str_replace(",", " ", $lowertext);
	$lowertext = str_replace(".", " ", $lowertext);
	return $lowertext;
}
function insert($table, $data)
{
	$pdo = getPDOObject();

	// $fld_str='';$val_str='';
	// if($table_name && is_array($data_array))
	// {
	$sql = "SHOW COLUMNS FROM `" . $table . "`";
	$columns_query = sqlfetch($sql);

	foreach ($columns_query as $coloumn_data)
		$column_name[] = $coloumn_data['Field'];
	// print_r($column_name);  

	if (!empty($data) && is_array($data)) {
		$columns = '';
		$values  = '';
		$i = 0;
		if (!array_key_exists('created', $data)) {
			$data['created'] = date("Y-m-d H:i:s");
		}
		if (!array_key_exists('modified', $data)) {
			$data['modified'] = date("Y-m-d H:i:s");
		}

		$actual_data = array();

		foreach ($data as $key => $val) {
			if (in_array($key, $column_name)) {
				// echo $key;
				$actual_data[$key] = $val;
			}
		}
		// print_r($actual_data);
		$columnString = implode(',', array_keys($actual_data));
		$valueString = ":" . implode(',:', array_keys($actual_data));
		$sql = "INSERT INTO " . $table . " (" . $columnString . ") VALUES (" . $valueString . ")";
		$query = $pdo->prepare($sql);
		foreach ($actual_data as $key => $val) {
			$val = htmlspecialchars(strip_tags($val));
			$query->bindValue(":" . $key, $val);
		}
		$insert = $query->execute();
		if ($insert) {
			$data['id'] = $pdo->lastInsertId();
			return $data;
		} else {
			return false;
		}
	} else {
		return false;
	}
}


function sqlfetch($query)
{
	$row = array();
	$pdo = getPDOObject();
	$sql = $pdo->query($query);

	$datas = $sql->fetchAll(PDO::FETCH_ASSOC);
	foreach ($datas as $data)
		$row[] = $data;
	return $row;
}

function get_active_status_text($num)
{
	$status = '';
	if ($num == 0)
		$status = '<span class="label label-default">Deactive</span>';
	if ($num == 1)
		$status = '<span class="label label-success">Active</span>';
	return $status;
}


function get_category_name($id)
{

	$name = '';
	$sql = sqlfetch("SELECT * FROM category where name='$id'");
	if (count($sql))
		foreach ($sql as $category)
			$name = $category['id'];
	return $name;
}

function get_product_name($id)
{
	$name = '';
	$sql = sqlfetch("SELECT * FROM product where id='$id'");
	if (count($sql))
		foreach ($sql as $product)
			$name = $product['name'];
	return $name;
}

function get_subproduct_name($id)
{
	$name = '';
	$sql = sqlfetch("SELECT * FROM subproduct where id='$id'");
	if (count($sql))
		foreach ($sql as $product)
			$name = $product['name'];
	return $name;
}


function get_category_id($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM category where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $category)
			$id = $category['id'];
	return $id;
}

function get_subcategory_id($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM subcategory where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $category)
			$id = $category['id'];
	return $id;
}

function get_blog_id($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM pages where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $category)
			$id = $category['id'];
	return $id;
}

function get_product_id($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM product where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $product)
			$id = $product['id'];
	return $id;
}


function get_subproduct_id($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM subproduct where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $product)
			$id = $product['id'];
	return $id;
}

function get_product_cat($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM product where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $product)
			$id = $product['subcat'];
	return $id;
}

function get_subproduct_prod($name)
{

	$id = 0;
	$sql = sqlfetch("SELECT * FROM subproduct where name='$name' order by fld_order limit 1");
	if (count($sql))
		foreach ($sql as $product)
			$id = $product['subcat'];
	return $id;
}

function get_num_sub_prod($id)
{

	$count = 0;
	$sql = sqlfetch("SELECT * FROM `subproduct` where subcat='$id'");
	if (count($sql))
		$count = count($sql);
	return $count;
}

function get_page_id($name)
{
	$categoryname = '';
	$data = sqlfetch("SELECT * FROM pages where name='$name'");
	foreach ($data as $category) {
		$categoryname = $category['id'];
	}
	return $categoryname;
}


function get_first_prod_by_cat($id)
{
	$data = sqlfetch("SELECT * FROM product where subcat='$id' order by id limit 1");
	foreach ($data as $product)
		$pid = $product['id'];
	return $pid;
}

function custom_echo($x, $length)
{
	if (strlen($x) <= $length) {
		echo $x;
	} else {
		$y = substr($x, 0, $length) . '...';
		echo $y;
	}
}
