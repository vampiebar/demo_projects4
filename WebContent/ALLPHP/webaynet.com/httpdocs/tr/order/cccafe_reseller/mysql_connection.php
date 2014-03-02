<?php 
class bf_vt {
		function bf_vt($bfvt_sqlhost,$bfvt_sqluser,$bfvt_sqlpass,$bfvt_sqlvt){
			$this->bfvt_sqlhost = $bfvt_sqlhost;
			$this->bfvt_sqluser = $bfvt_sqluser;
			$this->bfvt_sqlpass = $bfvt_sqlpass;
			$this->bfvt_sqlvt = $bfvt_sqlvt;
			$this->bfvt_sql_baglanti = mysql_connect($this->bfvt_sqlhost, $this->bfvt_sqluser, $this->bfvt_sqlpass) or die (mysql_error());
			if($this->bfvt_sql_baglanti){
				$this->bfvt_sql_vtbaglanti = mysql_select_db($this->bfvt_sqlvt,$this->bfvt_sql_baglanti) or die (mysql_error());		
				$mysqlv = explode( '.', mysql_get_server_info($this->bfvt_sql_baglanti) );
				$mysqlv = (int) sprintf( '%d%02d%02d', $mysqlv[0], $mysqlv[1], intval( $mysqlv[2] ) );
				if ( $mysqlv  >= 40100 )
				{
					mysql_query("SET CHARACTER SET latin5");
					mysql_query("SET collation_connection = 'latin5_turkish_ci'");
				}
			}
			return $this->bfvt_sql_baglanti;		
		}
		
		function bf_vt_sqlsorgu($bfvt_query){
			unset($this->bfvt_query_sonuc);
			$this->bfvt_query = $bfvt_query;
			$this->bfvt_query_sonuc = mysql_query($this->bfvt_query,$this->bfvt_sql_baglanti);
			return $this->bfvt_query_sonuc;
		}
		
		function bf_vt_numrows(){
			unset($this->bfvt_nr_sonuc);
			$this->bfvt_nr = $this->bfvt_query_sonuc;
			$this->bfvt_nr_sonuc = @mysql_num_rows($this->bfvt_nr);
			return $this->bfvt_nr_sonuc;
		}
		
		function bf_vt_fetcharray($bfvt_islem){
			$this->bfvt_cikti_fa = mysql_fetch_array($bfvt_islem);
			return $this->bfvt_cikti_fa;
		}

		function bf_vt_sqldongu(){
			unset($this->bfvt_cikti_matris);
			$i = 0;

			$dizi = $this->bf_vt_fetcharray($this->bfvt_query_sonuc);

			$k=0;
			$fe = array();
			for($asd = 0;$asd<mysql_num_fields($this->bfvt_query_sonuc);$asd++){
				$fe[$k] = mysql_field_name($this->bfvt_query_sonuc,$asd);
				$fe[$k+1] = $asd;
				$k += 2;
			}
			
						
			while ($i<$this->bfvt_nr_sonuc){
				for ($j=0;$j<count($fe)/2;$j++){
					$this->bfvt_cikti_matris[$i][$fe[2*$j]] = mysql_result($this->bfvt_query_sonuc,$i,$fe[($j*2)+1]);
					$this->bfvt_cikti_matris[$i][$j] = mysql_result($this->bfvt_query_sonuc,$i,$fe[($j*2)+1]);
					$this->bfvt_cikti_matris[$i][$fe[($j*2)+1]] = mysql_result($this->bfvt_query_sonuc,$i,$fe[($j*2)+1]);
				}
				
				$i++;
			}
			if (isset($this->bfvt_cikti_matris)){
				return $this->bfvt_cikti_matris;
			}
		}
		
		function bf_vt_sqldongulimit($a,$b){
			unset($this->bfvt_cikti_matris);
			$limit = $a+$b;
			$i = 0;
			$i2 = 0;
			$k = 0;
			foreach($this->bf_vt_fetcharray($this->bfvt_query_sonuc) as $anhtr => $b){
				$fe[$k] = $anhtr;
				$k++;
			}
			while ($i<$this->bfvt_nr_sonuc){
				if($i>=$a){
					if($i<$limit){
						for ($j=0;$j<count($fe)/2;$j++){
							$this->bfvt_cikti_matris[$i2][$j] = mysql_result($this->bfvt_query_sonuc,$i,$fe[2*$j]);
							$this->bfvt_cikti_matris[$i2][$fe[2*$j+1]] = mysql_result($this->bfvt_query_sonuc,$i,$fe[2*$j]);
						}
						$i2++;
					}
									
				}
				$i++;
			}
			if (isset($this->bfvt_cikti_matris)){
				return $this->bfvt_cikti_matris;
			}
		}
				
		function bf_vt_sqloptimize(){
			return false;
		}
		
		function bf_vt_bkapat(){
			mysql_close();
		}
	}
	
?>