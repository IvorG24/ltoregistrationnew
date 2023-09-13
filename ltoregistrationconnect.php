<?php
$serverName = "LAPTOP-H96FD3CI\\SQLEXPRESS";
$connectionOptions = [
    "Database" => "WEBAPP",
    "Uid" => "",
    "PWD" => ""
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn == false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo 'Connection Success';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST['Lastname'];
    $firstname = $_POST['Firstname'];
    $middlename = $_POST['Middlename'];
    $street = $_POST['Street'];
    $province = $_POST['Province'];
    $place = $_POST['City'];
    $contact = $_POST['Contact'];
    $tin = $_POST['Tin'];
    $nationality = $_POST['Nationality'];
    $gender = $_POST['Gender'];
    $birthdate = $_POST['Birthday'];
    $height = $_POST['Height'];
    $weight = $_POST['Weight'];
    $a = isset($_POST['A']) ? $_POST['A'] : 0;
    $b = isset($_POST['B']) ? $_POST['B'] : 0;
    $c = isset($_POST['C']) ? $_POST['C'] : 0;
    $d = isset($_POST['D']) ? $_POST['D'] : 0;
    $e = isset($_POST['E']) ? $_POST['E'] : 0;
    $f = isset($_POST['F']) ? $_POST['F'] : 0;
    $g = isset($_POST['G']) ? $_POST['G'] : 0;
    $h = isset($_POST['H']) ? $_POST['H'] : 0;
    $i = isset($_POST['I']) ? $_POST['I'] : 0;
    $j = isset($_POST['J']) ? $_POST['J'] : 0;
    $k = isset($_POST['K']) ? $_POST['K'] : 0;
    $l = isset($_POST['L']) ? $_POST['L'] : 0;
    $m = isset($_POST['M']) ? $_POST['M'] : 0;
    $n = isset($_POST['N']) ? $_POST['N'] : 0;
    $l1 = isset($_POST['License']) && $_POST['License'] === '1' ? 1 : 0;
    $l2 = isset($_POST['License']) && $_POST['License'] === '2' ? 1 : 0;
    $l3 = isset($_POST['License']) && $_POST['License'] === '3' ? 1 : 0;
    $l4 = isset($_POST['License']) && $_POST['License'] === '4' ? 1 : 0;
    $d1 = isset($_POST['Skill']) && $_POST['Skill'] === '1' ? 1 : 0;
    $d2 = isset($_POST['Skill']) && $_POST['Skill'] === '2' ? 1 : 0;
    $e1 = isset($_POST['Education']) && $_POST['Education'] === '1' ? 1 : 0;
    $e2 = isset($_POST['Education']) && $_POST['Education'] === '2' ? 1 : 0;
    $e3 = isset($_POST['Education']) && $_POST['Education'] === '3' ? 1 : 0;
    $e4 = isset($_POST['Education']) && $_POST['Education'] === '4' ? 1 : 0;
    $e5 = isset($_POST['Education']) && $_POST['Education'] === '5' ? 1 : 0;
    $e6 = isset($_POST['Education']) && $_POST['Education'] === '6' ? 1 : 0;
    $bloodtype = $_POST['bloodtype'];
    $organdonor = $_POST['organdonor'];
    $civilstatus = $_POST['status'];
    $hair = $_POST['hair'];
    $eyes = $_POST['eyes'];
    $built = $_POST['built'];
    $complexion = $_POST['complexion'];
    $fatherslastname = $_POST['fatherslast'];
    $fathersfirstname = $_POST['fathersfirst'];
    $fatherslastnamemiddlename = $_POST['fathersmiddle'];
    $motherslastname = $_POST['motherslast'];
    $mothersfirstname = $_POST['mothersfirst'];
    $mothersmiddlename = $_POST['mothersmiddle'];
    $spouselastname = $_POST['spouselast'];
    $spousefirstname = $_POST['spousefirst'];
    $spousemiddlename = $_POST['spousemiddle'];
    $birthplace=$_POST['birthplace'];
    $businessname=$_POST['businessname'];
    $businesscontact=$_POST['buscont'];
    $businessaddress=$_POST['businessadd'];
    $prevlastname = isset($_POST['Lastnameprev']) ? $_POST['Lastnameprev'] : 'none';
    $prevfirstname = isset($_POST['Firstnameprev']) ? $_POST['Firstnameprev'] : 'none';
    $prevmiddlename = isset($_POST['Middlenameprev']) ? $_POST['Middlenameprev'] : 'none';
    $signature=$_POST['signaturecert'];
    

    // Sanitize user input and use prepared statements to prevent SQL injection 

    $sourceQuery1 = "SELECT MAX(USERID) AS LatestUserID FROM USERDATA"; 
    $sourceResult1 = sqlsrv_query($conn, $sourceQuery1);
    //for user ID
    if ($sourceResult1 === false) {
    die(print_r(sqlsrv_errors(), true));
    }

    $row1 = sqlsrv_fetch_array($sourceResult1, SQLSRV_FETCH_ASSOC);
    $latestUserID = $row1['LatestUserID'];
   
    if ($latestUserID === null) {
        $userID = 100;
    } else {
        $userID = $latestUserID + 1;
    }
    // For applicationID
    $sourceQuery2 = "SELECT MAX(APPLICATIONID) AS LatestApplicationID FROM CATEGORY_DETAILS"; 
    $Resultappid = sqlsrv_query($conn, $sourceQuery2);

    if ($Resultappid === false) {
    die(print_r(sqlsrv_errors(), true));
    }

    $row2 = sqlsrv_fetch_array($Resultappid, SQLSRV_FETCH_ASSOC);
    $latestApplicationID = $row2['LatestApplicationID'];
   
    if ($latestApplicationID === null) {
        $applicationID = 300;
    } else {
        $applicationID = $latestApplicationID + 1;
    }

    //INSERT DATA FOR USERDATA
    $sqlcall1 = "INSERT INTO USERDATA (LASTNAME, FIRSTNAME, MIDDLENAME, STREET, PROVINCE, CITY, CONTACT, TIN, NATIONALITY, GENDER, BIRTHDATE, HEIGHT, WEIGHT) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params1 = array(
        $lastname, $firstname, $middlename, $street, $province, $place, $contact, $tin, $nationality, $gender, $birthdate, $height, $weight );
    $sql1 = sqlsrv_prepare($conn, $sqlcall1, $params1);

    //INSERT DATA FOR CATEGORY_DETAILS
    $sqlcall2 = "INSERT INTO CATEGORY_DETAILS (A, B, C, D, E, F, G, H, I, J, K, L, M, N, L1, L2, L3, L4, D1, D2, E1, E2, E3, E4, E5, E6, USERID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $params2 = array(
    $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n, $l1, $l2, $l3, $l4, $d1, $d2, $e1, $e2, $e3, $e4, $e5, $e6, $userID);
    $sql2 = sqlsrv_prepare($conn, $sqlcall2, $params2);

    //INSERT DATA FOR USERBIO
    $sqlcall3 = "INSERT INTO USERBIO (BLOODTYPE, ORGANDONOR, CIVILSTATUS, HAIR, EYES, BUILT, COMPLEXION, USERID, APPLICATIONID,FATHERSLASTNAME,FATHERSFIRSTNAME,FATHERSMIDDLENAME,MOTHERSLASTNAME,MOTHERSFIRSTNAME,MOTHERSMIDDLENAME,SPOUSELASTNAME,SPOUSEFIRSTNAME,SPOUSEMIDDLENAME,BIRTHPLACE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?)";

    $params3 = array(
        $bloodtype, $organdonor, $civilstatus, $hair, $eyes, $built, $complexion, $userID, $applicationID,
        $fatherslastname, $fathersfirstname, $fatherslastnamemiddlename,
        $motherslastname, $mothersfirstname, $mothersmiddlename,
        $spouselastname, $spousefirstname, $spousemiddlename,
        $birthplace
    );
    
    $sql3 = sqlsrv_prepare($conn, $sqlcall3, $params3);

    //INSERT DATA FOR WORK

    $sqlcall4 = "INSERT INTO WORK (BUSINESSNAME, BUSINESSCONTACT, BUSINESSADDRESS, PREVLASTNAME, PREVFIRSTNAME, PREVMIDDLENAME, USERID, SIGNATURE) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $params4 = array(
        $businessname, $businesscontact, $businessaddress,
        $prevlastname, $prevfirstname, $prevmiddlename,
        $userID, $signature
    );
    $sql4 = sqlsrv_prepare($conn, $sqlcall4, $params4);


    if (sqlsrv_execute($sql1 )) {
        echo 'Registration success';
    } else {
        echo 'Error';
    }
}

    if (sqlsrv_execute($sql2 )) {
    echo 'Registration success';
    } else {
    echo 'Error';
    }

    if (sqlsrv_execute($sql3 )) {
        echo 'Registration success';
        } else {
        echo 'Error';
        }
    if (sqlsrv_execute($sql4 )) {
          echo 'Registration success';
          } else {
         echo 'Error';
         }       
?>
