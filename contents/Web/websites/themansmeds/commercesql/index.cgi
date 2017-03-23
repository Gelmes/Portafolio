#!/usr/bin/perl

#######################################################################################
#                                                                                     #
#                                CommerceSQL                                          #
#                          http://commercesql.com                                     #
#                                                                                     #
# Copyright 2006 Internet Express Products                                            #
#                                                                                     #
# Version: 2.3                                              Last Modified 02/09/2007  #
#                                                                                     #
#######################################################################################
#
# CommerceSQL is based on our Commerce.cgi shopping cart that is
# available at http://commerce-cgi.com
#
# Commerce.cgi is based on Selena Sol's freeware 'Web Store'
# available at http://www.extropia.com. Modifications made
# independently by Carey Internet Services,
# and Internet Express Products.
#
# The entire package as distributed here is Copyright 2001
# Internet Express Products and is distributed free of charge
# consistent with the GNU General Public License Version 2
# dated June 1991.
#
# This program is free software that you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# Version 2 as published by the Free Software Foundation.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
#
# Pursuant to the License Agreement, this copyright notice may not be
# removed or altered in any way.
#
#######################################################################################

use CGI;
use CGI::Carp qw/fatalsToBrowser/;

$| = 1;

$time = time;

use DBI;

 ############################################################################
# Hacking Check Code
############################################################################

if ($ENV{'REQUEST_URI'} =~ /\.\./i || $ENV{'REQUEST_URI'} =~ /\%/i)
{
   $ipnum = $ENV{'REMOTE_ADDR'};
   @digits = split (/\./, $ipnum);
   $address = pack ("C4", @digits);
   $host = gethostbyaddr ($address, 2);
   $date = &get_date;

   open (HACK_LOG, "+>>./admin/files/hack.log");
   print HACK_LOG "$ENV{'REMOTE_ADDR'}\|$ENV{'REMOTE_PORT'}\|$host\|$date\|$ENV{'REQUEST_URI'}\n";
   close HACK_LOG;

   print "Content-type: text/html\n\n";

   print qq~
   <html>
   <head>
   <title>Hack Attempt</title>
   </head>
   <body text="#FFFFFF" bgcolor="#FF0000">
   <bgsound src="http://commerce-cgi.com/sound/siren.wav" loop="999">
   <p>&nbsp;</p>
   <p align="center"><font face="Arial"><b><font size="4">Hack attempt logged and
   will be reported to your ISP!</font></b></font></p>
   <div align="center">
   <center>
   <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111">
   <tr>
   <td width="100%"><font face="Arial"><b>IP: </b>$ENV{'REMOTE_ADDR'}<br>
   <b>Remote port:</b> $ENV{'REMOTE_PORT'}<br>
   <b>Host:</b> $host</font></td>
   </tr>
   </table>
   </center>
   </div>
   <p align="center"><font face="Arial"><br>
   &nbsp;</font></p>
   </body>
   </html>
   ~;

   exit;
}

&require_supporting_libraries (__FILE__, __LINE__,
		"./admin/configuration.pl",
		"./admin/admin_conf.pl",
		"./admin/html_lib.pl");

#######################################################################
#                             Variables                               #
#######################################################################

$flags = "-t";

$mailer  = '/usr/lib/sendmail';
$mailer1 = '/usr/bin/sendmail';
$mailer2 = '/usr/sbin/sendmail';
if ( -e $mailer) {
    $mail_program=$mailer;
} elsif( -e $mailer1){
    $mail_program=$mailer1;
} elsif( -e $mailer2){
    $mail_program=$mailer2;
} else {
    print "Content-type: text/html\n\n";
    print "I can't find sendmail, shutting down...<br>";
    print "Whoever set this machine up put it someplace weird.";
    exit;
}

$mail_program = "$mail_program $flags ";

#######################################################################
#                Database Definition Variables                        #
#######################################################################

$sc_mysql_dsn = "DBI:mysql:$sc_mysql_database_name:$sc_mysql_server_name";
$sc_mysql_prd_table    = "product";
$sc_mysql_ord_table    = "orders";
$sc_mysql_access_table = "accesslog";
$sc_mysql_error_table  = "errorlog";
$sc_mysql_email_table  = "emaillog";
$sc_mysql_cart_table   = "cart";
$sc_mysql_stat_table   = "prd_stats";

# SELECT:

# Note that the SELECT order format
# needs to match the $db{''} order below.

@sc_mysql_select_order = ("rowid",	    		# 0
 			                 "category",			# 1
			                 "price",			   # 2
			                 "name",			   # 3
			                 "image",			   # 4
			                 "description",		# 5
                  		  "weight",			   # 6
                  		  "userone",			# 7
                  		  "usertwo",			# 8
                  		  "userthree",			# 9
                  		  "userfour",			# 10
                  		  "userfive",			# 11
                  		  "options");			# 12

$db{"product_id"}  = 0;
$db{"product"}     = 1;
$db{"price"}       = 2;
$db{"name"}        = 3;
$db{"image_url"}   = 4;
$db{"description"} = 5;
$db{"shipping"}    = 6;
$db{"user1"}       = 7;
$db{"user2"}       = 8;
$db{"user3"}       = 9;
$db{"user4"}       = 10;
$db{"user5"}       = 11;
$db{"options"}     = 12;

@sc_db_index_for_display = ($db{"image_url"},
                            $db{"name"},
                            $db{"description"},
                            $db{"options"},
                            $db{"price"},
                            $db{"shipping"},
                            $db{"user1"},
                            $db{"user2"},
                            $db{"user3"},
                            $db{"user4"},
                            $db{"user5"});

@sc_db_index_for_defining_item_id = ($db{"product_id"},
                                     $db{"product"},
                                     $db{"price"},
                                     $db{"name"},
                                     $db{"image_url"},
                                     $db{"shipping"});

$sc_db_index_of_price = $db{"price"};

@sc_db_query_criteria = ("query_price_low_range|2|<=|number",
                         "query_price_high_range|2|>=|number",
                         "pid|0|=|number",
                         "product|1|=|string",
                         "name|3|=|string",
                         "keywords|1,3,5|=|string");

