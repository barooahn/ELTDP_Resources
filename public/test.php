<?php 
//first copy the file to the magic place where we can convert it to a pdf on the fly
copy('test.docx', "LibreOffice2/cde-package/cde-root/home/robert/Desktop/".'test.docx');
//change to that directory
chdir('/');
//the magic command that does the conversion
$myCommand = "./libreoffice.cde --headless -convert-to pdf Desktop/".'test.docx'." -outdir Desktop/";
exec ($myCommand);
//copy the file back

//changing the header to the location of the file makes it work well on androids
header( 'Location: '.str_replace(".doc", ".pdf", 'test.docx') );
?>
?>