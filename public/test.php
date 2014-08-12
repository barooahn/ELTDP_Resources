<?php 
//first copy the file to the magic place where we can convert it to a pdf on the fly
copy('test.doc', "LibreOffice2/cde-package/cde-root/home/robert/Desktop/".'test.doc');
//change to that directory
chdir('LibreOffice2/cde-package/cde-root/home/robert');
//the magic command that does the conversion
$myCommand = "./libreoffice.cde --headless -convert-to pdf Desktop/".'test.doc'." -outdir Desktop/";
exec ($myCommand);
//copy the file back

//changing the header to the location of the file makes it work well on androids
header( 'Location: '.str_replace(".doc", ".pdf", 'test.doc') );
?>
?>