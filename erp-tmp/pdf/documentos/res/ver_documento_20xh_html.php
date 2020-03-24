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
<page backtop="10mm" backbottom="10mm" backleft="5mm" backright="5mm" style="font-size: 10pt; font-family: arial" >
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
		
			//$sql="select record_card_user, record_card_pasw from record_cards WHERE record_card_user_id=13 and record_card_num_hora=1 order by record_card_user";
			$sql="select record_card_user, record_card_pasw from record_cards WHERE record_card_user_id='$id_user' and record_card_num_hora='$nTypeHra' order by record_card_user";
			$sql=mysqli_query($con, $sql);
		
			$nin=1;
			$va1 = "<tr>";
		
			//"<hr border='1%' size='0'>" . 
			//$nTypeHra=3;
			$nTypeHra=str_pad($nTypeHra, 2, "0", STR_PAD_LEFT);
		
			//$nPrecFicha=10;
			//if($nPrecFicha>0) {
			if($nPrintP==1) {
				$c1Spaces="";
				//$c2Spaces="";
				$nTypeHra .= '&nbsp;';
				$c2Spaces=number_format( $nPrecFicha,2,'.','');
			} else {
				$c1Spaces="&nbsp;&nbsp;&nbsp;&nbsp;";
				$c2Spaces="&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		
			while ($row=mysqli_fetch_array($sql)) {
				
				if ($nin <= 5) {
					$va1 .= "<td style='width: 42%;'> <img style='width: 100%; align: middle;' src='../../img/logo.jpg' ><b><u><br>$c1Spaces" . $nTypeHra . " Hrs Prepago $ $c2Spaces</u></b><br><br>" . 
					"<u style='font-size: 12pt; font-family: arial' >Usuario:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u style='font-size: 12pt; font-family: arial'>" . $row['record_card_user'] . "</u><br>" . 
					"<u style='font-size: 12pt; font-family: arial' >Contraseña:</u>&nbsp;&nbsp;&nbsp;&nbsp; <u style='font-size: 12pt; font-family: arial'>" . $row['record_card_pasw'] . "</u><br><br>" . 
					"<u style='font-size: 07pt; font-family: arial'>Contratación: 287 596 3304 / 287 100 3091</u>" . 
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
