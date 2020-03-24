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
		
			$sql="select record_card_user from record_cards where record_card_user_id=1 order by record_card_user";
			$sql=mysqli_query($con, $sql);
		
			$result = array();
			while ($row=mysqli_fetch_array($sql)) {
				$result[] = $row['record_card_user'];
				/*
				echo "<tr>";
				echo "<td>cell1_1 este es el primer:" . $result[$x]. "<br>Sigo ok<br>Otra linea</td>";
				echo "<td>cell1_2 este es el primer:" . $result[$x]. "<br>Sigo ok<br>Otra linea</td>";
				echo "<td>cell1_3 este es el primer:" . $result[$x]. "<br>Sigo ok<br>Otra linea</td>";
				echo "<td>cell1_4 este es el primer:" . $result[$x]. "<br>Sigo ok<br>Otra linea</td>";
				echo "</tr>";
				*/
			}
		
			$arrlength = count($result);
			//for($x = 0; $x < $arrlength; $x++) {
			
		for($blok = 1; $blok <= 4; $blok++) {
		
			$va1 = "<tr>";
			for($x = 0; $x < $arrlength; $x++) {
				
				$va1 .= "<td>cell1_1 :" . $result[$x]. "<br>Sigo ok<br>Otra linea</td>";

			}
			$va1 .= "</tr>";
			echo $va1;
			
			$va1 = "";
			
		}

		?>
		
		</tbody>
	</table>
	
</page>
