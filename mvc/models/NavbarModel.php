<?php

use Core\DB;

class NavBarModel extends DB
{
    public function getInforNavBar()
    {
        try {
            $query = "SELECT * FROM navbar";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addNavBarInfor($name)
    {
        try {
            $query = "INSERT INTO navbar (name) VALUES ('$name')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getNavBarById($id)
    {
        try {
            $query = "SELECT * FROM navbar WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforNavBar($id, $name)
    {
        try {
            $query = "UPDATE navbar SET name='$name' WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteNavBar($id)
    {
        try {
            $query = "DELETE FROM navbar WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    //Child NavBar
    public function getInforChildNavBar()
    {
        try {
            $query = "SELECT *,child_navbar.name AS child,navbar.name AS parent FROM child_navbar JOIN navbar ON child_navbar.navbar_id=navbar.id";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function addChildNavBar($nav_parent_id,$name)
    {
        try {
            $query = "INSERT INTO child_navbar (navbar_id,name) VALUES ($nav_parent_id,'$name')";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function getChildNavBarById($id)
    {
        try {
            $query = "SELECT * FROM child_navbar WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function customizeInforChildNavBar($id, $name)
    {
        try {
            $query = "UPDATE child_navbar SET name='$name' WHERE id = '$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
    public function deleteChildNavBar($id)
    {
        try {
            $query = "DELETE FROM child_navbar WHERE id='$id'";
            return mysqli_query($this->connection, $query);
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}