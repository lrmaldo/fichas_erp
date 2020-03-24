<style type="text/css">
<!--
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #FFFFFF;
  width: 60%;
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
  background: #FFFFFF;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #FFFFFF;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
	
.customHr {
    width: 95%
    font-size: 1px;
    color: rgba(0, 0, 0, 0);
    line-height: 1px;

    background-color: grey;
    margin-top: -6px;
    margin-bottom: 10px;
}
	
-->
</style>
<page backtop="10mm" backbottom="8mm" backleft="5mm" backright="5mm" style="font-size: 10pt; font-family: arial" >
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
		
			//$sql="select record_card_user, record_card_pasw from record_cards where record_card_user_id='$id_user' and record_card_num_hora='$nTypeHra' order by record_card_user";
			$sql="select record_card_user, record_card_pasw from record_cards where record_card_user_id='$id_user' and record_card_num_hora='$nTypeHra' order by record_card_user";
			$sql=mysqli_query($con, $sql);
		
			$nin=1;
			$va1 = "<tr>";
		
			//"<hr border='1%' size='0'>" . 
			//$nTypeHra=3;
			$nTypeHra=str_pad($nTypeHra, 2, "0", STR_PAD_LEFT) . " Hrs";
		
			//$nPrecFicha=0;
			//if($nPrecFicha>0) {
			if($nPrintP==1) {
				$cSpaces="";
				$nTypeHra .= '&nbsp;'. number_format( $nPrecFicha,2,'.','');
			} else {
				$cSpaces="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		
			while ($row=mysqli_fetch_array($sql)) {
				
				if ($nin <= 5) {
					$va1 .= "<td style='width: 38%;'> <img style='width: 45%;' src='../../img/logo.jpg' > $cSpaces <small><u>" . $nTypeHra . "</u></small>" . 
					"<u style='font-size: 10pt; font-family: arial' >Usuario:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u style='font-size: 10pt; font-family: arial'>" . $row['record_card_user'] . "</u><br>" . 
					"<u style='font-size: 10pt; font-family: arial' >Contraseña:</u>&nbsp;&nbsp;&nbsp;&nbsp; <u style='font-size: 10pt; font-family: arial'>" . $row['record_card_pasw'] . "</u>" . 
					"</td> ";
				}
				
				$nin++;
				
				if ($nin == 5) {
					$va1 .= "</tr>";
					echo $va1;
					$nin=1;
					$va1 = "<tr>";
				}
			}
		
			$va1 .= "</tr>";
			echo $va1;
	
		?>
		
		</tbody>
	</table>
	
</page>
