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

    public function saveUser()
    {
      $pdo = Conexion::getConexion()->getPdo();

      try {
        // Verificar si el nombre de usuario o el correo electrónico ya están registrados
        $sqlCheck = 'SELECT COUNT(*) as count FROM user WHERE userName = :username OR email = :email';
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':username', $this->username);
        $stmtCheck->bindParam(':email', $this->email);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch();

        if ($result['count'] > 0) { 
          return 'Nombre de Usuario o Email ya registrado';
        }
        // Si no están registrados, proceder con el registro
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $sqlInsert = 'INSERT INTO user (userName, email, password) VALUES (:username, :email, :password)';
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->bindParam(':username', $this->username);
        $stmtInsert->bindParam(':email', $this->email);
        $stmtInsert->bindParam(':password', $hashPassword);

        if ($stmtInsert->execute()) {
          $msg = 'Usuario registrado con éxito';
        }

        return $msg;
      } catch (\Throwable $th) {
        throw $th;
      } finally {
        $pdo = null;
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
        return 'Nombre de usuario o contraseña incorrectos';
      }
    } catch (\Throwable $th) {
      return 'Ocurrió un error durante el inicio de sesión';
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

  public function getUser($usernameget)
  {
    try {
      $pdo = $this->getConexion()->getPdo();
      $query = "SELECT * FROM user WHERE username = ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$usernameget]);
      $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $user; // Devuelve un array, incluso si está vacío
    } catch (PDOException $e) {
      return false; // Devuelve false en caso de error
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