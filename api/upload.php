<?php

    if($_REQUEST['action']=='upload'){
    	$files = $_FILES['files'];
    	$j=0;
    	for($i=0;$i<count($files['tmp_name']);$i++){
    		$Suffix = explode('.',$files['name'][$i]);
    		$front = $Suffix[count($Suffix)-2];
    		$houzui = $Suffix[count($Suffix)-1];
    		$filename = 'photo/'.$front.'_'.time().'_'.$j++.'.'.$houzui;
    		$succeedStr = '';
    		if(move_uploaded_file($files['tmp_name'][$i], $filename)){
    		    $succeedStr =  ":文件上传成功:".$filename;
    		}else{
    		    $succeedStr =  ":文件上传失败:".$filename;
    		}
    		$succeedTime = date('Y-m-d',$_SERVER['REQUEST_TIME']);
    		file_put_contents(dirname( __FILE__ ).'/upload_log.log',$succeedTime.$succeedStr."\n", FILE_APPEND);
    	}
    	echo count($files['tmp_name']);
        // 	echo json_encode($files);
    }elseif($_REQUEST['action']=='getTableData'){
        $tableData = array();
        //打开当前目录下的目录pic下的子目录common。
        $handler = opendir('photo/');
        //2、循环的读取目录下的所有文件
        //其中$filename = readdir($handler)是每次循环的时候将读取的文件名赋值给$filename，为了不陷于死循环，所以还要让$filename !== false。一定要用!==，因为如果某个文件名如果叫’0′，或者某些被系统认为是代表false，用!=就会停止循环*/
        while( ($filename = readdir($handler)) !== false ) {
              //3、目录下都会有两个文件，名字为’.'和‘..’，不要对他们进行操作
              if($filename != "." && $filename != ".."){
                  //4、进行处理
                  //这里简单的用echo来输出文件名
                  //echo $filename.'<br>';
                  array_unshift($tableData, $filename);
              }
        }
        //5、关闭目录
        closedir($handler);
        echo json_encode($tableData);
    }elseif($_REQUEST['action']=='base64'){
        //接收base64数据
        $image= $_POST['base'];
        //设置图片名称
        $imageName = date("Ymd_His",time())."_".rand(1111,9999).'.png';
        //判断是否有逗号 如果有就截取后半部分
        if (strstr($image,",")){
            $image = explode(',',$image);
            $image = $image[1];
        }
        //设置图片保存路径
        $path = "/photo";
        //图片路径
        $imageSrc= $path."/". $imageName;
        //生成文件夹和图片
        $r = file_put_contents($imageSrc, base64_decode($image));
        if (!$r) {
            return json(['code'=>0,'message'=>'图片生成失败']);
        }else {
            return json(['code'=>1,'message'=>'图片生成成功']);
        }
    }else{
        
        return json(['code'=>0,'message'=>'没有找到接口'.__FILE__]);
    }

?>
