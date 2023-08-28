<?php

namespace Octobyte\viauy\modelo;

use PDOException;
use Octobyte\viauy\libs\Conexion;

class Company extends Conexion
{
  private $name;
  private $email;
  private $password;
  private $passwordC;

  public function __construct($name, $email, $password, $passwordC)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->passwordC = $passwordC;
  }

  public function validateName($name){
    $minLength = 6;
    $maxLength = 16;
    $length = strlen($name);
    return ($length >= $minLength && $length <= $maxLength);
  }

  public function validatePassword($password){
    $minLength = 8;
    $maxLength = 16;
    $length = strlen($password);
    return ($length >= $minLength && $length <= $maxLength);
  }

  public function saveCompany(){
    $pdo = Conexion::getConexion()->getPdo();

    if ($this->password === $this->passwordC) {
        try{
            if (!$this->validateName($this->name)) {
                return '<span style="color: red;">Nombre de Compañia debe tener entre 6 y 16 caracteres</span>';
              }

            if (!$this->validatePassword($this->password)) {
                return '<span style="color: red;">Contraseña debe tener entre 8 y 16 caracteres</span>';
            }

            $sqlCheck = 'SELECT COUNT(*) as count FROM company WHERE CompanyName = :name OR companyEmail = :email';
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->bindParam(':name', $this->name);
            $stmtCheck->bindParam(':email', $this->email);
            $stmtCheck->execute();
            $result = $stmtCheck->fetch();

            if ($result['count'] > 0) {
            return '<span style="color: red;">Nombre de Usuario o Email ya registrado</span>';
            }

            $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);

            $sqlInsert = 'INSERT INTO company (CompanyName, CompanyEmail, password) VALUES (:name, :email, :password)';
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':name', $this->name);
            $stmtInsert->bindParam(':email', $this->email);
            $stmtInsert->bindParam(':password', $hashPassword);

            if ($stmtInsert->execute()) {
                return true;
            }



        } catch (\Throwable $th) {
            throw $th;
      } finally {
        $pdo = null;
      }
    } else {
      return '<span style="color: red;">Las contraseñas no coinciden</span>';
    }
  }

  
  public function loginCompany()
  {
      $pdo = $this->getConexion()->getPdo();
  
      try {
          $sql = 'SELECT * FROM company WHERE companyName = :name';
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':name', $this->name);
          $stmt->execute();
          $company = $stmt->fetch(\PDO::FETCH_ASSOC);
  
          if ($company && password_verify($this->password, $company['password'])) {
              $_SESSION['company_name'] = $company['companyName'];
              return 'success';
          } else {
              return '<p class="error-msg">Nombre de compañia o contraseña incorrectos</p>';
          }
      } catch (\Throwable $th) {
          return '<p class="error-msg">Ocurrió un error durante el inicio de sesión</p>';
      } finally {
          $pdo = null;
      }
  }
  


}