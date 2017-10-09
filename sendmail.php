<?php

include "mail/class.phpmailer.php";

$fname = $_POST['fname'];
$lname = $_REQUEST['lname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$message = $_POST['message'];

$html_body = '<html lang="en">
<head>
<meta charset="utf-8" />
<title>Table Style</title>
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

.table-title h3,body{font-weight:400;font-family:Roboto,helvetica,arial,sans-serif}.table-fill,div.table-title{margin:auto;max-width:600px;padding:5px;width:100%}td,th{vertical-align:middle;text-align:left}.table-title h3,td{text-shadow:-1px -1px 1px rgba(0,0,0,.1)}td,th,th.text-left{text-align:left}body{background-color:#3e94ec;font-size:16px;text-rendering:optimizeLegibility}div.table-title{display:block}.table-title h3{color:#fafafa;font-size:30px;font-style:normal;text-transform:uppercase}.table-fill{background:#fff;border-radius:3px;border-collapse:collapse;height:320px;box-shadow:0 5px 10px rgba(0,0,0,.1);animation:float 5s infinite}th{color:#D5DDE5;background:#1b1e24;border-bottom:4px solid #9ea7af;border-right:1px solid #343a45;font-size:23px;font-weight:100;padding:24px;text-shadow:0 1px 1px rgba(0,0,0,.1)}th:first-child{border-top-left-radius:3px}th:last-child{border-top-right-radius:3px;border-right:none}tr{border-top:1px solid #C1C3D1;border-bottom-:1px solid #C1C3D1;color:#666B85;font-size:16px;font-weight:400;text-shadow:0 1px 1px rgba(256,256,256,.1)}tr:first-child{border-top:none}tr:last-child{border-bottom:none}tr:nth-child(odd) td{background:#EBEBEB}tr:nth-child(odd):hover td{background:#4E5066}tr:last-child td:first-child{border-bottom-left-radius:3px}tr:last-child td:last-child{border-bottom-right-radius:3px}td{background:#FFF;padding:20px;font-weight:300;font-size:18px;border-right:1px solid #C1C3D1}td:last-child{border-right:0}th.text-center{text-align:center}th.text-right{text-align:right}td.text-left{text-align:left}td.text-center{text-align:center}td.text-right{text-align:right}

</style>
</head>
<body>
<div class="table-title">
<h3>Data Table</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left" colspan="2"><center>Contact Form Details</center></th>
</tr>
</thead>
<tbody class="table-hover">
<tr>
<td class="text-left">First Name</td>
<td class="text-left">'.$fname.'</td>
</tr>
<tr>
<td class="text-left">Last Name</td>
<td class="text-left">'.$lname.'</td>
</tr>
<tr>
<td class="text-left">Email</td>
<td class="text-left">'.$email.'</td>
</tr>
<tr>
<td class="text-left">Contact</td>
<td class="text-left">'.$mobile.'</td>
</tr>
<tr>
<td class="text-left">Message</td>
<td class="text-left">'.$message.'</td>
</tr>							
</tbody>
</table>
</body>';

$mail_sent_admin = send_admin_mail($html_body);	

if($mail_sent_admin == 1){		
	$data = array();
	$data['status'] = 'success';
	$data['code'] = '1';
	$data['message'] = 'Mail sent successfully.';
}else{
	$data = array();
	$data['status'] = 'failed';
	$data['code'] = '0';
	$data['message'] = 'Message sending failled';
}
echo json_encode($data, true);



function send_admin_mail($mailContent){ 

	$subject = "Marathi Literature Festival";
	date_default_timezone_set('Asia/Calcutta');
	
	$mail = new PHPMailer();
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->IsHTML(true);

	$mail->Username = "asmitahospitality1@gmail.com";
	$mail->Password = "click@123";
	$mail->setFrom('asmitahospitality1@gmail.com', 'Marathi Literature Festival');                                

	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->MsgHTML($mailContent);
	$mail->AddAddress('prajwal.p@mobisofttech.co.in');

	if(!$mail->Send()){
		return json_encode("Mailer Error: " . $mail->ErrorInfo);
	}else{
		return 1;
	}        
	$mail->ClearAddresses(); 
}

?>