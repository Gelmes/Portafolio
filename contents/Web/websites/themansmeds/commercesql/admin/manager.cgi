#!/usr/bin/perl

#########################################################################
#
# Copyright (c) 2000 Internet Express Products
# All Rights Reserved.
#
# This software is the confidential and proprietary information of
# Internet Express Products.  You shall
# not disclose such Confidential Information and shall use it only in
# accordance with the terms of the license agreement you entered into
# with Internet Express Products.
#
# Internet Express Products MAKES NO REPRESENTATIONS OR WARRANTIES ABOUT
# THE SUITABILITY OF THE SOFTWARE, EITHER EXPRESSED OR IMPLIED,
# INCLUDING BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF
# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE,
# OR NON-INFRINGEMENT.
#
# INTERNET EXPRESS PRODUCTS SHALL NOT BE LIABLE FOR ANY DAMAGES SUFFERED BY
# LICENSEE AS A RESULT OF USING, MODIFYING OR DISTRIBUTING THIS
# SOFTWARE OR ITS DERIVATIVES.
#
# MANAGER.CGI is FREE to use for your own personal use whether it be
# for you or your business.
#
# You may not give this script away or distribute it an any way without
# written permission.
#
# This script is designed as an aid in setting up the shopping cart tables
# and for use with our Webstore Manager software program.
#
# http://commercesql.com/utilities.htm
#
##########################################################################

use CGI;
use CGI::Carp qw/fatalsToBrowser/;

use DBI;

$len = length($ENV{'SCRIPT_FILENAME'})-18;
$mypath = substr($ENV{'SCRIPT_FILENAME'},0,$len);

require "./configuration.pl";
require "./admin_conf.pl";

$header = qq~
   <head>
   <META HTTP-EQUIV="Cache-Control" Content="no-cache">
   <META HTTP-EQUIV="Pragma" Content="no-cache">
   <title>Webstore Manager</title>
   </head>
~;

%form_data = &get_data();

if ($form_data{'action'} eq "upload") {
   &upload;
} elsif ($form_data{'action'} eq "export") {
   &export;
} elsif ($form_data{'action'} eq "export_prd") {
   &export_prd;
} elsif ($form_data{'action'} eq "create") {
   &create;
} elsif ($form_data{'action'} eq "email") {
   &email;
} elsif ($form_data{'password'}) {
   &pass;
} elsif ($form_data{'action'} eq "password") {
   &passform;
} else {
   &frontpage;
}

exit;

############################################################
# Frontpage
############################################################

sub frontpage
{
   print "Content-type: text/html\n\n";
   print qq~
      <html>
      $header
      <body>
      <center>manager.cgi must be called with a command!
      </body>
      </html>
   ~;
}

############################################################
# Password input form
############################################################

sub passform
{
   print "Content-type: text/html\n\n";
   print qq~
      <html>
      $header
      <body>
      <form method="POST" action="manager.cgi">
        <p align="center">Username: <input type="text" name="username" size="20"></p>
        <p align="center">Password: <input type="text" name="password" size="20"></p>
        <p align="center"><input type="submit" value="Submit" name="B1"></p>
      </form>
      </body>
      </html>
   ~;
}

############################################################
# Password the admin folder
############################################################

sub pass
{
   $password = crypt($form_data{'password'}, "YL");
   open (PASSFILE, ">.htpasswd");
   print PASSFILE "$form_data{'username'}\:";
   print PASSFILE "$password\n";
   close(PASSFILE);

   $mylength = length($ENV{'SCRIPT_FILENAME'})-12;
   $path = substr($ENV{'SCRIPT_FILENAME'},0,$mylength);
   open (ACCESSFILE, ">.htaccess");
   print ACCESSFILE "Options All\n";
   print ACCESSFILE "AuthType \"Basic\"\n";
   print ACCESSFILE "AuthName \"Protected Access\"\n";
   print ACCESSFILE "AuthUserFile $path/.htpasswd\n";
   print ACCESSFILE "<Limit GET>\n";
   print ACCESSFILE "require valid-user\n";
   print ACCESSFILE "</Limit>\n";

   print "Content-type: text/html\n\n";

   print qq~
      <html>
      $header
      <body bgcolor="#ffffff">
      <center>
      <p>Your username $form_data{'username'} and password $form_data{'password'} ($password) has been set</p>
      </center>
      </body>
      </html>
   ~;
}

