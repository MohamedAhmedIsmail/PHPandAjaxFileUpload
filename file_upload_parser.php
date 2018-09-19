<?php
include_once("dbconfig/database.php");
include_once("dbconfig/user.php");
include_once("dbconfig/viewuser.php");
class FileUpload
{
    private $fileName;
    private $fileTmpLoc;
    private $fileType;
    private $fileSize;
    private $fileErrorMsg;
    protected function upload()
    {
        $this->fileName=$_FILES["file1"]["name"];
        $this->fileTmpLoc=$_FILES["file1"]["tmp_name"];
        $this->fileType=$_FILES["file1"]["type"];
        $this->fileSize=$_FILES["file1"]["size"];
        $this->fileErrorMsg=$_FILES["file1"]["error"];
        $result=array('fileName'=>$this->fileName,'fileTemp'=>$this->fileTmpLoc,'fileType'=>$this->fileType,'fileSize'=>$this->fileSize,'fileErrMsg'=>$this->fileErrorMsg);
        return $result;
    }
}
class FileHandle extends FileUpload
{
    public function handle()
    {
        $validvid_extensions=array('mkv','mp4','flv','3gp');
        $validaudio_extensions=array('mp3','wav','ogg');
        $validimg_extensions=array('jpeg','jpg','png','gif','bmp','pdf','doc','ppt');
        $validtxt_extensions=array('txt','csv','docx','pdf');
        $test=$this->upload();
        $file=$test['fileName'];
        $type=$test['fileType'];
        $ext=strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!$test['fileTemp']) 
        { 
            echo "ERROR: Please browse for a file before clicking the upload button.";
            exit();
        }
        if(move_uploaded_file($test['fileTemp'], "test_uploads/$file"))
        {
            if(in_array($ext,$validvid_extensions))
            {
                ?>
                <div id="theater">
                    <video id="video" style='max-width:500px;max-height:500px;' src="<?php echo "test_uploads/$file" ?>" controls="false"></video>
                    <canvas id="canvas"></canvas>
                </div>
                <?php
            }
            if(in_array($ext,$validimg_extensions))
            {
                echo 
                "<div class='item'>
                    <img style='max-width:400px;max-height:400px;' class='myimg img-responsive' src='test_uploads/$file'>
                </div>";
            }
            if(in_array($ext,$validtxt_extensions))
            {
                ?>
                <div>
                    <p><?php echo file_get_contents("test_uploads/$file");?></p>
                </div>
                <?php
            }
            if(in_array($ext,$validaudio_extensions))
            {
            echo "
                <audio controls>
                <source src='test_uploads/$file' type='$type'/>
                </audio>
                ";
               
            }
          $users=new ConnectDatabase();
          $conn=$users->connect();
          $insert=$conn->query("INSERT user(fileName,fileTmpLoc,fileType,fileSize) VALUES('".$test['fileName']."','".$test['fileTemp']."','".$test['fileType']."','".$test['fileSize']."')");
        }
        else 
        {
            echo "move_uploaded_file function failed";
        }       
    }
}
$upload=new FileHandle();
$upload->handle();
