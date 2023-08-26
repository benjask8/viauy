<?php

namespace Octobyte\viauy\modelo;

use PDOException;
use Octobyte\viauy\libs\Conexion;

class User extends Conexion
{
  private $username;
  private $email;
  private $password;
  private $passwordC;

  public function __construct($username, $email, $password, $passwordC)
  {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->passwordC = $passwordC;
  }

  public function validateUsername($username)
  {
    $minLength = 6;
    $maxLength = 16;
    $length = strlen($username);
    return ($length >= $minLength && $length <= $maxLength);
  }

  public function validatePassword($password)
  {
    $minLength = 8;
    $maxLength = 16;
    $length = strlen($password);
    return ($length >= $minLength && $length <= $maxLength);
  }

  public function saveUser()
  {
    $pdo = Conexion::getConexion()->getPdo();

    if ($this->password === $this->passwordC) {
      try {
        if (!$this->validateUsername($this->username)) {
          return '<span style="color: red;">Nombre de Usuario debe tener entre 6 y 16 caracteres</span>';
        }

        if (!$this->validatePassword($this->password)) {
          return '<span style="color: red;">Contraseña debe tener entre 8 y 16 caracteres</span>';
        }

        // Verificar si el nombre de usuario o el correo electrónico ya están registrados
        $sqlCheck = 'SELECT COUNT(*) as count FROM user WHERE userName = :username OR email = :email';
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':username', $this->username);
        $stmtCheck->bindParam(':email', $this->email);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch();

        if ($result['count'] > 0) {
          return '<span style="color: red;">Nombre de Usuario o Email ya registrado</span>';
        }

        // Si no están registrados, proceder con el registro
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $sqlInsert = 'INSERT INTO user (userName, email, password) VALUES (:username, :email, :password)';
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->bindParam(':username', $this->username);
        $stmtInsert->bindParam(':email', $this->email);
        $stmtInsert->bindParam(':password', $hashPassword);

        if ($stmtInsert->execute()) {
          $msg = '<span style="color: green;">Usuario registrado con éxito</span>';
        }

        return $msg;
      } catch (\Throwable $th) {
        throw $th;
      } finally {
        $pdo = null;
      }
    } else {
      return '<span style="color: red;">Las contraseñas no coinciden</span>';
    }
  }
  public function loginUser()
  {
      $pdo = $this->getConexion()->getPdo();
  
      try {
          $sql = 'SELECT * FROM user WHERE username = :username';
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':username', $this->username);
          $stmt->execute();
          $user = $stmt->fetch(\PDO::FETCH_ASSOC);
  
          if ($user && password_verify($this->password, $user['password'])) {
              $_SESSION['user_name'] = $user['username'];
              $_SESSION['is_admin'] = $user['is_admin'];
              // Verificar si el usuario es administrador y establecer $_SESSION['esAdmin']
              // Aquí realizarías la lógica necesaria para determinar si es administrador o no
  
              return 'success'; // Devolver un indicador de inicio de sesión exitoso
          } else {
              return '<p class="error-msg">Nombre de usuario o contraseña incorrectos</p>';
          }
      } catch (\Throwable $th) {
          return '<p class="error-msg">Ocurrió un error durante el inicio de sesión</p>';
      } finally {
          $pdo = null;
      }
  }
  
  public function getAllUsers()
    {
        try {
            $pdo = $this->getConexion()->getPdo();
            $query = "SELECT * FROM user";
            $stmt = $pdo->query($query);
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            return false; // Error
        }
    }

    public function updateAdmin($id, $esAdmin)
    {
        try {
            $pdo = $this->getConexion()->getPdo();
            $query = "UPDATE user SET is_admin = ? WHERE username = ?";
            $stmt = $pdo->prepare($query); // Usar prepare en lugar de query
            $stmt->execute([$esAdmin, $id]);
            return $esAdmin; // Devolver verdadero en caso de éxito
        } catch (PDOException $e) {
            return false; // Devolver falso en caso de error
        }
    }


}