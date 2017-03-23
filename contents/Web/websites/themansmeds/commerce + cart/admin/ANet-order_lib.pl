#######################################################################
#                    Order Form Definition Variables                  #
#######################################################################

$sc_gateway_username = "testdriver";
$txnkey = "53C6cTa59rb757Q9";
$secure_order_script_url = "https://secure.authorize.net/gateway/transact.dll";
$authNetTestModeOn = "yes";


%sc_order_form_array =('BillTo_First_Name', 'First Name',
                       'BillTo_Last_Name', 'Last Name',
                       'BillTo_Street_Line1', 'Billing Address Street',
                       'BillTo_City', 'Billing Address City',
                       'BillTo_State', 'Billing Address State',
                       'BillTo_Zip', 'Billing Address Zip',
                       'BillTo_Country', 'Billing Address Country',
                       'ShipTo_First_Name', 'Ship To First Name',
                       'ShipTo_Last_Name', 'Ship To Last Name',
                       'ShipTo_Street_Line1', 'Shipping Address Street',
                       'ShipTo_City', 'Shipping Address City',
                       'ShipTo_State', 'Shipping Address State',
                       'ShipTo_Zip', 'Shipping Address Zip',
                       'ShipTo_Country', 'Shipping Address Country',
                       'Phone_Number', 'Phone Number',
                       'Email_Address', 'Email',
                       'Payment_Card_Type', 'Type of Card',
                       'Payment_Card_Number', 'Card Number',
                       'Payment_Card_Exp_Month', 'Card Expiration Month',
                       'Payment_Card_Exp_Year', 'Card Expiration Year');


@sc_order_form_required_fields = ("BillTo_First_Name",
                                  "BillTo_Last_Name",
                                  "BillTo_Street_Line1",
                                  "BillTo_City",
                                  "BillTo_State",
                                  "BillTo_Zip",
                                  "Phone_Number",
                                  "Email_Address",
                                  "Payment_Card_Type",
                                  "Payment_Card_Number",
                                  "Payment_Card_Exp_Month",
                                  "Payment_Card_Exp_Year");

#######################################################################
# Offline-orderform.html
#######################################################################