#######################################################################
#                    Cart Definition Variables                        #
#######################################################################

$cart{"quantity"}            = 0;
$cart{"product_id"}          = 1;
$cart{"product"}             = 2;
$cart{"price"}               = 3;
$cart{"name"}                = 4;
$cart{"image"}               = 5;
$cart{"shipping"}            = 6;
$cart{"options"}             = 7;
$cart{"price_after_options"} = 8;
$cart{"unique_cart_line_id"} = 9;

@sc_cart_display_fields = ("Quantity", "Product", "Price", "Total");
@sc_cart_index_for_display = ($cart{"quantity"}, $cart{"name"}, $cart{"price"}, $cart{"price_after_options"}, $cart{"options"});

$sc_cart_index_of_price = $cart{"price"};
$sc_cart_index_of_name = $cart{"name"};
$sc_cart_index_of_price_after_options = $cart{"price_after_options"};
$sc_cart_index_of_measured_value = $cart{"shipping"};
$sc_cart_index_of_item_id = $cart{"product_id"};
$sc_cart_index_of_quantity = $cart{"quantity"};
$sc_cart_index_of_option = $cart{"options"};

# increasing numerical value (1,2,3) if its 0,
# then it never gets calculated at this stage

$sc_calculate_discount_at_process_form  = 1;
$sc_calculate_shipping_at_process_form  = 2;
$sc_calculate_sales_tax_at_process_form = 3;

@sc_order_form_shipping_related_fields = ();

@sc_order_form_discount_related_fields = ();

# price|quantity|total measurement field|amount or percent
# @sc_shipping_logic = ( "1-49.99|||10.0%",
#                        "50-99.99|||8.0%",
#                        "100-149.99|||7.0%",
#                        "150-499.99|||6.0%",
#                        "500-|||4.0%");

@sc_discount_logic  = ();

#######################################################################
#                  Miscellaneous Variables                            #
#######################################################################

@acceptable_file_extensions_to_display = (".html", ".htm");

$back = "-1";

%form_data = &get_data();

if (("$sc_domain_name_for_cookie" ne $ENV{'HTTP_HOST'}) &&
      ($form_data{'process_order'} eq "" ) &&
      ($form_data{'submit_order_form_button'} eq "" ) &&
      ($form_data{'order_form_button.x'} eq "" ))
{
   print "Location: $sc_main_script_url\n\n";
   exit;
}

&get_cookie;

$page = $form_data{'page'};
$page =~ /([\w\-\=\+\/]+)\.(\w+)/;
$page = "$1.$2";
$page = "" if ($page eq ".");
$page =~ s/^\/+//; # Get rid of any residual / prefix

$category = $form_data{'category'};
$category =~ /([\w\-\=\+\/]+)\.(\w+)/;
$category = "$1.$2";
$category = "" if ($category eq ".");
$category =~ s/^\/+//; # Get rid of any residual / prefix

# $cart_id = $form_data{'cart_id'};

&error_check_form_data;

if ($form_data{'cart_id'} < 10000000)
{
   $form_data{'cart_id'} = "";
}

