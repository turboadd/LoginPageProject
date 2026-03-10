<?php
    public function login($user, $password)
  {
    if (!empty($user) && !empty($password))
    {    
      $password = $web->doHash($user, $password); // in this function is (return sha1(strtoupper($user).':'.strtoupper($password))
      $stmt = $PDO->prepare("SELECT * FROM am where am_user = :user and am_pass= :pass");
      $stmt->bindValue(':user', $user, PDO::PARAM_STR);
      $stmt->bindValue(':pass', $password, PDO::PARAM_STR);
      $stmt->execute();
      $rows = $stmt->rowCount();

      if ($rows > 0)      
      {    
        $results_login = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_name'] = $results_login['username'];
        $_SESSION['user_id'] = $results_login['id'];  
        return true;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }
 
?> 