sub OrderForm
{
   ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
   $year += 1900;
   $cc_year = $year;

   while ($cc_year <= ($year + 10))
   {
      $cc_years .= "<option>$cc_year</option>\n";
      $cc_year++
   }

   foreach $card (@credit_cards)
   {
      $cards_accepted .= "<option>$card</option>\n";
   }
   $ship_count = 0;

#   $temp_final_shipping = &calculate_shipping($temp_total, $total_quantity, $total_measured_quantity);
   $temp_final_shipping = $total_measured_quantity + $baseShipValue + $upgradeShipPrice[$form_data{'upgradeShipping'}];
   $temp_final_shipping += $temp_final_shipping*($upgradeShipPercent[$form_data{'upgradeShipping'}]/100);
   $temp_ship = &display_price(&format_price($temp_final_shipping));

   $shipping_html = "<option value=\"$form_data{'upgradeShipping'}\">$upgradeShipValue[$form_data{'upgradeShipping'}] $temp_ship</option>";
   foreach $ship_value (@upgradeShipValue)
   {
      $temp_final_shipping = $total_measured_quantity + $baseShipValue + $upgradeShipPrice[$ship_count];
      $temp_final_shipping += $temp_final_shipping*($upgradeShipPercent[$ship_count]/100);
      $temp_ship = &display_price(&format_price($temp_final_shipping));
      $shipping_html .= "<option value=\"$ship_count\">$upgradeShipValue[$ship_count] $temp_ship</option>\n";
      $ship_count++;
   }
   print qq~
      </FORM>
      <FORM METHOD = "post" ACTION = "$sc_order_script_url">
      <INPUT TYPE = "hidden" NAME = "page" VALUE = "$form_data{'page'}">
      <INPUT TYPE = "hidden" NAME = "cart_id" VALUE = "$form_data{'cart_id'}">
      <CENTER>
      <TABLE WIDTH="100%" BORDER="0" CELLPADDING="0">
      <TR>
      <TD colspan="2" valign="top">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      <TR>
      <TD colspan="2">
        <blockquote>
          <p><font size="2" face="Arial">This is where you enter your billing
          information. This should be the same as the billing address on your credit
          card.</font></p>
        </blockquote>
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2" bgcolor="$highlightcolor"><font color="$highlightfontcolor" face="Arial"><b>&nbsp;Billing
        Name:</b></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">First Name:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="BillTo_First_Name" VALUE="$form_data{'BillTo_First_Name'}" SIZE="30" MAXLENGTH="30">
        <font color="#FF0000">$form_data{'BillTo_First_Name_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Last Name:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="BillTo_Last_Name" VALUE="$form_data{'BillTo_Last_Name'}" SIZE="30" MAXLENGTH="30">
        <font color="#FF0000">$form_data{'BillTo_Last_Name_error'}</font></font></TD>
      </TR>
      <TR>
      <TD colspan="2" bgcolor="$highlightcolor"><font color="$highlightfontcolor" face="Arial"><b>&nbsp;Billing
        Address:</b></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Street:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="BillTo_Street_Line1" SIZE="30" value="$form_data{'BillTo_Street_Line1'}">
        <font color="#FF0000">$form_data{'BillTo_Street_Line1_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">City:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="BillTo_City" SIZE="30" value="$form_data{'BillTo_City'}">
        <font color="#FF0000">$form_data{'BillTo_City_error'}</font>
        </font>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">State/Province/Region:</font></TD>
      <TD>
      <font face="Arial" size="2">
      <INPUT TYPE="text" NAME="BillTo_State" SIZE="4" MAXLENGTH="11" value="$form_data{'BillTo_State'}">
      <font color="#FF0000">$form_data{'BillTo_State_error'}</font>
      </font>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">ZIP/Postal Code:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="BillTo_Zip" SIZE="11" MAXLENGTH="11" value="$form_data{'BillTo_Zip'}">
        <font color="#FF0000">$form_data{'BillTo_Zip_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Country:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="BillTo_Country" SIZE="11" MAXLENGTH="11" value="$form_data{'BillTo_Country'}">
        <font color="#FF0000">$form_data{'BillTo_Country_error'}</font></font></TD>
      </TR>
      <TR>
      <TD COLSPAN="2">&nbsp;</TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <blockquote>
          <p><font size="2" face="Arial">If you would like to have your order shipped
          to an address other then the billing address then please fill out this
          section.</font></p>
        </blockquote>
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2" bgcolor="$highlightcolor"><font color="$highlightfontcolor" face="Arial"><b>&nbsp;Shipping
        Name:</b></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">First Name:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="ShipTo_First_Name" SIZE="30" MAXLENGTH="30" value="$form_data{'ShipTo_First_Name'}">
        <font color="#FF0000">$form_data{'ShipTo_First_Name_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Last Name:&nbsp;</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="ShipTo_Last_Name" SIZE="30" MAXLENGTH="30" value="$form_data{'ShipTo_Last_Name'}">
        <font color="#FF0000">$form_data{'ShipTo_Last_Name_error'}</font></font></TD>
      </TR>
      <TR>
      <TD colspan="2" bgcolor="$highlightcolor"><font color="$highlightfontcolor" face="Arial"><b>&nbsp;Shipping
        Address:</b></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Street:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="ShipTo_Street_Line1" SIZE="30" value="$form_data{'ShipTo_Street_Line1'}">
        <font color="#FF0000">$form_data{'ShipTo_Street_Line1_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">City:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="ShipTo_City" SIZE="30" value="$form_data{'ShipTo_City'}">
        <font color="#FF0000">$form_data{'ShipTo_City_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">State/Province/Region:</font></TD>
      <TD>
      <font face="Arial" size="2">
      <INPUT TYPE="text" NAME="ShipTo_State" SIZE="4" MAXLENGTH="11" value="$form_data{'ShipTo_State'}">
      <font color="#FF0000">$form_data{'ShipTo_State_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">ZIP/Postal Code:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="ShipTo_Zip" SIZE="11" MAXLENGTH="11" value="$form_data{'ShipTo_Zip'}">
        <font color="#FF0000">$form_data{'ShipTo_Zip_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Country:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="ShipTo_Country" SIZE="11" MAXLENGTH="11" value="$form_data{'ShipTo_Country'}">
        <font color="#FF0000">$form_data{'ShipTo_Country_error'}</font></font></TD>
      </TR>
      <TR>
      <TD COLSPAN="2">&nbsp;</TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <blockquote>
          <p><font size="-1" face="Arial">Enter your contact information here so that
          if we need to contact you regarding your order. All contact information
          supplied is for company use only, and will not be given or sold to other
          companies.</font></p>
        </blockquote>
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2" bgcolor="$highlightcolor"><font face="Arial">&nbsp;<font color="$highlightfontcolor"><b>Contact
        Information:</b></font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Phone:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="Phone_Number" SIZE="15" MAXLENGTH="15" value="$form_data{'Phone_Number'}">
        <font color="#FF0000">$form_data{'Phone_Number_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Fax:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="Ecom_BillTo_Telecom_Fax_Number" SIZE="15" MAXLENGTH="15" value="$form_data{'Ecom_BillTo_Telecom_Fax_Number'}">
        <font color="#FF0000">$form_data{'Ecom_BillTo_Telecom_Fax_Number_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">E-Mail:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="Email_Address" MAXLENGTH="30" size="20" value="$form_data{'Email_Address'}">
        <font color="#FF0000">$form_data{'Email_Address_error'}</font></font></TD>
      </TR>
      <TR>
      <TD align="right"></TD>
      <TD><font size="2" face="Arial"><input type="checkbox" $form_data{'mailinglist'} value="CHECKED" name="mailinglist">Check
        here to be added to our mailing list.</font></TD>
      </TR>
      <TR>
      <TD COLSPAN="2">&nbsp;</TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <blockquote>
          <p><font face="Arial" size="2">Please select the method that you would like
          used for shipping your order.</font></p>
        </blockquote>
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2" bgcolor="$highlightcolor">
        <b><font face="Arial" color="$highlightfontcolor">&nbsp;Shipping Method:</font></b>
      </TD>
      </TR>
      </CENTER>
      <TR>
      <TD>
        <p align="right"><font face="Arial" size="2">Shipping:</font>
      </TD>
      <CENTER>
      <TD>
        <font face="Arial" size="2"><select name="upgradeShipping" size="1">
         $shipping_html
        </select> <font color="#FF0000">$form_data{'upgradeShipping_error'}</font></font>
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
      &nbsp;
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2">
        <blockquote>
          <p><font face="Arial" size="-1">Be careful to enter all credit card
          information correctly to avoid any delays in the shipping of your order.</font></p>
        </blockquote>
      </TD>
      </TR>
      <TR>
      <TD COLSPAN="2" bgcolor="$highlightcolor"><font face="Arial"><font color="black">&nbsp;</font><b><font color="$highlightfontcolor">Credit
        Card Information:</font></b></font></TD>
      </TR>
      </CENTER>
      <TR>
      <TD align="right">
      <p><font face="Arial" size="2">Card:</font></p>
      </TD>
      <CENTER>
      <TD>
      <select size="1" name="Payment_Card_Type">
        <option>$form_data{'Payment_Card_Type'}</option>
      $cards_accepted
      </select>
      <font color="#FF0000" size="2" face="Arial">$form_data{'Payment_Card_Type_error'}</font>
      </TD>
      </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Number:</font></TD>
      <TD><font face="Arial" size="2"><INPUT TYPE="text" NAME="Payment_Card_Number" MAXLENGTH="20" size="20" value="$form_data{'Payment_Card_Number'}">
        <font color="#FF0000">$form_data{'Payment_Card_Number_error'}</font></font></TD>
       </TR>
      <TR>
      <TD align="right"><font face="Arial" size="2">Exp. Date:</font></TD>
      <TD>
      <font face="Arial" size="2">
      <SELECT NAME="Payment_Card_Exp_Month" size="1">
      <OPTION>$form_data{'Payment_Card_Exp_Month'}</OPTION>
      <OPTION>1</OPTION>
      <OPTION>2</OPTION>
      <OPTION>3</OPTION>
      <OPTION>4</OPTION>
      <OPTION>5</OPTION>
      <OPTION>6</OPTION>
      <OPTION>7</OPTION>
      <OPTION>8</OPTION>
      <OPTION>9</OPTION>
      <OPTION>10</OPTION>
      <OPTION>11</OPTION>
      <OPTION>12</OPTION>
      </SELECT>/

      <SELECT NAME="Payment_Card_Exp_Year" size="1">
      <OPTION>$form_data{'Payment_Card_Exp_Year'}</OPTION>
      $cc_years
      </SELECT><font color="#FF0000">$form_data{'Payment_Card_Exp_Month_error'}
      $form_data{'Payment_Card_Exp_Year_error'}</font>
      </font>
      </TD>
      </TR>
      <TR>
      <TD colspan="2">&nbsp;</TD>
      </TR>
      <TR>
      <TD colspan="2">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      </CENTER>
      <TR>
      <TD align="right" colspan="2">
        <blockquote>
          <p align="left"><font face="Arial" size="2">If you have any comments or
          special instructions that you would like to send to us then please fill in
          that information here.</font></p>
        </blockquote>
      </TD>
      </TR>
      <TR>
      <TD colspan="2" bgcolor="$highlightcolor"><b><font color="$highlightfontcolor"><font face="Arial">&nbsp;</font><font face="Arial" size="+0">Special
        Instructions / </font><font color="$highlightfontcolor" face="Arial">Comments:</font></font></b></TD>
      </TR>
      <TR>
      <TD colspan="2">
        <p align="center"><font face="Arial"><textarea style="FONT-SIZE: 10pt" name="comments" rows="3" cols="43">$form_data{'comments'}</textarea></font></TD>
      </TR>
      <TR>
      <TD colspan="2">
      </TD>
      </TR>
      <TR>
      <TD colspan="2">
        <hr noshade size="1" color="#000000">
      </TD>
      </TR>
      </TABLE>
      <CENTER>
      <P>
      <P>
      &nbsp;
      <TABLE WIDTH=400>
      <TR>
      <TD WIDTH=400>
      <FONT face=ARIAL SIZE=2>
      Only one more step! Please click the <strong>Verify Order</strong>
      button below. This will give you the chance to examine your order one last time
      before you actually submit it to be processed.
      </FONT>
      </TD>
      </TR>
      </TABLE>
      <P>
      <font face="Arial">
      <INPUT TYPE=submit NAME = "submit_order_form_button"  VALUE = " Verify Order ">
      <BR>
      </font>
      </CENTER>
      </FORM>
   ~;
}

############################################################
# subroutine: process_order_form
############################################################

sub process_order_form {
   local($subtotal, $total_quantity,$total_measured_quantity,$required_fields_filled_in);
   print qq~
      <HTML>
      <HEAD>
      <TITLE>Step Two</TITLE>
      <style>
      	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
      </style>
      </HEAD>
      $body_tag
   ~;

   ($subtotal,$total_quantity,$total_measured_quantity) = &display_cart_table("verify");

   $required_fields_filled_in = "yes";

   foreach $required_field (@sc_order_form_required_fields)
   {
      if ($form_data{$required_field} eq "")
      {
         $required_fields_filled_in = "no";
#         $error_message .= qq~         ~;
         $field = $required_field . "_error";
         $form_data{$field} = "You forgot $sc_order_form_array{$required_field}";
      }
   }

   if ($required_fields_filled_in eq "yes") {
      &printSubmitPage;
   } else {
      &OrderForm;
   }

   &SecureStoreFooter;

   print qq~
      </BODY>
      </HTML>
   ~;

}

###############################################################################

sub printSubmitPage
{
local($invoice_number, $customer_number);

$invoice_number = time;
$customer_number = $cart_id;
$customer_number =~ s/_/./g;
$COMMENTS = $form_data{'comments'};
$COMMENTS =~ s/\'/\\\'/g;

if (! $form_data{'ShipTo_First_Name'})
{
   $form_data{'ShipTo_First_Name'} = $form_data{'BillTo_First_Name'};
}
if (! $form_data{'ShipTo_Last_Name'})
{
   $form_data{'ShipTo_Last_Name'} = $form_data{'BillTo_Last_Name'};
}
if (! $form_data{'ShipTo_Street_Line1'})
{
   $form_data{'ShipTo_Street_Line1'} = $form_data{'BillTo_Street_Line1'};
}
if (! $form_data{'ShipTo_City'})
{
   $form_data{'ShipTo_City'} = $form_data{'BillTo_City'};
}
if (! $form_data{'ShipTo_State'})
{
   $form_data{'ShipTo_State'} = $form_data{'BillTo_State'};
}
if (! $form_data{'ShipTo_Zip'})
{
   $form_data{'ShipTo_Zip'} = $form_data{'BillTo_Zip'};
}
if (! $form_data{'ShipTo_Country'})
{
   $form_data{'ShipTo_Country'} = $form_data{'BillTo_Country'};
}

print qq~
</FORM>
<FORM METHOD=POST ACTION=\"$secure_order_script_url\">
<INPUT TYPE=HIDDEN NAME=\"x_cart_id\" VALUE=\"$cart_id\">
<INPUT TYPE=HIDDEN NAME=\"x_Freight\" VALUE=\"$final_shipping\">
<INPUT TYPE=HIDDEN NAME=\"x_Tax\" VALUE=\"$final_sales_tax\">
<INPUT TYPE=HIDDEN NAME=\"x_Discount\" VALUE=\"$final_discount\">
<INPUT TYPE=HIDDEN NAME=\"x_amount\" VALUE=\"$authPrice\">
~;

if ($authNetTestModeOn eq "yes")
{
   print qq~
      <INPUT TYPE=HIDDEN NAME=x_Test_Request VALUE=\"TRUE\">
   ~;
}

$sequence = int(rand 1000);
require "./admin/SimHMAC.pl";
$fp = &hmac_hex($sc_gateway_username ."^".$sequence."^".$invoice_number."^".$authPrice."^",$txnkey);


print qq~
<INPUT TYPE=HIDDEN NAME=x_Login VALUE=\"$sc_gateway_username\">

<INPUT TYPE="HIDDEN" NAME="x_fp_sequence" VALUE="$sequence">
<INPUT TYPE="HIDDEN" NAME="x_fp_timestamp" VALUE="$invoice_number">
<INPUT TYPE="HIDDEN" NAME="x_fp_hash" VALUE="$fp">

<INPUT TYPE=HIDDEN NAME=x_Version VALUE=\"3.0\">
<INPUT TYPE=HIDDEN NAME=x_ADC_Relay_Response VALUE=\"TRUE\">
<INPUT TYPE=HIDDEN NAME=x_ADC_URL VALUE=\"$sc_order_script_url\">
<INPUT TYPE=HIDDEN NAME=x_Email_Merchant VALUE=\"FALSE\">
<INPUT TYPE=HIDDEN NAME=x_Email_Customer VALUE=\"FALSE\">
<!--Customer/Order Data-->
<INPUT TYPE=HIDDEN NAME=x_Cust_ID VALUE=\"$customer_number\">
<INPUT TYPE=HIDDEN NAME=x_Invoice_Num VALUE=\"$invoice_number\">
<INPUT TYPE=HIDDEN NAME=x_Description VALUE=\"Online Order\">
<!--Billing Address-->
<INPUT TYPE=HIDDEN NAME=x_Fax VALUE=\"$form_data{'Ecom_BillTo_Telecom_Fax_Number'}\">
<INPUT TYPE=HIDDEN NAME=x_First_Name VALUE=\"$form_data{'BillTo_First_Name'}\">
<INPUT TYPE=HIDDEN NAME=x_Last_Name VALUE=\"$form_data{'BillTo_Last_Name'}\">
<INPUT TYPE=HIDDEN NAME=x_Address VALUE=\"$form_data{'BillTo_Street_Line1'}\">
<INPUT TYPE=HIDDEN NAME=x_City VALUE=\"$form_data{'BillTo_City'}\">
<INPUT TYPE=HIDDEN NAME=x_State VALUE=\"$form_data{'BillTo_State'}\">
<INPUT TYPE=HIDDEN NAME=x_Zip VALUE=\"$form_data{'BillTo_Zip'}\">
<INPUT TYPE=HIDDEN NAME=x_Country VALUE=\"$form_data{'BillTo_Country'}\">
<INPUT TYPE=HIDDEN NAME=x_Phone VALUE=\"$form_data{'Phone_Number'}\">
<INPUT TYPE=HIDDEN NAME=x_Email VALUE=\"$form_data{'Email_Address'}\">

<!--Shipping Address-->
<INPUT TYPE=HIDDEN NAME=x_Ship_To_First_Name VALUE=\"$form_data{'ShipTo_First_Name'}\">
<INPUT TYPE=HIDDEN NAME=x_Ship_To_Last_Name VALUE=\"$form_data{'ShipTo_Last_Name'}\">
<INPUT TYPE=HIDDEN NAME=x_Ship_To_Address VALUE=\"$form_data{'ShipTo_Street_Line1'}\">
<INPUT TYPE=HIDDEN NAME=x_Ship_To_City VALUE=\"$form_data{'ShipTo_City'}\">
<INPUT TYPE=HIDDEN NAME=x_Ship_To_State VALUE=\"$form_data{'ShipTo_State'}\">
<INPUT TYPE=HIDDEN NAME=x_Ship_To_Zip VALUE=\"$form_data{'ShipTo_Zip'}\">
<INPUT TYPE=HIDDEN NAME=x_Ship_To_Country VALUE=\"$form_data{'ShipTo_Country'}\">

<!--Billing Data-->
<INPUT TYPE=HIDDEN NAME=x_comments VALUE=\"$COMMENTS\">
<INPUT TYPE=HIDDEN NAME=x_mailinglist VALUE=\"$form_data{'mailinglist'}\">

<INPUT TYPE=HIDDEN NAME=x_hw2ship VALUE=\"$upgradeShipValue[$form_data{'upgradeShipping'}]\">

<INPUT TYPE=HIDDEN NAME=x_Card_Num VALUE=\"$form_data{'Payment_Card_Number'}\">
<INPUT TYPE=HIDDEN NAME=x_Exp_Date VALUE=\"$form_data{'Payment_Card_Exp_Month'}\/$form_data{'Payment_Card_Exp_Year'}\">

<TABLE WIDTH="500" CELLPADDING="2" CELLSPACING="0">

<TR BGCOLOR="#FFFFFF">
<TD>
&nbsp;
</TD>
</TR>

<tr>
<TD>
<FONT FACE="ARIAL" SIZE="2" COLOR="#000000">
Please verify the following information. When you are confident
that it is correct, click the 'Submit Order For Processing' button below
</FONT>
</TD>
</TR>
</TABLE>

<FONT FACE=ARIAL SIZE=-1>
<CENTER>
<TABLE WIDTH=500 BORDER=0>
<TR>
<TD bgcolor="$highlightcolor" COLSPAN=2>
<FONT FACE=ARIAL SIZE=-1 color="$highlightfontcolor">
<B>Customer Information</B>
</FONT>
</TD>
</TR>

<TR>
<TD nowrap>
<FONT FACE=ARIAL SIZE=-1>
Customer Number
</FONT>
</TD>
<TD WIDTH=400>
<FONT FACE=ARIAL SIZE=-1>
$cart_id
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Order Number
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$time
</FONT>
</TD>
</TR>

<TR>
<TD bgcolor="$highlightcolor" COLSPAN=2>
<FONT FACE=ARIAL SIZE=-1 color="$highlightfontcolor">
<B>Billing Address</B>
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Name
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'BillTo_First_Name'} $form_data{'BillTo_Last_Name'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Street
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'BillTo_Street_Line1'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
City
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'BillTo_City'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
State
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'BillTo_State'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Zip
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'BillTo_Zip'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Country
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'BillTo_Country'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Phone
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'Phone_Number'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
E-Mail
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'Email_Address'}
</FONT>
</TD>
</TR>

<!--Shipping Address-->

<TR>
<TD bgcolor="$highlightcolor" COLSPAN=2>
<FONT FACE=ARIAL SIZE=-1 color="$highlightfontcolor">
<B>Shipping Address</B>
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Name
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'ShipTo_First_Name'} $form_data{'ShipTo_Last_Name'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Street
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'ShipTo_Street_Line1'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
City
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'ShipTo_City'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
State
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'ShipTo_State'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Zip
</FONT>
</TD>
<TD WIDTH=350>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'ShipTo_Zip'}
</FONT>
</TD>
</TR>

<TR>
<TD WIDTH=150>
<FONT FACE=ARIAL SIZE=-1>
Country
</FONT>
<TD>
<FONT FACE=ARIAL SIZE=-1>
$form_data{'ShipTo_Country'}
</FONT>
</TD>
</TR>

<TR>
<TD COLSPAN=2>
<CENTER>
<P>
<INPUT TYPE="HIDDEN" NAME="process_order" VALUE="yes">
<INPUT TYPE=SUBMIT VALUE="Submit Order For Processing">
<P>
</CENTER>
</TD>
</TR>
</TABLE>
</FORM>
</CENTER>
</FONT>
~;
}

###############################################################

sub processOrder
{
local($subtotal, $total_quantity,
   $total_measured_quantity,
   $text_of_cart,
   $required_fields_filled_in, $product, $quantity, $options,
   $text_of_confirm_email, $text_of_admin_email, $emailCCnum, $logCCnum);

   $orderDate = &get_date;

# Check to make sure this is coming from Authorize.net

   if ($form_data{'x_response_code'} eq "1")
   {
      ####################################################################
      # Do all the work...
      ####################################################################

      $text_of_confirm_email .= "Thank you for your order. We appreciate your business and will do everything we can to meet your expectations. Please visit us again soon!\n\n";

      # $text_of_confirm_email .= "New Order: $orderDate\n\n";
      $text_of_confirm_email .= "  --PRODUCT INFORMATION--\n\n";

      $dbh = DBI->connect($sc_mysql_dsn, $sc_mysql_user_name, $sc_mysql_password) || die "Couldn't connect to database: " . DBI->errstr;
      my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$form_data{'x_cart_id'}\'";
   	my($sth) = $dbh->prepare($query);
   	$sth->execute || die("Couldn't exec sth!");
   	while(@row = $sth->fetchrow)
   	{
   		$cart_data = $row[2];
      	$cartData++;
      	@cart_fields = split (/\|/, $cart_data);
      	$quantity = $cart_fields[0];
      	$product_price = $cart_fields[3];
      	$product = $cart_fields[4];
      	$options = $cart_fields[7];
      	$options =~ s/<br>/ /g;
      	$text_of_confirm_email .= "Quantity:      $quantity\nProduct:       $product $sc_money_symbol $product_price (each)\n";
      	if ($options)
      	{
      	   $text_of_confirm_email .= "Options:       $options";
      	}
      	$text_of_confirm_email .= "\n\n";
      }
      $sth->finish;

      $text_of_confirm_email .= "\n";
      $text_of_confirm_email .= "INVOICE:       $form_data{'x_invoice_num'}\n";
      $text_of_confirm_email .= "SHIPPING:      $form_data{'x_freight'}\n";
      $text_of_confirm_email .= "DISCOUNT:      $form_data{'x_discount'}\n";
      $text_of_confirm_email .= "SALES TAX:     $form_data{'x_tax'}\n";
      $text_of_confirm_email .= "TOTAL:         $form_data{'x_amount'}\n";

      my($query) = "SELECT * FROM $sc_mysql_cart_table where cart_id = \'$form_data{'x_cart_id'}\'";
   	my($sth) = $dbh->prepare($query);
   	$sth->execute || die("Couldn't exec sth!");
   	while(@row = $sth->fetchrow)  {
   		$cart_data = $row[2];
   	    $cartData++;
   	    @cart_fields = split (/\|/, $cart_data);

   	    $PRICE = $cart_fields[3];
   	    $PRICE =~ tr/:$\@\"\%\&//d;
   	    $PRAFO = $cart_fields[13];
   	    $PRAFO =~ tr/:$\@\"\%\&//d;
   	    $LINE = $cart_fields[14];
   	    $LINE =~ tr/:$\@\"\n\%\&//d;
   	    $EXTAMT = $cart_fields[0] * $PRAFO;
   	    $COMMENTS = $form_data{'x_comments'};
   	    $COMMENTS =~ tr/:$\@\"\n\%\&//d;

   	    $DISCOUNT = $form_data{'x_discount'};
   	    $DISCOUNT =~ tr/:$\@\"\%\&//d;
          $DISCOUNT =~ tr/$sc_money_symbol//;

          $SHIPPING = $form_data{'x_freight'};
          $SHIPPING =~ tr/:$\@\"\%\&//d;
          $SHIPPING =~ tr/$sc_money_symbol//;

          $SALESTAX = $form_data{'x_tax'};
          $SALESTAX =~ tr/:$\@\"\%\&//d;
          $SALESTAX =~ tr/$sc_money_symbol//;

          $GRANDTOTAL = $form_data{'x_amount'};
          $GRANDTOTAL =~ tr/:$\@\"\%\&//d;
          $GRANDTOTAL =~ tr/$sc_money_symbol//;

   	    $SUBTOTAL = $GRANDTOTAL - $DISCOUNT - $SHIPPING - $SALESTAX;
   	    $time = time;

          $cart_fields[2] =~ s/\'/\\\'/g;
          $cart_fields[4] =~ s/\'/\\\'/g;
          $cart_fields[7] =~ s/\'/\\\'/g;
          $cart_fields[12] =~ s/\'/\\\'/g;

          $query = "insert into $sc_mysql_ord_table values (\'\',\'$form_data{'x_invoice_num'}\',\'$form_data{'x_first_name'} $form_data{'x_last_name'}\',\'$form_data{'x_address'}\',\'$form_data{'x_city'}\',\'$form_data{'x_state'}\',\'$form_data{'x_zip'}\',\'$form_data{'x_country'}\',\'$form_data{'x_ship_to_first_name'} $form_data{'x_ship_to_last_name'}\',\'$form_data{'x_ship_to_address'}\',\'$form_data{'x_ship_to_city'}\',\'$form_data{'x_ship_to_state'}\',\'$form_data{'x_ship_to_zip'}\',\'$form_data{'x_ship_to_country'}\',\'$form_data{'x_phone'}\',\'$form_data{'x_fax'}\',\'$form_data{'x_email'}\',\'$form_data{'x_method'}\',\'$form_data{'x_ccname'}\',\'$form_data{'x_card_num'}\',\'$form_data{'x_exp_date'}\',\'$form_data{'x_hw2ship'}\',\'$COMMENTS\',\'$cart_fields[0]\',\'$DISCOUNT\',\'$cart_fields[2]\',\'$PRICE\',\'$cart_fields[4]\',\'$cart_fields[7]\',\'$PRAFO\',\'$LINE\',\'$EXTAMT\',\'$SUBTOTAL\',\'$SHIPPING\',\'$SALESTAX\',\'$GRANDTOTAL\',\'\',\'$ENV{'REMOTE_ADDR'}\',\'$time\')";
          $dbh->do($query);
      }
      $sth->finish;

      if ($form_data{'x_mailinglist'} =~ /CHECKED/i)
      {
          $query = "insert into $sc_mysql_email_table values (\'$form_data{'x_email'}\')";
          $dbh->do($query);
      }


      if (($sc_send_order_to_email =~ /yes/i) && ($cartData))
      {
         &send_mail($sc_order_email, $sc_order_email, "Online Order",$form_data{'x_amount'});
      }

      if ($cartData)
      {
         &send_mail($sc_admin_email, $form_data{'x_email'}, "Thank you for your order!", "$text_of_confirm_email");
      }

      if ($log_common_products eq "yes")
      {
         &product_stats;
      }

      # This empties the cart after the order is successful

      $query = "DELETE from $sc_mysql_cart_table where cart_id =\'$form_data{'x_cart_id'}\'";
      $dbh->do($query);
      $dbh->disconnect;

      print qq~
         <HTML>
         <HEAD>
         <TITLE>Thank you for your order</TITLE>
         <style>
         	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
         </style>
         </HEAD>
         $body_tag
      ~;

      &SecureStoreHeader;

      print qq~
         <CENTER>
         <TABLE WIDTH=500>
         <TR>
         <TD WIDTH=500>
         <FONT FACE=ARIAL>
         <P>&nbsp;</P>
         Thank you for shopping with us. Your order has been received and will be
         shipped as soon as possible. Please visit us again soon!<br>
         <P>&nbsp;</P>
         </FONT>
         </TD>
         </TR>
         </TABLE>
         <CENTER>
      ~;

      &SecureStoreFooter;

      print qq~
         </BODY>
         </HTML>
      ~;

   } else {
         print qq~
            <HTML>
            <HEAD>
            <TITLE>Error Processing Order</TITLE>
            <style>
            	.boxborder {BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid}
            </style>
            </HEAD>
            $body_tag
         ~;

         &SecureStoreHeader;

         print "<p>$form_data{'x_response_code'}) $form_data{'x_response_reason_text'}</p>\n";

   	   if ($form_data{'x_response_code'} eq "2"){
   	       $message = "There was a problem with your order<BR><BR>";
   	       $message .= "$form_data{'x_response_reason_text'}";
         } else {
            $message = "<p>There was an internal error while processing your order!</p><p>Please use your browser back button and retry your order</p>";
         }
         print "$message";
         &SecureStoreFooter;
   }

   if ($authNetTestModeOn eq "yes")
   {
      print "<p align=left>";
   	foreach $tag ( sort ( keys %form_data ) )
   	{
   	   if (! ($form_data{ $tag } eq ""))
   	   {
   		   print "\$form_data{\'$tag\'} = " . $form_data{ $tag }. "<br>\n";
   	   }
   	}
   }

}

1;