if ($cookie{'cart_id'} eq "" && $form_data{'cart_id'} eq "")
{
   &delete_old_carts;
   &assign_a_unique_shopping_cart_id;

   if ($ENV{'HTTP_USER_AGENT'} =~ /http\:\/\//i)
   {
      $cart_id = "";
      $form_data{'cart_id'} = "";
   }

}

if ($form_data{'cart_id'} eq "")
{
   $cart_id = $cookie{'cart_id'};
} else {
   $cart_id = $form_data{'cart_id'};
}

print "Content-type: text/html\n\n";

$are_any_query_fields_filled_in = "no";
foreach $query_field (@sc_db_query_criteria)
{
   @criteria = split(/\|/, $query_field);
	if ($form_data{$criteria[0]} ne "")
	{
	   $are_any_query_fields_filled_in = "yes";
	}
}

if ($form_data{'process_order'}) {
   &require_supporting_libraries (__FILE__, __LINE__, "./admin/$sc_gateway_name-order_lib.pl");
   $cart_id = $form_data{'cart_id'};
   &processOrder;
   exit;
} elsif ($form_data{'add_to_cart_button.x'} ne "") {
   $back = "-2";
   &add_to_the_cart;
   exit;
} elsif ($form_data{'submit_change_quantity_button.x'} ne "") {
   &modify_quantity_of_items_in_cart;
   exit;
} elsif ($form_data{'submit_deletion_button.x'} ne "") {
   &delete_from_cart;
   exit;
} elsif ($form_data{'order_form_button.x'} ne "") {
   local($subtotal);
   local($total_quantity);
   local($total_measured_quantity);
   local($hidden_fields_for_cart);
   ($subtotal,$total_quantity,$total_measured_quantity,$text_of_cart) = &display_cart_table("orderform");
   &require_supporting_libraries (__FILE__, __LINE__, "./admin/$sc_gateway_name-order_lib.pl");
   &OrderForm;
   &SecureStoreFooter;
   exit;
} elsif ($form_data{'submit_order_form_button'} ne "") {
   &require_supporting_libraries (__FILE__, __LINE__, "./admin/$sc_gateway_name-order_lib.pl");
   &process_order_form;
   exit;
} elsif (($page ne "" || $form_data{'search_request_button.x'} ne ""
                      || $form_data{'continue_shopping_button.x'}
                      || $are_any_query_fields_filled_in =~ /yes/i)) {
   &create_html_page_from_db;
   exit;

} elsif ($form_data{'x_response_code'}) {
   &require_supporting_libraries (__FILE__, __LINE__, "./admin/$sc_gateway_name-order_lib.pl");
   $cart_id = $form_data{'x_cart_id'};
   &processOrder;
   exit;
} elsif ($form_data{'authcode'} || $form_data{'err'} || $form_data{'die'}) {
   &require_supporting_libraries (__FILE__, __LINE__, "./admin/$sc_gateway_name-order_lib.pl");
   $cart_id = $form_data{'p4'};
   &processOrder;
   exit;
} else {
   &display_page("Home.htm", "Output Frontpage", __FILE__, __LINE__);
   exit;
}

#######################################################################
#                       Require Supporting Libraries.		          #
#######################################################################

sub require_supporting_libraries
{
   local ($file, $line, @require_files) = @_;
   local ($require_file);

   foreach $require_file (@require_files)
   {
      if (-e "$require_file" && -r "$require_file")
      {
         require "$require_file";
      } else {
         print "I am sorry but I was unable to require $require_file at line
         $line in $file.  Would you please make sure that you have the
         path correct and that the permissions are set so that I have
         read access?  Thank you.";
         exit;
      }
   }
}

#######################################################################
#                     Error Check Form Data.                          #
#######################################################################

sub error_check_form_data
{
   foreach $file_extension (@acceptable_file_extensions_to_display)
   {
   	if ($page =~ /$file_extension/ || $page eq "")
   	{
   	   $valid_extension = "yes";
   	}
   }

   if ($valid_extension ne "yes")
   {
      print "I am sorry, but you may only use this program to view HTML pages.";
      &update_error_log("PAGE LOAD WARNING", __FILE__, __LINE__);
      exit;
   }

}

#######################################################################
#                        Delete Old Carts. 	                      #
#######################################################################

sub delete_old_carts
{
   $my_time = time;
   $twenty_four_hours = "86400";
   $old_date = $my_time-$twenty_four_hours;
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
	$query = "DELETE from $sc_mysql_cart_table where add_time < '$old_date'";
	$dbh->do($query);
   $dbh->disconnect;
}

#######################################################################
#                        Assign a Shopping Cart.                      #
#######################################################################

sub assign_a_unique_shopping_cart_id
{
   if ($sc_shall_i_log_accesses eq "yes")
   {
      $remote_addr = $ENV{'REMOTE_ADDR'};
      $request_uri = $ENV{'REQUEST_URI'};
      $http_user_agent = $ENV{'HTTP_USER_AGENT'};
      if ($ENV{'HTTP_REFERER'} ne "")
      {
         $http_referer = $ENV{'HTTP_REFERER'};
      } else {
         $http_referer = "possible bookmarks";
      }
      $remote_host = $ENV{'REMOTE_HOST'};
      $shortdate = &get_date;

      $unixdate = time;
      $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
      $query = "INSERT INTO $sc_mysql_access_table values ('$form_data{'url'}','$shortdate','$request_uri','$cookie{'visit'}','$remote_addr','$http_user_agent','$http_referer','$unixdate')";
      $dbh->do($query);
      $dbh->disconnect;
   }
   srand (time|$$);
   $cart_count = 0;
   $cart_found = "yes";

   while ($cart_found eq "yes")
   {
      $cart_id = time . "." . $$;
      $cart_id =~ s/-//g;
      $cart_count++;
      $cart_found = "no";
      $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
      my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$cart_id\'";
   	my($sth) = $dbh->prepare($query);
   	$sth->execute || die("Couldn't exec sth!");
   	while(@row = $sth->fetchrow)
   	{
      	$cart_found = "yes";
      }
      $sth->finish;
      $dbh->disconnect;

   	if ($cart_count == 4)
   	{
      	print qq~
            There must be something wrong with your local
            rand function because I cannot get a unique, random number for
            your shopping cart. Please check the call to rand in the Assign a
            Shopping Cart routine.
         ~;
      	&update_error_log("COULD NOT CREATE UNIQUE CART ID", __FILE__, __LINE__);
      	exit;
   	}
   }
   &SetCookies;
}

#######################################################################
#                    Add to Shopping Cart                             #
#######################################################################

sub add_to_the_cart
{
   if ($form_data{'viewOrder'} eq "")
   {
      &checkReferrer;
   }
   $highest_item_number = 100;
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$cart_id\'";
   	my($sth) = $dbh->prepare($query);
   	$sth->execute || die("Couldn't exec sth!");
   	while(@row = $sth->fetchrow)  {
   		$item_number = $row[4];
         $highest_item_number = $item_number if ($item_number > $highest_item_number);
   	}
   $sth->finish;

   @items_ordered = keys (%form_data);
   foreach $item (@items_ordered)
   {
      if (($item =~ /^item-/i || $item =~ /^option/i) && $form_data{$item} ne "")
      {
         $item =~ s/^item-//i;
         if ($item =~ /^option/i)
         {
            push (@options, $item);
         } else {
         	if (($form_data{"item-$item"} =~ /\D/) || ($form_data{"item-$item"} == 0))
         	{
               $badqty = "YES";
         	} else {
            	$quantity = $form_data{"item-$item"};
            	push (@items_ordered_with_options, "$quantity\|$item\|");
         	}
         }
      }
   }

   foreach $item_ordered_with_options (@items_ordered_with_options)
   {
      $options = "";
      $option_subtotal = "";
      $option_grand_total = "";
      $item_grand_total = "";
      $item_ordered_with_options =~ s/~qq~/\"/g;
      $item_ordered_with_options =~ s/~gt~/\>/g;
      $item_ordered_with_options =~ s/~lt~/\</g;
      @cart_row = split (/\|/, $item_ordered_with_options);
      $item_quantity = $cart_row[$sc_cart_index_of_quantity];
      $item_id_number = $cart_row[$sc_cart_index_of_item_id];
      $item_price = $cart_row[$sc_cart_index_of_price];
      $item_shipping = $cart_row[6];
      foreach $option (@options)
      {
         ($option_marker, $option_number, $option_item_number) = split (/\|/, $option);

         if ($option_item_number eq "$item_id_number")
         {
            ($option_name, $option_price) = split (/\|/,$form_data{$option});
            if($option_name)
            {
               $options .= "$option_name $option_price,";
            }
            $unformatted_option_grand_total = $option_grand_total + $option_price;
            $option_grand_total = &format_price($unformatted_option_grand_total);
         }
      }
      $item_number = ($highest_item_number+1);
      $unformatted_item_grand_total = $item_price + $option_grand_total;
      $item_grand_total = &format_price("$unformatted_item_grand_total");
      $options =~ s/\'/\\\'/g;
      foreach $field (@cart_row)
      {
         $cart_row .= "$field\|";
      }
      $cart_row .= "$options\|$item_grand_total\|$item_number\n";
   }

   $unixdate = time;
   if ($cart_row ne ""){
   	$query = "INSERT INTO $sc_mysql_cart_table values ('',\'$cart_id\','$cart_row','$unixdate','$item_number')";
   	$dbh->do($query);
	}
   $dbh->disconnect;

	if ($form_data{'viewOrder'} eq "yes")
	{
	   &display_cart_contents;
	} elsif ($are_any_query_fields_filled_in =~ /yes/i) {
   	$page = "";
   	$category = "";
      &create_html_page_from_db;
	} else {
	   &create_html_page_from_db;
	}
}

#######################################################################
#                Modify Quantity of Items in the Cart                 #
#######################################################################

sub modify_quantity_of_items_in_cart
{
   &checkReferrer;
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   foreach $key (keys (%form_data))
   {
      if ($key =~ /[\d]/ && $form_data{$key} =~ /[\d]/ && $form_data{$key} ne "")
      {
         $shopper_row = "";
         my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$cart_id\' and number = \'$key\'";
      	my($sth) = $dbh->prepare($query);
      	$sth->execute || die("Couldn't exec sth!");
      	while(@row = $sth->fetchrow)  {
      		$cart_data = $row[2];
            @database_row = split (/\|/, $cart_data);
            $cart_row_number = pop (@database_row);
            push (@database_row, $cart_row_number);
            shift (@database_row);
            $shopper_row .= "$form_data{$key}\|";
            foreach $field (@database_row)
            {
               $shopper_row .= "$field\|";
            }
            chop $shopper_row;
         }
         if ($form_data{$key} eq "0")
         {
            $query = "DELETE from $sc_mysql_cart_table where cart_id ='$cart_id' and number = '$key'";
            $dbh->do($query);
         }
         elsif ($form_data{$key} > "0")
         {
            unless ($form_data{$key} =~ /[\D]/ )
            {
               $query = "UPDATE $sc_mysql_cart_table SET cart_row = '$shopper_row' where cart_id = '$cart_id' and number = '$key'";
               $dbh->do($query);
            }
         }
         $sth->finish;
      }
   }
   $dbh->disconnect;
   &display_cart_contents;
}

#######################################################################
#                 Delete Item From Cart                               #
#######################################################################

sub delete_from_cart
{
   &checkReferrer;
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   $delete_row = $form_data{'delete_row'};
	$query = "DELETE from $sc_mysql_cart_table where cart_id = '$cart_id' and number = '$delete_row'";
	$dbh->do($query);
   $dbh->disconnect;
   &display_cart_contents;
}

#######################################################################
#                   create_html_page_from_db Subroutine               #
#######################################################################

sub create_html_page_from_db
{
   local (@database_rows, @database_fields, @item_ids, @display_fields);
   local ($total_row_count, $id_index, $display_index);
   local ($row, $field, $empty, $option_tag, $option_location, $output);
   if ($page ne "" && $form_data{'search_request_button'} eq "" && $form_data{'continue_shopping_button'} eq "")
   {
      &display_page($page, "Display Products for Sale", __FILE__, __LINE__);
      exit;
   }
   if ($category ne "" && $form_data{'search_request_button'} eq "" && $form_data{'continue_shopping_button'} eq "")
   {
      &display_page($category, "Display Products for Sale", __FILE__, __LINE__);
      exit;
   }
   &product_page_header("Product Listing");
#    if ($form_data{'add_to_cart_button.x'} ne "" && $sc_shall_i_let_client_know_item_added eq "yes" && $badqty ne "YES")
#    {
#       print qq~
#          <TR>
#          <TD COLSPAN=3>
#          <CENTER>
#          <FONT FACE=ARIAL SIZE=2 COLOR=BLUE>Thank you, your selection has been added to your order.</FONT>
#          </CENTER>
#          </TD>
#          </TR>
#          <BR>
#       ~;
#    }
   ($status,$total_row_count) = &submit_query(*database_rows);
   $nextCount = $form_data{'next'}+$sc_db_max_rows_returned;
   $prevCount = $form_data{'next'}-$sc_db_max_rows_returned;
   $minCount = $form_data{'next'};
   $maxCount = $form_data{'next'}+$sc_db_max_rows_returned;

   # insert code to print table header and set variables
   print "<div align=\"center\">";
   print "<center>";
   print "<table border=\"0\" width=\"100%\"><tr><td width=33%\" valign=\"top\">";
   $desCount = "1";

   foreach $row (@database_rows)
   {
      # insert code for rows
      if ($rowCount && $rowCount > $minCount && $rowCount <= $maxCount){
         if ($desCount == $rowsper){
            print qq~
               </td></tr>
               <tr>
               <td width="100%" colspan="3">
               <hr noshade size="1" color="#C0C0C0" width="90%">
               </td>
               </tr>
               <tr><td width="33%" valign="top">
            ~;
            $desCount = "1";
         } else {
            print "<\/td><td width=\"33%\" valign=\"top\">";
            $desCount++;
         }
      }

      $rowCount++;
      $prevHits = $sc_db_max_rows_returned;
      $nextHits = $sc_db_max_rows_returned;
      if ($rowCount > $minCount && $rowCount <= $maxCount)
      {
         @database_fields = split (/\|/, $row);
         foreach $field (@database_fields)
         {
            if ($field =~ /^%%OPTION%%/)
            {
               ($empty, $option_tag, $option_location) = split (/%%/, $field);
               $field = "";
               open (OPTION_FILE, "<./options/$option_location") || &file_open_error ("./options/$option_location", "Display Products for Sale", __FILE__,__LINE__);
               while (<OPTION_FILE>)
               {
                  s/%%PRODUCT_ID%%/$database_fields[$sc_db_index_of_product_id]/g;
                  $field .= $_;
               }
               close (OPTION_FILE);
            }
         }
         @display_fields = ();
         @temp_fields = @database_fields;
         foreach $display_index (@sc_db_index_for_display)
         {
            if ($display_index == $sc_db_index_of_price)
            {
               $temp_fields[$sc_db_index_of_price] = &display_price(&format_price($temp_fields[$sc_db_index_of_price]));
            }
            push(@display_fields, $temp_fields[$display_index]);
         }
         @item_ids = ();
         foreach $id_index (@sc_db_index_for_defining_item_id)
         {
            $database_fields[$id_index] =~ s/\"/~qq~/g;
            $database_fields[$id_index] =~ s/\>/~gt~/g;
            $database_fields[$id_index] =~ s/\</~lt~/g;
            $database_fields[$id_index] =~ s/\'/\\\'/g;
            push(@item_ids, $database_fields[$id_index]);
         }
         $itemID = join("\|",@item_ids);
         $sc_product_display_row = &displayProductPage;
      }
   }

   # insert code to close table
   print "<\/td><\/tr><\/table></center></div>";

   &product_page_footer($status,$total_row_count);
   print qq~
      <CENTER>
      <INPUT TYPE = "submit" NAME = "add_to_cart_button" VALUE = "Add Items to my Cart">
      </CENTER>
   ~;
   exit;
}

#######################################################################
#                   display_cart_contents Subroutine                  #
#######################################################################

sub display_cart_contents
{
   local (@cart_fields);
   local ($field, $cart_id_number, $quantity, $display_number,
   $unformatted_subtotal, $unformatted_grand_total, $grand_total);
   &standard_page_header("View/Modify Cart");
   &display_cart_table("");
   &cart_footer;
   exit;
}

#######################################################################
#                    file_open_error Subroutine                       #
#######################################################################

sub file_open_error
{
   local ($bad_file, $script_section, $this_file, $line_number) = @_;
   $type_of_error = "FILE OPEN ERROR-$bad_file";
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   $query = "INSERT INTO $sc_mysql_error_table values ('$type_of_error','$this_file','$line_number','')";
   $dbh->do($query);
   $dbh->disconnect;
}

#######################################################################
#                     display_page Subroutine                         #
#######################################################################

sub display_page
{
   local ($page, $routine, $file, $line) = @_;

   print qq~
      <HTML>
      <HEAD>
      <TITLE>$site_name</TITLE>
      <style>
      	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
      </style>
      </HEAD>
      $body_tag
   ~;
   &StoreHeader;

   if ($form_data{'category'} ne "")
   {
      open (PAGE, "<./category/$category") || &file_open_error("$category", "$routine", $file, $line);
   } else {
      $page =~ s/_/ /g;
      open (PAGE, "<./pages/$page") || &file_open_error("$page", "$routine", $file, $line);
   }

   while (<PAGE>)
   {
      s/%%cart_id%%/$cart_id/g;
      s/%%page%%/$form_data{'page'}/g;
      s/%%date%%/$date/g;
      s/%%URLofImages%%/$URLofImages/g;
      print $_;
   }
   close (PAGE);
   &StoreFooter;

   print qq~
      </BODY>
      </HTML>
   ~;
}

#################################################################
#                  update_error_log Subroutine                  #
#################################################################

sub update_error_log
{
   local ($type_of_error, $file_name, $line_number) = @_;
   local ($log_entry, $email_body, $variable, @env_vars);
   @env_vars = keys(%ENV);
   if ($sc_shall_i_log_errors eq "yes")
   {
      foreach $variable (@env_vars)
      {
         $log_entry .= "$ENV{$variable}\|";
      }
      $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
      $query = "INSERT INTO $sc_mysql_error_table values ('$type_of_error','$file_name','$line_number','$log_entry')";
      $dbh->do($query);
      $dbh->disconnect;
   }
   if ($sc_shall_i_email_if_error eq "yes")
   {
      $email_body = "$type_of_error\n\n";
      $email_body .= "FILE = $file_name\n";
      $email_body .= "LINE = $line_number\n";
      foreach $variable (@env_vars)
      {
         $email_body .= "$variable = $ENV{$variable}\n";
      }
      &send_mail("$sc_admin_email", "$sc_admin_email", "Web Store Error", "$email_body");
   }
}

#################################################################
#                      get_date Subroutine                      #
#################################################################

sub get_date
{
   local ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst,$date);
   local (@days, @months);
   @days = ('Sunday','Monday','Tuesday','Wednesday','Thursday', 'Friday','Saturday');
   @months = ('January','February','March','April','May','June','July','August','September','October','November','December');
   ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
   if ($hour < 10)
   {
      $hour = "0$hour";
   }
   if ($min < 10)
   {
      $min = "0$min";
   }
   if ($sec < 10)
   {
      $sec = "0$sec";
   }
   $year += 1900;
   $date = "$days[$wday], $months[$mon] $mday, $year";
   return $date;
}

