<?php
function get_universities()
{
    global $conn;
    $result = $conn->query("SELECT * FROM universities ORDER BY name ASC");
    $universities = [];
    while ($row = $result->fetch_assoc()) {
        $universities[] = $row;
    }
    $conn->close();
    return $universities;
}

function get_university($abbr)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM universities WHERE abbreviation=?");
    $stmt->bind_param("s", $abbr); 
    $stmt->execute();
    $result = $stmt->get_result();
    
    $university = [];
    while ($row = $result->fetch_assoc()) {
        $university[] = $row;
    }
    
    $stmt->close(); 
    $conn->close(); 
    return $university;
}