############################################################
# Upload products from data.file to product table
############################################################

sub upload
{
   print "Content-type: text/html\n\n";

   $data_file_path = "$mypath/admin/files/data.file";

   $dbh = DBI->connect("dbi:mysql:$sc_mysql_database_name:$sc_mysql_server_name","$sc_mysql_user_name","$sc_mysql_password") || die "Couldn't connect to database: " . DBI->errstr;

   $query = "DELETE FROM product";
   $dbh->do($query) || print "Error: $DBI::errstr<br>\n";

#   $query = "LOAD DATA INFILE \"$data_file_path\" INTO TABLE product FIELDS TERMINATED BY \"|\"";
#   $dbh->do($query);

   open (DATA_FILE, "<$data_file_path");

   while (<DATA_FILE>)
   {
       @datafields = split(/\|/, $_);
       $datafields[1] =~ s/\'/\\\'/g;

       $datafield_three = $datafields[3];
       $datafield_three =~ s/\'/\\\'/g;
       $datafield_three =~ s/\|/\\\|/g;
       $datafield_three =~ s/\$/\\\$/g;
       $datafield_three =~ s/\^/\\\^/g;
       $datafield_three =~ s/\}/\\\}/g;
       $datafield_three =~ s/\{/\\\{/g;
       $datafield_three =~ s/\(/\\\(/g;
       $datafield_three =~ s/\)/\\\)/g;
       $datafield_three =~ s/\[/\\\[/g;
       $datafield_three =~ s/\]/\\\]/g;
       $datafield_three =~ s/\+/\\\+/g;
       $datafield_three =~ s/\?/\\\?/g;
       $datafield_three =~ s/\*/\\\*/g;
       $datafield_three =~ s/\;/ /g;

       $datafield_five = $datafields[5];
       $datafield_five =~ s/\'/\\\'/g;
       $datafield_five =~ s/\|/\\\|/g;
       $datafield_five =~ s/\$/\\\$/g;
       $datafield_five =~ s/\^/\\\^/g;
       $datafield_five =~ s/\}/\\\}/g;
       $datafield_five =~ s/\{/\\\{/g;
       $datafield_five =~ s/\(/\\\(/g;
       $datafield_five =~ s/\)/\\\)/g;
       $datafield_five =~ s/\[/\\\[/g;
       $datafield_five =~ s/\]/\\\]/g;
       $datafield_five =~ s/\+/\\\+/g;
       $datafield_five =~ s/\?/\\\?/g;
       $datafield_five =~ s/\*/\\\*/g;
       $datafield_five =~ s/\;/ /g;

       $query = "insert into product values (\'$datafields[0]\',\'$datafields[1]\',\'$datafields[2]\',\'$datafield_three\',\'$datafields[4]\',\'$datafield_five\',\'$datafields[6]\',\'$datafields[7]\',\'$datafields[8]\',\'$datafields[9]\',\'$datafields[10]\',\'$datafields[11]\',\'$datafields[12]\')";
       $dbh->do($query) || print "Error: $DBI::errstr<br>\n";
   }
   close (DATA_FILE);

   $dbh->disconnect;

   print qq~
   <html>
   $header
   <body>
   <p align="center"><font face="Arial">The data.file has been uploaded to your MySQL database!</font></p>
   </body>
   </html>
   ~;
}

############################################################
# Export orders to log file
############################################################

