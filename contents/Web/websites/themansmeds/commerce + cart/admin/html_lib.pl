###########################################################################
#
###########################################################################

sub StoreHeader
{
   &cart_content;
   $product = $form_data{'product'};
   $keywords = $form_data{'keywords'};
   $keywords =~ s/ /+/g;
   $date = &get_date;
   &categories;
   &pages;
   print qq~
         <!--Start Header Here-->
         <script LANGUAGE="JavaScript1.1">
             function makeCool() {
                 src = event.toElement;
         //	alert(src.href);
                 if (src.href) {
                     src.oldcol = src.style.color;
                     src.style.color = "ff0000";
                 }
             }
             function makeNonCool() {
                 src=event.fromElement;
                 if (src.href) {
                     src.style.color = src.oldcol;
                 }
             }
         	{
         		document.onmouseover=makeCool;
         		document.onmouseout=makeNonCool;
         	}

         </script>
         <table cellSpacing="0" width="100%" border="0" bgcolor="$highlightcolor">

         <tr>
         <td colspan="2">
         <p align="center"><b><font color="$highlightfontcolor" face="Arial" size="1">&nbsp;<br>
         </font><font size="6" color="$highlightfontcolor" face="Arial">$site_name<br>
         </font><font color="$highlightfontcolor" face="Arial" size="1">&nbsp;</font></b>
         </td>
         </tr>
         <tr bgColor="#000000" height="25">
         <td align="left"><font face="Arial" color="#ffffff" size="1">
         &nbsp;$date</font></td>
         <td align="right"><font face="Arial" color="#ffffff" size="2">$cart_content</font>
         <a href="$sc_main_script_url?add_to_cart_button.x=yes&product=$product&cart_id=$cart_id&keywords=$keywords&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$form_data{'next'}&viewOrder=yes"><img alt src="$URLofImages/site/cart-checkout.gif" align="absMiddle" border="0" width="181" height="25"></a></td>
         </tr>
         </table>
         <table cellSpacing="0" cellPadding="5" width="100%" border="0">

         <tr>
         <td valign="top" width="125">
         <table cellSpacing="0" cellPadding="2" width="100%" border="0">

         <tr>
         <td bgColor="$highlightcolor"><font face="Arial" color="$highlightfontcolor" size="2">&nbsp;Navigation&nbsp;</font></td>
         </tr>
         <tr>
         <td><font face="Arial" size="1">$pages<br>
         <br>
         </font></td>
         </tr>
         <tr>
         <td bgColor="$highlightcolor"><font face="Arial" color="$highlightfontcolor" size="2">Quick Find</font></td>
         </tr>
         <tr>
         <td>
         <FORM METHOD=POST ACTION=$sc_main_script_url>
         <INPUT TYPE="text" NAME="keywords" SIZE="15" MAXLENGTH="60">
         <INPUT TYPE="submit" NAME="search_request_button.x" VALUE=" Search ">
         <input type="hidden" name="cart_id" value=$cart_id>
         </form>
         </td>
         </tr>
         <tr>
         <td bgColor="$highlightcolor"><font face="Arial" color="$highlightfontcolor" size="2">&nbsp;Categories</font></td>
         </tr>
         <tr>
         <td><font face="Arial" size="1">
         $categories<br>
         <br>
         </font></td>
         </tr>
         </table>
         <p>&nbsp;</p>
         <p>&nbsp;
         </td>
         <td vAlign="top" width="100%" class="boxborder">
         <!-- End Header Here -->
   ~;

   open (CATEGORY_DESC, "<./category/$form_data{'product'}.htm");
   while (<CATEGORY_DESC>)
   {
      print $_;
   }
   close (CATEGORY_DESC);
}

###########################################################################
#
###########################################################################

sub SecureStoreHeader
{
   $URLofImages = $secure_image_path;
   &cart_content;
   $date = &get_date;
   &categories;
   &pages;
   $product = $form_data{'product'};
   $keywords = $form_data{'keywords'};
   $keywords =~ s/ /+/g;
   print qq~
         <!--Start Header Here-->
         <script LANGUAGE="JavaScript1.1">
             function makeCool() {
                 src = event.toElement;
         //	alert(src.href);
                 if (src.href) {
                     src.oldcol = src.style.color;
                     src.style.color = "ff0000";
                 }
             }
             function makeNonCool() {
                 src=event.fromElement;
                 if (src.href) {
                     src.style.color = src.oldcol;
                 }
             }
         	{
         		document.onmouseover=makeCool;
         		document.onmouseout=makeNonCool;
         	}

         </script>
         <table cellSpacing="0" width="100%" border="0" bgcolor="$highlightcolor">

         <tr>
         <td colspan="2">
         <p align="center"><b><font color="$highlightfontcolor" face="Arial" size="1">&nbsp;<br>
         </font><font size="6" color="$highlightfontcolor" face="Arial">$site_name<br>
         </font><font color="$highlightfontcolor" face="Arial" size="1">&nbsp;</font></b>
         </td>
         </tr>
         <tr bgColor="#000000" height="25">
         <td align="left"><font face="Arial" color="#ffffff" size="1">
         &nbsp;$date</font></td>
         <td align="right"><font face="Arial" color="#ffffff" size="2">$cart_content</font>
         <a href="$sc_main_script_url?add_to_cart_button.x=yes&product=$product&cart_id=$cart_id&keywords=$keywords&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$form_data{'next'}&viewOrder=yes"><img alt src="$URLofImages/site/cart-checkout.gif" align="absMiddle" border="0" width="181" height="25"></a></td>
         </tr>
         </table>
         <table cellSpacing="0" cellPadding="5" width="100%" border="0">

         <tr>
         <td valign="top" width="125">
         <table cellSpacing="0" cellPadding="2" width="100%" border="0">

         <tr>
         <td bgColor="$highlightcolor"><font face="Arial" color="$highlightfontcolor" size="2">&nbsp;Navigation&nbsp;</font></td>
         </tr>
         <tr>
         <td><font face="Arial" size="1">$pages<br>
         <br>
         </font></td>
         </tr>
         <tr>
         <td bgColor="$highlightcolor"><font face="Arial" color="$highlightfontcolor" size="2">Quick Find</font></td>
         </tr>
         <tr>
         <td>
         <FORM METHOD=POST ACTION=$sc_main_script_url>
         <INPUT TYPE="text" NAME="keywords" SIZE="15" MAXLENGTH="60">
         <INPUT TYPE="submit" NAME="search_request_button.x" VALUE=" Search ">
         <input type="hidden" name="cart_id" value=$cart_id>
         </form>
         </td>
         </tr>
         <tr>
         <td bgColor="$highlightcolor"><font face="Arial" color="$highlightfontcolor" size="2">&nbsp;Categories</font></td>
         </tr>
         <tr>
         <td><font face="Arial" size="1">
         $categories<br>
         <br>
         </font></td>
         </tr>
         </table>
         <p>&nbsp;</p>
         <p>&nbsp;
         </td>
         <td vAlign="top" width="100%" class="boxborder">
         <!-- End Header Here -->
   ~;
}

