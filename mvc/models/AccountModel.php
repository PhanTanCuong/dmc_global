<?php

use Core\DB;
class AccountModel extends DB
{

    //get List of accounts function
    public function getAccount()
    {
        $query = "SELECT * FROM register";
        $result = mysqli_query($this->connection, $query);

        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        return $result;
    }

    //Total number of user
    public function totalUser()
    {
        $query = "SELECT id FROM register ORDER BY id";
        $result = mysqli_query($this->connection, $query);

        // Check for query execution error
        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }
        $total = mysqli_num_rows($result);
        return $total;
    }

    //get account infor by id
    public function getAccountbyId($id)
    {
        $query_run = "SELECT * FROM register where id='$id'";
        return mysqli_query($this->connection, $query_run);
    }

    //add user account function
    public function addAccount($username, $email, $password, $role)
    {
        try {
            //PASSWORD_BCRYPT: độ dài=60
            //PASSWORD_DEFAULT: độ dài=255
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO register (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssss", $username, $email, $hash_password, $role);
            $result = $stmt->execute();
            $stmt->close();

            return $result;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //edit user account function
    public function editAccount($id, $username, $email, $role)
    {
        try {

            $query = "UPDATE  register SET username=?, email=?, role=? WHERE id=?  ";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssi", $username, $email, $role, $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //delete user account function
    public function deleteAccount($id)
    {
        try {
            $query_run = "DELETE FROM register WHERE id='$id'";
            return mysqli_query($this->connection, $query_run);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //LOGIN
    //login function: check email query
    public function login($email, $password)
    {
        try {
            $query = "SELECT * FROM register WHERE email = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stored_password = $row['password'];
                if (password_verify($password, $stored_password)) {
                    return $row;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
