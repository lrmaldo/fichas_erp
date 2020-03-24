<?php 
	if ($con){
?>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../<?php echo get_row('perfil','logo_url', 'id_perfil', 1);?>" alt="Logo"><br>
                
            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
			
				<?php 
				
				if ($opt_empresaslc==1) {
				?>
			
					<span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo get_row('perfil','nombre_empresa', 'id_perfil', 1);?></span>
					<br><?php echo get_row('perfil','direccion', 'id_perfil', 1).", ". get_row('perfil','ciudad', 'id_perfil', 1)." ".get_row('perfil','estado', 'id_perfil', 1);?><br> 
					Teléfono: <?php echo get_row('perfil','telefono', 'id_perfil', 1);?><br>
					Email: <?php echo get_row('perfil','email', 'id_perfil', 1) . ' Whatssapp 2291738806';?>
				<?php } else {?>
					
					<span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo 'SARAHI YULIANA GARCIA USCANGA';?></span>
					<br><?php echo 'BLVD. MANUEL. ÁVILA CAMACHO 523, COL. MARIA LUISA, CP 68310' . ', ' . 'TUXTEPEC' . ' ' . 'OAXACA, RFC: GAUS8901091T2';?><br>
					Teléfono: <?php echo '2878756019';?><br>
					Email: <?php echo get_row('perfil','email', 'id_perfil', 1) . ' Whatssapp 2291738806' . ":" . $opt_empresaslc ;?>
				
				<?php }?>
            
			</td>
			<td style="width: 25%;text-align:right">
			<?php echo $Titulo_doc;?>
			</td>
			
        </tr>
    </table>
	<?php }?>
	