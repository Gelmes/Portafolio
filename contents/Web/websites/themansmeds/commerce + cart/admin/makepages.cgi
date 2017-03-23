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
# Internet Express Products SHALL NOT BE LIABLE FOR ANY DAMAGES SUFFERED BY
# LICENSEE AS A RESULT OF USING, MODIFYING OR DISTRIBUTING THIS
# SOFTWARE OR ITS DERIVATIVES.
#
##########################################################################

use CGI;
use CGI::Carp qw/fatalsToBrowser/;
use DBI;

print "Content-type: text/html\n\n";

$sc_main_script_url = "http://www.commercesql.com/index.cgi";
$URLofImages = "http://www.commercesql.com/images";
$sc_mysql_server_name = "localhost";
$sc_mysql_database_name = "commercesql_com";
$sc_mysql_user_name = "username";
$sc_mysql_password = "password";

$template_path = "./template.htm";

# create directory if not there
if (!(-d "../store"))
{
   $test = `mkdir ../store`;
}

$dbh = DBI->connect("dbi:mysql:$sc_mysql_database_name:$sc_mysql_server_name","$sc_mysql_user_name","$sc_mysql_password") || die("Couldn't connect to database!\n");
my($query) = "SELECT * FROM product";
my($sth) = $dbh->prepare($query);
$sth->execute || die("Couldn't exec sth!");
while(@row = $sth->fetchrow)
{
   open(TEMPLATE,"./template.htm");
   $new_doc = "";
   while ($line = <TEMPLATE>)
   {
      $image = $row[4];
      $image =~ s/%%URLofImages%%/$URLofImages\/product/g;
      $line =~ s/%%id%%/$row[0]/g;
      $line =~ s/%%category%%/$row[1]/g;
      $line =~ s/%%price%%/$row[2]/g;
      $line =~ s/%%name%%/$row[3]/g;
      $line =~ s/%%image%%/$image/g;
      $line =~ s/%%description%%/$row[5]/g;
      $line =~ s/%%weight%%/$row[6]/g;
      $line =~ s/%%userone%%/$row[7]/g;
      $line =~ s/%%usertwo%%/$row[8]/g;
      $line =~ s/%%userthree%%/$row[9]/g;
      $line =~ s/%%userfour%%/$row[10]/g;
      $line =~ s/%%userfive%%/$row[11]/g;
      $line =~ s/%%options%%/$row[12]/g;
      $line =~ s/%%sc_main_script_url%%/$sc_main_script_url/g;
      $new_doc .= $line;
   }
   close(TEMPLATE);

   $f_name = $row[3];
   $f_name =~ s/ /_/g;
   $f_name =~ s/\//_/g;
   open(TEMPLATE,">../store/$f_name.htm");
   print TEMPLATE $new_doc;
   close(TEMPLATE);

   $index_page .= "<a href=\"$f_name.htm\">$row[3]</a><br>";

}
$sth->finish;
$dbh->disconnect;

open(TEMPLATE,">../store/index.htm");
print TEMPLATE "<html>";
print TEMPLATE "<head>";
print TEMPLATE "<title>Web Store Index</title>";
print TEMPLATE "</head>";
print TEMPLATE "<body>";
print TEMPLATE $index_page;
print TEMPLATE "</body>";
print TEMPLATE "</html>";
close(TEMPLATE);

print "Pages Created";