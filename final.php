<?php
 $dob = $_GET['dob'] ?? ''; 
 $message = '';

# Validate Date of Birth
 if (empty($dob)){
# the user's date of birth cannot be a null string
  $message = 'Please submit your date of birth.';
 }
 elseif (!preg_match('~^([0-9]{2})/([0-9]{2})/([0-9]{4})$~', $dob, $parts)){


# Check the format
  $message = 'The date of birth is not a valid date in the format MM/DD/YYYY';
 }
 elseif (!checkdate($parts[1],$parts[2],$parts[3])){
  $message = 'The date of birth is invalid. Please check that the month is between 1 and 12, and the day is valid for that month.';
 }
 
 if ($message == '') {
  
  
# Convert date of birth to DateTime object
  $dob =  new DateTime($dob);

  $minInterval = DateInterval::createFromDateString('18 years');

 
  $minDobLimit = ( new DateTime() )->sub($minInterval);


# Check whether the user is 18 years old.
  if ($dob >= $minDobLimit) {
   $message = 'You are not old enough to use this site.';
  }
 
  if ($message == '') {
   $today = new DateTime();
   $diff = $today->diff($dob);
    echo '"Welcome ';
    echo $_GET ['fname'];
    echo $diff->format(' ,you are %Y years old."');
  }
 }
?>
<p><b><?=$message?></b></p>