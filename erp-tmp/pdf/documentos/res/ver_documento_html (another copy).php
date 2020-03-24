<style type="text/css">
<!--
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 101%;
  height: 583%;
  text-align: left;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 10px 5px;
}
table.blueTable tbody td {
  font-size: 15px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
	
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm" style="font-size: 12pt; font-family: arial" >
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    <?php echo get_row('perfil','email', 'id_perfil', 1); ?>
                </td>
            </tr>
        </table>
    </page_footer>
  
	<?php 
		//$i=1;
	?>
	
    <table class="blueTable">
	<tbody>
		<?php 
		
			$sql="select record_card_user from record_cards where record_card_user_id=3 order by record_card_user";
			$sql=mysqli_query($con, $sql);
		
			//$result = array();
			$nin=1;
			$va1 = "<tr>";
			while ($row=mysqli_fetch_array($sql)) {
				//$result[] = $row['record_card_user'];
				
				if ($nin <= 5) {
					$va1 .= "<td>cell1_:" . $row['record_card_user']. "<br>Sigo ok<br>Otra linea</td>";
				}
				
				$nin++;
				
				if ($nin == 5) {
						$va1 .= "</tr>";
						echo $va1;
						$nin=0;
						$va1 = "<tr>";
				}
				
			}
		
			$va1 .= "</tr>";
						echo $va1;
		
			/*
			$arrlength = count($result);
			$nin=1;
			$va1 = "<tr>";
			for($x = 0; $x < $arrlength; $x++) {
					if ($nin < 5) {
						$va1 .= "<td>cell1_:" . $result[$x]. "<br>Sigo ok<br>Otra linea</td>";
					}
					if ($nin == 5) {
						$va1 .= "</tr>";
						echo $va1;
						$nin=0;
						$va1 = "<tr>";
					}
					
					$nin++;
			}
			*/

		?>
		
		</tbody>
	</table>
	
</page>