###########################################################################
#
###########################################################################

sub StoreFooter
{
   &specials;
   print qq~
      <!--BEGIN STORE FOOTER-->
      </td>
      <td vAlign="top" width="125">
      <table cellSpacing="0" cellPadding="2" width="100%" border="0">
      <tr>
      <td bgColor="$highlightcolor" nowrap><font face="Arial" color="$highlightfontcolor" size="2">&nbsp;Hot
        Buys</font></td>
      </tr>
      <tr>
      <td>
      <br>
        <p align="center">$specials</p>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </table>


<table bgColor="$highlightcolor" border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%">
      <p align="center">&nbsp;</td>
  </tr>
				</table>
            <p align="center"><br>
            <font face="Arial" size="2">
            <a href="http://commercesql.com">FREE SHOPPING CART SOFTWARE!</a></font>
            <p align="center">&nbsp;

      <!--END STORE FOOTER-->
   ~;
}

###########################################################################
#
###########################################################################

sub SecureStoreFooter
{
   &specials_Secure;
   print qq~
      <!--BEGIN SECURE STORE FOOTER-->
      </td>
      <td vAlign="top" width="125">
      <table cellSpacing="0" cellPadding="2" width="100%" border="0">
      <tr>
      <td bgColor="$highlightcolor" nowrap><font face="Arial" color="$highlightfontcolor" size="2">&nbsp;Hot
        Buys</font></td>
      </tr>
      <tr>
      <td>
      <br>
        <p align="center">$specials</p>
      </td>
      </tr>
      </table>
      </td>
      </tr>
      </table>

<table bgColor="$highlightcolor" border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%">
      <p align="center">&nbsp;</td>
  </tr>
				</table>
            <p align="center"><br>
            <font face="Arial" size="2">
            Powered by: <a href="http://commercesql.com">CommerceSQL Shopping
            Cart</a></font>
            <p align="center">&nbsp;

      <!--END STORE FOOTER-->
   ~;
}

#######################################################################
#                    product_page_header Subroutine                   #
#######################################################################

sub product_page_header
{
   local ($page_title) = @_;
   local ($hidden_fields) = &make_hidden_fields;
   if ($form_data{'product'})
   {
      $hdr_prd = "$page_title - $form_data{'product'}";
   } elsif ($form_data{'pid'}) {
      $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
      my($query) = "SELECT * FROM $sc_mysql_prd_table where rowid = \'$form_data{'pid'}\'";
   	my($sth) = $dbh->prepare($query);
   	$sth->execute || die("Couldn't exec sth!");
   	while(@row = $sth->fetchrow)
   	{
         $hdr_prd = $row[3];
      }
      $sth->finish;
      $dbh->disconnect;
   } elsif ($form_data{'keywords'}) {
      $hdr_prd = "Search Results for: $form_data{'keywords'}";
   } else {
      $hdr_prd = $page_title;
   }

   print qq~
      <HTML>
      <HEAD>
      <TITLE>$hdr_prd</TITLE>
      <style>
      	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
      </style>
      </HEAD>
      $body_tag
   ~;
   &StoreHeader;
}

#######################################################################
#                    product_page_footer Subroutine                   #
#######################################################################

sub product_page_footer
   {
   local($keywords);
   $keywords = $form_data{'keywords'};

   $keywords =~ s/ /+/g;

   local($db_status, $total_rows_returned) = @_;
   local($warn_message);
   $warn_message = "<DIV ALIGN=CENTER>";

   if ($db_status ne "")
   {

   	if ($db_status =~ /max.*row.*exceed.*/i)
   	{

   		if($form_data{'next'} > "0")
   		{
      		$warn_message .= qq~
      		   <a href=$sc_main_script_url?product=$form_data{'product'}&keywords=$keywords&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$prevCount>Previous $prevHits Matches</a> &nbsp;&nbsp;
      		~;
   		}

   		if ($maxCount == $rowCount-1)
   		{
   			$nextHits = (@database_rows-$maxCount);
   			if ($nextHits == 1)
   			{
      			$warn_message .= qq~
      			   <a href=$sc_main_script_url?product=$form_data{'product'}&keywords=$keywords&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$maxCount>Last Match</a>
      			~;
   			}

   		}

   	if ($maxCount < $rowCount && $maxCount != $rowCount-1)
   	{

   		if ($maxCount >= $rowCount-$nextHits )
   		{
      		$lastCount = $rowCount-$maxCount;
      		$warn_message .= qq~
      		   <a href=$sc_main_script_url?product=$form_data{'product'}&keywords=$keywords&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$maxCount>Last $lastCount Matches</a>
      		~;
   		} else {
      		$warn_message .= qq~
      		   <a href=$sc_main_script_url?product=$form_data{'product'}&keywords=$keywords&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$maxCount>Next $nextHits Matches</a>
      		~;
   		}

   	}

   	$warn_message .= "</DIV>";

   	}

   }

   print qq~
      <P>
      $warn_message
   ~;

   &StoreFooter;

   print qq~
      </BODY>
      </HTML>
   ~;
   exit;
}

