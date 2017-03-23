#!/usr/bin/perl
#
print "Content-type: text/html\n\n";
use DBI;
my @drivers = DBI->available_drivers();
foreach my $driver ( @drivers ) {
   if ($driver eq "mysql")
   {
      print "Everything seems OK, your server has the programs needed to run this script";
   }
}
exit;