<?php
if(isset($_POST['add-school'])){
  //Get the form data and remove the white space

  $name = strip_tags(trim($_POST['schoolName']));
  $name = str_replace(array("\r", "\n"), array(" ", " "), $name);

  $state = trim($_POST['state']);
  $schoolType = trim($_POST['schoolType']);
  $ownership = trim($_POST['ownership']);
  $address = trim($_POST['address']);
  $year = trim($_POST['year']);
  $contact = trim($_POST['contact']);

  //Check that all form fields are filled
  if(empty($name) OR empty($state) OR empty($schoolType) OR empty($ownership) OR empty($address) OR empty($year) OR empty($contact)){
    //Set a bad response and exit
    http_response_code(400);
    echo 'Oops! There was a problem with your submission. Complete the form and try again.';
    exit;
  }

  //Setup email recipient and content.

  $recipient = 'noblejoeuc@gmail.com';

  $subject = 'Add New School for the Deaf';

  $email_content = "Name: $name\r\n";
  $email_content .= "State: $state\r\n";
  $email_content .= "School Type: $schoolType\r\n";
  $email_content .= "Ownership: $ownership\r\n";
  $email_content .= "Address: $address\r\n";
  $email_content .= "Year: $year\r\n";
  $email_content .= "Contact: $contact";


  //Build the email headers
  $email_headers = 'From: schools@schoolsforthedeaf.org.ng' . "\r\n" .
                    'Reply-To: info@afriknet.com' . "\r\n" .
                    'X-Mailer: PHP/' .phpversion();


  //Send the email
  if(mail($recipient, $subject, $email_content, $email_headers)){
    //Set success response code
    http_response_code(200);
    echo 'Thank You! Your message has been sent.';
  }else{
    //Set a 500 internal error server response code.
    http_response_code(500);
    echo 'Oops! Something weent wrong and we could not find your message';
  }
}