#######################################################################
#                    standard_page_header Subroutine                  #
#######################################################################

sub standard_page_header

{
   local($type_of_page) = @_;
   local ($hidden_fields) = &make_hidden_fields;
   print qq~
      <HTML>
      <HEAD>
      <TITLE>$type_of_page</TITLE>
      <style>
      	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
      </style>
      </HEAD>
      $body_tag
   ~;
}

#######################################################################
#                       cart_footer Subroutine                        #
#######################################################################

sub cart_footer
{
   local($offlineSecureURL);

   $offlineSecureURL =
      "</FORM>
      <FORM METHOD\=POST ACTION\=\"$sc_order_script_url\">
      <INPUT TYPE\=HIDDEN NAME\=\"cart_id\" VALUE\=\"$cart_id\">";

   $keywords = $form_data{'keywords'};
   $keywords =~ s/ /+/g;

   if ($subtotal > 0)
   {
      print qq~
         <div align="center">
         <center>
         <table width="400" border="0">
                  <br><br>
         <tr>
         <td valign="top" align="right">
         <INPUT TYPE="IMAGE" NAME="submit_change_quantity_button" VALUE="Change Quantity" SRC="$URLofImages/cart/edit_items.gif" BORDER="0">
         </td>
         <td valign="top" align="right">
         <INPUT TYPE="IMAGE" NAME="continue_shopping_button" VALUE="Continue Shopping" SRC="$URLofImages/cart/continue_shopping.gif" BORDER="0">
         </td>
         <td valign="top" align="right">
         $offlineSecureURL
         <INPUT TYPE = "hidden" NAME = "product" VALUE = "$form_data{'product'}">
         <INPUT TYPE = "hidden" NAME = "keywords" VALUE = "$keywords">
         <INPUT TYPE = "hidden" NAME = "pid" VALUE = "$form_data{'pid'}">
         <INPUT TYPE = "hidden" NAME = "name" VALUE = "$form_data{'name'}">
         <INPUT TYPE="IMAGE" NAME="order_form_button" VALUE="Complete Secure Order" SRC="$URLofImages/cart/complete_order.gif" BORDER="0">
         </FORM>
         </td>
         </tr>
         </table>
         </center>
         </div>
      ~;
   } else {
      print qq~
         <div align="center">
           <center>
           <table border="0">
             <tr>
               <td width="100%">
                  &nbsp;
                  <p>
                  <INPUT TYPE="IMAGE" NAME="continue_shopping_button" VALUE="Continue Shopping" SRC="$URLofImages/cart/continue_shopping.gif" BORDER="0">
                  </p>
               </td>
             </tr>
           </table>
           </center>
         </div>
      ~;
   }

   &StoreFooter;
}

#######################################################################
#                    cart_table_header Subroutine                     #
#######################################################################

sub cart_table_header

{
   local ($modify_type) = @_;
   if (($modify_type ne "") && ($modify_type ne "orderform") && ($modify_type ne "process order"))
   {
      $modify_type = "<TH bgcolor=$highlightcolor><FONT color=$highlightfontcolor FACE=ARIAL SIZE=2>&nbsp\;$modify_type\&nbsp\;</FONT></TH>";
   }
   if ($modify_type eq "")
   {
      $modify_type = "<TH></TH>";
   }
   if ($modify_type eq "orderform")
   {
      $modify_type = "";
   }
   if ($modify_type eq "process order")
   {
      $modify_type = "";
   }
   if (($reason_to_display_cart =~ /orderform/i) || ($reason_to_display_cart =~ /verify/i))
   {
      print qq~
         <HTML>
         <HEAD>
         <TITLE>Check Out</TITLE>
         <style>
         	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
         </style>
         </HEAD>
         $body_tag
      ~;
      &SecureStoreHeader;
   } else {
      print qq~
         <HTML>
         <HEAD>
         <TITLE>Check Out</TITLE>
         <style>
         	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
         </style>
         </HEAD>
         $body_tag
      ~;
      &StoreHeader;
   }
   print qq~
      <FORM METHOD="POST" ACTION="$sc_main_script_url">
      <INPUT TYPE="HIDDEN" NAME="product" VALUE="$form_data{'product'}">
      <INPUT TYPE="HIDDEN" NAME="keywords" VALUE="$form_data{'keywords'}">
      <INPUT TYPE="HIDDEN" NAME="pid" VALUE="$form_data{'pid'}">
      <INPUT TYPE="HIDDEN" NAME="name" VALUE="$form_data{'name'}">
      <INPUT TYPE="HIDDEN" NAME="cart_id" VALUE="$cart_id">
      <INPUT TYPE="HIDDEN" NAME="next" VALUE="$form_data{'next'}">

      <CENTER>
      <TABLE width=100% BORDER = "0" cellspacing="0" cellpadding="2">
      <TR>
      <FONT FACE=ARIAL SIZE=2>
      $modify_type
   ~;
   foreach $field (@sc_cart_display_fields)
   {
      print qq~
         <TH bgcolor="$highlightcolor"><FONT color=$highlightfontcolor FACE=ARIAL SIZE=2>&nbsp;$field&nbsp;</FONT></TH>\n
      ~;
   }
}

#######################################################################
#                    display_cart_table Subroutine                    #
#######################################################################

