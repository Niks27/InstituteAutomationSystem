<?php
require_once("db6.php");

class crud
{
    public $id;

    public function insert($studentArr)
    {
        $fname = $studentArr['fname'];
        $lname = $studentArr['lname'];
        $address = $studentArr['address'];
        $mobile = $studentArr['mobile'];
        $age = $studentArr['age'];
        $dob = $studentArr['dob'];
        $gender = $studentArr['gender'];
        $std = $studentArr['batch'];
        $fees = $studentArr['fees'];
        $profile = $_FILES["profilepic"]["name"];
        $fileName = NULL;
        $target_dir = "";

        if(isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"]))
        {
            $target_dir = "uploads/";
            $imageFileType = pathinfo($_FILES["profilepic"]["name"], PATHINFO_EXTENSION);
            $allowedExtArr = array('gif', 'png', 'jpg', 'jpeg');

            if(!in_array($imageFileType, $allowedExtArr))
            {
                $errorMsg .= "Please select png, jpg, jpeg, gif Files only";
            }

            if($profile)
            {
                $fileName = "photo_".time().".".$imageFileType;
                $target_dir .= $fileName;
                if(!move_uploaded_file($_FILES["profilepic"]["temp_name"], $target_dir))
                {
                    $errorMsg .= "Error in uploading file";
                }
            }
        }

        $sql = "INSERT INTO `student`(`fname`, `lname`, `gender`, `batch`, `address`, `mobile`, `age`, `dob`, `profilepic`, `fees`) VALUES (:fname, :lname, :gender, :batch, :address, :mobile, :age, :dob, :profile, :fees)";
        $db = db::getinstance();
        $result = $db->prepare($sql);
        $pdoresult = $result->execute(array(":fname"=>$fname, ":lname"=>$lname, ":gender"=>$gender, ":batch"=>$std, ":address"=>$address, ":mobile"=>$mobile, ":age"=>$age, ":dob"=>$dob, ":fees"=>$fees, ":profile"=>$target_dir));

        if($pdoresult)
        {
            $lastid = $db->lastInsertId();
            $this->id = $lastid;
        }
    }

    public function view($id)
    {
        $sql = "SELECT * FROM `student` WHERE id = $id";
        $db = db::getinstance();
        $result = $db->prepare($sql);
        $pdoresult = $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($studentArr, $id, $oldimage)
    {
        $fname = $studentArr['fname'];
        $lname = $studentArr['lname'];
        $address = $studentArr['address'];
        $mobile = $studentArr['mobile'];
        $age = $studentArr['age'];
        $dob = $studentArr['dob'];
        $gender = $studentArr['gender'];
        $std = $studentArr['batch'];
        $fees = $studentArr['fees'];

        if(isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"]))
        {
            $target_dir = "uploads/";
            $imageFileType = pathinfo($_FILES["profilepic"]["name"], PATHINFO_EXTENSION);
            $allowedExtArr = array('gif', 'png', 'jpg', 'jpeg');

            if(!in_array($imageFileType, $allowedExtArr))
            {
                $errorMsg .= "Please select png, jpg, jpeg, gif Files only";
            }

            if($_POST['fname'])
            {
                $fileName = "photo_".time().".".$imageFileType;
                $target_dir .= $fileName;
                if(!move_uploaded_file($_FILES["profilepic"]["temp_name"], $target_dir))
                {
                    $errorMsg .= "Error in uploading file";
                }
            }
        }

        else
        {
            $target_dir = $oldimage;
        }

        $db = db::getinstance();
        $sql1 = "UPDATE `student` SET fname='$fname', lname='$lname', gender='$gender', batch='$std', address='$address', mobile='$mobile', age='$age', dob='$dob', profilepic='$$target_dir', fees='$fees' WHERE id=$id";
        $result = $db->prepare($sql1);
        $pdoresult = $result->execute();
        $last_id = $db->lastInsertId();
        $this->id = $last_id;

        if($pdoresult)
        {
            return true;
        }

        else
        {
            return false;
        }
    }

    public function viewdata($fname)
    {
        $db = db::getinstance();
        $sql = "SELECT * FROM `student` WHERE fname LIKE '%$fname%'";
        $result = $db->prepare($sql);
        $pdoresult = $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllStudent($fName = "")
    {
        $db = db::getinstance();
        $whereClause = "";
        $sql = "SELECT * FROM `student`";

        if($fName != "")
        {
            $sql .= "WHERE fname LIKE `%$fName%`";
        }

        else
        {
            $sql .= "WHERE 1";
        }

        $recordset = $db->prepare($sql);
        $recordset->execute();
        return $recordset;
    }
}

?>