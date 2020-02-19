#!/usr/bin/perl
#

use CGI;
use CGI::Carp qw/fatalsToBrowser/;

print "Content-type: text/html\n\n";
use DBI;
my @drivers = DBI->available_drivers();
foreach my $driver ( @drivers ) {
   if ($driver eq "mysql")
   {
      print "<p>Everything seems OK, your server has the programs needed to run this script</p>";
   }
}

$temp = $ENV{'PATH'};
$ENV{'PATH'} = "/bin:/usr/bin";
$the_id = `id`;
$whoami = `whoami`;
$ENV{'PATH'} = $temp;

print qq~
   Scripts are running under id: $the_id<br>
   Unix 'whoami' responds with: $whoami<br>
~;
exit;