sub display_cart_table
{
   local($reason_to_display_cart) = @_;
   local(@cart_fields);
   local($cart_id_number);
   local($quantity);
   local($unformatted_subtotal);
#   local($subtotal);
   local($unformatted_grand_total);
   local($grand_total);
   local($price);
   local($total_quantity) = 0;
   local($total_measured_quantity) = 0;
   local($display_index);
   local($counter);
   local($hidden_field_name);
   local($hidden_field_value);
   local($display_counter);
   local($product_id, @db_row);
   local($cart_html);

   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;

   my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$cart_id\'";
   	my($sth) = $dbh->prepare($query);
   	$sth->execute || die("Couldn't exec sth!");
   	while(@row = $sth->fetchrow)  {
   	   $row_count++;
   		$cart_data = $row[2];
         $cart_html .= "<TR>";
         chop;
         @cart_fields = split (/\|/, $cart_data);
         $cart_row_number = pop(@cart_fields);
         push (@cart_fields, $cart_row_number);
         $quantity = $cart_fields[0];
         $product_id = $cart_fields[1];
         $remain = $row_count % 2;   # This gets the remainder after division.
         if ($remain)
         {
            $bgcolor = "#FFFFFF";
         } else {
            $bgcolor = "#E6E6E6";
         }
         if ($reason_to_display_cart =~ /orderform/i)
         {
            if (!(&check_db_with_product_id($product_id,*db_row)))
            {
               print qq~
                  </TR></TABLE>
                  <DIV ALIGN=CENTER><TABLE WIDTH=400>
                  <TR><TD>&nbsp;</TD></TR><TR><TD><P>
                  <FONT FACE=ARIAL>
                  I'm sorry, Product ID: $product_id was not found in
                  the database. Your order cannot be processed without
                  this validation. Please contact the
                  <a href=mailto:$sc_admin_email>site administrator</a>.
                  </FONT></TD></TR></TABLE></DIV>
                  </BODY>
                  </HTML>
               ~;
               exit;
            } else {
            	if ($db_row[$sc_db_index_of_price] ne $cart_fields[$sc_cart_index_of_price])
            	{
               	print qq~
                  	</TR>
                  	</TABLE>
                  	<DIV ALIGN=CENTER>
                  	<TABLE WIDTH=500>
                  	<TR>
                  	<TD>
                  	<P>
                  	<FONT FACE=ARIAL>
                  	Price for product id:$product_id did not match
                  	database! Your order will NOT be processed without
                  	this validation!
                  	</TD>
                  	</TR>
                  	</TABLE>
                  	</DIV>
                  	</BODY>
                  	</HTML>
               	~;
               	exit;
            	}
            }
         }

         $total_quantity += $quantity;
         if ($reason_to_display_cart =~ /change*quantity/i)
         {
            $cart_html .= qq~
               <TD bgcolor="$bgcolor" ALIGN = "center">
               <INPUT TYPE = "text" NAME = "$cart_row_number" SIZE ="3">
               </TD>
            ~;
         } elsif (($reason_to_display_cart =~ /orderform/i) || ($reason_to_display_cart =~ /process order/i) || ($reason_to_display_cart =~ /verify/i)) {
         } else {
            $cart_html .= qq~
               <td bgcolor="$bgcolor"><FONT FACE=ARIAL SIZE=2><a href="$sc_main_script_url?submit_deletion_button.x=yes&product=$form_data{'product'}&keywords=$form_data{'keywords'}&pid=$form_data{'pid'}&name=$form_data{'name'}&next=$form_data{'next'}&delete_row=$cart_row_number&cart_id=$cart_id">Delete</a></FONT>
               </td>
            ~;
         }
         $display_counter = 0;
         foreach $display_index (@sc_cart_index_for_display)
         {
            if ($cart_fields[$display_index] eq "")
            {
               $cart_fields[$display_index] = "&nbsp;";
            }
           if ($display_index == $sc_cart_index_of_name)
            {
               $cart_html .= qq~
                  <TD bgcolor="$bgcolor" ALIGN = "left"><FONT FACE=ARIAL SIZE=2><a href="$sc_main_script_url?cart_id=$cart_id&pid=$cart_fields[1]">$cart_fields[$display_index]</a></FONT></TD>\n
               ~;
            } elsif ($display_index == $sc_cart_index_of_price) {
               $price = &display_price(&format_price($cart_fields[$display_index]));
               $cart_html .= qq~
                  <TD bgcolor="$bgcolor" ALIGN = "center" nowrap valign="top"><FONT FACE=ARIAL SIZE=2>$price</FONT></TD>\n
               ~;
            } elsif ($display_index == $sc_cart_index_of_price_after_options) {
               $lineTotal = &format_price(($cart_fields[0]*$cart_fields[$display_index]));
               $lineTotal = &display_price($lineTotal);
               $cart_html .= qq~
                  <TD bgcolor="$bgcolor" ALIGN = "right" nowrap valign="top"><FONT FACE=ARIAL SIZE=2>$lineTotal</FONT></TD>\n
               ~;
            } elsif ($display_index == $sc_cart_index_of_option) {
               if (($reason_to_display_cart =~ /orderform/i) || ($reason_to_display_cart =~ /process order/i) || ($reason_to_display_cart =~ /verify/i))
               {
                  $cart_html .= qq~
                     </tr><tr><td bgcolor="$bgcolor"></td>
                     <td bgcolor="$bgcolor"><FONT FACE=ARIAL SIZE=2>$cart_fields[$display_index]</font></td>
                     <td bgcolor="$bgcolor"></td><td bgcolor="$bgcolor"></td></tr>
                  ~;
               } else {
                  $cart_html .= qq~
                     </tr><tr><td bgcolor="$bgcolor"></td><td bgcolor="$bgcolor"></td>
                     <td bgcolor="$bgcolor"><FONT FACE=ARIAL SIZE=2>$cart_fields[$display_index]</font></td>
                     <td bgcolor="$bgcolor"></td><td bgcolor="$bgcolor"></td></tr>
                  ~;
               }
            } elsif (($display_index == "0") && ($reason_to_display_cart eq /orderform/i)) {
               $cart_html .= qq~
                  <td bgcolor="$bgcolor" align = "center">
                  <INPUT TYPE ="text" NAME="$cart_row_number" VALUE="$quantity" SIZE ="3">
                  </td>
               ~;
            } else {
               $cart_html .= qq~
                  <TD bgcolor="$bgcolor" ALIGN = "center"><FONT FACE=ARIAL SIZE=2>$cart_fields[$display_index]</FONT></TD>\n
               ~;
            }
            $display_counter++;
         }

         $total_measured_quantity += ($cart_fields[0]*$cart_fields[6]);
         $shipping_total = $total_measured_quantity;

         $unformatted_subtotal = ($cart_fields[$sc_cart_index_of_price_after_options]);
         $subtotal = &format_price($cart_fields[0]*$unformatted_subtotal);
         $unformatted_grand_total = $grand_total + $subtotal;
         $grand_total = &format_price($unformatted_grand_total);
         $price = &display_price($subtotal);


   	}
   $sth->finish;
   $dbh->disconnect;

   $price = &display_price($grand_total);
   $shipping_total = &display_price($shipping_total);

   if ($reason_to_display_cart =~ /verify/i)
   {
      $cart_html .= qq~
         <INPUT TYPE=HIDDEN NAME=TOTAL VALUE=$grand_total>
      ~;
   }

   $cart_html .= qq~
      </TABLE>
        <table border="0" width="100%">
          <tr>
            <td width="100%">
              <div align="right">
                <table border="0" width="200">
                  <tr>
                    <td width="60%" bgcolor="$highlightcolor">
                      <p align="right"><font SIZE=2 color="$highlightfontcolor"><b>Subtotal:&nbsp;&nbsp; </b></font></td>
                    <td width="40%">
                      <p align="right"><font SIZE=2>$price</font></td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>
          </table>
         ~;

   if ($grand_total > 0)
   {
      if ($reason_to_display_cart =~ /process order/i)
      {
          $alt_image = "process_order";
          $reason_to_display_cart = "process order";
          &cart_table_header($reason_to_display_cart, $alt_image);
      } elsif (($reason_to_display_cart =~ /orderform/i) || ($reason_to_display_cart =~ /verify/i)) {
         $reason_to_display_cart = "orderform";
         &cart_table_header($reason_to_display_cart);
      } else {
         &cart_table_header("Delete");
      }

      print $cart_html;
      &display_calculations($grand_total,$total_measured_quantity);
   } else {
      print qq~
         <HTML>
         <HEAD>
         <TITLE>Check Out</TITLE>
         <style>
         	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
         </style>
         </HEAD>
         $body_tag
      ~;
      &StoreHeader;
      print qq~
         </FORM>
         <FORM METHOD="POST" ACTION="$sc_main_script_url">
         <INPUT TYPE="HIDDEN" NAME="product" VALUE="$form_data{'product'}">
         <INPUT TYPE="HIDDEN" NAME="keywords" VALUE="$form_data{'keywords'}">
         <INPUT TYPE="HIDDEN" NAME="pid" VALUE="$form_data{'pid'}">
         <INPUT TYPE="HIDDEN" NAME="name" VALUE="$form_data{'name'}">
         <INPUT TYPE="HIDDEN" NAME="cart_id" VALUE="$cart_id">
         <CENTER>
         <TABLE width=100% BORDER = "0" cellspacing="0" cellpadding="2">
         <TR>
         <FONT FACE=ARIAL SIZE=2>
      ~;
      print qq~
         <div align="center">
           <center>
           <table border="0" width="100%">
             <tr>
               <td width="100%">
                 <p align="center">Your cart is empty... Please add products to your cart before checking out.</td>
             </tr>
           </table>
           </center>
         </div>
      ~;
   }

   return($grand_total, $total_quantity, $total_measured_quantity);
}

