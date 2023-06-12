<?php
  $targetFolder = '/home/ikwopr5xim0u/public_html/storage/app/public';
$linkFolder = '/home/ikwopr5xim0u/public_html/public/storage';
symlink($targetFolder, $linkFolder);
echo 'Symlink process successfully completed'; 
?>