#################################################################
#                     display_price Subroutine                  #
#################################################################

sub display_price

{
   local ($price) = @_;
   local ($format_price);
   if ($sc_money_symbol_placement eq "front")
   {
      $format_price = "$sc_money_symbol $price";
   } else {
      $format_price = "$price $sc_money_symbol";
   }
   return $format_price;
}

#######################################################################
#                            format_price                             #
#######################################################################

sub format_price
{
   local ($unformatted_price) = @_;
   local ($formatted_price);
   $formatted_price = sprintf ($sc_money_format, $unformatted_price);
   return $formatted_price;
}

############################################################
#
############################################################

sub checkReferrer
{
   local ($referringDomain, $acceptedDomain);
   $acceptedDomain = $sc_domain_name_for_cookie;
   $referringDomain = $ENV{'HTTP_REFERER'};
   $referringDomain =~ s/http:\/\///g;
   $referringDomain =~ s/https:\/\///g;
   $referringDomain =~ s/\/.*//g;
   if ($referringDomain =~ "^w*\.")
   {
      $referringDomain =~ s/^w*\.//i;
   }
   if ($acceptedDomain =~ "^w*\.")
   {
      $acceptedDomain =~ s/^w*\.//i;
   }
   if ($referringDomain ne $acceptedDomain)
   {
      print "$acceptedDomain is the accepted referrer.<br>";
      print "$referringDomain is not a valid referrer<br>";
      print "Referring Site Authentication Failed!";
      exit;
   }
}