#######################################################################
#                    make_hidden_fields Subroutine                    #
#######################################################################

sub make_hidden_fields
{
   local($hidden);
   local($db_query_row);
   local($db_form_field);

   $hidden = qq~
      <INPUT TYPE = "hidden" NAME = "cart_id" VALUE = "$cart_id">
      <INPUT TYPE = "hidden" NAME = "page" VALUE = "$form_data{'page'}">
   ~;
   if ($form_data{'keywords'} ne "")
   {
      $hidden .= qq~
         <INPUT TYPE = "hidden" NAME = "keywords" VALUE = "$form_data{'keywords'}">
      ~;
   }
   if ($form_data{'name'} ne "")
   {
      $hidden .= qq~
         <INPUT TYPE = "hidden" NAME = "name" VALUE = "$form_data{'name'}">
      ~;
   }
   if ($form_data{'pid'} ne "")
   {
      $hidden .= qq~
         <INPUT TYPE = "hidden" NAME = "pid" VALUE = "$form_data{'pid'}">
      ~;
   }
   if ($form_data{'exact_match'} ne "")
   {
      $hidden .= qq~
         <INPUT TYPE = "hidden" NAME = "exact_match" VALUE = "$form_data{'exact_match'}">
      ~;
   }
   if ($form_data{'case_sensitive'} ne "")
   {
      $hidden .= qq~
         <INPUT TYPE = "hidden" NAME = "case_sensitive" VALUE = "$form_data{'case_sensitive'}">
      ~;
   }
   foreach $db_query_row (@sc_db_query_criteria)
   {
      $db_form_field = (split(/\|/, $db_query_row))[0];
      if ($form_data{$db_form_field} ne "" && $db_form_field ne "keywords")
      {
         $hidden .= qq~
            <INPUT TYPE = "hidden" NAME = "$db_form_field" VALUE = "$form_data{$db_form_field}">
         ~;
      }
   }
   return ($hidden);
}

