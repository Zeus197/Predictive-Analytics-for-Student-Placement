<?php
$N = 44;
echo "check";
exec("Rscript r_script_.R $N ",$output,$return_var);
echo "output:".$output[0];
echo "return_var".$return_var;
	  
?>	