############################################################
# Get form input
############################################################

sub get_data {
   local($string);
   if ($ENV{'REQUEST_METHOD'} eq 'GET') {
      $_ = $string = $ENV{'QUERY_STRING'};
      tr/\"~;/_/;
      $string = $_;
   } else {
      read(STDIN, $string, $ENV{'CONTENT_LENGTH'});
      $_ = $string;
      $OK_CHARS='a-zA-Z0-9=&%\n\/_\-\.@';
      tr/\"~;/_/;
      $string = $_;
   }
   @data = split(/&/, $string);
   foreach (@data)
   {
      split(/=/, $_);
      $_[0] =~ s/\+/ /g;
      $_[0] =~ s/%(..)/pack("c", hex($1))/ge;
      $data{"$_[0]"} = $_[1];
   }
   foreach (keys %data)
   {
      $data{"$_"} =~ s/\+/ /g;
      $data{"$_"} =~ s/%(..)/pack("c", hex($1))/ge;
   }
   %data;
}

############################################################
#
############################################################

sub get_cookie {
   local($chip, $val);
   foreach (split(/; /, $ENV{'HTTP_COOKIE'}))
   {
      s/\+/ /g;
      ($chip, $val) = split(/=/,$_,2);
      $chip =~ s/%([A-Fa-f0-9]{2})/pack("c",hex($1))/ge;
      $val =~ s/%([A-Fa-f0-9]{2})/pack("c",hex($1))/ge;
      $cookie{$chip} .= "\1" if (defined($cookie{$chip}));
      $cookie{$chip} .= $val;
   }
}

