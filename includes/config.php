<?php

// use this file to configire the settings for your library

// Name of your Library - Not used for this program
define("institutionName", "Your Library");

// URL of your DB server - Not used for this program
define("dbServer", "your-sierra-db-server");

// URL of your Encore server - Not used for this program
define("encoreServer", "encore.server.url.ca");

// URL of your app server
define("appServer", "your-server-name");

// API Version - This app uses 4
define("apiVer", "5");

// Your API Key
define("apiKey", "your API key");

// Your API Secret
define("apiSecret", "your secret");

// Number of results you want to use.  Best to have it a large number so all expired patrons get emailed.
define("numberOfResults", "10000");

// For future development - No need to change at this time
define("resultOffset", "0");

// Email that the mail that is sent out will be from
define("mailFrom", "your-email@your-library");

// Subject of the email
define("mailSubject", "Your Library Card is expiring soon");

// this defines the email that will be sent out.  The email will start with "Dear <Person's first name>"
define("emailBody", '
  <p>This is a courtesy notice to inform you that your library card will expire on <b>');
define("emailBody_3", '</b> Please <b>visit</b> or <b>call Your Library to renew your card</b> so you can continue to enjoy our services and digital downloads. You may renew in person or by telephone at one of our locations.');

//set the following variable to 1 if you want CC emails sent 0 if you dont.
define("sendCCEmail", "1");

// the following line if you want to send a CC of all emails to a different email
//this is useful if you have a mailbox that you use to keep track of these types of $email_headers

 define("ccAddress", "your-email@your-library");

 //set the following variable to 1 if you want a summary emails sent 0 if you dont.
 define("sendSummaryEmail", "1");

 //set this to the email address you want your summary emails to be sent to
define("summaryEmailAddress", "your-email@your-library");




?>