sub export
{
   $data_file_path = "$mypath/admin/files/order.log";

   open (ORDER, $data_file_path);
   while (<ORDER>)
   {
      $ord_dat .= $_;
   }
   close (ORDER);

   if ($ord_dat eq "")
   {
      unlink $data_file_path;

      $dbh = DBI->connect("dbi:mysql:$sc_mysql_database_name:$sc_mysql_server_name","$sc_mysql_user_name","$sc_mysql_password") || die "Couldn't connect to database: " . DBI->errstr;

      $query = "UPDATE orders SET status=1 WHERE status=0";
      $dbh->do($query) || print "Error: $DBI::errstr<br>\n";

      open (ORDER_LOG, ">$data_file_path");
      $query = qq~SELECT * FROM orders WHERE status = '1'~;
      my($sth) = $dbh->prepare($query);
      $sth->execute || die("Couldn't exec sth!");
      while(@row = $sth->fetchrow)
      {
      	print ORDER_LOG "$row[1]\|";
      	print ORDER_LOG "$row[2]\|";
      	print ORDER_LOG "$row[3]\|";
      	print ORDER_LOG "$row[4]\|";
      	print ORDER_LOG "$row[5]\|";
      	print ORDER_LOG "$row[6]\|";
      	print ORDER_LOG "$row[7]\|";
      	print ORDER_LOG "$row[8]\|";
      	print ORDER_LOG "$row[9]\|";
      	print ORDER_LOG "$row[10]\|";
      	print ORDER_LOG "$row[11]\|";
      	print ORDER_LOG "$row[12]\|";
      	print ORDER_LOG "$row[13]\|";
      	print ORDER_LOG "$row[14]\|";
      	print ORDER_LOG "$row[15]\|";
      	print ORDER_LOG "$row[16]\|";
      	print ORDER_LOG "$row[17]\|";
      	print ORDER_LOG "$row[18]\|";
      	print ORDER_LOG "$row[19]\|";
      	print ORDER_LOG "$row[20]\|";
      	print ORDER_LOG "$row[21]\|";
      	print ORDER_LOG "$row[22]\|";
      	print ORDER_LOG "$row[23]\|";
      	print ORDER_LOG "$row[24]\|";
      	print ORDER_LOG "$row[25]\|";
      	print ORDER_LOG "$row[26]\|";
      	print ORDER_LOG "$row[27]\|";
      	print ORDER_LOG "$row[28]\|";
      	print ORDER_LOG "$row[29]\|";
      	print ORDER_LOG "$row[30]\|";
      	print ORDER_LOG "$row[31]\|";
      	print ORDER_LOG "$row[32]\|";
      	print ORDER_LOG "$row[33]\|";
      	print ORDER_LOG "$row[34]\|";
      	print ORDER_LOG "$row[35]\n";
      }
      $sth->finish;

      close (ORDER_LOG);

      $query = "UPDATE orders SET status=2 WHERE status=1";
      $dbh->do($query) || print "Error: $DBI::errstr<br>\n";

      $dbh->disconnect;

      print "Content-type: text/html\n\n";

      print qq~
         <html>
         $header
         <body>
         <p align="center"><font face="Arial">The order.log file has been created for downloading!</font></p>
         </body>
         </html>
      ~;
   } else {
      print "Content-type: text/html\n\n";
      print qq~
         <html>
         $header
         <body>
         <p align="center"><font face="Arial">Still data in the order.log... export skipped, download first!</font></p>
         </body>
         </html>
      ~;
   }

}

############################################################
# Export Products to data file
############################################################

sub export_prd
{
   $data_file_path = "$mypath/admin/files/data.file";

      unlink $data_file_path;
      $dbh = DBI->connect("dbi:mysql:$sc_mysql_database_name:$sc_mysql_server_name","$sc_mysql_user_name","$sc_mysql_password") || die "Couldn't connect to database: " . DBI->errstr;

      open (PRD_LOG, ">$data_file_path");
      $query = "SELECT * FROM product";
      my($sth) = $dbh->prepare($query);
      $sth->execute || die("Couldn't exec sth!");
      while(@row = $sth->fetchrow)
      {
         $desc = $row[4];
         $desc =~ s/\n/<br>/g;
      	print PRD_LOG "$row[0]\|";
      	print PRD_LOG "$row[1]\|";
      	print PRD_LOG "$row[2]\|";
      	print PRD_LOG "$row[3]\|";
      	print PRD_LOG "$desc\|";
      	print PRD_LOG "$row[5]\|";
      	print PRD_LOG "$row[6]\|";
      	print PRD_LOG "$row[7]\|";
      	print PRD_LOG "$row[8]\|";
      	print PRD_LOG "$row[9]\|";
      	print PRD_LOG "$row[10]\|";
      	print PRD_LOG "$row[11]\|";
      	print PRD_LOG "$row[12]\n";
      }
      $sth->finish;
      $dbh->disconnect;

      close PRD_LOG;

      print "Content-type: text/html\n\n";
      print qq~
         <html>
         $header
         <body>
         <p align="center"><font face="Arial">The data.file has been created for downloading!</font></p>
         </body>
         </html>
      ~;
}