############################################################
#
############################################################
sub SetCookies
{
   local(@days) = ("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
   local(@months) = ("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
   local($sec,$min,$hour,$mday,$mon,$year,$wday) = gmtime(time);

   $cookie{'cart_id'} = "$cart_id";

   $sec = "0" . $sec if $sec < 10;
   $min = "0" . $min if $min < 10;
   $hour = "0" . $hour if $hour < 10;
   local(@secure) = ("","secure");

   $year += 1901;
   $expires = "expires\=$days[$wday], $mday-$months[$mon]-$year $hour:$min:$sec GMT; "; #form expiration from value passed to function.
   $secure = "0";
   local($key);
   foreach $key (keys %cookie)
   {
      $cookie{$key} =~ s/ /+/g;
      print "Set-Cookie: $key\=$cookie{$key}; $expires; path\=$sc_path_for_cookie; domain\=$sc_domain_name_for_cookie; $secure[$sec]\n";
   }
}

############################################################
#             Send Email
############################################################

sub real_send_mail {
    local($fromuser, $fromsmtp, $touser, $tosmtp,
      $subject, $messagebody) = @_;
local($old_path) = $ENV{"PATH"};

$ENV{"PATH"} = "";
$ENV{ENV} = "";
open (MAIL, "|$mail_program") || &web_error("Could Not Open Mail Program");

$ENV{"PATH"} = $old_path;
    print MAIL <<__END_OF_MAIL__;
To: $touser
From: $fromuser
Subject: $subject

$messagebody

__END_OF_MAIL__

    close (MAIL);
}

sub send_mail {
    local($from, $to, $subject, $messagebody) = @_;
    local($fromuser, $fromsmtp, $touser, $tosmtp);
    $fromuser = $from;
    $touser = $to;
    $fromsmtp = (split(/\@/,$from))[1];
    $tosmtp = (split(/\@/,$to))[1];
    &real_send_mail($fromuser, $fromsmtp, $touser,
           $tosmtp, $subject, $messagebody);
}

sub web_error {
    local ($error) = @_;
    $error = "Error Occured: $error";
    print "$error<p>\n";
    die $error;

}

############################################################
# subroutine: calculate_final_values
############################################################

sub calculate_final_values
{
   my ($subtotal, $total_quantity, $total_measured_quantity) = @_;
   my ($final_shipping, $final_discount, $final_sales_tax);

   $temp_total = $subtotal;

   if ($subtotal > 0)
   {
      for my $calc_loop (1..3)
      {
         if ($sc_calculate_discount_at_process_form == $calc_loop)
         {
             $final_discount = &calculate_discount($temp_total, $total_quantity, $total_measured_quantity);
             $subtotal -= $final_discount;
         }

         if ($sc_calculate_shipping_at_process_form == $calc_loop)
         {
             $final_shipping = &calculate_shipping($temp_total, $total_quantity, $total_measured_quantity);
             $final_shipping += $total_measured_quantity + $baseShipValue + $upgradeShipPrice[$form_data{'upgradeShipping'}];
             $final_shipping += ($final_shipping*($upgradeShipPercent[$form_data{'upgradeShipping'}]/100));
             $subtotal += $final_shipping;
         }

         if ($sc_calculate_sales_tax_at_process_form == $calc_loop)
         {
             $final_sales_tax = &calculate_sales_tax($temp_total);
             $subtotal += $final_sales_tax;
         }

         $temp_total = $subtotal;
      }
   }

   my $grand_total = $temp_total;

   return ($final_shipping, $final_discount, $final_sales_tax, &format_price($grand_total));
}

############################################################
# subroutine: calculate_shipping
############################################################

sub calculate_shipping {
  local($subtotal, $total_quantity, $total_measured_quantity) = @_;
  return(&calculate_general_logic(
         $subtotal,
         $total_quantity,
         $total_measured_quantity,
         *sc_shipping_logic,
         *sc_order_form_shipping_related_fields));
}

############################################################
# subroutine: calculate_discount
############################################################

sub calculate_discount {
  local($subtotal, $total_quantity, $total_measured_quantity) = @_;
  return(&calculate_general_logic(
         $subtotal,
         $total_quantity,
         $total_measured_quantity,
         *sc_discount_logic,
         *sc_order_form_discount_related_fields));
}

############################################################
# subroutine: calculate_general_logic
############################################################

sub calculate_general_logic {
   local($subtotal, $total_quantity, $total_measured_quantity, *general_logic, *general_related_form_fields) = @_;
   local($general_value);
   local($x, $count);
   local($logic);
   local($criteria_satisfied);
   local(@fields);
   local(@related_form_values) = ();

   # The form values are assigned
   $count = 0;
   foreach $x (@general_related_form_fields)
   {
      $related_form_values [$count] = $form_data{$x};
      $count++;
   }

   foreach $logic (@general_logic)
   {
      $criteria_satisfied = "yes";
      @fields = split(/\|/, $logic);
      for (1..@related_form_values)
      {
         if (!(&compare_logic_values($related_form_values[$_ - 1], $fields[$_ - 1])))
         {
               $criteria_satisfied = "no";
         }
      }
      for (1..@related_form_values)
      {
         shift(@fields);
      }
      if (!(&compare_logic_values($subtotal, $fields[0])))
      {
         $criteria_satisfied = "no";
      }
      shift (@fields);
      if (!(&compare_logic_values($total_quantity,$fields[0])))
      {
         $criteria_satisfied = "no";
      }
      shift (@fields);
      if (!(&compare_logic_values($total_measured_quantity, $fields[0])))
      {
         $criteria_satisfied = "no";
      }
      shift (@fields);
      if ($criteria_satisfied eq "yes")
      {
         if ($fields[0] =~ /%/)
         {
            $fields[0] =~ s/%//;
            $general_value = $subtotal * $fields[0] / 100;
         } else {
            $general_value = $fields[0];
         }
      }
   }
   return(&format_price($general_value));
}

############################################################
# subroutine: calculate_sales_tax
############################################################

sub calculate_sales_tax
{
   local($subtotal) = @_;
   local($sales_tax) = 0;
   if (! $form_data{'ShipTo_State'})
   {
      $form_data{'ShipTo_State'} = $form_data{'BillTo_State'};
   }

   $ShipTo_State = $form_data{'ShipTo_State'};
   $ShipTo_State =~ tr/a-z/A-Z/;

   $state_count = 0;
   foreach $tax_state (@sc_sales_tax_form_values)
   {
      $tax_state =~ tr/a-z/A-Z/;
      if ($tax_state eq $ShipTo_State)
      {
         $sales_tax = $subtotal * ($sc_sales_tax[$state_count] + 0);
      }
      $state_count++;
   }

   return (&format_price($sales_tax));
}

############################################################
# subroutine: compare_logic_values
############################################################

sub compare_logic_values {
   local($input_value, $value_to_compare) = @_;
   local($lowrange, $highrange);

   if ($value_to_compare =~ /-/)
   {
      ($lowrange, $highrange) = split(/-/, $value_to_compare);
      if ($lowrange eq "")
      {
         if ($input_value <= $highrange)
         {
            return(1);
         } else {
            return(0);
         }
      } elsif ($highrange eq "") {
         if ($input_value >= $lowrange)
         {
            return(1);
         } else {
            return(0);
         }
      } else {
         if (($input_value >= $lowrange) && ($input_value <= $highrange))
         {
            return(1);
         } else {
            return(0);
         }
      }
   } else {
      if (($input_value =~ /$value_to_compare/i) || ($value_to_compare eq ""))
      {
         return(1);
      } else {
         return(0);
      }
   }
}



############################################################
# subroutine: check_db_with_product_id
############################################################

sub check_db_with_product_id
{
   local($product_id, *db_row) = @_;
   local($db_product_id);
   local(@fields);
   local($status) = 0;
   local($sth, $dbh);
   local($mysql_where_expr, $mysql_product_id_column_name);

   $mysql_full_query_expr = "SELECT * FROM $sc_mysql_prd_table WHERE rowid = $product_id";

   $dbh = DBI->connect ($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password,
         { RaiseError => 0, PrintError => 0})
		   or $mysql_error_message = "MySQL Error: Could not connect to $sc_mysql_dsn";

   if ($mysql_error_message ne "")
   {
      &update_error_log($mysql_error_message, __FILE__, __LINE__);
   } else {
      $sth = $dbh->prepare ("$mysql_full_query_expr");
      $sth->execute ();
      while( @fields = $sth->fetchrow_array () )
      {
         @db_row = @fields;
         $db_product_id = $db_row[$db{"product_id"}];
         $status++;
      }
      $sth->finish ();
      $dbh->disconnect ();
  }
  return ($status);
}

############################################################
# subroutine: submit_query
############################################################

sub submit_query
{
   local(*database_rows) = @_;
   local($status);
   local(@fields);
   local($row_count);
   local($sth, $dbh, $temp);
   local($mysql_where_expr, $mysql_limit_offset, $mysql_limit_expr);
   local($exact_match) = $form_data{'exact_match'};
   local($case_sensitive) = $form_data{'case_sensitive'};

   foreach $criteria (@sc_db_query_criteria)
   {
      $temp = &mysql_build_criteria($exact_match,$case_sensitive, $criteria);
      if ($temp ne "")
      {
         $mysql_where_expr .= $temp." AND ";
      }
   }

   $mysql_where_expr =~ s/ AND $//;

   $mysql_full_query_expr = "SELECT * ".
               			    "FROM $sc_mysql_prd_table ".
               			    "WHERE $mysql_where_expr ".
               			    "ORDER BY name ";

   $dbh = DBI->connect ($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password,
         { RaiseError => 0, PrintError => 0})
		   or $mysql_error_message = "MySQL Error: Could not connect to $sc_mysql_dsn";

   if ($mysql_error_message ne "")
   {
      &update_error_log($mysql_error_message, __FILE__, __LINE__);
   } else {
      $sth = $dbh->prepare ("$mysql_full_query_expr");
      $sth->execute ();
      while( @fields = $sth->fetchrow_array () )
      {
         push(@database_rows, join("\|", @fields));
         $row_count++;

      } # End of while

      $sth->finish ();
      $dbh->disconnect ();
   }
   $status = "";
   if ($row_count > $sc_db_max_rows_returned)
   {
      $status = "max_rows_exceeded";
   }

   if ($row_count == 0)
   {
      if ($form_data{'continue_shopping_button.x'})
      {

         open (PAGE, "<./pages/Home.htm") || &file_open_error("Home.htm", "$routine", $file, $line);
         while (<PAGE>)
         {
            s/%%cart_id%%/$cart_id/g;
            s/%%page%%/$form_data{'page'}/g;
            s/%%date%%/$date/g;
            s/%%URLofImages%%/$URLofImages/g;
            print $_;
         }
         close (PAGE);
      } else {
         &no_items_found;
      }
      &StoreFooter;
      print qq~
         </BODY>
         </HTML>
      ~;
   exit;
   }
  return($status, $row_count);
}

############################################################
# subroutine: mysql_build_criteria
############################################################

sub mysql_build_criteria
{
   local($exact_match, $case_sensitive, $criteria) = @_;
   local($c_name, $c_fields, $c_op, $c_type);
   local(@criteria_fields);
   local($form_value);
   local($month, $year, $day);
   local($form_date);
   local($db_index);
   local($db_name);
   local(@word_list);
   local($criteria_string) = "";
   ($c_name, $c_fields, $c_op, $c_type) = split(/\|/, $criteria);
   @criteria_fields = split(/,/,$c_fields);
   $form_value = $form_data{$c_name};
   if ($form_value eq "")
   {
      return;
   }

   if (($c_type =~ /date/i) || ($c_type =~ /number/i) || ($c_op ne "="))
   {

      foreach $db_index (@criteria_fields)
      {
         $db_name = $sc_mysql_select_order[$db_index];
         if ($c_type =~ /date/i)
         {
            ($month, $day, $year) = split(/\//, $form_value);
            $month = "0" . $month if (length($month) < 2);
            $day = "0" . $day if (length($day) < 2);
            if ($year > 50 && $year < 1900) { $year += 1900; }
            if ($year < 1900) { $year += 2000; }
            $form_date = $year."-".$month."-".$day;
            $criteria_string .= qq~($db_name $c_op "$form_date") OR ~;
         } elsif ($c_type =~ /number/i) {
            $criteria_string .= qq~($db_name $c_op $form_value) OR ~;
         } else {
            $criteria_string .= qq~($db_name $c_op $form_value) OR ~;
         }

      } # End of foreach $form_field

      $criteria_string =~ s/ OR $//i;

   } else {
      if ($exact_match =~ /yes/i) {
         $word_list[0] = $form_value;
      } else {
         $form_value =~ s/\+/ /g;
         @word_list = split(/\s+/,$form_value);
      }
      $criteria_string = "(";
      foreach $word (@word_list)
      {
         foreach $db_index (@criteria_fields)
         {
            $db_name = $sc_mysql_select_order[$db_index];
            if ($form_data{'exact_match'} =~ /yes/i)
            {
               $criteria_string .= qq~$db_name = "$word" OR ~;
            } elsif ($case_sensitive =~ /yes/i) {
               $criteria_string .= qq~$db_name REGEXP ".*$word.*" OR ~;
            } else {
               $pct = "\%";
		         $criteria_string .= qq~$db_name LIKE "$pct$word$pct" OR ~;
            }
         }
         $criteria_string =~ s/ OR $//i;
         $criteria_string .= ") AND (";
      }
      $criteria_string =~ s/ AND \($//i;
   }
   return $criteria_string;
}

############################################################
# Product Stats
############################################################

sub product_stats
{
   my (@row, $cart_data, @cart_fields);
   my (%product_array, %stats, $prd_stats_1, $prd_stats_2);
   my ($key, $query, $sth1, $sth);

   $query = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$cart_id\'" || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
   $sth = $dbh->prepare($query);
   $sth->execute || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
   while(@row = $sth->fetchrow)
   {
      $cart_data = $row[2];
      @cart_fields = split (/\|/, $cart_data);
      push (@stata, $cart_fields[1]);
      push (@statb, $cart_fields[1]);
   }
   $sth->finish;

   foreach $prda (@stata)
   {
      foreach $prdb (@statb)
      {
         if ($prda ne $prdb)
         {
            &insert_stats($prda, $prdb);
         }
      }
   }
}

#########################################################################
# This function insert a new record into the table specified.
#########################################################################

sub insert_stats
{
   local ($prd_1, $prd_2)= @_;

   local ($query, $sth3, @insert_fields, $new_record, $data);
   local ($check_query, @check_fields, $check_record, $check);
   local ($check_count);

   $check_query = "SELECT * FROM $sc_mysql_stat_table WHERE id = \'$prd_1\' AND prd = \'$prd_2\'" || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
   $sth3 = $dbh->prepare($check_query);
   $sth3->execute || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
   while (@row = $sth3->fetchrow)
   {
      $check_count++;
   }
   $sth3->finish;

   if ($check_count)
   {
      $query = "UPDATE $sc_mysql_stat_table SET count = count + 1 WHERE id = \'$prd_1\' AND prd = \'$prd_2\'" || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
      $sth3 = $dbh->prepare($query);
      $sth3->execute || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
      $sth3->finish;
   } else {
      $query = "INSERT INTO $sc_mysql_stat_table values ('$prd_1', '$prd_2', '1')" || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
      $sth3 = $dbh->prepare($query);
      $sth3->execute || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
      $sth3->finish;
   }
}

############################################################
#             Perl String
############################################################

sub perl_string
{
   local($data_string = $_);

   $data_string =~ s/\\/\\\\/g;
   $data_string =~ s/\|/\\\|/g;
   $data_string =~ s/\$/\\\$/g;
   $data_string =~ s/\^/\\\^/g;
   $data_string =~ s/\}/\\\}/g;
   $data_string =~ s/\{/\\\{/g;
   $data_string =~ s/\(/\\\(/g;
   $data_string =~ s/\)/\\\)/g;
   $data_string =~ s/\[/\\\[/g;
   $data_string =~ s/\]/\\\]/g;
   $data_string =~ s/\+/\\\+/g;
   $data_string =~ s/\?/\\\?/g;
   $data_string =~ s/\*/\\\*/g;

   return $data_string;
}