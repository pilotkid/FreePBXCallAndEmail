# FreePBXCallAndEmail
Files to add to your Freepbx instance to allow HTML emails and click to call

https://youtu.be/8P2_djhhloY

# Call Via URL

1) Login to the FreePBX dashboard
2) Goto Settings->Asterisk Manager Users
3) Click Add Manager
4) Fill in Manager Name
5) Use a secure machine generated password
6) Set writetimeout to 1000 miliseconds
7) Submit Changes
8) Apply configuration
9) Download Call.php
10) Open Call.php
11) Change $strUser to the asterisk manager name that you just created
12) Change $strSecretto the asterisk password for the manager that you just created
13) Open scp connection to your pbx server
14) Navigate to /var/www/html
15) Upload Call.php



# HTML EMAILS

1) Download htmlemails
2) Open scp connection to your pbx server
3) Navigate to /usr/local/bin/
4) Upload htmlemails
5) Login to FreePBX Dashboard
6) Goto Settings->Voicemail Admin->Settings->Email Config
7) Set Mail Command to /usr/local/bin/htmlemails
8) Set the html contents for the body
9) Submit changes
10) Apply Config