###################################################################################
#
###################################################################################

sub displayProductPage
{
   $keywords = $form_data{'keywords'};

   $keywords =~ s/ /+/g;

   $image = $display_fields[0];
   if ($form_data{'pid'} || $form_data{'fp'} || $form_data{'name'})
   {
      $image =~ s/%%URLofImages%%/$URLofImages\/product/g;
   }else {
      $image =~ s/%%URLofImages%%/$URLofImages\/product\/small/g;
   }
   $name = $display_fields[1];
   $description = $display_fields[2];
   $optionFile = $display_fields[3];

   $price = $display_fields[4];
   $shippingPrice = $display_fields[5];
   $userFieldOne = $display_fields[6];
   $userFieldTwo = $display_fields[7];
   $userFieldThree = $display_fields[8];
   $userFieldFour = $display_fields[9];
   $userFieldFive = $display_fields[10];
   $itemID = "item-$itemID";

   if ($form_data{'pid'} || $form_data{'fp'} || $form_data{'name'})
   {
      print qq~
         <form method="POST" action="$sc_main_script_url">
         <INPUT TYPE = "hidden" NAME = "cart_id" VALUE = "$cart_id">
         <INPUT TYPE = "hidden" NAME = "product" VALUE = "$form_data{'product'}">
         <INPUT TYPE = "hidden" NAME = "keywords" VALUE = "$keywords">
         <INPUT TYPE = "hidden" NAME = "pid" VALUE = "$form_data{'pid'}">
         <INPUT TYPE = "hidden" NAME = "name" VALUE = "$form_data{'name'}">
         <INPUT TYPE = "hidden" NAME = "back" VALUE = "$form_data{'back'}">
         <table width="100%" cellspacing="0" cellpadding="4">
         <TD ALIGN="CENTER" VALIGN="Top">
         <FONT FACE="ARIAL" SIZE="2">
         <p>$image</p>
         <p><a href="$sc_main_script_url?product=$form_data{'product'}&next=$form_data{'back'}&cart_id=$cart_id&keywords=$keywords&product=$product"><img border="0" src="$URLofImages/cart/back.gif" width="131" height="33"></a></p>
         </font>
         </TD>
         <TD ALIGN="CENTER" valign="top" width="100%">
         <p align="center">
         <FONT FACE="ARIAL" SIZE="2">
         <b>$name</b>
         </FONT>
         <p align="left">
         <FONT FACE="ARIAL" SIZE="2">
         $description
         </FONT>
         <p align="center">
         <b>
         <font color="#FF0000" SIZE="2" face="Arial"><br>
         Only: $price<br>
         <br>
         </font>
         </b>
         <FONT FACE="ARIAL" SIZE="2">
         $optionFile
         </font>
         <b>
         <font color="#FF0000" SIZE="2" face="Arial"><br>
         </font>
         </b>
         <div align="center">
         <center>
         <table border="0" cellspacing="0" cellpadding="0">
         <tr>
         <td>
         <p align="center">
         <FONT FACE="ARIAL" SIZE="2">
         <INPUT TYPE="TEXT" NAME="$itemID" SIZE="3" MAXLENGTH="3" VALUE="1">
         </font>
         </p>
         </td>
         <td>
          <p align="center"><FONT FACE="ARIAL" SIZE="2">
         <INPUT TYPE="IMAGE" NAME="add_to_cart_button" VALUE="Add To Cart" SRC="$URLofImages/cart/add_to_cart.gif" BORDER="0">
         </font>
          </p>
         </td>
         </tr>
         </table>
         </center>
         </div>
         </table>
         </form>
      ~;

      if ($display_common_products eq "yes")
      {
         $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || print "Error Line " . __LINE__ . "<br><br>Couldn't connect to database<br><br>$DBI::errstr<br>\n";

         $query = "SELECT prd FROM $sc_mysql_stat_table where id = \'$form_data{'pid'}\' ORDER BY count DESC LIMIT $display_common_number";
         $sth = $dbh->prepare($query);
         $sth->execute || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
         while(@row = $sth->fetchrow)
         {
         $common_prd_count++;
         $rowid = $dbh->quote($row[0]);
         $rowid = "rowid = $rowid";
         push (@common_prds, $rowid);
         }
         $sth->finish;

         if ($common_prd_count)
         {
            $common_sel = join(" OR ", @common_prds);

            $query = "SELECT * FROM $sc_mysql_prd_table WHERE $common_sel";
            $sth = $dbh->prepare($query);
            $sth->execute || print "Error Line " . __LINE__ . "<br>$query<br>$DBI::errstr<br>\n";
            while(@row = $sth->fetchrow)
            {
               $common_prd .= qq~
               <li><p align="left"><font face="Arial" size="2">
               <a href="$sc_main_script_url?pid=$row[$db{"product_id"}]&cart_id=$cart_id&fp=x">
               $row[$db{"name"}]
               </a></font></li>
               ~;
               $prd_count++;
            }
            $sth->finish;
         }

         $dbh->disconnect;

         if ($prd_count > 0){
            $common_products = "<div align=\"center\"><center><table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"100%\" align=\"left\" bgcolor=\"$highlightcolor\">";
            $common_products .= "<p align=\"left\"><font face=\"Arial\" size=\"2\" color=\"$highlightfontcolor\">&nbsp;&nbsp;Others who have bought this product have also purchased:</font>";
            $common_products .= "</td></tr><tr><td width=\"100%\" align=\"left\">";
            $common_products .= "<ul>" . $common_prd . "</ul>";
            $common_products .= "</td></tr></table></center></div>";
         } else {
            $common_products = "";
         }
      } else {
         $common_products = "";
      }

      print $common_products;
   } else {
      print qq~
      <table border="0" cellspacing="0" cellpadding="0" width="85%">
        <tr>
          <td rowspan="2" valign="top" width="50%">
            <p align="right">
               <a href="$sc_main_script_url?cart_id=$cart_id&back=$form_data{'next'}&pid=$database_fields[$sc_db_index_of_product_id]&keywords=$keywords&product=$product">
               $image
               </a>
          </td>
          <td width="50%" valign="top">
            <p align="center">
               <FONT FACE="ARIAL" SIZE="1">
               <a href="$sc_main_script_url?cart_id=$cart_id&back=$form_data{'next'}&pid=$database_fields[$sc_db_index_of_product_id]&keywords=$keywords&product=$product">$name</a>
               </FONT>
          </td>
        </tr>
        <tr>
          <td valign="bottom" width="50%">
            <p align="center">
               <font color="#FF0000"><b>$price</b></font>
          </td>
        </tr>
      </table>
      ~;
   }

}

