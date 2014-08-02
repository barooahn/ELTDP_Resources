<?php 

chdir('libreoffice/program');
exec("soffice.exe --headless -convert-to pdf Animal_flashcards_docx.docx");


echo ' Converted';
?>