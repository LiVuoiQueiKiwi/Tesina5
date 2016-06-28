<?php 
include ('dbfunction.php');
function Admincheck ($id) {
			$contr=true;
			$controllo = "
				SELECT * FROM admin WHERE IDutente = $id
			";
			if ($this->conn->query($controllo)->fetchColumn()==0) $contr=false;
			return $contr;
		}
?>