############################################################
# Export orders to log file
############################################################

sub email
{
   $email_file_path = "$mypath/admin/files/email.db";

   unlink $email_file_path;

   open (EMAIL_LOG, "+>$email_file_path");

   $dbh = DBI->connect("dbi:mysql:$sc_mysql_database_name:$sc_mysql_server_name","$sc_mysql_user_name","$sc_mysql_password") || die "Couldn't connect to database: " . DBI->errstr;
   $query = "SELECT * FROM emaillog";
   my($sth) = $dbh->prepare($query);
   $sth->execute || die("Couldn't exec sth!");
   while(@row = $sth->fetchrow)
   {
      print EMAIL_LOG "$row[0]\n";
   }
   $sth->finish;
   $dbh->disconnect;

   close (EMAIL_LOG);

   print "Content-type: text/html\n\n";

   print qq~
      <html>
      $header
      <body>
      <p align="center"><font face="Arial">The email.db file has been created for downloading\!</font></p>
      </body>
      </html>
   ~;
}

############################################################
# Create the database tables
############################################################

sub create
{
   print "Content-type: text/html\n\n";

   $dbh = DBI->connect("dbi:mysql:$sc_mysql_database_name:$sc_mysql_server_name","$sc_mysql_user_name","$sc_mysql_password") || die "Couldn't connect to database: " . DBI->errstr;

   $file = "./webstore.sql";

   open QF, "$file";
   while ($line = <QF>) {

      my $isComment = 0;
      my $isBlankLine = 0;

      if ($line =~ /^\s*#/)  {$isComment   = 1}
      if ($line =~ /^\s*--/) {$isComment   = 1}
      if ($line =~ /^\s*\n/) {$isBlankLine = 1}
      if (!$isComment and !$isBlankLine) { $query .= " $line"; }

      if ($line =~ /;\s*(\n|$)/) {

          # strips out the beginning and ending spaces.
          $query =~ s/^\s+//;
          $query =~ s/\s+$//;
          $query =~ s/(\r|\n)+/ /g;

          if ($query ne ';') {
              # run query.
              $dbh->do($query);
          }
          # clean up query and prepare to take in the next one.
          $query = '';
      }
   }
   close QF;

   # In case the last query does not end with a semi-colon.
   $query =~ s/^\s+//;
   $query =~ s/\s+$//;
   $query =~ s/(\r|\n)+/ /g;

   if (!($query =~ /;$/) and ($query ne '')) {
      # run query.
      $dbh->do($query) || print "Error: $DBI::errstr<br>\n";
   }


   $dbh->disconnect;



   print qq~
   <html>
   $header
   <body>
   <p align="center"><font face="Arial">The database files have been created!</font></p>
   </body>
   </html>
   ~;
}

############################################################
# Get form input
############################################################

sub get_data {
    local($string);

    # get data
    if ($ENV{'REQUEST_METHOD'} eq 'GET') {
        $_ = $string = $ENV{'QUERY_STRING'};
	tr/\"~;/_/;
	$string = $_;

    }
    else { read(STDIN, $string, $ENV{'CONTENT_LENGTH'});
        $_ = $string;
	$OK_CHARS='a-zA-Z0-9=&%\n\/_\-\.@';
	tr/\"~;/_/;
	$string = $_;
	   }

    # split data into name=value pairs
    @data = split(/&/, $string);

    # split into name=value pairs in associative array
    foreach (@data) {
	split(/=/, $_);
	$_[0] =~ s/\+/ /g; # plus to space
	$_[0] =~ s/%(..)/pack("c", hex($1))/ge; # hex to alphanumeric
	$data{"$_[0]"} = $_[1];
    }

    # translate special characters
    foreach (keys %data) {
	$data{"$_"} =~ s/\+/ /g; # plus to space
	$data{"$_"} =~ s/%(..)/pack("c", hex($1))/ge; # hex to alphanumeric
    }

    %data;			# return associative array of name=value
}
