<?php
class ViewUsers extends User
{
  public function ShowAllUsers()
  {
    $datas=$this->getAllUsers();
    foreach($datas as $data)
    {
        echo "The ID is: " . $data['ID'] . "<br>";
        echo "The File format is: " . $data['File_Format'];
    }
  }
}
?>