###########################################################################
#
###########################################################################

sub no_items_found
{
   print qq~
      <p align="center"><font face="Arial">No items found for that search but you may
      like one of these items.</font></p>
   ~;
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   my($query) = "SELECT * FROM $sc_mysql_prd_table ORDER BY RAND() LIMIT $sc_db_max_rows_returned";
   # my($query) = "SELECT rowid,category,price,name,image,rand((rowid)+curtime()+0) as rand FROM $sc_mysql_prd_table order by rand LIMIT $sc_db_max_rows_returned";

	my($sth) = $dbh->prepare($query);
	$sth->execute || die("Couldn't exec sth!");

   print "<div align=\"center\">";
   print "<center>";
   print "<table border=\"0\" width=\"100%\"><tr><td valign=\"top\">";
   $desCount = "1";

	while(@row = $sth->fetchrow)
	{
	   $name = $row[3];
	   $image = $row[4];
	   $price = &display_price($row[2]);
      $image =~ s/%%URLofImages%%/$URLofImages\/product\/small/g;
      if ($rowCount){
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
            print "<\/td><td width=\33%\" valign=\"top\">";
            $desCount++;
         }
      }
      $rowCount++;
      print qq~
         <table border="0" cellspacing="0" cellpadding="0" width="85%">
           <tr>
             <td rowspan="2" valign="top" width="50%">
               <p align="right">
                  <a href="$sc_main_script_url?cart_id=$cart_id&amp;pid=$row[0]">
                  $image
                  </a>
             </td>
             <td width="50%" valign="top">
               <p align="center">
                  <FONT FACE="ARIAL" SIZE="1">
                  <a href="$sc_main_script_url?cart_id=$cart_id&amp;pid=$row[0]">$name</a>
                  </FONT>
             </td>
           </tr>
           <tr>
             <td valign="bottom" width="50%">
               <p align="center">
                  <font color="#FF0000"><b>$price</b></font>
             </td>
           </tr>
         </table>
      ~;
   }
   $sth->finish;
   $dbh->disconnect;
   print "<\/td><\/tr><\/table></center></div>";
}

#################################################################

sub display_calculations {

local($subtotal,$total_measured_quantity) = @_;

($final_shipping, $final_discount, $final_sales_tax,$grand_total) =
&calculate_final_values($subtotal, $total_quantity, $total_measured_quantity);

if ($final_shipping > 0)
{
   $final_shipping = &format_price($final_shipping);
   $final_shipping = &display_price($final_shipping);
   print qq~
        <table border="0" width="100%">
          <tr>
            <td width="100%">
              <div align="right">
                <table border="0" width="200">
                  <tr>
                    <td width="60%" bgcolor="$highlightcolor">
                      <p align="right"><font SIZE=2 color="$highlightfontcolor"><b>Shipping:&nbsp;&nbsp; </b></font></td>
                    <td width="40%">
                      <p align="right"><font SIZE=2>$final_shipping</font></td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>
          </table>
   ~;
}

if ($final_discount > 0)
{
$final_discount = &format_price($final_discount);

$final_discount = &display_price($final_discount);

print qq~
  <table border="0" width="100%">
    <tr>
      <td width="100%">
        <div align="right">
          <table border="0" width="200">
            <tr>
              <td width="60%" bgcolor="$highlightcolor">
                <p align="right"><font SIZE=2 color="$highlightfontcolor"><b>Discount:&nbsp;&nbsp; </b></font></td>
              <td width="40%">
                <p align="right"><font SIZE=2>$final_discount</font></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    </table>
~;

}

if ($final_sales_tax > 0)
{
$final_sales_tax = &format_price($final_sales_tax);
$final_sales_tax = &display_price($final_sales_tax);

print qq~
  <table border="0" width="100%">
    <tr>
      <td width="100%">
        <div align="right">
          <table border="0" width="200">
            <tr>
              <td width="60%" bgcolor="$highlightcolor">
                <p align="right"><font SIZE=2 color="$highlightfontcolor"><b>Sales Tax:&nbsp;&nbsp; </b></font></td>
              <td width="40%">
                <p align="right"><font SIZE=2>$final_sales_tax</font></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    </table>
~;

}

$authPrice = $grand_total;
$grand_total = &display_price($grand_total);

print qq~
  <table border="0" width="100%">
    <tr>
      <td width="100%">
        <div align="right">
          <table border="0" width="200">
            <tr>
              <td width="60%" bgcolor="$highlightcolor">
                <p align="right"><font SIZE=2 color="$highlightfontcolor"><b>Grand Total:&nbsp;&nbsp; </b></font></td>
              <td width="40%">
                <p align="right"><font SIZE=2>$grand_total</font></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>
    </table>
~;

print qq~
<INPUT TYPE=HIDDEN NAME=cart_id VALUE=\"$cart_id\">
<INPUT TYPE=HIDDEN NAME=AMOUNT VALUE=\"$sc_money_symbol $authPrice\">
<INPUT TYPE=HIDDEN NAME=SHIPPING VALUE=\"$final_shipping\">
<INPUT TYPE=HIDDEN NAME=DISCOUNT VALUE=\"$final_discount\">
<INPUT TYPE=HIDDEN NAME=SALESTAX VALUE=\"$final_sales_tax\">
~;
}

