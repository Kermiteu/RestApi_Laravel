<?php

namespace App\Http\Controllers;
use App\Models\People;
use Illuminate\Http\Request;

class CRRUD_Controller {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($first_name, $last_name, $phone_number, $street, $city) {

        $query = "INSERT INTO people (first_name, last_name, phone_number, street, city) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $first_name, $last_name, $phone_number, $street, $city);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read($id) {
        $query = "SELECT * FROM people WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return false;
        }
    }

    public function readAll() {
        $query = "SELECT * FROM people";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $users;
    }

    public function update($id, $first_name, $last_name, $phone_number, $street, $city) {

        $query = "UPDATE people SET first_name = ?, last_name = ?, phone_number = ?, street = ?, city = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $first_name, $last_name, $phone_number, $street, $city, $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM people WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}