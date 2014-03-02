<?php 
$port = $_GET["port"];
?>
<form>
            <fieldset data-role="controlgroup">
            	<?php 
            	$array=array("NoSetTaskbar","NoPropertiesMyComputer","NoFolderOptions","NoControlPanel","DisableTaskMgr","NoRun","NoClose","StartMenuLogOff","NoViewOnDrive");
                for($j=0;$j<count($array);$j++){
                $url[$j]='http://register.workviewer.com/ICAOsCtrlWSBifrost/jaxrs/bf/getdata?host=localhost&port='.$port.'&showerrorinxml=yes&link=proc_list?get_windows_limit=zzz'.$array[$j].'';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url[$j]);
                $data = curl_exec($ch);
                curl_close($ch);
                $xml[$j] = simplexml_load_string($data);
                if($array[$j]=="NoSetTaskbar"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2a" id="checkbox-v-2a" value="NoSetTaskbar" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2a">Taskbar'ın özelliklerini değiştirmeyi engelle</label>
                <?php 
				}
				if($array[$j]=="DisableTaskMgr"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2c" id="checkbox-v-2c" value="DisableTaskMgr" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2c">Görev Yöneticisi'ne erişimi engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="NoFolderOptions"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2b" id="checkbox-v-2b" value="NoFolderOptions" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2b">Klasör özelliklerine erişimi engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="NoClose"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2d" id="checkbox-v-2d" value="NoClose" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2d">Bilgisayarı Kapat-Yeniden Başlat-Uyku Moduna Al Komutlarını engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="NoViewOnDrive"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2e" id="checkbox-v-2e" value="NoViewOnDrive" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2e">Sürücüleri engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="NoPropertiesMyComputer"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2f" id="checkbox-v-2f" value="NoPropertiesMyComputer" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2f">Bilgisayarım özelliklerine girmeyi engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="NoControlPanel"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2g" id="checkbox-v-2g" value="NoControlPanel" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2g">Denetim Masası'na erişimi engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="NoRun"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2h" id="checkbox-v-2h" value="NoRun" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2h">Çalıştır Komutunu engelle</label>
                <?php 
				}
				?>
                <?php 
				if($array[$j]=="StartMenuLogOff"){
				?>
                <input type="checkbox" class="winrest" name="checkbox-v-2i" id="checkbox-v-2i" value="StartMenuLogOff" <?php if(substr(trim($xml[$j]->value),-1)==1){echo "checked";}  ?>>
                <label class="test" for="checkbox-v-2i">Oturumu Kapat komutunu engelle</label>
                <?php 
				}
				?>
				<?php
				}
				?>
               <!--
                -->
            </fieldset>
		</form>