#######################################################################
#                             Cart Content                            #
#######################################################################

sub cart_content
{
   $count = "";
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$cart_id\'";
	my($sth) = $dbh->prepare($query);
	$sth->execute || die("Couldn't exec sth!");
	while(@row = $sth->fetchrow)  {
      $count++;
      @cart_fields = split (/\|/, $row[2]);
      $quantity = $cart_fields[0];
      $product_id = $cart_fields[1];
      $price = $cart_fields[$sc_cart_index_of_price_after_options];
      $total_cost = $total_cost + $quantity * $price;
      $total_qty = $total_qty + $quantity;
   }
   $sth->finish;
   $dbh->disconnect;
   if ($count > 0) {
     $cart_content = "Total Quantity: $total_qty &nbsp; Subtotal: " . &display_price(&format_price($total_cost)) . "\n";
   } else {
     $cart_content = 'Total Quantity: 0 &nbsp; Subtotal: ' . &display_price(&format_price("0.00"));
   }
}

#######################################################################
# Create links to all the pages in the pages directory
#######################################################################

sub pages
{
   $pages = "<font face=\"Arial\" size=\"2\"><a href=\"$sc_main_script_url?cart_id=$cart_id\">Home</a></font><br>\n";
   opendir(PAGES,"./pages")||die("Cannot open Directory!");
   @pnames = readdir(PAGES);
   for $pnames(@pnames)
   {
      $pname = (split (/\./, $pnames))[0];
      $pnames =~ s/ /_/g;

      if ($pname && $pname ne "Home" && $pname ne "----")
      {
         $pages .= "<font face=\"Arial\" size=\"2\"><a href=\"$sc_main_script_url?page=$pnames&cart_id=$cart_id\">$pname</a></font><br>\n";
      }
   }
   close (PAGES)
}

#######################################################################
# Create category list from database
#######################################################################

sub categories
{
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   my($query) = "SELECT DISTINCT category FROM $sc_mysql_prd_table ORDER BY category";
	my($sth) = $dbh->prepare($query);
	$sth->execute || die("Couldn't exec sth!");
	while(@row = $sth->fetchrow)  {
	   $cat_name = $row[0];
	   $cat_name =~ s/_/ /g;
#	   $cat_name =~ s/\'/\\\'/g;
		$categories .= "<font face=\"Arial\" size=\"2\"><a href=\"$sc_main_script_url?exact_match=yes&product=$row[0]&cart_id=$cart_id\">$cat_name</a></font><br>\n";
   }
   $sth->finish;
   $dbh->disconnect;
}

#######################################################################
# Display Specials / or 3 random products from database
#######################################################################

sub specials_Secure
{
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   my($query) = "SELECT * FROM $sc_mysql_prd_table ORDER BY RAND() LIMIT 3";
   # my($query) = "SELECT rowid,category,price,name,image,rand((rowid)+curtime()+0) as rand FROM $sc_mysql_prd_table order by rand LIMIT 3";
	my($sth) = $dbh->prepare($query);
	$sth->execute || die("Couldn't exec sth!");
	while(@row = $sth->fetchrow)
	{
	   $image = $row[4];
      $image =~ s/%%URLofImages%%/$secure_image_path\/product\/small/g;
      $specials .= "<p align=\"center\">\n";
      $specials .= "<a href=\"$sc_main_script_url?pid=$row[0]&product=$row[1]&cart_id=$cart_id\">\n";
      $specials .= "$image</a><br>\n";
      $specials .= "<font face=\"Arial\" size=\"1\">$row[3]<br>\n";
      $specials .= "<b><font color=\"#FF0000\">Only: ";
      $specials .= &display_price($row[2]) . "<\/font><\/b><\/p>\n";
      $specials .= "<hr width=\"100\" noshade size=\"1\" color=\"#000000\">\n";
   }
   $sth->finish;
   $dbh->disconnect;
}

#######################################################################
# Display Specials / or 3 random products from database
#######################################################################

sub specials
{
   $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
   my($query) = "SELECT * FROM $sc_mysql_prd_table ORDER BY RAND() LIMIT 3";
   # my($query) = "SELECT rowid,category,price,name,image,rand((rowid)+curtime()+0) as rand FROM $sc_mysql_prd_table order by rand LIMIT 3";
	my($sth) = $dbh->prepare($query);
	$sth->execute || die("Couldn't exec sth!");
	while(@row = $sth->fetchrow)
	{
	   $image = $row[4];
      $image =~ s/%%URLofImages%%/$URLofImages\/product\/small/g;
      $specials .= "<p align=\"center\">\n";
      $specials .= "<a href=\"$sc_main_script_url?pid=$row[0]&product=$row[1]&cart_id=$cart_id\">\n";
      $specials .= "$image</a><br>\n";
      $specials .= "<font face=\"Arial\" size=\"1\">$row[3]<br>\n";
      $specials .= "<b><font color=\"#FF0000\">Only: ";
      $specials .= &display_price($row[2]) . "<\/font><\/b><\/p>\n";
      $specials .= "<hr width=\"100\" noshade size=\"1\" color=\"#000000\">\n";
   }
   $sth->finish;
   $dbh->disconnect;
}

1;